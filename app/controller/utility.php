<?php 
$appname="Blueroll";

	$act=@$_POST['act'];
	include("func.php");
	$dd = date('Y-m-d');

$sitepack=@$_COOKIE['sitepack'];
$dec=@base64_decode($sitepack);
	
	
	$spt=explode("**--**",$dec);
	
	$compid=@$spt[0];
	$email=@$spt[1];
	$curaddress=@$spt[2];
	
	//$ip_server = $_SERVER['SERVER_ADDR'];

$applink=returnQueryValue("select appurl from tblcompany where id=$compid","appurl");

$curuserid=returnQueryValue("select id from tblusers where email='$email'","id");
$smailparam=returnQueryValue("select sendmail from tblcompany where id=$compid","sendmail");
$cname=returnQueryValue("select name from tblcompany where id=$compid","name");
	$imglogo=returnQueryValue("select imglogo from tblcompany where id=$compid","imglogo");

		
		if($act=="addgrade"){
			$txtgrade=@$_POST['txtgrade'];
			$txtbasic=@$_POST['txtbasic'];
			
			$rnm=recNum("select * from tblgrades where compid=$compid and gradename='$txtgrade'");
			if($rnm>0){
				echo "exists";exit;
			}
			
			$qry="insert into tblgrades(compid,gradename,basicpay) values($compid,'$txtgrade',$txtbasic)";
			$res=mysql_query($qry);
			echo "1";
			
		}
		
		//cbocrite:cbocrite,txtpayelement:txtpayelement,act: '', txtamount: txtamount,txtpcent: txtpcent,txtwef:txtwef, txtwet: txtwet, cbopayelement: cbopayelement
		//grdid:grdid,payid:payid
		if($act=="addpayelement"){
			$cbocrite=@$_POST['cbocrite'];
			$txtpayelement=@$_POST['txtpayelement'];
			$txtamount=@$_POST['txtamount'];
			$txtpcent=@$_POST['txtpcent'];
			$txtwef=@$_POST['txtwef'];
			$txtwet=@$_POST['txtwet'];
			$cbopayelement=@$_POST['cbopayelement'];
			$grdid=@$_POST['grdid'];
			$payid=@$_POST['payid'];
			$cbotype=@$_POST['cbotype'];
			$ischecked=@$_POST['ischecked'];
			
			$rnm=recNum("select * from tblpayelement where compid=$compid and grade=$grdid and payroll=$payid and payelement='$txtpayelement'");
			if($rnm>0){
				echo "exists";exit;
			}
			$txtwef=date('Y-m-d', strtotime($txtwef));
			$txtwet=date('Y-m-d', strtotime($txtwet));
			
			$qry="insert into tblpayelement(compid,payelement,amount,crita,wef,wet,dependson,payroll,grade,pct,creditdebit,pension) 
			values($compid ,'$txtpayelement',$txtamount,'$cbocrite','$txtwef','$txtwet','$cbopayelement',$payid,$grdid,$txtpcent,'$cbotype','$ischecked')";
			//echo $qry;exit;
			$res=mysql_query($qry);
			echo "1";
			
		}
		
		//ischecked:ischecked,cbotype:cbotype,cbocrite:cbocrite,txtpayelement:txtpayelement,act: 'addpayelementpersonal', txtamount: txtamount,txtwef:txtwef, txtwet: txtwet
		
			if($act=="addpayelementpersonal"){
			$cbocrite=@$_POST['cbocrite'];
			$txtpayelement=@$_POST['txtpayelement'];
			$txtamount=@$_POST['txtamount'];
			
			$txtwef=@$_POST['txtwef'];
			$txtwet=@$_POST['txtwet'];
			
			
			$cbotype=@$_POST['cbotype'];
			$ischecked=@$_POST['ischecked'];
			$empid=@$_POST['empid'];
			
			
			
			$rnm=recNum("select * from tblemployeepayelement where empid=$empid and payelement='$txtpayelement'");
			if($rnm>0){
				echo "exists";exit;
			}
			$txtwef=date('Y-m-d', strtotime($txtwef));
			$txtwet=date('Y-m-d', strtotime($txtwet));
			
			$qry="insert into tblemployeepayelement(compid,payelement,amount,crita,wef,wet,creditdebit,empid) 
			values($compid ,'$txtpayelement',$txtamount,'$cbocrite','$txtwef','$txtwet','$cbotype',$empid)";
			//echo $qry;exit;
			$res=mysql_query($qry);
			echo "1";
			
		}
		
		//act: 'loadpayelementtable', cbopayroll: cbopayroll,cbograde:cbograde
		
		if($act=="loadpayelementtable"){
			
			$cbopayroll=@$_POST['cbopayroll'];
			$cbograde=@$_POST['cbograde'];
			
			if($cbopayroll==""){}else{
				if($cbograde==""){
					$qry="select * from tblpayelement where compid=$compid and payroll=$cbopayroll";
				}else{
					$qry="select * from tblpayelement where compid=$compid and payroll=$cbopayroll and grade=$cbograde";
				}
				
			}
			
			
									//	echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$pck="
											<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" >
												<thead>
													<tr>
														<th>S/N</th>
														<th>Pay Element</th>
														<th>Amount</th>
														<th>Computation Formula</th>
														<th>Factor</th>
														<th>Pay Type</th>
														<th>Pension Savings</th>
														<th>Status</th>
														<th>WEF</th>
														<th>WET</th>
														
													</tr>
												</thead>
												<tbody>";
											$rd=mysql_fetch_assoc($res);
											$ip=1;
											do{
												$pck.="<tr>";	
												$pck.="<td>".$ip."</td>";
												$pck.="<td><center>".$rd['payelement']."</center></td>";
												$pck.="<td><center>".number_format($rd['amount'],2)."</center></td>";
												$crita=$rd['crita'];
												$peid=$rd['id'];
												$parentpayelement="";
												$dependson=$rd['dependson'];
												if($dependson=="BASIC"){
													$parentpayelement="Basic Pay";
												}else{
													$parentpayelement=returnQueryValue("select payelement from tblpayelement where id=$dependson","payelement");
												}
											
												if($crita=="USEAMT"){													
													$crita="Use Amount Specified";
													$parentpayelement="";
												}
												if($crita=="PCT"){													
													$crita="% of Another Pay Element";
												}
												if($crita=="EQL"){													
													$crita="= Another Pay Element";
												}
												
												if($crita=="MLTP"){													
													$crita="= Multiple of Another Pay Element";
												}
												
												if($crita=="TAXA"){													
													$crita="Tax on another Pay Element";
												}
												
												if($crita=="TAXG"){													
													$crita="= Tax on Payroll Total Gross";
												}
												
													$fnalcrite=$crita." - <b>".$parentpayelement."<b>";
																						
												
												$pck.="<td>".$fnalcrite."</td>";
												$ptype="";
												$creditdebit=$rd['creditdebit'];
												if($creditdebit=="D"){
													$ptype="Deduction";
												}else{
													$ptype="Earning";
												}
												
												$pck.="<td><center>".$rd['pct']."</center></td>";
												
												$pck.="<td><center>".$ptype."</center></td>";
												
												$pension=$rd['pension'];
												if($pension=="Y"){
													
													$pck.="<td><center><i class=\"fa fa-check text-dark\"></i></center></td>";
													
												}else{
													$pck.="<td></td>";
												}
												
												$active=$rd['active'];
												
												
												
												$btnlabel="";
														$active=$rd['active']; 
														if($active=="Y"){
															$active= "Active";
															$btnlabel="Deactivate";
														}
														else{
															$active= "Inactive";
															$btnlabel="Activate";
														}
												$pck.="<td><center>".$active." <a href='activatepayelement.php?id=$peid'><button class='btn btn-sm btn-primary'>$btnlabel</button> </a></center></td>";
												
												$pck.="<td><center>".$rd['wef']."</center></td>";
												$pck.="<td><center>".$rd['wet']."</center></td>";


												$pck.="</tr>";													
													
																								
												$ip=$ip+1;
													}
													while($rd=mysql_fetch_assoc($res));
													
													$pck.="</tbody></table>";
													
													echo $pck;
													
			
		}
		}
		
		if($act=="adddepartment"){
			
			$txtdepartment=@$_POST['txtdepartment'];
			
			$rnm=recNum("select * from tbldepartments where compid=$compid and department='$txtdepartment'");
			if($rnm>0){
				echo "exists";exit;
			}
			
			$qry="insert into tbldepartments(compid,department) values($compid,'$txtdepartment')";
			$res=mysql_query($qry);
			echo "1";
			
		}
		
		//cbograde:cbograde,txtpcent:txtpcent,txtstartdate: txtstartdate,act: 'addincrease'
		
		if($act=="addincrease"){
			
			$cbograde=@$_POST['cbograde'];
			$txtpcent=@$_POST['txtpcent'];
			$txtstartdate=@$_POST['txtstartdate'];
			
			
			$qry="insert into salaryincrement(compid,grade,pcent,ddate,createdby) values($compid,$cbograde,$txtpcent,'$dd',$curuserid)";
			$res=mysql_query($qry);
			echo "1";
			
		}
		
		if($act=="addstaff"){
			
			$cbograde=@$_POST['cbograde'];
			$txtempid=@$_POST['txtempid'];
			$txtfname=@$_POST['txtfname'];
			$txtemail=@$_POST['txtemail'];
			$txttel=@$_POST['txttel'];
			$txtaddress=@$_POST['txtaddress'];
			
			$appid=getappid();
			$rnm=recNum("select * from  tblemployee where compid=$compid and staffid='$txtempid'");
			if($rnm>0){
				echo "exists";exit;
			}
			$rema=getremainingmembers($compid);
			if($rema>0){
			$qry="insert into tblemployee(compid,fullname,grade,email,telephone,staffid,appid,address,datecreated) values($compid,'$txtfname',$cbograde,'$txtemail','$txttel','$txtempid','$appid','$txtaddress','$dd')";
			$res=mysql_query($qry);
			$pword=sha1("123456");
			$resx=mysql_query("insert into tblusers(fullname,email,telephone,pword,compid,role) values ('$txtfname','$txtemail','$txttel','$pword',$compid,'member')");
			
			$linkcrumb=uniqid();
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Your account has been created on $applink!</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/login.php?ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Login to $cname </button></a> </p>";
				
				//echo $pemail;
				$subject="Welcome to ".$appname;
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
			
			echo "1";
			}else{
				echo "exceed";
			}
			
			
		}
		
		//empid:empid,cbograde:cbograde,txtempid:txtempid,txtfname:txtfname,txtemail:txtemail,txttel:txttel,act: 'editstaff'
		
		if($act=="editstaff"){
			
			$empid=@$_POST['empid'];
			$cbograde=@$_POST['cbograde'];
			$txtempid=@$_POST['txtempid'];
			$txtfname=@$_POST['txtfname'];
			$txtemail=@$_POST['txtemail'];
			$txttel=@$_POST['txttel'];
			$txtaddress=@$_POST['txtaddress'];
			$oldgrade=returnQueryValue("select grade from tblemployee where id=$empid","grade");
			$oldemail=returnQueryValue("select email from tblemployee where id=$empid","email");
			if($cbograde==$oldgrade){}else{
			$rst=mysql_query("update tblusers set email='$txtemail' where email='$oldemail'");
			}
			
			$reso=mysql_query("insert into tblemployeegradelog(empid,tfrom,tto,ddate,createdby) values($oldgrade,$oldgrade,$cbograde,'$dd',$curuserid)");
					
			$qry="update tblemployee set fullname='$txtfname',grade=$cbograde,email='$txtemail',telephone='$txttel',staffid='$txtempid',address='$txtaddress' where id=$empid";
			$res=mysql_query($qry);
			
			
			echo "1";
			
		}
		
		//ccboplan:cboplan,act: 'upgrade2',ifreq:ifreq,cname:cname
		
		
		
			if($act=="upgrade"){
			
			$cboplan=@$_POST['cboplan'];
			
			$ifreq=@$_POST['ifreq'];
			if($ifreq=="mnt"){
				$futureDate=date('Y-m-d', strtotime('+1 months'));
			}else{
				$futureDate=date('Y-m-d', strtotime('+1 year'));
			}
			
			
			$mntprice=returnQueryValue("select mnt from tblplans where id=$cboplan","mnt");
			$yrprice=returnQueryValue("select tyear from tblplans where id=$cboplan","tyear");
			$nmember=returnQueryValue("select nmember from tblplans where id=$cboplan","nmember");
			//echo "update tblcompany set planid=$cboplan,nmember=$nmember, wef='$dd',wet='$futureDate' where compid=$compid";
			$res=mysql_query("update tblcompany set planid=$cboplan,nmember=$nmember, wef='$dd',wet='$futureDate' where id=$compid");
		echo "1";
		
		}
		
		if($act=="getplanprice"){
			
			$cboplan=@$_POST['cboplan'];
			if($cboplan==""){
				echo "&nbsp;";exit;
			}
			$mntprice=returnQueryValue("select mnt from tblplans where id=$cboplan","mnt");
			$yrprice=returnQueryValue("select tyear from tblplans where id=$cboplan","tyear");
			
			echo "<a href=\"javascript:payWithPaystack('$cboplan','$mntprice','mnt');\" ><button class=\"btn btn-primary\">"."<i class=\"fa fa-credit-card\"></i> Pay Monthly rate of ".number_format($mntprice)."</button></a><br><br>";
			echo "<a href=\"javascript:payWithPaystack('$cboplan','$yrprice','yr');\" ><button class=\"btn btn-primary\">"."<i class=\"fa fa-credit-card\"></i> Pay Monthly rate of ".number_format($yrprice)."</button></a><br><br>";
			
		}
		
		//changepass,txtoldpass:txtoldpass,txtpass:txtpass,
		
		if($act=="changepass"){
			//txtport:txtport,txtsmtp:txtsmtp,txtusername:txtusername,txtpass:txtpass
			$txtoldpass=@$_POST['txtoldpass'];
			$txtpass=@$_POST['txtpass'];
			$oldsha=sha1($txtoldpass);
			$txtpass=sha1($txtpass);
			$rn=recNum("select * from tblusers where email='$email' and pword='$oldsha'");
			if($rn<1){
				echo "xxx";exit;
			}
			$res=mysql_query("update tblusers set pword='$txtpass' where email='$email'");
		echo "1";
		}
		
		if($act=="updatedcompany"){
			//txtport:txtport,txtsmtp:txtsmtp,txtusername:txtusername,txtpass:txtpass
			$txtport=@$_POST['txtport'];
			$txtsmtp=@$_POST['txtsmtp'];
			$txtusername=@$_POST['txtusername'];
			$txtpass=@$_POST['txtpass'];
			
			$txturl=@$_POST['txturl'];
			
			$txtemail=@$_POST['txtemail'];
			$txttel=@$_POST['txttel'];
			$txtaddress1=@$_POST['txtaddress1'];
			$txtaddress2=@$_POST['txtaddress2'];
			$txtaddress3=@$_POST['txtaddress3'];
			$imgdatax2=@$_POST['imgdatax2'];
			$logofilename=@$_POST['logofilename'];
			$sendmaila=@$_POST['sendmail'];
			$fname=strtoupper(uniqid()).$logofilename;
			$flname="../docs/".$fname;
			$rwt=base64_to_jpeg($imgdatax2, $flname);
			
			
			//txtport:txtport,txtsmtp:txtsmtp,txtusername:txtusername,txtpass:txtpass
			
			$qry="update tblcompany set appurl='$txturl', smtp='$txtsmtp',smtpusername='$txtusername',smtppassword='$txtpass',smtpport='$txtport', telephone='$txttel',address1='$txtaddress1',address2='$txtaddress2',address3='$txtaddress3',email='$txtemail', logostring='$fname',sendmail='$sendmaila' where id=$compid";
			$res=mysql_query($qry);
			echo "1";
			
		}
		
		//act: 'rejectagreement',lnid:lnid
		
		if($act=="rejectagreement"){
			///////////////////////
			$lnid=@$_POST['lnid'];
			$rs=mysql_query("update tblloans set signagreed='J' where id=$lnid");
			
			
			
			$rd=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lnid"));
		$empid=$rd['empid'];
		$loanid=$rd['loanid'];
		$duration=$rd['duration'];
		$lamount=$rd['amount'];
		$principal=$rd['principal'];
		$interest=$rd['interest'];
		$intrate=$rd['intrate'];
		$startdate=$rd['startdate'];
		$signagreed=$rd['startdate'];
				
			$loanname=returnQueryValue("select name from loantypes where id=$loanid","name");
			$createdby=returnQueryValue("select createdby from loantypes where id=$loanid","createdby");

		$rdlnd=mysql_fetch_assoc(mysql_query("select * from tblemployee where id=$empid"));
				$elname=$rdlnd['fullname'];
				$eltel=$rdlnd['telephone'];
				$elemail=$rdlnd['email'];
				$laddress=$rdlnd['address'];

					$empuserid=$createdby;
				
				
				
				
				$msg="$loanname Agreement Signed";
				$link="signagreement.php?id=".$lnid;
				$res2=mysql_query("insert into notifi (msg,link,ddate,tfrom,tto) value('$msg','$link','$dd',$curuserid,$empuserid)");
				
				
				///mail notification ////////////////////////////
				$txtfname=returnQueryValue("select fullname from tblusers where id=$empuserid","fullname");
				$email=returnQueryValue("select email from tblusers where id=$empuserid","email");
				
				$linkcrumb=uniqid();
				
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Please sign your Loan agreement</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/$link'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Sign Loan Agreement</button></a> </p>";
				
				//echo $pemail;
				$subject=$appname.": $loanname Agreement Signed";
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
				////end mail notfication.///////////////////
			
			
			
			echo "1";
		}
		
		if($act=="signagreementxxx"){
			
			$lnid=@$_POST['lnid'];
			$txtpinx=@$_POST['txtpinx'];
			
			$txtpinx=trim($txtpinx);
			
			$pexist=recNum("select * from tblpins where pin='$txtpinx' and lnid=$lnid and used='N'");
			if($pexist>0){
				
				$rs=mysql_query("update tblloans set signagreed='Y' where id=$lnid");
				$rs2=mysql_query("update tblpins set used='Y' where pin='$txtpinx'");
				echo "1";
				
			}else{
				echo "xxx";
			}
			
		}
		
			if($act=="addprorata"){
			
			$empid=@$_POST['empid'];
			
			$cbomonth=@$_POST['cbomonth'];
			$txtyear=@$_POST['txtyear'];
			$txtnodays=@$_POST['txtnodays'];
			
			
			
			$rnm=recNum("select * from tblprorate where empid=$empid and tmonth=$cbomonth and tyear=$txtyear");
			if($rnm>0){
				echo "exists";exit;
			}
			
			
			
			$qry="insert into tblprorate(tmonth,tyear,ndays,empid) values($cbomonth,$txtyear,$txtnodays,$empid)";
			$res=mysql_query($qry);
			echo "1";
			
		}
		
		
	if($act=="validate"){
			
			$pid=@$_POST['pid'];
			
			
			
			$rnm=recNum("select * from tblemployee where compid=$compid");
			if($rnm<1){
				echo "<b><font color='red'>Payroll parameters error</font></b><br>";
				echo "<b>** Employees records not available</b>";
				
				exit;
			}
			
			$rnm=recNum("select * from tblemployee where compid=$compid and active='Y'");
			if($rnm<1){
				echo "<b><font color='red'>Payroll parameters error</font></b><br>";
				echo "<b>** There is no active employee in this company</b>";
				
				exit;
			}
			
			$rnm=recNum("select * from  tblgrades where compid=$compid");
			if($rnm<1){
				echo "<b><font color='red'>Payroll parameters error</font></b><br>";
				echo "<b>** Grades levels not yet defined</b>";
				
				exit;
			}
			
			$rnm=recNum("select * from tblpayelement where compid=$compid and payroll=$pid");
			if($rnm<1){
				echo "<b><font color='red'>Payroll parameters error</font></b><br>";
				echo "<b>** Pay Element not defined for this payroll</b>";
				
				exit;
			}
			
			
			echo "Y";
			
		}
		
		
		
		if($act=="addpayroll"){
			$txtpayroll=@$_POST['txtpayroll'];
			$cbofrequency=@$_POST['cbofrequency'];
			$txtwef=@$_POST['txtwef'];
			
			$txtwef=date('Y-m-d', strtotime($txtwef));
			
			$rnm=recNum("select * from tblpayroll where compid=$compid and name='$txtpayroll'");
			if($rnm>0){
				echo "exists";exit;
			}
			
			$qry="insert into tblpayroll(compid,name,freq,rundate) values($compid,'$txtpayroll','$cbofrequency','$txtwef')";
			$res=mysql_query($qry);
			echo "1";
			
		}
		
			if($act=="editpayroll"){
				//pid:pid,cbostatus:cbostatus
			$txtpayroll=@$_POST['txtpayroll'];
			$cbofrequency=@$_POST['cbofrequency'];
			$txtwef=@$_POST['txtwef'];
			$pid=@$_POST['pid'];
			$cbostatus=@$_POST['cbostatus'];
			
			
			$txtwef=date('Y-m-d', strtotime($txtwef));
			
			
			
			$qry="update tblpayroll set name='$txtpayroll',freq='$cbofrequency',rundate='$txtwef',active='$cbostatus',modifiedby=$curuserid,modifieddate='$dd' where id=$pid";
			$res=mysql_query($qry);
			echo "1";
			
		}
		//txtemail:txtemail,txtpass:txtpass,txtpass2: txtpass2,act: 'activatelogin'
		
		if($act=="activatelogin"){
				$txtemail=@$_POST['txtemail'];
				$txtpass2=@$_POST['txtpass2'];
				$txtpass=@$_POST['txtpass'];
				$invid=@$_POST['invid'];
				
				$txtpass=sha1($txtpass);
				
				$rd=mysql_fetch_assoc(mysql_query("select * from tblinvites where id=$invid"));
				$active=$rd['active'];
				$email=$rd['email'];
				$fullname=$rd['fullname'];
				$telephone=$rd['telephone'];
				$role=$rd['role'];
				$compid=$rd['compid'];
				
				$resx=mysql_query("insert into tblusers(fullname,email,telephone,pword,compid,role) values ('$fullname','$email','$telephone','$txtpass',$compid,'member')");
				
				$res=mysql_query("update tblinvites set active='Y' where id=$invid");
				
				
				$imglogo=returnQueryValue("select logostring from tblcompany where id=$compid","logostring");
				$linkcrumb=uniqid();
				$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'><b>Welcome to $appname</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Your account is now active!</center> </p>";
					//echo $pemail;
				$subject="Welcome to ".$appname;
				$from="noreply@greenroll.com";
				if($smailparam=="Y"){
				$emret=sendmail($txtemail, $subject, $pemail, $from);
				}
				echo "1";
				
				
		}
		
		
			if($act=="userlogin"){
				$txtpass=@$_POST['txtpass'];
				$txtemail=@$_POST['txtemail'];
				
				$txtpass=sha1($txtpass);
				
				
				
				
				$rnm=recNum("select * from tblusers where email='$txtemail' and  pword='$txtpass'");
				if($rnm>0){
					
					$rd=mysql_fetch_assoc(mysql_query("select * from tblusers where email='$txtemail' and  pword='$txtpass'"));
					$ip_server = $_SERVER['SERVER_ADDR'];
					$compid=$rd['compid'];
					$email=$rd['email'];
					$pck=$compid."**--**".$email."**--**".$ip_server;
					$isactive=returnQueryValue("select active from tblusers where email='$txtemail'","active");
					if($isactive=="N"){
						echo "xxx2";exit;
					}
					$res=mysql_query("update tblusers set curmachine='$ip_server' where email='$txtemail' and  pword='$txtpass'");
					
					$bcs=base64_encode($pck);
					$sk=setcookie("sitepack", $bcs, time() + (86400 * 30), "/");
					
					echo "1";
					
				}
				else{
					echo "xxx";exit;
				}
				
				
				
		}
		//edituser
		
		if($act=="edituser"){
				$txtfname=@$_POST['txtfname'];
				$txtemail=@$_POST['txtemail'];
				$txttel=@$_POST['txttel'];
				
				$cborole=@$_POST['cborole'];
				$uid=@$_POST['uid'];
				
				
				$qry="update tblusers fullname='$txtfname',email='$txtemail',telephone='$txttel' where id=$uid";
				$res=mysql_query($qry);
				echo "1";
				
		}
		
			if($act=="addmember"){
				$txtfname=@$_POST['txtfname'];
				$txtemail=@$_POST['txtemail'];
				$txttel=@$_POST['txttel'];
				$txtpass1=@$_POST['txtpass1'];
				$txtpass1=sha1($txtpass1);
				$cborole=@$_POST['cborole'];
				
				
				
				
				$rnm=recNum("select * from tblusers where compid=$compid and (email='$txtemail' or telephone='$txttel')");
				if($rnm>0){
					echo "exists";exit;
				}
				
				$qry="insert into tblusers(compid,fullname,email,telephone,pword,role) values($compid,'$txtfname','$txtemail','$txttel','$txtpass1','$cborole')";
				$res=mysql_query($qry);
				echo "1";
				
		}
		///cbopayroll:cbopayroll,cboyear:cboyear,txtwef:txtwef,txtwet:txtwet,act: 'addupfront'
		
		
			if($act=="addupfront"){
				$cbopayroll=@$_POST['cbopayroll'];
				$cboyear=@$_POST['cboyear'];
				$txtwef=@$_POST['txtwef'];
				$txtwet=@$_POST['txtwet'];
				$txtwef=date('Y-m-d', strtotime($txtwef));
			$txtwet=date('Y-m-d', strtotime($txtwet));	
				
				
				
				$rnm=recNum("select * from tblupfront where wef='$txtwef' and wet='$txtwet' and compid=$compid and payid=$cbopayroll");
				if($rnm>0){
					echo "exists";exit;
				}
				
				$qry="insert into tblupfront(compid,wef,wet,tyear,createdby,payid) values($compid,'$txtwef','$txtwet',$cboyear,$curuserid,$cbopayroll)";
				$res=mysql_query($qry);
				echo "1";
				
		}
		
		//cbopayelement:cbopayelement,txtwef:txtwef,txtwet:txtwet,act: 'addupfrontitem'
		
			if($act=="addupfrontitem"){
				$cbopayelement=@$_POST['cbopayelement'];
				$txtwef=@$_POST['txtwef'];
				$txtwet=@$_POST['txtwet'];
				$grade=@$_POST['grade'];
				$upfrontid=@$_POST['upfrontid'];
				$txtwef=date('Y-m-d', strtotime($txtwef));
			$txtwet=date('Y-m-d', strtotime($txtwet));	
				
				
				
				$rnm=recNum("select * from tblupfrontitems where elementid=$cbopayelement and upfrontid=$upfrontid");
				if($rnm>0){
					echo "exists";exit;
				}
				
				$qry="insert into tblupfrontitems(elementid,upfrontid,wef,wet,gradeid) values($cbopayelement,$upfrontid,'$txtwef','$txtwet',$grade)";
				$res=mysql_query($qry);
				echo "1";
				
		}
		
		
		if($act=="requestapproval"){
				$cbouser=@$_POST['cbouser'];
				$logid=@$_POST['logid'];
				
				$qry="update tblrunlog set assignedto=$cbouser where id=$logid";
				$res=mysql_query($qry);
				$msg="Payroll Approval Request";
				$link="approvepayroll.php?logid=".$logid;
				$res2=mysql_query("insert into notifi (msg,link,ddate,tfrom,tto) value('$msg','$link','$dd',$curuserid,$cbouser)");
				$txtfname=returnQueryValue("select fullname from tblusers where id=$cbouser","fullname");
				$email=returnQueryValue("select email from tblusers where id=$cbouser","email");
				
				$linkcrumb=uniqid();
				
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>An Approval ticket has been assigned to you.</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/login.php?ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Login to $cname to Approve </button></a> </p>";
				
				//echo $pemail;
				$subject=$appname.": Payroll Approval Request";;
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
				echo "1";
				
		}
		
		
		
		
		
		if($act=="requestapprovalup"){
				$cbouser=@$_POST['cbouser'];
				$logid=@$_POST['logid'];
				
				$qry="update tblrunlogup set assignedto=$cbouser where id=$logid";
				$res=mysql_query($qry);
				$msg="Upfront Approval Request";
				$link="approvepayrollup.php?logid=".$logid;
				$res2=mysql_query("insert into notifi (msg,link,ddate,tfrom,tto) value('$msg','$link','$dd',$curuserid,$cbouser)");
				
				$txtfname=returnQueryValue("select fullname from tblusers where id=$cbouser","fullname");
				$email=returnQueryValue("select email from tblusers where id=$cbouser","email");
				
				$linkcrumb=uniqid();
				
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>An Approval ticket has been assigned to you.</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/login.php?ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Login to $cname to Approve </button></a> </p>";
				
				//echo $pemail;
				$subject=$appname.": Upfront Approval Request";
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
				
				
				echo "1";
				
		}
		
		
		if($act=="approverequest"){
				
				$logid=@$_POST['logid'];
				$rd=mysql_fetch_assoc(mysql_query("select * from tblrunlog where id=$logid"));
				$runby=$rd['runby'];
				$payroll=$rd['payroll'];
				
				$rundate=returnQueryValue("select rundate from tblpayroll where id=$payroll","rundate");
				
				$rundate = date('Y-m-d', strtotime("+1 months", strtotime($rundate)));
				
				$qry="update tblrunlog set approved='Y' where id=$logid";
				$res=mysql_query($qry);
				$msg="Payroll Approved!";
				$link="payrollviewer.php?logid=".$logid;
				$res2x=mysql_query("update tblpayroll set rundate='$rundate' where id=$payroll");
				
				$res2=mysql_query("insert into notifi (msg,link,ddate,tfrom,tto) value('$msg','$link','$dd',$curuserid,$runby)");
				///mail notification ////////////////////////////
				$txtfname=returnQueryValue("select fullname from tblusers where id=$runby","fullname");
				$email=returnQueryValue("select email from tblusers where id=$runby","email");
				
				$linkcrumb=uniqid();
				
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Payroll Approval request completed.</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/login.php?ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Login to $cname to view status</button></a> </p>";
				
				//echo $pemail;
				$subject=$appname.": Payroll Approved!";
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
				////end mail notfication.///////////////////
				
				$qryc="select * from tblemployee where compid=$compid";
				$resc=mysql_query($qryc);
				$nmc=mysql_num_rows($resc);
				if($nmc>0){
					$rdc=mysql_fetch_assoc($resc);
					do{
						
						$empid=$rdc['id'];
						$loanexist=returnQueryValue("select id from tblloans where empid=$empid and approved='Y'","id");
						if($loanexist==""){
						
						}
						else{
							
							$lnschedule=returnQueryValue("select min(id) minid from tblloanshedule where loanid=$loanexist and paid='N'","minid");
						if($lnschedule==""){
							
						}else{
							//$cursched=mysql_fetch_assoc(mysql_query("select * from tblloanshedule where id=$lnschedule"));
							$upsch=mysql_query("update tblloanshedule set paid='Y' where id=$lnschedule");
						}
						
							
						}
						
						
						
					}
					while($rdc=mysql_fetch_assoc($resc));
				}
				
				echo "1";
				
		}
		
			if($act=="approverequestup"){
				
				$logid=@$_POST['logid'];
				$rd=mysql_fetch_assoc(mysql_query("select * from tblrunlogup where id=$logid"));
				$runby=$rd['runby'];
				
				$qry="update tblrunlogup set approved='Y' where id=$logid";
				$res=mysql_query($qry);
				$msg="Upfront Approved!";
				$link="payrollviewerup.php?logid=".$logid;
				$res2=mysql_query("insert into notifi (msg,link,ddate,tfrom,tto) value('$msg','$link','$dd',$curuserid,$runby)");
				
				///mail notification ////////////////////////////
				$txtfname=returnQueryValue("select fullname from tblusers where id=$runby","fullname");
				$email=returnQueryValue("select email from tblusers where id=$runby","email");
				
				$linkcrumb=uniqid();
				
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Upfront Approval request completed.</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/login.php?ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Login to $cname to view status</button></a> </p>";
				
				//echo $pemail;
				$subject=$appname.": Upfront Approved!";
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
				////end mail notfication.///////////////////
				
				echo "1";
				
		}
		
		////act: 'approveloan',lnid:lnid
		
		if($act=="approveloan"){
				$lnid=@$_POST['lnid'];
				$rd=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lnid"));
				$empid=$rd['empid'];
				$parentloan=$rd['parentloan'];
				$email=returnQueryValue("select email from tblemployee where id=$empid","email");
				$usid=returnQueryValue("select id from tblusers where email='$email'","id");
				if($parentloan>0){
					$resen=mysql_query("update tblloanshedule set paid='Y' where loanid=$parentloan");
				}
				
					$qry="update tblloans set approved='Y' where id=$lnid";
				$res=mysql_query($qry);
				$msg="Loan Approved!";
				$link="signagreement.php?id=".$lnid;
				$res2=mysql_query("insert into notifi (msg,link,ddate,tfrom,tto) value('$msg','$link','$dd',$curuserid,$usid)");
				
				///mail notification ////////////////////////////
				$txtfname=returnQueryValue("select fullname from tblusers where id=$usid","fullname");
				$email=returnQueryValue("select email from tblusers where id=$usid","email");
				
				$linkcrumb=uniqid();
				
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Congrats! Your Loan has been approved</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/login.php?ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Login to $cname to view status</button></a> </p>";
				
				//echo $pemail;
				$subject=$appname.": Loan Approved!";
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
				////end mail notfication.///////////////////
				
				
				echo "1";

		
		}
		//schedid:schedid,act: 'markloanpayment'
		
		if($act=="markloanpayment"){
				$schedid=@$_POST['schedid'];
				
				$res2=mysql_query("update tblloanshedule set paid='Y' where id=$schedid");
				echo "1";

		
		}
		
		
			if($act=="sendagreement"){
				$lnid=@$_POST['lnid'];
				$rd=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lnid"));
		$empid=$rd['empid'];
		$loanid=$rd['loanid'];
		$duration=$rd['duration'];
		$lamount=$rd['amount'];
		$principal=$rd['principal'];
		$interest=$rd['interest'];
		$intrate=$rd['intrate'];
		$startdate=$rd['startdate'];
		$signagreed=$rd['startdate'];
				
			$loanname=returnQueryValue("select name from loantypes where id=$loanid","name");

		$rdlnd=mysql_fetch_assoc(mysql_query("select * from tblemployee where id=$empid"));
				$elname=$rdlnd['fullname'];
				$eltel=$rdlnd['telephone'];
				$elemail=$rdlnd['email'];
				$laddress=$rdlnd['address'];

					$empuserid=returnQueryValue("select id from tblusers where email='$elemail'","id");
				
				
				$qry="update tblloans set signagreed='R' where id=$lnid";
				$res=mysql_query($qry);
				$msg="Sign $loanname Agreement";
				$link="signagreement.php?id=".$lnid;
				$res2=mysql_query("insert into notifi (msg,link,ddate,tfrom,tto) value('$msg','$link','$dd',$curuserid,$empuserid)");
				
				
				///mail notification ////////////////////////////
				$txtfname=returnQueryValue("select fullname from tblusers where id=$empuserid","fullname");
				$email=returnQueryValue("select email from tblusers where id=$empuserid","email");
				
				$linkcrumb=uniqid();
				
			$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $txtfname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Please sign your Loan agreement</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/$link'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Sign Loan Agreement</button></a> </p>";
				
				//echo $pemail;
				$subject=$appname.": Sign $loanname Agreement";
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
				////end mail notfication.///////////////////
				
				
				
				echo "1";
				
		}
		
		//act: 'approverequest',logid:logid
		
		//txtfname:txtfname,txtemail:txtemail,act: 'addinvite',txttel: txttel,cborole:cborole
		
		if($act=="addinvite"){
				$txtfname=@$_POST['txtfname'];
				$txtemail=@$_POST['txtemail'];
				$txttel=@$_POST['txttel'];
				
				$cborole=@$_POST['cborole'];
				
				
				
				
				$rnm=recNum("select * from tblinvites where compid=$compid and (email='$txtemail' or telephone='$txttel')");
				if($rnm>0){
					echo "exists";exit;
				}
				
				$rnm2=recNum("select * from tblusers where compid=$compid and (email='$txtemail' or telephone='$txttel')");
				if($rnm2>0){
					echo "exists";exit;
				}
				
				$qry="insert into tblinvites(compid,fullname,email,telephone,role,inviter,active) values($compid,'$txtfname','$txtemail','$txttel','$cborole',$curuserid,'N')";
				
				$res=mysql_query($qry);
				$invid=mysql_insert_id();
				$cname=returnQueryValue("select name from tblcompany where id=$compid","name");
				$imglogo=returnQueryValue("select logostring from tblcompany where id=$compid","logostring");
				
				//$applink
				$linkcrumb=uniqid();
				$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'><b>Your team is waiting for you to join them</b></font></center></p>";
				$pemail.="<p><center><font size='3'>$cname has invited you to collaborate on $appname as a prefered Business tool!</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/join.php?invid=$invid&ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Join $cname </button></a> </p>";
				$pemail.="<p><center><a href='$applink"."app/join.php?invid=$invid&ssid=$linkcrumb'>Click here to activate your account</a> </p>";
				$pemail.="<p><center>Or copy and paste the following link into your browser<br><a href='$applink"."app/join.php?invid=$invid&ssid=$linkcrumb'>$applink"."app/join.php?invid=$invid&ssid=$linkcrumb"."</a> </p>";
				//echo $pemail;
				$subject="$cname has invited you to join them on ".$appname;
				$from="noreply@greenroll.com";
				if($smailparam=="Y"){
				$emret=sendmail($txtemail, $subject, $pemail, $from);
				}
				echo "1";
				
				
		}
		if($act=="gethour"){
			$tpBasic=@$_POST['tpBasic'];
			$tp2=@$_POST['tp2'];
					$datetime1 = new DateTime($tpBasic);
			$datetime2 = new DateTime($tp2);
			$interval = $datetime1->diff($datetime2);
			echo $interval->format('%h');

		}
		
		//tpBasic:tpBasic,act: 'savetime', tp2:tp2,txttotal:txttotal,txtdate: txtdate
		
		if($act=="savetime"){
			$tpBasic=@$_POST['tpBasic'];
			$tp2=@$_POST['tp2'];
			$txttotal=@$_POST['txttotal'];
			$txtdate=@$_POST['txtdate'];
			$empid=@$_POST['empid'];
			
			$txtdate=date('Y-m-d', strtotime($txtdate)); 
			
			$rnm=recNum("select * from timecard where empid=$empid and ddate='$txtdate' and tfrom='$tpBasic' and tto='$tp2'");
				if($rnm>0){
					echo "exists";exit;
				}
				 
				$qry="insert into timecard(empid,ddate,tfrom,tto,tothour,createddate) values($empid,'$txtdate','$tpBasic','$tp2',$txttotal,'$dd')";
				$res=mysql_query($qry);
				echo "1";

		}
		
		if($act=="getalltime"){
			$txtdate=@$_POST['txtdate'];
			$empid=@$_POST['empid'];
			$txtdate=date('Y-m-d', strtotime($txtdate)); 
			$qry="select * from timecard where empid=$empid";
			$res=mysql_query($qry);
			$rnm=mysql_num_rows($res);
			if($rnm>0){
				$rd=mysql_fetch_assoc($res);
				$ip=1;
				echo '<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" ><thead>
													<tr>
														<th>S/N</th>
														<th>Day</th>
														<th>Start Time</th>
														<th>End Time</th>
														<th>Hours Worked</th>
														
														
														
														
														<th></th>	</tr>
												</thead><tbody>';
			do{
				echo "<tr>";
				
				echo "<td>$ip</td>";
				$tfrom=$rd['tfrom'];
				$tto=$rd['tto'];
				$tothour=$rd['tothour'];
				$ddate=$rd['ddate'];
				echo "<td>$ddate</td>";
				echo "<td>$tfrom</td>";
				echo "<td>$tto</td>";
				echo "<td>$tothour</td>";
				echo "<td>
															<a href='deletetime.php?id=$empid'><button class='btn btn-sm btn-red'>Delete <i class='fa fa-trash'></i></button> </a>
														</td>";
				echo "</tr>";
				
			}while ($rd=mysql_fetch_assoc($res));
				echo "</tbody></table>";
			}else{
				echo "No record found";
			}
			
		
		}
		
		
		
		
		
		if($act=="addloantype"){
				$txttype=@$_POST['txttype'];
				$txtduration=@$_POST['txtduration'];
				$txtinterest=@$_POST['txtinterest'];
				$txtmax=@$_POST['txtmax'];
				
				$rnm=recNum("select * from loantypes where compid=$compid and name='$txttype'");
				if($rnm>0){
					echo "exists";exit;
				}
				
				$qry="insert into loantypes(name,duration,intrate,compid,createdby,ddate,maxamount) values('$txttype',$txtduration,$txtinterest,$compid,$curuserid,'$dd',$txtmax)";
				$res=mysql_query($qry);
				echo "1";
				
				
		}
		
		if($act=="loadchat"){
			$lnid=@$_POST['lnid'];
			$qrs="select * from loanchat where loanid=$lnid";
																		$rs=mysql_query($qrs);
																		$nms=mysql_num_rows($rs);
																		if($nms>0){
																			$rds=mysql_fetch_assoc($rs);
																			do{
																				$tto=$rds['tto'];
																				$tfrom=$rds['tfrom'];
																				$ddate=$rds['ddate'];
																				$msg=stripslashes($rds['msg']);
																				
																				$sfrom=returnQueryValue("select fullname from tblusers where id=$tfrom","fullname");
																				$sto=returnQueryValue("select fullname from tblusers where id=$tto","fullname");
																				if($curuserid==$tfrom){
																					echo "<div style='background: rgb(237, 240, 245);padding: 12px 22px;font-size: 0.905rem;display: inline-block;
																					padding: 9px 9px 6px;border-radius: 20px;border-top-right-radius: 0px;
																					margin-bottom: 5px;float: right;clear: both;max-width: 65%;word-wrap: break-word;border:1px solid #009900'><font style='font-size:11px;'><b>$sfrom</b></font><br>".$msg."<br><font style='font-size:9px;'>$ddate</font></div>";
																				}else{
																						echo "<div style='background: rgb(237, 240, 245);padding: 12px 22px;font-size: 0.905rem;
																						display: inline-block;padding: 9px 9px 6px;border-radius: 20px;
																						border-top-left-radius:0px;margin-bottom: 5px;float: left;clear: both;max-width: 65%;word-wrap: break-word;border:1px solid #009900'><font style='font-size:11px;'><b>$sfrom</b></font><br>".$msg."<br><font style='font-size:9px;'>$ddate</font></div>";
																				}
																				
																			}
																			while($rds=mysql_fetch_assoc($rs));
																		}
		}
		
		if($act=="savechat"){
			$todaysdate=date("Y-m-d h:i:s A");
			$txtmsg=addslashes(@$_POST['txtmsg']);
			$loanowner=@$_POST['loanowner'];
			$lnid=@$_POST['lnid'];
			$lngetter=@$_POST['lngetter'];
			$whois=returnQueryValue("select role from tblusers where id=$curuserid","role");
			if($lngetter==$curuserid){
			$res=mysql_query("insert into loanchat(loanid,msg,tfrom,tto,ddate) value($lnid,'$txtmsg',$curuserid,$loanowner,'$todaysdate')");
			}else{
				$res=mysql_query("insert into loanchat(loanid,msg,tfrom,tto,ddate) value($lnid,'$txtmsg',$curuserid,$lngetter,'$todaysdate')");
			}
			echo "1";
			
		}
		//txtmsg:txtmsg,act: 'savechat', loanowner: loanowner
		
		//txttype:txttype,act: 'editloantype',txtduration: txtduration,txtinterest: txtinterest,ltid: ltid
		
		if($act=="editloantype"){
			//txttype:txttype,act: 'editloantype',txtduration: txtduration,txtinterest: txtinterest,ltid: ltid,txtadvert: txtadvert, txtmax:txtmax
			
				$txttype=@$_POST['txttype'];
				$txtduration=@$_POST['txtduration'];
				$txtinterest=@$_POST['txtinterest'];
				$txtmax=@$_POST['txtmax'];
				$txtadvert=@$_POST['txtadvert'];
				$txtadvert=addslashes($txtadvert);
				$ltid=@$_POST['ltid'];
				$advloan=@$_POST['advloan'];
				$pgateway=@$_POST['pgateway'];
				
				$qry="update loantypes set paymentgateway='$pgateway', name='$txttype',duration=$txtduration,intrate=$txtinterest,maxamount=$txtmax, conditions='$txtadvert',advertise='$advloan' where id=$ltid";
				//echo $qry;exit;
				$res=mysql_query($qry);
				echo "1";
				
				
		}
		
		if($act=="getloantypedetails"){
				$cboloantype=@$_POST['cboloantype'];
				$rd=mysql_fetch_assoc(mysql_query("select * from  loantypes where id=$cboloantype"));
				$duration=$rd['duration'];
				$intrate=$rd['intrate'];
				
				echo $duration."|".$intrate;
				
				//echo "1";
				
				
		}
		
		//rpid:rpid,act: 'loanrepaid'
		
		if($act=="loanrepaid"){
				$rpid=@$_POST['rpid'];
				$compido=@$_POST['compido'];
				
				$rdr=mysql_fetch_assoc(mysql_query("select * from tblloanshedule where id=$rpid"));
				$duedate=$rdr['paymentdate'];
				$instamount=$rdr['instamount'];
				
				$res=mysql_query("update tblloanshedule set paid='Y' where id=$rpid");
				
				$res2=mysql_query("insert into paymentlog(owner,amount,ddate,creditdebit,source) values($compido,$instamount,'$dd','C',$compido)");
				echo "1";
				
		}
		
		if($act=="calcloan"){
				$tenor=@$_POST['tenor'];
				$intrate=@$_POST['intrate'];
				$principal=@$_POST['principal'];
				
				$capital=$_POST['principal']; 
				$txtstartdate=$_POST['txtstartdate']; 
				
				
$interest=$intrate; 
$year=$tenor/12; 
$instalment=$_POST['insttype']; 


//Calculate time in months. 
$months=$tenor; 

//Check out which is the instalment. 
if (strcmp($instalment,"Fixed")==0) 
//Fixed amortization schedule 
{ 
//Calculate fixed payment for month. 
    $fixedPayment=$capital / $months; 
    $interestRateForMonth=$interest / 12; 

//Calculate interest for every month. 
 echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
 echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));  
