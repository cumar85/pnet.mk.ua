<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package big-brother
 */
?>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php do_action( 'before_sidebar' ); ?>
		<div class="secondary widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; // end sidebar widget area