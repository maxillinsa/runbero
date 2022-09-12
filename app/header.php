<?php 

if (is_dir("install")){
	header("location: install/index.php"); 
	exit;
	
}

include("controller/func.php");

$appname="Blueroll";

//$compid=1;



//$enc= encrypt("what the fuck? 12344", "1234");





$sitepack=@$_COOKIE['sitepack'];
	if(empty($sitepack)){
		
	//	header("location:login.php");
		
		echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
        exit();
	}
	
	
	$dec=base64_decode($sitepack);
	
	
	$spt=explode("**--**",$dec);
	
	$compid=$spt[0];
	$email=$spt[1];
	$curaddress=$spt[2];
	
	$ip_server = $_SERVER['SERVER_ADDR'];
	
	if($curaddress==$ip_server){}else{
		
	//	header("location:login.php");
		
		echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
        exit();
	}
	
	//echo $compid;exit;
	
	$fullname=returnQueryValue("select fullname from tblusers where email='$email'","fullname");
	$role=returnQueryValue("select role from tblusers where email='$email'","role");
	$currempid=returnQueryValue("select id from tblemployee where email='$email'","id");
	$roledes="";
	if($role=="admin"){
		
		$roledes="Administrator";
		
	}
	
	if($role=="payrollofficer"){
		
		$roledes="Payroll Officer";
		
	}
	if($role=="member"){
		
		$roledes="Member/Employee";
		
	}
	//echo $role;exit;
	$cname=returnQueryValue("select name from tblcompany where id=$compid","name");
	$imglogo=returnQueryValue("select imglogo from tblcompany where id=$compid","imglogo");
	$isloan=returnQueryValue("select loan from tblcompany where id=$compid","loan");
	$clogo=returnQueryValue("select logostring from tblcompany where id=$compid","logostring");
	$address1=returnQueryValue("select address1 from tblcompany where id=$compid","address1");
	$address2=returnQueryValue("select address2 from tblcompany where id=$compid","address2");
	$address3=returnQueryValue("select address3 from tblcompany where id=$compid","address3");
	$alladdress=$address1."<br>".$address2."<br>".$address3;
	$ltelephone=returnQueryValue("select telephone from tblcompany where id=$compid","telephone");
	$lemail=returnQueryValue("select email from tblcompany where id=$compid","email");
	
	$longaddress=$address1." ".$address2." ".$address3;
	
	$curuserid=returnQueryValue("select id from tblusers where email='$email'","id");
	//echo $curuserid;exit;
	
	$totnotification=@returnQueryValue("select count(*) tdc from notifi where tto=$curuserid","tdc");
	if($totnotification==""){
		$totnotification="0";
	}
	
	include("stats.php");
	
	//echo $totearn;
	//echo $totdeduct;
	


