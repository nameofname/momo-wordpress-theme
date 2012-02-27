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

				<?php
					// Spit out all comments (get all when you pass null instead of a number 
          // AND dump the commenting form. 
          echo get_post_comments($post->ID, null); 
          momo_comments_form(); 
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
