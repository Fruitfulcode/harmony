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
			<?php if ( is_single() ) : ?>
			<?php else : ?>
				<?php if (get_the_title() != '') : ?>
				<?php endif; ?>
			<?php endif;  ?>		
			
			<?php if ( !is_single() ) : ?>
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php if ( is_sticky() ) : ?>
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
														<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'fruitful' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
													</h2> 
													<div class="additional-info2">
														<span class="post_tree"><?php the_excerpt(); ?><span id="colortext"> <?php echo trim_characters(50, '...'); ?></span></span>
													</div>
												</div>
											</div>
										</a>
									</div>
								</article>
							</div>
						<?php else : ?>
							<article  id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?>>
								<div class="property">
									<a href="<?php the_permalink(); ?>">
										<div class="property-image">
											<img class="img-responsive" src=<?php if ( has_post_thumbnail()) { $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog_img2');echo ''.$full_image_url[0] . '';} ?>>
										</div> 
										<div class="overlay-blog">
											<div class="info">
												<h3 class="post-title2 entry-title">
													<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'fruitful' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
												</h3>
												<div class="additional-info">
													<h2>test</h2>
												</div>
											</div>
										</div>
									</a>
								</div>
							</article>
						<?php endif;  ?>
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
		
