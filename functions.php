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


class fruitful_news_widget extends WP_Widget {
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
		$pc = new WP_Query('ignore_sticky_posts=1&posts_per_page=6'); ?>
		<?php while ($pc->have_posts()) : $pc->the_post(); ?>
			<li>
				<?php 
				if (has_post_thumbnail()) {
					$img_type = wp_get_attachment_image_src(get_post_thumbnail_id(),'default_post')[0];
				} else {
					$img_type = 'wp-content/themes/harmony/images/no-image-blog-2.png';
				}?>
				<div class="news-block">
					<a class="news-img" href="<?php the_permalink();?>" style="background:url(<?php echo $img_type ?>)no-repeat center;"></a>
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
				</div>
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
		}?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); 
				?>"><?php _e( 'Title:' );?>
			</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title');
			?>" name="<?php echo $this->get_field_name( 'title' ); 
			?>" type="text" value="<?php echo esc_attr( $title ); ?>" 
			/>
		</p><?php 
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
		parent::__construct( 'contact_us-widget', __('Harmony Contact Information', 'contact_us'), $widget_ops, $control_ops );
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
			if ( $email )
				printf( __('<a href="mailto:%1$s"><i class="fa fa-envelope"></i> %1$s</a>', 'contact_us') . '<br><br>', $email );
			if ( $phone )
				printf( __('<a href="tel:%1$s"><i class="fa fa-phone"></i> %1$s</a>', 'contact_us'), $phone );
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
	add_image_size( 'sticky_post', 1080, 1080, true ); // new solution for single blog pictures
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'default_post', 365, 280, true ); // new solution for blog pictures
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'single_img', 1920, 500, true ); // new solution for single-blog post pictures
}


function trim_characters($count, $after = '...') { //function for cutting post title by letters
	$excerpt = get_the_title();
	$excerpt = strip_tags($excerpt);
	$excerpt = mb_substr($excerpt, 0, $count);
	$excerpt = $excerpt . $after;
	return $excerpt;
}


