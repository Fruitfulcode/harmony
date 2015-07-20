<?php


	if ( ! function_exists( 'fruitful_get_product_search_form' ) ) {
		function fruitful_get_search_form(){
			?>
			<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				<div>
					<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search...', 'woocommerce' ); ?>" />
					<input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' ); ?>" />
					<input type="hidden" name="post_type" value="product" />
				</div>
			</form>
			<?php
		}
	}




 if ( ! function_exists( 'fruitful_widgets_init' ) ) {
function fruitful_widgets_init() {
	register_widget( 'Fruitful_Widget_News_Archive' );

	register_sidebar( array(
		'name' => __( 'Footer top sidebar', 'fruitful' ),
		'id' => 'sidebar-7',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer bottom sidebar', 'fruitful' ),
		'id' => 'sidebar-8',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Single Post Sidebar', 'fruitful' ),
		'id' => 'sidebar-3',
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
				$pc = new WP_Query('posts_per_page=6'); ?>
				<?php while ($pc->have_posts()) : $pc->the_post(); ?>
					<li>
						<?php 
						if (is_sticky() && $count==0) 
						$pc = new WP_Query('ignore_sticky_posts=1&posts_per_page=5'); $count++;?>
						<?php 
						if(has_post_thumbnail()){
							?><a href="<?php the_permalink();?>"><?php the_post_thumbnail(array());?></a><?php
						} else {
							echo '<img src="'.get_bloginfo('stylesheet_directory').'/images/no-image.png"/>';
						}?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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






add_action( 'widgets_init', 'ContactUs_widget' );

function ContactUs_widget() 
{
	register_widget( 'ContactUs_Widget' );
}
class ContactUs_Widget extends WP_Widget 
{

	function ContactUs_Widget() 
	{
		$widget_ops = array( 'classname' => 'contact_us', 'description' => __('Simple contact information ', 'contact_us') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact_us-widget' );
		$this->WP_Widget( 'contact_us-widget', __('Harmony Contact Information', 'contact_us'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance )
	{
		extract( $args );
		$address = $instance['address'];
		$email = $instance['email'];
		$phone = $instance['phone'];

		echo $before_widget;
		?>
		<div class="contact_us">
			<h3>Contact Information</h3>
		<?php
			if ( $address )
				printf( '<p>' . __('<i class="fa fa-map-marker"></i> %1$s', 'contact_us') . '</p>', $address );
			if ( $show_info )
				printf( $email );
			if ( $email )
				printf( __('<a href="mailto:%1$s"><i class="fa fa-envelope"></i> %1$s</a>', 'contact_us') . '<br><br>', $email );
			if ( $show_info )
				printf( $email );
			if ( $phone )
				printf( __('<a href="tel:%1$s"><i class="fa fa-phone"></i> %1$s</a>', 'contact_us'), $phone );
			if ( $show_info )
				printf( $phone );
		?>
		</div>
		<?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );

		return $instance;
	}

	function form( $instance ) 
	{

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Your address:', 'contact_us'); ?></label>
			<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Your email:', 'contact_us'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Your phone:', 'contact_us'); ?></label>
			<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}





if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'blog_img', 1920, 500, true ); // new solution for single blog pictures
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'blog_img2', 365, 265, true ); // new solution for blog pictures
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'sticky_img', 767, 530, true ); // new solution for sticky post pictures
}



function trim_characters($count, $after = '...') //function for cutting post title by letters
{
  $excerpt = get_the_title();
  $excerpt = strip_tags($excerpt);
  $excerpt = mb_substr($excerpt, 0, $count);
  $excerpt = $excerpt . $after;
  return $excerpt;
}


if (!function_exists('fruitful_get_blog_single')) //single blog post header
{
	function fruitful_get_blog_single()
	{
		if (is_single())
		{
			if ( has_post_thumbnail()) 
			{ 
				?>
				<div class="logofon">
					<?php echo get_the_post_thumbnail(null, array(1920, 500)); ?>
				</div>
				<?php
			} 
			if (! has_post_thumbnail()) 
			{ 
				?><div class="logofon2">

				</div><?php
			} 
			?>
			<div class="sixteen columns">
				<div class="entry-title2"> 
					<span class="post_tree"><?php  the_breadcrumb();?><span id="colortext"> <?php echo trim_characters(25, '...'); ?></span></span>
					<h1><?php the_title(); ?> </h1>
				</div>
			</div>
			<?php
		}
	}
}



function the_breadcrumb(){ // blogpost title
	if (!is_front_page()) 
	{
		echo '<a href="';
		echo get_option('home');
		echo '">Home';
		echo "</a> / ";
		if (is_category() || is_single()) 
		{
			the_category(' ');
			if (is_single()) 
			{
				echo " / ";
			}
		} 
		elseif (is_page()) 
		{
			echo the_title();
		}
	}
	else 
	{
		echo 'Home';
	}
}


if (!function_exists('harmony_entry_meta')) 
{
	function harmony_entry_meta()
	{
		if (is_single()) 
		{ 
		?>
			<div class="page-container">
				<header class="entry-meta">
					<?php if ('post' == get_post_type()):?>
					<?php
						 $categories_list = get_the_category_list( __( ', ', 'fruitful'));
					if ( $categories_list && fruitful_categorized_blog() ) : ?>
					<?php endif;?>
					
					<?php endif;?>
					
					<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
						<!-- <span class="comments-link"><i class="fa fa-comment-o"></i><?php comments_popup_link( __( 'Leave a comment', 'fruitful' ), __( '1', 'fruitful' ), __( '% Comments', 'fruitful' ) ); ?></span> -->
					<?php } ?>
					<?php
						$tags_list = get_the_tag_list( '', __( ', ', 'fruitful' ) );
						if ( $tags_list ) :
					?>
						<div class="tag-links">
							<h2 >Tags</h2> 
							<span class="tags"><?php echo $tags_list; ?></span> 
						</div>
						<?php endif;  ?>
						<div class="date"><?php echo get_the_date(); ?></div>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
							<div class="comments-link"><i class="fa fa-comment-o"></i><?php comments_popup_link( __( '0', 'fruitful' ), __( '1', 'fruitful' ), __( '% ', 'fruitful' ) ); ?></div>
						<?php } ?>
						
				</header>
			</div>	
		<?php
		} 
	}
}