$totinterest=0; 
   for ($i=0;$i<$months;$i++) 
    { 
//$txtstartdate=$_POST['txtstartdate']; 
	
//Interest for the month. 
        $interestForMonth=$capital / 100 * $interestRateForMonth; 
//Diminish capital after calculating interest. 
        $totinterest+=$interestForMonth;
//Print out payment for this month. Output is formatted (payment has two digits) 
        $month=$i+1; 
        //printf("$month payment is %.2f<br>", $paymentForMonth); 
		echo "<tr>";
		echo "<td>".$ddate."</td>";
		echo "<td>".number_format($capital,2)."</td>";
		$capital=$capital - $fixedPayment; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$fixedPayment + $interestForMonth; 
		echo "<td>".number_format($paymentForMonth,2)."</td>";
		echo "<td>".number_format($interestForMonth,2)."</td>";
		echo "<td>".number_format($capital,2)."</td>";
		echo "</tr>";
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
    }  
echo "</tbody></table>";	
echo "Total Interest: <b>".number_format($totinterest,2)."<b>";
} 
//Annuity 
else 
{ 
echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
 echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));
    $interest=$interest / 100; 
	$fxcapital=$capital;
	$totinterest=0;
	$si=1;
	for ($i=0;$i<$months;$i++) 
    { 
    $result=$interest / 12 * pow(1 + $interest / 12,$months) / (pow(1 + $interest / 12,$months) - 1) * $fxcapital; 
	//printf("Monthly pay is %.2f", $result); 
	$intvalue=$interest/$months*$capital;
	echo "<tr>";
		echo "<td>".$ddate."</td>";
		echo "<td>".number_format($fxcapital,2)."</td>";
		$capital=$capital - $result; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$result; 
		echo "<td>".number_format($result,2)."</td>";
		echo "<td>".number_format($intvalue,2)."</td>";
		
		if($si==$months){
			$totinterest=$capital* -1;
			echo "<td>0</td>";
		}else{
			echo "<td>".number_format($capital,2)."</td>";
		}
		echo "</tr>";
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		$si+=1;
		
	}
	
	echo "</tbody></table><br>";
	echo "Total Interest: <b>".number_format($totinterest,2)."</b>";
    
    
		}}
				
