<?php

add_action('init','woo_global_options');
function woo_global_options() {
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option('woo_options');
}

add_action( 'admin_head','woo_options' );  
if (!function_exists('woo_options')) {
function woo_options() {
	
// VARIABLES
$themename = "Apz";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/apz/';
$shortname = "woo";

$GLOBALS['template_path'] = get_bloginfo('template_directory');

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

//Testing 
$options_select = array("one","two","three","four","five");
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options


$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// THIS IS THE DIFFERENT FIELDS
$options = array();   

$options[] = array( "name" => "General Settings",
					"icon" => "general",
                    "type" => "heading");
                        
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify an image URL directly.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Text Title",
					"desc" => "Enable if you want Blog Title and Tagline to be text-based. Setup title/tagline in WP -> Settings -> General.",
					"id" => $shortname."_texttitle",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "E-Mail URL",
					"desc" => "Enter your preferred E-mail subscription URL. (Feedburner or other)",
					"id" => $shortname."_subscribe_email",
					"std" => "",
					"type" => "text");



$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Post/Page Comments",
					"desc" => "Select if you want to enable/disable comments on posts and/or pages. ",
					"id" => $shortname."_comments",
					"type" => "select2",
					"options" => array("post" => "Posts Only", "page" => "Pages Only", "both" => "Pages / Posts", "none" => "None") );                                                          
    
$options[] = array( "name" => "Styling Options",
					"icon" => "styling",
					"type" => "heading");    

$options[] = array( "name" =>  "Link Color",
					"desc" => "Pick a custom color for links or add a hex color code e.g. #697e09",
					"id" => "woo_link_color",
					"std" => "",
					"type" => "color");   

$options[] = array( "name" =>  "Link Hover Color",
					"desc" => "Pick a custom color for links hover or add a hex color code e.g. #697e09",
					"id" => "woo_link_hover_color",
					"std" => "",
					"type" => "color");                    

$options[] = array( "name" =>  "Button Color",
					"desc" => "Pick a custom color for buttons or add a hex color code e.g. #697e09",
					"id" => "woo_button_color",
					"std" => "",
					"type" => "color");                    
					
$options[] = array(	"name" => "Featured Area",
					"icon" => "featured",
					"type" => "heading");					

$options[] = array( "name" => "Disable Slider",
					"desc" => "Check this to disable the slider on the homepage.",
					"id" => $shortname."_slider_disable",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Disable Featured Media",
					"desc" => "Check this to disable the featured media area on the homepage below the slider.",
					"id" => $shortname."_media_panel_disable",
					"std" => "false",
					"type" => "checkbox");  					

$options[] = array( "name" => "Disable iPhone Image",
					"desc" => "Check this to disable the iPhone image container in the slider on the homepage.",
					"id" => $shortname."_slider_iphone_disable",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Featured Slider Height",
					"desc" => "Set a manual height for the slider e.g. 250. Default height is 500px. <br /><strong>Note: this only applies when there is only one slide.</strong>",
					"id" => $shortname."_apz_slider_height",
					"std" => "500",
					"type" => "text"); 
                    
$options[] = array(    "name" => "Animation Speed",
                    "desc" => "The time in <b>seconds</b> the animation between frames will take.",
                    "id" => $shortname."_slider_speed",
                    "std" => 0.6,
					"type" => "select",
					"options" => array( '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0' ) );

$options[] = array(    "name" => "Auto Start",
                    "desc" => "Set the slider to start sliding automatically.",
                    "id" => $shortname."_slider_auto",
                    "std" => "false",
                    "type" => "checkbox");   
                    
$options[] = array(    "name" => "Auto Slide Interval",
                    "desc" => "The time in <b>seconds</b> each slide pauses for, before sliding to the next.",
                    "id" => $shortname."_slider_interval",
                    "std" => "4",
					"type" => "select",
					"options" => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ) );
					 					                   
										
$options[] = array( "name" => "Widgets Panel",
					"icon" => "misc",
				    "type" => "heading");
				    
