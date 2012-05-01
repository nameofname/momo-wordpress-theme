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
		<div id="home">
			<div id="content" role="main">
            <?php
                $path = get_option('momo_hero_banner'); 
                if (getimagesize($path)) {
                    echo "<img id='momo_hero_banner' src='$path' alt='' />"; 
                }
            ?>

			<?php if ( have_posts() ) : ?>

				<?php 
            $home_page_loop_num = 0; 
            while ( have_posts() ) : the_post(); 
                if (($home_page_loop_num <= 9   )) {
                    get_template_part( 'content-home', get_post_format() );
                }
                $home_page_loop_num++; 
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
