<?php
/**
 * @package Momofuku
 */
?>

<article id="post-<?php the_ID(); ?>" class="archive-post">
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Momofuku' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?>
        </a>
        <?php edit_post_link(''); ?>
    </h1>

		<div class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php Momofuku_posted_on(); ?>
		<?php endif; ?>
    <span class="comments-number"> | <?php momo_comments_number(); ?></span>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->


</article><!-- #post-<?php the_ID(); ?> -->
