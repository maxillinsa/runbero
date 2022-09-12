<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		//echo md5("hello");exit;
		
		
		require('PHPExcel.php');
		
		
		// Autosize the columns
		
		

		
		
		$logid=@$_GET['logid'];
		include("header.php"); 
		include("mpdf60/mpdf.php");
		
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
						 
						
							//$logid=returnQueryValue("select id from tblrunlogup where payroll=$pid and tyear=$yr and tmonth=$imnt and tday=$tday","id");
							
							$rd=mysql_fetch_assoc(mysql_query("select * from tblrunlogup where id=$logid"));
							$tmonth= sprintf("%02d", $rd['tmonth']);
							$tday= sprintf("%02d", $rd['tday']);
							
							$tyear= $rd['tyear'];
							
		
							$fdate=$tyear."-".$tmonth."-".$tday;
							$pid=$rd['payroll'];
							
							$payrollname=returnQueryValue("select name from tblpayroll where id=$pid","name");
							$freq=returnQueryValue("select freq from tblpayroll where id=$pid","freq");
							
							
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
							$logid=returnQueryValue("select id from tblrunlogup where payroll=$pid and tyear=$yr and tmonth=$imnt and tday=$tday","id");
							$approved=returnQueryValue("select approved from tblrunlogup where payroll=$pid and tyear=$yr and tmonth=$imnt and tday=$tday","approved");
							if($approved==""){
								$approved="N";
							}
							if($logid==""){
								//echo "exists";exit;
								$res=mysql_query("insert into tblrunlogup(payroll,tyear,tmonth,tday,nextrun) value($pid,$yr,$mnt,$tday,'$nextrun')");
								$logid=mysql_insert_id();
							}
							
						
						
							if($approved=="Y"){
								$qry="select * from tblemployee where compid=$compid and active='Y'";
								$tyear=returnQueryValue("select tyear from tblrunlogup where id=$logid","tyear");
								$tmonth=returnQueryValue("select tmonth from tblrunlogup where id=$logid","tmonth");
								$tday=returnQueryValue("select tday from tblrunlogup where id=$logid","tday");
								$mntname=getMonthNameFromNum($tmonth);
								
								//echo $qry;exit;
								$pck="";
								$resemp=mysql_query($qry);
								$rdemp=mysql_fetch_assoc($resemp);
								$pxk="";
								
								
								
								do{
									
		$ix=0;
									$pck="";
									$empname=$rdemp['fullname'];
									//echo $empname."<br>";
									$empgrade=$rdemp['grade'];
									$empid=$rdemp['staffid'];
									$empidid=$rdemp['id'];
									
					$phpExcel = new PHPExcel;
		// Setting font to Arial Black
		$phpExcel->getDefaultStyle()->getFont()->setName('Arial Black');
		// Setting font size to 14
		$phpExcel->getDefaultStyle()->getFont()->setSize(11);
		//Setting description, creator and title
		$phpExcel ->getProperties()->setTitle("Payroll Record");
		$phpExcel ->getProperties()->setCreator("GreenRoll");
		$phpExcel ->getProperties()->setDescription("GreenRoll Generated");
		// Creating PHPExcel spreadsheet writer object
		// We will create xlsx file (Excel 2007 and above)
		$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$sheet = $phpExcel ->getActiveSheet();
		
			$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue($empname." ".$empid);
										$sheet ->getCell('B'.$ix)->setValue("");
										
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("Payroll Period");
										$sheet ->getCell('B'.$ix)->setValue($mntname.", ".$tyear);
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("");
										$sheet ->getCell('B'.$ix)->setValue("");
		
		$sheet->setTitle($empname."-".$empid);
		
									$grade=returnQueryValue("select gradename from tblgrades where id=$empgrade","gradename");
									$basicamnt=returnQueryValue("select basicpay from tblgrades where id=$empgrade","basicpay");
									
										$pck.="<div style='border: 4px solid #022E64;    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    margin: 0;
    padding: 1.5rem 1.5rem;
    position: relative;'><hr style='height:20px;background-color:#022E64;border: 10px solid #022E64;'><div class=\"row \"><div style='float:right;margin-right:10%;'>";
										$pck.="";
								$pck.="<p class=\"h3\" style='margin-bottom: .30em;font-weight: 500;line-height: 1.1;font-size:20px;font-weight:bold;'>".$cname."</p>";
								$pck.="<address style='margin-bottom: 1rem;font-style: normal;line-height: inherit;'>$address1<br>$address2<br>$address3<br$email></address></div>";
								$pck.="<div class=\"col-lg-6 text-right\" style='flex: 0 0 50%;
max-width: 50%;'><p class=\"h3\" style='margin-bottom: .30em;
font-weight: 500;
line-height: 1.1;font-size:20px;font-weight:bold;'>$empname</p><address style='margin-bottom: 1rem;font-style: normal;line-height: inherit;'><b>($empid)</b><br>$grade</address></div></div>";
								
								$pck.="<div class=\" text-dark\"><p class=\"mb-1 mt-5\"><span class=\"font-weight-semibold\">Payroll Month :</span> $mntname,$tyear</p>";
								$todaysdate=date("l jS \of F Y h:i:s A");
								//$pck.="<p><span class=\"font-weight-semibold\">Run Date :</span> $todaysdate</p><br>";
								$totEarning=0;
								
								$pck.="<p>&nbsp;</p><p><span  style='font-size:20px;margin-top: 0;
margin-bottom: 1rem;background-color:#022E64;padding:14px; font-size:22px;color:white;margin-top:7px;' >Earnings</span> </p>";
								
								$pck.="<div class=\"table-responsive\" style='width:90%'><table  style='border: 1px solid #e8ebf3!important;
								border-collapse: collapse!important;
								background-color: #fff!important;width:100%'>";
								//$pck.=
								
									$eleqry="select * from tblrunlogitemsup where creditdebit='C' and logid=$logid and empid=$empidid";
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
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'>$elementname<br>
										<font style='font-size:8px;'>$pelemnarr</font></td><td style='border: 2px solid #022E64!important;padding:7px;'>".number_format($amt,2)."</td>";
										$pck.="</tr>";
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue($elementname);
										$sheet ->getCell('B'.$ix)->setValue($amt);
										
										
										
									}while($elerd=mysql_fetch_assoc($eleres));
									
									$pck.="<tr>";
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><b>Total Earning</b></td><td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'>".number_format($totEarning,2)."</td>";
										$pck.="</tr>";
										
											$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("Total Earning");
										$sheet ->getCell('B'.$ix)->setValue($totEarning);
										
											$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("");
										$sheet ->getCell('B'.$ix)->setValue("");
										
										
									
									$pck.="</table></div>";
							
									
									$pck.="<p>&nbsp;</p><p><span  style='font-size:20px;margin-top: 0;
margin-bottom: 1rem;background-color:#022E64;padding:14px; font-size:22px;color:white;margin-top:7px;' >Deductions</span> </p>";
								
								$pck.="<div class=\"table-responsive\" style='width:90%'><table  style='border: 1px solid #e8ebf3!important;
								border-collapse: collapse!important;
								background-color: #fff!important;width:100%'>";
								//$pck.=
								$totdeduct=0;
									
									$eleqry="select * from tblrunlogitemsup where creditdebit='D' AND globalo='N' and logid=$logid and empid=$empidid";
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
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'>$elementname<br>
										<font style='font-size:8px;'>$pelemnarr</font></td><td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'>".number_format($amt,2)."</td>";
										$pck.="</tr>";
										
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue($elementname);
										$sheet ->getCell('B'.$ix)->setValue($amt);
										//echo $commit."<br>";
										
										
									}while($elerd=mysql_fetch_assoc($eleres));
									
									$pck.="<tr>";
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><b>Total Deductions</b></td><td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'>".number_format($totdeduct,2)."</td>";
										$pck.="</tr>";
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("Total Deductions");
										$sheet ->getCell('B'.$ix)->setValue($totdeduct);
										
										
										$pck.="<tr>";
										$pck.="	<td></td><td></td>";
										$pck.="</tr>";
										
										$pck.="<tr>";
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><b >Summary</b></td><td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'></td>";
										$pck.="</tr>";
										
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("");
										$sheet ->getCell('B'.$ix)->setValue("");
										
											$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("Summary");
										$sheet ->getCell('B'.$ix)->setValue("");
										
										$pck.="<tr>";
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><b >Gross Earnings</b></td><td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'>".number_format($totEarning,2)."</td>";
										$pck.="</tr>";
											$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("Gross Earning");
										$sheet ->getCell('B'.$ix)->setValue($totEarning);
										$pck.="<tr>";
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><b >Total Deductions</b></td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;color:red;'><td><font > -".number_format($totdeduct,2)."</td>";
										$pck.="</tr>";
										
											$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("Total Deductions");
										$sheet ->getCell('B'.$ix)->setValue($totdeduct);
										
										$txqry="select * from tblrunlogitemsup where creditdebit='D' AND globalo='Y' and logid=$logid and empid=$empidid";
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
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><b style='font-size:17px;'>$txname</b></td><td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><font style='color:red;'> -".number_format($txamt,2)."</td>";
										$pck.="</tr>";
										
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue($txname);
										$sheet ->getCell('B'.$ix)->setValue($txamt);
												
											}
											while($txrd=mysql_fetch_assoc($txres));
											
										}
										$tded=$totgded+$totdeduct;
										$netearn=$totEarning-$tded;
										
										$pck.="<tr>";
										$pck.="	<td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;'><b >Net Pay</b></td><td style='border: 2px solid #022E64!important;padding:7px;font-size:17px;color:red;'><font style='color:green;'><b>".number_format($netearn,2)."<b></td>";
										$pck.="</tr>";
										
										$ix=$ix+1;
										$sheet ->getCell('A'.$ix)->setValue("Net Pay");
										$sheet ->getCell('B'.$ix)->setValue($netearn);
									
									$pck.="</table></div></div></div>";
									$poka="";
									$poka=$poka.$pck;
									
								$totdeduct=0;
								$totEarning=0;
								$tded=0;
										$netearn=0;
										
										$flo=$empid.date("l jS \of F Y h:i:s A");
								//echo $todaysdate."<br>";
								$filename="upfront_".md5($flo).".xls";
								
								$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		// Save the spreadsheet
		$writer->save("docs/".$filename);
								
								$savefilea=saveFile($logid,$tday,$tmonth,$tyear,$empidid,$filename,$compid,"excel","Upfront");
																
								}
								while($rdemp=mysql_fetch_assoc($resemp));
								
								
								
							
							
							}
						
						
						?>

						<div class="row" id="divres">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title" style="font-size:30px;"><i class="fa fa-check fa-lg" style="color:green;"></i> Payslips saved in the Document bay.  </h3>
										
									</div>
									<br><br><h3 class="card-title" style="padding-left:70px;">Payslip Excel files are located in <b>My Team->Documents Bay</b></h3>
									<?php 
										//echo $pck;
									
									
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