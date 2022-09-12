<?php 
//echo sha1("123456");
include("controller/mycon.php");
$invid=@$_GET['invid'];
if(empty($invid)){
	header("location: ../index.php");
	exit;
}
$rd=mysql_fetch_assoc(mysql_query("select * from tblinvites where id=$invid"));
$active=$rd['active'];
$email=$rd['email'];

if($active=="Y"){
	
	echo "<p><center><font size='3' color:red;><b>Your account is already active.</b></font><br><a href='login.php'>Click here to Login</a></center></p>";
	exit;
	
}

?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="msapplication-TileColor" content="#0f75ff">
	<meta name="theme-color" content="#9d37f6">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- Title -->
	<title>Join</title>
	<link rel="stylesheet" href="../assets/fonts/fonts/font-awesome.min.css">

	<!-- Bootstrap Css -->
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Sidemenu Css -->
	<link href="../assets/plugins/toggle-sidebar/sidemenu.css" rel="stylesheet" />


	<!-- Dashboard css -->
	<link href="../assets/css/style.css" rel="stylesheet" />
	<link href="../assets/css/admin-custom.css" rel="stylesheet" />

	<!-- c3.js Charts Plugin -->
	<link href="../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

	<!---Font icons-->
	<link href="../assets/css/icons.css" rel="stylesheet"/>

	<!-- SWITCHER -->
	<link  href="../assets/switcher/css/switcher.css" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>

	<!-- COLOR-SKINS -->
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/webslidemenu/color-skins/color1.css" />
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/css/apprise.css" />

	</head>
	<body class="construction-image">


		<!--Loader-->
		<div id="global-loader">
			<img src="../assets/images/other/loader.gif" class="loader-img " alt="">
		</div>

		<!--Page-->
		<div class="page ">
			<div class="page-content z-index-10">
				<div class="container">
					<div class="row">
						<div class="col-xl-4 col-md-12 col-md-12 d-block mx-auto">
							<div class="card mb-0" id="divresponse">
							<center><img src="../assets/images/brand/logo.png" style="width:200px;height:64px;"></center><br><br>
								<div class="card-header">
								
								
									<h3 class="card-title"><br>Please activate your account</h3>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label class="form-label text-dark">Email address</label>
										<input type="email" class="form-control" id="txtemail" disabled value="<?php echo $email ?>" placeholder="Enter email">
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Password</label>
										<input type="password" class="form-control" id="txtpass" placeholder="Password">
									</div>
									
									<div class="form-group">
										<label class="form-label text-dark">Confirmed Password</label>
										<input type="password" class="form-control" id="txtpass2" placeholder="Password">
									</div>
									
									<div class="form-footer mt-2">
										<a href="javascript:login();" class="btn btn-primary btn-block" style="background-color:#00539C;">Continue</a>
									</div>
									<div class="text-center  mt-3 text-dark" >
										<a href="login.php">Take me to Login screen </a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<!-- Dashboard js -->
		<script src="../assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="../assets/js/vendors/selectize.min.js"></script>
		<script src="../assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="../assets/js/vendors/circle-progress.min.js"></script>
		<script src="../assets/plugins/rating/jquery.rating-stars.js"></script>
		<!-- Custom scroll bar Js-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>


		<!-- Fullside-menu Js-->
		<script src="../assets/plugins/toggle-sidebar/sidemenu.js"></script>


		<!--Counters -->
		<script src="../assets/plugins/counters/counterup.min.js"></script>
		<script src="../assets/plugins/counters/waypoints.min.js"></script>


		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script src="../assets/js/apprise-1.5.full.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		var invid="<?php echo $invid; ?>";
		function login(){
			//txtpass,txtemail
			var txtemail=Tvar("txtemail").value;
			var txtpass=Tvar("txtpass").value;
			var txtpass2=Tvar("txtpass2").value;
			//apprise(txtemail);
			if(txtemail==""){
				return;
			}
			
			if(txtpass==""){
				apprise("<font color='red'>ERROR: Password is required</font>");
				return;
			}
			if(txtpass2==""){
				apprise("<font color='red'>ERROR: Confirm Password is required</font>");
				return;
			}
			
			if(txtpass2==txtpass){}else{
				apprise("<font color='red'>ERROR: Confirm Password and Password must be the same</font>");
				return;
			}
			$.post("controller/utility.php", {txtemail:txtemail,txtpass:txtpass,txtpass2: txtpass2,act: 'activatelogin',invid:invid},
						   function (data) {

							   if (data.length > 0) {
								
								   
								   
								   if(data=="1"){
									Tvar("divresponse").innerHTML="<div style='font-size:30px;'><p>Registration Successful.<br><br><a href='login.php?' style='font-size:15px;'>Click here to Login</a></p></div><br><br>";
									//window.location="index.php";
									//return;
									//alert(data);
									//tSuccess("Invite sent");
								}else{
									Tvar("divresponse").innerHTML=data;
									
								}
								
								   
								  								   
								   
							   }

							});
			
			
		}
		
		</script>

	</body>
</html>