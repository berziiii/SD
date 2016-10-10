<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Suffolk_Downs
 * @since Suffolk Downs 1.0
 */
?>
		</div>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-footer-inner">
	<?php get_sidebar( 'main' ); ?>
				<div class="site-info">
					<p>&copy; <?php echo date("Y") ?> Suffolk Downs</p>
				</div>
				<div class="social-media">
					<ol>
						<li><a class="icon-social-facebook" href="http://www.facebook.com/TheHometownFavorite" target="_blank"><span>Facebook</span></a></li>
						<li><a class="icon-social-twitter" href="http://twitter.com/SuffolkDowns" target="_blank"><span>Twitter</span></a></li>
						<li><a class="icon-social-youtube" href="http://www.youtube.com/user/suffolkdowns" target="_blank"><span>YouTube</span></a></li>
					</ol>
				</div>
			</div>
		</footer>
	</div>
<?php wp_footer(); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri() . "/assets/scripts/suffolkdown.js"; ?>"></script>
</body>
</html>