//////////////////////////////////////
	
				
				
				if($act=="saveloanself"){
		//txtacountname:txtacountname,txtaccno:txtaccno,txtbank:txtbank
				$tenor=@$_POST['tenor'];
				$intrate=@$_POST['intrate'];
				$principal=@$_POST['principal'];
				$sdate="1900-01-01";
				$enddate="2080-01-01";
				$capital=$_POST['principal']; 
				$txtstartdate=$_POST['txtstartdate']; 
				$sdate=date('Y-m-d', strtotime($txtstartdate));
				$cboemployee=@$_POST['cboemployee'];
				$cboloantype=@$_POST['cboloantype'];
				$instalment=$_POST['insttype']; 
				$txtacountname=$_POST['txtacountname'];
				$txtaccno=$_POST['txtaccno'];
				$txtbank=$_POST['txtbank'];
			
				$empgrade=returnQueryValue("select grade from tblemployee where id=$cboemployee","grade");
				//echo "select grade from tblusers where id=$cboemployee";exit;
				//echo $empgrade;exit;
				$pelementid=returnQueryValue("select id from tblpayelement where grade=$empgrade and crita='LND' and compid=$compid","id");
				if($pelementid==""){
					//echo "here";exit;
					$rqr="insert into tblpayelement(payelement,amount,crita,wef,wet,payroll,grade,pct,creditdebit,compid) value('Loan Repayment',0,'LND','$sdate','$enddate',0,$empgrade,0,'D',$compid)";
					//echo $rqr;exit;
					$res=mysql_query($rqr);
					$pelementid=mysql_insert_id();
				}
				
				$maxid=returnQueryValue("select max(id)maxid from tblloans where compid=$compid","maxid");
				$maxid+=1;
				$loanno="GNRL/".$compid."/".str_pad($maxid, 5, "0", STR_PAD_LEFT);
				//echo $pelementid;exit;
				$qrloan="Insert into tblloans (loanid,empid,duration,intrate,principal,amount,ddate,startdate,compid,instalment
				,createtype,loanno,insttype,createdby,bank,accno,accountname) values($cboloantype,$cboemployee,$tenor,$intrate,$principal,0,'$dd','$sdate',$compid,
				0,'A','$loanno','$instalment',$curuserid,'$txtbank','$txtaccno','$txtacountname')";
				
				$res2=mysql_query($qrloan);
					$lnid=mysql_insert_id();
				
				$interest=$intrate; 
				$year=$tenor/12; 
				




