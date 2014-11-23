<?php get_header(); ?>
<div class="single-post-encart">
	<div class="single-post-view">
		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<nav class="nav-single">
						<h3 class="nav-text"><?php _e( 'Post navigation', 'immotheme' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'immotheme' ) . '</span> %title' ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'immotheme' ) . '</span>' ); ?></span>
					</nav><!-- .nav-single -->

					<div class="single-post">
	    				<h1 class="single-post-title"><?php the_title(); ?></h1>
	        			<p class="single-post-info">
	          				Posté le <?php the_date(); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
	        			</p>
	        			<div class="single-post-content">
	          				<?php the_content(); ?>
	        			</div>
	    				<div class="single-post-comments">
	          				<?php comments_template(); ?>
	        			</div>
	      			</div>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		<div class="sidebar-single-post">
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
	</div>
	<?php get_footer(); ?>
</div>