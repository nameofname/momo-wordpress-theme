<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Custom theme actions/functions
	- Add specific IE styling/hacks to HEAD
	- Add custom styling
	- Set global php variables
- Custom hook definitions

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Custom functions */
/*-----------------------------------------------------------------------------------*/

// Add specific IE styling/hacks to HEAD
add_action('wp_head','woo_IE_head');
function woo_IE_head() {
?>

<!--[if IE 6]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" />
<![endif]-->	

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" />
<![endif]-->

<?php
}

// Add custom styling
add_action('woo_head','woo_custom_styling');
function woo_custom_styling() {
	
	// Get options
	$link = get_option('woo_link_color');
	$hover = get_option('woo_link_hover_color');
	$button = get_option('woo_button_color');
		
	// Add CSS to output
	if ($link)
		$output .= 'a:link, a:visited {color:'.$link.'}' . "\n";
	if ($hover)
		$output .= 'a:hover {color:'.$hover.'}' . "\n";
	if ($button)
		$output .= '.button, .reply a {background-color:'.$button.'}' . "\n";
	
	// Output styles
	if (isset($output)) {
		$output = "<!-- Woo Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
		echo $output;
	}
		
} 

// Set global php variables
add_action('woo_head','woo_globals');
function woo_globals() {
	
	// Set global Thumbnail dimensions and alignment
	$GLOBALS['thumb_align'] = 'alignleft'; $align = get_option('woo_thumb_align'); if ($align) $GLOBALS['thumb_align'] = $align; 			
	$GLOBALS['thumb_w'] = '100'; $thumb_w =  get_option('woo_thumb_w'); if ($thumb_w) $GLOBALS['thumb_w'] = $thumb_w;	
	$GLOBALS['thumb_h'] = '100'; $thumb_h =  get_option('woo_thumb_h'); if ($thumb_w) $GLOBALS['thumb_h'] = $thumb_h;	

	// Set global Single Post thumbnail dimensions
	$GLOBALS['thumb_single'] = 'false'; $enable =  get_option('woo_thumb_single'); if ($enable) $GLOBALS['thumb_single'] = $enable;	
	$GLOBALS['single_h'] = '150'; $single_h =  get_option('woo_single_h'); if ($thumb_w) $GLOBALS['single_h'] = $single_h;	
	$GLOBALS['single_w'] = '150'; $single_w =  get_option('woo_single_w'); if ($thumb_w) $GLOBALS['single_w'] = $single_w;	

}



/*-----------------------------------------------------------------------------------*/
/* Custom Hook definition */
/*-----------------------------------------------------------------------------------*/

// Add any custom hook definitions you want here
// function woo_hook_name() { do_action( 'woo_hook_name' ); }					

?>