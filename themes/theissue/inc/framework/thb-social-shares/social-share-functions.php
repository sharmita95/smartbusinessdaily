<?php

function thb_get_count( $function, $post_id = 0 ) {
	$cache = array();
	$cache = get_transient( 'thb_counts' );


	if ( ! $post_id ) { $post_id = get_the_ID(); }

	$count = isset($cache[ $function . '_' . $post_id ]) ? $cache[ $function . '_' . $post_id ] : false;

	if ( empty( $count ) && $count !== '0' ) {
		$url = get_permalink( $post_id );

		if ( ! empty( $url ) ) {
			require_once('social-share-api.php');
			$share_counter = new thb_ShareCount( $url );
			$count = call_user_func( array( $share_counter, $function ) );
		}

		if ( empty( $count ) )
			$count = '0';

		$cache[ $function . '_' . $post_id ] = $count;

		$time = '';
		switch (ot_get_option('sharing_cache', '1')) {
			case '1h':
				$time = 3600;
				break;
			case '1':
				$time = DAY_IN_SECONDS;
				break;
			case '7':
				$time = WEEK_IN_SECONDS;
				break;
			case '30':
				$time = DAY_IN_SECONDS * 30;
				break;
		}

		set_transient( 'thb_counts', $cache, $time );
	}
	if ($function == 'thb_all_count') {
		update_post_meta($post_id, 'thb_all_counts', $count);
	}
	return $count;
}

/* Wrapper Functions */

function thb_facebook_count( $post_id = 0 ) {
	return thb_get_count( __FUNCTION__, $post_id );
}
function thb_linkedin_count( $post_id = 0 ) {
	return thb_get_count( __FUNCTION__,$post_id );
}
function thb_pinterest_count( $post_id = 0 ) {
	return thb_get_count( __FUNCTION__ ,$post_id );
}
function thb_all_count( $post_id = 0 ) {
	return thb_get_count( __FUNCTION__,$post_id );
}