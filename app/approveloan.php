<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php include("header.php"); 
		
		
		$lnid=@$_GET['id'];
		if(empty($lnid)){
			header("location: index.php");
			exit;
		}
		$rd=mysql_fetch_assoc(mysql_query("select * from tblloans where id=$lnid"));
		$empid=$rd['empid'];
		$loanid=$rd['loanid'];
		$duration=$rd['duration'];
		$lamount=$rd['amount'];
		$principal=$rd['principal'];
		$interest=$rd['interest'];
		$intrate=$rd['intrate'];
		$startdate=$rd['startdate'];
		$signagreed=$rd['signagreed'];
		$approved=$rd['approved'];
		
		$minid=returnQueryValue("select min(id)mind from tblloanshedule where loanid=$lnid","mind");
		$instmt=returnQueryValue("select instamount from tblloanshedule where id=$minid","instamount");
		
		$loanname=returnQueryValue("select name from loantypes where id=$loanid","name");
		
		$rdlnd=mysql_fetch_assoc(mysql_query("select * from tblemployee where id=$empid"));
		$elname=$rdlnd['fullname'];
		$eltel=$rdlnd['telephone'];
		$elemail=$rdlnd['email'];
		$laddress=$rdlnd['address'];
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Loan</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Loan Agreement</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Request Loan Agreement</div>

									</div>
									
									<div class="card-body" id="divassign">
									
									<?php 
								//	$clogo=str_replace("data:","",$clogo);
									//echo $clogo;
										echo "<img src='docs/$clogo' style='height:120px;width:150px;'><br>";
										echo "<span style='font-size:15px;'>".$alladdress."</span><br>";
										echo "<span style='font-size:15px;'><i class='fa fa-phone-square'></i> ".$ltelephone."</span><br>";
										echo "<span style='font-size:15px;'><i class='fa fa-envelope-o'></i>".$lemail."</span><br>";
										
										
										echo "<span style='font-size:20px;'><br><u>Loan Applicant</u></span><br>";
										echo "<span style='font-size:15px;'>".$elname."</span><br>";
										echo "<span style='font-size:15px;'>".$laddress."</span><br>";
										
										echo "<span style='font-size:15px;'>".$eltel."</span><br>";
										echo "<span style='font-size:15px;'>".$elemail."</span><br>";
										
										$todaysdate=date("l jS \of F Y h:i:s A");
										echo "<br><span style='font-size:12px;'>".$todaysdate."</span>";
										$ddate=date("l jS \of F Y");
										
									?>
									
								<br><br>	<span style="font-size:30px;"><center><?php echo "'".$loanname."' "; ?> Agreement</center></span>
									
									<?php 
										echo "<hr>";
										
										echo "This loan agreement is made and will be effective on <b><u>$ddate</u></b><br>";
										
										echo "<b>BETWEEN</b><br>";
										echo "<b><u>$elname</u></b> hereinafter reffered to as the \"<b>Burrower</b>\" with a street address of <b><u>$laddress</u></b><br>";
										echo "<b>AND</b><br>";
										echo "<b><u>$cname</u></b> hereinafter reffered to as \"<b>Lender</b>\" with a street address of  <b><u>$longaddress</u></b>";
										
									
									
									?>
									
									<br><br><br><span style="font-size:20px;FONT-WEIGHT:bold;"><center>Terms and Agreement</center></span><hr>
									
									<?php 
										
										echo "Within $duration months from today, Burrower promises to pay the Lender ".number_format($principal,2). " and interest as well as other charges as avowed below:";
										
										echo "<b><br><br>Liabilty</b><br><br>";
										
										echo "Althought this agreement may be (electronically) signed by more than one person, each of the undersigned that they are each as individuals responsible and jointly and severally liable for paying back the full amount.<br><br>";
										
										echo "<b>Details of Loan: Agreed between Burrower and Lender</b><br><br>";
										
										echo "Amount of Loan: <b>".number_format($principal,2)."</b><br>";
										echo "Interest: <b>".number_format($interest,2)."</b><br>";
										echo "Total of Payment: <b>".number_format($lamount,2)."</b><br>";
										echo "ANNUAL PERCENTAGE RATE: <b>".number_format($intrate,2)."</b><br>";
										
										echo "<b><br><br>Repayment of Loan</b><br><br>";
										
										echo "Burrower will pay back in the following manner: Burrow will repay the amount of this note in $duration continuous installments of ".number_format($instmt,2)."
										starting from $startdate<br><br>";
										?>
									
									
									<div class="card-body">
									
									<?php 
										$qry="select * from tblloanshedule where loanid=$lnid order by id asc";
									//	echo $qry;
										$res=mysql_query($qry);
										$nm=mysql_num_rows($res);
										if($nm<1){
											echo "No record found";
										}else{
											$rd=mysql_fetch_assoc($res);
											$ip=1;
											
											$minid=returnQueryValue("select min(id)minid from tblloanshedule where loanid=$lnid and paid='N'","minid");
									
									
									?>
										<div class="table-responsive">
											<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" >
												<thead>
													<tr>
													<th>SN</th>
														<th>Payment Date</th>
														<th>Beginning Balance</th>
														<th>Instalment Amount</th>
														<th>Interest</th>
														<th>Closing Balance</th>
														
														
													</tr>
												</thead>
												<?php 
													do{
														
													
												?>
												<tbody>
													
													<tr>
														<td><?php echo $ip;
														$repid=$rd['id'];
														
														?></td>
														<td><?php echo $rd['paymentdate']; ?></td>
														<td><?php echo number_format($rd['begbalance'],2); ?></td>
														<td><?php echo number_format($rd['instamount'],2); ?></td>
														<td><?php echo number_format($rd['interest'],2); ?></td>
														<td><?php echo number_format($rd['endbalance'],2); ?></td>
													
														
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
										<br>
										<?php
										//echo $signagreed;
										if($approved=="Y"){}else{ ?>
										<p><center><a href="javascript:sendagreement();" class="btn btn-primary"> <i class="fa fa-legal"></i> Approve Loan</a></center></p>
									
									<?php 
												
											
										}
												
												?>
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
		var lnid="<?php echo $lnid; ?>";
		
			function sendagreement(){
				
				
					$.post("controller/utility.php", {act: 'approveloan',lnid:lnid},
						   function (data) {

							   if (data.length > 0) {
								   
								   //alert(data);
								   
								 Tvar("divassign").innerHTML= "<h3 class='card-title' style='font-size:30px;'><i class='fa fa-paper-plane fa-lg' style='color:green;'></i> Loan Approved Successfully</h3><br>";
								  								   
								   
							   }

							});
							
							//Terror(errdetails,diva)
				
			}
		
		
		</script>

	</body>
</html>