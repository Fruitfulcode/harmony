<?php
/**
 * @package WordPress
 * @subpackage Fruitful theme
 * @since Fruitful theme 1.0
 */
?>
<?php $options = fruitful_get_theme_options(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?>>

	
	<div class="post-content">	
		<header class="post-header">

			<?php if ( !is_single() ) : ?>
				<?php if ( /*has_post_thumbnail() &&*/ !post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<div class="property">
							<a href="<?php the_permalink(); ?>">
								<?php if (is_sticky()) :
									$post_type	= 'sticky_post';	
								endif; ?>
								<?php if (! is_sticky()) :
									$post_type	= 'default_post';
								endif; ?>
								<div class="property-image img-responsive" style="background:url(<?php 
									if ( has_post_thumbnail()) { 
										$full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'sticky_post');echo ''.$full_image_url[0] . '';
									} 
									else {
										echo get_stylesheet_directory_uri(). '/images/no-image-blog-3.png'; 
									}?> )";>
								</div>

								<div class="overlay-blog">
									<div class="info">
										<h3>
											<?php the_title(); ?>
										</h3>
										<div class="additional-info">
											<span class="post_tree"><?php the_excerpt(); ?></span>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php endif;?>
		<?php endif;?>
		</header><!-- .entry-header -->

		<?php if ( (is_search())) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<?php if ( is_single() ) : ?>
				<div class="entry-content">
					<?php harmony_entry_meta(); ?>
					<?php the_content( __( 'Read More <span class="meta-nav">&rarr;</span>', 'fruitful' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'fruitful' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			<?php endif;?>
		<?php endif;?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
