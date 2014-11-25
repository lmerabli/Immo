
<?php get_header(); ?>
	<div class="encart">

		<!-- PARTIE CENTRALE-->
		<div class="content">

			<!--COLONNE GAUCHE-->
			<div class="body">
				<?php 
				//print_r($_SESSION);
				 echo fL_formulaire()
				?>
				<?php get_template_part( 'loop', 'index' ); ?>
			</div>

			<!--COLONNE DROITE-->
			<div class="side">
				<div class="login-box">
					<!--SI L'UTILISATEUR EST CONNECTE-->
					<?php if( is_user_logged_in() ): ?>
						<div class="connect-box connect-box_connected">
							<?php echo '<p class="welcome_user">Bienvenue <a href="http://localhost/Immo/wp-admin/profile.php">', $current_user->user_login,' !</a></p>'; ?>
							<a class="disconnect_user" href="http://localhost/Immo/wp-login.php?action=logout&amp;_wpnonce=7cec4d7f3b">Déconnexion</a>
						</div>
					<!--SI L'UTILISATEUR N'EST PAS CONNECTE-->
					<?php else :?>
						<!-- BOITE DE CONNEXION-->
						<div class="connect-box connect-box_notconnected">
							<?php wp_login_form(); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- FORMULAIRE DE RECHERCHE -->
				<?php get_search_form(); ?>

				<!-- BARRE LATERALE -->
				<?php get_sidebar(); ?>
			</div>

			<!-- APPEL AU FICHIER FOOTER -->
			<?php get_footer(); ?>

