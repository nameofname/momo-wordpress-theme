<?php
/*
Template Name: Archives Page
*/
?>

<?php get_header(); ?>
       
    <div id="innerpage" class="archive">
    <div class="col-full">
    
		<div class="col-left <?php if (woo_active_sidebar('sidebar-pages')) : echo "with-sidebar"; endif; ?> ">
		    
				<div <?php post_class(); ?>>

                    <h2 class="title"><?php the_title(); ?></h2>
			    
				    <div class="entry">
				    
					    <h3><?php _e('The Last 30 Posts', 'woothemes') ?></h3>
																		  
					    <ul>											  
					        <?php query_posts('showposts=30'); ?>		  
					        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					            <?php $wp_query->is_home = false; ?>	  
					            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php the_time(get_option('date_format')); ?> - <?php echo $post->comment_count ?> <?php _e('comments', 'woothemes') ?></li>
					        <?php endwhile; endif; ?>					  
					    </ul>											  
																		  
					    <h3><?php _e('Categories', 'woothemes') ?></h3>	  
																		  
					    <ul>											  
					        <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
					    </ul>											  
					     												  
					    <h3><?php _e('Monthly Archives', 'woothemes') ?></h3>
																		  
					    <ul>											  
					        <?php wp_get_archives('type=monthly&show_post_count=1') ?>	
					    </ul>
				
					</div><!-- /.entry -->
                    
                </div><!-- /.post -->             
        
		</div><!-- /.col-left -->

		<?php get_sidebar(); ?>
	
	</div><!-- /.col-full -->
    </div><!-- /#innerpage -->
		
<?php get_footer(); ?>
