<?php

// Get Instagram Photos
function thb_getInstagramPhotos($number = 6, $username) {

	// Check Username
	if ( ! $username ) {
		$result['error'] = esc_html( 'Please enter an Instagram User.', 'theissue' );
		return $result;
	}

	$transient_name = 'thb-instagram-media-'.$username.'-'.$number;
	$result = get_transient($transient_name);
	if (!$result) {

		$remote_url = 'https://instagram.com/'.$username;
		$request_params = array(
			'timeout'    => 10,
			'user-agent' => thb_random_user_agent(),
			'headers'    => array(
				'Accept-language' => 'en',
			),
			'sslverify' => false
		);

		$request = wp_safe_remote_get( $remote_url, $request_params );

		if ( is_wp_error( $request ) ) {
			return false;
		}

		$data = wp_remote_retrieve_body( $request );

    // Get Data
    preg_match( '/window\._sharedData = (.*);<\/script>/', $data, $ins_data );

    $ins_data_full = array_shift( $ins_data );
    $ins_data_json = array_shift( $ins_data );

		$image_data = false;
    if ( $ins_data_json ) {
      $instagram_json = json_decode( $ins_data_json, true );
      // Live Count.
      if ( ! empty( $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
        $image_data = $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
      } else {
        $result['error'] = esc_html__( 'Please check your username.', 'theissue' );
      }

			// User Data.
			if ( ! empty( $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user'] ) ) {
        $user_data['followed_by'] = $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'];
				$user_data['follow'] = $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_follow']['count'];
				$user_data['profile_pic_url_hd'] = $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user']['profile_pic_url_hd'];
      }

    } else {
      $result['error'] = esc_html__( 'Please check your username.', 'theissue' );
    }
		if ($image_data) {
			foreach ($image_data as $key => $edge) {
				if ( ! isset( $edge['node']['thumbnail_src'] ) && $edge['node']['thumbnail_src'] ) {
					continue;
				}
				$result['data'][$key] = array(
					'link'          => 'http://instagram.com/p/'.$edge['node']['shortcode'].'/',
					'image_url'     => $edge['node']['thumbnail_src'],
					'likes' 				=> $edge['node']['edge_liked_by']['count'],
					'comments' 			=> $edge['node']['edge_media_to_comment']['count']
				);
				if ( isset( $edge['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
					$text = strtok( $edge['node']['edge_media_to_caption']['edges'][0]['node']['text'], "\n" );

					$result['data'][$key]['caption'] = strip_tags( $text );
				}
			}
		}
		// Number of images.
		$result['data'] = array_slice( $result['data'], 0, $number, true );
		$result['user_data'] = $user_data;
		set_transient($transient_name, $result, HOUR_IN_SECONDS);
	}
	return $result;
}
