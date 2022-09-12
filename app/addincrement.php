<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		
		include("header.php"); 
		
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Payroll</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Parameters</li>
							</ol>
						</div>


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Add Increment</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										<div class="form-group">
										<label class="form-label">Grade</label>
											<select class="form-control w-100" id="cbograde">
											
											<?php
											
												$qry="select * from tblgrades where compid=$compid";
												$res=mysql_query($qry);
												$nm=mysql_num_rows($res);
												if($nm>0){
													$rdx=mysql_fetch_assoc($res);
													do{
														$idx=$rdx['id'];
														$seelcted="";
														if($gradeido==$idx){
															$seelcted="selected";
														}
														$payroll=$rdx['gradename'];
														echo "<option value='$idx' $seelcted>$payroll</option>";
													}
													while($rdx=mysql_fetch_assoc($res));
												}

											?>
											
											</select>
										</div>
										
										
										<div class="form-group ">
										
											<label class="form-label">Percentage Increase</label>
											<input type="number" value="0" class="form-control w-100" id="txtpcent"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Start Date</label>
											<input class="form-control fc-datepicker" id="txtstartdate" placeholder="MM/DD/YYYY" type="text">
										</div>
								
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Increment</button>
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
	<script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
		<script src="../assets/plugins/time-picker/toggles.min.js"></script>
		<!-- Data tables -->
		<script src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="../assets/js/datatable.js"></script>
<script src="../assets/js/select2.js"></script>
		<script src="../assets/js/formelements.js"></script>
		<!-- Datepicker js -->
		<script src="../assets/plugins/date-picker/spectrum.js"></script>
		<script src="../assets/plugins/date-picker/jquery-ui.js"></script>
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
<script src="../assets/js/apprise-1.5.full.js"></script>
		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
			function saveGrade(){
				//cbograde,txtpcent,txtstartdate
				var cbograde=Tvar("cbograde").value;
				var txtpcent=Tvar("txtpcent").value;
				var txtstartdate=Tvar("txtstartdate").value;
				
				
				
				if(txtpcent==""){
					apprise("<font color='red'>ERROR:</font> Percentage is required");
						return;
				}
				
				
				if(txtstartdate==""){
					apprise("<font color='red'>ERROR:</font> Start date is required");
						return;
				}
				
				
				
				
				
				
				
						$.post("controller/utility.php", {cbograde:cbograde,txtpcent:txtpcent,txtstartdate: txtstartdate,act: 'addincrease'},
						   function (data) {

							   if (data.length > 0) {
								   
							//	alert(data);
								   
								   
								   if(data=="1"){
									//Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Registration Successful.<br><span style='font-size:20px;'>Welcome to FBNInvex!</span><br><br><br><a href='login.php?refid="+refid+"'>Click here to Login</a></div><br><br><br><br><br><br><br><br><br><br>";
									window.location="salaryincrement.php";
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