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
				<div class="text-bloc website-name">
					<!-- variable wordpress du nom du site-->
					<label onclick="location.href='<?php echo get_settings('home'); ?>';" style="cursor: pointer;"><?php bloginfo('name'); ?></label>
				</div>
				<div class="text-bloc website-slogan">
					<!-- variable wordpress du slogan du site-->
					<label><?php bloginfo('description'); ?></label>
				</div>
			</div>
		</div>
	<div id="menu" role="navigation">
    		<?php wp_nav_menu(array('theme_location' => 'header')); ?>
	</div>
	