$options[] = array( "name" => "Enable Widget Panel on the homepage",
					"desc" => "Show the widgets panel on the homepage.",
					"id" => $shortname."_widgets_footer_panel",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array(	"name" => "Widgets Panel Header",
					"desc" => ".",
					"id" => $shortname."_widgets_footer_panel_header",
					"std" => "Widgets",
					"type" => "text");

$options[] = array(	"name" => "Widgets Panel Description",
					"desc" => ".",
					"id" => $shortname."_widgets_footer_panel_description",
					"std" => "A space for your widgets",
					"type" => "text");
										               
$options[] = array( "name" => "Blog Panel",
					"icon" => "misc",
				    "type" => "heading");   
				    
$options[] = array( "name" => "Enable Blog Panel on the homepage",
					"desc" => "Show the blog panel on the homepage.",
					"id" => $shortname."_blog_footer_panel",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array(	"name" => "Number of Blog Posts to display",
					"desc" => "The number of posts that will be displayed on the homepage",
					"id" => $shortname."_blog_number_of_posts",
					"std" => "3",
					"type" => "text");
										
$options[] = array(	"name" => "Blog Panel Header",
					"desc" => "This is the text that will be displayed on the homepage for the panel.",
					"id" => $shortname."_blog_footer_panel_header",
					"std" => "Blog",
					"type" => "text");

$options[] = array(	"name" => "Blog Panel Description",
					"desc" => "This is the text that will be displayed under the header on the homepage for the panel.",
					"id" => $shortname."_blog_footer_panel_description",
					"std" => "The latest news and info",
					"type" => "text");

$options[] = array( "name" => "Blog Page Template",
					"desc" => "Select the page that has the blog page template applied to.",
					"id" => $shortname."_blog_page_template",
					"std" => "Select a page:",
					"type" => "select",
					"options" => $woo_pages);
										
$options[] = array( "name" => "Contact Panel",
					"icon" => "misc",
				    "type" => "heading");   
				    
$options[] = array( "name" => "Enable Contact Panel in the homepage footer",
					"desc" => "Show the contact panel in the footer of the homepage.",
					"id" => $shortname."_contact_footer_panel",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array(	"name" => "Contact Panel Header",
					"desc" => ".",
					"id" => $shortname."_contact_footer_panel_header",
					"std" => "Contact",
					"type" => "text");

$options[] = array(	"name" => "Contact Panel Description",
					"desc" => ".",
					"id" => $shortname."_contact_footer_panel_description",
					"std" => "Contact and follow us",
					"type" => "text");

$options[] = array( "name" => "Contact Form E-Mail",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Contact Form Twitter Username",
					"desc" => "Enter your Twitter username to add a link to your Twitter profile on the contact form on the homepage.",
					"id" => $shortname."_contactform_twitter",
					"std" => "",
					"type" => "text");
									
$options[] = array( "name" => "Contact Form Facebook URL",
					"desc" => "Enter your Facebook Page URL to add a link to your Facebook Page on the contact form on the homepage.",
					"id" => $shortname."_contactform_facebook",
					"std" => "",
					"type" => "text");
															 					                   
$options[] = array( "name" => "Dynamic Images",
					"type" => "heading",
					"icon" => "image");    
				    				   
$options[] = array( "name" => 'Dynamic Image Resizing',
					"desc" => "",
					"id" => $shortname."_wpthumb_notice",
					"std" => 'There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using WP Post Thumbnail option.',
					"type" => "info");					

$options[] = array( "name" => "WP Post Thumbnail",
					"desc" => "Use WordPress post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.",
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Dynamic Image Resizing",
					"desc" => "The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>",
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Hard Crop",
					"desc" => "The post thumbnail will be cropped to match the target aspect ratio (only used if 'Dynamic Image Resizing' is enabled).",
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox" );

$options[] = array( "name" => "TimThumb - Custom Settings Panel",
					"desc" => "This will enable the <a href='http://code.google.com/p/timthumb/'>TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel below the post</strong>. Make sure your themes <em>cache</em> folder is writeable. <a href='http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/'>Need help?</a>",
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox" );

$options[] = array( "name" => "TimThumb - Automatic Image Thumbnail",
					"desc" => "If no thumbnail is specifified then the first uploaded image in the post is used (TimThumb must be enabled).",
					"id" => $shortname."_auto_img",
					"std" => "false",
					"type" => "checkbox" );
$options[] = array( "name" => "Thumbnail Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Height')
								  ));
                                                                                                
$options[] = array( "name" => "Thumbnail Image alignment",
					"desc" => "Select how to align your thumbnails with posts.",
					"id" => $shortname."_thumb_align",
					"std" => "alignleft",
					"type" => "radio",
					"options" => $options_thumb_align); 

$options[] = array( "name" => "Show thumbnail in Single Posts",
					"desc" => "Show the attached image in the single post page.",
					"id" => $shortname."_thumb_single",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Single Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the image size. Max width is 576.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_single_w',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_single_h',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => "Add thumbnail to RSS feed",
					"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox");    

//Advertising       
                                              

// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);

                                     
// Woo Metabox Options
$woo_metaboxes = array();

if( get_post_type() == 'post' || !get_post_type()){

	$woo_metaboxes[] = array (
	    "name"  => "image",
	    "std"  => "",
	    "label" => "Custom Thumbnail Image",
	    "type" => "upload",
	    "desc" => "Upload an image to show with your post."
	);
	$woo_metaboxes[] = array (
	    "name"  => "embed",
	    "std"  => "",
	    "label" => "Embed Code",
	    "type" => "textarea",
	    "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar)"
	);
	$woo_metaboxes[] = array (
	    "name"  => "embed-width",
	    "std"  => "",
	    "label" => "Featured Video Width",
	    "type" => "text",
	    "desc" => "Enter the width for the homepage video embed code for your video (YouTube, Vimeo or similar)"
	);
	$woo_metaboxes[] = array (
	    "name"  => "embed-height",
	    "std"  => "",
	    "label" => "Featured Video Height",
	    "type" => "text",
	    "desc" => "Enter the height for the homepage video embed code for your video (YouTube, Vimeo or similar)"
	);
} // End post

if( get_post_type() == 'slide' || !get_post_type()){

	$woo_metaboxes[] = array (
	    "name"  => "image",
	    "std"  => "",
	    "label" => "Custom Thumbnail Image",
	    "type" => "upload",
	    "desc" => "Upload an image to show with your post."
	);
	$woo_metaboxes[] = array (
	    "name"  => "horizontal-slider",
	    "std"  => "false",
	    "label" => "Use Horizontal Image",
	    "type" => "checkbox",
	    "desc" => "Use Horizontal Image for the Featured Slider on the homepage."
	);
	$woo_metaboxes[] = array (
	    "name"  => "appstore-link",
	    "std"  => "http://",
	    "label" => "Link to App Store",
	    "type" => "text",
	    "desc" => "Enter the link to the App Store for this App"
	);

} // End slide

if( get_post_type() == 'media' || !get_post_type()){

	$woo_metaboxes[] = array (
	    "name"  => "image",
	    "std"  => "",
	    "label" => "Custom Thumbnail Image",
	    "type" => "upload",
	    "desc" => "Upload an image to show with your post."
	);
	$woo_metaboxes[] = array (
	    "name"  => "embed",
	    "std"  => "",
	    "label" => "Embed Code",
	    "type" => "textarea",
	    "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar)"
	);
	$woo_metaboxes[] = array (
	    "name"  => "embed-width",
	    "std"  => "",
	    "label" => "Featured Video Width",
	    "type" => "text",
	    "desc" => "Enter the width for the homepage video embed code for your video (YouTube, Vimeo or similar)"
	);
	$woo_metaboxes[] = array (
	    "name"  => "embed-height",
	    "std"  => "",
	    "label" => "Featured Video Height",
	    "type" => "text",
	    "desc" => "Enter the height for the homepage video embed code for your video (YouTube, Vimeo or similar)"
	);


} // End media

// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);      

}
}

?>