<?php
/**
 * big-brother functions and definitions
 *
 * @package big-brother
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700; /* pixels */

if ( ! function_exists( 'big_brother_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function big_brother_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on big-brother, use a find and replace
	 * to change 'big-brother' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'big-brother', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'big-brother' ),
		'social'  => __( 'Social Links', 'big-brother' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'big_brother_custom_background_args', array(
		'default-color'       => 'f5f6f7',
		'default-position-x'  => 'middle',
		'default-repeat'      => 'no-repeat',
	) ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
endif; // big_brother_setup
add_action( 'after_setup_theme', 'big_brother_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function big_brother_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'big-brother' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'big_brother_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function big_brother_scripts() {
	wp_enqueue_style( 'big-brother-style', get_stylesheet_uri() );
	wp_enqueue_style( 'my', get_template_directory_uri() . '/my.css' );
	wp_enqueue_style( 'big-brother-gentium' );
	wp_enqueue_style( 'big-brother-open-sans' );

	wp_enqueue_script( 'big-brother-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'big-brother-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'validation', get_template_directory_uri() . '/js/validation.js', array( 'jquery' ), '1.1');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'big-brother-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'big_brother_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
* Breadcrumbs
*/
function big_brother_the_breadcrumbs() {

        if ( ! is_home() && ! is_front_page() ) {

		$before = '<span class="breadcrumbs-current">';
		$after = '</span>';

		echo '<a class="breadcrumbs-root" href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Головна', 'big-brother' ) . '</a>';

		if ( is_category() ) {
			global $wp_query;
			$cat = get_category( $wp_query->get_queried_object()->term_id );
			$cat_parents = get_category_parents( get_category( $cat->parent ), true, '<span class="sep"></span>' );

			if ( 0 < $cat->parent && ! is_wp_error( $cat_parents ) )
				echo '<span class="breadcrumbs-ancestor cat-parents">' . $cat_parents . '</span>';
			echo $before . single_cat_title( '', false ) . $after;

		} elseif ( is_day() ) {
			echo '<span class="breadcrumbs-ancestor"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></span>';
			echo '<span class="breadcrumbs-ancestor"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></span>';
			echo $before . get_the_time( 'd' ) . $after;

		} elseif ( is_month() ) {
			echo '<span class="breadcrumbs-ancestor"><a href="' . get_year_link( get_the_time('Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></span>';
			echo $before . get_the_time( 'F' ) . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;

		} elseif ( is_single() ) {
			if ( is_attachment() ) {
				global $post;
				echo '<span class="breadcrumbs-ancestor"><a href="' . esc_url( get_permalink( $post->post_parent ) ) . '">' . get_the_title( $post->post_parent ) . '</a></span>' . $before . get_the_title() . $after;
			} else {
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_page() ) {
			global $post;
			if ( $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$parent_links = array();
				while ( $parent_id ) {
					$page = get_post( $parent_id );
					$parent_links[] = '<span class="breadcrumbs-ancestor"><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a></span>';
					$parent_id  = $page->post_parent;
				}
				echo implode( array_reverse( $parent_links ) );
			}
			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf( __( 'Search results for &#39;%s&#39;', 'big-brother' ), get_search_query() ) . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf( __( 'Posts tagged &#39;%s&#39;', 'big-brother' ), single_tag_title( '', false ) ) . $after;

		} elseif ( is_author() ) {
			global $author;
			echo $before . sprintf( __( 'Articles posted by %s', 'big-brother' ), get_userdata( $author )->display_name ) . $after;

		} elseif ( is_404() ) {
			echo $before . __( 'Error 404', 'big-brother' ) . $after;
		} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
			echo $before . __( 'Asides', 'big-brother' ) . $after;
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			echo $before . __( 'Images', 'big-brother') . $after;
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			echo $before . __( 'Videos', 'big-brother' ) . $after;
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			echo $before . __( 'Quotes', 'big-brother' ) . $after;
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			echo $before . __( 'Links', 'big-brother' ) . $after;
		}

		if ( get_query_var( 'paged' ) ) {
			echo $before . '(' . sprintf( __( 'Page %s', 'big-brother' ), get_query_var( 'paged' ) ) . ')' . $after;
		}
	}
}

/**
 * Register Google Fonts
 */
function big_brother_google_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	/*	translators: If there are characters in your language that are not supported
		by Gentium, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Gentium font: on or off', 'big-brother' ) ) {

		wp_register_style( 'big-brother-gentium', "$protocol://fonts.googleapis.com/css?family=Gentium+Basic:400,700,400italic,700italic" );

	}

	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'big-brother' ) ) {

		wp_register_style( 'big-brother-open-sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,800" );

	}

}
add_action( 'init', 'big_brother_google_fonts' );

/**
 * Enqueue Google Fonts for custom headers
 */
function big_brother_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'big-brother-gentium' );
	wp_enqueue_style( 'big-brother-open-sans' );

}













add_action( 'admin_enqueue_scripts', 'big_brother_admin_scripts' );
