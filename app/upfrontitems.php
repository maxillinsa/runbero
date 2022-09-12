<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php
			$upid=@$_GET['id'];
			$grade=@$_GET['grade'];
			
		include("header.php"); 
		$rd=mysql_fetch_assoc(mysql_query("select * from tblupfront where id= $upid"));
		$payid=$rd['payid'];
		$payname=returnQueryValue("select name from tblpayroll where id=$payid","name");
		$wef=$rd['wef'];
		$wet=$rd['wet'];
		//$wef=date("l jS \of F Y h:i:s A");
		$wef=date('l jS \of F Y', strtotime($wef));
		$wet=date('l jS \of F Y', strtotime($wet));
		?>

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
										<div class="card-title">Existing Upfront Items</div>

									</div>
									
									<div class="card-body">
									<span style="font-size:17px;"><?php echo "Upfront: <u>".$payname."</u> <b>From</b> ".$wef." <b>To</b> ".$wet; ?></span><br>
										<br>Grade: <select class="form-control w-25" id="cbograde" onchange="loadpayelementgrade();">
											<?php
											echo "<option value='0' $selected>
											</option>";
												$qry="select * from tblgrades where compid=$compid ";
												$res=mysql_query($qry);
												$nm=mysql_num_rows($res);
												if($nm>0){
													$rd=mysql_fetch_assoc($res);
													do{
														$id=$rd['id'];
														$selected="";
														if($id==$grade){
															$selected="selected";
														}
														$payroll=$rd['gradename'];
														echo "<option value='$id' $selected>$payroll</option>";
													}
													while($rd=mysql_fetch_assoc($res));
												}

											?>
											</select> <a href="addupfronitems.php?id=<?php echo $upid; ?>&grade=<?php echo $grade; ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Create New Upfront Item</a><br><br>
									<?php 
									$qry="";
									if(empty($grade)){
										$qry="select * from tblupfrontitems where upfrontid=$upid";
										
									}else{
										$qry="select * from tblupfrontitems where upfrontid=$upid and gradeid=$grade";
									}
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
														<th>Grade</th>
														<th>Pay Element</th>
														<th>From</th>
														
														<th>To</th>
														
														<th></th>
													</tr>
												</thead>
												<?php 
													do{
														
													
												?>
												<tbody>
													
													<tr>
													
														<td><?php echo $ip; ?></td>
														<td><?php 
														$payid=$rd['gradeid'];
														$payrollname=returnQueryValue("select gradename from tblgrades where id=$payid ","gradename");
														echo $payrollname; ?></td>
														
														<td><?php 
														$payid=$rd['elementid'];
														$payrollname=returnQueryValue("select payelement from tblpayelement where id=$payid ","payelement");
														echo $payrollname; ?></td>
														<td><?php echo $rd['wef']; ?></td>
														<td><?php echo $rd['wet']; ?></td>
														
														
														
														<td>
													<a href="deleteupfronitem.php?id=<?php echo $ido; ?>&upid=<?php echo $upid; ?>&grade=<?php echo $grade; ?>">	<button type="button" class="btn btn-sm btn-primary waves-effect waves-light" onclick="saveGrade();"><i class="fa fa-trash"></i> Remove Item</button>
													
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
		<script type="text/javascript" src="func.js"></script>
		<script>
		var upfrontid="<?php echo $upid; ?>";
		function loadpayelementgrade(){
				var cbograde=Tvar("cbograde").value;
				if(cbograde=="0"){return;}
				window.location="upfrontitems.php?grade="+cbograde+"&id="+upfrontid;
				
			}
		
		</script>

	</body>
</html>