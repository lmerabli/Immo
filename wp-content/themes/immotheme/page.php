<?php
/*
	Template Name: Statistiques
*/
?>

<?php get_header(); ?>

<div class="page-encart">
	<div class="page-view">

		<!-- Partie centrale -->
		<div class="left-side-page body">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="post">
						<h1 class="post-title"><?php the_title(); ?></h1>
						<div class="post-content">
							<p>Contenu : <strong><?php echo the_content(); ?></strong></p>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<!-- Colonne de droite -->
		<div class="right-side-page side">
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

			<?php get_sidebar(); ?>
		</div>

		<?php get_footer(); ?>
	</div>
</div>

