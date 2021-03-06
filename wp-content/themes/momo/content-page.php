<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Momofuku
 * @since Momofuku 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
        <?php the_title(); ?>
        <?php edit_post_link(''); ?>
    </h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Momofuku' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
  <?php
    // Spit out all comments (get all when you pass null instead of a number 
    // AND dump the commenting form. 
    echo get_post_comments($post->ID, null); 
    momo_comments_form(); 
  ?>

</article><!-- #post-<?php the_ID(); ?> -->
