<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		
		include("header.php"); 
		
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Payroll</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">
								Setup Pay Element</li>
							</ol>
						</div>


							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Payroll Summary</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
									
									
									<i class="fa fa-warning"></i> Select <b>Payroll Project</b> criterials <b>to</b> view.<br><br>
										<div class="form-group ">
										
											<label class="form-label">Payroll</label>
											
											<select class="form-control w-100" id="cbopayroll">
											<option value='' selected></option>
											<?php
											
												$qry="select * from tblpayroll where compid=$compid and active='Y'";
												$res=mysql_query($qry);
												$nm=mysql_num_rows($res);
												if($nm>0){
													$rd=mysql_fetch_assoc($res);
													do{
														$id=$rd['id'];
														$payroll=$rd['name'];
														echo "<option value='$id'>$payroll</option>";
													}
													while($rd=mysql_fetch_assoc($res));
												}

											?>
											
											</select>
											
											
										</div>
										
																			
										
										<div class="form-group">
										<label class="form-label">Month</label>
											<select class="form-control" id="cbomonth" name="cbomonth">
															<option value="1">January</option>
															<option value="2">February</option>
															<option value="3">March</option>
															<option value="4">April</option>
															<option value="5">May</option>
															<option value="6">June</option>
															<option value="7">July</option>
															<option value="8">August</option>
															<option value="9">September</option>
															<option value="10">October</option>
															<option value="11">November</option>
															<option value="12">December</option>
															</select>
										</div>
										
											<div class="form-group">
										<label class="form-label">Year</label>
											<select class="form-control" id="cboyear" name="cboyear">
															
															<option value="2021">2021</option>
															<option value="2022">2022</option>
															<option value="2023">2023</option>
															<option value="2024">2024</option>
															<option value="2025">2025</option>
															<option value="2026">2026</option>
															
															</select>
										</div>
								
								
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();"> <i class="fa fa-search"></i> View <i class="fa fa-angle-double-right"></i></button>
									</div>
									
									<div class="table-responsive" id="divres" style="padding-left:4%;">
									
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

		<script src="../assets/js/index1.js"></script>

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
			function saveGrade(){
				//cbopayroll,cbomonth,cboyear
				var cbopayroll=Tvar("cbopayroll").value;
				var cbomonth=Tvar("cbomonth").value;
				var cboyear=Tvar("cboyear").value;
				
				if(cbopayroll==""){
					return
				}
				
				
				
				window.location="upfrontreportsumarry.php?payid="+cbopayroll+"&mnt="+cbomonth+"&cboyear="+cboyear;
				
				
			}
			
			function loadByPayRoll(){
				
				var cbopayroll=Tvar("cbopayroll").value;
				var cbograde=Tvar("cbograde").value;
				
				if(cbopayroll==""){
					return;
				}
				
				if(cbograde==""){
					
					
				}else{
					if(cbopayroll==""){
						return;
					}
				}
				
				$.post("controller/utility.php", {act: 'loadpayelementtable', cbopayroll: cbopayroll,cbograde:cbograde},
						   function (data) {

							   if (data.length > 0) {
								   
								// alert(data);
								
								Tvar("divres").innerHTML=data;
								  								   
								   
							   }

							});
				
			}
		
		
		</script>

	</body>
</html>