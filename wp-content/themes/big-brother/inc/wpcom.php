<?php
/**
 * WordPress.com-specific functions and definitions
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Big-Brother
 */

function big_brother_theme_colors() {
	global $themecolors;

	/**
	 * Set a default theme color array for WP.com.
	 *
	 * @global array $themecolors
	 */
	if ( ! isset( $themecolors ) ) :
		$themecolors = array(
			'bg' => 'f5f6f7',
			'border' => 'a6b7c0',
			'text' => '444444',
			'link' => '1185d7',
			'url' => '1185d7',
		);
	endif;
}
add_action( 'after_setup_theme', 'big_brother_theme_colors' );

 /**
 * Adds support for WP.com print styles
 */
function big_brother_theme_support() {
	add_theme_support( 'print-style' );
}
add_action( 'after_setup_theme', 'big_brother_theme_support' );

//WordPress.com specific styles
function big_brother_wpcom_styles() {
	wp_enqueue_style( 'big_brother-wpcom', get_template_directory_uri() . '/inc/style-wpcom.css', '060314' );
}
add_action( 'wp_enqueue_scripts', 'big_brother_wpcom_styles' );

/*
 * De-queue Google fonts if custom fonts are being used instead
 */
function big_brother_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		$customfonts = TypekitData::get( 'families' );
		if ( $customfonts && $customfonts['site-title']['id'] && $customfonts['headings']['id'] && $customfonts['body-text']['id'] ) {
			wp_dequeue_style( 'big-brother-gentium' );
			wp_dequeue_style( 'big-brother-open-sans' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'big_brother_dequeue_fonts' );