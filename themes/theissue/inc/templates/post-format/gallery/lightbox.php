<?php
  $thb_id = get_the_ID();
	$lightbox_post_title = ot_get_option('lightbox_post_title', 'on');
	$lightbox_image_title = ot_get_option('lightbox_image_title', 'on');
	$lightbox_image_caption = ot_get_option('lightbox_image_caption', 'on');
	$lightbox_image_source = ot_get_option('lightbox_image_source', 'on');
	$lightbox_color = isset($_GET['lightbox_color']) ? $_GET['lightbox_color'] : ot_get_option('lightbox_color', 'lightbox-light');
	$photos = thb_get_gallery_photos($thb_id);

  if (!is_array($photos)) { return; }
  $count = sizeof($photos);

	$i = 1;

	$classes[] = 'post-gallery-content';
  $classes[] = 'lightbox-style2';
	$classes[] = $lightbox_color;
?>
<div id="thb-post-gallery-<?php echo esc_attr($thb_id); ?>" class="mfp-hide">

	<?php foreach ($photos as $photo_id) { ?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
			<div class="lightbox-header">
				<div class="row full-width-row no-row-padding">
					<div class="small-6 medium-8 columns">
						<?php if ($lightbox_post_title == 'on') { ?>
							<h5><?php the_title(); ?></h5>
						<?php } ?>
					</div>
					<div class="small-6 medium-4 columns close-column">
						<aside class="meta">
							<?php echo esc_attr($i) . '<em>/</em>'. esc_attr($count); ?>
						</aside>
						<button title="<?php esc_attr_e('Close (Esc)', 'theissue'); ?>" class="lightbox-header-button lightbox-grid"><?php get_template_part('assets/img/svg/grid.svg'); ?></button>
						<button title="<?php esc_attr_e('Close (Esc)', 'theissue'); ?>" class="lightbox-header-button lightbox-close"><?php get_template_part('assets/svg/arrows_remove.svg'); ?></button>
					</div>
				</div>
			</div>
			<div class="row full-width-row no-padding thb-content-row  no-row-padding">
				<div class="small-12 medium-7 large-9 columns image">
					<?php echo wp_get_attachment_image( $photo_id, 'theissue-full-x2' ); ?>

					<?php if ($i == '1') { ?>
						<div class="thb-gallery-grid">
							<div class="row">
							<?php $j = 1; foreach ($photos as $photo) { ?>
								<div class="small-4 medium-3 columns"><div class="thb-grid-image"><span class="thb-grid-count"><?php echo esc_attr($j); ?></span><?php echo wp_get_attachment_image( $photo, 'theissue-thumbnail-x3', false, array(
                    'class' => "thb-pinned",
                ) ); ?></div></div>
							<?php $j++; } ?>
							</div>
						</div>
					<?php } ?>
					<a class="thb-gallery-arrow mfp-arrow-left prev"><?php get_template_part('assets/img/svg/prev_arrow.svg'); ?></a>
					<a class="thb-gallery-arrow mfp-arrow-right next"><?php get_template_part('assets/img/svg/next_arrow.svg'); ?></a>
				</div>
				<div class="small-12 medium-5 large-3 columns image-text">
					<div class="lightbox-text-content">
						<?php $the_image = get_post($photo_id); ?>
						<?php if ($the_image->post_title && $lightbox_image_title == 'on') { ?>
							<h6><?php echo esc_html($the_image->post_title); ?></h6>
						<?php } ?>
						<?php if ($the_image->post_excerpt && $lightbox_image_caption == 'on') { ?>
							<p><?php echo wp_kses_post($the_image->post_excerpt); ?></p>
						<?php } ?>
						<?php if ($the_image->post_content && $lightbox_image_source == 'on') { ?>
							<small><?php esc_html_e('Source:', 'theissue'); ?> <?php echo esc_html($the_image->post_content); ?></small>
						<?php } ?>
					</div>
					<?php do_action('thb_adv_lightbox_sidebar', $i - 1); ?>
				</div>
			</div>
		</div>
	<?php $i++; } ?>
</div>
