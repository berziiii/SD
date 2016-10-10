<?php
get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
						$image = get_field('image')['url'];
					?>
					<header class="hero-header" <?php	if($image) { echo 'style="background: url('. $image . ') no-repeat; background-position: center center; background-size: cover;"';} ?>>
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>
						<div class="hero-header-inner">
							<div class="hero-header-content">
								<?php
									if(get_field('copy_over_image') == 'yes') {
								?>
								<h1 class="entry-title"><?php the_field('headline'); ?> <span><?php the_field('subheadline'); ?></span> </h1>
								<ol>
								<?php
								while( have_rows('dates') ): the_row(); ?>
									<li><?php the_sub_field('date'); ?></li>
								<?php
								endwhile; ?>
								</ol>
								<?php
									}
								?>
							</div>
						</div>
					</header>
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
