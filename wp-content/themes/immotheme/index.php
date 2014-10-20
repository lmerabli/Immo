
<?php get_header(); ?>
	<div>
		<div class="content">
			<!--COLONNE GAUCHE-->
			<div class="body">
				<?php get_template_part( 'loop', 'index' ); ?>
			</div>
			<!--COLONNE DROITE-->
			<div class="side">
				<?php get_search_form(); ?>
				<?php get_sidebar(); ?>
			</div>
			<?php get_footer(); ?>

