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
				$pc = new WP_Query('ignore_sticky_posts=1&posts_per_page=6'); ?>
				<?php while ($pc->have_posts()) : $pc->the_post(); ?>
					<li>
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
	add_image_size( 'sticky_post', 1080, 1080, true ); // new solution for single blog pictures
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'default_post', 365, 280, true ); // new solution for blog pictures
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'single_img', 1920, 500, true ); // new solution for single-blog post pictures
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
 

/*if (isset($_GET['width']) AND isset($_GET['height'])) {
    echo 'Ширина экрана: ' . $_GET['width'] . "<br />\n";
    echo 'Высота экрана: ' . $_GET['height'] . "<br />\n";
}
else {
    echo "<script language='javascript'>\n";
    echo " location.href=\"${_SERVER['SCRIPT_NAME']}?${_SERVER['QUERY_STRING']}"
            . "width=\" + screen.width + \"&height=\" + screen.height;\n";
    echo "</script>\n";
}*/


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
  	if (isset($_GET['width']) < 640) {
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
  	if (isset($_GET['width']) < 640) {
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
	}
  
  $cnt_posts++;
 }

 add_action('after_post_content_loop', 'apost_content_loop');