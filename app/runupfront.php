<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php include("header.php"); ?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Upfront</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Payroll</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Select an Upfront</div>

									</div>
									
									<div class="card-body">
									
									<?php 
										$qry="select * from tblupfront where compid=$compid";
									//	echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$rd=mysql_fetch_assoc($res);
											$ip=1;
											$ido=$rd['id'];
											
											
									
									
									?>
										<div class="table-responsive">
											<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" >
												<thead>
													<tr>
													
														<th>S/N</th>
														<th>Year</th>
														<th>Applied to Payroll</th>
														<th>Wet Effect From</th>
														<th>With Effect to</th>
														
														<th>Created By</th>
														<th>Assigned To</th>
														<th>Paid?</th>
														<th></th>
													</tr>
												</thead>
												<?php 
													do{
														
													
												?>
												<tbody>
													
													<tr>
													
														<td><?php echo $ip; ?></td>
														<td><?php echo $rd['tyear']; ?></td>
														<td><?php 
														$payid=$rd['payid'];
														$payrollname=returnQueryValue("select name from tblpayroll where id=$payid ","name");
														echo $payrollname; ?></td>
														<td><?php echo $rd['wef']; ?></td>
														<td><?php echo $rd['wet']; ?></td>
														<td><?php 
														$createdby=$rd['createdby'];
														$createdname=returnQueryValue("select fullname from tblusers where id=$createdby ","fullname");
														echo $createdname; ?></td>
														
														<td><?php 
														$assignedto=$rd['assignedto'];
														$createdname=returnQueryValue("select fullname from tblusers where id=$assignedto ","fullname");
														echo $createdname; ?></td>
														
														<td><?php 
														$approved=$rd['approved'];
														if($approved=="Y"){
															$approved="Yes";
														}
														else{
															$approved="No";
														}
														
														echo "<b>".$approved."</b>"; ?></td>
														
														
														<td>
													<a href="runupfront2.php?uid=<?php echo $ido; ?>&pid=<?php echo $payid; ?>">	<button type="button" class="btn btn-sm btn-primary waves-effect waves-light" onclick="saveGrade();"><i class="fa fa-play"></i> Process Payment</button>
													
												</a></td>
														
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

	</body>
</html>