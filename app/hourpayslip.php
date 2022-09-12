<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		//echo cal_days_in_month(CAL_GREGORIAN,01,2020);;exit;
		$dd = date('Y-m-d');
		include("header.php"); 
		 $crd=mysql_fetch_assoc(mysql_query("select * from tblcompany where id=$compid"));
						 $cname=$crd['name'];
						  $address1=$crd['address1'];
						  $address2=$crd['address2'];
						  $address3=$crd['address3'];
						  $email=$crd['email'];
						  $telephone=$crd['telephone'];
						  
			
		
		?>

			
				<div class="app-content  my-3 my-md-5">
					<div class="side-app">

						<?php 
						 $canrun="Y";
						 $canrunerror="";
						 $approved="N";
						 
						
						 
							$pid=@$_GET['pid'];
							$rd=mysql_fetch_assoc(mysql_query("select * from tblpayroll where id=$pid"));
							$fdate=$rd['rundate'];
							
							$payrollname=$rd['name'];
							$freq=$rd['freq'];
							
							
							
							
							$parts = explode('-', $fdate);
							$mnt =$parts[1];
							$yr =$parts[0];
							$yr=$current_year=date("Y");
							$tday=$parts[2];
							$itday=(int)$tday;
							$imnt=(int)$mnt;
							$mntname=getMonthNameFromNum($mnt);
							$now = date('Y-m-d'); // or your date as well
							$nextrun="";
							$currundate=$yr."-".$mnt."-".$tday;
							//echo $currundate;exit;
							if($freq=="Monthly"){
								
								$nextrun = date('Y-m-d', strtotime("+1 months", strtotime($fdate)));
								
							}
							//$nextrun=$current_year."-".$current_month_num."-20";
							//echo $nextrun;
							$logid=returnQueryValue("select id from tblrunlog where payroll=$pid and tyear=$yr and tmonth=$imnt and tday=$tday","id");
							$approved=returnQueryValue("select approved from tblrunlog where payroll=$pid and tyear=$yr and tmonth=$imnt and tday=$tday","approved");
							if($approved==""){
								$approved="N";
							}
							if($logid==""){
								//echo "exists";exit;
								$res=mysql_query("insert into tblrunlog(payroll,tyear,tmonth,tday,nextrun,transdate,runby) value($pid,$yr,$mnt,$tday,'$nextrun','$dd',$curuserid)");
								$logid=mysql_insert_id();
							}
							
							$assignedto=returnQueryValue("select assignedto from tblrunlog where id=$logid","assignedto");
							
							//echo $logid;
							if($approved=="N"){
								$qry="select * from tblemployee where compid=$compid and active='Y'";
								//echo $qry;exit;
								$pck="";
								$resemp=mysql_query($qry);
								$rdemp=mysql_fetch_assoc($resemp);
								do{
									
									$empname=$rdemp['fullname'];
									//echo $empname."<br>";
									$empgrade=$rdemp['grade'];
									$empid=$rdemp['staffid'];
									$empidid=$rdemp['id'];
									$incr=getIncrease($empgrade);
									$grade=returnQueryValue("select gradename from tblgrades where id=$empgrade","gradename");
									$basicamnt=returnQueryValue("select basicpay from tblgrades where id=$empgrade","basicpay");
									$basicamnt=proratepay($empidid,$basicamnt,$mnt,$yr);
									$basicamnt=$basicamnt+ $incr/100 * $basicamnt;
									
										$pck.="<div class=\"card-body\" style='border: 4px solid #022E64;'><hr style='height:20px;background-color:#022E64;border: 10px solid #022E64;'><div class=\"row \"><div class=\"col-lg-6 \">";
										$pck.="";
								$pck.="<p class=\"h3\">".$cname."</p>";
								$pck.="<address>$address1<br>$address2<br>$address3<br$email></address></div>";
								$pck.="<div class=\"col-lg-6 text-right\"><p class=\"h3\">$empname</p><address><b>($empid)</b><br>$grade</address></div></div>";
								
								$pck.="<div class=\" text-dark\"><p class=\"mb-1 mt-5\"><span class=\"font-weight-semibold\">Payroll Month :</span> $mntname,$yr</p>";
								$todaysdate=date("l jS \of F Y h:i:s A");
								$pck.="<p><span class=\"font-weight-semibold\">Run Date :</span> $todaysdate</p><br>";
								$totEarning=0;
								
								$pck.="<p><span class=\"font-weight-bold\" style='font-size:20px;'>Earnings</span> </p>";
								
								$pck.="<div class=\"table-responsive\"><table class=\"table table-bordered table-hover text-nowrap\">";
								//$pck.=
								$totEarning=$totEarning+$basicamnt;
									$pck.="<tr>";
										$pck.="	<td>Basic Pay</td><td>".number_format($basicamnt,2)."</td>";
										$pck.="</tr>";
										$commit=savePayElementLog("BASIC",$logid,"C",$tday,$mnt,$yr,$empidid,$basicamnt,"G","BASIC Pay","N","Basic Salary");
									
									$eleqry="select * from tblpayelement where active='Y' and grade=$empgrade and creditdebit='C' and crita not in ('TAXG','PENS') and payroll=$pid and '$currundate' between wef and wet";
									//echo $eleqry."<br>";
									$eleres=mysql_query($eleqry);
									$retno=mysql_num_rows($eleres);
									$elerd=mysql_fetch_assoc($eleres);
									if($retno>0){
										do{
										
										$eleid=$elerd['id'];
										$payelement=$elerd['payelement'];
										$amt=computeElement($eleid);
										$amt=proratepay($empidid,$amt,$mnt,$yr);
										$amt=getUpFront($amt,$eleid,$pid,$empgrade);
										$amt=$amt+ $incr/100 * $amt;
										$pelemnarr=getPayItemNarration($eleid);
										$totEarning=$totEarning+$amt;
										$pck.="<tr>";
										$pck.="	<td>$payelement<br>
										<font style='font-size:8px;'>$pelemnarr</font></td><td>".number_format($amt,2)."</td>";
										$pck.="</tr>";
										$commit=savePayElementLog($eleid,$logid,"C",$tday,$mnt,$yr,$empidid,$amt,"G",$pelemnarr,"N",$payelement);
										
									}while($elerd=mysql_fetch_assoc($eleres));
									}
									
									
									
									
							////////////////////Personaized angle for credit		
									$pqry="select * from tblemployeepayelement where empid=$empidid and creditdebit='C' and '$currundate' between wef and wet";
								//	echo $pqry;
									$pres=mysql_query($pqry);
									
									$prd=mysql_fetch_assoc($pres);
									$pnum=mysql_num_rows($pres);
									if($pnum>0){
										do{
											$pesid=$prd['id'];
											$payelement=$prd['payelement'];
											$amount=$prd['amount'];
											$amount=proratepay($empidid,$amount,$mnt,$yr);
											$totEarning=$totEarning+$amount;
											$pck.="	<td>$payelement<br></td><td>".number_format($amount,2)."</td>";
										$pck.="</tr>";
										$commit=savePayElementLog("CUSTOM".$pesid,$logid,"C",$tday,$mnt,$yr,$empidid,$amount,"P","Use Amount","N",$payelement);
										//echo $commit."<br>";
											
										}
										while($prd=mysql_fetch_assoc($pres));
										
									}
						////////////////////////////////////////////////////////////////
									
									$pck.="<tr>";
										$pck.="	<td><b>Total Earning</b></td><td>".number_format($totEarning,2)."</td>";
										$pck.="</tr>";
										
									
									$pck.="</table></div>";
								//	$totEarning=0;
									
									
									////debits deductions
									
									$pck.="<p><span class=\"font-weight-bold\" style='font-size:20px;'>Deductions</span> </p>";
								
								$pck.="<div class=\"table-responsive\"><table class=\"table table-bordered table-hover text-nowrap\">";
								//$pck.=
								$totdeduct=0;
									
									$eleqry="select * from tblpayelement where active='Y' and grade=$empgrade and creditdebit='D' and crita not in ('TAXG','PENS') and payroll=$pid and '$currundate' between wef and wet";
									//echo $eleqry;
									$eleres=mysql_query($eleqry);
									$retnop=mysql_num_rows($eleres);
									$elerd=mysql_fetch_assoc($eleres);
									if($retnop>0){
										
										do{
										
										$eleid=$elerd['id'];
										$payelement=$elerd['payelement'];
										$amt=computeElement($eleid);
										$amt=proratepay($empidid,$amt,$mnt,$yr);
										$amt=getUpFront($amt,$eleid,$pid,$empgrade);
										//$amt=$amt+ $incr/100 * $amt;
										$pelemnarr=getPayItemNarration($eleid);
										$totdeduct=$totdeduct+$amt;
										$pck.="<tr>";
										$pck.="	<td>$payelement<br>
										<font style='font-size:8px;'>$pelemnarr</font></td><td>".number_format($amt,2)."</td>";
										$pck.="</tr>";
										
										$commit=savePayElementLog($eleid,$logid,"D",$tday,$mnt,$yr,$empidid,$amt,"G",$pelemnarr,"N",$payelement);
										//echo $commit."<br>";
										
										
									}while($elerd=mysql_fetch_assoc($eleres));
										
									}
									
									///////LOAN/////////
									$eleqry="select * from tblpayelement where grade=$empgrade and creditdebit='D' and crita in ('LND')  and '$currundate' between wef and wet";
									//echo $eleqry;
									$eleres=mysql_query($eleqry);
									$retnop=mysql_num_rows($eleres);
									$elerd=mysql_fetch_assoc($eleres);
									if($retnop>0){
										
										do{
										
										$eleid=$elerd['id'];
										$payelement=$elerd['payelement'];
										$amt=computeElementLN($empidid);
										//$amt=proratepay($empidid,$amt,$mnt,$yr);
										//$amt=getUpFront($amt,$eleid,$pid,$empgrade);
										$pelemnarr=getPayItemNarration($eleid);
										$totdeduct=$totdeduct+$amt;
										$pck.="<tr>";
										$pck.="	<td>$payelement<br>
										<font style='font-size:8px;'>$pelemnarr</font></td><td>".number_format($amt,2)."</td>";
										$pck.="</tr>";
										
										$commit=savePayElementLog($eleid,$logid,"D",$tday,$mnt,$yr,$empidid,$amt,"G",$pelemnarr,"N",$payelement);
										//echo $commit."<br>";
										
										
									}while($elerd=mysql_fetch_assoc($eleres));
										
									}
									//////////////////////////
									
									
							////////////////////Personaized angle for DEBIT		
									$pqry="select * from tblemployeepayelement where empid=$empidid and creditdebit='D' and '$currundate' between wef and wet";
									$pres=mysql_query($pqry);
									$prd=mysql_fetch_assoc($pres);
									$pnum=mysql_num_rows($pres);
									if($pnum>0){
										do{
											$pesid=$prd['id'];
											$payelement=$prd['payelement'];
											$amount=$prd['amount'];
											$amount=proratepay($empidid,$amount,$mnt,$yr);
											$totdeduct=$totdeduct+$amount;
											$pck.="	<td>$payelement<br></td><td>".number_format($amount,2)."</td>";
										$pck.="</tr>";
										$commit=savePayElementLog("CUSTOM".$pesid,$logid,"D",$tday,$mnt,$yr,$empidid,$amount,"P","Use Amount","N",$payelement);
											
										}
										while($prd=mysql_fetch_assoc($pres));
										
									}
						////////////////////////////////////////////////////////////////
									
									$pck.="<tr>";
										$pck.="	<td><b>Total Deductions</b></td><td>".number_format($totdeduct,2)."</td>";
										$pck.="</tr>";
										
										$pck.="<tr>";
										$pck.="	<td></td><td></td>";
										$pck.="</tr>";
										
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Summary</b></td><td></td>";
										$pck.="</tr>";
										
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Gross Earnings</b></td><td>".number_format($totEarning,2)."</td>";
										$pck.="</tr>";
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Total Deductions</b></td><td><font style='color:red;'> -".number_format($totdeduct,2)."</td>";
										$pck.="</tr>";
										
										$txqry="select * from tblpayelement where active='Y' and grade=$empgrade and creditdebit='D' and crita in ('TAXG','PENS') and payroll=$pid and '$currundate' between wef and wet";
										$txres=mysql_query($txqry);
										$txrd=mysql_fetch_assoc($txres);
										$txnum=mysql_num_rows($txres);
										$totgded=0;
										
										if($txnum>0){
											do{
												$peleid=$txrd['id'];
												$txname=$txrd['payelement'];
												$pelemnarr=getPayItemNarration($peleid);
												$txpct=$txrd['pct'];
												$txamt=($totEarning * $txpct)/100;
												
												$txamt=proratepay($empidid,$txamt,$mnt,$yr);
												$txamt=getUpFront($txamt,$peleid,$pid,$empgrade);
												$totgded=$totgded+$txamt;
												
												$crita=$txrd['crita'];
												$commit=savePayElementLog($peleid,$logid,"D",$tday,$mnt,$yr,$empidid,$txamt,"G",$pelemnarr,"Y",$txname);
												
												
												
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>$txname</b></td><td><font style='color:red;'> -".number_format($txamt,2)."</td>";
										$pck.="</tr>";
												
											}
											while($txrd=mysql_fetch_assoc($txres));
											
										}
										$tded=$totgded+$totdeduct;
										$netearn=$totEarning-$tded;
										
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Net Pay</b></td><td><font style='color:green;'><b>".number_format($netearn,2)."<b></td>";
										$pck.="</tr>";
									
									$pck.="</table></div></div></div>";
									
								$totdeduct=0;
								$totEarning=0;
								$tded=0;
										$netearn=0;
									
								}
								while($rdemp=mysql_fetch_assoc($resemp));
							
							
							}
						
						
						
						
						
						// approved already
						
							if($approved=="Y"){
								$qry="select * from tblemployee where compid=$compid and active='Y'";
								$tyear=returnQueryValue("select tyear from tblrunlog where id=$logid","tyear");
								$tmonth=returnQueryValue("select tmonth from tblrunlog where id=$logid","tmonth");
								$tday=returnQueryValue("select tday from tblrunlog where id=$logid","tday");
								$mntname=getMonthNameFromNum($tmonth);
								
								//echo $qry;exit;
								$pck="";
								$resemp=mysql_query($qry);
								$rdemp=mysql_fetch_assoc($resemp);
								do{
									
									$empname=$rdemp['fullname'];
									//echo $empname."<br>";
									$empgrade=$rdemp['grade'];
									$empid=$rdemp['staffid'];
									$empidid=$rdemp['id'];
									$grade=returnQueryValue("select gradename from tblgrades where id=$empgrade","gradename");
									$basicamnt=returnQueryValue("select basicpay from tblgrades where id=$empgrade","basicpay");
									
										$pck.="<div class=\"card-body\" style='border: 4px solid #022E64;'><hr style='height:20px;background-color:#022E64;border: 10px solid #022E64;'><div class=\"row \"><div class=\"col-lg-6 \">";
										$pck.="";
								$pck.="<p class=\"h3\">".$cname."</p>";
								$pck.="<address>$address1<br>$address2<br>$address3<br$email></address></div>";
								$pck.="<div class=\"col-lg-6 text-right\"><p class=\"h3\">$empname</p><address><b>($empid)</b><br>$grade</address></div></div>";
								
								$pck.="<div class=\" text-dark\"><p class=\"mb-1 mt-5\"><span class=\"font-weight-semibold\">Payroll Month :</span> $mntname,$tyear</p>";
								$todaysdate=date("l jS \of F Y h:i:s A");
								//$pck.="<p><span class=\"font-weight-semibold\">Run Date :</span> $todaysdate</p><br>";
								$totEarning=0;
								
								$pck.="<p><span class=\"font-weight-bold\" style='font-size:20px;'>Earnings</span> </p>";
								
								$pck.="<div class=\"table-responsive\"><table class=\"table table-bordered table-hover text-nowrap\">";
								//$pck.=
								
									$eleqry="select * from tblrunlogitems where creditdebit='C' and logid=$logid and empid=$empidid";
									//echo $eleqry;exit;
									$eleres=mysql_query($eleqry);
									$elerd=mysql_fetch_assoc($eleres);
									do{
										
										$eleid=$elerd['pelementid'];
										$starget=$elerd['starget'];
										$elementname="";
										if($starget=="P"){
											$elementname=$elerd['payitemname'];
										}
										else{
											if($eleid=="BASIC"){
											$elementname=$elerd['payitemname'];
											
										}else{
											$elementname=$elerd['payitemname'];
										}
										}
										
										
										$pelemnarr=$elerd['paynarration'];
										$amt=$elerd['amount'];
										$totEarning=$totEarning+$amt;
										$pck.="<tr>";
										$pck.="	<td>$elementname<br>
										<font style='font-size:8px;'>$pelemnarr</font></td><td>".number_format($amt,2)."</td>";
										$pck.="</tr>";
										
										
									}while($elerd=mysql_fetch_assoc($eleres));
									
									$pck.="<tr>";
										$pck.="	<td><b>Total Earning</b></td><td>".number_format($totEarning,2)."</td>";
										$pck.="</tr>";
										
									
									$pck.="</table></div>";
								//	$totEarning=0;
									
									
									////debits deductions
									
									$pck.="<p><span class=\"font-weight-bold\" style='font-size:20px;'>Deductions</span> </p>";
								
								$pck.="<div class=\"table-responsive\"><table class=\"table table-bordered table-hover text-nowrap\">";
								//$pck.=
								$totdeduct=0;
									
									$eleqry="select * from tblrunlogitems where creditdebit='D' AND globalo='N' and logid=$logid and empid=$empidid";
									//echo $eleqry;exit;
									$eleres=mysql_query($eleqry);
									$elerd=mysql_fetch_assoc($eleres);
									do{
										
										$eleid=$elerd['pelementid'];
										$elementname="";
										if($eleid=="BASIC"){
											$elementname="Basic Salary";
											
										}else{
											$elementname=$elerd['payitemname'];
										}
										
										
										$pelemnarr=$elerd['paynarration'];
										$amt=$elerd['amount'];
										$totdeduct=$totdeduct+$amt;
										$pck.="<tr>";
										$pck.="	<td>$elementname<br>
										<font style='font-size:8px;'>$pelemnarr</font></td><td>".number_format($amt,2)."</td>";
										$pck.="</tr>";
										
										
										//echo $commit."<br>";
										
										
									}while($elerd=mysql_fetch_assoc($eleres));
									
									$pck.="<tr>";
										$pck.="	<td><b>Total Deductions</b></td><td>".number_format($totdeduct,2)."</td>";
										$pck.="</tr>";
										
										$pck.="<tr>";
										$pck.="	<td></td><td></td>";
										$pck.="</tr>";
										
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Summary</b></td><td></td>";
										$pck.="</tr>";
										
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Gross Earnings</b></td><td>".number_format($totEarning,2)."</td>";
										$pck.="</tr>";
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Total Deductions</b></td><td><font style='color:red;'> -".number_format($totdeduct,2)."</td>";
										$pck.="</tr>";
										
										$txqry="select * from tblrunlogitems where creditdebit='D' AND globalo='Y' and logid=$logid and empid=$empidid";
										$txres=mysql_query($txqry);
										$txrd=mysql_fetch_assoc($txres);
										$txnum=mysql_num_rows($txres);
										$totgded=0;
										
										if($txnum>0){
											do{
												
										
												$peleid=$txrd['pelementid'];
												$txname=$txrd['payitemname'];
												//$txpct=$txrd['pct'];
												$txamt=$txrd['amount'];
												$totgded=$totgded+$txamt;
												
												
												
												
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>$txname</b></td><td><font style='color:red;'> -".number_format($txamt,2)."</td>";
										$pck.="</tr>";
												
											}
											while($txrd=mysql_fetch_assoc($txres));
											
										}
										$tded=$totgded+$totdeduct;
										$netearn=$totEarning-$tded;
										
										$pck.="<tr>";
										$pck.="	<td><b style='font-size:17px;'>Net Pay</b></td><td><font style='color:green;'><b>".number_format($netearn,2)."<b></td>";
										$pck.="</tr>";
									
									$pck.="</table></div></div></div>";
									
								$totdeduct=0;
								$totEarning=0;
								$tded=0;
										$netearn=0;
									
								}
								while($rdemp=mysql_fetch_assoc($resemp));
							
							
							}
						
						
						?>

						<div class="row" id="divres">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><?php echo $payrollname; ?></h3>
										<div class="card-options">
										<?php if($approved=="N"){ 
										
										
										if($assignedto>0){
											echo "Payroll sent for Approval";
										}else{
										?><a href="requestapproval.php?logid=<?php echo $logid; ?>"><button type="button" class="btn btn-sm btn-blue mr-2"><i class="icon ion-checkmark"></i> Request Payroll Approval</button></a>	
										<?php 
										}
										if($assignedto==$curuserid){
										?><button type="button" class="btn btn-sm btn-pink mr-2"><i class="icon icon-wallet"></i> Approve Payslip(s)</button>
										
										<?php } } ?>
											<?php if($approved=="Y"){  ?><button type="button" class="btn btn-sm btn-primary mr-2"><i class="fa fa-envelope-o"></i> Send Payslip</button>
											<?php echo "<a href='pdfpayslip.php?logid=$logid' >"; ?><button type="button" class="btn btn-sm btn-secondary mr-2"><i class="fa fa-file-pdf-o"></i> Export to PDF</button><?php echo "</a>"; ?>
											<?php echo "<a href='excelslip.php?logid=$logid' >"; ?><button type="button" class="btn btn-sm btn-secondary mr-2"><i class="fa fa-file-excel-o"></i> Export to Excel</button></a>
											<?php } ?>
											
											<a href="exportall.php?logid=<?php echo $logid; ?>" target="_blank"><button type="button" class="btn btn-sm btn-blue mr-2"><i class="icon fa-file-excel-o"></i> Export All to CSV</button></a>
										</div>
									</div>
									<?php 
										echo $pck;
									
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
		
			</div>

			<!--footer-->
		<?php include("footer.php"); ?>
			<!-- End Footer-->
		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top" ><i class="fa fa-rocket"></i></a>


		<!-- Dashboard Core -->
		<script src="../assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="../assets/js/vendors/selectize.min.js"></script>
		<script src="../assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="../assets/js/vendors/circle-progress.min.js"></script>
		<script src="../assets/plugins/rating/jquery.rating-stars.js"></script>

		<!--Counters -->
		<script src="../assets/plugins/counters/counterup.min.js"></script>
		<script src="../assets/plugins/counters/waypoints.min.js"></script>

		<!-- Fullside-menu Js-->
		<script src="../assets/plugins/toggle-sidebar/sidemenu.js"></script>

		<!-- CHARTJS CHART -->
		<script src="../assets/plugins/chart/Chart.bundle.js"></script>
		<script src="../assets/plugins/chart/utils.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!-- ECharts Plugin -->
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/js/index1.js"></script>

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>

	</body>
</html>