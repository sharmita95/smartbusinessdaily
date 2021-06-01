<?php
  if (ot_get_option('article_author', 'on') == 'off') { return; }
  $id = get_the_author_meta( 'ID' );
  if ( get_the_author_meta('description', $id ) == '') { return; }
?>
<div class="thb-article-author style1">
  <?php echo get_avatar( $id , '172', '', '', array('class' => 'lazyload')); ?>
  <div class="author-content">
    <a href="<?php echo get_author_posts_url( $id ); ?>" rel="author"><?php the_author_meta('display_name', $id ); ?></a>
    <?php if(get_the_author_meta('twitter', $id ) != '') { ?>
			<a href="<?php echo get_the_author_meta('twitter', $id ); ?>" class="twitter author-social" target="_blank"><i class="thb-icon-twitter"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('facebook', $id ) != '') { ?>
			<a href="<?php echo get_the_author_meta('facebook', $id ); ?>" class="facebook author-social" target="_blank"><i class="thb-icon-facebook"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('instagram', $id ) != '') { ?>
			<a href="<?php echo get_the_author_meta('instagram', $id ); ?>" class="instagram author-social" target="_blank"><i class="thb-icon-instagram"></i></a>
		<?php } ?>
    <p><?php the_author_meta('description', $id ); ?></p>
  </div>
</div>