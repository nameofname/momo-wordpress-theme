
<?php get_header(); ?>

	<?php if (!$paged) { include ( TEMPLATEPATH . '/includes/featured-slider.php' ); } ?>
	<?php $alt_class = 0; $homepage = true; ?>
    <div id="main">
    	<?php 
          if (!$paged && get_option('woo_widgets_footer_panel') == 'true') { 
      ?>
    	<div class="section">
    	
    		<div class="col-full">
    		
    			<!-- /.heading -->
    			
    			<div id="home-widgets" class="content col-left">
    				<strong>
    				<a href="/?cat=16">BEVERAGE</a> | <a href="/?cat=10">KO</a> | <a href="/?cat=15">MA PECHE | <a href="/?cat=12">NOODLE BAR</a> | <a href="/?cat=18">SEIOBO</a> | <a href="/?cat=13">SSAM BAR</a> | <a href="/?cat=14">TEST KITCHEN</a><br /><br />
 			</strong>
    				<div class="col-left">
    					<?php woo_sidebar('home-left'); ?>
    				</div>
    				
    			</div><!-- /.content -->
    		
    		</div><!-- /.col-full -->
    	
    	</div><!-- /.section -->
    	<?php 
          $alt_class++; $homepage = true; 
      }
      ?>
    	<?php if (get_option('woo_blog_footer_panel') == 'true') { ?>
    	<div class="section <?php if ($alt_class == 1) { ?>alt<?php } ?>">
    	
    		<div class="col-full">
    		
    			<div class="heading col-left">
    				
    				<h2><?php _e(get_option('woo_blog_footer_panel_header'), 'woothemes') ?></h2>
    				
    				<span class="sub-heading"><?php _e(get_option('woo_blog_footer_panel_description'), 'woothemes') ?></span>
    				
    			</div><!-- /.heading -->
    			
    			<div class="content col-right blog">
    				<?php $category_id = array(); ?>
    				<?php $numberposts = get_option('woo_blog_number_of_posts'); ?>
    				<?php query_posts(array('category__not_in' => $category_id, 'posts_per_page' => $numberposts)); ?>
        			<?php if (have_posts()) : $count = 0; ?>
        			
        			<ul>
        			
        			<?php while (have_posts()) : the_post(); $count++; ?>
        			
        			<li>
              	
                		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                		
                			<span class="date"><?php the_time(get_option('date_format')); ?></span>
                			<span class="excerpt">
                				<span><?php the_title(); ?></span>
                	    		<?php echo strip_tags(get_the_excerpt()); ?>
                	    	</span>
		                	
		                	<br class="fix" />
		                	
		                </a>
		                
		            </li>
                                                
       				<?php endwhile; ?>
       				
       				</ul>
       				
       				<?php endif; ?>
    				
    				<div class="archive">
    					<a href="http://www.greinkestrasburg.com/?page_id=67" title="Archive">Blog Archive &rarr;</a>
    				</div>
    				
    				<div class="fix"> </div>
    				
    			</div><!-- /.content -->
    		
    		</div><!-- /.col-full -->
    	
    	</div><!-- /.section -->
    	<?php $alt_class++; $homepage = true;} ?>
    	<?php if ($homepage && get_option('woo_contact_footer_panel') == 'true') { ?>
    	<div class="section <?php if ($alt_class == 1) { ?>alt<?php } ?>">
    	
    		<div class="col-full">
    		
    			<div class="heading col-left">
    				
    				<h2><?php _e(get_option('woo_contact_footer_panel_header'), 'woothemes') ?></h2>
    				
    				<span class="sub-heading"><?php _e(get_option('woo_contact_footer_panel_description'), 'woothemes') ?></span>
    				
    			</div><!-- /.heading -->
    			
    			<div class="content col-right contact">
    			
    				<div class="col-left">
    				
	    				<?php include ( TEMPLATEPATH . '/includes/homepage-contact.php' ); ?>
	    				
	    			</div><!-- .col-left -->
	    			
	    			<div class="col-right">
	    			
	    				<ul>
	    					<li class="rss"><a href="<?php $GLOBALS[feedurl] = get_option('woo_feed_url'); if ( $feedurl ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>" title="<?php _e('RSS Feed','woothemes'); ?>"><?php _e('Subscribe to our RSS Feed', 'woothemes'); ?></a></li>
	    					<li class="twitter"><a href="http://twitter.com/<?php echo get_option('woo_contactform_twitter'); ?>" title="<?php _e('Twitter','woothemes'); ?>"><?php _e('Follow us on Twitter', 'woothemes'); ?></a></li>
	    					<li class="fb"><a href="<?php echo get_option('woo_contactform_facebook'); ?>" title="<?php _e('Facebook','woothemes'); ?>"><?php _e('Become a fan on Facebook', 'woothemes'); ?></a></li>
	    				</ul>
	    			
	    			</div><!-- /.col-right -->
    				
    			</div><!-- /.content -->
    		
    		</div><!-- /.col-full -->
    	
    	</div><!-- /.section -->
		<?php $alt_class++; } ?>
    </div><!-- /#main -->
		
<?php get_footer(); ?>
