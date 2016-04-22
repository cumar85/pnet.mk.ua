<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package big-brother
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer-wrapper">
			<div class="site-info">
			
				<?php do_action( 'big_brother_credits' ); ?>
			<!-- 	<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'big-brother' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'big-brother' ), 'Big Brother', '<a href="http://automattic.com" rel="designer">WordPress.com</a>' ); ?>
			-->
			
			Комунальне підприємство Миколаївської міської ради «Миколаївелектротранс»<br>
			Телефон:&nbsp;&nbsp;(0512) 36-40-79&nbsp;&nbsp;&nbsp;&nbsp;Факс:&nbsp;&nbsp;(0512) 36-02-41<br>
			Електронна адреса:&nbsp;&nbsp;nikpnet@ukr.net<br>
			</div><!-- .site-info -->
			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<div id="social-links">
					<?php wp_nav_menu( array( 'theme_location' => 'social', 'depth' => 1, 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'container_class' => 'social-links', ) ); ?>
				</div>
			<?php endif; ?>
		</div><!-- .site-footer-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>