<?php
/**
 * Momofuku functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'Momofuku_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override Momofuku_setup() in a child theme, add your own Momofuku_setup to your child theme's
 * functions.php file.
 */
function Momofuku_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Momofuku, use a find and replace
	 * to change 'Momofuku' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'Momofuku', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'Momofuku' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
}
endif; // Momofuku_setup

/**
 * Tell WordPress to run Momofuku_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'Momofuku_setup' );

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'eeeeee',
	'text' => '444444',
);

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function Momofuku_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'Momofuku_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function Momofuku_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'Momofuku' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

/*	register_sidebar( array(
		'name' => __( 'Sidebar 2', 'Momofuku' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'Momofuku' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );*/
}
add_action( 'init', 'Momofuku_widgets_init' );

if ( ! function_exists( 'Momofuku_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Momofuku 1.2
 */
function Momofuku_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', 'previous' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', 'next'); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php previous_post_link( '<div class="nav-previous">%link</div>', 'previous' ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php next_post_link( '<div class="nav-next">%link</div>', 'next'); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // Momofuku_content_nav


if ( ! function_exists( 'Momofuku_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own Momofuku_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Momofuku 0.4
 */
function Momofuku_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'Momofuku' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'Momofuku' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'Momofuku' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'Momofuku' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'Momofuku' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'Momofuku' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for Momofuku_comment()

if ( ! function_exists( 'Momofuku_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own Momofuku_posted_on to override in a child theme
 *
 * @since Momofuku 1.2
 */
function Momofuku_posted_on() {
	printf( __( '<time class="entry-date" datetime="%3$s" pubdate>%4$s</time><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'Momofuku' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'Momofuku' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Momofuku 1.2
 */
function Momofuku_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'Momofuku_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Momofuku 1.2
 */
function Momofuku_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so Momofuku_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so Momofuku_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in Momofuku_categorized_blog
 *
 * @since Momofuku 1.2
 */
function Momofuku_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'Momofuku_category_transient_flusher' );
add_action( 'save_post', 'Momofuku_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function Momofuku_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'Momofuku_enhanced_image_navigation' );


/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Momofuku.
 */

/**
 * Gets comments for a given post.  For use on category, archive, home pages.  EG. not for use 
 * on single page, where you can just use the comments template. 
 * Accepts: 
 * 
 * @param type $post_id // the id of the post you want to get comments for
 * @param type $number // the max number of comments you want.  Defaults to infinite. 
 * 
 * @return string // Returns formatted comments, in div tags. 
 */
function get_post_comments($post_id, $number) {
    $args = array(
        'post_id'=>$post_id, 
        'number'=>$number, 
    ); 
    $comments = get_comments($args); 
    $comment_output = ''; 
    foreach ($comments as $comment) {
        $comment_output .= "<div class='short-comment'>"; 
        $comment_output .= "<span class='short-comment-author'>$comment->comment_author</span>"; 
        $comment_output .= "<span class='short-comment-date'>$comment->comment_date</span>"; 
        $comment_output .= "<p class='short-comment-content'>$comment->comment_content</p>"; 
        $comment_output .= "</div>"; 
    }
    return $comment_output; 
}

function momo_comments_form() {
    if ( comments_open() || '0' != get_comments_number() ) {
        $args = array(
          'comment_notes_after'=>'<span class="show-form-allowed">about comments+</span><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>', 
          'logged_in_as'=>'',
          'title_reply'=>'',
          'id_form' => '', 
        ); 
        comment_form($args); 
    }
}

function momo_comments_number() {
		if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) {
        $cn = comments_number('0 Comments');
        $out = "<span class='comments-number'>$cn</span>"; 
		}
    return $out; 

}

/**
 * REDIRECT ALL USERS TO THE HOME PAGE INSTEAD OF THE ADMIN SCREEN WHEN THEY LOG IN
 * UNLESS THEY ARE ADMINISTRATOR!!!!!!!!!!!!!!!!
 */
function momo_login_redirect($redirect_to, $request, $user)
{
	//is there a user to check?
	if(is_array($user->roles))
	{
		//check for admins
		if(in_array("administrator", $user->roles))		
			return home_url("/wp-admin/");
		else
			return home_url();
	}
}
add_filter("login_redirect", "momo_login_redirect", 10, 3);


/**
 * Function to set the output of the hero banner admin page. 
 */
add_action('admin_menu', 'momo_hero_admin');

function momo_hero_admin() {
    // Is "manage_options" the best permissions level for this? Should I be using "administrator" ???
    if (current_user_can('manage_options'))  {
//        wp_die( __('You do not have sufficient permissions to access this page.') );
        add_theme_page('Momofuku Hero Banner admin', 'Momofuku Hero Banner', 'manage_options', 'momo-hero-banner', 'momo_hero_banner_admin');
    }
}

function momo_hero_banner_admin() {
    add_option("momo_hero_banner", '', '', 'yes');
    if (isset($_POST)){
        if ($_POST['remove'] == 'on') {
            update_option('momo_hero_banner', ''); 
            echo '<h1>Hero banner has been removed. </h1>'; 
            return true; 
        }
    }
    // Check whether a file was submitted via form. 
    if ($_FILES['file']) {
        $upload = $_FILES['file']; //Receive the uploaded image from form
        // upload file, and get back upload path. 
        $file = add_hero_banner($upload); 
        //echo '<pre>'; print_r($file_path); exit; 
        if (is_array($file)) {
            $file_path = $file['url']; 
            update_option('momo_hero_banner', $file_path); 
            echo '<h1>Your hero banner has been updated.</h1>'; 
            return true; 
        } else { // Some basic error handling for bad uploads. 
            echo 'There was a problem uploading your file: '; 
            switch ($file) {
                case 'tmp_failed': 
                    echo 'The file could not be uploaded to the tmp directory. Please verify you have the correct (server side) permissions'; break; 
                case 'already_exists': 
                    echo 'This file already exists. '; break; 
                case 'not_writable': 
                    echo 'The uploads directory is not writeable. Please change permissions '; 
            }
        }
    } else {
        $currbanner = get_option(momo_hero_banner); 
        $out = ''; 
        if ($currbanner != '') {
            $out /= '<h1>Current Image: </h1> <img src="" alt="Current Image." /> ';
        }
        $out .= '
            <form id="momo_upload_form" enctype="multipart/form-data" method="post"> 
            <h1>Manage Momofuku home page banner. </h1> 
            <p>Note: The correct width for a hero banner is 740px. Any image you upload here will automatically be resized to 740px, but for best performance use the correct width. </p>
            <!--<input type="hidden" name="MAX_FILE_SIZE" value="3000">!--> 
            <div>
            <label for="file">File to upload:</label> 
            <input id="file" type="file" name="file"> 
            </div>
            <div>
            <label for="remove">Remove hero banner: </label> 
            <input id="remove" type="checkbox" name="remove"> 
            </div>
            <input id="submit" class="submit" type="submit" name="submit" value="Submit"> 
            </form> ';
        $file_dir=get_bloginfo('template_directory'); 
        wp_enqueue_style("functions", $file_dir."/functions.css", false, "1.0", "all");  
        echo $out; 
    }
}

function add_hero_banner($upload){
//    echo '<pre>'; print_r($upload); exit; 
    $uploads = wp_upload_dir(); //Get path of upload dir of wordpress
    if (is_writable($uploads['path'])) {//Check if upload dir is writable 
        if ((!empty($upload['tmp_name']))) {  //Check if uploaded image is not empty
            if ($upload['tmp_name']) { //Check if image has been uploaded in temp directory
                $file=handle_image_upload($upload); /*Call our custom function to ACTUALLY upload the image*/
            } else {
                $file = 'tmp_failed'; 
            }
        } else {
            $file = 'already_exists'; 
        }
    }
    else {
        $file = 'not_writable'; 
    }
    return $file; 
}

function handle_image_upload($upload){
    global $post;
    if (file_is_displayable_image( $upload['tmp_name'] )) {//Check if image
        //handle the uploaded file
        $overrides = array('test_form' => false);
        $file=wp_handle_upload($upload, $overrides);
    }
    return $file;
}

/**
 * @function momo_create_taxonomy - Create sub category and ingredient taxonomies for post categorization. 
 * @note - This is not currently used.  Categories and sub categories will be managed through the normal 
 * Wordpress process. 
 */
function momo_create_taxonomy() { // Add new "Locations" taxonomy to Posts 
    register_taxonomy(
        'sub-category', 
        'post', array( // Hierarchical taxonomy (like categories) 
            'hierarchical' => true, // This array of options controls the labels displayed in the WordPress Admin UI 
            'labels' => array(
                'name' => _x( 'Sub Categories', 'taxonomy general name' ), 
                'singular_name' => _x( 'Sub Category', 'taxonomy singular name' ), 
                'search_items' => __( 'Search Sub Categories' ), 
                'all_items' => __( 'All Sub Categories' ), 
                'parent_item' => __( 'Parent Sub Category' ), 
                'parent_item_colon' => __( 'Parent Sub Category:' ), 
                'edit_item' => __( 'Edit Sub Categories' ), 
                'update_item' => __( 'Update Sub Category' ), 
                'add_new_item' => __( 'Add New Sub Category' ), 
                'new_item_name' => __( 'New Sub Category Name' ), 
                'menu_name' => __( 'Sub Categories' ), 
            ), // Control the slugs used for this taxonomy 
            'rewrite' => array(
                'slug' => 'sub-categories', // This controls the base slug that will display before each term 
                'with_front' => false, // Don't display the category base before "/locations/" 
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/" 
            ), 
        )
    ); 
} 
//add_action( 'init', 'momo_create_taxonomy', 0 );


// REMOVE STUFF FROM THE ADMIN THAT WE DON'T WANT USERS TO SEE: 
function customize_meta_boxes() {
    /* Removes meta boxes from Posts */
    remove_meta_box('postcustom','post','normal');
    remove_meta_box('trackbacksdiv','post','normal');
    //remove_meta_box('commentstatusdiv','post','normal');
    //remove_meta_box('commentsdiv','post','normal');
    remove_meta_box('tagsdiv-post_tag','post','normal');
    remove_meta_box('postexcerpt','post','normal');
    remove_meta_box('formatdiv','post','normal');
    /* Removes meta boxes from pages */
    remove_meta_box('postcustom','page','normal');
    remove_meta_box('trackbacksdiv','page','normal');
    //remove_meta_box('commentstatusdiv','page','normal');
    //remove_meta_box('commentsdiv','page','normal'); 
}

add_action('admin_init','customize_meta_boxes');

function remove_menu_items() {
    global $menu;
    $restricted = array(__('Links'), __('Comments'), __('Media'),
    __('Plugins'), __('Tools'), __('Users'));
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
            unset($menu[key($menu)]);
        
        }
    }
}

function remove_sub_menus() {
    global $submenu;
    unset($submenu['edit.php'][16]); // Removes 'Tags'.  
}

// Only remove menu items if not admin: 
$is_administrator = current_user_can('administrator') ? true : false; 
if (!$is_administrator) {
    add_action('admin_menu', 'remove_menu_items');
    add_action('admin_menu', 'remove_sub_menus');
}


function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); 
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

/**
 * REMOVE UNUSED ROLES: 
 * @note removign unused roles leaves users in tact, with no role. It does not 
 * harm their posts. 
 */ 
function remove_roles() {
    remove_role('author');
    remove_role('contributor');
}
remove_roles(); 

// CREATE CUSTOM WORDPRESS LOGIN SCREEN:::
/**
 * @desc attach custom admin login CSS file
 */
function momo_custom_login_js_css() {
    $bloginfo = get_bloginfo('template_url'); 
    echo '<link rel="stylesheet" type="text/css" href="' . $bloginfo . '/css/momo-login.css" />'; 
    echo "<script src='$bloginfo/js/jquery-1.7.1.min' type='text/javascript'></script>"; 
    echo "<script src='$bloginfo/js/momo-login.js' type='text/javascript'></script>"; 
}
 
add_action('login_head', 'momo_custom_login_js_css');

function load_my_js_css() {
    // assign the url of theme to a variable $themedir
    $themedir = get_bloginfo('template_url');
    wp_enqueue_style( 'my_style',  $themedir . "/fonts/lane/stylesheet.css");
    wp_enqueue_style( 'chosen_stylesheet',  $themedir . "/css/chosen.css");
    wp_enqueue_script('jquery_theme', get_template_directory_uri() . '/js/jquery-1.7.1.min.js'); 
    wp_enqueue_script('chosen_js', $themedir . "/js/chosen.jquery.min.js", 'jquery_theme'); 
}

// Load the above function via init hook.
add_action('init', load_my_js_css);

//$comments_open = comments_open(); 
//echo '<pre>'; var_dump($comments_open); exit; 


// get peramaters for search drop down
function momo_get_search_terms() {
    $search_param_args = array(
    'hierarchical' => TRUE, 
    'orderby' => 'name', 
    ); 
    $get_search = get_categories($search_param_args); 
    $search_terms = array(); 
    //echo '<pre>'; var_dump($get_search); exit; 
    for ($i=0; $i<sizeof($get_search); $i++) {
        $search_terms[$i] = $get_search[$i]->name; 
    }
    /*$json_search_params = json_encode($search_terms); 
    $json_out = "<script type='text/javascript'>
        var momo_search_terms = $json_search_params; 
    </script>"; */
    return $search_terms; 
}

function momo_get_search(){
    /*$out = '<select id="chosen_search">'; 
    $searches = momo_get_search_terms(); 
    for ($i = 0; $i < sizeof($searches); $i++) {
        $out .= "<option>$searches[$i]</option>"; 
    }
    $out.= '</select>'; 
    return $out; */
    $url = get_bloginfo('url');
    $top = "<form action='$url' method='get' id='searchform'>" ; 
    $top .= '<div>'; 
    $top .= '<input type="text" name="s" id="s" value="" />'; 
    echo $top; 
    $dropdown_args = array(
        'show_count' => 1, 
        'hierarchical' => 1, 
        'id' => 'category_search', 
    ); 
    wp_dropdown_categories($dropdown_args);
    $bottom = '<input type="submit" id="submit" name="submit" value="submit" />'; 
    $bottom .= '</div>'; 
    $bottom .= '</form>'; 
    echo $bottom; 
}

function momo_get_category() {
    if (is_single()) {
        global $post; 
        $cats = wp_get_post_categories($post->ID); 
        $curr_cat = $cats[0]; 
    } else {
        global $wp_query; 
        $curr_cat = get_query_var('cat');
    }
    return $curr_cat; 
}


?>

