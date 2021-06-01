<div class="row">
  <div class="small-12 columns">
    <div class="thb-author-page">
      <div class="row align-center">
        <div class="small-12 medium-8 columns">
          <div class="thb-author-info">
            <?php
              $id = get_the_author_meta( 'ID' );
              $count = count_user_posts($id);
            ?>
            <figure>
              <?php echo get_avatar( $id , '232', '', '', array('class' => 'lazyload')); ?>
            </figure>
            <div class="thb-author-page-description">
              <h1><?php the_author_meta('display_name', $id ); ?></h1>
              <p><?php the_author_meta('description', $id ); ?></p>
            </div>
          </div>
          <div class="thb-author-page-meta">
            <span><?php echo esc_attr($count); ?> <?php esc_html_e('Articles Published', 'theissue'); ?></span>
            <strong><?php esc_html_e('|', 'theissue'); ?></strong>
            <span><?php esc_html_e('Follow:', 'theissue'); ?></span>
            <?php if (get_the_author_meta('url', $id ) != '') { ?>
              <a href="<?php echo esc_url(get_the_author_meta('url', $id )); ?>" class="author-link"><i class="thb-icon-link"></i></a>
            <?php } ?>
            <?php if (get_the_author_meta('twitter', $id ) != '') { ?>
              <a href="<?php echo esc_url(get_the_author_meta('twitter', $id )); ?>" class="author-link-twitter"><i class="thb-icon-twitter"></i></a>
            <?php } ?>
            <?php if (get_the_author_meta('facebook', $id ) != '') { ?>
              <a href="<?php echo esc_url(get_the_author_meta('facebook', $id )); ?>" class="author-link-facebook"><i class="thb-icon-facebook"></i></a>
            <?php } ?>
            <?php if (get_the_author_meta('instagram', $id ) != '') { ?>
              <a href="<?php echo esc_url(get_the_author_meta('instagram', $id )); ?>" class="author-link-instagram"><i class="thb-icon-instagram"></i></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>