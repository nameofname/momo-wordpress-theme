<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */
?>

<?php
    if ( !is_user_logged_in() ) {
        wp_redirect('/wp-admin'); 
    } 
?> 

<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'Momofuku' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php wp_enqueue_script('jquery_theme', get_template_directory_uri() . '/js/jquery-1.7.1.min.js'); ?>
<?php if ( is_singular() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script('single_theme', get_template_directory_uri() . '/js/single.js'); 
    wp_enqueue_script( 'comment-reply' ); 
}?>
<?php if ( is_home() ) wp_enqueue_script('home_js', get_template_directory_uri() . '/js/home.js'); ?>           
<?php //wp_enqueue_script('home_js', get_template_directory_uri() . '/js/home.js');            
?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<?php do_action( 'before' ); ?>
	<header id="header" role="banner">
		<hgroup>
			<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <nav id="access" role="navigation">
                <?php 
                    // wp_nav_menu( array( 'theme_location' => 'primary' ) ); 
                ?>
                    <?php 
                        $blinfo = get_bloginfo('url'); 
                        $logout_url = wp_logout_url(); 
                        $toolbar = "
                            <ul>
                                <li><a href='$blinfo/wp-admin/post-new.php' title='Contribute'>New post</a></li>
                                <li><a href='$logout_url' title='Logout'>Logout</a></li>
                            </ul>
                        "; 
                        if(is_user_logged_in() && current_user_can('administrator')) {
                            echo $toolbar; 
                        }
                    ?>
            </nav><!-- #access -->
		</hgroup>

	</header><!-- #branding -->

	<div id="main">