//Calculate time in months. 
$months=$tenor; 

//Check out which is the instalment. 
if (strcmp($instalment,"Fixed")==0) 
//Fixed amortization schedule 
{ 
//Calculate fixed payment for month. 
    $fixedPayment=$capital / $months; 
    $interestRateForMonth=$interest / 12; 

//Calculate interest for every month. 
// echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
//echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));  
$totinterest=0; 
$lqry="";
   for ($i=0;$i<$months;$i++) 
    { 
//$txtstartdate=$_POST['txtstartdate']; 
	$tyear=date('Y', strtotime($ddate));
	$tmnt=date('m', strtotime($ddate));
	$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
//Interest for the month. 
        $interestForMonth=$capital / 100 * $interestRateForMonth; 
//Diminish capital after calculating interest. 
        $totinterest+=$interestForMonth;
//Print out payment for this month. Output is formatted (payment has two digits) 
        $month=$i+1; 
        //printf("$month payment is %.2f<br>", $paymentForMonth); 
		//echo "<tr>";
		//echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital,";
		$capital=$capital - $fixedPayment; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$fixedPayment + $interestForMonth; 
		//echo "<td>".number_format($paymentForMonth,2)."</td>";
		$lqry.="$paymentForMonth,";
		//echo "<td>".number_format($interestForMonth,2)."</td>";
		$lqry.="$interestForMonth,";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital)";
	//	echo "</tr>";
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		//echo $lqry;
		$ressch=mysql_query($lqry);
    }  
	
