
<?php

	if ( ! function_exists( 'fruitful_get_product_search_form' ) ) {
		function fruitful_get_search_form(){
			?>
			<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				<div>
					<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search', 'woocommerce' ); ?>" />
					<input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' ); ?>" />
					<input type="hidden" name="post_type" value="product" />
				</div>
			</form>
			<?php
		}
	}

		

