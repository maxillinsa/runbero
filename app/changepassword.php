<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php include("header.php");
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Documents</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">User Administration</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Change Password <i class="fa fa-file-text-o"></i></div>

									</div>
									
									<div class="card-body" id="registerpanel">
									<div class="form-group ">
										
											<label class="form-label">Old password</label>
											<input type="password" class="form-control w-100"  id="txtoldpass"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">New Password</label>
											<input type="password" class="form-control w-100"   id="txtpass"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Confirm New Password</label>
											<input type="password" class="form-control w-100"   id="txtpass2"  placeholder="">
										</div>
										
										
										<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Change Password</button>&nbsp;&nbsp;<a href='index.php'><button type="button" class="btn btn-red waves-effect waves-light">Cancel</button></a>
										
									</div>
										</div>
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
		
		<script src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="../assets/js/datatable.js"></script>

		<!-- Select2 js -->
		<script src="../assets/plugins/select2/select2.full.min.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>


		<!--Counters -->
		<script src="../assets/plugins/counters/counterup.min.js"></script>
		<script src="../assets/plugins/counters/waypoints.min.js"></script>

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
	
		
		<script src="../assets/js/apprise-1.5.full.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
		
			function saveGrade(){
				
				
				var txtoldpass=Tvar("txtoldpass").value;
				var txtpass=Tvar("txtpass").value;
				var txtpass2=Tvar("txtpass2").value;
				
				
				
				
				
				
				if(txtoldpass==""){
					apprise("<font color='red'>ERROR: Please specify your old password</font>");
					return
				}
				
				if(txtpass==""){
					apprise("<font color='red'>ERROR: Please specify your new password</font>");
					return
				}
				
				if(txtpass==txtpass2){}else{
					apprise("<font color='red'>ERROR: Password and confirm password must be the same</font>");
					return
				}
				
			
				
				
					
				$.post("controller/utility.php", {txtoldpass:txtoldpass,txtpass:txtpass,act: 'changepass'},
						   function (data) {

							   if (data.length > 0) {
								   
								   if(data=="xxx"){
									   apprise("<font color='red'>ERROR: Wrong Password Specified</font>");
										return
								   }
								   
								 if(data=="1"){
									Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Password changed Successful.<br><span style='font-size:20px;'>";
									//window.location="myteam.php";
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