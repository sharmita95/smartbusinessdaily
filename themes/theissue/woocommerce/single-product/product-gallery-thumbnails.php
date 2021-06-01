<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && $product->get_image_id() ) {
	?>
	<div id="product-thumbnails" class="product-thumbnails carousel thb-carousel" data-navigation="false" data-autoplay="false" data-columns="4" data-asnavfor="#product-images" data-infinite="false">
	<?php
	if ( has_post_thumbnail() ) : ?>
	  <div class="first woocommerce-product-gallery__image">
	  	<?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) ?>
	  </div>
	<?php endif;
	foreach ( $attachment_ids as $attachment_id ) {
		$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'theissue-thumbnail-x2' );
		$attributes      = array(
			'title'                   => get_post_field( 'post_title', $attachment_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image">';
		$html .= wp_get_attachment_image( $attachment_id, 'theissue-thumbnail-x2', false, $attributes );
 		$html .= '</div>';

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
	}
	?>
	</div>
	<?php
}