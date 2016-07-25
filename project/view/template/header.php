<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
	
		<title> <?php echo $title; ?> </title>
	
		<!-- Cascade Style Sheet -->
		<link rel="stylesheet" href="<?=STYLESHEET_FOLDER?>/bootstrap/bootstrap.min.css" type="text/css" media="screen, projection" />
		
		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="<?=STYLESHEET_FOLDER?>/style/style.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?=STYLESHEET_FOLDER?>/style/font-awesome.min.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?=STYLESHEET_FOLDER?>/style/main.css" type="text/css" media="screen, projection" />
		
		<!-- jQuery -->
		<script src="<?=JAVASCRIPT_FOLDER?>/jquery/jquery.min.js"></script>
		<script src="<?=JAVASCRIPT_FOLDER?>/jquery/jquery-ui.min.js"></script>
		<!-- jBootstrap -->
		<script src="<?=JAVASCRIPT_FOLDER?>/bootstrap.min.js"></script>
	
	</head>
	
	<body>

		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				
			  </button>
			  <a class="navbar-brand" href="<?=SERVER_ROOT_URL;?>"><img src="<?=IMAGES_URL?>/logo.png" width="36px" height="25px" alt="" /></a>
			</div>
			<div class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="<?=SERVER_ROOT_URL;?>">HOME</a></li>
				<li><a href="<?=SERVER_ROOT_URL;?>/articles">ARTICLES</a></li>
				<li><a href="<?=SERVER_ROOT_URL;?>/consultation/make">CONSULTATION</a></li>
				<li><a data-toggle="modal" data-target="#myModal" href="#myModal">MAP</a></li>
				<?php
				if( $isLoggedIn )
				{
				?>
					<li><a href="<?=SERVER_ROOT_URL;?>/profile"><?=strtoupper($_SESSION['username']);?> &#128100;</a></li>
					<li><a href="<?=SERVER_ROOT_URL;?>/login/logout">LOGOUT &#128682;</a></li>
				<?php
				}
				else
				{
				?>
					<li><a href="<?=SERVER_ROOT_URL;?>/login">LOGIN &#128274;</a></li>
					<li><a href="<?=SERVER_ROOT_URL;?>/register">REGISTER &#128100;</a></li>
				<?php
				}
				?>
			  </ul>
			</div><!--/.nav-collapse -->
		  </div>
		</div>