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
		</footer><!-- #colophon .site-footer -->
	<!--WordPress Development by Fruitful Code-->
<?php wp_footer(); ?>

</body>
</html>