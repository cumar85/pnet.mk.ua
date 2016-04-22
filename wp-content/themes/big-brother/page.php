<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package big-brother
 */

get_header(); ?>

	<?php if( function_exists( 'big_brother_the_breadcrumbs' ) ) : ?>
		<div class="breadcrumbs">
			<?php big_brother_the_breadcrumbs(); ?>
		</div>
	<?php endif; ?>
	<div class="content-area primary">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-wrapper">
					<?php get_template_part( 'content', 'page' ); ?>
				</div>
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
