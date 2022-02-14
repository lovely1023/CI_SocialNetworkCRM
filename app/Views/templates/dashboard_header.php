<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
	<title>CRM Platform</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/theme.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/latest-style.css">
	<script type="text/javascript">
		var baseURL = "<?php echo base_url(); ?>";
	</script>
	</head>
	<body>
	<section class="text-light" data-bg-parallax="<?php echo base_url()."/images/25.jpg"; ?>"><div class="parallax-container img-loaded" data-bg="<?php echo base_url()."/images/25.jpg"; ?>" data-velocity="-.140" data-ll-status="loaded"></div>
		<div class="container">
			<div class="row justify-content-md-center">
			<div class="col-md-4">

			<div class="text-center">
			<span class="display-4 d-block text-dark mb-2">08</span>
			<p class="lead">Leads last 7-days</p>
			</div>

			</div>
			<div class="col-md-4">

			<div class="text-center">
			<span class="display-4 d-block text-dark mb-2">103</span>
			<p class="lead">Leads last 30-days</p>
			</div>

			</div>
			<div class="col-md-4">

			<div class="text-center">
			<span class="display-4 d-block text-dark mb-2">500+</span>
			<p class="lead">500+ Current Leads</p>
			</div>

			</div>
			</div>
		</div>
	</section>

	<section id="page-content" class="sidebar-both">	
		<div class="container">
			<div class="row">

			<div class="sidebar col-lg-2 hidden-xs">

				<div class="widget widget-notification">
					<div class="notification-item">
					<div class="notification-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"/></a></div>
					<div class="notification-meta">
					<span>Welcome</span><br>
					Winston Mendoza <br>
					<span><?=$pageTitle?></span>
					</div>
					</div>
				</div>
				

				<div class="widget clearfix widget-categories">
				<h4 class="widget-title">Components</h4>
					<ul class="list list-arrow-icons">
					<li> <a title="" href="<?=base_url().'/'.$dashboard_type?>">Dashboard </a> </li>
					<li> <a title="" href="#">Configuration Settings </a> </li>
					<li> <a title="" href="#">Marketing Page </a> </li>
					<li> <a title="" href="#">SMS Campaigne</a> </li>
					<li> <a title="" href="#">Email Option</a> </li>
					<li> <a title="" href="#">Leads</a> </li>
					<li> <a title="" href="<?=base_url().'/'.$dashboard_type.'/user_list/'.$user['id']?>">User List</a> </li>
					<li> <a title="" href="<?=base_url().'/common_fields/email_template'?>">Email Template List</a> </li>
					<li> <a title="" href="<?=base_url().'/common_fields'?>">Common Fields</a> </li>
					</ul>
				</div>


				<div class="widget clearfix widget-categories">
					<h4 class="widget-title">Advance Settings</h4>
					<ul class="list list-arrow-icons">
					<li>Trainings</li>
					<li>Language</li>
					</ul>
				</div>

			</div>
			