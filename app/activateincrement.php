<?php 
$incid=@$_GET['id'];
		if(empty($incid)){
			header("location: index.php");exit;
		}


$dd = date('Y-m-d');
include("controller/func.php"); 
			$sitepack=@$_COOKIE['sitepack'];
$dec=@base64_decode($sitepack);
	
	
	$spt=explode("**--**",$dec);
	
	$compid=@$spt[0];
	$email=@$spt[1];
	$curaddress=@$spt[2];
	
	//$ip_server = $_SERVER['SERVER_ADDR'];


$curuserid=returnQueryValue("select id from tblusers where email='$email'","id");

$rd=mysql_fetch_assoc(mysql_query("select * from salaryincrement where id=$incid"));
$status=$rd['status'];
if($status=="Y"){
	$status="N";
}
else{
	$status="Y";
}

$res=mysql_query("update salaryincrement set status='$status' where id=$incid");
header("location: salaryincrement.php");


?>