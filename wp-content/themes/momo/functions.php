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

		<?php previous_post_link( '<div class="nav-previous">%link</div>', 'previos' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', 'next'); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Momofuku' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Momofuku' ) ); ?></div>
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
        //print_r($comment); exit; 
        $comment_output .= "<div class='short-comment'>"; 
        $comment_output .= "<span class='short-comment-author'>$comment->comment_author</span>"; 
        $comment_output .= "<span class='short-comment-date'>$comment->comment_date</span>"; 
        $comment_output .= "<p class='short-comment-content'>$comment->comment_content</p>"; 
        $comment_output .= "</div>"; 
    }
//    echo '<pre>'; print_r($comments); 
    return $comment_output; 
}

function momo_comments_form() {
    if ( comments_open() || '0' != get_comments_number() ) {
        $args = array(
          'comment_notes_after'=>'<span class="show-form-allowed">about comments+</span><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>', 
          'logged_in_as'=>'',
          'title_reply'=>'',
        ); 
        comment_form($args); 
    }
}


?>
