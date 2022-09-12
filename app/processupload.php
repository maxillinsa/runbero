<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<?php 
		$dd = date('Y-m-d');
		
	include 'excel_reader.php';    

	$fname=$_GET['fname'];
	$userid=@$_GET['userid'];



	$op=$_GET['op'];
	$excel = new PhpExcelReader;
	@$excel->read("tmpupload/".$fname);
			
		include("header.php");
$smailparam=returnQueryValue("select sendmail from tblcompany where id=$compid","sendmail");
//echo $compid."ppppp";exit;
		?>

				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Member Data Upload</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Member</li>
							</ol>
						</div>

						
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Preview Excel Data before Upload</div>

									</div>
									
									<div class="card-body">
									<?php


// Excel file data is stored in $sheets property, an Array of worksheets
/*
The data is stored in 'cells' and the meta-data is stored in an array called 'cellsInfo'

Example (firt_sheet - index 0, second_sheet - index 1, ...):

$sheets[0]  -->  'cells'  -->  row --> column --> Interpreted value
         -->  'cellsInfo' --> row --> column --> 'type' (Can be 'date', 'number', or 'unknown')
                                            --> 'raw' (The raw data that Excel stores for that data cell)
*/

// this function creates and returns a HTML table with excel rows and columns data
// Parameter - array with excel worksheet data
function sheetData($sheet,$compid) {
	
    $re = '<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" ><thead>';     // starts html table
 $re.="<th>Member ID/NO</th><th>Full Name</th><th>Email</th><th>Telephone</th><th>Grade</th><th>Address</th></thead><tbody>";

  $x = 2;
  $error="";
  while($x <= $sheet['numRows']) {
	  
    $re .= "<tr>\n";
    $y = 1;
	
	$staffid=@$sheet['cells'][$x][1]; //Staff Id No. 
	$fullname=@$sheet['cells'][$x][2]; //Staff Id No. 
	$email=@$sheet['cells'][$x][3]; //Staff Id No. 
	$telephone=@$sheet['cells'][$x][4]; //Staff Id No. 
	$grade=@$sheet['cells'][$x][5]; //Staff Id No. 
	$address=@$sheet['cells'][$x][6]; //Staff Id No. 
	
	if(empty($staffid)){
		$re .= " <td><span style='color:red;'>Member ID/NO. is missing</td>\n";
		$error="Staff ID/NO. is missing";
	}else{
		//echo "select * from tblemployee where compid=$compid and staffid='$staffid'";
		$rnm=recNum("select * from tblemployee where compid=$compid and staffid='$staffid'");
				if($rnm>0){
					$re .= " <td><span style='color:red;'>Member ID/NO. is already in use</td>\n";
		$error="Member ID NO is already in use";
				}else{
					$re .= " <td>$staffid</td>\n";
				}
		
	}
	
	if(empty($fullname)){
		$re .= " <td><span style='color:red;'>Staff Full Name is missing</td>\n";
		$error="Member fullname is missing";
	}else{
		$re .= " <td>$fullname</td>\n";
	}
	
	
	if(empty($email)){
		$re .= " <td><span style='color:red;'>Member Email is missing</td>\n";
		$error="Member Email is missing";
	}else{
		$rnm=recNum("select * from tblemployee where compid=$compid and email='$email'");
				if($rnm>0){
					$re .= " <td><span style='color:red;'>Member email is already in use</td>\n";
		$error="Member email is already in use";
				}else{
					$re .= " <td>$email</td>\n";
				}
		
	}
	
	if(empty($telephone)){
		$re .= " <td><span style='color:red;'>Member Email is missing</td>\n";
		$error="Member Telephone is missing";
	}else{
		$rnm=recNum("select * from tblemployee where compid=$compid and telephone='$telephone'");
				if($rnm>0){
					$re .= " <td><span style='color:red;'>Member Telephone is already in use</td>\n";
		$error="Member Telephone is already in use";
				}else{
					$re .= " <td>$telephone</td>\n";
				}
		
	}
	
		if(empty($grade)){
		$re .= " <td><span style='color:red;'>Member Category is missing</td>\n";
		$error="Member Category is missing";
	}else{
		$rnm=recNum("select * from tblgrades where compid=$compid and gradename = '$grade'");
				if($rnm<1){
					$re .= " <td><span style='color:red;'>Member Category not recognized.<br>Please check Member <a hre='grades.php'>Category definition</a> to see what you defined. </td>\n";
		$error="Member Category not recognized";
				}else{
					
					$re .= " <td>$grade</td>\n";
				}
			}
			
			
	if(empty($address)){
		$re .= " <td><span style='color:red;'>Member Address is missing</td>\n";
		$error="Member address is missing";
	}else{
		$re .= " <td>$address</td>\n";
	}
	
	$re .="<tr>";
    $x++;
  
  }

  return $re .'</tbody></table>';     // ends and returns the html table
}


