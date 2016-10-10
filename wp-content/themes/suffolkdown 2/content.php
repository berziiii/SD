<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Suffolk_Downs
 * @since Suffolk Downs 1.0
 */
?>
<div class="nav-links">
	<a href="<?php the_permalink(15); ?>" title="Back To News"><span class="meta-nav">&larr;</span> Back to News</a>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<?php if ( is_single() ) : ?>
		<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php else : ?>
		<h2 class="entry-title">
			<a class="entry-post-link" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<?php endif; // is_single() ?>
		<div class="entry-meta">
			<?php suffolkdowns_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'suffolkdowns' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</header>
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php else : ?>
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s...', 'suffolkdowns' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'suffolkdowns' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		?>
	</div>
	<?php endif; ?>
	<footer class="entry-meta">
		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer>
</article>
