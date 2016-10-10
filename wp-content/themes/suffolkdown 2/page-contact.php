<?php
/*
	Template Name: Contact
*/
?>
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
					<header class="entry-header" <?php	if($image) { echo 'style="background: url('. $image . ') no-repeat; background-size: cover;"';} ?>>
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
						<div class="entry-content-inner">
							<div class="entry-inner-container">
								<?php the_field('content'); ?>
							</div>
						</div>
					</div>
				</article>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
