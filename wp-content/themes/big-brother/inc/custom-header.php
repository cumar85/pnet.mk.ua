<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package big-brother
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses big_brother_header_style()
 * @uses big_brother_admin_header_style()
 * @uses big_brother_admin_header_image()
 *
 * @package big-brother
 */
function big_brother_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'big_brother_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1000,
		'height'                 => 200,
		'flex-height'            => true,
		'flex-width'            => true,
		'wp-head-callback'       => 'big_brother_header_style',
		'admin-head-callback'    => 'big_brother_admin_header_style',
		'admin-preview-callback' => 'big_brother_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'big_brother_custom_header_setup' );

if ( ! function_exists( 'big_brother_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see big_brother_custom_header_setup().
 */
function big_brother_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // big_brother_header_style

if ( ! function_exists( 'big_brother_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see big_brother_custom_header_setup().
 */
function big_brother_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			background-color: #1f567d;
			background-repeat: no-repeat;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			border: none;
			padding: 50px 0 30px;
			text-align: center;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
			margin: 0;
			font-family: "Open Sans", Helvetica, Arial, sans-serif;
			font-size: 30px;
			font-weight: 800;
			text-transform: uppercase;
		}
		#headimg h1 a {
			text-decoration: none;
		}
		#headimg h1 a:hover {
			text-decoration: underline;
		}
		#desc {
			margin: 0;
			font-size: 18px;
			font-weight: 400;
			font-family: "Gentium Basic", Georgia, "Times New Roman", Times, serif;
			font-style: italic;
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // big_brother_admin_header_style

if ( ! function_exists( 'big_brother_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see big_brother_custom_header_setup().
 */
function big_brother_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$bgstyle = '';

	if ( get_header_image() ) :
		$bgstyle = 'style="background-image:url(' . esc_url( get_custom_header()->url ) . ')"';
	endif;
?>
	<div id="headimg"<?php echo $bgstyle; ?>>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php
}
endif; // big_brother_admin_header_image
