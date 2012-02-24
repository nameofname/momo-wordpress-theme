<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>


<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/effects.css" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php $GLOBALS[feedurl] = get_option('woo_feed_url'); if ( $feedurl ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
      
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );  ?>
<?php wp_head(); ?>
<?php woo_head(); ?>

<!-- Slider Setup -->
<script type="text/javascript">
<?php if ( is_home() ) { ?>
jQuery(window).load(function(){
    jQuery("#loopedSlider").loopedSlider({
	<?php
	$autoStart = 0;
	$slidespeed = 600;
	$slidespeed = get_option("woo_slider_speed") * 1000; 
	if ( $slidespeed > 5000) $slidespeed = 5000;
	if ( get_option("woo_slider_auto") == "true" ) 
	   $autoStart = get_option("woo_slider_interval") * 1000;
	else 
	   $autoStart = 0;
	?>
        autoStart: <?php echo $autoStart; ?>, 
        slidespeed: <?php echo $slidespeed; ?>, 
        autoHeight: true
    });
});
<?php } ?>
</script>
<!-- /Slider Setup -->

</head>

<body <?php body_class(); ?>>

<?php woo_top(); ?>

<div id="wrapper">
           
	<div id="header">
	
		<div class="col-full">
 		       
			<div id="logo" class="col-left">
	    	   
			<?php if (get_option('woo_texttitle') <> "true") : $logo = get_option('woo_logo'); ?>
        	    <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
        	        <img src="<?php if ($logo) echo $logo; else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" />
        	    </a>
        	<?php endif; ?> 
        	
        	<?php if( is_singular() ) : ?>
        	    <span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
        	<?php else : ?>
        	    <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        	<?php endif; ?>
        	    <span class="site-description"><?php bloginfo('description'); ?></span>
	    	  	
			</div><!-- /#logo -->

			<div id="navigation" class="col-right">
				<?php wp_nav_menu( array( 'menu' => 'Main Nav', 'menu_id' => 'main-nav', 'menu_class' => 'nav' ) ); ?>
			</div><!-- /#navigation -->
		
		</div><!-- /.col-full -->
		
	</div><!-- /#header -->
    
	
       
