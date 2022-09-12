<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		$lid=@$_GET['id'];
		//echo $lid;exit;
		if(empty($lid)){
			header("location: index.php");
			exit;
		}
		
		include("header.php"); 
		
		$rdx=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lid"));
		$ltypeid=$rdx['loanid'];
		
		$minid=returnQueryValue("select min(id)minid from tblloanshedule where loanid=$lid and paid='N'","minid");
		$minid=$minid-1;
		$loanbalance=returnQueryValue("select endbalance from tblloanshedule where id=$minid","endbalance");
		
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
										<div class="card-title">Apply for Loan Topup</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
									<div class="form-group ">
										
											<label class="form-label">Loan Balance</label>
											<input type="text" class="form-control w-100" disabled value="<?php echo number_format($loanbalance,2); ?>" id="txtbalance" >
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Loan Type</label>
											
											<select class="form-control w-100" id="cboloantype" disabled onchange="getloantypedetails();">
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
														$sel="";
														if($ltypeid==$id){
															$sel="selected";
														}
														echo "<option value='$id' $sel>$payroll</option>";
													}
													while($rd=mysql_fetch_assoc($res));
												}

											?>
											
											</select>
											
											
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Duration/Tenor (Months)</label>
											<input type="number" class="form-control w-100" value="<?php echo $rdx['duration']; ?>" id="txtduration"  placeholder="Enter number of months here">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Interest Rate (%)</label>
											<input type="number" class="form-control w-100" disabled value="<?php echo $rdx['intrate']; ?>" id="txtinterest"  placeholder="Enter interest rate e.g. 5 or 10">
										</div>
										
										
									<div class="form-group ">
										
											<label class="form-label">Top up Amount </label>
											<input type="number" onblur="handle()" class="form-control w-100"  id="txtprincipal"  placeholder="Enter Loan Application Amount">
										<div id="divprincipal"></div>
										</div>
										
											<div class="form-group ">
										
											<label class="form-label">Calculation Type</label>
											
											<?php 
											$insttype=$rdx['insttype'];
											
											?>
											
											<select class="form-control w-100" id="insttype">
											
											
											<?php 
											$insttype=$rdx['insttype'];
											if($insttype=="Fixed"){
												echo "<option value='Fixed' selected>Fixed</option>";
												echo "<option value='Annuity'>Annuity</option>";
											}
											else{
												echo "<option value='Fixed'>Fixed</option>";
												echo "<option value='Annuity' selected>Annuity</option>";
											}
											?>
											
											</select>
											
											
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Repayment Start Date</label>
											<input class="form-control fc-datepicker" value="<?php echo $rdx['startdate']; ?>" id="txtstartdate" placeholder="MM/DD/YYYY" type="text">
										</div>
										
											<div class="form-group ">
										
											<label class="form-label">Applicant</label>
											<span style="font-weight:bold;">
											
											<?php 
												$empid=$rdx['empid'];
												
												echo returnQueryValue("select fullname from tblemployee where id=$empid","fullname");
											?>
											
											</span>
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Bank</label>
											<input type="text" class="form-control w-100" id="txtbank" value="<?php echo $rdx['bank']; ?>"  placeholder="Beneficary Bank">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Account No.</label>
											<input type="number" class="form-control w-100" id="txtaccno" value="<?php echo $rdx['accno']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Account Name</label>
											<input type="text" class="form-control w-100" id="txtacountname" value="<?php echo $rdx['accountname']; ?>"  placeholder="">
										</div>
								
									
									</div>
									<div class="card-footer">
									<div id="divloanresp">
									
									</div>
									<button id="btnprocess" type="button" class="btn btn-secondary waves-effect waves-light" onclick="processLoan();">Process</button>&nbsp;&nbsp;<button type="button" class="btn btn-warning waves-effect waves-light" onclick="reloadpage();">Reload</button>&nbsp;&nbsp;<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Loan</button>
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
		var lid="<?php echo $lid; ?>";
		var empid="<?php echo $empid; ?>";
		var loanbalance="<?php echo $loanbalance; ?>";
		var newprincipal=0;
			function saveGrade(){
				var tenor=Tvar("txtduration").value;
				var intrate=Tvar("txtinterest").value;
				var principal=Tvar("txtprincipal").value;
				if(principal==""){
					return;
				}
				var insttype=Tvar("insttype").value;
				var txtstartdate=Tvar("txtstartdate").value;
				var cboemployee=empid;
				if(txtstartdate==""){
					return;
				}
				
				var cboloantype=Tvar("cboloantype").value;
				if(cboloantype==""){
					return;
				}
				
					$.post("controller/utility.php", {lid:lid,cboloantype:cboloantype,cboemployee:cboemployee,tenor:tenor,intrate:intrate,principal:principal,act: 'toploanup',insttype:insttype,txtstartdate:txtstartdate },
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
			
			
		
		function reloadpage(){
				location.reload();
			}
			
			function handle(){
      
           // e.preventDefault(); // Ensure it is only this code that runs
			
			

           var txtprincipal=Tvar("txtprincipal").value;
		   var txtbalance=Tvar("txtbalance").value;
			if(txtprincipal==""){
				return;
			}
			
			if(txtprincipal=="0"){
				return;
			}
			
			newprincipal=parseFloat(txtprincipal)+parseFloat(loanbalance);
			Tvar("divprincipal").innerHTML="<b>New Loan Principal: "+newprincipal+"<b>";
			
        
    }
	
	
	function processLoan(){
				var tenor=Tvar("txtduration").value;
				var intrate=Tvar("txtinterest").value;
				var principal=newprincipal;
				if(principal==""){
					return;
				}
				var insttype=Tvar("insttype").value;
				var txtstartdate=Tvar("txtstartdate").value;
				if(txtstartdate==""){
					return;
				}
				
					$.post("controller/utility.php", {tenor:tenor,intrate:intrate,principal:newprincipal,act: 'calcloan',insttype:insttype,txtstartdate:txtstartdate },
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