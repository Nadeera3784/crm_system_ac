<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Dashboard</title>
	<meta name="description" content="#" />
	<meta name="keywords" content="#" />
	<meta name="author" content="#"/>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<?php
	if(isset($css)){
		$arrlength = count($css);
		for($x = 0; $x < $arrlength; $x++) {
			echo '<link href="'.base_url() . $css[$x].'" rel="stylesheet" type="text/css">';
		}
	}
	?>
	<link href="<?php echo base_url(); ?>assets/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="wrapper theme-2-active navbar-top-light">
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="nav-wrap">
				<div class="mobile-only-brand pull-left">
					<div class="nav-header pull-left">
						<div class="logo-wrap">
							<a href="<?php echo base_url(); ?>technician">
								<img class="brand-img" src="<?php echo base_url(); ?>assets/images/logo.png" alt="<?php echo $this->config_manager->config['conf_hotel_name']; ?>"/>
								<span class="brand-text"><img  src="<?php echo base_url(); ?>assets/images/brand.png" alt="<?php echo $this->config_manager->config['conf_hotel_name']; ?>"/></span>
							</a>
						</div>
					</div>	
					<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="ti-align-left"></i></a>
					<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="ti-more"></i></a>
				</div>
				<div id="mobile_only_nav" class="mobile-only-nav pull-right">
					<ul class="nav navbar-right top-nav pull-right">
						
						<li>
							<a id="open_right_sidebar" href="#"><i class="ti-settings  top-nav-icon"></i></a>
						</li>
						<li class="dropdown auth-drp">
							<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url();?>uploads/profile/<?php echo $this->ion_auth->user()->row()->avatar;?>" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
							<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
								<li>
									<a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo base_url();?>auth/logout"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
								</li>
							</ul>
						</li>
					</ul>
				</div>	
				</div>
			</nav>
			<div class="fixed-sidebar-left">
				<ul class="nav navbar-nav side-nav nicescroll-bar">
				    <li>
						<a href="<?php echo base_url();?>technician/index"><div class="pull-left"><i class="ti-dashboard mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
					</li>

					<li>
						<a href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="ti-clipboard mr-20"></i><span class="right-nav-text">Jobs</span></div><div class="pull-right"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
						<ul id="ecom_dr" class="collapse collapse-level-1">
							<li>
								<a href="<?php echo base_url();?>technician/job_list/">List</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="ti-timer mr-20"></i><span class="right-nav-text">Attendance </span></div><div class="pull-right"><i class="ti-angle-down "></i></div><div class="clearfix"></div></a>
						<ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
							<li>
								<a href="<?php echo base_url(); ?>technician/attendance_list">List</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="javascript:void(0);" data-toggle="collapse" data-target="#comp_dr"><div class="pull-left"><i class="ti-settings mr-20"></i><span class="right-nav-text">Settings</span></div><div class="pull-right"><i class="ti-angle-down "></i></div><div class="clearfix"></div></a>
						<ul id="comp_dr" class="collapse collapse-level-1">
							<li>
								<a href="<?=base_url();?>auth/change_password">Change Password</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>