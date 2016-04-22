<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package big-brother
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function big_brother_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer'         => 'page',
	) );

	add_theme_support( 'jetpack-responsive-videos' );

	add_image_size( 'big-brother-logo', 912, 406 );

	add_theme_support( 'site-logo', array( 'size' => 'big-brother-logo' ) );
}
add_action( 'after_setup_theme', 'big_brother_jetpack_setup' );


if ( function_exists( 'jetpack_is_mobile' ) ) {

	function big_brother_has_footer_widgets() {

		if ( is_active_sidebar( 'sidebar-1' ) && jetpack_is_mobile( '', true ) )
			return true;

		return false;
	}

	add_filter( 'infinite_scroll_has_footer_widgets', 'big_brother_has_footer_widgets' );
}

/**
 * Return early if Site Logo is not available.
 */
function big_brother_the_site_logo() {
	if ( ! function_exists( 'the_site_logo' ) ) {
		return;
	} else {
		the_site_logo();
	}
}