function sheetData2($sheet,$compid) {
	
  $re = '<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" ><thead>';     // starts html table
 $re.="<th>Member ID/NO</th><th>Full Name</th><th>Email</th><th>Telephone</th><th>Grade</th><th>Address</th></thead><tbody>";

  $x = 2;
  $error="";
  while($x <= $sheet['numRows']) {
	  
    $re .= "<tr>\n";
    $y = 1;
	
	$staffid=@$sheet['cells'][$x][1]; //Staff Id No. 
	$fullname=@$sheet['cells'][$x][2]; //Staff Id No. 
	$email=@$sheet['cells'][$x][3]; //Staff Id No. 
	$telephone=@$sheet['cells'][$x][4]; //Staff Id No. 
	$grade=@$sheet['cells'][$x][5]; //Staff Id No. 
	$address=@$sheet['cells'][$x][6]; //Staff Id No. 
	
	if(empty($staffid)){
		$re .= " <td><span style='color:red;'>Member ID/NO. is missing</td>\n";
		$error="Staff ID/NO. is missing";
	}else{
		$rnm=recNum("select * from tblemployee where compid=$compid and staffid='$staffid'");
				if($rnm>0){
					$re .= " <td><span style='color:red;'>Member ID/NO. is already in use</td>\n";
		$error="Member ID NO is already in use";
				}else{
					$re .= " <td>$staffid</td>\n";
				}
		
	}
	
	if(empty($fullname)){
		$re .= " <td><span style='color:red;'>Staff Full Name is missing</td>\n";
		$error="Member fullname is missing";
	}else{
		$re .= " <td>$fullname</td>\n";
	}
	
	
	if(empty($email)){
		$re .= " <td><span style='color:red;'>Member Email is missing</td>\n";
		$error="Member Email is missing";
	}else{
		$rnm=recNum("select * from tblemployee where compid=$compid and email='$email'");
				if($rnm>0){
					$re .= " <td><span style='color:red;'>Member email is already in use</td>\n";
		$error="Member email is already in use";
				}else{
					$re .= " <td>$email</td>\n";
				}
		
	}
	
	if(empty($telephone)){
		$re .= " <td><span style='color:red;'>Member Email is missing</td>\n";
		$error="Member Telephone is missing";
	}else{
		$rnm=recNum("select * from tblemployee where compid=$compid and telephone='$telephone'");
				if($rnm>0){
					$re .= " <td><span style='color:red;'>Member Telephone is already in use</td>\n";
		$error="Member Telephone is already in use";
				}else{
					$re .= " <td>$telephone</td>\n";
				}
		
	}
	
		if(empty($grade)){
		$re .= " <td><span style='color:red;'>Member Category is missing</td>\n";
		$error="Member Category is missing";
	}else{
		$rnm=recNum("select * from tblgrades where compid=$compid and gradename = '$grade'");
				if($rnm<1){
					$re .= " <td><span style='color:red;'>Member Category not recognized.<br>Please check Member <a hre='grades.php'>Category definition</a> to see what you defined. </td>\n";
		$error="Member Category not recognized";
				}else{
					
					$re .= " <td>$grade</td>\n";
				}
			}
			
			
	if(empty($address)){
		$re .= " <td><span style='color:red;'>Member Address is missing</td>\n";
		$error="Member address is missing";
	}else{
		$re .= " <td>$address</td>\n";
	}
	 if(empty($error)){
  $appid=getappid();
			
			//$fullname=addslashes($fullname);
			//$grade=addslashes($grade);
			//$address=addslashes($address);
			$address = str_replace("'", "", $address);
			$fullname = str_replace("'", "", $fullname);
			$rema=getremainingmembers($compid);
			if($rema>0){
			
			$gradeid=returnQueryValue("select id from tblgrades where gradename='$grade'","id");
			$qry="insert into tblemployee(compid,fullname,grade,email,telephone,staffid,appid,address) values($compid,'$fullname',$gradeid,'$email','$telephone','$staffid','$appid','$address')";
			//echo $qry;exit;
			
			$res=mysql_query($qry);
			$pword=sha1("123456");
			$resx=mysql_query("insert into tblusers(fullname,email,telephone,pword,compid,role,datecreated) values ('$fullname','$email','$telephone','$pword',$compid,'member','$dd')");
			
			$cname=returnQueryValue("select name from tblcompany where id=$compid","name");
				$imglogo=returnQueryValue("select logostring from tblcompany where id=$compid","logostring");
				
					$linkcrumb=uniqid();
				$pemail="<p><center><img src='$applink"."app/docs/".$imglogo."' style='width:300px;height:300px;'></center></p>";
				$pemail.="<p><center><font size='3'>Dear $fullname,</b></font></center></p>";
				$pemail.="<p><center><font size='3'>Your account has been created on $applink!</center> </p>";
				$pemail.="<p><center><a href='$applink"."app/login.php?ssid=$linkcrumb'><button style=' background-color: #00539C;color: black;border: 2px solid #4CAF50;padding:12px;color:white;'>Login to $cname </button></a> </p>";
				
				//echo $pemail;
				$subject="Welcome to ".$appname;
				$from="noreply@runbero.com";
				if($smailparam=="Y"){
					$emret=sendmail($email, $subject, $pemail, $from);
				}
			}else{
				echo "<td style='color: red;'>Error: Total number of Licensed Members exceeded.<br><a href='upgrade.php'>Upgrade Now</a></td>";
			}

  }else{
	   echo "<td style='color: red;'>Error: ".$error."</td>";
  }
 
	$re .="<tr>";
    $x++;
  
  }
 
  return $re .'</tbody></table>';     // ends and returns the html table
}


