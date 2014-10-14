<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ESGI Immobilier</title>
		<!--Variable Wordpress du css par défaut-->
		<link rel"stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
		<?php wp_head(); ?>
	</head>
	<body>
		<div class="banner">
			<!-- variable wordpress du nom du site-->
			<h1><?php bloginfo('name'); ?></h1>
			<!-- variable wordpress du slogan du site-->
			<p><?php bloginfo('description'); ?></p>
		</div>
		<?php wp_footer(); ?>
		<form method="get" id="form" action="<?php bloginfo('url'); ?>/">
		  	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s">
		 	<input type="submit" id="submit">
		</form>

	</body>
</html>