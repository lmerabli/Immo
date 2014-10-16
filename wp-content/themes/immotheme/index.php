<<<<<<< HEAD
<?php 
	get_header(); 
?>
	<div class="test">
=======

<?php get_header(); ?>
	<div>

>>>>>>> c7c47c168484b794b7eaece36f894b7c57b54657
		<div class="banner">
				<!-- variable wordpress du nom du site-->
				<h1><?php bloginfo('name'); ?></h1>
				<!-- variable wordpress du slogan du site-->
				<p><?php bloginfo('description'); ?></p>
		</div>
<<<<<<< HEAD
	</div>
<?php
	//get_sidebar();
	get_footer();
?>
=======


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

>>>>>>> c7c47c168484b794b7eaece36f894b7c57b54657
