
			</div><!-- #main -->

			<!-- FOOTER -->
			<footer id="colophon" class="footer" role="contentinfo">

				<?php get_sidebar( 'footer' ); ?>

				<div class="site-info">
					<?php do_action( 'immotheme_credits' ); ?>
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'immotheme' ) ); ?>"><?php printf( __( 'Propulsé par %s', 'immotheme' ), 'WordPress' ); ?></a>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div><!-- #page -->

		<?php wp_footer(); ?>
	</body> <!-- Fin body -->
</html> <!-- Fin html -->