<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Fruitful theme
 * @since Fruitful theme 1.0
 */
	?>
					</div>
					<?php harmony_entry_meta(); ?>
				</div>
			</div><!-- .page-container-->
			
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="sixteen columns">
					<div class="footer-sidebar">
						<?php get_sidebar('footer'); ?>
					</div>
				</div>
				<div id="back-to-top">
					<a rel="nofollow" href="#top" title="Back to top"><i class="fa fa-chevron-up"></i>top</a>
				</div>
					<div id="page3">
						<div class="sixteen columns">
							<?php dynamic_sidebar('sidebar-8'); ?>
						</div>
					</div>
				<div id="page2">
					<div class="footer-footer">
						<div class="license">
							<p id="license">© 2015 Harmony theme by  <span class="colortext">fruitfulcode</span> 
							Powered by <span class="colortext">WordPress</span> </p>
						</div>
						<?php fruitful_get_socials_icon (); ?>

					</div>
				</div>
			</footer><!-- #colophon .site-footer -->
		<!--WordPress Development by Fruitful Code-->
		<?php wp_footer(); ?>
	</div>
	<div class="overlay overlay-contentscale">
		<button type="button" class="overlay-close"></button>
		<div class="search_form2">
			<nav>
				<div id="searchforms">
					<h3>Search For</h3>
					<?php fruitful_get_search_form() ?>
				</div>
			</nav>
		</div>
	</div>
	<div class="overlay2 overlay-contentscale">
		<button type="button" class="overlay-close2"></button>
		<div class="contact-form2">
			<nav>
				<?php echo do_shortcode('[contact-form-7 id="64" title="Contact Us"]');?>
			</nav>
		</div>
	</div>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/search_overlay.js" type="text/javascript"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/contact_overlay.js" type="text/javascript"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/classie.js" type="text/javascript"></script>
</body>
</html>