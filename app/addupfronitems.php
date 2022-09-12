<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
	
		$upid=@$_GET['id'];
		$grade=@$_GET['grade'];
		
		include("header.php"); 
		$rd=mysql_fetch_assoc(mysql_query("select * from tblupfront where id= $upid"));
		$payid=$rd['payid'];
		
		$wef=$rd['wef'];
		$pwef=$rd['wef'];
		$wet=$rd['wet'];
		$pwet=$rd['wet'];
		//$wef=date("l jS \of F Y h:i:s A");
		$wef=date('l jS \of F Y', strtotime($wef));
		$wet=date('l jS \of F Y', strtotime($wet));
		
		$pwef=date('Y-m-d', strtotime($pwef));
		$pwet=date('Y-m-d', strtotime($pwet));
		
		$payname=returnQueryValue("select name from tblpayroll where id=$payid","name");
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Upfront</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Upfront</li>
							</ol>
						</div>


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">New Upfront Items</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										
									
										
										
										<span style="font-size:17px;"><?php echo "Upfront: <u>".$payname."</u> <b>From</b> ".$wef." <b>To</b> ".$wet; ?></span><br>
										
										<hr>
											
										
										<div class="form-group ">
										
											<label class="form-label">Pay Element with Period conforming with Upront Period.</label>
											
											<select class="form-control w-100" id="cbopayelement">
											<?php
											
												$qry="select * from tblpayelement where compid=$compid and ('$pwef' between wef and wet and '$pwet' >= wet) and grade=$grade";
											//echo $qry;
												$res=mysql_query($qry);
												$nm=mysql_num_rows($res);
												if($nm>0){
													$rd=mysql_fetch_assoc($res);
													do{
														$id=$rd['id'];
														
														$payroll=$rd['payelement'];
														echo "<option value='$id'>$payroll</option>";
													}
													while($rd=mysql_fetch_assoc($res));
												}

											?>
											</select>
										</div>
										
										<b>For the Period of:</b>
								<div class="form-group ">
										
											<label class="form-label"> From</label>
											
											<input class="form-control fc-datepicker" id="txtwef" placeholder="MM/DD/YYYY" type="text">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label"> To</label>
											<input class="form-control fc-datepicker" id="txtwet" placeholder="MM/DD/YYYY" type="text">
										</div>
										
									
													
														
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Upfront Item</button>
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
		
		
		var upfrontid="<?php echo $upid; ?>";
		var grade="<?php echo $grade; ?>";
		
		
		
			function saveGrade(){
				//cbopayelement,	txtwef,txtwet
				var cbopayelement=Tvar("cbopayelement").value;
				var txtwef=Tvar("txtwef").value;
				var txtwet=Tvar("txtwet").value;
				
				
				if(txtwef==""){
					apprise("<font color='red'>ERROR: Please specify dates</font>");
					return
				}
				
				if(txtwet==""){
					apprise("<font color='red'>ERROR: Please specify dates</font>");
					return
				}
				
				$.post("controller/utility.php", {grade:grade,cbopayelement:cbopayelement,txtwef:txtwef,txtwet:txtwet,act: 'addupfrontitem', upfrontid: upfrontid},
						   function (data) {

							   if (data.length > 0) {
								   
								 //alert(data);return;
								
								if(data=="exists"){
									//tError("ERROR: You have already invited contact<br>");
									apprise("<font color='red'>ERROR: You have already created a similar record</font>");
									return;
								}
								   
								   
								  if(data=="1"){
									//Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Registration Successful.<br><span style='font-size:20px;'>Welcome to FBNInvex!</span><br><br><br><a href='login.php?refid="+refid+"'>Click here to Login</a></div><br><br><br><br><br><br><br><br><br><br>";
									window.location="upfrontitems.php?id="+upfrontid+"&grade="+grade;
								}
								   
								  								   
								   
							   }

							});
							
							//Terror(errdetails,diva)
				
			}
			
			
			
		
		</script>

	</body>
</html>