if($op=="view"){

	$nr_sheets = count($excel->sheets);       // gets the number of sheets
	$excel_data = '';              // to store the the html tables with data of each sheet

	// traverses the number of sheets and sets html table with each sheet data in $excel_data
	$staffid="";
	for($i=0; $i<$nr_sheets; $i++) {
		$staffid=trim($excel->boundsheets[$i]['name']);
		
	  $excel_data .= sheetData($excel->sheets[$i],$compid);  
	}
}

if($op=="save"){
	ob_start();
	$nr_sheets = count($excel->sheets);       // gets the number of sheets
	$excel_data = '';              // to store the the html tables with data of each sheet
$staffid="";
	// traverses the number of sheets and sets html table with each sheet data in $excel_data
	for($i=0; $i<$nr_sheets; $i++) {
		//$staffid=trim($excel->boundsheets[$i]['name']);
		
	  $excel_data .= sheetData2($excel->sheets[$i],$compid) ;  
	}
	header("location: uploadstaff.php");
	
}
echo $excel_data;


?>
<center><button name="submit" class="btn btn-primary" onclick="commitData();">Upload and Save</button>&nbsp;&nbsp; <a href='uploadstaff.php'><button name="submit" class="btn btn-warning" onclick="commitData();">Exit</button></a></center>
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
		
		<script>
		var fname="<?php echo $fname; ?>";
		function commitData(){
	
			window.location="processupload.php?fname="+fname+"&op=save";
			
			//upload.php?fname=".$target_file."&userid=".$userid."&cmbappraisal=".$appid."&op=view"
		}
		</script>

	</body>
</html>