<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		
		include("header.php"); 
		
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Loan Management</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Loans</li>
							</ol>
						</div>


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Add Loan Type</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										<div class="form-group ">
										
											<label class="form-label">Loan Description</label>
											<input type="text" class="form-control w-100" id="txttype"  placeholder="Enter type here">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Duration/Tenor (Months)</label>
											<input type="number" class="form-control w-100" id="txtduration"  placeholder="Enter number of months here">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Interest Rate (%)</label>
											<input type="number" class="form-control w-100" id="txtinterest"  placeholder="Enter interest rate e.g. 5 or 10">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Maximum Amount</label>
											<input type="number" class="form-control w-100" id="txtmax"  placeholder="Enter Maximum loanable amount">
										</div>
									
								
								
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Record</button>&nbsp;&nbsp;<a href='loantypes.php'><button type="button" class="btn btn-red waves-effect waves-light">Cancel</button></a>
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
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/js/index1.js"></script>
<script src="../assets/plugins/wysiwyag/jquery.richtext.js"></script>
		<script src="../assets/js/formeditor.js"></script>
		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
			function saveGrade(){
				//txttype,txtduration,txtinterest
				var txttype=Tvar("txttype").value;
				var txtduration=Tvar("txtduration").value;
				var txtinterest=Tvar("txtinterest").value;
				var txtmax=Tvar("txtinterest").value;
				if(txttype==""){
					return
				}
				
				if(txtduration==""){
					return
				}
				if(txtduration=="0"){
					return
				}
				
				if(txtinterest==""){
					return
				}
				
				
				
						$.post("controller/utility.php", {txtmax:txtmax,txttype:txttype,act: 'addloantype',txtduration: txtduration,txtinterest: txtinterest},
						   function (data) {

							   if (data.length > 0) {
								   
								  //alert(data);
								
								if(data=="exists"){
									//tError("ERROR: You have already invited contact<br>");
									Terror("Similar record exists","diva");
									return;
								}
								   
								   
								   if(data=="1"){
									//Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Registration Successful.<br><span style='font-size:20px;'>Welcome to FBNInvex!</span><br><br><br><a href='login.php?refid="+refid+"'>Click here to Login</a></div><br><br><br><br><br><br><br><br><br><br>";
									window.location="loantypes.php";
									//return;
									//alert(data);
									//tSuccess("Invite sent");
								}
								   
								  								   
								   
							   }

							});
							
							//Terror(errdetails,diva)
				
			}
		
		
		</script>

	</body>
</html>