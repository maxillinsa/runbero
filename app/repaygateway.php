<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		$repid=@$_GET['id'];
		include("header.php"); 
		
		$rdr=mysql_fetch_assoc(mysql_query("select * from tblloanshedule where id=$repid"));
		$duedate=$rdr['paymentdate'];
		$instamount=$rdr['instamount'];
		
		$loanid=$rdr['loanid'];
		
		$owner=returnQueryValue("select empid from tblloans where id=$loanid","empid");
		$efullname=returnQueryValue("select fullname from tblemployee where id=$owner","fullname");
		$eemail=returnQueryValue("select email from tblemployee where id=$owner","email");
		$compido=returnQueryValue("select compid from tblemployee where id=$owner","compid");
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Account Setting</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page"> Payment</li>
							</ol>
						</div>


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Loan Repayment</div>
									</div>
									<div class="card-body" id="divres">
									<span id="diva"></span>
									<div class="form-group">
										<label class="form-label text-dark">Selected outstanding</label>
											<?php 
											
											
											
											echo "<span style='font-size:20px;'>Repayment amount <b>".number_format($instamount,2)."</b> due on <b>$duedate</b></span>";
											
											?>
											
									</div>
										
											
										<center>	<span id="spprice"></span>&nbsp;&nbsp;<a href='javascript:payWithPaystack();'><button type="button" class="btn btn-red"><i class='fa fa-credit-card'></i> Make Payment</button></a></center>
									</div>
									
								</div>
							</div>
						
						
					
					</div>
				</div>
			</div>

			<!--footer-->
		<?php include("footer.php"); ?>
			<!-- End Footer-->
		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top" ><i class="fa fa-rocket"></i></a>


		<!-- Dashboard Core -->
		<script src="../assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="../assets/js/vendors/selectize.min.js"></script>
		<script src="../assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="../assets/js/vendors/circle-progress.min.js"></script>
		<script src="../assets/plugins/rating/jquery.rating-stars.js"></script>

		<!--Counters -->
		<script src="../assets/plugins/counters/counterup.min.js"></script>
		<script src="../assets/plugins/counters/waypoints.min.js"></script>

		<!-- Fullside-menu Js-->
		<script src="../assets/plugins/toggle-sidebar/sidemenu.js"></script>

		<!-- CHARTJS CHART -->
		<script src="../assets/plugins/chart/Chart.bundle.js"></script>
		<script src="../assets/plugins/chart/utils.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!-- ECharts Plugin -->
		<script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
		<script src="../assets/plugins/time-picker/toggles.min.js"></script>
		<!-- Data tables -->
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/plugins/echarts/echarts.js"></script>
		
	<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/js/index1.js"></script>
		
		<script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
		<script src="../assets/plugins/time-picker/toggles.min.js"></script>
		<!-- Data tables -->
		<script src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="../assets/js/datatable.js"></script>

		<!-- Datepicker js -->
		<script src="../assets/plugins/date-picker/spectrum.js"></script>
		<script src="../assets/plugins/date-picker/jquery-ui.js"></script>
		<script src="../assets/plugins/input-mask/jquery.maskedinput.js"></script>

		<!-- Inline js -->
		<script src="../assets/js/select2.js"></script>
		<script src="../assets/js/formelements.js"></script>
<script src="../assets/js/apprise-1.5.full.js"></script>
		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		var price;
		var ifreq;
		var efullname="<?php echo $efullname; ?>";
		var rpid="<?php echo $repid; ?>";
		var compido="<?php echo $compido; ?>";
		var insamt="<?php echo $instamount; ?>";
		//apprise("hellow");
		var fnid=randomInt(200000, 50000000);
		//alert(fnid);
			function upgrade(){
				//txtempid,txtfname,txtemail,txttel,cbograde
				
				
						$.post("controller/utility.php", {rpid:rpid,act: 'loanrepaid',compido:compido},
						   function (data) {

							   if (data.length > 0) {
								   
								  
	
								  // alert(data);
								  								   
								   
							   }

							});
							
							//Terror(errdetails,diva)
				
			
			
			
			}
			
			
			function payWithPaystack() {
				//alert(insamt);
	 var initpay=insamt;
	   
	   	   
	   var pmto=parseInt(initpay);
	   if(pmto<1){
		   return;
	   }
	   var ptnmo=pmto*100;
	  
	
    var handler = PaystackPop.setup({
    key: 'pk_test_d4bd9ec26e6863c4587ae018e864f4860ea905b7', // pk_test_9c72f0cf732413c1921373d08a299b7cf9394bee Replace with your public key
    email: '<?php echo $eemail; ?>',
    amount: ptnmo, // the amount value is multiplied by 100 to convert to the lowest currency unit
    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
    firstname: '<?php echo $efullname; ?>',
    lastname: 'Borrower' ,
    reference: fnid, // Replace with a reference you generated
    callback: function(response) {
        //this happens after the payment is completed successfully
        var reference = response.reference;
        var success_url = "";
        var desc = "";
        var amount = ptnmo;
var idos=upgrade();
	Tvar("divres").innerHTML="<p><IMG SRC='../img/done.png' style='width:50px;height:50px;'> <span style='color:#008C22;font-size:20px;'> Loan Repayment successful</span></p><p><center><a href='index.php'>Click here to continue</a></a></p>";
	
      
	  
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
		
		</script>

	</body>
</html>