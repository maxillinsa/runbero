<?php 

$upiditm=@$_GET['id'];

$upid=@$_GET['upid'];

$grade=@$_GET['grade'];

if(empty($upiditm)){
	header("location: index.php");
	exit;
}

if(empty($upid)){
	header("location: index.php");
	exit;
}

if(empty($grade)){
	header("location: index.php");
	exit;
}


include("controller/func.php");

$res=mysql_query("delete from tblupfrontitems where id=$upiditm");

$ret="upfrontitems.php?id=".$upid."&grade=".$grade;

header("location: ".$ret);

?>