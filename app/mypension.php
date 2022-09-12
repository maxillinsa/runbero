<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		$payid=@$_GET['payid'];
		$txtfrom=@$_GET['txtfrom'];
		$txtto=@$_GET['txtto'];
		$txtfrom=date('Y-m-d', strtotime($txtfrom));
		
		$txtto=date('Y-m-d', strtotime($txtto));
		include("header.php"); 
		
		$cemail=returnQueryValue("select email from tblusers where id=$curuserid","email");
		$empid=returnQueryValue("select id from tblemployee where email='$cemail'","id");
				
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Pension</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Pension Record</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-10">
								<div class="card">
									<div class="card-header">
										<div class="card-title">
									
									<i class='fa fa-file-text-o'></i></div>

									</div>
									
									<div class="card-body">
								
									<?php //echo "<a href='exporttax.php?payid=$payid&txtfrom=$txtfrom&txtto=$txtto' >"; ?><button type="button" class="btn btn-sm btn-secondary mr-2"><i class="fa fa-file-excel-o"></i> Export to Excel</button></a>
									<br>
									
									
												
											
											<?php 
										$qry="select tblrunlogitems.empid,tblrunlogitems.amount,payitemname from tblrunlogitems,tblpayelement,tblrunlog where tblpayelement.id=pelementid and tblpayelement.crita in ('PENS') and tblrunlog.id=tblrunlogitems.logid and tblrunlog.approved='Y' and 
										tblrunlogitems.transdate between '$txtfrom' and '$txtto' and tblrunlogitems.empid =$empid

union 

select tblrunlogitemsup.empid,tblrunlogitemsup.amount,payitemname from tblrunlogitemsup,tblpayelement,tblrunlogup where tblpayelement.id=pelementid and tblpayelement.crita in ('PENS') and tblrunlogup.id=tblrunlogitemsup.logid and tblrunlogup.approved='Y' 
and tblrunlogup.transdate between '$txtfrom' and '$txtto'  and tblrunlogitemsup.empid =$empid order by empid";
										//echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$rd=mysql_fetch_assoc($res);
											do{
											$ip=1;
											$empid=$rd['empid'];
											$amount=$rd['amount'];
											$payitemname=$rd['payitemname'];
											$fullname=returnQueryValue("select fullname from tblemployee where id=$empid","fullname");
									
									
									?>
									
									<div class="table-responsive">
													<table class="table table-inbox table-hover">
													<thead>
													<th>
													Member Name
													</th>
													
													<th>
													Tax Pay Element
													</th>
													
													<th>
													Amount
													</th>
													</thead>
														<tbody>
														<?php 
														echo "<tr class=\"unread\">";
														echo "<td class=\"inbox-small-cells\">$fullname</td>";
														
														
														
														echo "<td class=\"view-message  dont-show\">$payitemname</td>";
														
														echo "<td class=\"view-message \">".number_format($amount,2)."</td>";
														
														//echo "<td class=\"view-message  text-right\"><a href='$furl'>Download <i class='fa fa-arrow-down'></i></></td>";
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