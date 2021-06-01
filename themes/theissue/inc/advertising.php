<?php
/* Header */
function thb_before_header() {
  $header_top_content = ot_get_option('header_top_content');
  $header_top_content_parallax = ot_get_option('header_top_content_parallax', 'on');
  $header_top_content_article = ot_get_option('header_top_content_article', 'on');
  if (empty($header_top_content)) { return; }
  if (is_single() && $header_top_content_article == 'off') { return; }
  ?>
  <div class="thb_before_header" data-parallax="<?php echo esc_attr($header_top_content_parallax); ?>">
    <div class="thb_before_header_inner">
      <?php do_action('thb_page_content', $header_top_content); ?>
    </div>
  </div>
  <?php
}
add_action('thb_before_header', 'thb_before_header');

function thb_header_left() {
  $header_left_content = ot_get_option('header_left_content', '');

  if ($header_left_content == '') { return; }


  ?>
  <div class="thb_header_left">
    <?php
      if ($header_left_content == 'social-links') {
        thb_get_social_list(true, true, 'thb-social-horizontal', 'mono-icons-horizontal');
      }
      if ($header_left_content == 'subscribe') {
        ?>
        <a href="#newsletter-popup" class="btn small no-radius thb-open-subscribe accent mfp-inline"><?php esc_html_e('Subscribe', 'theissue'); ?></a>
        <?php
      }
      if ($header_left_content == 'advertisement') {
        $adv_header_left = ot_get_option('adv_header_left');
        if ($adv_header_left && $adv_header_left !== '') {
          echo do_shortcode($adv_header_left);
        }
      }
    ?>
  </div>
  <?php
}
add_action('thb_header_left', 'thb_header_left');

function thb_header_right() {
  $header_right_content = ot_get_option('header_right_content', '');

  if ($header_right_content == '') { return; }


  ?>
  <div class="thb_header_right">
    <?php
      if ($header_right_content == 'social-links') {
        thb_get_social_list(true, true, 'thb-social-horizontal', 'mono-icons-horizontal');
      }
      if ($header_right_content == 'subscribe') {
        ?>
        <a href="#newsletter-popup" class="btn small no-radius thb-open-subscribe accent mfp-inline"><?php esc_html_e('Subscribe', 'theissue'); ?></a>
        <?php
      }
      if ($header_right_content == 'advertisement') {
        $adv_header_right = ot_get_option('adv_header_right');
        if ($adv_header_right && $adv_header_right !== '') {
          echo do_shortcode($adv_header_right);
        }
      }
    ?>
  </div>
  <?php
}
add_action('thb_header_right', 'thb_header_right');

/* Articles */
function thb_ads_before_content() {
  $adv_before_content = ot_get_option('adv_before_content');
  if ($adv_before_content && $adv_before_content !== '') {
    echo '<aside class="ad_before_content">'.do_shortcode($adv_before_content).'</aside>';
  }
}
add_action('thb_ads_before_content', 'thb_ads_before_content', 10);

function thb_ads_after_content() {
  $adv_after_content = ot_get_option('adv_after_content');
  if ($adv_after_content && $adv_after_content !== '') {
    echo '<aside class="ad_after_content cf">'.do_shortcode($adv_after_content).'</aside>';
  }
}
add_action('thb_ads_after_content', 'thb_ads_after_content', 10);

function thb_ads_after_article() {
  $adv_postend = ot_get_option('adv_postend');
  if ($adv_postend && $adv_postend !== '') {
    echo '<aside class="ad_container_bottom cf">'.do_shortcode($adv_postend).'</aside>';
  }
}
add_action('thb_ads_after_article', 'thb_ads_after_article', 10);

function thb_ads_after_article_ajax() {
  $adv_postend_ajax = ot_get_option('adv_postend_ajax');
  if ($adv_postend_ajax && $adv_postend_ajax !== '') {
    echo '<aside class="ad_container_bottom cf">'.do_shortcode($adv_postend_ajax).'</aside>';
  }
}
add_action('thb_ads_after_article_ajax', 'thb_ads_after_article_ajax', 10);

/* Galleries */
function thb_adv_lightbox_sidebar($i) {
  $adv_lightbox_sidebar = ot_get_option('adv_lightbox_sidebar');

  if (!is_array($adv_lightbox_sidebar) ) {
    return;
  }
  $adv_size = sizeof($adv_lightbox_sidebar);

  if ($i + 1 > $adv_size) {
    $i = $i % $adv_size;
  }


  if (isset($adv_lightbox_sidebar[$i]) && $adv_lightbox_sidebar[$i]['ad_code'] !== '') {
    echo '<aside class="ad_container_gallery_sidebar thb-ad-position-'.$i.'">';
    echo do_shortcode($adv_lightbox_sidebar[$i]['ad_code']);
    echo '</aside>';
  }
}
add_action('thb_adv_lightbox_sidebar', 'thb_adv_lightbox_sidebar', 10, 1);