<?php get_header(); ?>
       
    <div id="innerpage" class="archive">
    <div class="col-full">
    
		<div class="col-left <?php if (woo_active_sidebar('sidebar-pages')) : echo "with-sidebar"; endif; ?> ">
		           
            <?php if (have_posts()) : $count = 0; ?>
            
            <?php while (have_posts()) : the_post(); $count++; ?>
            
				<div <?php post_class(); ?>>

                    <?php if ( $GLOBALS['thumb_single'] == "true" ) woo_get_image('image',$GLOBALS['single_w'],$GLOBALS['single_h'],'thumbnail alignright'); ?>

                    <h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                    
                    <div class="entry">
                    	<?php the_content(); ?>
					</div> 
                    
                </div><!-- /.post -->
                
                <?php $comm = get_option('woo_comments'); if ( 'open' == $post->comment_status && ($comm == "page" || $comm == "both") ) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>           
                                                         
			<?php endwhile; else: ?>
				<div class="post">
                	
                	<h2 class="title"><?php _e('Error 404 - Page not found!', 'woothemes') ?></h2>
                    
                    <div class="entry">
                    	<p><?php _e('The page you trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'woothemes') ?></p>
					</div>
                	
  				</div><!-- /.post -->             
           	<?php endif; ?> 
        
		</div><!-- /.col-left -->

		<?php get_sidebar(); ?>
	
	</div><!-- /.col-full -->
    </div><!-- /#innerpage -->
		
<?php get_footer(); ?>