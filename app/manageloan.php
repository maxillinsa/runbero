<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		
		include("header.php"); 
		
		
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Loan Management</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">
								Loans</li>
							</ol>
						</div>
						
						
							<div class="col-md-12">
							<div class="card">
									<div class="card-header">
										<div class="card-title">Running Loans</div>

									</div>
								<div class="card-body">
									<a href="addnewloan.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Running Loan</a><br><br>
									<?php 
										$qry="select * from  tblloans where compid=$compid and approved='Y'";
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
											<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" style="color:black;" >
												<thead>
													<tr>
														<th>S/N</th>
														<th>Loan No.</th>
														<th>Applicant</th>
														<th>Principal</th>
														<th>Interest Rate</th>
														<th>Repayment Amount</th>
														<th>Instalment Amount</th>
														<th>Repayment Period</th>
														<th>Duration (Months)</th>
														<th>Repayment Start Date</th>
														<th>Status</th>
														<th>Created By</th>
														<th>Documents</th>
														<th>Date Created</th>
														<th></th>
													</tr>
												</thead>
												<?php 
													do{
														
													
												?>
												<tbody>
													
													<tr>
														<td><?php echo $ip; ?></td>
														
														<td><?php echo $rd['loanno']; ?></td>
														<td><?php 
														$lid=$rd['id'];
														$minid=returnQueryValue("select min(id)mind from tblloanshedule where loanid=$lid","mind");
		$instmt=returnQueryValue("select instamount from tblloanshedule where id=$minid","instamount");
														
														$empid=$rd['empid'];
														
														//echo $rd['name'];
														$ename=returnQueryValue("select fullname from tblemployee where id=$empid","fullname");
														echo $ename;
														?></td>
														<td><?php echo number_format($rd['principal'],2); ?></td>
														<td><?php echo number_format($rd['intrate'],2); ?></td>
														<td><?php echo number_format($rd['amount'],2); ?></td>
														<td><?php echo number_format($instmt,2); ?></td>
														<td><?php echo $rd['duration']; ?></td>
														<td><?php echo $rd['duration']; ?></td>
														<td><?php echo $rd['startdate']; ?></td>
														<td><?php 
															$status=$rd['approved'];
															$signagreed=$rd['signagreed'];
															if($status=="N"){
																$status="Pending Approval";
															}else{
																$status="<b><i class=\"fa fa-check\"></i>Approved</b>";
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
														<td>
														<a href='loandoc.php?id=<?php echo $lid; ?>' target='_blank'><button class='btn btn-sm btn-primary'>Documents<i class='fa fa-file-text-o'></i></button> </a>
														</td>
														<td><?php echo $rd['ddate']; ?></td>
															<td><?php echo " <a href='loanscheduleadmin.php?id=$lid' class='btn btn-sm btn-primary' target='_blank'>View Scedule <i class='fa fa-search'></i> </a>";
															
															

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

							</div><!-- /header-text -->
								</div>
							</div>
					



							<div class="col-md-12">
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
				
				
				
				window.location="payrollreportsumarry.php?payid="+cbopayroll+"&mnt="+cbomonth+"&cboyear="+cboyear;
				
				
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