<?php
$target_dir = "tmpupload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$txtfile=md5(uniqid(rand(), true));
	include("controller/func.php");
if($txtfile==""){
	$txtfile="somefile";
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$target_file=md5(uniqid(rand(), true)).".".$imageFileType;
//echo $target_file;exit;
$appid=@$_GET['appid'];
$userid=@$_GET['userid'];



if(isset($_POST["submit"])) {
    
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$target_file)) {
		//echo "insert into tblfile(rid,filename,description) values($id,'$target_file','$txtfile')";exit;
        //$res=mysql_query("insert into tblfile(rid,filename,description) values($id,'$target_file','$txtfile')");
		header("location:processupload.php?fname=".$target_file."&op=view");
		
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
    } else {
       header("location: uploadstaff.php");
    }
	
}
?>