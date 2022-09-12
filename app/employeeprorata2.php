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
							<h4 class="page-title">Employees</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Payroll Prorata</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><u><?php echo $empname; ?></u> Personalized Pay Elements</div>

									</div>
									
									<div class="card-body">
									<a href="prorateemployee.php?empid=<?php echo $empid; ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Prorate</a><br><br>
									
										<div class="table-responsive">
											<?php 
											
										
					
					$qry="select * from tblprorate where empid=$empid";
			
			
									//	echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$pck="
											<table id=\"example2\" class=\"hover table-bordered border-top-0 border-bottom-0\" >
												<thead>
													<tr>
														<th>S/N</th>
														<th>Month</th>
														<th>Year</th>
														<th>No of days</th>
													
													</tr>
												</thead>
												<tbody>";
											$rd=mysql_fetch_assoc($res);
											$ip=1;
											do{
												$pck.="<tr>";	
												$pck.="<td>".$ip."</td>";
												$pck.="<td><center>".$rd['tmonth']."</center></td>";
												$pck.="<td><center>".$rd['tyear']."</center></td>";
												$pck.="<td><center>".$rd['ndays']."</center></td>";
												


												$pck.="</tr>";													
													
																								
												$ip=$ip+1;
													}
													while($rd=mysql_fetch_assoc($res));
													
													$pck.="</tbody></table>";
													
													echo $pck;
													
			
		}
											
											?>
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