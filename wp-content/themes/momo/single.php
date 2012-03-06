<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */

get_header(); ?>
<?php get_sidebar(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php Momofuku_content_nav( 'nav-below' ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
