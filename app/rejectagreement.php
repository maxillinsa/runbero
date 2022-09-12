<?php 
$lid=@$_GET['id'];
if(empty($lid)){
			header("location: index.php");
			exit;
		}
		
			include("controller/func.php"); 
			$sitepack=@$_COOKIE['sitepack'];
$dec=@base64_decode($sitepack);
	
	
	$spt=explode("**--**",$dec);
	
	$compid=@$spt[0];
	$email=@$spt[1];
	$curaddress=@$spt[2];
	
	//$ip_server = $_SERVER['SERVER_ADDR'];


$curuserid=returnQueryValue("select id from tblusers where email='$email'","id");

//echo "update tblloans set approved='J' where where id=$lid";exit;

$res=mysql_query("update tblloans set signagreed='J' where id=$lid");

header("location: myloans.php?id=".$lid);


?>