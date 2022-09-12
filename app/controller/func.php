<?php 
$skey = "thisisthepartwheregbegestart"; // you can change it
      //setcookie("bas65Ght", "");
	  //include("Encryption.php");
	//  echo getMonthNameFromNum(3);
	$current_month_num=date("m");
	$current_month_fullname=date("F");
	$current_day_num=date("d");
	$current_year=date("Y");
	
	//echo sha1("hello");
	
	  	include("safe_html.php");
	include("mycon.php");

require 'PHPMailer-master/PHPMailerAutoload.php';

	
	


	
	function recNum($sql){
		
		$res=@mysql_query($sql);
		
		$nm=@mysql_num_rows($res);
		//var_dump($nm);
		return $nm;
	}
	
	function executeStatement($sql){
		
		$res=mysql_query($sql);
		
		return $res;
	}
	
	function returnQueryValue($sql,$fld){
		
		$res=@mysql_query($sql);
		$nm=@mysql_fetch_assoc($res);
		return $nm[$fld];
	}
	

	
	
	

function sendSMS($tel,$msg){
	
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{ \"from\":\"InfoSMS\", \"to\":\"$tel\", \"text\":\"$msg\" }",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "Error #:" . $err;
} else {
  return $response;
}
	
}
	
	function sendmail($to, $subject, $message, $from) {
	$headers = "MIME-Version: 1.0" . "\r\n";
	


$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = returnQueryValue("select smtp from tblcompany where id=1","smtp");
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = returnQueryValue("select smtpport from tblcompany where id=1","smtpport");
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = returnQueryValue("select smtpusername from tblcompany where id=1","smtpusername");
//Password to use for SMTP authentication
$mail->Password = returnQueryValue("select smtppassword from tblcompany where id=1","smtppassword");
//Set who the message is to be sent from
$mail->setFrom($from, 'Alerts');
//Set an alternative reply-to address
$mail->addReplyTo($from, 'Do not');
//Set who the message is to be sent to
$mail->addAddress($to, 'Everyone');
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($message);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    return "Mailer Error: " . $mail->ErrorInfo;
} else {
    return "Message sent!";
}

}

function getMonthNameFromNum($num){
	
	switch ($num) {
    case 1:
        return "January";
        break;
    case 2:
        return "February";
        break;
    case 3:
        return "March";
        break;
		
	 case 4:
        return "April";
        break;
	  case 5:
        return "May";
        break;
	 case 6:
        return "June";
        break;
		
	  case 7:
        return "July";
        break;
		
	  case 8:
        return "August";
        break;
		
	  case 9:
        return "September";
        break;
		
	case 10:
        return "October";
        break;

		  case 11:
        return "November";
        break;
		
		  case 12:
        return "December";
        break;
		
    default:
        return "January";
	}
	
}

function getMonthNoFromName($mntName){
	$mnt=strtolower($mntName);
	switch ($mnt) {
    case "january":
        return 1;
        break;
    case "february":
        return 2;
        break;
    case "march":
        return 3;
        break;
		
	 case "april":
        return 4;
        break;
	  case "may":
        return 5;
        break;
	 case "june":
        return 6;
        break;
		
	  case "july":
        return 7;
        break;
		
	  case "august":
        return 8;
        break;
		
	  case "september":
        return 9;
        break;
		
	case "october":
        return 10;
        break;

		  case "november":
        return 11;
        break;
		
		  case "december":
        return 12;
        break;
		
    default:
        return 1;
	}
}

function getLastDayOfAMonth($ddate){
	
	$a_date =$ddate;
return date("t", strtotime($a_date));
}

function getappid(){
	return strtoupper(uniqid());
}

function computeElementLN($empidid){
	$loanexist=returnQueryValue("select id from tblloans where empid=$empidid and approved='Y'","id");
	if($loanexist==""){
		return 0;
		exit;
	}
	
	$lnschedule=returnQueryValue("select min(id) minid from tblloanshedule where loanid=$loanexist and paid='N'","minid");
	if($lnschedule==""){
		return 0;
		exit;
	}
	$cursched=mysql_fetch_assoc(mysql_query("select * from tblloanshedule where id=$lnschedule"));
	$curSchamt=$cursched['instamount'];
	return $curSchamt;
	
}