if (!function_exists('harmony_entry_meta2')) 
{
	function harmony_entry_meta2()
	{
		if (is_single()) 
		{ 
		?>
				<div class="bio">
					<span class="biography_image"><?php echo get_avatar( get_the_author_meta('email') , 120 ); ?></span>
						<div class="biography_block">
							<h2><?php print get_the_author(); ?></h2>
							<span class="biography_text" ><?php echo get_the_author_meta ('description') ?></span>
						</div>
				</div>
			<?php fruitful_content_nav( 'nav-below' );  ?>
			<?php comments_template(); ?>
			<!-- <div class="replybutton">
				<button id="trigger-overlay3" type="button">Leave Comments</button>
			</div> -->
		<?php
		} 
	}
}




if ( ! function_exists( 'fruitful_get_content_with_custom_sidebar' ) ) {
	function fruitful_get_content_with_custom_sidebar($curr_sidebar = null) {
		global $post;
		
		function get_content_part() {
			global $post;
			
			?>
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">	
			<?php			
				/* Start the Loop */
				$page_on_front  = get_option('page_on_front');
				$page_for_posts = get_option('page_for_posts');
				
				if (is_page() && !empty($page_on_front) &&  !empty($page_for_posts) && ($page_on_front == $page_for_posts)) {
					echo '<div class="alert alert-danger"><strong>'.__("Front page displays Error.", 'fruitful').'</strong> '.__('Select different pages!', 'fruitful').'</div>';
					
				} else {
					if (!is_archive() && !is_search() && !is_404()) {
						if (is_home()) {
							if ( have_posts() ) : 
								/* The loop */ 
								while ( have_posts() ) : the_post(); 
									get_template_part( 'content', get_post_format() ); 
								endwhile; 
								fruitful_content_nav( 'nav-below' ); 
							else :
								get_template_part( 'no-results', 'index' ); 
							endif;
						} else {
							
							if ( have_posts() ) {
								while ( have_posts() ) : the_post();
									if (is_page() && !is_front_page() && !is_home()) {
										get_template_part( 'content', 'page' ); 

										if (fruitful_state_page_comment()) { 
											comments_template( '', true );  
										}
									} else if (is_single()) {
										get_template_part( 'content', get_post_format() );	
										fruitful_content_nav( 'nav-below' );
									
										if (fruitful_state_post_comment()) { 
											if ( comments_open() || '0' != get_comments_number() ) comments_template();  
										}
									} else if (is_front_page())	{
										get_template_part( 'content', 'page' );
									}
							   endwhile;
							}
						} 
					} else {
						?>
							<section id="primary" class="content-area">
								<div id="content" class="site-content" role="main">

								<?php if ( have_posts() ) : ?>
										<header class="page-header">
											<h1 class="page-title">
												<?php
													
													if ( is_archive()) {
														if ( is_category() ) {
															printf( __( 'Category Archives: %s', 'fruitful' ), '<span>' . single_cat_title( '', false ) . '</span>' );
														} elseif ( is_tag() ) {
															printf( __( 'Tag Archives: %s', 'fruitful' ), '<span>' . single_tag_title( '', false ) . '</span>' );
														} elseif ( is_author() ) {
															the_post();
															printf( __( 'Author Archives: %s', 'fruitful' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
															rewind_posts();

														} elseif ( is_day() ) {
															printf( __( 'Daily Archives: %s', 'fruitful' ), '<span>' . get_the_date() . '</span>' );
	
														} elseif ( is_month() ) {
															printf( __( 'Monthly Archives: %s', 'fruitful' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

														} elseif ( is_year() ) {
															printf( __( 'Yearly Archives: %s', 'fruitful' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

														} else {
															_e( 'Archives', 'fruitful' );
														}
													}
													
													if (is_search())
														printf( __( 'Search Results for: %s', 'fruitful' ), '<span>' . get_search_query() . '</span>' ); 
												?>
											</h1>
											<?php
												if ( is_category() ) {
													$category_description = category_description();
													if ( ! empty( $category_description ) )
														echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

												} elseif ( is_tag() ) {
													$tag_description = tag_description();
													if ( ! empty( $tag_description ) )
														echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
												}
											?>
										</header><!-- .page-header -->

										<?php /* Start the Loop */ 
										while ( have_posts() ) : the_post(); 
											get_template_part( 'content', get_post_format() );
										endwhile; 
										fruitful_content_nav( 'nav-below' );
										
									else : 
										if (is_404()) {
											get_template_part( 'content', '404' );	
										} else {
											get_template_part( 'no-results', 'archive' );
										}	
										
									endif; ?>

								</div><!-- #content .site-content -->
							</section><!-- #primary .content-area -->
						<?php
					}
				}
			?>
				</div>
			</div>
		<?php 
		}
		
		function get_html_custom_post_template($content_class, $sidebar_class, $curr_sidebar, $content_type) {
			global $post;
			$is_sidebar = true;
			$is_sidebar = fruitful_is_woo_sidebar();
				
			if ($content_type == 0) { ?>
				<?php get_content_part(); ?>	
		<?php } else if ($content_type == 1) { ?>
				
				<div class="eleven columns <?php echo $content_class;?>"><?php get_content_part(); ?> </div>	
				
				<?php if ($is_sidebar && is_page()) { ?>
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
				<?php } else { ?>	
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
				<?php } ?>	
				
		<?php } else if ($content_type == 2) { ?>
				
				<div class="eleven columns <?php echo $content_class;?>"> <?php get_content_part(); ?> </div>	
				
				<?php 
				if ($is_sidebar && is_page()) 
				{ 
					?>
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
					<?php 
				} 
				else 
				{ 
					?>	
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
					<?php 
				} 
				?>	
				
		<?php } 
		}
		
		$curr_template = '';
		$options = fruitful_get_theme_options();
		
		if (fruitful_is_latest_posts_page()) {
			$curr_template = esc_attr($options['latest_posts_templ']);
		} elseif (is_archive()) {
			if (is_tag()) {
				$curr_template = esc_attr($options['layout_tag_templ']);	
			} elseif (is_category()) {
				$curr_template = esc_attr($options['layout_cat_templ']);
			} elseif (is_author()) {
				$curr_template = esc_attr($options['layout_author_templ']);
			} else {
				$curr_template = esc_attr($options['layout_archive_templ']); 
			}	
		} elseif (is_404()) {
			$curr_template = esc_attr($options['layout_404_templ']);
		} elseif (is_search()) {
			$curr_template = esc_attr($options['layout_search_templ']);
		} else {
			$default_blog_template = (get_post_meta( get_option('page_for_posts', true), '_fruitful_page_layout', true ))?(get_post_meta( get_option('page_for_posts', true), '_fruitful_page_layout', true )-1) : 1;
			
			$default_post_template = (get_post_meta( $post->ID , '_fruitful_page_layout', true ))?(get_post_meta(  $post->ID , '_fruitful_page_layout', true )-1):esc_attr($options['layout_single_templ']);
			$default_page_template = (get_post_meta( $post->ID , '_fruitful_page_layout', true ))?(get_post_meta(  $post->ID , '_fruitful_page_layout', true )-1):esc_attr($options['layout_page_templ']);
			if (!fruitful_is_blog()) {
				if (is_archive()) {
					$curr_template = $default_blog_template;
				} else {
						
					if (class_exists('BuddyPress')){
						$bp_pages = get_option('bp-pages');			//possible pages - activity, members, register, activate
						foreach ($bp_pages as $bp_page_slug => $bp_page_id){
							if (bp_is_current_component($bp_page_slug)){
								$curr_template = (get_post_meta( $bp_page_id , '_fruitful_page_layout', true ))?(get_post_meta( $bp_page_id , '_fruitful_page_layout', true )-1):0;
							} else {
								$curr_template = $default_page_template;
							}
						}
					} else {
						$curr_template = $default_page_template;
					}
					
				}
			} else {
				if (is_single()) {
					$curr_template = $default_post_template;
				} else {
					$curr_template = $default_blog_template;
				}
			}
		}
		
		if ($curr_template == 0) { 
			get_html_custom_post_template('alpha', 'omega', $curr_sidebar, $curr_template);
		} else if ($curr_template == 1) { 
			get_html_custom_post_template('alpha', 'omega', $curr_sidebar, $curr_template);
		} else if ($curr_template == 2) {
			get_html_custom_post_template('omega', 'alpha', $curr_sidebar, $curr_template);
		} else {
			if (is_home()) {
				$curr_template = 1;
			}		
			get_html_custom_post_template('alpha', 'omega', $curr_sidebar, $curr_template);
		}
	}
}





if ( ! function_exists( 'fruitful_comment' ) ) :
function fruitful_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'fruitful' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'fruitful' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-body">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 60 ); ?>
					
				</div><!-- .comment-author .vcard -->
			</footer>
			<div class="comment-content">
				<div class="comment-meta commentmetadata">
					<?php printf( __( '%s', 'fruitful' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<div class="date2"><?php echo get_the_date('n.j.Y'); ?></div>
					<?php edit_comment_link( __( '(Edit)', 'fruitful' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'fruitful' ); ?></em>
					<br />
				<?php endif; ?>
				
				<?php comment_text(); ?>
				<div class="reply">
					<a href=""><i class="fa fa-long-arrow-right"></i></a>
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div>
			
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; 