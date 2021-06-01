<?php
/* De-register Contact Form 7 styles */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles
function thb_main_styles() {
	global $post;
	$i = 0;
	$self_hosted_fonts = ot_get_option('self_hosted_fonts');

	// Enqueue
	wp_enqueue_style("thb-app", Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/css/app.css', null, esc_attr(Thb_Theme_Admin::$thb_theme_version));

	if ( wp_unslash($_SERVER['HTTP_HOST']) !== 'theissue.fuelthemes.net') {
		wp_enqueue_style('thb-style', get_stylesheet_uri(), null, null);
	}
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont(), array(), null );
	wp_add_inline_style( 'thb-app', thb_selection() );

	if ($self_hosted_fonts) {
		foreach ($self_hosted_fonts as $font) {
			$i++;
			wp_enqueue_style("thb-self-hosted-".$i, $font['font_url'], null, esc_attr(Thb_Theme_Admin::$thb_theme_version));
		}
	}

	if ( $post ) {
		if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}

}
add_action('wp_enqueue_scripts', 'thb_main_styles');


// Main Scripts
function thb_register_js() {
	if (!is_admin()) {
		global $post;
		$thb_api_key = ot_get_option('map_api_key');

		// Register
		wp_enqueue_script('thb-vendor', Thb_Theme_Admin::$thb_theme_directory_uri. 'assets/js/vendor.min.js', array('jquery'), esc_attr(Thb_Theme_Admin::$thb_theme_version), TRUE);
		wp_enqueue_script('underscore');
		wp_enqueue_script('thb-app', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/js/app.min.js', array('jquery', 'thb-vendor', 'underscore'), esc_attr(Thb_Theme_Admin::$thb_theme_version), TRUE);

		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) ) {
			wp_enqueue_script('comment-reply');
		}

		if ( $post ) {
			if ( has_shortcode($post->post_content, 'thb_map_parent') || has_shortcode($post->post_content, 'thb_location_parent')) {
				wp_enqueue_script('gmapdep', 'https://maps.google.com/maps/api/js?key='.esc_attr($thb_api_key).'', false, null, false);
			}

			if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}
		// Typekit
		if ($typekit_id = ot_get_option('typekit_id')) {
			wp_enqueue_script('thb-typekit', 'https://use.typekit.net/'.$typekit_id.'.js', array(), NULL, FALSE );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}

		wp_localize_script( 'thb-app', 'themeajax', array(
			'url' => admin_url( 'admin-ajax.php' ),
			'l10n' => array (
				'of' => esc_html__('%curr% of %total%', 'theissue'),
				'just_of' => esc_html__('of', 'theissue'),
				'loading' => esc_html__("Loading", 'theissue'),
				'lightbox_loading' => esc_html__("Loading...", 'theissue'),
				'nomore' => esc_html__("No More Posts", 'theissue'),
				'nomore_products' => esc_html__("All Products Loaded", 'theissue'),
				'loadmore' => esc_html__("Load More", 'theissue'),
				'added' => esc_html__("Added To Cart", 'theissue'),
				'no_results' => esc_html__("No Results Found", 'theissue'),
				'results_found' => esc_html__("Results Found", 'theissue'),
				'results_all' => esc_html__("View All Results", 'theissue'),
				'copied' => esc_html__("Copied", 'theissue'),
				'prev' => esc_html__("Prev", 'theissue'),
				'next' => esc_html__("Next", 'theissue'),
				'pinit' => esc_html__("PIN IT", 'theissue'),
				'adding_to_cart' => esc_html__("Adding to Cart", 'theissue')
			),
			'svg' => array(
				'prev_arrow' => thb_load_template_part('assets/img/svg/prev_arrow.svg'),
				'next_arrow' => thb_load_template_part('assets/img/svg/next_arrow.svg'),
				'added_arrow' => thb_load_template_part('assets/img/svg/arrows_check.svg'),
				'close_arrow' => thb_load_template_part('assets/svg/arrows_remove.svg'),
				'pagination' => thb_load_template_part('assets/img/svg/pagination.svg'),
				'preloader' => thb_load_template_part('assets/img/svg/preloader-material.svg'),
			),
			'settings' => array (
				'infinite_count' => ot_get_option('infinite_count'),
				'site_url' => get_home_url(),
				'current_url' => get_permalink(),
				'fixed_header_scroll' => ot_get_option('fixed_header_scroll', 'on'),
				'fixed_header_padding' => ot_get_option('header_padding_fixed'),
				'newsletter_length' => ot_get_option('newsletter-interval','1'),
				'page_transition' => ot_get_option('page_transition', 'on'),
				'page_transition_style' => ot_get_option('page_transition_style', 'thb-fade'),
				'page_transition_in_speed' => ot_get_option('page_transition_in_speed', 1000),
				'page_transition_out_speed' => ot_get_option('page_transition_out_speed', 500),
				'shop_product_listing_pagination' => ot_get_option('shop_product_listing_pagination', 'style1'),
				'right_click' => ot_get_option('right_click','on'),
				'cart_url'  => thb_wc_supported() ? wc_get_cart_url(): false,
				'is_cart'  => thb_wc_supported() ? is_cart() : false,
				'is_checkout' => thb_wc_supported() ? is_checkout() : false,
				'touch_threshold' => apply_filters('theissue_touchthreshold', 5),
				'thb_custom_video_player' => ot_get_option('thb_custom_video_player', 'on'),
				'viai_publisher_id' => ot_get_option('viai_publisher_id', '431861828953521')
			)
		) );
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