//echo "</tbody></table>";	
//echo "Total Interest: <b>".number_format($totinterest,2)."<b>";
$totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
echo "1";
} 
//Annuity 
else 
{ 
//echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
 //echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));
    $interest=$interest / 100; 
	$fxcapital=$capital;
	$totinterest=0;
	$si=1;
	for ($i=0;$i<$months;$i++) 
    { 
$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
    $result=$interest / 12 * pow(1 + $interest / 12,$months) / (pow(1 + $interest / 12,$months) - 1) * $fxcapital; 
	//printf("Monthly pay is %.2f", $result); 
	$intvalue=$interest/$months*$capital;
	//echo "<tr>";
	//	echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
	//	echo "<td>".number_format($fxcapital,2)."</td>";
		$lqry.="$fxcapital,";
		$capital=$capital - $result; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$result; 
		//echo "<td>".number_format($result,2)."</td>";
		$lqry.="$result,";
		//echo "<td>".number_format($intvalue,2)."</td>";
		$lqry.="$intvalue,";
		if($si==$months){
			$totinterest=$capital* -1;
		//	echo "<td>0</td>";
			$lqry.="0)";
		}else{
		//	echo "<td>".number_format($capital,2)."</td>";
			$lqry.="$capital)";
		}
		//echo "</tr>";
		//echo $lqry;exit;
		$ressch=mysql_query($lqry);
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		
		$si+=1;
		
	}
	
	//echo "</tbody></table><br>";
	//echo "Total Interest: <b>".number_format($totinterest,2)."</b>";
    $totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
  echo "1";  
}
		}
