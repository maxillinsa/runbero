<?php 

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

$target_dir = "loandoc/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

	


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$target_file=md5(uniqid(rand(), true)).".".$imageFileType;
//echo $target_file;exit;
$txtlid=@$_GET['lnid'];
//echo $imageFileType;exit;
if($imageFileType=='rar'||$imageFileType=='zip'||$imageFileType=='xlsx'||$imageFileType=='pdf'||$imageFileType=='xls'||$imageFileType=='png'||$imageFileType=='jpg'||$imageFileType=='jpeg'||$imageFileType=='doc'||$imageFileType=='docx'||$imageFileType=='csv'){
	
}
else{
	 echo "<span style='color:red;font-size:20px;'>Document type not supported!</span><br><a href='loandoc.php?id=$txtlid'>Click here to continue</a>";
	 exit;
}


$txtpurpose=@$_POST['txtpurpose'];




if(isset($_POST["submit"])) {
    
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$target_file)) {
		
		
			
		$res=mysql_query("insert into loandoc (loanid,filname,ddate,purpose,createdby) values($txtlid,'$target_file','$dd','$txtpurpose',$curuserid)");
		
		header("location:loandoc.php?id=$txtlid");
		
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
    } else {
       echo "<span style='color:red;font-size:20px;'>Document Upload failed</span><br><a href='loandoc.php?id=$txtlid'>Click here to continue</a>";
    }
	
}

?>