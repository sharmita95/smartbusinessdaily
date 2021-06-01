<?php
  add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );

  $classes[] = 'post';
  $classes[] = 'mega-menu-style2';
  $classes[] = 'featured-style';
  $classes[] = 'center-contents';

?>
<div <?php post_class($classes); ?>>
  <figure class="post-gallery">
    <?php the_post_thumbnail('theissue-squaresmall-x2'); ?>
  </figure>
  <div class="post-inner-content">
    <?php do_action( 'thb_displayTitle', 'h5'); ?>
  </div>
</div>