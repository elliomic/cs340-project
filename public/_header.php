<?php require_once "setup.php" ?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PEBCAK</title>
	<link rel="stylesheet" href="css/all.css">
    <link rel="icon"
          type="image/png"
          href="images/favicon.png">
  </head>
  <body>
    
    <header class="x-header-nav x-header-nav--ad">
	  <link href="css/gnavstyle.css" rel="stylesheet">
	  <div aria-label="Main Navigation" class="polaris-nav polaris-nav-header-wrapper" role="navigation">		
		<div class="polaris-header"> 
		  <ul class="polaris-navigation">
			<li class="polaris-item">
			  <a href="index.php" target="_self" class="polaris-link ">
				<img src="images/logo.jpg" height=50>
			  </a>
			</li>
		  </ul>
		  <ul class="polaris-navigation">
			<li class="polaris-item ">
			  <a href="index.php" target="_self" class="polaris-link">
				<span class="polaris-trackname">Home</span>
			  </a>
			</li>
			<li class="polaris-item ">
			  <a href="plans.php" target="_self" class="polaris-link">
				<span class="polaris-trackname">Shop</span>
			  </a>
			</li>
            <?php if(is_logged_in()) {?>
			<li class="polaris-item ">
			  <a href="account.php " target="_self" class="polaris-link ">
				<span class="polaris-trackname">Account</span>
			  </a>
			</li>
            <?php } ?>
		  </ul>
		  <ul class="polaris-personal">
			<li class="polaris-item ">
              <?php if(is_logged_in()) {?>
			  <a href="logout.php" target="_self" class="polaris-link ">
				<span class="polaris-trackname">Log Out</span>
			  </a>
              <?php } else {?>
			  <a href="login.php" target="_self" class="polaris-link ">
				<span class="polaris-trackname">Sign In</span>
			  </a>
              <?php } ?>
			</li>
		  </ul>
		</div>
	  </div>
	</header>

	<main role="main">
	  
	  <section class="x-content-banner x-content-banner--pad-top-sm x-content-banner--pad-bottom-sm x-ui-theme--transparent x-background--transparent">
		
		<div class="x-flex-row middle-md center-sm">
		  
		  <div class="x-flex__col-xs-12 x-flex__col-md-8 x--ta-c">
			<div class="x-flex__content x-content-banner__content">
