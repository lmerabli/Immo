<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo( 'title' ); ?> | Test Wordpress</title>
		<!--Variable Wordpress du css par défaut-->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<?php wp_head(); ?>		
	</head>
	<div class="banner">
			<div id="banner-text">
				<!-- variable wordpress du nom du site-->
				<h1><?php bloginfo('name'); ?></h1>
				<!-- variable wordpress du slogan du site-->
				<p><?php bloginfo('description'); ?></p>
			</div>
		</div>
	<div id="menu" role="navigation">
    		<?php wp_nav_menu(array('theme_location' => 'header')); ?>
	</div>
	
