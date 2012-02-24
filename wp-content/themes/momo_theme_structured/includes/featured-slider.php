<?php
	// Setup height of slider
	$height = get_option('woo_apz_slider_height');
	if ( $height == "" ) { 
		$height = "500";
	}
	$horizontal_elements = 0;

	global $woo_options;
?>
<div id="feature">
	<?php if (get_option('woo_slider_disable') == 'false') { ?>
    <div class="highlight">
    <div id="loopedSlider" class="col-full">
    
    <div class="container" <?php if ($int_page_count <= 1) { ?>style="height:<?php echo $height; ?>px"<?php } ?>>
        <div class="slides">  
               
    	<?php $slide_count = 0; ?>
		<?php query_posts('posts_per_page=20&suppress_filters=0&post_type=slide&order=ASC&orderby=date'); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; ?>		        					
            <?php $horizontal_slider = get_post_meta($post->ID, "horizontal-slider", true); ?>  
            <?php if ( $horizontal_slider == 'true' ) { $horizontal_elements++; } ?>
            <div id="slide-<?php echo $count; ?>" class="slide" <?php if($count >= 2) { echo 'style="display:none"'; }?>>
                                    
            	<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
                
                <div class="<?php if (get_option('woo_slider_iphone_disable') == 'true') { $width = '283'; $height = '450'; ?>nophone<?php } else { $width = '197'; $height = '295'; ?>iphone<?php } ?><?php if ( $horizontal_slider == 'true' ) { ?>-horizontal <?php } ?> col-left">

					<div class="image">
						<?php if ( $horizontal_slider == 'true' ) { $temp_width = $width; $width = $height; $height = $temp_width; } ?>
						<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
						<?php $image_link = get_post_meta($post->ID, "image", true); ?>	
                    		<a class="thickbox" href="<?php echo $image_link; ?>" title="<?php echo get_the_title(); ?>">
                    		<?php echo woo_image('key=image&class=thickbox&width='.$width.'&height='.$height.'&link=img');?>			
                    		</a>
                		<?php } ?> 
					
					</div><!-- /.image -->
												
				</div><!-- /.iphone -->
                
                <?php } ?>
				
				<div class="info<?php if ( $horizontal_slider == 'true' ) { ?> info-horizontal<?php } ?> col-right" <?php if ( !get_post_meta($post->ID, 'image', true) ) echo 'style="width:auto;"'; ?>>
				
					<div class="entry">
						<?php the_content(); ?>	    				
					</div><!-- /.entry -->
					<?php $app_store_link = get_post_meta($post->ID, 'appstore-link', true); ?>
					<?php if ( ($app_store_link != '') && ($app_store_link != 'http://') ) { ?>
					<a class="appstore" title="Get it on the Appstore" href="<?php echo $app_store_link; ?>" target="_blank"><?php _e('Available on the AppStore', 'woothemes') ?></a>
					<?php } ?>						
				</div><!-- /.info -->

            </div><!-- /.slide -->  
			<?php $slide_count = $count; ?>
        <?php endwhile; endif; ?>
                
        </div><!-- /.slides -->
    </div><!-- /.container -->
    <?php if ($slide_count > 1) { ?>
    <div class="controls">
    							
        <ul class="pagination">
			<?php query_posts('suppress_filters=0&post_type=slide&order=ASC&orderby=date'); ?>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; ?>		        					
	                        
	        <li><a href="#" rel="<?php echo $count; ?>"><?php the_title(); ?></a></li>
	
	        <?php endwhile; endif; ?>
	    </ul>
      						
    </div><!-- /.controls -->
	<?php } ?>
    <div class="fix"></div>	
    
    </div><!-- /#loopedSlider -->
    </div><!-- /.highlight -->
    <?php } ?>
    <?php if (get_option('woo_media_panel_disable') == 'true') { } else { ?>
    <div id="feature-media">
    
    	<div class="col-full">
    		<?php query_posts(array('post_type' => 'media', 'orderby' => 'date', 'order' => 'DESC', 'showposts' => 4)); ?>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; ?>		        					
	            <?php $post_id = get_the_ID(); ?>
	            <?php $image_meta = get_post_meta($post_id, "image", true);?>
	            <?php $embed_code = get_post_meta($post_id, "embed", true);?>
	            <?php $embed_code_width = get_post_meta($post_id, "embed-width", true);?>
	            <?php $embed_code_height = get_post_meta($post_id, "embed-height", true);?>
	            <?php if ($embed_code_width != '') { $embed_code_width = 'width='.$embed_code_width.'&'; } else { $embed_code_width = ''; } ?>
	            <?php if ($embed_code_height != '') { $embed_code_height = 'height='.$embed_code_height.'&'; } else { $embed_code_height = ''; } ?>
	            <?php if ($embed_code) { $type = 'video'; } else { $type = 'image'; } ?>
	            <?php $image_link = get_post_meta($post_id, "image", true); ?>            
	        	<div class="block">
					<?php if ($type == 'video') { ?>
					<a class="thickbox" href="#TB_inline?<?php echo $embed_code_width.$embed_code_height; ?>inlineId=embed<?php echo $post_id; ?>" title="<?php echo get_the_title(); ?>">
    					<span id="embed<?php echo $post_id; ?>" style="display:none;"><?php echo $embed_code; ?></span>
					<?php }
					elseif ($type == 'image') { ?>
					<a class="thickbox" href="<?php echo $image_meta; ?>" title="<?php echo get_the_title(); ?>">
					<?php } ?>
    					<span class="media-overlay">&nbsp;</span>
    					<?php if ($image_link == '') { $image_link = get_bloginfo('template_directory').'/images/temp/featured-screen.jpg'; ?><img width=148 height=97 src="<?php echo $image_link; ?>" alt="Icon" /><?php } else { echo woo_image('class=thickbox&width=148&height=97&alt=Icon&link=img'); } ?>
    				</a>
    				<span class="media-type <?php if ($type == 'video') { echo 'vid'; } elseif ($type == 'image') { echo 'pic'; } else { echo ''; } ?>">&nbsp;</span>
		    	</div><!-- /.block -->
	
	        <?php endwhile; endif; ?>
		 
    	</div><!-- /.col-full -->
    
    </div><!-- /.featured-media -->
    <?php } ?>
</div><!-- /#feature -->