if (!function_exists('fruitful_get_blog_single')) //single blog post header
{
	function fruitful_get_blog_single()	{
		if (is_single()) {
			if ( has_post_thumbnail()) { 
				?><div class="logofon" style="background:url(<?php $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single_img');echo ''.$full_image_url[0]?> )no-repeat center;"></div><?php
			} 
			if (! has_post_thumbnail()) { 
				?><div class="logofon2"></div><?php
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
		if (is_category() || is_single()) {
			the_category(' ');
			if (is_single()) {
				echo " / ";
			}
		} 
		elseif (is_page()) {
			echo the_title();
		}
	}
	else 	{
		echo 'Home';
	}
}


if (!function_exists('harmony_entry_meta')) {
	function harmony_entry_meta()	{
		if (is_single()) { 
			?><div class="page-container">
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
					if ( $tags_list ) :?>
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
		</div><?php
		} 
	}
}


if (!function_exists('harmony_entry_meta2')) {
	function harmony_entry_meta2() {
		if (is_single()) { 
			?>
			<div class="bio">
				<span class="biography_image"><?php echo get_avatar( get_the_author_meta('email') , 120 ); ?></span>
				<div class="biography_block">
					<h2><?php print get_the_author(); ?></h2>
					<span class="biography_text" ><?php echo get_the_author_meta ('description') ?></span>
				</div>
			</div>
			<?php if ( have_comments() ) : ?>
				<h2 class="comments-title">
					<?php
					printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'fruitful' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
						?>
					</h2>
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
						<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
							<h1 class="assistive-text"><?php _e( 'Comment navigation', 'fruitful' ); ?></h1>
							<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'fruitful' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'fruitful' ) ); ?></div>
						</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
					<?php endif; // check for comment navigation ?>

					<ol class="commentlist">
						<?php
						/* Loop through and list the comments. Tell wp_list_comments()
						 * to use fruitful_comment() to format the comments.
						 * If you want to overload this in a child theme then you can
						 * define fruitful_comment() and that will be used instead.
						 * See fruitful_comment() in inc/template-tags.php for more.
						 */
						wp_list_comments( array( 'callback' => 'fruitful_comment' ) );
						?>
					</ol><!-- .commentlist -->
				<?php endif; // have_comments() ?>
				<?php comment_form(); ?>
			<!-- <div class="replybutton">
				<button id="trigger-overlay3" type="button">Leave Comments</button>
			</div> -->
			<?php
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

			/*blog blocks*/
			global $cnt_posts, $is_even, $odd_count, $sticky_posts, $count_sticky, $posts_per_page;

			$cnt_posts = 1;
			$odd_count = 1;

			$sticky_posts   = get_option('sticky_posts');
			$count_sticky   = count($sticky_posts);
			$posts_per_page = get_option('posts_per_page');

			if ( ! function_exists( 'child_post_classes' ) ) :
				function child_post_classes( $classes ) {
					if  (is_home() && !is_single()) {
  			// $classes[] = 'one-third';
  			// $classes[] = 'column';
					}
					return $classes;
				}
		endif; //bilt_post_classes
		add_filter( 'post_class', 'child_post_classes' );


		function bpost_content_loop() {
			global $wp_query, 
			$cnt_posts, 
			$is_even, 
			$odd_count, 
			$count_sticky,  
			$odd_count, 
			$posts_per_page; 

			$post_count  = $wp_query->post_count;

			$is_even = ($count_sticky%2 == 0);
			if (!$is_even && $count_sticky > 0) {
				if ($count_sticky == 1 && $cnt_posts == 1 && ($post_count - $count_sticky) > 0)
					echo '<div class="sticky-container grid-sticky_with-posts_post-two_post-one">';


				if ($count_sticky > 2 && $cnt_posts == 1)
					echo '<div class="sticky-container grid-sticky">';

			} else if ($is_even && $count_sticky > 0) {
				if ($odd_count == 1 && is_sticky(get_the_ID())) {
					$odd_count = 1;
					echo '<div class="sticky-container grid-sticky-odd ">';
				}
			} 
		}
		add_action('before_post_content_loop', 'bpost_content_loop');


		function apost_content_loop() {
			global $wp_query, 
			$cnt_posts, 
			$is_even, 
			$odd_count, 
			$count_sticky,  
			$odd_count, 
			$posts_per_page; 

			$post_count = $wp_query->post_count;
			if (!$is_even && $count_sticky > 0) {
				if ($count_sticky == 1 && ($post_count - $count_sticky) > 0) {
					if (($post_count - $count_sticky) >= 2 ) {
						if ($cnt_posts == 3)
							echo '</div> <!-- sticky-container with-posts -->'; 
					} else if (($post_count - $count_sticky) == 1 && $cnt_posts > 1) {
						echo '</div> <!-- sticky-container with-posts -->'; 
					}
				}

				if (is_sticky(get_the_ID()) && ($count_sticky == $cnt_posts) && $count_sticky > 2)
					echo '</div> <!-- sticky-container grid-sticky -->';

			} else if ($is_even && $count_sticky > 0) {
				if (is_sticky(get_the_ID()) && $odd_count == 2) {
					echo '</div><!-- sticky-container grid-sticky-odd -->';
					$odd_count = 1;
				} else {
					$odd_count++;
				}

				if (is_sticky(get_the_ID()) && ($count_sticky == $cnt_posts) && $count_sticky > 2)
					echo '</div> <!-- sticky-container grid-sticky -->';
			}  
			$cnt_posts++;
		}
		add_action('after_post_content_loop', 'apost_content_loop');


		function child_options($sections) {
	include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use is_plugin_active() below
	if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
		global $wpdb;
		$cf7 = $wpdb->get_results(
			"
			SELECT ID, post_title
			FROM $wpdb->posts
			WHERE post_type = 'wpcf7_contact_form'
			"
			);
		$contact_forms = array();
		if ($cf7) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[$cform->ID] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = 0;
		}
	} 
	else {
		$contact_forms[0] = 'No contact forms found';
	}	

	$sections['custom'] = array (
		'title'					=> __( 'Custom', 'fruitful' ),
		'fields'				=> array(	
			array(
				'id' 				=> 'search_overlay',
				'label'			=> __( 'Search field' , 'fruitful' ),
				'info'      => __( 'Here you can enable/disable Overlay Search', 'fruitful' ),
				'description'	=> __( 'Enable' , 'fruitful'),
				'type'			=> 'checkbox',
				'default'		=> 'on'
				),
			array(
				'id' 				=> 'overlay_type',
				'label'			=> __( 'Overlay type' , 'fruitful' ),
				'info'      => __( 'Set search overlay type', 'fruitful' ),			
				'type'			=> 'select',
				'options'		=> 	array( 
					'-1'	 		=> __('Huge inc', 'fruitful') , 
					'2' 			=> __('Corner', 'fruitful'),
					'3' 			=> __('Slide down', 'fruitful'), 
					'4' 			=> __('Scale', 'fruitful'), 
					'5' 			=> __('Door', 'fruitful'), 
					'6' 			=> __('Content push', 'fruitful'), 
					'7' 			=> __('Content scale', 'fruitful'), 
					'8' 			=> __('Corner shape', 'fruitful'), 
					'9' 			=> __('Little boxes', 'fruitful'), 
					'10' 			=> __('Simple genie', 'fruitful'), 
					'11' 			=> __('Genie', 'fruitful')
					),
				'default'		=> '7'
				),
			array(
				'id'        => 'cc-scf-7',
				'label'			=> __( 'Contact form type' , 'fruitful' ),
				'info'      => __( 'Only if contact form 7 enebled', 'fruitful' ),	
				'type'      => 'select',
				'title'     => __('Select contact form', 'fruitful'),
				'options'   => $contact_forms,
				),
			)
);
return $sections;
}
add_filter('settings_fields', 'child_options');


function get_search_overlay() {
	$theme_options  = fruitful_get_theme_options(); 
	if (isset($theme_options['overlay_type'])) {
		if ($theme_options['overlay_type'] == -1) {echo '<div class="overlay overlay-hugeinc">';}
		else if ($theme_options['overlay_type'] == 2) {echo '<div class="overlay overlay-corner">';}
		else if ($theme_options['overlay_type'] == 3) {echo '<div class="overlay overlay-slidedown">';}
		else if ($theme_options['overlay_type'] == 4) {echo '<div class="overlay overlay-scale">';}
		else if ($theme_options['overlay_type'] == 5) {echo '<div class="overlay overlay-door">';}
		else if ($theme_options['overlay_type'] == 6) {echo '<div class="overlay overlay-contentpush">';}
		else if ($theme_options['overlay_type'] == 7) {echo '<div class="overlay overlay-contentscale">';}
		else if ($theme_options['overlay_type'] == 8) {
			echo '<div class="overlay overlay-cornershape" data-path-to="m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">';
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">';
			echo '<path class="overlay-path" d="m 0,0 1439.999975,0 0,805.99999 0,-805.99999 z"/>';
			echo '</svg>';
		}
		else if ($theme_options['overlay_type'] == 9) {
			echo '<div class="overlay overlay-boxes">';
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="101%" viewBox="0 0 1440 806" preserveAspectRatio="none">';
			echo '<path d="m0.005959,200.364029l207.551124,0l0,204.342453l-207.551124,0l0,-204.342453z"/>inc/';
			echo '<path d="m0.005959,400.45401l207.551124,0l0,204.342499l-207.551124,0l0,-204.342499z"/>';
			echo '<path d="m0.005959,600.544067l207.551124,0l0,204.342468l-207.551124,0l0,-204.342468z"/>';
			echo '<path d="m205.752151,-0.36l207.551163,0l0,204.342437l-207.551163,0l0,-204.342437z"/>';
			echo '<path d="m204.744629,200.364029l207.551147,0l0,204.342453l-207.551147,0l0,-204.342453z"/>';
			echo '<path d="m204.744629,400.45401l207.551147,0l0,204.342499l-207.551147,0l0,-204.342499z"/>';
			echo '<path d="m204.744629,600.544067l207.551147,0l0,204.342468l-207.551147,0l0,-204.342468z"/>';
			echo '<path d="m410.416046,-0.36l207.551117,0l0,204.342437l-207.551117,0l0,-204.342437z"/>';
			echo '<path d="m410.416046,200.364029l207.551117,0l0,204.342453l-207.551117,0l0,-204.342453z"/>';
			echo '<path d="m410.416046,400.45401l207.551117,0l0,204.342499l-207.551117,0l0,-204.342499z"/>';
			echo '<path d="m410.416046,600.544067l207.551117,0l0,204.342468l-207.551117,0l0,-204.342468z"/>';
			echo '<path d="m616.087402,-0.36l207.551086,0l0,204.342437l-207.551086,0l0,-204.342437z"/>';
			echo '<path d="m616.087402,200.364029l207.551086,0l0,204.342453l-207.551086,0l0,-204.342453z"/>';
			echo '<path d="m616.087402,400.45401l207.551086,0l0,204.342499l-207.551086,0l0,-204.342499z"/>';
			echo '<path d="m616.087402,600.544067l207.551086,0l0,204.342468l-207.551086,0l0,-204.342468z"/>';
			echo '<path d="m821.748718,-0.36l207.550964,0l0,204.342437l-207.550964,0l0,-204.342437z"/>';
			echo '<path d="m821.748718,200.364029l207.550964,0l0,204.342453l-207.550964,0l0,-204.342453z"/>';
			echo '<path d="m821.748718,400.45401l207.550964,0l0,204.342499l-207.550964,0l0,-204.342499z"/>';
			echo '<path d="m821.748718,600.544067l207.550964,0l0,204.342468l-207.550964,0l0,-204.342468z"/>';
			echo '<path d="m1027.203979,-0.36l207.550903,0l0,204.342437l-207.550903,0l0,-204.342437z"/>';
			echo '<path d="m1027.203979,200.364029l207.550903,0l0,204.342453l-207.550903,0l0,-204.342453z"/>';
			echo '<path d="m1027.203979,400.45401l207.550903,0l0,204.342499l-207.550903,0l0,-204.342499z"/>';
			echo '<path d="m1027.203979,600.544067l207.550903,0l0,204.342468l-207.550903,0l0,-204.342468z"/>';
			echo '<path d="m1232.659302,-0.36l207.551147,0l0,204.342437l-207.551147,0l0,-204.342437z"/>';
			echo '<path d="m1232.659302,200.364029l207.551147,0l0,204.342453l-207.551147,0l0,-204.342453z"/>';
			echo '<path d="m1232.659302,400.45401l207.551147,0l0,204.342499l-207.551147,0l0,-204.342499z"/>';
			echo '<path d="m1232.659302,600.544067l207.551147,0l0,204.342468l-207.551147,0l0,-204.342468z"/>';
			echo '<path d="m-0.791443,-0.360001l207.551163,0l0,204.342438l-207.551163,0l0,-204.342438z"/>';
			echo '</svg>';
		}
		else if ($theme_options['overlay_type'] == 10) {echo '<div class="overlay overlay-simplegenie">';}
		else if ($theme_options['overlay_type'] == 11) {
			echo '<div class="overlay overlay-genie" data-steps="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z;m 698.9986,728.03569 41.23353,0 -3.41953,77.8735 -34.98557,0 z;m 687.08153,513.78234 53.1506,0 C 738.0505,683.9161 737.86917,503.34193 737.27015,806 l -35.90067,0 c -7.82727,-276.34892 -2.06916,-72.79261 -14.28795,-292.21766 z;m 403.87105,257.94772 566.31246,2.93091 C 923.38284,513.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 455.17312,480.07689 403.87105,257.94772 z;M 51.871052,165.94772 1362.1835,168.87863 C 1171.3828,653.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 31.173122,513.78234 51.871052,165.94772 z;m 52,26 1364,4 c -12.8007,666.9037 -273.2644,483.78234 -322.7299,776 l -633.90062,0 C 359.32034,432.49318 -6.6979288,733.83462 52,26 z;m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">';
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">';
			echo '<path class="overlay-path" d="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z"/>';
			echo '</svg>';
		}
			echo '<button type="button" class="overlay-close"></button>';
			echo '<div class="search_form2">';
				echo '<nav>';
					echo '<ul>';
						echo '<li>';
							echo '<div id="searchforms">';
								echo '<h3>Search For</h3>';
								echo fruitful_get_search_form();
							echo '</div>';
						echo '</li>';
					echo '</ul>';
				echo '</nav>';
			echo '</div>';
		echo '</div>';
	}
}


function get_contact_overlay() {
	$theme_options  = fruitful_get_theme_options(); 
	include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use is_plugin_active() below
	if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
		$cf7_id = $theme_options['cc-scf-7'];
	}
	else {
		$cf7_id = null;
	}
	if (isset($theme_options['overlay_type'])) {
		if ($theme_options['overlay_type'] == -1) {echo '<div class="overlay2 overlay-hugeinc">';}
		else if ($theme_options['overlay_type'] == 2) {echo '<div class="overlay2 overlay-corner">';}
		else if ($theme_options['overlay_type'] == 3) {echo '<div class="overlay2 overlay-slidedown">';}
		else if ($theme_options['overlay_type'] == 4) {echo '<div class="overlay2 overlay-scale">';}
		else if ($theme_options['overlay_type'] == 5) {echo '<div class="overlay2 overlay-door">';}
		else if ($theme_options['overlay_type'] == 6) {echo '<div class="overlay2 overlay-contentpush">';}
		else if ($theme_options['overlay_type'] == 7) {echo '<div class="overlay2 overlay-contentscale">';}
		else if ($theme_options['overlay_type'] == 8) {
			echo '<div class="overlay2 overlay-cornershape" data-path-to="m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">';
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">';
			echo '<path class="overlay-path" d="m 0,0 1439.999975,0 0,805.99999 0,-805.99999 z"/>';
			echo '</svg>';
		}
		else if ($theme_options['overlay_type'] == 9) {
			echo '<div class="overlay2 overlay-boxes">';
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="101%" viewBox="0 0 1440 806" preserveAspectRatio="none">';
			echo '<path d="m0.005959,200.364029l207.551124,0l0,204.342453l-207.551124,0l0,-204.342453z"/>inc/';
			echo '<path d="m0.005959,400.45401l207.551124,0l0,204.342499l-207.551124,0l0,-204.342499z"/>';
			echo '<path d="m0.005959,600.544067l207.551124,0l0,204.342468l-207.551124,0l0,-204.342468z"/>';
			echo '<path d="m205.752151,-0.36l207.551163,0l0,204.342437l-207.551163,0l0,-204.342437z"/>';
			echo '<path d="m204.744629,200.364029l207.551147,0l0,204.342453l-207.551147,0l0,-204.342453z"/>';
			echo '<path d="m204.744629,400.45401l207.551147,0l0,204.342499l-207.551147,0l0,-204.342499z"/>';
			echo '<path d="m204.744629,600.544067l207.551147,0l0,204.342468l-207.551147,0l0,-204.342468z"/>';
			echo '<path d="m410.416046,-0.36l207.551117,0l0,204.342437l-207.551117,0l0,-204.342437z"/>';
			echo '<path d="m410.416046,200.364029l207.551117,0l0,204.342453l-207.551117,0l0,-204.342453z"/>';
			echo '<path d="m410.416046,400.45401l207.551117,0l0,204.342499l-207.551117,0l0,-204.342499z"/>';
			echo '<path d="m410.416046,600.544067l207.551117,0l0,204.342468l-207.551117,0l0,-204.342468z"/>';
			echo '<path d="m616.087402,-0.36l207.551086,0l0,204.342437l-207.551086,0l0,-204.342437z"/>';
			echo '<path d="m616.087402,200.364029l207.551086,0l0,204.342453l-207.551086,0l0,-204.342453z"/>';
			echo '<path d="m616.087402,400.45401l207.551086,0l0,204.342499l-207.551086,0l0,-204.342499z"/>';
			echo '<path d="m616.087402,600.544067l207.551086,0l0,204.342468l-207.551086,0l0,-204.342468z"/>';
			echo '<path d="m821.748718,-0.36l207.550964,0l0,204.342437l-207.550964,0l0,-204.342437z"/>';
			echo '<path d="m821.748718,200.364029l207.550964,0l0,204.342453l-207.550964,0l0,-204.342453z"/>';
			echo '<path d="m821.748718,400.45401l207.550964,0l0,204.342499l-207.550964,0l0,-204.342499z"/>';
			echo '<path d="m821.748718,600.544067l207.550964,0l0,204.342468l-207.550964,0l0,-204.342468z"/>';
			echo '<path d="m1027.203979,-0.36l207.550903,0l0,204.342437l-207.550903,0l0,-204.342437z"/>';
			echo '<path d="m1027.203979,200.364029l207.550903,0l0,204.342453l-207.550903,0l0,-204.342453z"/>';
			echo '<path d="m1027.203979,400.45401l207.550903,0l0,204.342499l-207.550903,0l0,-204.342499z"/>';
			echo '<path d="m1027.203979,600.544067l207.550903,0l0,204.342468l-207.550903,0l0,-204.342468z"/>';
			echo '<path d="m1232.659302,-0.36l207.551147,0l0,204.342437l-207.551147,0l0,-204.342437z"/>';
			echo '<path d="m1232.659302,200.364029l207.551147,0l0,204.342453l-207.551147,0l0,-204.342453z"/>';
			echo '<path d="m1232.659302,400.45401l207.551147,0l0,204.342499l-207.551147,0l0,-204.342499z"/>';
			echo '<path d="m1232.659302,600.544067l207.551147,0l0,204.342468l-207.551147,0l0,-204.342468z"/>';
			echo '<path d="m-0.791443,-0.360001l207.551163,0l0,204.342438l-207.551163,0l0,-204.342438z"/>';
			echo '</svg>';
		}
		else if ($theme_options['overlay_type'] == 10) {echo '<div class="overlay2 overlay-simplegenie">';}
		else if ($theme_options['overlay_type'] == 11) {
			echo '<div class="overlay2 overlay-genie" data-steps="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z;m 698.9986,728.03569 41.23353,0 -3.41953,77.8735 -34.98557,0 z;m 687.08153,513.78234 53.1506,0 C 738.0505,683.9161 737.86917,503.34193 737.27015,806 l -35.90067,0 c -7.82727,-276.34892 -2.06916,-72.79261 -14.28795,-292.21766 z;m 403.87105,257.94772 566.31246,2.93091 C 923.38284,513.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 455.17312,480.07689 403.87105,257.94772 z;M 51.871052,165.94772 1362.1835,168.87863 C 1171.3828,653.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 31.173122,513.78234 51.871052,165.94772 z;m 52,26 1364,4 c -12.8007,666.9037 -273.2644,483.78234 -322.7299,776 l -633.90062,0 C 359.32034,432.49318 -6.6979288,733.83462 52,26 z;m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">';
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">';
			echo '<path class="overlay-path" d="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z"/>';
			echo '</svg>';
		}
			echo '<button type="button" class="overlay-close2"></button>';
			echo '<div class="contact-form2">';
				echo '<nav>';
					echo '<ul>';
						echo '<li>';
							echo '<h3>Contact</h3>';
							echo '<div class="cf7-contact">';
								echo do_shortcode('[contact-form-7 id="'.$cf7_id.'"]');
							echo '</div>';
						echo '</li>';
					echo '</ul>';
				echo '</nav>';
			echo '</div>';
		echo '</div>';
	}
}


function get_search_status() {
	$theme_options  = fruitful_get_theme_options(); 
	if (isset($theme_options['search_overlay'])) {
		if ($theme_options['search_overlay'] == 'off') {
			echo '<div class="search_form" style="display:none;">';
		}
		else {
			echo '<div class="search_form">';
		}
		echo '<span id="trigger-overlay" type="button"><i class="fa fa-search"></i>Search</span>';
		echo '</div>';
	}
}


function get_contact_status() {
	include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use is_plugin_active() below
	if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
		echo '<div class="contact-form">';
	}
	else {
		echo '<div class="contact-form" style="display:none;">';
	}
	echo '<button id="trigger-overlay2" type="button"><i class="fa fa-envelope-o"></i>Contact Me</button>';
	echo '</div>';
}














