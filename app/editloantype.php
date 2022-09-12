<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		$ltid=@$_GET['id'];
		if(empty($ltid)){
			header("location: index.php");exit;
		}
		
		include("header.php"); 
		
		$rd=mysql_fetch_assoc(mysql_query("select * from loantypes where id=$ltid"));
		$lname=$rd['name'];
		$condition=$rd['conditions'];
		$maxamount=$rd['maxamount'];
		$duration=$rd['duration'];
		$intrate=$rd['intrate'];
		$advertise=$rd['advertise'];
		$paymentgateway=$rd['paymentgateway'];
		$sm="";
		if($advertise=="Y"){
			$sm="checked";
		}
		$pg="";
		if($paymentgateway=="Y"){
			$pg="checked";
		}
		
		
		if(empty($condition)){
			$condition.="<p><font size='5' color='#008C22'><center>$cname ".$lname."</center></font></p><br>";
			$condition.="<p>".$cname." has a fantastic offer to help meet your financial need.</p><br>";
			$condition.="<p>We now give as much as N".number_format($maxamount,2)." for as long as ".$duration." months at interest rate of ".$intrate."%. Also, our array of product also covers features of BUYOVER of existing facilities except bank loans.</p><br>";
			$condition.="<p><b>You need following documents for you to obtain the loan:</b></p><br>";
			$condition.="<p>&bull; Utility bill not older than 3 months with your current address on it.</p>";
			$condition.="<p>&bull; A mail trail of your updated bank statement sent by your bank.</p>";
			$condition.="<p>&bull; A recent passport photograph.</p>";
			$condition.="<p>&bull; A valid means of Identification (Driver’s License, International passport or National identity card)/voters card.</p>";
			$condition.="<p>&bull; Staff identity card.</p>";
			$condition.="<p>&bull; Letter of appointment or letter of promotion.</p>";
		}
		 
		
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Loan Management</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Loans</li>
							</ol>
						</div>


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Edit Loan Type</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										<div class="form-group ">
										
											<label class="form-label">Loan Description</label>
											<input type="text" class="form-control w-100" id="txttype" value="<?php echo $rd['name']; ?>"  placeholder="Enter type here">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Duration/Tenor (Months)</label>
											<input type="number" class="form-control w-100" id="txtduration" value="<?php echo $rd['duration']; ?>"  placeholder="Enter number of months here">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Interest Rate (%)</label>
											<input type="number" class="form-control w-100" id="txtinterest"  value="<?php echo $rd['intrate']; ?>"  placeholder="Enter interest rate e.g. 5 or 10">
										</div>
										
										
										<div class="form-group ">
										
											<label class="form-label">Maximum Amount</label>
											<input type="number" class="form-control w-100" id="txtmax" value="<?php echo $rd['maxamount']; ?>"  placeholder="Enter Maximum loanable amount">
										</div>
										
										
									<div class="card">
									<div class="card-header">
										<div class="card-title">Loan Description/Terms and Condition</div>

									</div>
									<div class="card-body">
										<textarea class="content" name="example" id="txtadvert"><?php echo stripslashes($condition); ?></textarea>
									</div>
								</div>
							
								<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="chkagreed" <?php echo $sm; ?> disabled>
											<span class="custom-control-label text-dark">I want to advertise this Loan on Runbero Loan Market</span>
										</label>
								
								<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="pgate" <?php echo $pg; ?> disabled>
											<span class="custom-control-label text-dark">Use Runbero Payment Gateway for Loan Recovery</span>
										</label>
								
									
									</div>
									
									
									
									</div>
									<div class="card-footer">
										<center><button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Save Update</button>&nbsp;&nbsp;<a href='loantypes.php'><button type="button" class="btn btn-red waves-effect waves-light">Cancel</button></a></center>
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
		<script src="../assets/plugins/wysiwyag/jquery.richtext.js"></script>
		<script src="../assets/js/formeditor.js"></script>

		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		
			var ltid="<?php echo $ltid; ?>";
		
			function saveGrade(){
				//txttype,txtduration,txtinterest
				var txttype=Tvar("txttype").value;
				var txtduration=Tvar("txtduration").value;
				var txtinterest=Tvar("txtinterest").value;
				var txtadvert=Tvar("txtadvert").value;
				var txtmax=Tvar("txtmax").value;
				//paymentgateway
				var advloan="N";
				var pgateway="N";
				var chkagreed = document.getElementById('chkagreed').checked;
				if(chkagreed==true){
					advloan="Y";
				}
				var pgate = document.getElementById('pgate').checked;
				if(pgate==true){
					pgateway="Y";
				}
				if(txttype==""){
					return
				}
				
				if(txtduration==""){
					return
				}
				if(txtduration=="0"){
					return
				}
				
				if(txtinterest==""){
					return
				}
				
				
				
						$.post("controller/utility.php", {pgateway:pgateway,advloan:advloan,txttype:txttype,act: 'editloantype',txtduration: txtduration,txtinterest: txtinterest,ltid: ltid,txtadvert: txtadvert, txtmax:txtmax},
						   function (data) {

							   if (data.length > 0) {
								   
								 //alert(data);
								
							
								   
								   
								   if(data=="1"){
									//Tvar("registerpanel").innerHTML="<div style='font-size:30px;'>Registration Successful.<br><span style='font-size:20px;'>Welcome to FBNInvex!</span><br><br><br><a href='login.php?refid="+refid+"'>Click here to Login</a></div><br><br><br><br><br><br><br><br><br><br>";
									window.location="loantypes.php";
									//return;
									//alert(data);
									//tSuccess("Invite sent");
								}
								   
								  								   
								   
							   }

							});
							
							//Terror(errdetails,diva)
				
			}
		
		
		</script>

	</body>
</html>