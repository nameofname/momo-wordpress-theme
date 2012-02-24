<?php
/**
 * The HOME PAGE!
 *
 * This is used as the home page if no static home page is used (static home pages use front-page.php)
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */

get_header(); ?>

<?php get_sidebar(); ?>
		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php Momofuku_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php Momofuku_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'Momofuku' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'Momofuku' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