//cboloantype:cboloantype,cboemployee:cboemployee,tenor:tenor,intrate:intrate,principal:principal,act: 'saveloan',insttype:insttype,txtstartdate:txtstartdate	
//lid:lid,cboloantype:cboloantype,cboemployee:cboemployee,tenor:tenor,intrate:intrate,principal:principal,act: 'toploanup',insttype:insttype,txtstartdate:txtstartdate


if($act=="toploanup"){
		//txtacountname:txtacountname,txtaccno:txtaccno,txtbank:txtbank
				$tenor=@$_POST['tenor'];
				$intrate=@$_POST['intrate'];
				$principal=@$_POST['principal'];
				$sdate="1900-01-01";
				$enddate="2080-01-01";
				$capital=$_POST['principal']; 
				$txtstartdate=$_POST['txtstartdate']; 
				$sdate=date('Y-m-d', strtotime($txtstartdate));
				$cboemployee=@$_POST['cboemployee'];
				$cboloantype=@$_POST['cboloantype'];
				$instalment=$_POST['insttype']; 
				$lid=$_POST['lid']; 
				
			
				$empgrade=returnQueryValue("select grade from tblemployee where id=$cboemployee","grade");
				//echo "select grade from tblusers where id=$cboemployee";exit;
				//echo $empgrade;exit;
				$pelementid=returnQueryValue("select id from tblpayelement where grade=$empgrade and crita='LND' and compid=$compid","id");
				if($pelementid==""){
					//echo "here";exit;
					$rqr="insert into tblpayelement(payelement,amount,crita,wef,wet,payroll,grade,pct,creditdebit,compid) value('Loan Repayment',0,'LND','$sdate','$enddate',0,$empgrade,0,'D',$compid)";
					//echo $rqr;exit;
					$res=mysql_query($rqr);
					$pelementid=mysql_insert_id();
				}
				
				$maxid=returnQueryValue("select max(id)maxid from tblloans where compid=$compid","maxid");
				$maxid+=1;
				$loanno="GNRL/".$compid."/".str_pad($maxid, 5, "0", STR_PAD_LEFT);
				//echo $pelementid;exit;
				$qrloan="Insert into tblloans (loanid,empid,duration,intrate,principal,amount,approvedby,ddate,startdate,compid,instalment,
				approved,createtype,loanno,insttype,createdby,parentloan,topup) values($cboloantype,$cboemployee,$tenor,$intrate,$principal,0,$curuserid,'$dd','$sdate',$compid,
				0,'Y','A','$loanno','$instalment',$curuserid,$lid,'Y')";
				
				$res2=mysql_query($qrloan);
					$lnid=$lid;
					$res2=mysql_query($qrloan);
					$lnid=mysql_insert_id();
					//$reinitialize=mysql_query("delete from tblloanshedule where loanid=$lnid");
				
				$interest=$intrate; 
				$year=$tenor/12; 
				




