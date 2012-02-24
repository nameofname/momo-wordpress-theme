<?php
/*
Template Name: Image Gallery
*/
?>
<?php get_header(); ?>
       
    <div id="innerpage" class="archive">
    <div class="col-full">
    
		<div class="col-left <?php if (woo_active_sidebar('sidebar-pages')) : echo "with-sidebar"; endif; ?> ">
		    
				<div <?php post_class(); ?>>

                    <?php if ( $GLOBALS['thumb_single'] == "true" ) woo_get_image('image',$GLOBALS['single_w'],$GLOBALS['single_h'],'thumbnail alignright'); ?>
                    <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    
                    <div class="entry">
                    	<?php query_posts('showposts=60'); ?>
               			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
               			    <?php $wp_query->is_home = false; ?>
			   			
               			    <?php woo_get_image('image',100,100,'thumbnail alignleft'); ?>
               			    
               			   <?php endwhile; endif; ?>
               			   <div class="fix"></div>
					</div> 
                    
                </div><!-- /.post -->         
        
		</div><!-- /.col-left -->

		<?php get_sidebar(); ?>
	
	</div><!-- /.col-full -->
    </div><!-- /#innerpage -->
		
<?php get_footer(); ?>