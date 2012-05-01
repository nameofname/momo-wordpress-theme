<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */

get_header(); ?>

<?php get_sidebar(); ?>
		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( '%s' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
					?>
				</header>

				<?php /* Start the Loop */ ?>
				<?php 
        while ((have_posts()))  {
            the_post(); 
            // determine whether you are in an Ideas sub-category.  If so, use the content-home style post format. 
            if (is_category()) {
                $cat = get_query_var('cat');
                $the_cat = get_category ($cat); 
                $is_ideas = (strpos(strtolower($the_cat->name), 'ideas') === FALSE) ? FALSE : TRUE; 
                if ($is_ideas){
                    get_template_part( 'content-home', get_post_format() );
                } else {
                    get_template_part( 'content-archive', get_post_format() );
                }
            } 
        }

				Momofuku_content_nav( 'nav-below' ); 
        
        ?>
			</div><!-- #content -->
		</section><!-- #primary -->
<?php endif; ?>
<?php get_footer(); ?>
