<?php
  $classes[] = 'post';
  $classes[] = 'mega-menu-style1';
?>
<div <?php post_class($classes); ?>>
  <figure class="post-gallery">
    <?php do_action('thb_post_icon'); ?>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('theissue-squaresmall-x2'); ?></a>
  </figure>
  <?php do_action( 'thb_displayTitle', 'h6'); ?>
</div>