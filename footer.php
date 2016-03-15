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
					<?php harmony_entry_meta2(); ?>
				</div>
			</div><!-- .page-container-->
			
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="sixteen columns">
					<div class="footer-sidebar">
						<?php if (is_page() || is_single() ) : ?>
							<?php dynamic_sidebar('sidebar-7'); ?>
						<?php endif;?>
					</div>
				</div>
				<div id="back-to-top">
					<a rel="nofollow" href="#top" title="Back to top"><i class="fa fa-chevron-up"></i>top</a>
				</div>
					<div id="footer">
						<div class="sixteen columns">
							<?php dynamic_sidebar('sidebar-8'); ?>
						</div>
					</div>
				<div id="copyright">
					<div class="footer-footer">
						<div class="license">
							<p id="license">© 2015 Harmony theme by  <a href="http://fruitfulcode.com" class="colortext" target="blank">fruitfulcode</a> 
							Powered by <a href="https://wordpress.org" class="colortext" target="blank">WordPress</a> </p>
						</div>
						<?php fruitful_get_socials_icon (); ?>

					</div>
				</div>
			</footer><!-- #colophon .site-footer -->
		<!--WordPress Development by Fruitful Code-->
		<?php wp_footer(); ?>
	</div>
	<?php get_search_overlay(); ?>
	<?php get_contact_overlay(); ?>
	<script src="<?php echo esc_url( get_stylesheet_directory_uri());?>/js/classie.js" type="text/javascript"></script>
	<script src="<?php echo esc_url( get_stylesheet_directory_uri());?>/js/custom_harmony.js" type="text/javascript"></script>
	<script src="<?php echo esc_url( get_stylesheet_directory_uri());?>/js/modernizr.custom.js" type="text/javascript"></script>
	<script src="<?php echo esc_url( get_stylesheet_directory_uri());?>/js/snap.svg-min.js" type="text/javascript"></script>
</body>
</html>