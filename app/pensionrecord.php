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
								Pension</li>
							</ol>
						</div>


							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Pension Record</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
									
									
									
										<div class="form-group ">
										
											<label class="form-label">Payroll</label>
											
											<select class="form-control w-100" id="cbopayroll">
											<option value='' selected></option>
											<?php
											
												$qry="select * from tblpayroll where compid=$compid";
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
										
											<div class="form-group ">
										
											<label class="form-label">From</label>
											<input class="form-control fc-datepicker" id="txtfrom" placeholder="MM/DD/YYYY" type="text">
										</div>
										
										
											<div class="form-group ">
										
											<label class="form-label">To</label>
											<input class="form-control fc-datepicker" id="txtto" placeholder="MM/DD/YYYY" type="text">
										</div>
										
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">View Record <i class="fa fa-angle-double-right"></i></button>
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

	
		<script src="../assets/plugins/chart/Chart.bundle.js"></script>
		<script src="../assets/plugins/chart/utils.js"></script>
		<script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
		<script src="../assets/plugins/time-picker/toggles.min.js"></script>
		<!-- Data tables -->
		

		<!-- Datepicker js -->
		<script src="../assets/plugins/date-picker/spectrum.js"></script>
		<script src="../assets/plugins/date-picker/jquery-ui.js"></script>
		<script src="../assets/plugins/input-mask/jquery.maskedinput.js"></script>

		<!-- Inline js -->
		<script src="../assets/js/select2.js"></script>
		<script src="../assets/js/formelements.js"></script>

		<script src="../assets/js/index1.js"></script>

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
			function saveGrade(){
				//cbopayroll,cbograde
				var cbopayroll=Tvar("cbopayroll").value;
				var txtfrom=Tvar("txtfrom").value;
				var txtto=Tvar("txtto").value;
				
				
				if(txtfrom==""){
					return
				}
				
				if(txtto==""){
					return
				}
				
				window.location="viewpensionrecord.php?payid="+cbopayroll+"&txtfrom="+txtfrom+"&txtto="+txtto;
				
				
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