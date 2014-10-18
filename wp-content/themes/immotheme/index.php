
<?php get_header(); ?>
	<div>
		<div class="banner">
			<div id="banner-text">
				<!-- variable wordpress du nom du site-->
				<h1><?php bloginfo('name'); ?></h1>
				<!-- variable wordpress du slogan du site-->
				<p><?php bloginfo('description'); ?></p>
			</div>
		</div>
		<div class="menu">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			<?php wp_nav_menu( array( 'menu' => 'NOM DU MENU' , 'sort_column' => 'menu_order' , 'container' => '<ul>' , 'container_id' =>  'ID CONTAINER' , 'menu_class' => 'CLASSE CSS')); ?>
		</div>
<<<<<<< HEAD
=======

>>>>>>> 395ba8175cd7a1e00959f77a9b6e3e707dc70314
		<div class="content">
			<!--COLONNE GAUCHE-->
			<div class="body">
				<p>Ceci est un contenu test</p>
				<?php get_template_part( 'loop', 'index' ); ?>
			</div>
			<!--COLONNE DROITE-->
			<div class="side">
				<?php get_search_form(); ?>
				<?php get_sidebar(); ?>

			</div>
				<?php get_footer(); ?>

