<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package big-brother
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<link rel="icon" href="<?php bloginfo('url'); ?>/wp-content/uploads/2015/04/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/wp-content/uploads/2015/04/favicon.ico" type="image/x-icon" />

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header clearfix" role="banner">
	
	<!--
		<?php if ( get_header_image() ) : ?>
			<?php $headerclass = ' has-header'; ?>
			<div class="header-image" style="background-image: url(<?php echo esc_url( get_custom_header()->url ); ?>); "></div>
		<?php endif; // End header image check. ?>
		
	-->
	    
		
		
		
	    <div class="header-image"> </div>

	
		<div class="site-branding<?php echo $headerclass; ?>">
			<?php //big_brother_the_site_logo(); ?>
			<div id ="height_header" style ="height: 1px;"> </div>
			<div> <img src="<?php bloginfo('template_url')?>/img/logo.png" alt="" style=""> </div>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<nav id="site-navigation" class="main-navigation nav-horizontal<?php echo $headerclass; ?>" role="navigation">
			<h1 class="menu-toggle"><?php _e( 'Меню', 'big-brother' ); ?></h1>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'big-brother' ); ?></a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content clearfix">
