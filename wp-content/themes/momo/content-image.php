<?php
/**
 * The template for displaying posts in the Image Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Momofuku
 * @since Momofuku 1.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Momofuku' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?>
        </a>
        <?php edit_post_link(''); ?>
    </h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Momofuku' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Momofuku' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php Momofuku_posted_on(); ?>
		<span class="sep"> | </span>
    <span class="comments-number"><?php momo_comments_number(); ?></span>

		<?php edit_post_link( __( 'Edit', 'Momofuku' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
