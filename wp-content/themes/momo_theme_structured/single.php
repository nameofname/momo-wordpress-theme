<?php get_header(); ?>
       
    <div id="innerpage">
    <div class="col-full">
    
		<div class="col-left <?php if (woo_active_sidebar('sidebar-blog')) : echo "with-sidebar"; endif; ?> ">
		           
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
            
				<div <?php post_class(); ?>>

                    <?php if ( $GLOBALS['thumb_single'] == "true" ) woo_get_image('image',$GLOBALS['single_w'],$GLOBALS['single_h'],'thumbnail alignright'); ?>

                    <h1 class="title"><?php the_title(); ?></h1>
                    
                    <p class="post-meta">
                    	<span class="small"><?php _e('by', 'woothemes') ?></span> <span class="post-author"><?php the_author_posts_link(); ?></span> &bull;
                    	<span class="small"><?php _e('on', 'woothemes') ?></span> <span class="post-date"><?php the_time(get_option('date_format')); ?></span> &bull;
                    	<span class="small"><?php _e('in', 'woothemes') ?></span> <span class="post-category"><?php the_category(', ') ?></span>
   	                    <?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
                    </p>
                    
                    <div class="entry">
                    	<?php the_content(); ?>
					</div>
										
					<?php the_tags('<p class="tags">Tags: ', ', ', '</p>'); ?>
                    
                </div><!-- /.post -->
                
                <?php woo_postnav(); ?>
                
                <?php $comm = get_option('woo_comments'); if ( 'open' == $post->comment_status && ($comm == "post" || $comm == "both") ) : ?>
	                <?php comments_template('', true); ?>
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