function computeElement($payelementid){
	
	$eleqry="select * from tblpayelement where id=$payelementid";
	//echo $eleqry;
	$eleres=mysql_query($eleqry);
	$elerd=mysql_fetch_assoc($eleres);
	$crite=$elerd['crita'];	
	if($crite=="USEAMT"){
		return ecomputeAmount($payelementid);
		exit;
	}
	
	if($crite=="PCT"){
		//echo $payelementid."xxx".ecomputePercentage($payelementid)."--<br>";
		return ecomputePercentage($payelementid);
		exit;
	}
	
	if($crite=="EQL"){
		return ecomputeEQL($payelementid);
		exit;
	}
	
	if($crite=="MLTP"){
		return ecomputeMLTP($payelementid);
		exit;
	}
	
	if($crite=="TAXA"){
		return ecomputePercentage($payelementid);
		exit;
	}
	
	if($crite=="PENS"){
		return ecomputePercentage($payelementid);
		exit;
	}
	
									
	
}

function ecomputeAmount($payelementid){
	$eleqry="select * from tblpayelement where id=$payelementid";
	$eleres=mysql_query($eleqry);
	$elerd=mysql_fetch_assoc($eleres);
	$amount=$elerd['amount'];
	return $amount;
	
}

function ecomputePercentage($payelementid){
	
	$eleqry="select * from tblpayelement where id=$payelementid";
	//echo $eleqry."<br>";
	$eleres=mysql_query($eleqry);
	$elerd=mysql_fetch_assoc($eleres);
	$depependon=$elerd['dependson'];
	$grade=$elerd['grade'];
	$pct=$elerd['pct'];
	$amnt=0;
	if($depependon=="BASIC"){
		//echo $eleqry."<br>";
		$amnt=returnQueryValue("select basicpay from tblgrades where id=$grade","basicpay");
		//echo $amnt."--".$pct."<br>";
	}
	else{
		
		$amnt=computeElement($depependon);
		
	}
	
	return $amnt * $pct/100;
	
}

function ecomputeEQL($payelementid){
	
	$eleqry="select * from tblpayelement where id=$payelementid";
	$eleres=mysql_query($eleqry);
	$elerd=mysql_fetch_assoc($eleres);
	$depependon=$elerd['dependson'];
	$amnt=computeElement($depependon);
	return $amnt;
	
}

function ecomputeMLTP($payelementid){
	$eleqry="select * from tblpayelement where id=$payelementid";
	$eleres=mysql_query($eleqry);
	$elerd=mysql_fetch_assoc($eleres);
	$depependon=$elerd['dependson'];
	$pct=$elerd['pct'];
	$amnt=computeElement($depependon);
	return $amnt * $pct;
}

