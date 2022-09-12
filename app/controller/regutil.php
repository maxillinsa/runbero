<?php 
	include("func.php");
	$dd = date('Y-m-d');
	$act=@$_POST['act'];
	if($act=="registerbusiness"){
	$futureDate=date('Y-m-d', strtotime('+1 year'));
	//echo $futureDate;exit;
	
	//cboplan:cboplan,exampleInputPassword1:exampleInputPassword1,txtaddress:txtaddress,txtemail:txtemail,txtcname:txtcname,txtcompany:txtcompany,act: 'registerbusiness'
	$cboplan=@$_POST['cboplan'];
	//echo $cboplan;exit;
	$exampleInputPassword1=@$_POST['exampleInputPassword1'];
	$txtaddress=stripslashes(@$_POST['txtaddress']);
	$txtemail=@$_POST['txtemail'];
	$txtcname=@$_POST['txtcname'];
	$txtcompany=@$_POST['txtcompany'];
	$txttelephone=@$_POST['txttelephone'];

	$nm=recNum("select * from tblcompany email='$txtemail' or name='$txtcname'");
	if($nm>0){
		echo "xxx";exit;
	}
	$qry="";
	$nmember=returnQueryValue("select nmember from tblplans where id=$cboplan","nmember");
	if($cboplan=="1"){
		$futureDate=date('Y-m-d', strtotime('+3 months'));
		$qry="insert into tblcompany(name,email,telephone, address1,planid,wef,wet,nmember) values('$txtcompany','$txtemail','$txttelephone','$txtaddress',$cboplan,'$dd','$futureDate',$nmember)";
	}
	else{
		$qry="insert into tblcompany(name,email,telephone, address1) values('$txtcompany','$txtemail','$txttelephone','$txtaddress')";
	}
	
	//$qry="insert into tblcompany(name,email,telephone, address1,planid,wef,wet,nmember) values('$txtcompany','$txtemail','$txttelephone','$txtaddress',$cboplan,'$dd','$futureDate',$nmember)";
	//echo $qry;exit;
	$res=mysql_query($qry);
	$compid=mysql_insert_id();
	
	$pword=sha1($exampleInputPassword1);
	$userrec=mysql_query("insert into tblusers(fullname,email,telephone,pword,compid,role,confirmemail) values('$txtcname','$txtemail','$txttelephone','$pword',$compid,'admin','N')");
	$usid=mysql_insert_id();
	$linkcrumb=uniqid();
				$pemail="Dear $txtcname,<br>";
				$pemail.="<p><center><font size='3'><b>Welcome to Runbero</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Your Business account has been created successfully</center> </p>";
				$pemail.="<p><center><a href='https://runbero.com/"."app/activateaccount.php?ssid=$usid&ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Please Confirm your email </button></a> </p>";
				
				//echo $pemail;
				$subject="Welcome to Runbero";
				$from="noreply@runbero.com";
				
				$emret=@sendmail($txtemail, $subject, $pemail, $from);
				
				if($cboplan=="1"){
						echo "1";
				}else{
					echo "1x";
				}
				}
				
if($act=="upgrade2"){
			
			$cboplan=@$_POST['cboplan'];
			$cname=@$_POST['cname'];
			$compidx=returnQueryValue("select id from tblcompany where name='$cname'","id");
			$ifreq=@$_POST['ifreq'];
			if($ifreq=="mnt"){
				$futureDate=date('Y-m-d', strtotime('+1 months'));
			}else{
				$futureDate=date('Y-m-d', strtotime('+1 year'));
			}
			$mntprice=returnQueryValue("select mnt from tblplans where id=$cboplan","mnt");
			$res2=mysql_query("insert into paymentlog(amount,ddate,creditdebit,source) values($mntprice,'$dd','C',$compidx)");
			//if no owner, then it belongs to me
			
			
			$yrprice=returnQueryValue("select tyear from tblplans where id=$cboplan","tyear");
			$nmember=returnQueryValue("select nmember from tblplans where id=$cboplan","nmember");
			//echo "update tblcompany set planid=$cboplan,nmember=$nmember, wef='$dd',wet='$futureDate' where compid=$compid";
			$res=mysql_query("update tblcompany set planid=$cboplan,nmember=$nmember, wef='$dd',wet='$futureDate' where id=$compidx");
		echo "1";
		
		}
		//exampleInputPassword1:exampleInputPassword1,act: 'activateacount',ssid:ssid
		
		if($act=="activateacount"){
			
			$exampleInputPassword1=@$_POST['exampleInputPassword1'];
			$ssid=@$_POST['ssid'];
			$pword=sha1($exampleInputPassword1);
			
			$res=mysql_query("update tblusers set pword='$pword',confirmemail='Y' where id=$ssid");
		echo "1";
			
		}
		
		if($act=="getplanprice"){
			
			$cboplan=@$_POST['cboplan'];
			if($cboplan==""){
				echo "&nbsp;";exit;
			}
			
			$planname=returnQueryValue("select description from tblplans where id=$cboplan","description");
			$mntprice=returnQueryValue("select mnt from tblplans where id=$cboplan","mnt");
			$yrprice=returnQueryValue("select tyear from tblplans where id=$cboplan","tyear");
			
			echo "<center><span style='font-size:18px;'>Activate <b>$planname</b> Plan</span><br><br><a href=\"javascript:payWithPaystack('$cboplan','$mntprice','mnt');\" ><button class=\"btn btn-primary\">"."<i class=\"fa fa-credit-card\"></i> Pay Monthly rate of ".number_format($mntprice)."</button></a><br><br>";
			echo "<a href=\"javascript:payWithPaystack('$cboplan','$yrprice','yr');\" ><button class=\"btn btn-primary\">"."<i class=\"fa fa-credit-card\"></i> Pay Annual rate of ".number_format($yrprice)."</button></a><br><br></center>";
			
		}

?>