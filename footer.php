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
					<div class="sixteen columns">
						<div class="footer-sidebar">
							<?php get_sidebar('footer'); ?>
						</div>
					</div>
			</div>
		</div><!-- .page-container-->
		
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
					<ul>
						<?php
						$pc = new WP_Query('orderby=comment_count&posts_per_page=5'); ?>
						<?php while ($pc->have_posts()) : $pc->the_post(); ?>
						<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array()); ?></a>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</li>
						<?php endwhile; ?>
					</ul>
			</div>
			<div id="back-top">
				<a rel="nofollow" href="#top" title="Back to top">&uarr;</a>
			</div>
		</footer><!-- #colophon .site-footer -->
	<!--WordPress Development by Fruitful Code-->
<?php wp_footer(); ?>

</body>
</html>