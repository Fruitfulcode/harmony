<?php
/**
 * @package WordPress
 * @subpackage Fruitful theme
 * @since Fruitful theme 1.0
 */
?>
<?php $options = fruitful_get_theme_options(); ?>
	<div class="post-content">	
		<header class="post-header">
			<?php 
			if ( is_single() ) : ?>
			<?php else : ?>
				<?php if (get_the_title() != '') : ?>
				<?php endif; ?>
			<?php endif;  ?>		
			
			<?php if ( !is_single() ) : ?>
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php 
						if ( is_sticky() ) : ?>
							<div class="sticky-post">
								<article id="sticky-post" <?php post_class('blog_post'); ?>>
									<div class="property">
										<a href="<?php the_permalink(); ?>">
											<div class="property-image2">
												<img class="img-responsive" src=<?php if ( has_post_thumbnail()) { $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'sticky_img');echo ''.$full_image_url[0] . '';} ?>>
											</div>
											<div class="overlay-blog2">
												<div class="info">
													<h2>
														<?php the_title(); ?>
													</h2> 
													<div class="additional-info2">
														<span class="post_tree"><?php the_excerpt(); ?></span>
													</div>
												</div>
											</div>
										</a>
									</div>
								</article>
							</div>
						<?php 
						else : ?>
							<?php 
							if ($count < 2) : ?>
								<div class="default-post">
									<?php harmony_blog_structure(); ?>
								</div>
							<?php 
							else : ?>
								<div class="default-post2">
									<?php harmony_blog_structure(); ?>
								</div>
							<?php 
							endif;
						endif; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( is_single() ) : 
					if ($options['show_featured_single'] == 'on'){
						if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div> 
						<?php endif;
					} ?>
			<?php endif;  ?>
		</header>

		<?php if ( (is_search())) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
			<?php if ( is_single() ) : ?>
				<div class="entry-content">
					<?php the_content( __( 'Read More <span class="meta-nav">&rarr;</span>', 'fruitful' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'fruitful' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			<?php endif;
			?>
		<?php endif; ?>
	</div>


		
