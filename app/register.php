<!doctype html>
<?php 
include("controller/func.php");

$planid=@$_GET['planid'];

?>
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
	<title>Runbero: Join</title>
	<link rel="stylesheet" href="../assets/fonts/fonts/font-awesome.min.css">

	<!-- Bootstrap Css -->
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Sidemenu Css -->
	<link href="../assets/plugins/toggle-sidebar/sidemenu.css" rel="stylesheet" />

<script src="https://js.paystack.co/v1/inline.js"></script>
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
							<div class="card mb-xl-0">
							<center><img src="../assets/images/brand/logo.png" style="width:200px;height:64px;"></center><br><br>
								<div class="card-header">
									<h3 class="card-title">Register</h3>
								</div>
								<div id="divres">
								<form action="javascript:registerNow();" method="post" >
								<div class="card-body" >
									<div class="form-group">
										<label class="form-label text-dark">Business Name</label>
										<input type="text" class="form-control" placeholder="Enter name" id="txtcompany" required>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Contact Person Name</label>
										<input type="text" class="form-control" placeholder="Enter name" id="txtcname" required>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Mobile No.</label>
										<input type="number" class="form-control" placeholder="Telephone" id="txttelephone" required>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Email address</label>
										<input type="email" class="form-control" placeholder="Enter email" id="txtemail" required>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Physical Address</label>
										<input type="text" class="form-control" placeholder="Physical Address" id="txtaddress" required>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Password</label>
										<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Confirm Password</label>
										<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Plan Type</label>
											<select class="form-control w-100" id="cboplan">
											
											
											<?php 
											$qry="select * from tblplans order by id asc";
											$res=mysql_query($qry);
											$rd=mysql_fetch_assoc($res);
											do{
												$id=$rd['id'];
												$plan=$rd['description']." Up to ".number_format($rd['nmember'])." Members for ".number_format($rd['mnt'],2)." per Month, ".number_format($rd['tyear'],2)." per Year";
												
												$sel="";
												if($id==$planid){
													$sel="selected";
												}
												echo "<option value='$id' $sel>".$plan."</option>";
											}
											while($rd=mysql_fetch_assoc($res));
											?>
											
											</select>
									</div>
									<div class="form-group">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="chkagreed">
											<span class="custom-control-label text-dark">I agree with the <a href="terms.html" target="_blank">terms and policy of <b>Runbero</b></a></span>
										</label>
									</div>
									<div class="form-footer mt-2">
									<input type="submit" class='btn btn-primary btn-block' value="Create New Account" name="submit">&nbsp;&nbsp;</center>
										
									</div>
									<div class="text-center  mt-3 text-dark">
										Already have account?<a href="login.php"> SignIn</a>
									</div>

								</div>
							</form>
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
<link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/css/apprise.css" />

		<!-- Fullside-menu Js-->
		<script src="../assets/plugins/toggle-sidebar/sidemenu.js"></script>


		<!--Counters -->
		<script src="../assets/plugins/counters/counterup.min.js"></script>
		<script src="../assets/plugins/counters/waypoints.min.js"></script>


		<script src="../assets/js/apprise-1.5.full.js"></script>
		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		var price;
		var ifreq;
		//apprise("hellow");
		var fname="";
		var cname="";
		var fnid=randomInt(200000, 50000000);
		var email="";
		var plan=0;
		
		function registerNow(){
			//alert("here");
			
			//txtcompany,txtcname,txtemail,txtaddress,exampleInputPassword1,exampleInputPassword2,cboplan,chkagreed
			
				var txtcompany=Tvar("txtcompany").value;
				fname=txtcompany;
			var txtcname =Tvar("txtcname").value;
			cname=txtcompany;
			var txtemail=Tvar("txtemail").value;
			var txtaddress=Tvar("txtaddress").value;
			var exampleInputPassword1=Tvar("exampleInputPassword1").value
			var exampleInputPassword2=Tvar("exampleInputPassword2").value
			var cboplan=Tvar("cboplan").value
			var txttelephone=Tvar("txttelephone").value
			plan=cboplan;
			email=txtemail;
			if(exampleInputPassword1==exampleInputPassword2){}else{
					apprise("<font color='red'>ERROR: Password and confirm password should be the same</font>");
					return
				}
				
				var chkagreed = document.getElementById('chkagreed').checked;
				if(chkagreed==false){
					apprise("<font color='red'>ERROR: You need to accept Runbero Terms and Conditions</font>");
					return
				}
				
					$.post("controller/regutil.php", {txttelephone:txttelephone,cboplan:cboplan,exampleInputPassword1:exampleInputPassword1,txtaddress:txtaddress,txtemail:txtemail,txtcname:txtcname,txtcompany:txtcompany,act: 'registerbusiness' },
						   function (data) {

							   if (data.length > 0) {
								  // alert(data);
								   								   
								if(data=="xxx"){
									apprise("<font color='red'>ERROR: Business Name or Email is already in use.<br>Please login if you already have an account.</font>");
									return;
								}
								
								if(data=="1"){
									Tvar("divres").innerHTML="<p><IMG SRC='../img/done.png' style='width:50px;height:50px;'> <span style='color:#008C22;font-size:20px;'> Registration successful</span></p><p><center><a href='login.php'>Click here to Login</a></p>";
									
									
								}
								
								
								if(data=="1x"){
									Tvar("divres").innerHTML="<p><IMG SRC='../img/done.png' style='width:50px;height:50px;'> <span style='color:#008C22;font-size:20px;'> Registration successful</span></p><p><center><a href='javascript:getprice();' class='btn btn-primary'><i class=\"fa fa-credit-card\"></i> Pay to Activate for your selected Plan</a></a></p><p><a href='login.php'>Click here to Login</a></p>";
									
									
								}
								 
							   }

							});
		}
		
		function getprice(){
				var cboplan=plan;
				//alert(cboplan);
				$.post("controller/regutil.php", {cboplan:cboplan,act: 'getplanprice'},
						   function (data) {

							   if (data.length > 0) {
								   
								  	Tvar("divres").innerHTML=data;
									
									
							   }

							});
			}
			
			
			function payWithPaystack(planid,amount,freq) {
	 var initpay=amount;
	   
	   ifreq=freq;
	   
	   var pmto=parseFloat(initpay.replace(/,/g, ''))
	   if(pmto<1){
		   return;
	   }
	   var ptnmo=pmto*100;
	  
	
    var handler = PaystackPop.setup({
    key: 'pk_test_d4bd9ec26e6863c4587ae018e864f4860ea905b7', // pk_test_9c72f0cf732413c1921373d08a299b7cf9394bee Replace with your public key
    email: email,
    amount: ptnmo, // the amount value is multiplied by 100 to convert to the lowest currency unit
    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
    firstname: fname,
    lastname: cname,
    reference: fnid, // Replace with a reference you generated
    callback: function(response) {
        //this happens after the payment is completed successfully
        var reference = response.reference;
        var success_url = "";
        var desc = "";
        var amount = ptnmo;
var idos=upgrade();
	Tvar("divres").innerHTML="<p><IMG SRC='../img/done.png' style='width:50px;height:50px;'> <span style='color:#008C22;font-size:20px;'> Activation successful</span></p><p><center><a href='login.php'>Click here to continue</a></a></p>";
	
      
	  
    },
    onClose: function() {
        reason="Payment window closed";
	    var retstr="<div class=\"my-4\">";
  retstr+=" <center><p class=\"text-danger text-20 line-height-07\"><i class=\"fa fa-close\" style='font-size:60px;'></i></p></center>";
   retstr+="<center><p class=\"text-danger text-8 font-weight-500 line-height-07\">Transaction Failed</p></center>";
   retstr+="<center><p class=\"lead\">"+reason+"</p></center></div>";
  
    retstr+="<p><button class=\"btn btn-primary btn-block\" style=\"background-color:#022E63;\" onclick=\"reloadpage();\">Try again</button> </p>";
             // var names=othernames+" "+lastname;
			  var resamt=parseFloat(ptnmo)/100;
  
      document.getElementById("divres").innerHTML   =retstr; 
	  
	  
	 
    },
  });
  handler.openIframe();
}

	function reloadpage(){
	location.reload();
}

function randomInt(min, max) {
    return Math.round(min + Math.random()*(max-min));
}

	function upgrade(){
				//txtempid,txtfname,txtemail,txttel,cbograde
				var cboplan=plan;
				
						$.post("controller/regutil.php", {cboplan:cboplan,act: 'upgrade2',ifreq:ifreq,cname:cname},
						   function (data) {

							   if (data.length > 0) {
								   
								  
	
								  // alert(data);
								  								   
								   
							   }

							});
							
							//Terror(errdetails,diva)
				
			}
		
		</script>

	</body>
</html>