//Calculate time in months. 
$months=$tenor; 

//Check out which is the instalment. 
if (strcmp($instalment,"Fixed")==0) 
//Fixed amortization schedule 
{ 
//Calculate fixed payment for month. 
    $fixedPayment=$capital / $months; 
    $interestRateForMonth=$interest / 12; 

//Calculate interest for every month. 
// echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
//echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));  
$totinterest=0; 
$lqry="";
   for ($i=0;$i<$months;$i++) 
    { 
//$txtstartdate=$_POST['txtstartdate']; 
	$tyear=date('Y', strtotime($ddate));
	$tmnt=date('m', strtotime($ddate));
	$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
//Interest for the month. 
        $interestForMonth=$capital / 100 * $interestRateForMonth; 
//Diminish capital after calculating interest. 
        $totinterest+=$interestForMonth;
//Print out payment for this month. Output is formatted (payment has two digits) 
        $month=$i+1; 
        //printf("$month payment is %.2f<br>", $paymentForMonth); 
		//echo "<tr>";
		//echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital,";
		$capital=$capital - $fixedPayment; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$fixedPayment + $interestForMonth; 
		//echo "<td>".number_format($paymentForMonth,2)."</td>";
		$lqry.="$paymentForMonth,";
		//echo "<td>".number_format($interestForMonth,2)."</td>";
		$lqry.="$interestForMonth,";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital)";
	//	echo "</tr>";
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		//echo $lqry;
		$ressch=mysql_query($lqry);
    }  
	
//echo "</tbody></table>";	
//echo "Total Interest: <b>".number_format($totinterest,2)."<b>";
$totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
echo "1";
} 
//Annuity 
else 
{ 
//echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
 //echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));
    $interest=$interest / 100; 
	$fxcapital=$capital;
	$totinterest=0;
	$si=1;
	for ($i=0;$i<$months;$i++) 
    { 
$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
    $result=$interest / 12 * pow(1 + $interest / 12,$months) / (pow(1 + $interest / 12,$months) - 1) * $fxcapital; 
	//printf("Monthly pay is %.2f", $result); 
	$intvalue=$interest/$months*$capital;
	//echo "<tr>";
	//	echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
	//	echo "<td>".number_format($fxcapital,2)."</td>";
		$lqry.="$fxcapital,";
		$capital=$capital - $result; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$result; 
		//echo "<td>".number_format($result,2)."</td>";
		$lqry.="$result,";
		//echo "<td>".number_format($intvalue,2)."</td>";
		$lqry.="$intvalue,";
		if($si==$months){
			$totinterest=$capital* -1;
		//	echo "<td>0</td>";
			$lqry.="0)";
		}else{
		//	echo "<td>".number_format($capital,2)."</td>";
			$lqry.="$capital)";
		}
		//echo "</tr>";
		//echo $lqry;exit;
		$ressch=mysql_query($lqry);
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		
		$si+=1;
		
	}
	
	//echo "</tbody></table><br>";
	//echo "Total Interest: <b>".number_format($totinterest,2)."</b>";
    $totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
  echo "1";  
}
		}




