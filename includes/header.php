<?php 
	$settings = get_data('settings','where setting_is_active = 1','name,value');
	$settings = decomposed_settings($settings);
?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="<?=WEBSITE_URL;?>assets/frontend/img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title><?=WEBSITE_TITLE;?></title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/linearicons.css">
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/font-awesome.min.css">
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/bootstrap.css">
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/magnific-popup.css">
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/jquery-ui.css">
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/nice-select.css">
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/animate.min.css">
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/owl.carousel.css">			
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/jquery-ui.css">			
			<link rel="stylesheet" href="<?=WEBSITE_URL;?>assets/frontend/css/main.css">
			<style>
				div#doct{display:none;}
			</style>
		</head>
		<body>	
		  <header id="header">
	  		<div class="header-top">
	  			<div class="container">
			  		<div class="row align-items-center">
			  			<div class="col-lg-6 col-sm-6 col-4 header-top-left">
			  				<a href="tel:+9530123654896"><span class="lnr lnr-phone-handset"></span> <span class="text"><span class="text"><?=(! empty($settings['phone'])) ? $settings['phone'] : ''?></span></span></a>
				  			<a href="mailto:support@colorlib.com"><span class="lnr lnr-envelope"></span> <span class="text"><span class="text"><?=(! empty($settings['email'])) ? $settings['email'] : ''?></span></span></a>			
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-8 header-top-right">
							<a href="#appointment" class="primary-btn text-uppercase">Book Appointment</a>
			  			</div>
			  		</div>			  					
	  			</div>
			</div>
		    <div class="container main-menu">
		    	<div class="row align-items-center justify-content-between d-flex">
			      <div id="logo">
			        <a href="<?=WEBSITE_URL?>index.php"><img src="<?=WEBSITE_URL;?>assets/frontend/img/logo.png" alt="" title="" /></a>
			      </div>
			      <?php include_once "includes/navbar.php"; ?>
		    	</div>
		    </div>
		  </header><!-- #header -->