<?php
	if ( ! function_exists( 'fruitful_get_product_search_form' ) ) {
		function fruitful_get_search_form(){
			?>
			<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				<div>
					<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'SEARCH', 'woocommerce' ); ?>" />
					<input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' ); ?>" />
					<input type="hidden" name="post_type" value="product" />
				</div>
			</form>
			<?php
		}
	}

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Fruitful theme 1.0
 */
 if ( ! function_exists( 'fruitful_widgets_init' ) ) {
function fruitful_widgets_init() {
	register_widget( 'Fruitful_Widget_News_Archive' );
	
	register_sidebar( array(
		'name' => __( 'footer sidebar', 'fruitful' ),
		'id' => 'sidebar-7',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'widgets_init', 'fruitful_widgets_init' );
}


class fruitful_news_widget extends WP_Widget 
{
	function __construct() {
		parent::__construct('fruitful_news_widget',__('Recent News', 'fruitful_new_widget'), 
		array( 'description' => __( 'Latest news from your blog', 'fruitful_new_widget'),));
	}
	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title',$instance['title']);
		echo $args['before_widget'];
		if (!empty($title)){
			echo $args['before_title'].$title.$args['after_title'];
			}
				$pc = new WP_Query('orderby=comment_count&posts_per_page=6'); ?>
				<?php while ($pc->have_posts()) : $pc->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array()); ?></a>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endwhile; 
				echo $args['after_widget'];

	}
	public function form( $instance ){
		if ( isset( $instance['title'])){
			$title = $instance['title'];
		}
		else {
			$title = __('Recent News','fruitful_new_widget');
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); 
			?>"><?php _e( 'Title:' );?>
		</label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title');
		?>" name="<?php echo $this->get_field_name( 'title' ); 
		?>" type="text" value="<?php echo esc_attr( $title ); ?>" 
		/>
		</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} 
	function fruit_load_widget() {
		register_widget( 'fruitful_news_widget' );
	}
	add_action( 'widgets_init', 'fruit_load_widget' );


