<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		
		
		include("header.php"); 
		
		$rd=mysql_fetch_assoc(mysql_query("select * from tblcompany where id=$compid"));
							//$fdate=$rd['rundate'];
							
							$smail=$rd['sendmail'];
							$sm="";
							if($smail=="Y"){
								$sm="checked";
							}
							
				
							
		
		
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						


							<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Settings</div>
									</div>
									<div class="card-body">
									<span id="diva"></span>
										<div class="form-group ">
										
											<label class="form-label">Organization Name</label>
											<input type="text" class="form-control w-100" id="txtorgname" value="<?php echo $rd['name']; ?>"  placeholder="" disabled>
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Address Line 1</label>
											<input type="text" class="form-control w-100" id="txtaddress1" value="<?php echo $rd['address1']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Address Line 2</label>
											<input type="text" class="form-control w-100" id="txtaddress2" value="<?php echo $rd['address2']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Address Line 3</label>
											<input type="text" class="form-control w-100" id="txtaddress3"  value="<?php echo $rd['address3']; ?>" placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Email</label>
											<input type="text" disabled class="form-control w-100" id="txtemail" value="<?php echo $rd['email']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Telephone</label>
											<input type="text" class="form-control w-100" id="txttel" value="<?php echo $rd['telephone']; ?>"  placeholder="">
										</div>
										
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="chkagreed" <?php echo $sm; ?>>
											<span class="custom-control-label text-dark">Enable Email Notifications</span>
										</label>
										
										<div class="form-group ">
										<label class="form-label">Company Logo</label>
														<input type="file" capture=camera accept="image/*" id="logofile" >
														
													</div>
													<img src="<?php echo "docs/".$rd['logostring']; ?>" style="height:100px;width:100px;" />
										
										
										
										<div class="form-group ">
										
											<label class="form-label">Application URL</label>
											<input type="text" class="form-control w-100" id="txturl" value="<?php echo $rd['appurl']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Mail SMTP Address</label>
											<input type="text" class="form-control w-100" id="txtsmtp" value="<?php echo $rd['smtp']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Mail Username</label>
											<input type="text" class="form-control w-100" id="txtusername" value="<?php echo $rd['smtpusername']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">Mail Password</label>
											<input type="text" class="form-control w-100" id="txtpass" value="<?php echo $rd['smtppassword']; ?>"  placeholder="">
										</div>
										
										<div class="form-group ">
										
											<label class="form-label">SMTP Port</label>
											<input type="number" class="form-control w-100" id="txtport" value="<?php echo $rd['smtpport']; ?>"  placeholder="">
										</div>
									
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveGrade();">Update Parameters</button>
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
		<script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
		<script src="../assets/plugins/time-picker/toggles.min.js"></script>
		<!-- Data tables -->
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/plugins/echarts/echarts.js"></script>
		
	<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/plugins/echarts/echarts.js"></script>
		<script src="../assets/js/index1.js"></script>
		
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
<script src="../assets/js/apprise-1.5.full.js"></script>
		<!-- Custom Js-->
		<script src="../assets/js/admin-custom.js"></script>
		<script type="text/javascript" src="func.js"></script>
		
		<script>
		//apprise("hellow");
		  var imgdatax = "";
            var imgdatax2 = "";
			var logofilename="";
			function saveGrade(){
				//txtaddress1,txtemail,txttel
				var txtaddress1=Tvar("txtaddress1").value;
				var txtaddress2=Tvar("txtaddress2").value;
				var txtaddress3=Tvar("txtaddress3").value;
				var txtemail=Tvar("txtemail").value;
				var txttel=Tvar("txttel").value;
				var txtpass=Tvar("txtpass").value;
				var txtusername=Tvar("txtusername").value;
				var txtsmtp=Tvar("txtsmtp").value;
				var txtport=Tvar("txtport").value;
				
				var txturl=Tvar("txturl").value;
				
				var sendmail="N";
				
				var chkagreed = document.getElementById('chkagreed').checked;
				if(chkagreed==true){
					sendmail="Y";
				}
				
				
				if(txtaddress1==""){
					apprise("<font color='red'>ERROR:</font> Address is required");
						return;
					
				}
				
				
				
				if(txtemail==""){
					apprise("<font color='red'>ERROR: </font> Email is required");
						return;
				}
				
				
				
				
						$.post("controller/utility.php", {txturl:txturl,txtport:txtport,txtsmtp:txtsmtp,txtusername:txtusername,txtpass:txtpass,sendmail:sendmail,logofilename:logofilename,imgdatax2:imgdatax2,txtemail:txtemail,txttel:txttel,act: 'updatedcompany',txtaddress1:txtaddress1,txtaddress2:txtaddress2,txtaddress3:txtaddress3},
						   function (data) {

							   if (data.length > 0) {
								   
								//  alert(data);
								
								apprise("Record updated");
								   
								  								   
								   
							   }

							});
							
							//Terror(errdetails,diva)
				
			}
			
			
			document.getElementById('logofile').addEventListener('change', handleFileSelect, false);

          


            function handleFileSelect(evt) {
				//alert(document.getElementById('logofile').value)
                var files = evt.target.files; // FileList object

                // Loop through the FileList and render image files as thumbnails.
                for (var i = 0, f; f = files[i]; i++) {

                    // Only process image files.
                    if (!f.type.match('image.*')) {
                        continue;
                    }

                    var reader = new FileReader();

                    // Closure to capture the file information.
                    reader.onload = (function (theFile) {
                        return function (e) {
                            // Render thumbnail.
                            var span = document.createElement('span');
                            span.innerHTML = ['<img class="thumber" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
							logofilename=escape(theFile.name);
						//	alert(logofilename);
                          //  document.getElementById('list').innerHTML = "";
                            imgdatax2 = e.target.result;
                           // document.getElementById('list').insertBefore(span, null);
                            // var filename = e.target.files[0];
                            // document.write(imgdata)
                            //  localStorage.setItem('filerx', imgdatax);
                            // localStorage.setItem('filerx2', imgdatax2);

                            //  picurl = e.target.result;
							//alert(imgdatax2);
                        };
                    })(f);

                    // Read in the image file as a data URL.
                    reader.readAsDataURL(f);
                }
                // alert(picurl);

            }

		
		
		</script>

	</body>
</html>