<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Customer Feedback Widget
- WooTabs widget
- Flickr widget
- Ad widget
- Search widget
- Twitter widget
- Blog Author Info
- Deregister Default Widgets 

-----------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------------*/
/* Customer Feedback Widget */
/*---------------------------------------------------------------------------------*/

class Woo_CustomerFeedback extends WP_Widget {

	function Woo_CustomerFeedback() {
		$widget_ops = array('description' => 'Use this widget to add your Customer Feedback as a widget.' );
		parent::WP_Widget(false, __('Woo - Customer Feedback Widget', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		$title = $instance['title'];
		$customerquote = $instance['customerquote'];
		$customername = $instance['customername'];
		$customerlink = $instance['customerlink'];
		$upload = $instance['upload'];
		
        ?><div class="feedback-widget widget"><?php
			if($title != '') {
			?><h3><?php _e($title,'woothemes'); ?></h3><?php
			}
			 
			 ?>
			 
			<div class="outer">
					
					<div class="customer-quote"><em><?php echo $customerquote; ?></em></div>
					<div class="customer-details">
					
						<?php if (isset($upload) && $upload != '') { ?><div class="customer-image"><img src="<?php echo $upload; ?>" alt="Customer Image" width="40" /></span></div><?php } ?>
					
						<div class="customer-name">
							<h4><?php echo $customername; ?></h4>
							<a href="http://<?php echo str_replace('http://','',$customerlink); ?>" target="_blank"><?php echo $customerlink; ?></a>
						</div>

       				</div>
       				
       				<div class="fix"></div>
				
			</div>
		</div><?php
	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {        
		$title = esc_attr($instance['title']);
		$customerquote = esc_attr($instance['customerquote']);
		$customername = esc_attr($instance['customername']);
		$customerlink = esc_attr($instance['customerlink']);
		$upload = esc_attr($instance['upload']);
		?>
		<script type="text/javascript">jQuery(document).ready(function(){ setupAdUploaders(); });</script>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('customerquote'); ?>"><?php _e('Customer Quote:','woothemes'); ?></label>
           	<textarea id="<?php echo $this->get_field_id('customerquote'); ?>" name="<?php echo $this->get_field_name('customerquote'); ?>" class="widefat"><?php echo $customerquote; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('customername'); ?>"><?php _e('Customer Name:','woothemes'); ?></label>
           	<input type="text" name="<?php echo $this->get_field_name('customername'); ?>" value="<?php echo $customername; ?>" class="widefat" id="<?php echo $this->get_field_id('customername'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('customerlink'); ?>"><?php _e('Customer Website:','woothemes'); ?></label>
           	<input type="text" name="<?php echo $this->get_field_name('customerlink'); ?>" value="<?php echo $customerlink; ?>" class="widefat" id="<?php echo $this->get_field_id('customerlink'); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('upload'); ?>"><?php _e('Upload Customer Image','woothemes'); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('upload'); ?>" value="<?php echo $upload; ?>" class="widefat upload-box" />
        <span class="button widget_image_upload_button" id="<?php echo $this->get_field_id('upload'); ?>">Upload Image</span>
        <?php if(!empty($upload)) { echo "<img class='woo-upload-start-image' id='image_". $this->get_field_id('upload') ."' src='". $upload . "' width='75' />"; } ?>
        </p>
        <?php
	}
} 

register_widget('Woo_CustomerFeedback');

add_action('admin_head', 'woo_widget_customer_feedback_head');

function woo_widget_customer_feedback_head() { 
	?>
    <style type="text/css">
		.woo-upload-nav { height:30px; margin-top:10px; }
		.woo-upload-nav li { float:left}
		.woo-upload-nav li.active a { background: #fff; color: #333 }
		.woo-upload-nav li  a { text-decoration: none;float:left;  width:25px; text-align:center; padding:4px 0; margin-right:4px; background:#f8f8f8; border:1px solid #e7e7e7; border-radius: 8px; 	-moz-border-radius:8px; -webkit-border-radius: 8px; }
		.woo-upload-crop { width:225px; overflow:hidden;border-top:dashed #ccc 1px; margin-top:10px;}
		.woo-upload-holder { width:9000px; }
		.woo-upload-piece { float:left; width:215px; padding:0 5px}
		.upload-box {margin-bottom:10px}
		.woo-upload-start-image, .woo-option-image { margin:10px 0; clear:both; display:block}
		.seperator { text-align:left; padding:2px 0; margin:15px 0 20px 0; border-bottom:2px solid #aaa;  font-weight:700; color: #888}
		.clear {clear:both}  
	</style>
    <?php
	//AJAX Upload
	?>
    <script type="text/javascript">
	
	jQuery(document).ready(function(){
		
		jQuery('.woo-upload-nav a').live('click',function(){
		
			var nav = jQuery(this).parent().parent();
			var navClicked = jQuery(this);
			nav.find('li').removeClass('active');
			navClicked.parent().addClass('active');
			var move = navClicked.attr('rel');
			nav.next().next().children().animate({'marginLeft':move},200);
			return false;
		
		})
	
	});
	
	</script>
	<script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/functions/js/ajaxupload.js"></script>
	<script type="text/javascript">
		
	function setupAdUploaders(){
		
		jQuery(document).ready(function(){
		
		//AJAX Upload

		jQuery('.widget_image_upload_button').each(function(){
		
		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');	
		new AjaxUpload(clickedID, {
			  action: '<?php echo admin_url("admin-ajax.php"); ?>',
			  name: clickedID, // File upload name
			  data: { // Additional data to send
					action: 'woo_widget_ajax_post_action',
					type: 'upload',
					data: clickedID },
			  autoSubmit: true, // Submit file after selection
			  responseType: false,
			  onChange: function(file, extension){},
			  onSubmit: function(file, extension){
					clickedObject.text('Uploading'); // change button text, when user selects file	
					this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
					interval = window.setInterval(function(){
						var text = clickedObject.text();
						if (text.length < 13){	clickedObject.text(text + '.'); }
						else { clickedObject.text('Uploading'); } 
					}, 200);
			  },
			  onComplete: function(file, response) {
			   
				window.clearInterval(interval);
				clickedObject.text('Upload Image');	
				this.enable(); // enable upload button
				setupAdUploaders(); // Reinitialize the uploaders
				
				// If there was an error
				if(response.search('Upload Error') > -1){
					var buildReturn = '<span class="upload-error">' + response + '</span>';
					jQuery(".upload-error").remove();
					clickedObject.parent().after(buildReturn);
				
				}
				else{
					var buildReturn = '<img class="hide woo-option-image" id="image_'+clickedID+'" src="'+response+'" width="75" alt="" />';
//					var buildReturn = '<img class="hide" id="image_'+clickedID+'" src="<?php bloginfo('template_url') ?>/thumb.php?src='+response+'&w=345" alt="" />';
					jQuery(".upload-error").remove();
					jQuery("#image_" + clickedID).remove();	
					clickedObject.parent().after(buildReturn);
					jQuery('img#image_'+clickedID).fadeIn();
					clickedObject.next('span').fadeIn();
					clickedObject.prev('input').val(response);
				}				
				
			  }
			 
			});
			
		});

	});
	
	}; // end function
	
	setupAdUploaders();
	
	</script>
    <?php
}

add_action('wp_ajax_woo_widget_ajax_post_action', 'woo_widget_ad_ajax_callback');

function woo_widget_ad_ajax_callback() {
	global $wpdb; // this is how you get access to the database
	$themename = get_option('template') . "_";
	//Uploads
	if(isset($_POST['type'])){
		if($_POST['type'] == 'upload'){
			
			$clickedID = $_POST['data']; // Acts as the name
			$filename = $_FILES[$clickedID];
			$override['test_form'] = false;
			$override['action'] = 'wp_handle_upload';    
			$uploaded_file = wp_handle_upload($filename,$override);
			 
					$upload_tracking[] = $clickedID;
					update_option( $clickedID , $uploaded_file['url'] );
					//update_option( $themename . $clickedID , $uploaded_file['url'] );
			 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
			 else { echo $uploaded_file['url']; } // Is the Response
		}
		
	}
	die();

}

/*---------------------------------------------------------------------------------*/
/* WooTabs widget */
/*---------------------------------------------------------------------------------*/

class Woo_Tabs extends WP_Widget {

   function Woo_Tabs() {
  	   $widget_ops = array('description' => 'This widget is the Tabs that classicaly goes into the sidebar. It contains the Popular posts, Latest Posts, Recent comments and a Tag cloud.' );
       parent::WP_Widget(false, $name = __('Woo - Tabs', 'woothemes'), $widget_ops);    
   }


   function widget($args, $instance) {        
       extract( $args );
       
       $number = $instance['number']; if ($number == '') $number = 5;
       $thumb_size = $instance['thumb_size']; if ($thumb_size == '') $thumb_size = 35;
       ?>  

 		<div id="tabs">
           
            <ul class="wooTabs">
                <li class="popular"><a href="#tab-pop"><?php _e('Popular', 'woothemes'); ?></a></li>
                <li class="latest"><a href="#tab-latest"><?php _e('Latest', 'woothemes'); ?></a></li>
                <li class="comments"><a href="#tab-comm"><?php _e('Comments', 'woothemes'); ?></a></li>
                <li class="tags"><a href="#tab-tags"><?php _e('Tags', 'woothemes'); ?></a></li>
            </ul>
            
            <div class="clear"></div>
            
            <div class="boxes box inside">
                        
                <ul id="tab-pop" class="list">            
                    <?php if ( function_exists('woo_tabs_popular') ) woo_tabs_popular($number, $thumb_size); ?>                    
                </ul>
            
                <ul id="tab-latest" class="list">
                    <?php if ( function_exists('woo_tabs_latest') ) woo_tabs_latest($number, $thumb_size); ?>                    
                </ul>	
            
                <ul id="tab-comm" class="list">
                    <?php if ( function_exists('woo_tabs_comments') ) woo_tabs_comments($number, $thumb_size); ?>                    
                </ul>	
                
                <div id="tab-tags" class="list">
                    <?php wp_tag_cloud('smallest=12&largest=20'); ?>
                </div>
                
            </div><!-- /.boxes -->
			
        </div><!-- /wooTabs -->
    
         <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {                
       $number = esc_attr($instance['number']);
       $thumb_size = esc_attr($instance['thumb_size']);
	   
       ?>    
       <p>
       <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:','woothemes'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
       </label>
       </p>  
       <p>
       <label for="<?php echo $this->get_field_id('thumb_size'); ?>"><?php _e('Thumbnail Size (0=disable):','woothemes'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('thumb_size'); ?>" name="<?php echo $this->get_field_name('thumb_size'); ?>" type="text" value="<?php echo $thumb_size; ?>" />
       </label>
       </p>  
       <?php 
   }

} 
register_widget('Woo_Tabs');



/*---------------------------------------------------------------------------------*/
/* Flickr widget */
/*---------------------------------------------------------------------------------*/
class Woo_flickr extends WP_Widget {

	function Woo_flickr() {
		$widget_ops = array('description' => 'This Flickr widget populates photos from a Flickr ID.' );

		parent::WP_Widget(false, __('Woo - Flickr', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		extract( $args );
		$id = $instance['id'];
		$number = $instance['number'];
		$type = $instance['type'];
		$sorting = $instance['sorting'];
		$size = $instance['size'];
		
		echo $before_widget;
		echo $before_title; ?>
		<?php _e('Photos on <span>flick<span>r</span></span>','woothemes'); ?>
        <?php echo $after_title; ?>
            
        <div class="wrap">
            <div class="fix"></div>
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $sorting; ?>&amp;&amp;layout=x&amp;source=<?php echo $type; ?>&amp;<?php echo $type; ?>=<?php echo $id; ?>&amp;size=<?php echo $size; ?>"></script>        
            <div class="fix"></div>
        </div>

	   <?php			
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
		$type = esc_attr($instance['type']);
		$sorting = esc_attr($instance['sorting']);
		$size = esc_attr($instance['size']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
        </p>
       	<p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
                <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
                <option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
                <option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'woothemes'); ?></option>
                <option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'woothemes'); ?></option>            
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Sorting:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
                <option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'woothemes'); ?></option>
                <option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'woothemes'); ?></option>            
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('size'); ?>" class="widefat" id="<?php echo $this->get_field_id('size'); ?>">
                <option value="s" <?php if($size == "s"){ echo "selected='selected'";} ?>><?php _e('Square', 'woothemes'); ?></option>
                <option value="m" <?php if($size == "m"){ echo "selected='selected'";} ?>><?php _e('Medium', 'woothemes'); ?></option>
                <option value="t" <?php if($size == "t"){ echo "selected='selected'";} ?>><?php _e('Thumbnail', 'woothemes'); ?></option>
            </select>
        </p>
		<?php
	}
} 

register_widget('woo_flickr');


/*---------------------------------------------------------------------------------*/
/* Ad Widget */
/*---------------------------------------------------------------------------------*/

class Woo_AdWidget extends WP_Widget {

	function Woo_AdWidget() {
		$widget_ops = array('description' => 'Use this widget to add any type of Ad as a widget.' );
		parent::WP_Widget(false, __('Woo - Adspace Widget', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		$title = $instance['title'];
		$adcode = $instance['adcode'];
		$image = $instance['image'];
		$href = $instance['href'];
		$alt = $instance['alt'];

        echo '<div class="adspace-widget widget">';

		if($title != '')
			echo '<h3>'.$title.'</h3>';

		if($adcode != ''){
		?>
		
		<?php echo $adcode; ?>
		
		<?php } else { ?>
		
			<a href="<?php echo $href; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" /></a>
	
		<?php
		}
		
		echo '</div>';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {        
		$title = esc_attr($instance['title']);
		$adcode = esc_attr($instance['adcode']);
		$image = esc_attr($instance['image']);
		$href = esc_attr($instance['href']);
		$alt = esc_attr($instance['alt']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Ad Code:','woothemes'); ?></label>
            <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
        </p>
        <p><strong>or</strong></p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo $href; ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <?php
	}
} 

register_widget('Woo_AdWidget');


/*---------------------------------------------------------------------------------*/
/* Search widget */
/*---------------------------------------------------------------------------------*/
class Woo_Search extends WP_Widget {

   function Woo_Search() {
	   $widget_ops = array('description' => 'This is a WooThemes standardized search widget.' );
       parent::WP_Widget(false, __('Woo - Search', 'woothemes'),$widget_ops);      
   }

   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
	?>
		<?php echo $before_widget; ?>
        <?php if ($title) { echo $before_title . $title . $after_title; } ?>
        <?php include(TEMPLATEPATH . '/search-form.php'); ?>
		<?php echo $after_widget; ?>   
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);

       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
      <?php
   }
} 

register_widget('Woo_Search');


/*---------------------------------------------------------------------------------*/
/* Twitter widget */
/*---------------------------------------------------------------------------------*/
class Woo_Twitter extends WP_Widget {

   function Woo_Twitter() {
	   $widget_ops = array('description' => 'Add your Twitter feed to your sidebar with this widget.' );
       parent::WP_Widget(false, __('Woo - Twitter Stream', 'woothemes'),$widget_ops);      
   }
   
   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
    $limit = $instance['limit']; if (!$limit) $limit = 5;
	$username = $instance['username'];
	$unique_id = $args['widget_id'];
	?>
		<?php echo $before_widget; ?>
        <?php if ($title) echo $before_title . $title . $after_title; ?>
        <ul id="twitter_update_list_<?php echo $unique_id; ?>"><li></li></ul>	
        <?php echo woo_twitter_script($unique_id,$username,$limit); //Javascript output function ?>	 
        <?php echo $after_widget; ?>
        
   		
	<?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);
       $limit = esc_attr($instance['limit']);
	   $username = esc_attr($instance['username']);
       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('username'); ?>"  value="<?php echo $username; ?>" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="" size="3" id="<?php echo $this->get_field_id('limit'); ?>" />

       </p>
      <?php
   }
   
} 
register_widget('Woo_Twitter');


/*---------------------------------------------------------------------------------*/
/* Blog Author Info */
/*---------------------------------------------------------------------------------*/
if (class_exists('WP_Widget')) {
	class Woo_BlogAuthorInfo extends WP_Widget {
	
	   function Woo_BlogAuthorInfo() {
		   $widget_ops = array('description' => 'This is a WooThemes Blog Author Info widget.' );
		   parent::WP_Widget(false, __('Woo - Blog Author Info', 'woothemes'),$widget_ops);      
	   }
	
	   function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$bio = $instance['bio'];
		$email = $instance['email'];
		$avatar_size = $instance['avatar_size']; if ( !$avatar_size ) $avatar_size = 48;
		$avatar_align = $instance['avatar_align']; if ( !$avatar_align ) $avatar_align = 'left';
		$read_more_text = $instance['read_more_text'];
		$read_more_url = $instance['read_more_url'];
		?>
			<?php echo $before_widget; ?>
			<?php if ($title) { echo $before_title . $title . $after_title; } ?>
			
            <span class="<?php echo $avatar_align; ?>"><?php if ( $email ) echo get_avatar( $email, $size = $avatar_size ); ?></span>
            <p><?php echo $bio; ?></p>
			<?php if ( $read_more_url ) echo '<p><a href="' . $read_more_url . '">' . $read_more_text . '</a></p>'; ?>
			<div class="fix"></div>
			<?php echo $after_widget; ?>   
	   <?php
	   }
	
	   function update($new_instance, $old_instance) {                
		   return $new_instance;
	   }
	
	   function form($instance) {        
	   
			$title = esc_attr($instance['title']);
			$bio = esc_attr($instance['bio']);
			$email = esc_attr($instance['email']);
			$avatar_size = esc_attr($instance['avatar_size']);
			$avatar_align = esc_attr($instance['avatar_align']);
			$read_more_text = esc_attr($instance['read_more_text']);
			$read_more_url = esc_attr($instance['read_more_url']);
			?>
			<p>
			   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('bio'); ?>"><?php _e('Bio:','woothemes'); ?></label>
				<textarea name="<?php echo $this->get_field_name('bio'); ?>" class="widefat" id="<?php echo $this->get_field_id('bio'); ?>"><?php echo $bio; ?></textarea>
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('<a href="http://www.gravatar.com/">Gravatar</a> E-mail:','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('email'); ?>"  value="<?php echo $email; ?>" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" />
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('Gravatar Size:','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('avatar_size'); ?>"  value="<?php echo $avatar_size; ?>" class="widefat" id="<?php echo $this->get_field_id('avatar_size'); ?>" />
			</p>
            <p>
                <label for="<?php echo $this->get_field_id('avatar_align'); ?>"><?php _e('Gravatar Alignment:','woothemes'); ?></label>
                <select name="<?php echo $this->get_field_name('avatar_align'); ?>" class="widefat" id="<?php echo $this->get_field_id('avatar_align'); ?>">
                    <option value="left" <?php if($avatar_align == "left"){ echo "selected='selected'";} ?>><?php _e('Left', 'woothemes'); ?></option>
                    <option value="right" <?php if($avatar_align == "right"){ echo "selected='selected'";} ?>><?php _e('Right', 'woothemes'); ?></option>            
                </select>
            </p>
 			<p>
			   <label for="<?php echo $this->get_field_id('read_more_text'); ?>"><?php _e('Read More Text (optional):','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('read_more_text'); ?>"  value="<?php echo $read_more_text; ?>" class="widefat" id="<?php echo $this->get_field_id('read_more_text'); ?>" />
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('read_more_url'); ?>"><?php _e('Read More URL (optional):','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('read_more_url'); ?>"  value="<?php echo $read_more_url; ?>" class="widefat" id="<?php echo $this->get_field_id('read_more_url'); ?>" />
			</p>
          
			<?php
	   	}
	} 
	
	register_widget('Woo_BlogAuthorInfo');
}

	

/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
function woo_deregister_widgets(){
    unregister_widget('WP_Widget_Search');         
}
add_action('widgets_init', 'woo_deregister_widgets');  


?>