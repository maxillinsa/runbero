<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		$lnid=@$_GET['id'];
		if(empty($lnid)){
			header("location: index.php");exit;
		}
		include("header.php");
		$rd=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lnid"));
		$lapproved=$rd['approved'];
		$loanid=$rd['loanid'];
		$cgateway=returnQueryValue("select paymentgateway from loantypes where id=$loanid","paymentgateway");

		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Loan Management</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Loan Schedule</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><?php 
											$rd=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lnid"));
											$lntid=$rd['loanid'];
											$loantype=returnQueryValue("select name from loantypes where id=$lntid","name");
											echo "'".$loantype."' Repayment Schedule";
										?></div>

									</div>
									
									<div class="card-body">
									
									<?php 
										$qry="select * from tblloanshedule where loanid=$lnid order by id asc";
									//	echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$rd=mysql_fetch_assoc($res);
											$ip=1;
											
											$minid=returnQueryValue("select min(id)minid from tblloanshedule where loanid=$lnid and paid='N'","minid");
									
									
									?>
										<div class="table-responsive">
											<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" >
												<thead>
													<tr>
													<th>SN</th>
														<th>Payment Date</th>
														<th>Beginning Balance</th>
														<th>Instalment Amount</th>
														<th>Interest</th>
														<th>Closing Balance</th>
														<th>Status</th>
														
													</tr>
												</thead>
												<?php 
													do{
														
													
												?>
												<tbody>
													
													<tr>
														<td><?php echo $ip;
														$repid=$rd['id'];
														
														?></td>
														<td><?php echo $rd['paymentdate']; ?></td>
														<td><?php echo number_format($rd['begbalance'],2); ?></td>
														<td><?php echo number_format($rd['instamount'],2); ?></td>
														<td><?php echo number_format($rd['interest'],2); ?></td>
														<td><?php echo number_format($rd['endbalance'],2); ?></td>
														<td><?php 
														$paid=$rd['paid'];
														$retst="";
														if($paid=="Y"){
															$retst="<span style='color:green;font-weight:bold;'><i class='fa fa-check'></i> Paid</span>";
														}
														else{
															if($minid==$repid){
																echo "<span style='color:red;font-weight:bold;'>UnPaid</span>";
																if($lapproved=="Y"){
																	if($cgateway=="Y"){
																$retst="&nbsp;";
																}
																}
															}else{
																$retst="<span style='color:red;font-weight:bold;'>UnPaid</span>";
															}
															
														}
														echo "<b>".$retst."</b>"; ?></td>
														
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
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
			var lnid="<?php echo $lnid; ?>";
			function payLoan(id){
				
				window.location="repaygateway.php?id="+id;
				
			}
		
		</script>

	</body>
</html>