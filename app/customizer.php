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
							<h4 class="page-title">Pay Element</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Pay Element</li>
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
										
											<label class="form-label">Pay Element Name</label>
											<input type="text" class="form-control w-100" id="txtpayelement"  placeholder="e.g Transport Allowance">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Amount</label>
											<input type="number" class="form-control w-100" id="txtamount"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Computations</label>
											
											<select class="form-control w-100" id="cbocrite">
											<option value="USEAMT" selected>Use Amount Specified</option>
											
											</select>
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Computations Type</label>
											
											<select class="form-control w-100" id="cbotype">
											<option value="C" >Earnings</option>
											<option value="D" selected>Deductions</option>										
											
											
											</select>
										</div>
										
								
										
								<div class="form-group ">
										
											<label class="form-label">With Effect From</label>
											
											<input class="form-control fc-datepicker" id="txtwef" placeholder="MM/DD/YYYY" type="text">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">With Effect To</label>
											<input class="form-control fc-datepicker" id="txtwet" placeholder="MM/DD/YYYY" type="text">
										</div>
										
									
														
														
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Pay Element</button>
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
				
				var txtpayelement=Tvar("txtpayelement").value;
				var txtamount=Tvar("txtamount").value;
				var cbocrite=Tvar("cbocrite").value;
				
				var txtwef=Tvar("txtwef").value;
				var txtwet=Tvar("txtwet").value;
				var cbotype=Tvar("cbotype").value;
				
				
				if(txtpayelement==""){
					apprise("<font color='red'>ERROR: Please specify Pay Element Name</font>");
					return
				}
				
				if(txtwef==""){
					apprise("<font color='red'>ERROR: Please specify dates</font>");
					return
				}
				
				if(txtwet==""){
					apprise("<font color='red'>ERROR: Please specify dates</font>");
					return
				}
				
				
				
				
				//alert(parseFloat(txtamount));
				if(cbocrite=="USEAMT"){
					if(txtamount==""){
						apprise("<font color='red'>ERROR: Please specify Pay Element Amount</font>");
						return;
					}
					
				}
				
				
				
				
				
				if(txtamount==""){
						txtamount="0";
					}
					
					
				
				var ischecked="N";
				
				
			
				
				
						$.post("controller/utility.php", {empid:empid,ischecked:ischecked,cbotype:cbotype,cbocrite:cbocrite,txtpayelement:txtpayelement,act: 'addpayelementpersonal', txtamount: txtamount,txtwef:txtwef, txtwet: txtwet},
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
									window.location="employeespayement2.php?empid="+empid;
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