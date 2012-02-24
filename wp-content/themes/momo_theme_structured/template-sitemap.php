<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
       
    <div id="innerpage" class="archive">
    <div class="col-full">
    
		<div class="col-left <?php if (woo_active_sidebar('sidebar-pages')) : echo "with-sidebar"; endif; ?> ">
		    
				<div <?php post_class(); ?>>

                    <h2 class="title"><?php the_title(); ?></h2>
	        	
	        	<div class="entry">
	            
	            	<h3><?php _e('Pages', 'woothemes') ?></h3>
	
	            	<ul>
	           	    	<?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' ); ?>		
	            	</ul>				
	    
		            <h3><?php _e('Categories', 'woothemes') ?></h3>
	
		            <ul>
	    	            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
	        	    </ul>
			        
			        <h3><?php _e('Posts per category', 'woothemes') ?></h3>
			        
			        <?php
			    
			            $cats = get_categories();
			            foreach ($cats as $cat) {
			    
			            query_posts('cat='.$cat->cat_ID);
			
			        ?>
	        
	        			<h4><?php echo $cat->cat_name; ?></h4>
						
			        	<ul>	
	    	        	    <?php while (have_posts()) : the_post(); ?>
	        	    	    <li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments', 'woothemes') ?> (<?php echo $post->comment_count ?>)</li>
	            		    <?php endwhile;  ?>
			        	</ul>
	    
	    		    <?php } ?>
	    		
	    		</div><!-- /.entry -->
                    
                </div><!-- /.post -->             
        
		</div><!-- /.col-left -->

		<?php get_sidebar(); ?>
	
	</div><!-- /.col-full -->
    </div><!-- /#innerpage -->
		
<?php get_footer(); ?>
