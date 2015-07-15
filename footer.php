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

	<div class="overlay3 overlay-contentscale">
		<button type="button" class="overlay-close3"></button>
		<div class="addcomment">
			<nav>
				<?php comment_form(); ?>
			</nav>
		</div>
	</div>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/search_overlay.js" type="text/javascript"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/contact_overlay.js" type="text/javascript"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/comment_overlay.js" type="text/javascript"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/classie.js" type="text/javascript"></script>

<!-- <section id="properties" class="properties">
	<div class="grid">
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div id="property-1898" class="property">
					<figure class="tag status">Sale</figure>
					<figure class="type" title="Apartment">
						<img width="26px" height="26px" src="http://themes.fruitfulcode.com/zoner/wp-content/uploads/2014/07/apartment.png" alt="">
					</figure><a href="http://themes.fruitfulcode.com/zoner/property/osiedle-domk%c3%b3w-szeregowych-w-rudzie-%c5%9bl%c4%85skiej/">
					<div class="property-image">
						<img class="img-responsive" src="http://themes.fruitfulcode.com/zoner/wp-content/uploads/2014/11/DSCN0648-440x330.jpg" alt="">
					</div>
					<div class="overlay">
						<div class="info">
							<span class="tag price">zł120,000</span>
							<h3>Osiedle domków szeregowych w Rudzie Śląskiej</h3>
							<figure>Ruda Śląska, Katowicka 18, 41-706</figure>
						</div>
						<ul class="additional-info">
							<li>
								<header>Area:</header>
								<figure>33 m<sup>2</sup></figure>
							</li>
							<li>
								<header>Beds:</header>
								<figure>3</figure>
							</li>
							<li>
								<header>Baths:</header>
								<figure>3</figure>
							</li>
							<li>
								<header>Garages:</header>
								<figure>3</figure>
							</li>
						</ul>
					</div></a>
				</div>
			</div>
		</div>
	</div> -->




</body>
</html>