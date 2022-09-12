<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php include("header.php"); ?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Payroll</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Departments</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Pick a Payroll to run</div>

									</div>
									
									<div class="card-body">
									
									<?php 
										$qry="select * from tblpayroll where compid=$compid";
									//	echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$rd=mysql_fetch_assoc($res);
											$ip=1;
											
											
									
									
									?>
										<div class="table-responsive">
											<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" >
												<thead>
													<tr>
														<th>S/N</th>
														<th>Payroll</th>
														<th>Run Frequency</th>
														<th>Next Run Date</th>
														<th>Status</th>
														<th></th>
													</tr>
												</thead>
												<?php 
													do{
														
														$pid=$rd['id'];
														
													
												?>
												<tbody>
													
													<tr>
														<td><?php echo $ip; ?></td>
														<td><?php echo $rd['name']; ?></td>
														<td><?php echo $rd['freq']; ?></td>
														<td><?php echo $rd['rundate']; ?></td>
														<td><?php 
														$status=$rd['active'];
														if($status=="Y"){
															$status="Active";
														}
														else{
															$status="Inactive";
														}
														echo "<b>".$status."</b>"; ?></td>
														
														<td><?php echo " <a href='javascript:runpayroll(\"$pid\");' class='btn btn-sm btn-primary'>Run <i class='fa fa-play'></i> </a>"; ?></td>
														
														
														
													</tr>
												</tbody>
												<?php 
												
												$ip=$ip+1;
													}
													while($rd=mysql_fetch_assoc($res));
										}
												
												?>
												
											</table>

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
		<script src="../assets/js/apprise-1.5.full.js"></script>
		<script src="../assets/js/admin-custom.js"></script>
		
		<script>
		
			function runpayroll(pid){
				//alert(pid);
				$.post("controller/utility.php", {pid:pid,act: 'validate'},
						   function (data) {

							   if (data.length > 0) {
								   
								 
								   
								   
							if(data=="Y"){
									//Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Registration Successful.<br><span style='font-size:20px;'>Welcome to FBNInvex!</span><br><br><br><a href='login.php?refid="+refid+"'>Click here to Login</a></div><br><br><br><br><br><br><br><br><br><br>";
									window.location="payslip.php?pid="+pid;
									//return;
									//alert(data);
									//tSuccess("Invite sent");
								}
								   else{
									   apprise(data);
								   }
								  								   
								   
							   }

							});
			}
		
		</script>

	</body>
</html>