<?php
//Get Page View Count
function thb_post_viewcount( $id ) {
  if ( function_exists( 'stats_get_from_restapi' ) ) {
		$id = $id ? $id : get_the_ID();

		$args = 'days=-1&post_id=' . $id;
    $cache = 'thb_postviews_count_' . $id;

    if ( ( $count = get_transient( $cache ) ) === false ) {
      $stats = stats_get_from_restapi( array(), 'views/posts/?post_ids='.$id );
      set_transient( $cache, $stats, 300 );
    }

    if ( $stats['posts'][0]['views'] != NULL ) {
      echo thb_numberAbbreviation(esc_attr($stats['posts'][0]['views']));
    } else {
      echo '0';
    }
  } else {
    return NULL;
  }
}
add_action( 'thb_post_viewcount', 'thb_post_viewcount', 10, 1 );

//Most Viewed
function thb_most_viewed( $time = 7, $numPosts = 5) {
  if ( function_exists( 'stats_get_from_restapi' ) ) {
    $cache = 'thb_most_viewed_'.$time;
    if ( ( $stats = get_transient( $cache ) ) === false ) {
        $stats = stats_get_from_restapi( array(), 'top-posts?max=' . absint( $numPosts + 30 ) . '&summarize=1&num=' . absint( $time ) );

        if ( ! empty( $stats->summary ) & ! empty( $stats->summary->postviews ) ) {
  				foreach ( $stats->summary->postviews as $key ) {
  					if ( 'page' != $key->type && 'homepage' != $key->type ) {
  						$posts[] = $key->id;
  						if ( count( $posts ) == $numPosts ) {
  							break;
  						}
  					}
  				}
  				set_transient( $cache, $posts, 600 );
  			}
    }
    if (!empty($posts)) {
      return $posts;
    }
    return NULL;
  } else {
    return NULL;
  }
}