if($act=="editsaveloan"){
		//txtacountname:txtacountname,txtaccno:txtaccno,txtbank:txtbank
				$tenor=@$_POST['tenor'];
				$intrate=@$_POST['intrate'];
				$principal=@$_POST['principal'];
				$sdate="1900-01-01";
				$enddate="2080-01-01";
				$capital=$_POST['principal']; 
				$txtstartdate=$_POST['txtstartdate']; 
				$sdate=date('Y-m-d', strtotime($txtstartdate));
				$cboemployee=@$_POST['cboemployee'];
				$cboloantype=@$_POST['cboloantype'];
				$instalment=$_POST['insttype']; 
				$lid=$_POST['lid']; 
				
			
				$empgrade=returnQueryValue("select grade from tblemployee where id=$cboemployee","grade");
				//echo "select grade from tblusers where id=$cboemployee";exit;
				//echo $empgrade;exit;
				$pelementid=returnQueryValue("select id from tblpayelement where grade=$empgrade and crita='LND' and compid=$compid","id");
				if($pelementid==""){
					//echo "here";exit;
					$rqr="insert into tblpayelement(payelement,amount,crita,wef,wet,payroll,grade,pct,creditdebit,compid) value('Loan Repayment',0,'LND','$sdate','$enddate',0,$empgrade,0,'D',$compid)";
					//echo $rqr;exit;
					$res=mysql_query($rqr);
					$pelementid=mysql_insert_id();
				}
				
				$maxid=returnQueryValue("select max(id)maxid from tblloans where compid=$compid","maxid");
				$maxid+=1;
				$loanno="GNRL/".$compid."/".str_pad($maxid, 5, "0", STR_PAD_LEFT);
				//echo $pelementid;exit;
				$qrloan="update tblloans set duration=$tenor,intrate=$intrate,principal=$principal,insttype='$instalment' where id=$lid";
				
				$res2=mysql_query($qrloan);
					$lnid=$lid;
					
					$reinitialize=mysql_query("delete from tblloanshedule where loanid=$lnid");
				
				$interest=$intrate; 
				$year=$tenor/12; 
				




//Calculate time in months. 
$months=$tenor; 

//Check out which is the instalment. 
if (strcmp($instalment,"Fixed")==0) 
//Fixed amortization schedule 
{ 
//Calculate fixed payment for month. 
    $fixedPayment=$capital / $months; 
    $interestRateForMonth=$interest / 12; 

//Calculate interest for every month. 
// echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
//echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));  
$totinterest=0; 
$lqry="";
   for ($i=0;$i<$months;$i++) 
    { 
//$txtstartdate=$_POST['txtstartdate']; 
	$tyear=date('Y', strtotime($ddate));
	$tmnt=date('m', strtotime($ddate));
	$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
//Interest for the month. 
        $interestForMonth=$capital / 100 * $interestRateForMonth; 
//Diminish capital after calculating interest. 
        $totinterest+=$interestForMonth;
//Print out payment for this month. Output is formatted (payment has two digits) 
        $month=$i+1; 
        //printf("$month payment is %.2f<br>", $paymentForMonth); 
		//echo "<tr>";
		//echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital,";
		$capital=$capital - $fixedPayment; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$fixedPayment + $interestForMonth; 
		//echo "<td>".number_format($paymentForMonth,2)."</td>";
		$lqry.="$paymentForMonth,";
		//echo "<td>".number_format($interestForMonth,2)."</td>";
		$lqry.="$interestForMonth,";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital)";
	//	echo "</tr>";
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		//echo $lqry;
		$ressch=mysql_query($lqry);
    }  
	
//echo "</tbody></table>";	
//echo "Total Interest: <b>".number_format($totinterest,2)."<b>";
$totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
echo "1";
} 
//Annuity 
else 
{ 
//echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
 //echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));
    $interest=$interest / 100; 
	$fxcapital=$capital;
	$totinterest=0;
	$si=1;
	for ($i=0;$i<$months;$i++) 
    { 
$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
    $result=$interest / 12 * pow(1 + $interest / 12,$months) / (pow(1 + $interest / 12,$months) - 1) * $fxcapital; 
	//printf("Monthly pay is %.2f", $result); 
	$intvalue=$interest/$months*$capital;
	//echo "<tr>";
	//	echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
	//	echo "<td>".number_format($fxcapital,2)."</td>";
		$lqry.="$fxcapital,";
		$capital=$capital - $result; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$result; 
		//echo "<td>".number_format($result,2)."</td>";
		$lqry.="$result,";
		//echo "<td>".number_format($intvalue,2)."</td>";
		$lqry.="$intvalue,";
		if($si==$months){
			$totinterest=$capital* -1;
		//	echo "<td>0</td>";
			$lqry.="0)";
		}else{
		//	echo "<td>".number_format($capital,2)."</td>";
			$lqry.="$capital)";
		}
		//echo "</tr>";
		//echo $lqry;exit;
		$ressch=mysql_query($lqry);
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		
		$si+=1;
		
	}
	
	//echo "</tbody></table><br>";
	//echo "Total Interest: <b>".number_format($totinterest,2)."</b>";
    $totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
  echo "1";  
}
		}
		

		if($act=="saveloan"){
		//txtacountname:txtacountname,txtaccno:txtaccno,txtbank:txtbank
				$tenor=@$_POST['tenor'];
				$intrate=@$_POST['intrate'];
				$principal=@$_POST['principal'];
				$sdate="1900-01-01";
				$enddate="2080-01-01";
				$capital=$_POST['principal']; 
				$txtstartdate=$_POST['txtstartdate']; 
				$sdate=date('Y-m-d', strtotime($txtstartdate));
				$cboemployee=@$_POST['cboemployee'];
				$cboloantype=@$_POST['cboloantype'];
				$instalment=$_POST['insttype']; 
				
			
				$empgrade=returnQueryValue("select grade from tblemployee where id=$cboemployee","grade");
				//echo "select grade from tblusers where id=$cboemployee";exit;
				//echo $empgrade;exit;
				$pelementid=returnQueryValue("select id from tblpayelement where grade=$empgrade and crita='LND' and compid=$compid","id");
				if($pelementid==""){
					//echo "here";exit;
					$rqr="insert into tblpayelement(payelement,amount,crita,wef,wet,payroll,grade,pct,creditdebit,compid) value('Loan Repayment',0,'LND','$sdate','$enddate',0,$empgrade,0,'D',$compid)";
					//echo $rqr;exit;
					$res=mysql_query($rqr);
					$pelementid=mysql_insert_id();
				}
				
				$maxid=returnQueryValue("select max(id)maxid from tblloans where compid=$compid","maxid");
				$maxid+=1;
				$loanno="GNRL/".$compid."/".str_pad($maxid, 5, "0", STR_PAD_LEFT);
				//echo $pelementid;exit;
				$qrloan="Insert into tblloans (loanid,empid,duration,intrate,principal,amount,approvedby,ddate,startdate,compid,instalment,
				approved,createtype,loanno,insttype,createdby) values($cboloantype,$cboemployee,$tenor,$intrate,$principal,0,$curuserid,'$dd','$sdate',$compid,
				0,'Y','A','$loanno','$instalment',$curuserid)";
				
				$res2=mysql_query($qrloan);
					$lnid=mysql_insert_id();
				
				$interest=$intrate; 
				$year=$tenor/12; 
				




//Calculate time in months. 
$months=$tenor; 

//Check out which is the instalment. 
if (strcmp($instalment,"Fixed")==0) 
//Fixed amortization schedule 
{ 
//Calculate fixed payment for month. 
    $fixedPayment=$capital / $months; 
    $interestRateForMonth=$interest / 12; 

//Calculate interest for every month. 
// echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
//echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));  
$totinterest=0; 
$lqry="";
   for ($i=0;$i<$months;$i++) 
    { 
//$txtstartdate=$_POST['txtstartdate']; 
	$tyear=date('Y', strtotime($ddate));
	$tmnt=date('m', strtotime($ddate));
	$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
//Interest for the month. 
        $interestForMonth=$capital / 100 * $interestRateForMonth; 
//Diminish capital after calculating interest. 
        $totinterest+=$interestForMonth;
//Print out payment for this month. Output is formatted (payment has two digits) 
        $month=$i+1; 
        //printf("$month payment is %.2f<br>", $paymentForMonth); 
		//echo "<tr>";
		//echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital,";
		$capital=$capital - $fixedPayment; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$fixedPayment + $interestForMonth; 
		//echo "<td>".number_format($paymentForMonth,2)."</td>";
		$lqry.="$paymentForMonth,";
		//echo "<td>".number_format($interestForMonth,2)."</td>";
		$lqry.="$interestForMonth,";
		//echo "<td>".number_format($capital,2)."</td>";
		$lqry.="$capital)";
	//	echo "</tr>";
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		//echo $lqry;
		$ressch=mysql_query($lqry);
    }  
	
//echo "</tbody></table>";	
//echo "Total Interest: <b>".number_format($totinterest,2)."<b>";
$totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
echo "1";
} 
//Annuity 
else 
{ 
//echo "<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" ><thead>";
 //echo "<th>Payment Date</th><th>Beginning Balance</th><th>Instalment Amount</th><th>Interest</th><th>Ending Balance</th><tbody>";
$ddate=date('Y-m-d', strtotime($txtstartdate));
    $interest=$interest / 100; 
	$fxcapital=$capital;
	$totinterest=0;
	$si=1;
	for ($i=0;$i<$months;$i++) 
    { 
$lqry="insert into tblloanshedule(loanid,paymentdate,begbalance,instamount,interest,endbalance) values($lnid,";
    $result=$interest / 12 * pow(1 + $interest / 12,$months) / (pow(1 + $interest / 12,$months) - 1) * $fxcapital; 
	//printf("Monthly pay is %.2f", $result); 
	$intvalue=$interest/$months*$capital;
	//echo "<tr>";
	//	echo "<td>".$ddate."</td>";
		$lqry.="'$ddate',";
	//	echo "<td>".number_format($fxcapital,2)."</td>";
		$lqry.="$fxcapital,";
		$capital=$capital - $result; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$result; 
		//echo "<td>".number_format($result,2)."</td>";
		$lqry.="$result,";
		//echo "<td>".number_format($intvalue,2)."</td>";
		$lqry.="$intvalue,";
		if($si==$months){
			$totinterest=$capital* -1;
		//	echo "<td>0</td>";
			$lqry.="0)";
		}else{
		//	echo "<td>".number_format($capital,2)."</td>";
			$lqry.="$capital)";
		}
		//echo "</tr>";
		//echo $lqry;exit;
		$ressch=mysql_query($lqry);
		$ddate = date('Y-m-d', strtotime("+1 months", strtotime($ddate)));
		
		$si+=1;
		
	}
	
	//echo "</tbody></table><br>";
	//echo "Total Interest: <b>".number_format($totinterest,2)."</b>";
    $totamt=$totinterest+$principal;
$resop=mysql_query("update tblloans set amount=$totamt,interest=$totinterest where id=$lnid");
  echo "1";  
}
		}
		

//////////////////////////////////
				
				
		
		
		if($act=="acceptinvite"){
				$eid=@$_POST['eid'];
				$exampleInputPassword1=@$_POST['exampleInputPassword1'];
				$txtfname=@$_POST['txtfname'];
				$rd=mysql_fetch_assoc(mysql_query("select * from tblinvites where id=$eid"));
				$tel=$rd['telephone'];
				$email=$rd['email'];
				$compid=$rd['compid'];
				$role=$rd['role'];
				$txtpass1=sha1($exampleInputPassword1);
				
			$qry="insert into tblusers(compid,fullname,email,telephone,pword,role) values($compid,'$txtfname','$email','$tel','$txtpass1','$role')";
				$res=mysql_query($qry);
				
				$res2=mysql_query("update tblinvites set active='N' where id=$eid");
				echo "1";
				
				
		}
			
		
		
function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
   file_put_contents($output_file, file_get_contents($base64_string));
   return 1;
}


?>