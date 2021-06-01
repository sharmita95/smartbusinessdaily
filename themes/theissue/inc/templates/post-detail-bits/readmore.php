<?php
  $post_readmore = get_post_meta(get_the_ID(), 'post_readmore', true);

  if ( !$post_readmore|| $post_readmore == '' ) {
    return;
  }
  $args = array(
		'post_type' => 'post',
		'post__in' => $post_readmore
	);
	$readmoreloop = new WP_Query( $args );

?>
<?php if ( $readmoreloop->have_posts() ) { ?>
<aside class="thb-readmore">
  <div class="thb-readmore-title"><?php esc_html_e('Read More', 'theissue'); ?></div>
  <?php while ( $readmoreloop->have_posts() ) : $readmoreloop->the_post(); ?>
    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
  <?php endwhile; ?>
</aside>
<?php wp_reset_postdata(); }
