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
								<li class="breadcrumb-item active" aria-current="page">Loan Application</li>
							</ol>
						</div>


							<div class="col-md-8" id="divres">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Start New Loan</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										<div class="form-group ">
										
											<label class="form-label">Loan Type</label>
											
											<select class="form-control w-100" id="cboloantype" onchange="getloantypedetails();">
											<option value='' selected></option>
											<?php
											
												$qry="select * from  loantypes where compid=$compid";
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
										
											<label class="form-label">Duration/Tenor (Months)</label>
											<input type="number" class="form-control w-100" id="txtduration"  placeholder="Enter number of months here">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Interest Rate (%)</label>
											<input type="number" class="form-control w-100" id="txtinterest"  placeholder="Enter interest rate e.g. 5 or 10">
										</div>
										
										
									<div class="form-group ">
										
											<label class="form-label">Loan Principal</label>
											<input type="number" class="form-control w-100" id="txtprincipal"  placeholder="Enter Loan Application Amount" disabled>
										</div>
										
											<div class="form-group ">
										
											<label class="form-label">Calculation Type</label>
											
											<select class="form-control w-100" id="insttype">
											<option value='Fixed'>Fixed</option>
											<option value='Annuity'>Annuity</option>
											
											</select>
											
											
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Repayment Start Date</label>
											<input class="form-control fc-datepicker" id="txtstartdate" placeholder="MM/DD/YYYY" type="text">
										</div>
										
											<div class="form-group ">
										
											<label class="form-label">Applicant</label>
											
											<select class="form-control w-100" id="cboemployee">
											<option value='' selected></option>
											<?php
											
												$qry="select * from  tblemployee where compid=$compid";
												$res=mysql_query($qry);
												$nm=mysql_num_rows($res);
												if($nm>0){
													$rd=mysql_fetch_assoc($res);
													do{
														$id=$rd['id'];
														$payroll=$rd['fullname'];
														$staffid=$rd['staffid'];
														echo "<option value='$id'>$payroll - $staffid</option>";
													}
													while($rd=mysql_fetch_assoc($res));
												}

											?>
											
											</select>
											
											
										</div>
								
									
									</div>
									<div class="card-footer">
									<div id="divloanresp">
									
									</div>
									<button id="btnprocess" type="button" class="btn btn-secondary waves-effect waves-light" onclick="processLoan();" disabled>Process</button>&nbsp;&nbsp;<button type="button" class="btn btn-warning waves-effect waves-light" onclick="saveGrade();">Reload</button>&nbsp;&nbsp;<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save and Start Loan</button>&nbsp;&nbsp;<a href='manageloan.php'><button type="button" class="btn btn-red waves-effect waves-light">Cancel</button></a>
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
		<script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
		<script src="../assets/plugins/time-picker/toggles.min.js"></script>
		<!-- Data tables -->
		<script src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="../assets/js/datatable.js"></script>

		<!-- Datepicker js -->
		<script src="../assets/plugins/date-picker/spectrum.js"></script>
		<script src="../assets/plugins/date-picker/jquery-ui.js"></script>
		<script src="../assets/plugins/input-mask/jquery.maskedinput.js"></script>

		<!-- Inline js -->
		<script src="../assets/js/select2.js"></script>
		<script src="../assets/js/formelements.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!-- ECharts Plugin -->
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/js/index1.js"></script>

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
			function saveGrade(){
				var tenor=Tvar("txtduration").value;
				var intrate=Tvar("txtinterest").value;
				var principal=Tvar("txtprincipal").value;
				if(principal==""){
					return;
				}
				var insttype=Tvar("insttype").value;
				var txtstartdate=Tvar("txtstartdate").value;
				var cboemployee=Tvar("cboemployee").value;
				if(txtstartdate==""){
					return;
				}
				
				var cboloantype=Tvar("cboloantype").value;
				if(cboloantype==""){
					return;
				}
				
					$.post("controller/utility.php", {cboloantype:cboloantype,cboemployee:cboemployee,tenor:tenor,intrate:intrate,principal:principal,act: 'saveloan',insttype:insttype,txtstartdate:txtstartdate },
						   function (data) {

							   if (data.length > 0) {
								   								   
								 // alert(data);
								//  Tvar("divloanresp").innerHTML=data;
								if(data=="1"){
									Tvar("divres").innerHTML="<p style='font-size:30px;'><i class=\"fa fa-check\"></i> Loan Successfully Applied</p>";
									Tvar("divres").innerHTML+="<p><a href='manageloan.php'>Click here to continue.</a></p>";
								}
								 
							   }

							});
				
			}
			
			function getloantypedetails(){
				 Tvar("txtduration").value="";
				Tvar("txtinterest").value="";
				Tvar("txtprincipal").disabled=true;
				Tvar("btnprocess").disabled=true;
				
				var cboloantype=Tvar("cboloantype").value;
				if(cboloantype==""){
					return;
				}
				 
				$.post("controller/utility.php", {cboloantype:cboloantype,act: 'getloantypedetails'},
						   function (data) {

							   if (data.length > 0) {
								   								   
								   var sp=data.split("|");
								   duration=sp[0];
								   intrate=sp[1];
								   Tvar("txtduration").value=duration;
								   Tvar("txtinterest").value=intrate;
								   Tvar("txtprincipal").disabled=false;
								 Tvar("btnprocess").disabled=false;
								 
							   }

							});
							
				
				
			}
			
			function processLoan(){
				var tenor=Tvar("txtduration").value;
				var intrate=Tvar("txtinterest").value;
				var principal=Tvar("txtprincipal").value;
				if(principal==""){
					return;
				}
				var insttype=Tvar("insttype").value;
				var txtstartdate=Tvar("txtstartdate").value;
				if(txtstartdate==""){
					return;
				}
				
					$.post("controller/utility.php", {tenor:tenor,intrate:intrate,principal:principal,act: 'calcloan',insttype:insttype,txtstartdate:txtstartdate },
						   function (data) {

							   if (data.length > 0) {
								   								   
								  //alert(data);
								  Tvar("divloanresp").innerHTML=data;
								 
							   }

							});
							
			}
		
		
		</script>

	</body>
</html>