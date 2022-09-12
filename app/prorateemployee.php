<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		$empid=@$_GET['empid'];
		include("header.php"); 
		
		$empname=returnQueryValue("select fullname from tblemployee where id=$empid","fullname");
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Prorate Employee Pay</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Prorate</li>
							</ol>
						</div>


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><?php echo $empname; ?></u> Personalized Pay Elements</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										<div class="form-group ">
										
											<label class="form-label">Affected Month</label>
											<select class="form-control w-100" id="cbomonth">
											<option value="1" selected>1</option>
											<option value="2" selected>2</option>
											<option value="3" selected>3</option>
											<option value="4" selected>4</option>
											<option value="5" selected>5</option>
											<option value="6" selected>6</option>
											<option value="7" selected>7</option>
											<option value="8" selected>8</option>
											<option value="9" selected>9</option>
											<option value="10" selected>10</option>
											<option value="11" selected>11</option>
											<option value="12" selected>12</option>
											
											</select>
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Year</label>
											<input type="number" class="form-control w-100" id="txtyear"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Prorate Payroll by Number of days</label>
											<input type="number" class="form-control w-100" id="txtnodays"  placeholder="">
										</div>
										
										
								
										
							
									
														
														
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Prorata</button>
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

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script src="../assets/js/apprise-1.5.full.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		
		<script>
		//apprise("hell");
		
		var empid="<?php echo $empid; ?>";
		
		//alert(payid);
		
			function saveGrade(){
				
				//cbomonth,txtyear,txtnodays,txtwet
				
				var cbomonth=Tvar("cbomonth").value;
				var txtyear=Tvar("txtyear").value;
				var txtnodays=Tvar("txtnodays").value;
				
			
				
				
				if(txtyear==""){
					apprise("<font color='red'>ERROR: Please specify Payroll Year</font>");
					return
				}
				
				if(txtnodays==""){
					apprise("<font color='red'>ERROR: Please specify number of days</font>");
					return
				}
				
		
				
				
						$.post("controller/utility.php", {empid:empid,act: 'addprorata',cbomonth:cbomonth,txtyear: txtyear,txtnodays: txtnodays},
						   function (data) {

							   if (data.length > 0) {
								   
								 //alert(data);return;
								
								if(data=="exists"){
									//tError("ERROR: You have already invited contact<br>");
									apprise("<font color='red'>ERROR: Pay Element already exists for this Person</font>");
									return;
								}
								   
								   
								   if(data=="1"){
									//Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Registration Successful.<br><span style='font-size:20px;'>Welcome to FBNInvex!</span><br><br><br><a href='login.php?refid="+refid+"'>Click here to Login</a></div><br><br><br><br><br><br><br><br><br><br>";
									window.location="employeeprorata2.php?empid="+empid;
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