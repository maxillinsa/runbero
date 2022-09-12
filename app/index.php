<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php include("header.php"); ?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title"><?php echo $cname; ?></h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</div>

						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
								<div class="card overflow-hidden">
									<div class="card-body ">
										<h5 class="">Total Earning</h5>
										
										
										<h2 class="text-dark  mt-0 "><?php echo number_format($totearn,2); ?></h2>
										<div class="progress progress-sm mt-0 mb-2">
											<div class="progress-bar bg-primary w-75" role="progressbar"></div>
										</div>
										<div class=""><i class="fa fa-caret-up text-green"></i>Earnings</div>
									</div>
								</div>
							</div>
							<div class=" col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card overflow-hidden">
									<div class="card-body ">
										<h5 class="">Total Deductions</h5>
										<h2 class="text-dark  mt-0 "><?php echo number_format($totdeduct,2); ?></h2>
										<div class="progress progress-sm mt-0 mb-2">
											<div class="progress-bar bg-red w-45" role="progressbar"></div>
										</div>
										<div class=""><i class="fa fa-caret-down text-danger"></i>Deductions</div>
									</div>
								</div>
							</div>
							<div class=" col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card overflow-hidden">
									<div class="card-body ">
										<h5 class="">Net Payout</h5>
										<h2 class="text-dark  mt-0 "><?php echo number_format($netpayout,2); ?></h2>
										<div class="progress progress-sm mt-0 mb-2">
											<div class="progress-bar bg-warning w-50" role="progressbar"></div>
										</div>
										<div class=""><i class="fa fa-caret-down text-danger"></i>Total Payout</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
								<div class="card overflow-hidden">
									<div class="card-body ">
										<h5 class="">Total Upfront</h5>
										<h2 class="text-dark  mt-0  "><?php echo number_format($totupfront,2); ?></h2>
										<div class="progress progress-sm mt-0 mb-2">
											<div class="progress-bar bg-success w-25" role="progressbar"></div>
										</div>
										<div class=""><i class="fa fa-caret-up text-success"></i>Annual Bulk Payments</div>
									</div>
								</div>
							</div>
						</div>

					<?php if($role=="admin"){ ?>

						<div class="row">
						
						<div>
						
						<ul class="drop-icon-wrap">
											<li>
												<a href="employees.php" class="drop-icon-item">
													<i class="icon icon-user text-primary"></i>
													<span class="block"> Members</span>
												</a>
											</li>
											
											
												<li>
												<a href="uploadstaff.php" class="drop-icon-item">
													<i class="fa fa-arrow-up text-primary"></i>
													<span class="block"> Upload</span>
												</a>
											</li>
											
											<li>
												<a href="grades.php" class="drop-icon-item">
													<i class="icon icon-layers text-primary"></i>
													<span class="block"> Categories</span>
												</a>
											</li>

											<li>
												<a href="myteam.php" class="drop-icon-item">
													<i class="icon icon-people text-primary"></i>
													<span class="block"> My Team</span>
												</a>
											</li>
											
											<li>
												<a href="docarea.php" class="drop-icon-item">
													<i class="icon icon-folder-alt text-primary"></i>
													<span class="block"> Documents</span>
												</a>
											</li>
											
										
											
											<li>
												<a href="payrollproject.php" class="drop-icon-item">
													<i class="icon icon-wrench text-primary"></i>
													<span class="block"> Payroll</span>
												</a>
											</li>
											
											<li>
												<a href="payelement.php" class="drop-icon-item">
													<i class="icon icon-puzzle text-primary"></i>
													<span class="block"> Pay Elements</span>
												</a>
											</li>
											
												<li>
												<a href="upfront.php" class="drop-icon-item">
													<i class="icon icon-bag text-primary"></i>
													<span class="block"> Upfront</span>
												</a>
											</li>
											
											<li>
												<a href="salaryincrement.php" class="drop-icon-item">
													<i class="icon icon-graph text-primary"></i>
													<span class="block"> Increment</span>
												</a>
											</li>
											
											
											<li>
												<a href="loanrequests.php" class="drop-icon-item">
													<i class="icon icon-hourglass text-primary"></i>
													<span class="block"> Loans</span>
												</a>
											</li>
											
											<li>
												<a href="manageloan.php" class="drop-icon-item">
													<i class="icon icon-share-alt text-primary"></i>
													<span class="block"> Loan Request</span>
												</a>
											</li>
											
												<li>
												<a href="invites.php" class="drop-icon-item">
													<i class="icon icon-directions text-primary"></i>
													<span class="block"> Invite User</span>
												</a>
											</li>
											
											
										</ul>
						
						</div>
						<?php 
							$gradenum=recNum("select * from tblgrades where compid=$compid");
							$payrollnum=recNum("select * from tblpayroll where compid=$compid");
							$payelenum=recNum("select * from tblpayelement where compid=$compid");
							$emplnum=recNum("select * from tblemployee where compid=$compid");
							$ltypenum=recNum("select * from loantypes where compid=$compid");
							
						?>
						<?php if($role=="admin" || $role=="payrollofficer"){ ?>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">New to Blueroll? Self Guide</div>
									</div>
									<div class="card-body">
									<?php 
									echo ' <ul class="drop-icon-wrap" style="float:left;">';
									echo '<li style="padding-left:10px;font-size:16px;font-weight:bold;color:#008C22;"></li>';
									if($gradenum>0){
										echo '<li style="padding-left:10px;">
												<a href="#" style="font-size:14px;" class="drop-icon-item">
													<img src="../img/done.png" style="height:40px;height:40px;">
													<span class="block"> Member Categorizations</span>
												</a>
											</li>';
									}else{
										echo '<li><span style="font-size:14px;text-align:left;">Payroll Module </span><span style="font-size:18px;font-weight:bold;">1#</span>&nbsp;<a href="grades.php" class="btn btn-sm btn-blue">Define Members Categories</a></li>';
									}
									
									if($payrollnum>0){
										echo '<li style="padding-left:10px;">
												<a href="#" style="font-size:14px;" class="drop-icon-item">
													<img src="../img/done.png" style="height:40px;height:40px;">
													<span class="block"> Payroll Project created!</span>
												</a>
											</li>';
									}else{
										echo '<li style="padding-left:10px;"><span style="font-size:18px;font-weight:bold;">2#&nbsp;</span><a href="payrollproject.php" class="btn btn-sm btn-indigo">Create a Payroll Project</a></li>';
									}
									
									if($payelenum>0){
										echo '<li style="padding-left:10px;">
												<a href="#" style="font-size:14px;" class="drop-icon-item">
													<img src="../img/done.png" style="height:40px;height:40px;">
													<span class="block"> Pay Elements defined!</span>
												</a>
											</li>';
									}else{
										echo '<li style="padding-left:10px;"><span style="font-size:18px;font-weight:bold;">3#&nbsp;</span><a href="payelement.php" class="btn btn-sm btn-primary">Define Pay Elements</a></li>';
									}
									
									
									if($emplnum>0){
										echo '<li style="padding-left:10px;">
												<a href="#" style="font-size:14px;" class="drop-icon-item">
													<img src="../img/done.png" style="height:40px;height:40px;">
													<span class="block"> Members Registered!</span>
												</a>
											</li>';
									}else{
										echo '<li style="padding-left:10px;"><span style="font-size:18px;font-weight:bold;">4#&nbsp;</span><a href="employees.php" class="btn btn-sm btn-primary">Register your Members</a></li>';
									}
									
									
									
									echo '</ul>';
									
									?>
									
									
									
									
										<?php 
									echo ' <ul class="drop-icon-wrap" style="float:left;">';
									echo '<li style="padding-left:10px;font-size:16px;font-weight:bold;color:#008C22;"></li>';
									if($gradenum>0){
										echo '<li style="padding-left:10px;">
												<a href="#" style="font-size:14px;" class="drop-icon-item">
													<img src="../img/done.png" style="height:40px;height:40px;">
													<span class="block"> Member Categorizations</span>
												</a>
											</li>';
									}else{
										echo '<li style=""><span style="font-size:14px;">Loan Module </span><span style="font-size:18px;font-weight:bold;">1#</span>&nbsp;<a href="grades.php" class="btn btn-sm btn-blue">Define Members Categories</a></li>';
									}
									
									
									
									if($ltypenum>0){
										echo '<li style="padding-left:10px;">
												<a href="#" style="font-size:14px;" class="drop-icon-item">
													<img src="../img/done.png" style="height:40px;height:40px;">
													<span class="block"> Loan types defined!</span>
												</a>
											</li>';
									}else{
										echo '<li style="padding-left:10px;"><span style="font-size:18px;font-weight:bold;">2#&nbsp;</span><a href="loantypes.php" class="btn btn-sm btn-primary">Define Loan Types</a></li>';
									}
									
									
									if($emplnum>0){
										echo '<li style="padding-left:10px;">
												<a href="#" style="font-size:14px;" class="drop-icon-item">
													<img src="../img/done.png" style="height:40px;height:40px;">
													<span class="block"> Members Registered!</span>
												</a>
											</li>';
									}else{
										echo '<li style="padding-left:10px;"><span style="font-size:18px;font-weight:bold;">3#&nbsp;</span><a href="employees.php" class="btn btn-sm btn-primary">Register your Members</a></li>';
									}
									
									
									
									echo '</ul>';
									
									?>
									
									</div>
								</div>
							</div>
						
						
						<?php } ?>
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Blueroll Tips</div>
									</div>
									<div class="card-body">
									
									<div class="ibox teams mb-30 bg-boxshadow">
											<div class="card overflow-hidden">
									<div class="power-ribbon power-ribbon-top-left text-warning"><span class="bg-warning"></span></div>
									<div class="card-body">
										<div class="item-det row">
											<div class="col-md-9">
												<a href="jobs.html" class="text-dark"><h4 class="mb-2">You need to have an active Payroll in your account</h4></a>
												<div class="">
													<ul class="mb-0 d-flex">
														<li class="mr-5"><a href="#" class="icons"> Create a Payroll Project now</a></li>
														<li class="mr-5"><a href="#" class="icons"> Pay attention to First Run date. It controls when processing starts</a></li>
													</ul>
												</div>
											</div>
											<div class="col-sm-3 col-auto">
												<div class="icons mt-3 mt-sm-0 pb-0 ">
													<a href="payrollproject.php" class="btn btn-primary mt-1"> Get Started</a>
												</div>
											</div>
										</div>
									</div>
								</div>
										
										</div>
										
										
										<div class="ibox teams mb-30 bg-boxshadow">
											<div class="card overflow-hidden">
									<div class="power-ribbon power-ribbon-top-left text-warning"><span class="bg-warning"><i class="fa fa-info"></i></span></div>
									<div class="card-body">
										<div class="item-det row">
											<div class="col-md-9">
												<a href="#" class="text-dark"><h4 class="mb-2">Running Payroll <span class="badge badge-danger fs-12">Important</span></h4></a>
												<div class="">
													<ul class="mb-0 d-flex">
														<li class="mr-5"><a href="#" class="icons"> To start running payroll, create your Pay Elements</a></li>
														<li class="mr-5"><a href="#" class="icons"> Use the predefined Pay Item Criterias for accurate compuations</a></li>
													</ul>
												</div>
											</div>
											<div class="col-sm-3 col-auto">
												<div class="icons mt-3 mt-sm-0 pb-0 ">
													<a href="payelement.php" class="btn btn-primary mt-1"> Try it</a>
												</div>
											</div>
										</div>
									</div>
								</div>
										
										</div>
										
										<div class="card overflow-hidden">
									<div class="power-ribbon power-ribbon-top-left text-warning"><span class="bg-warning"><i class="fa fa-bolt"></i></span></div>
									<div class="card-body">
										<div class="item-det row">
											<div class="col-md-9">
												<a href="jobs.html" class="text-dark"><h4 class="mb-2">Start you Loan Business</h4></a>
												<div class="">
													<ul class="mb-0 d-flex">
														<li class="mr-5"><a href="#" class="icons"><i class="icon icon-briefcase text-muted mr-1"></i> Kickstart your Loan business by defining your Loan offerings</a></li>
														<li class="mr-5"><a href="#" class="icons"><i class="icon icon-location-pin text-muted mr-1"></i> Your borrowers have self-service access to service their Loans</a></li>
													</ul>
												</div>
											</div>
											<div class="col-sm-3 col-auto">
												<div class="icons mt-3 mt-sm-0 pb-0 ">
													<a href="loantypes.php" class="btn btn-primary mt-1"> Create Loan Types</a>
												</div>
											</div>
										</div>
									</div>
								</div>
									</div>
								</div>
							</div>
						
						
						
						</div>

					<?php } ?>
					
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

	</body>
</html>