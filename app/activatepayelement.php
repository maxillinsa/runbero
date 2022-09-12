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

$rd=mysql_fetch_assoc(mysql_query("select * from tblpayelement where id=$incid"));
$active=$rd['active'];
if($active=="Y"){
	$active="N";
}
else{
	$active="Y";
}

$res=mysql_query("update tblpayelement set active='$active' where id=$incid");
header("location: payelement.php");


?>