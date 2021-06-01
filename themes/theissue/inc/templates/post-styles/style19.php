<?php
  add_filter( 'excerpt_length', 'thb_long_excerpt_length' );
  $classes[] = 'post';
  $classes[] = 'style19';
  $classes[] = 'center-contents';
?>
<div <?php post_class($classes); ?>>
  <?php do_action( 'thb_categories'); ?>
  <?php do_action( 'thb_displayTitle', 'h1'); ?>
  <figure class="post-gallery">
    <?php do_action('thb_post_icon'); ?>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('theissue-full-x2'); ?></a>
  </figure>
  <div class="post-excerpt">
    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="thb-read-more"><?php esc_html_e('Read More', 'theissue'); ?></a>
  </div>
  <?php do_action( 'thb_post_bottom', true); ?>
  <?php get_template_part('inc/templates/post-detail-bits/shopthelook-small'); ?>
</div>