?>
<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="msapplication-TileColor" content="#0f75ff">
		<meta name="theme-color" content="#9d37f6">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

		<!-- Title -->
		<title>Blueroll - Cloud Payroll and Loan System</title>
		<link rel="stylesheet" href="../assets/fonts/fonts/font-awesome.min.css">

		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">


		<!-- Bootstrap Css -->
		<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- Dashboard Css -->
		<link href="../assets/css/style.css" rel="stylesheet" />
		<link href="../assets/css/admin-custom.css" rel="stylesheet" />

		<!-- Sidemenu Css -->
		<link href="../assets/plugins/toggle-sidebar/sidemenu.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />
		
			<!-- Data table css -->
		<link href="../assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="../assets/plugins/datatable/jquery.dataTables.min.css" rel="stylesheet" />


		<link href="../assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- Time picker Plugin -->
		<link href="../assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />
		

		<!-- Date Picker Plugin -->
		<link href="../assets/plugins/date-picker/spectrum.css" rel="stylesheet" />


 <script src="https://js.paystack.co/v1/inline.js"></script>
		<!---Font icons-->
		<link href="../assets/css/icons.css" rel="stylesheet"/>
		<link href="../assets/plugins/iconfonts/icons.css" rel="stylesheet" />

		<!-- COLOR-SKINS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/webslidemenu/color-skins/color1.css" />
		
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/css/apprise.css" />
		
		<link href="../assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />
				<link href="../assets/css/style.css" rel="stylesheet" />
				<link href="../assets/css/color.css" rel="stylesheet" />
		<link href="../assets/css/admin-custom.css" rel="stylesheet" />

		<!-- Chat Plugin css-->
		<link href="../assets/plugins/chat/jquery.convform.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!---Font icons-->
		<link href="../assets/css/icons.css" rel="stylesheet"/>

		<!-- COLOR-SKINS -->
		<link href="../assets/css/style.css" rel="stylesheet" />
		<link href="../assets/css/admin-custom.css" rel="stylesheet" />

		<!-- Chat Plugin css-->
		<link href="../assets/plugins/chat/jquery.convform.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!---Font icons-->
		<link href="../assets/css/icons.css" rel="stylesheet"/>

		<style>
		
		.msgme{
			background: rgb(237, 240, 245);
			border-radius: 20px;
			padding: 12px 22px;
			font-size: 0.905rem;
			display: inline-block;
			padding: 10px 15px 8px;
			border-radius: 20px;
			border-top-left-radius: 20px;
			margin-bottom: 5px;
			float: right;
			clear: both;
			max-width: 65%;
			word-wrap: break-word;
			
		}
		
		
		
		</style>
		
		

	</head>
	<body class="app sidebar-mini">


		<div id="global-loader">
			<img src="../assets/images/other/loader.gif" class="loader-img " alt="">
		</div>

		<div class="page">
			<div class="page-main" style="padding-left:0px;margin-left:0px;">
				<div class="app-header1 header py-1 d-flex" style="padding-left:0px;margin-left:0px;">
					<div class="container-fluid" style="padding-left:0px;margin-left:0px;">
						<div class="d-flex" style="padding-left:0px;">
							<div class="header-brand" style="padding-left:0px;margin-left:0px;">
								<a href="index.php"><img src="../assets/images/brand/logo.png" style="width:200px;height:64px;padding-left:0px;margin-left:0px;"></a>
								
							</div>
							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
							<div class="header-navicon">
								<a href="#" data-toggle="search" class="nav-link d-lg-none navsearch-icon">
									<i class="fa fa-search"></i>
								</a>
							</div>
							<div class="header-navsearch">
								<a href="#" class=" "></a>
								<form class="form-inline mr-auto">
									<div class="nav-search">
										<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" >
										<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
									</div>
								</form>
							</div>
							<div class="d-flex order-lg-2 ml-auto">
								<div class="dropdown d-none d-md-flex" >
									<a  class="nav-link icon full-screen-link">
										<i class="fe fe-maximize-2"  id="fullscreen-button"></i>
									</a>
								</div>
								<div class="dropdown d-none d-md-flex country-selector">
									<a href="#" class="d-flex nav-link leading-none" data-toggle="dropdown">
										<img src="../assets/images/us_flag.jpg" alt="img" class="avatar avatar-xs mr-1 align-self-center">
										<div>
											<strong class="text-dark">English</strong>
										</div>
									</a>
								
								</div>
								
							
								<div class="dropdown d-none d-md-flex">
									<a class="nav-link icon" data-toggle="dropdown">
										<i class="fa fa-bell-o"></i>
										<span class=" nav-unread badge badge-danger  badge-pill"><?php
												if($totnotification=="0"){}else{
													echo $totnotification;
												}
										?></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a href="#" class="dropdown-item text-center">You have <?php echo $totnotification; ?> notification</a>
										<div class="dropdown-divider"></div>
										<?php 
										$qrs="select * from notifi where tto=$curuserid order by id desc";
										$reso=mysql_query($qrs);
										$numo=mysql_num_rows($reso);
										$rdo=mysql_fetch_assoc($reso);
										if($numo>0){
											do{
												$msg=$rdo['msg'];
												$dd=$rdo['ddate'];
												$link=$rdo['link'];
											
										
										?>
										<a href="<?php echo $link; ?>" class="dropdown-item d-flex pb-3">
											<div class="notifyimg">
												<i class="fa fa-envelope-o"></i>
											</div>
											<div>
												<strong><?php echo $msg; ?></strong>
												<div class="small text-muted"><?php echo $dd; ?></div>
											</div>
										</a>
										<?php 
										}
											while($rdo=mysql_fetch_assoc($reso));
											
										}
										
										
										?>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item text-center">See all Notification</a>
									</div>
								</div>
							
								
								<div class="dropdown ">
									<a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
										<img src="../assets/images/faces/male/13.jpg" alt="profile-img" class="avatar avatar-md brround">
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
										<a class="dropdown-item" href="changepassword.php">
											 Change Password
										</a>
										<a class="dropdown-item" href="logout.php">
											<i class="dropdown-icon icon icon-power"></i> Log out
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"  ></div>
				<aside class="app-sidebar doc-sidebar" >
					<div class="app-sidebar__user clearfix">
						<div class="dropdown user-pro-body">
							<div>
								<img src="../assets/images/faces/male/13.jpg" alt="user-img" class="avatar avatar-lg brround">
								<a href="editprofile.html" class="profile-img">
									<span class="fa fa-pencil" aria-hidden="true"></span>
								</a>
							</div>
							<div class="user-info">
								<h2><?php echo $fullname; ?></h2>
								<span><?php echo $roledes; ?></span>
							</div>
						</div>
					</div>
					<ul class="side-menu" >
					
						<li class="slide">
							<a class="side-menu__item"  href="index.php"><i class="side-menu__icon typcn typcn-chart-pie-outline"></i><span class="side-menu__label">Dashboard</span><i class="angle fa fa-angle-right"></i></a>
							
						</li>
					
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i><span class="side-menu__label">Collaborate</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
							<?php if($role=="admin"){ ?>
								<li>
									<a href="myteam.php" class="slide-item">My Team</a>
								</li>
								<li>
									<a href="invites.php" class="slide-item">Invite</a>
								</li>
								<?php } ?>
								
								<li>
									<a href="docarea.php" class="slide-item">Document Bay</a>
								</li>
								
							</ul>
						</li>
						
						
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-cog-outline"></i><span class="side-menu__label">Workspace Settings</span> <i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
							<?php if($role=="admin"){ ?>
								<li><a class="slide-item" href="cparameters.php">Company Parameters</a></li>
								<?php } ?>
								<?php if($role=="admin" || $role=="payrollofficer"){ ?>
								<li><a class="slide-item" href="grades.php">Members Grades/Categories</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php if($role=="admin" || $role=="payrollofficer"){ ?>
					
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-point-of-interest-outline"></i><span class="side-menu__label">Members</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
							
								<li>
									<a href="employees.php" class="slide-item">Manage Members</a>
								</li>
								<li>
									<a href="uploadstaff.php" class="slide-item">Upload Members Data</a>
								</li>
								
							
								
							</ul>
						</li>
						<?php } ?>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-news"></i><span class="side-menu__label">Payroll</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
							<?php if($role=="admin" || $role=="payrollofficer"){ ?>
								<li>
									<a href="payrollproject.php" class="slide-item">Manage Payroll</a>
								</li>
								
								<li>
									<a href="payelement.php" class="slide-item">Pay Elements</a>
								</li>
								
									<li>
									<a href="employeespayement.php" class="slide-item">Personalized Pay Elements</a>
								</li>
								
								
								
								<li>
									<a href="upfront.php" class="slide-item">Upfront Payment</a>
								</li>
								
								<li>
									<a href="employeeprorata.php" class="slide-item">Prorate Employee</a>
								</li>
								
								<li>
									<a href="salaryincrement.php" class="slide-item">Salary Increment</a>
								</li>
							<?php } ?>
							<?php if($role=="member"){ ?>
								<li>
									<a href="mypayslip.php" class="slide-item">My Payslips</a>
								</li>
								
								
								<li>
									<a href="myupfront.php" class="slide-item">My Upfronts</a>
								</li>
								
								<?php } ?>
								
							</ul>
						</li>
						
						
						
						
						
						
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-news"></i><span class="side-menu__label">Loans</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
							<?php if($role=="admin" || $role=="payrollofficer"){ ?>
								<li>
									<a href="loantypes.php" class="slide-item">Loan Types</a>
								</li>
								
								
								
								<li>
									<a href="manageloan.php" class="slide-item">View Existing Loans</a>
								</li>
								
								
								<li>
									<a href="loanrequests.php" class="slide-item">Loan Requests</a>
								</li>
								
								
								<li>
									<a href="loanstatuses.php" class="slide-item">Loans Financial Status</a>
								</li>
								<?php } ?>
								<?php if($role=="member"){ ?>
								
								<li>
									<a href="myloans.php" class="slide-item">My Loans</a>
								</li>
								
								
								<?php } ?>
								
								
								
								
							</ul>
						</li>
						
							<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-news"></i><span class="side-menu__label">Statements</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
							<?php if($role=="admin" || $role=="payrollofficer"){ ?>
								<li>
									<a href="runperiod.php" class="slide-item">Run Payroll</a>
									
								
								</li>
								
								<li>
									<a href="approvedpayroll.php" class="slide-item">Approved Payroll</a>
								</li>
								
								<li>
									<a href="runupfront.php" class="slide-item">Run Upfront Payment</a>
								</li>
								
								<li>
									<a href="approvedupfront.php" class="slide-item">Approved Upfront</a>
								</li>
								
								<li>
									<a href="payrollsummary.php" class="slide-item">Payroll Summary Report</a>
								</li>
								
								<li>
									<a href="upfrontsummary.php" class="slide-item">Upfront Summary Report</a>
								</li>
								
								<li>
									<a href="taxrecord.php" class="slide-item">Tax Record</a>
								</li>
								
								<li>
									<a href="pensionrecord.php" class="slide-item">Pension Funds</a>
								</li>
								<?php } ?>
								
								<?php if($role=="member"){ ?>
								<li>
									<a href="docarea.php" class="slide-item">My Payslips</a>
								</li>
							
								
								<li>
									<a href="mytaxes.php" class="slide-item">My Taxes</a>
								</li>
								
								<li>
									<a href="mypension.php" class="slide-item">My Pension</a>
								</li>
								<?php } ?>
								
							</ul>
						</li>
						
						</ul>
				
				</aside>