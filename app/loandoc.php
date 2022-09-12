<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		$lnid=@$_GET['id'];
		if(empty($lnid)){
			header("location: index.php");exit;
		}
		
		include("header.php"); ?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Loans</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Loan Management</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-10">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><?php 
									
									$rd=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lnid"));
											$lntid=$rd['loanid'];
											$loantype=returnQueryValue("select name from loantypes where id=$lntid","name");
											echo "'".$loantype."' Documents ";
									?> <i class='fa fa-file-text-o'></i></div>

									</div>
									
									<div class="card-body">
								
									
									
									
												
											
											<?php 
										$qry="select * from loandoc where loanid=$lnid order by id desc";
									//	echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$rd=mysql_fetch_assoc($res);
											do{
											$ip=1;
											$ido=$rd['id'];
											$createdby=$rd['createdby'];
											$furl="loandoc/".$rd['filname'];
											//echo "select payroll from tblrunlog where id=$ido";
									
									
									?>
									
									<div class="table-responsive">
													<table class="table table-inbox table-hover">
														<tbody>
														<?php 
														echo "<tr class=\"unread\">";
														echo "<td class=\"inbox-small-cells\"><i class=\"fa fa-star inbox-started\"></i></td>";
														
														echo "<td class=\"view-message  dont-show\">".$rd['purpose']."</td>";
														$cname=returnQueryValue("select fullname from tblusers where id=$createdby","fullname");
														echo "<td class=\"view-message  dont-show\">Uploaded by: $cname</td>";
														
														echo "<td class=\"view-message \"><strong>Uploaded Date: </strong>".$rd['ddate']."</td>";
														
														echo "<td class=\"view-message  text-right\"><a href='$furl'>Download <i class='fa fa-arrow-down'></i></></td>";
														echo "</tr>";
														?>
														
															
													
													</table>
													
													<?php 
												
												$ip=$ip+1;
													}
													while($rd=mysql_fetch_assoc($res));
										}
											
												?>

												</div>
												
												
												
												
										</div>
										</div>
										
										<div class="col-md-12 col-lg-6">
										<div class="card">
									<div class="card-header">
										<div class="card-title">New Upload <i class='fa fa-mail-reply'></i></div>

									</div>
										
										<div class="card-body">
											<form action="upload.php?lnid=<?php echo $lnid; ?>" method="post" enctype="multipart/form-data">
											<div class="form-group " style="display:none;">
											
												<label class="form-label">Document Purpose or Description</label>
												<input type="text" class="form-control w-100" name="txtlid" id="txtlid" value="<?php echo $lnid; ?>"  placeholder="">
											</div>
											
											<div class="form-group ">
											
												<label class="form-label">Document Purpose or Description</label>
												<input type="text" class="form-control w-100" name="txtpurpose" id="txtpurpose"  placeholder="" required>
											</div>
											
														<div class="form-group ">
											<label class="form-label">New Document</label>
															<input type="file" id="fileToUpload" name="fileToUpload" required>
															
														</div>
														
													<center>	<input type="submit" class='btn btn-sm btn-primary' value="Upload Document" name="submit"></center>
											</form>
										</div>
										</div>
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