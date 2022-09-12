<?php 
$sitepack=@$_COOKIE['sitepack'];
$dec=base64_decode($sitepack);
	
	include("controller/func.php");
	$spt=explode("**--**",$dec);
	
	$compid=$spt[0];
	$email=$spt[1];
	$curaddress=$spt[2];
	
	
	//echo $sitepack;exit;
	//echo "update tblusers set curmachine='' where email='$email'";exit;
	$res=mysql_query("update tblusers set curmachine='' where email='$email'");
	
	unset($_COOKIE['sitepack']); 
    setcookie('sitepack', null, -1, '/'); 
	
	header("location: login.php");
	

?>