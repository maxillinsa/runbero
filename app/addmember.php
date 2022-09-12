<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		
		include("header.php"); 
		
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">My Team</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Members</li>
							</ol>
						</div>


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Add Member</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										<div class="form-group ">
										
											<label class="form-label">Fullname</label>
											<input type="text" class="form-control w-100" id="txtfname"  placeholder="Enter member name here">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Email</label>
											<input type="text" class="form-control w-100" id="txtemail"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Telephone</label>
											<input type="text" class="form-control w-100" id="txttel"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Role</label>
											
											<select class="form-control w-100" id="cborole">
											<option value="admn" >Administrator</option>
											<option value="payrollofficer" selected>Payroll Officer</option>	
											<option value="supervisor" >Supervisor</option>											
											
											
											</select>
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Password</label>
											<input type="password" class="form-control w-100" id="txtpass1"  placeholder="">
										</div>
										
											<div class="form-group ">
										
											<label class="form-label">Confirm Password</label>
											<input type="password" class="form-control w-100" id="txtpass2"  placeholder="">
										</div>
								
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Member</button>&nbsp;&nbsp;<a href='myteam.php'><button type="button" class="btn btn-red waves-effect waves-light">Cancel</button></a>
										
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

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script src="../assets/js/apprise-1.5.full.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
			function saveGrade(){
				
				
				var txtfname=Tvar("txtfname").value;
				var txtemail=Tvar("txtemail").value;
				var txttel=Tvar("txttel").value;
				var txtpass1=Tvar("txtpass1").value;
				var txtpass2=Tvar("txtpass2").value;
				
				var cborole=Tvar("cborole").value;
				
				
				
				if(txtfname==""){
					apprise("<font color='red'>ERROR: Please specify Member Fullname</font>");
					return
				}
				
				if(txtemail==""){
					apprise("<font color='red'>ERROR: Please specify Member Email Address</font>");
					return
				}
				
				if(txttel==""){
					apprise("<font color='red'>ERROR: Please specify Member Telephone Number</font>");
					return
				}
				
				if(txtpass1==""){
					apprise("<font color='red'>ERROR: Please specify Password</font>");
					return
				}
				
				if(txtpass2==""){
					apprise("<font color='red'>ERROR: Please specify Confirm Password</font>");
					return
				}
				
				if(txtpass1==txtpass2){}else{
					apprise("<font color='red'>ERROR: Password and confirm password must be the same</font>");
					return
				}
				
				
				
					
				$.post("controller/utility.php", {cborole:cborole,txtfname:txtfname,txtemail:txtemail,act: 'addmember',txttel: txttel,txtpass1: txtpass1},
						   function (data) {

							   if (data.length > 0) {
								   
								  //alert(data);
								
								if(data=="exists"){
									//tError("ERROR: You have already invited contact<br>");
									apprise("<font color='red'>ERROR: Email or Telephone is already in use by another member</font>");
									return;
								}
								
								if(data=="exceed"){
									//tError("ERROR: You have already invited contact<br>");
									apprise("<font color='red'>ERROR: Number of Licensed Users exceeded!<br><a href='upgrade.php'>Upgrade Now</a></font>");
									return;
								}
								   
								   
								   if(data=="1"){
									//Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Registration Successful.<br><span style='font-size:20px;'>Welcome to FBNInvex!</span><br><br><br><a href='login.php?refid="+refid+"'>Click here to Login</a></div><br><br><br><br><br><br><br><br><br><br>";
									window.location="myteam.php";
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