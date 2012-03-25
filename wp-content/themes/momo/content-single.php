<?php
/**
 * @package Momofuku
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
        <?php the_title(); ?>
        <?php edit_post_link(''); ?>
    </h1>

		<div class="entry-meta">
			<?php Momofuku_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Momofuku' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
  <span class="comments-number"><?php momo_comments_number(); ?></span>
  <?php
      // Spit out all comments (get all when you pass null instead of a number 
      // AND dump the commenting form. 
      echo get_post_comments($post->ID, null); 
      momo_comments_form(); 
  ?>


</article><!-- #post-<?php the_ID(); ?> -->