function getPayItemNarration($payelementid){
	
	$eleqry="select * from tblpayelement where id=$payelementid";
	$eleres=mysql_query($eleqry);
	$elerd=mysql_fetch_assoc($eleres);
	$depependon=$elerd['dependson'];
	$pct=$elerd['pct'];
	
	$crita=$elerd['crita'];
												$parentpayelement="";
												$dependson=$elerd['dependson'];
												if($dependson=="BASIC"){
													$parentpayelement="Basic Pay";
												}else{
													$parentpayelement=returnQueryValue("select payelement from tblpayelement where id=$dependson","payelement");
												}
											
												if($crita=="USEAMT"){													
													$crita=" Amount Specified";
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
												
												if($crita=="LND"){													
													$crita="= Loan Schedule";
												}
												
												if($crita=="PENS"){													
													$crita="= Pension";
												}
												
													$fnalcrite=$crita." - ".$parentpayelement."";
													
													return $fnalcrite;
}

function savePayElementLog($pelementid,$logid,$creditdebit,$tday,$tmonth,$tyear,$empid,$amnt,$starget,$narration,$globalo,$payitemname){
	$dd = date('Y-m-d');
	$res=mysql_query("delete from tblrunlogitems where logid=$logid and pelementid='$pelementid' and empid=$empid");
	$qry="insert into tblrunlogitems(logid,tday,tmonth,tyear,pelementid,creditdebit,empid,transdate,amount,starget,paynarration,globalo,payitemname)
	values ($logid,$tday,$tmonth,$tyear,'$pelementid','$creditdebit',$empid,'$dd',$amnt,'$starget','$narration','$globalo','$payitemname')";
//	echo $qry;
	$res2=mysql_query($qry);
	
	return "1";
}


function savePayElementLogup($pelementid,$logid,$creditdebit,$tday,$tmonth,$tyear,$empid,$amnt,$starget,$narration,$globalo,$payitemname){
	$dd = date('Y-m-d');
	$res=mysql_query("delete from tblrunlogitemsup where logid=$logid and pelementid='$pelementid' and empid=$empid");
	$qry="insert into tblrunlogitemsup(logid,tday,tmonth,tyear,pelementid,creditdebit,empid,transdate,amount,starget,paynarration,globalo,payitemname)
	values ($logid,$tday,$tmonth,$tyear,'$pelementid','$creditdebit',$empid,'$dd',$amnt,'$starget','$narration','$globalo','$payitemname')";
	$res2=mysql_query($qry);
	
	return "1";
}

function saveFile($logid,$tday,$tmonth,$tyear,$empid,$pfilename,$compid,$doctype,$filedetail){
	
	$res=mysql_query("delete from tbldocs where empid=$empid and logid=$logid and tmonth=$tmonth and tyear=$tyear and doctype='$doctype'");
	
	$res2=mysql_query("insert into tbldocs(empid,logid,tmonth,tyear,pfilename,tday,compid,doctype,filedetail) values($empid,$logid,$tmonth,$tyear,'$pfilename',$tday,$compid,'$doctype','$filedetail')");
	return "1";
}

function getUpFront($amt,$eleid,$pid,$empgrade){
	$dd = date('Y-m-d');
	//echo "select * from tblupfrontitems where '$dd' between wef and wet and elementid=$eleid and gradeid=$empgrade";
	$rnum=mysql_num_rows(mysql_query("select * from tblupfrontitems where '$dd' between wef and wet and elementid=$eleid and gradeid=$empgrade"));
	if($rnum>0){
		return 0;
	}else{
		return $amt;
	}
}

function proratepay($empid,$amt,$tmonth,$tyear){
	
	$rnm=recNum("select * from tblprorate where empid=$empid and tmonth=$tmonth and tyear=$tyear");
			if($rnm>0){
				$rd=mysql_fetch_assoc(mysql_query("select * from tblprorate where empid=$empid and tmonth=$tmonth and tyear=$tyear"));
				$nodays=$rd['ndays'];
				$daysinmonth=cal_days_in_month(CAL_GREGORIAN,$tmonth,$tyear);
				
				$amto=$amt*$nodays/$daysinmonth;
				return $amto;
			}else{
				return $amt;
			}
			
	
}

function getEmployeeCredit($empid,$mnt,$yr,$payid){
	$qry= "select sum(amount)amt from tblrunlogitems,tblrunlog where tblrunlogitems.empid=$empid and tblrunlogitems.tmonth=$mnt and tblrunlogitems.tyear=$yr and tblrunlog.id=tblrunlogitems.logid and tblrunlog.payroll=$payid and creditdebit='C'";
	//echo $qry;
	$totcredit=returnQueryValue($qry,"amt");
	
	if($totcredit==""){
		return 0;
	}else{
	return	$totcredit;
	}
}

function getEmployeeCreditup($empid,$mnt,$yr,$payid){
	$qry= "select sum(amount)amt from tblrunlogitemsup,tblrunlogup where tblrunlogitemsup.empid=$empid and tblrunlogitemsup.tyear=$yr and tblrunlogup.id=tblrunlogitemsup.logid and tblrunlogup.payroll=$payid and creditdebit='C'";
	//echo $qry;
	$totcredit=returnQueryValue($qry,"amt");
	
	if($totcredit==""){
		return 0;
	}else{
	return	$totcredit;
	}
}

function getEmployeeDebit($empid,$mnt,$yr,$payid){
	//echo "select sum(amount)amt from tblrunlogitems,tblrunlog where tblrunlogitems.tmonth=$mnt and tblrunlogitems.tyear=$yr and tblrunlog.id=tblrunlogitems.logid and tblrunlog.payroll=$payid and creditdebit='C'";
	$totcredit=returnQueryValue("select sum(amount)amt from tblrunlogitems,tblrunlog where tblrunlogitems.empid=$empid and tblrunlogitems.tmonth=$mnt and tblrunlogitems.tyear=$yr and tblrunlog.id=tblrunlogitems.logid and tblrunlog.payroll=$payid and creditdebit='D'","amt");
	if($totcredit==""){
		return 0;
	}else{
		return $totcredit;
	}
}

function getPayElementAmtup($pelementid,$mnt,$yr,$payid){
	$qry= "select sum(amount)amt from tblrunlogitemsup,tblrunlogup where tblrunlogitemsup.pelementid='$pelementid' and tblrunlogitemsup.tyear=$yr and tblrunlogup.id=tblrunlogitemsup.logid and tblrunlogup.payroll=$payid";
	//echo $qry;
	$totcredit=returnQueryValue($qry,"amt");
	
	if($totcredit==""){
		return 0;
	}else{
	return	$totcredit;
	}
}

function getEmployeeDebitup($empid,$mnt,$yr,$payid){
	//echo "select sum(amount)amt from tblrunlogitems,tblrunlog where tblrunlogitems.tmonth=$mnt and tblrunlogitems.tyear=$yr and tblrunlog.id=tblrunlogitems.logid and tblrunlog.payroll=$payid and creditdebit='C'";
	$totcredit=returnQueryValue("select sum(amount)amt from tblrunlogitemsup,tblrunlogup where tblrunlogitemsup.empid=$empid and tblrunlogitemsup.tyear=$yr and tblrunlogup.id=tblrunlogitemsup.logid and tblrunlogup.payroll=$payid and creditdebit='D'","amt");
	if($totcredit==""){
		return 0;
	}else{
		return $totcredit;
	}
}

function getPayElementAmt($pelementid,$mnt,$yr,$payid){
	$qry= "select sum(amount)amt from tblrunlogitems,tblrunlog where tblrunlogitems.pelementid='$pelementid' and tblrunlogitems.tmonth=$mnt and tblrunlogitems.tyear=$yr and tblrunlog.id=tblrunlogitems.logid and tblrunlog.payroll=$payid";
	//echo $qry;
	$totcredit=returnQueryValue($qry,"amt");
	
	if($totcredit==""){
		return 0;
	}else{
	return	$totcredit;
	}
}

function prorateupfront($upid,$grade,$amt,$elementid){
	//echo $amt."-----";
	//echo "select * from tblupfrontitems where upfrontid=$upid and elementid=$elementid and gradeid=$grade<br>";
	$rd=mysql_fetch_assoc(mysql_query("select * from tblupfrontitems where upfrontid=$upid and elementid=$elementid and gradeid=$grade"));
	$wef=$rd['wef'];
	$wet=$rd['wet'];
	
	$diff = abs(strtotime($wet) - strtotime($wef));

	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	//echo $months."mmmmm";
	$amtfinal=$months * $amt;
	
	
//	echo $amtfinal;
	return $amtfinal;
			
	
}

function getIncrease($grade){
	
	$maxid=returnQueryValue("select max(id)maxid from salaryincrement where grade=$grade and status='Y'","maxid");
	if($maxid==""){
		return 0;
	}
	
	$incr=returnQueryValue("select pcent from salaryincrement where id=$maxid","pcent");
	return $incr;
}


function encrypt($data, $password) {

return base64_encode ($data);
} 

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}

function getremainingmembers($compid){
	$dd = date('Y-m-d');
//	echo "select nmember from  tblcompany where '$dd' between wef and wet and id=$compid";
	$nm=returnQueryValue("select nmember from  tblcompany where '$dd' between wef and wet and id=$compid","nmember");
	$wef=returnQueryValue("select wef from  tblcompany where '$dd' between wef and wet and id=$compid","wef");
	$wet=returnQueryValue("select wet from  tblcompany where '$dd' between wef and wet and id=$compid","wet");
	if($nm==""){
		return 0;
		exit;
	}else{
		$remain=(int) $nm;
		$rnm=recNum("select * from tblemployee where compid=$compid and datecreated between '$wef' and '$wet'");
		$tremain=$remain-$rnm;
		return $tremain;
	}
}





?>