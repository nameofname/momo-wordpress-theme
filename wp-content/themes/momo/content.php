<?php
/**
 * @package Momofuku
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Momofuku' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?>
        </a>
        <?php edit_post_link(''); ?>
    </h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php Momofuku_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Momofuku' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Momofuku' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'Momofuku' ) );
				if ( $categories_list && Momofuku_categorized_blog() ) :
			?>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'Momofuku' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'Momofuku' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
    <span class="comments-number"><?php momo_comments_number(); ?></span>
    <?php
        echo get_post_comments($post->ID, 3); 
        momo_comments_form(); 
    ?>

	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
