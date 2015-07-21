<?php
/**
 * @package WordPress
 * @subpackage Fruitful theme
 * @since Fruitful theme 1.0
 */
?>
<?php $options = fruitful_get_theme_options(); 
$sticky = count(get_option('sticky_posts'));
$default = $wp_query->post_count; ?>
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
						<?php if ($sticky == 0 && $default == 1): ?>
							
						<?php endif;?>
						<?php if ($sticky == 0 && $default == 2): ?>
							
						<?php endif;?>
						<?php if ($sticky == 0 && $default > 2): ?>
							
						<?php endif;?>
						<?php if ($sticky == 1 && $default == 0): ?>
							
						<?php endif;?>
						<?php if ($sticky == 1 && $default == 1): ?>
							
						<?php endif;?>
						<?php if ($sticky == 1 && $default == 2): ?>
							
						<?php endif;?>

						<?php  /*sticky-1 default>2*/
						if ($sticky == 1 && $default > 2): ?>
							<?php 
							if ( is_sticky() ) : ?>
								<?php harmony_s1_d2more(); ?>
							<?php 
							else : ?>
								<?php harmony_blog_structure(); ?>
							<?php
							endif;?>	
						<?php 
						endif;?>

						<?php if ($sticky == 2): ?>
							
						<?php endif;?>
						<?php if ($sticky == 3): ?>
							
						<?php endif;?>
						<?php if ($sticky > 3): ?>
							
						<?php endif;?>
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


		
