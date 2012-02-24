<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
       
    <div id="innerpage" class="archive">
    <div class="col-full">
    
		<div class="col-left">
		           
            <?php if (have_posts()) : $count = 0; ?>
            
            <?php while (have_posts()) : the_post(); $count++; ?>
            
				<div <?php post_class(); ?>>

                    <?php if ( $GLOBALS['thumb_single'] == "true" ) woo_get_image('image',$GLOBALS['single_w'],$GLOBALS['single_h'],'thumbnail alignright'); ?>

                    <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    
                    <div class="entry">
                    	<?php the_content(); ?>
					</div> 
                    
                </div><!-- /.post -->                
                                                         
			<?php endwhile; else: ?>
				<div class="post">
                	
                	<h2 class="title"><?php _e('Error 404 - Page not found!', 'woothemes') ?></h2>
                    
                    <div class="entry">
                    	<p><?php _e('The page you trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'woothemes') ?></p>
					</div>
                	
  				</div><!-- /.post -->             
           	<?php endif; ?> 
        
		</div><!-- /.col-left -->
	
	</div><!-- /.col-full -->
    </div><!-- /#innerpage -->
		
<?php get_footer(); ?>