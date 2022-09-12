<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php include("header.php"); ?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">My Loans</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Departments</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Members</div>

									</div>
									
									<div class="card-body">
							<a href="applyforloan.php" class="btn btn-primary"> <i class="fa fa-percent"></i> Apply For a New Loan</a><br>
							<?php 
										$qry="select * from  tblloans where empid=$currempid";
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
											<table class="table table-inbox table-hover">
												<thead>
													<tr>
														<th>S/N</th>
														<th>Loan No.</th>
														<th>Type</th>
														<th>Applicant</th>
														<th>Principal</th>
														<th>Interest Rate</th>
														<th>Repayment Amount</th>
														<th>Instalment Amount</th>
														<th>Repayment Period</th>
														<th>Duration (Months)</th>
														<th>Repayment Start Date</th>
														<th></th>
														<th>Status</th>
														<th>Created By</th>
														<th>Loan Documents</th>
														<th>Date Created</th>
														<th>Agreement Signed?</th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<?php 
													do{
														$topup=$rd['topup'];
													
												?>
												<tbody>
													
													<tr>
														<td class=\"inbox-small-cells\"><?php echo $ip; ?></td>
														
														<td class=\"inbox-small-cells\"><?php echo $rd['loanno']; ?></td>
														
														<td class=\"inbox-small-cells\"><?php 
														if($topup=="N"){
															echo "<b>New</b>";
														}else{
															echo "<b>Top Up</b>";
														}
														?></td>
														
														
														<td class=\"inbox-small-cells\"><?php 
														$lid=$rd['id'];
														$minid=returnQueryValue("select min(id)mind from tblloanshedule where loanid=$lid","mind");
		$instmt=returnQueryValue("select instamount from tblloanshedule where id=$minid","instamount");
														$empid=$rd['empid'];
														//echo $rd['name'];
														$ename=returnQueryValue("select fullname from tblemployee where id=$empid","fullname");
														echo $ename;
														?></td>
														<td class=\"inbox-small-cells\"><?php echo number_format($rd['principal'],2); ?></td>
														<td class=\"inbox-small-cells\"><?php echo number_format($rd['intrate'],2); ?></td>
														<td class=\"inbox-small-cells\"><?php echo number_format($rd['amount'],2); ?></td>
														<td class=\"inbox-small-cells\"><?php echo number_format($instmt,2); ?></td>
														<td class=\"inbox-small-cells\"><?php echo $rd['duration']; ?></td>
														<td class=\"inbox-small-cells\"><?php echo $rd['duration']; ?></td>
														<td class=\"inbox-small-cells\"><?php echo $rd['startdate']; ?></td>
														<td class=\"inbox-small-cells\">
															<a href='discussloan.php?id=<?php echo $lid; ?>' target='_blank'><button class='btn btn-sm btn-secondary'> Chat <i class='fa fa-commenting-o'></i></button> </a>
														</td>
														<td class=\"inbox-small-cells\"><?php 
															$status=$rd['approved'];
															$signagreed=$rd['signagreed'];
															$approved=$rd['approved'];
															if($status=="N"){
																$status="Pending Approval";
															}
															if($status=="Y"){
																$status="<b><i class=\"fa fa-check\"></i>Approved</b>";
															}
															if($status=="J"){
																$status="<b style='color:red;'><i class=\"fa fa-ban\"></i>Declined</b>";
															}
														echo "<span style='font-size:10px;'>".$status."</span>"; ?></td>
														<td><?php 
														$cby=$rd['createdby'];
														$createtype=$rd['createtype'];
														if($createtype=="A"){
															$ecrname=returnQueryValue("select fullname from tblusers where id=$cby","fullname");
														}else{
															$ecrname=returnQueryValue("select fullname from tblemployee where id=$cby","fullname");
														}
														
														
														
														echo $ecrname; ?></td>
														
														<td class=\"inbox-small-cells\">
															<a href='loandoc.php?id=<?php echo $lid; ?>' target='_blank'><button class='btn btn-sm btn-primary'>Documents <i class='fa fa-file-text-o'></i></button> </a>
														</td>
														
														<td class=\"inbox-small-cells\"><?php echo $rd['ddate']; ?></td>
															<td><?php 
															$signagreed=$rd['signagreed'];
															if($signagreed=="N"){
																echo "<center>Not yet</center>";
															
															}
															
															if($signagreed=="R"){
																echo "<center style='font-size:10px;'>Agreement Received. Waiting for Approval</center>";
															
															}
															
															if($signagreed=="Y"){
																echo "<center STYLE='color:green;font-weight:bold;'>Yes</center>";
															
															}
															
															if($signagreed=="J"){
																echo "<center style='font-size:10px;color:red;'>Agreement Rejected</center>";
															
															}
															
															 ?></td>
															 
															<td>
															<td><?php 
															
															echo " <a href='loanschedulemember.php?id=$lid' class='btn btn-sm btn-primary' target='_blank'>View Schedule <i class='fa fa-search'></i> </a>&nbsp;&nbsp;"; 
															
															
															
															?>
															
															</td>
															
																<td><?php 
															
															
															if($signagreed=="R"){
																if($status=="N"){
																	echo " <a href='signagreement.php?id=$lid' class='btn btn-sm btn-info' target='_blank'>Sign Agreement <i class='fa fa-pencil'></i> </a>&nbsp;&nbsp;";
																}
															}
															?>
															
															</td>
															
															<td><?php 
															
															
														
																if($approved=="Y"){
																	echo " <a href='loantopup.php?id=$lid' class='btn btn-sm btn-red'>Loan Top Up <i class='fa fa-chevron-up'></i> </a>&nbsp;&nbsp;";
																}
															
															?>
															
															</td>
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