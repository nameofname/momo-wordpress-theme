<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */

get_header(); ?>
<?php get_sidebar(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

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
