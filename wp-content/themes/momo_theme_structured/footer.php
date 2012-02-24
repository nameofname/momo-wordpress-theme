	<?php if(!is_home() && (woo_active_sidebar('footer-pages-left') || woo_active_sidebar('footer-pages-right') || woo_active_sidebar('footer-blog-left') || woo_active_sidebar('footer-blog-right'))){ ?>
	
			<div class="section footer">
    			
    			<div class="col-full">
    			
    				<div class="heading col-left">
    					
    					<h2><?php _e(get_option('woo_widgets_footer_panel_header'), 'woothemes') ?></h2>
    					
    					<span class="sub-heading"><?php _e(get_option('woo_widgets_footer_panel_description'), 'woothemes') ?></span>
    					
    				</div><!-- /.heading -->
    				
    				<div id="home-widgets" class="content col-right">
    					
    					<div class="col-left">
    						<?php 
    							if(is_page()){
	    							woo_sidebar('footer-pages-left');
	    						}else{
	    							woo_sidebar('footer-blog-left');
	    						}
    						?>
    					</div>
    					
    					<div class="col-right">    				
    						<?php 
    							if(is_page()){
	    							woo_sidebar('footer-pages-right');
	    						}else{
	    							woo_sidebar('footer-blog-right');
	    						}
    						?>
						</div>	    					
    					
    				</div><!-- /.content -->
    			
    			</div><!-- /.col-full -->
    	
    		</div><!-- /.section -->
		
		<?php } ?>


	<div id="footer">
		
		<div class="col-full">
		
			<div id="copyright" class="col-left">
				<p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>. <?php _e('All Rights Reserved.', 'woothemes') ?></p>
			</div>
			
			<div id="credit" class="col-right">
				<!--<p><?php _e('Powered by', 'woothemes') ?> <a href="http://www.wordpress.org"><?php _e('WordPress', 'woothemes') ?></a>. <?php _e('Designed by', 'woothemes') ?> <a href="http://www.woothemes.com"><img src="<?php bloginfo('template_directory'); ?>/images/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>-->
			</div>
			
		</div><!-- /.col-full -->
		
	</div><!-- /#footer  -->

</div><!-- /#wrapper -->
<script type="text/javascript">
	var tb_pathToImage = "<?php echo get_option('siteurl').'/'. WPINC.'/js/thickbox/loadingAnimation.gif'; ?>";
	var tb_closeImage = "<?php echo get_option('siteurl').'/'. WPINC.'/js/thickbox/tb-close.png'; ?>";
</script>
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>