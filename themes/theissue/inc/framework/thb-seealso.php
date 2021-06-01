<?php
function thb_seealso($content) {
  if ( !( is_single() || is_admin() ) ) { return $content; }
  $article_seealso = ot_get_option('article_seealso', 'on');
  if ( $article_seealso == 'off' ) { return $content; }

	$data = explode( '</p>', $content );
	$count = count( $data );
	if ( $count < 5 ) {
		return $content;
	}

  $twothirds = floor( $count / 1.5 );


  array_splice( $data, $twothirds, 0, '<p>'.thb_get_seealsopost().'</p>' );

  $content = implode( '</p>', $data );
  return $content;
}

add_filter( 'the_content', 'thb_seealso' );

function thb_get_seealsopost() {
  global $post;
	$id = $post->ID;
  $article_seealso_relation = ot_get_option('article_seealso_relation', 'cats');
  if ($article_seealso_relation == 'cats') {
    $cats = get_the_category();
    $all_cats = '';
  	foreach ( $cats as $cat ) {
  		$all_cats .= $cat->term_id . ',';
  	}
    $args = array(
  		'cat'              => $all_cats,
  		'post__not_in'     => array( $id ),
  		'posts_per_page'   => 1,
  		'orderby'          => 'rand',
  	);
  } else if ($article_seealso_relation == 'tags') {
    $tags = wp_get_post_tags($id);
    $tag_ids = array();
		foreach($tags as $individual_tag) { $tag_ids[] = $individual_tag->term_id; }
	  $args = array(
	    'tag__in' => $tag_ids,
	    'post__not_in'     => array( $id ),
	    'posts_per_page'   => 1,
      'orderby'          => 'rand',
	  );
  }

  $article_seealso_date = ot_get_option('article_seealso_date', '0');

  if ($article_seealso_date > 0) {
    $args['date_query'] = array(
			array(
				'column' => 'post_modified_gmt',
				'after'  => $article_seealso_date . ' months ago',
			),
		);
  }
  $seealso_query = new WP_Query($args);
  ob_start();
  while ( $seealso_query->have_posts() ) : $seealso_query->the_post();
    get_template_part('inc/templates/post-styles/misc/see-also');
  endwhile;

  $out = ob_get_clean();
	wp_reset_postdata();

  return $out;

}