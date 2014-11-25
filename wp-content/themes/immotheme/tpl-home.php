<?php
    /**
    * Template Name: Page d'accueil 
    */
?>
<?php get_header(); ?>

<div class="page-encart">
	<div class="page-view">

		<!-- Partie centrale -->
		<div class="left-side-page">
			<?php while (have_posts()) : the_post(); ?>
				<div class="post">
					<h1 class="post-title"><?php the_title(); ?></h1>
					<div class="post-content">
						<p><strong><?php the_content(); ?></strong></p>
					</div>
				</div>
			<?php endwhile; ?>
			<div>
				<h1>Les dernières actualités</h1>
			</div>

			<div>
				<?php
					$query = new WP_query(array('post_type'=>'post','posts_per_page'=>4));
					while($query->have_posts()): $query->the_post(); global $post;
				?>
				<div>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
			</div>
		</div>

		<!-- Colonne de droite -->
		<div class="right-side-page">
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