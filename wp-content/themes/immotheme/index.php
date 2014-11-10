
<?php get_header(); ?>
	<div class="encart">

		<!-- PARTIE CENTRALE-->
		<div class="content">

			<!--COLONNE GAUCHE-->
			<div class="body">
				<?php get_template_part( 'loop', 'index' ); ?>
			</div>

			<!--COLONNE DROITE-->
			<div class="side">

				<!--### CONNEXION ###-->
				<!--SI L'UTILISATEUR EST CONNECTE-->
				<?php if( is_user_logged_in() ): ?>
					<div class="connect-box">
						VOUS ETES CONNECTE 
						<?php echo '<p>', $current_user->user_login,'</p>'; ?>
					</div>
				<!--SI L'UTILISATEUR N'EST PAS CONNECTE-->
				<?php else :?>
					<!-- BOITE DE CONNEXION-->
					<div class="connect-box">
						<?php wp_login_form(); ?>
					</div>
				<?php endif; ?>

				<!-- FORMULAIRE DE RECHERCHE -->
				<?php get_search_form(); ?>

				<!-- BARRE LATERALE -->
				<?php get_sidebar(); ?>
			</div>

			<!-- APPEL AU FICHIER FOOTER -->
			<?php get_footer(); ?>

