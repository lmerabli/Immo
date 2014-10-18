
			</div><!-- #main -->

			<footer id="colophon" class="site-footer" role="contentinfo">

				<?php get_sidebar( 'footer' ); ?>

				<div class="site-info">
					<?php do_action( 'twentyfourteen_credits' ); ?>
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyfourteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfourteen' ), 'WordPress' ); ?></a>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div><!-- #page -->

		<?php wp_footer(); ?>
	</body>
</html>