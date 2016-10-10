<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Suffolk_Downs
 * @since Suffolk Downs 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>
						<div class="entry-header-innner">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</div>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'suffolkdowns' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div>
					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'suffolkdowns' ), '<span class="edit-link">', '</span>' ); ?>
					</footer>
				</article>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
