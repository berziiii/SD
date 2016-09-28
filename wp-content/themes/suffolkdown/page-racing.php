<?php
/*
	Template Name: Racing
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
							<div class="entry-inner-racing">
								<div class="racing-content">
									<?php the_field('content'); ?>
								</div>
								<div class="racing-program-comments">
									<?php if( get_field('program_comments') ): ?>
										<br>
										<?php the_field('program_comments'); ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php if( get_field('track_conditions') ): ?>
							<div class="entry-content-side">
								<h2>Track Conditions</h2>
								<div class="entry-content-side-content">
									<?php the_field('track_conditions'); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</article>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
