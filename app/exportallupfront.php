
		<?php 
		//echo md5("hello");exit;
	

		
		require('PHPExcel.php');
		
		
		// Autosize the columns
		
		

		
		
		$logid=@$_GET['logid'];
		include("controller/func.php"); 
			$sitepack=@$_COOKIE['sitepack'];
$dec=@base64_decode($sitepack);
	
	
	$spt=explode("**--**",$dec);
	
	$compid=@$spt[0];
	$email=@$spt[1];
	$curaddress=@$spt[2];
	
	//$ip_server = $_SERVER['SERVER_ADDR'];


$curuserid=returnQueryValue("select id from tblusers where email='$email'","id");


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
						 
						 header('Content-Type: application/vnd.ms-excel');
							header("Content-Disposition: attachment; filename=\"ALL_UPFRONT_".date("Y-m-d H:i:s").".xls\"");
							header('Pragma: no-cache');
							header('Expires: 0');
						 $printa="";
						
							//$logid=returnQueryValue("select id from tblrunlog where payroll=$pid and tyear=$yr and tmonth=$imnt and tday=$tday","id");
							
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
							//$logid=returnQueryValue("select id from tblrunlog where payroll=$pid and tyear=$yr and tmonth=$imnt and tday=$tday","id");
							$cname=returnQueryValue("select name from tblcompany where id=$compid","name");
							$printa.="<b><font size='7'>".$cname."</font></b><br>";
							$printa.="<b><font size='5'>Upfront Data</font></b><br>";
							$expqr="select distinct grade from tblrunlogitemsup,tblemployee where logid=$logid and  tblemployee.id=empid";
							$expres=mysql_query($expqr);
							$expnum=mysql_num_rows($expres);
							$exprd=mysql_fetch_assoc($expres);
							
							do{
								$gradeid=$exprd['grade'];
								//echo $gradeid."<br>";
								$gradename=returnQueryValue("select gradename from tblgrades where id=$gradeid","gradename");
								$printa.="<br><b>All $gradename</b><br>";
								$printa.= "<table border=2><thead><th>Member Name</th>";
								$qr1="select distinct pelementid from tblrunlogitemsup where logid=$logid";
								//echo $qr1."<br>";
								$rs1=mysql_query($qr1);
								$rd1=mysql_fetch_assoc($rs1);
								do{
									$peleid=$rd1['pelementid'];
									if($peleid=='BASIC'){
										$pelementname="BASIC";
									}
									else{
										$pelementname=returnQueryValue("select payelement from tblpayelement where id=$peleid","payelement");
									}
									$printa.= "<th><b>".$pelementname."</b></th>";
								}
								while($rd1=mysql_fetch_assoc($rs1));
								$printa.= "<th><b></b></th>";
								$printa.="</thead><tbody>";
								
								$qr2="select distinct empid from tblrunlogitemsup,tblemployee where logid=$logid and grade=$gradeid and tblemployee.id=empid and tblrunlogitemsup.empid=tblemployee.id";
								$rs2=mysql_query($qr2);
								$rd2=mysql_fetch_assoc($rs2);
								$printa.= "<tr>";
								do{
									$empid=$rd2['empid'];
									$memname=returnQueryValue("select fullname from tblemployee where id=$empid","fullname");
									
									$printa.= "<td>".$memname."</td>";
									
									$qr3="select empid,pelementid,amount,creditdebit from tblrunlogitemsup,tblemployee where logid=$logid and grade=$gradeid and 
									tblemployee.id=$empid and tblrunlogitemsup.empid=$empid";
									
									$rs3=mysql_query($qr3);
									$rd3=mysql_fetch_assoc($rs3);
									do{
										
										$amount=$rd3['amount'];
										$creditdebit=$rd3['creditdebit'];
										
										if($creditdebit=="C"){
											$creditdebit="+";
											$printa.="<td style='color:blue;'>$creditdebit ".number_format($amount,2)."</td>";
										}else{
											$creditdebit="-";
											$printa.="<td style='color:red;'>$creditdebit ".number_format($amount,2)."</td>";
										}
										
										
										
									}while($rd3=mysql_fetch_assoc($rs3));
									
								$printa.= "</tr>";	
									
									
								}
								while($rd2=mysql_fetch_assoc($rs2));
								
								$printa.="</tbody></table>";
								
								
								
							}
								
							while($exprd=mysql_fetch_assoc($expres));	
							
							
							echo $printa;
						
						
						?>

						<div class="row" id="divres">
							
						</div>
					</div>
				</div>
		
			</div>

		