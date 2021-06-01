<?php

/* Get Article Style */
function thb_get_article_style($id) {
	$style = ot_get_option('article_style', 'style1');

	if (get_post_meta($id, 'article_style_override', true) === 'on') {
		$style = get_post_meta($id, 'post_style', true);

		if (empty($style) || $style == '') {
			$style = get_post_meta($id, 'post-style', true);
		}
	}
	return $style;
}
/* Post Categories */
function thb_categories($article = false) {
	if ( has_category() ) {
		if ($article && ot_get_option('article_cat', 'on') == 'off') {
			return;
		} else {
			$post_meta_category = ot_get_option('post_meta_cat', 'on');

			if ($post_meta_category == 'off') {
				return;
			}
		}
		$classes[] = 'post-category';
		$classes[] = $article ? 'post-detail-category' : false;
		?>
		<aside class="<?php echo esc_attr(implode(' ', $classes)); ?>">
			<?php
				if ($article) {
					$article_cat_primary = ot_get_option('article_cat_primary', 'off');
					if ($article_cat_primary == 'on') {
						do_action( 'thb_DisplaySingleCategory');
					} else {
						the_category('<i>,</i> ');
					}
				} else {
					$post_meta_cat_primary = ot_get_option('post_meta_cat_primary', 'off');

					if ($post_meta_cat_primary == 'on') {
						do_action( 'thb_DisplaySingleCategory');
					} else {
						the_category('<i>,</i> ');
					}
				}
			?>
		</aside>
	<?php
	}
	if ($article) {
		do_action('thb_after_post_category');
	}
}
add_action('thb_categories', 'thb_categories', 10, 1);

/* Get Single Category ID */
function thb_getSingleCategory() {
	$selection = get_post_meta(get_the_ID(), 'post-primary-category', true);

	if (!$selection || $selection === 'auto') {
	  if ( empty($id)) {
	    $id = '';
	    $categories = get_the_category();
	    if ( empty( $categories ) ) return;
	    while ( empty($id) && ! empty($categories) ) {
	      $cat = array_shift($categories);

	      if ( $cat->parent == 0 ) {
					$id = $cat->term_id;
				}
	    }
	  }
	  if ( ! (int) $id ) { return; }
	} else {
		$id = $selection;
	}
  ?>
		<a href="<?php echo esc_url(get_category_link($id)); ?>" rel="category tag"><?php echo get_cat_name($id); ?></a>
	<?php
}
add_action( 'thb_DisplaySingleCategory', 'thb_getSingleCategory');
/* Display Title */
function thb_displayTitle($tag = 'h3', $id = false) {
	$id = $id ? $id : get_the_ID();
	$frmt = '<div class="post-title"><%s><a href="%s" title="%s"><span>%s</span></a></%s></div>';
	echo sprintf( $frmt, $tag, get_permalink($id), the_title_attribute("echo=0"), get_the_title($id), $tag);
}
add_action( 'thb_displayTitle', 'thb_displayTitle', 10, 2);

/* Post Author */
function thb_post_author() {
	?>
	<div class="post-author">
		<em><?php esc_html_e('by', 'theissue'); ?></em> <?php the_author_posts_link(); ?>
	</div>
	<?php
}
add_action('thb_post_author', 'thb_post_author', 10);

/* Post Bottom Info */
function thb_post_bottom($author) {
	$post_id = get_the_ID();
	$post_sponsors_selected = wp_get_post_terms($post_id, 'thb-sponsors');
	$post_meta_author = ot_get_option('post_meta_author', 'on');
	$post_meta_date = ot_get_option('post_meta_date', 'on');
	$post_meta_reading_time = ot_get_option('post_meta_reading_time', 'on');
	$post_meta_sharing = ot_get_option('post_meta_sharing', 'on');


	if ( false !== $post_sponsors_selected && ! empty( $post_sponsors_selected ) && is_array($post_sponsors_selected)) { ?>
		<aside class="thb-post-bottom sponsored-bottom">
			<ul>
				<li><?php echo esc_html_e('Sponsored Content', 'theissue'); ?></li>
				<li>
					<?php foreach ( $post_sponsors_selected as $sponsor_id ) { ?>
		    		<?php $sponsor = get_term( $sponsor_id ); ?> <?php echo esc_attr($sponsor->name); ?>
		      <?php } ?>
				</li>
			</ul>
		</aside>
	<?php } else { ?>
		<?php if (($post_meta_author == 'off' || !$author) && $post_meta_date == 'off' && $post_meta_reading_time == 'off' && $post_meta_sharing == 'off') { return; } ?>
		<aside class="thb-post-bottom">
			<?php if ($author && $post_meta_author == 'on') { do_action('thb_post_author'); } ?>
			<ul>
				<?php if ($post_meta_date == 'on') { ?>
				<li class="post-date"><?php echo get_the_date(); ?></li>
				<?php } ?>
				<?php if ($post_meta_reading_time == 'on') { ?>
				<li class="post-read"><?php do_action('thb_reading_time'); ?></li>
				<?php } ?>
				<?php if ($post_meta_sharing == 'on') { if (!class_exists('TheIssue_plugin')) { return; } ?>
				<li class="post-share"><?php echo thb_numberAbbreviation(thb_all_count($post_id)); ?> <?php echo esc_html_e('Shares', 'theissue'); ?>
					<?php
						$post_url = get_permalink();
						$sharing_buttons = thb_article_get_accounts($post_url, $post_id, 'post_meta_sharing_icons' );

						if (!empty($sharing_buttons)) {
					?>
					<div class="post-share-bubble">
						<div class="post-share-icons">
							<?php foreach($sharing_buttons as $button) { ?>
								<a href="<?php echo esc_url($button['url']); ?>" class="post-social-share <?php echo esc_attr($button['slug']); ?>">
									<i class="<?php echo esc_attr($button['icon']); ?>"></i>
								</a>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				</li>
				<?php } ?>
			</ul>
		</aside>
		<?php
	}
}
add_action('thb_post_bottom', 'thb_post_bottom', 10, 1);

/* Post Icon */
function thb_post_icon() {
	$format = get_post_format();
	$thb_id = get_the_ID();
	$is_review = get_post_meta($thb_id, 'post_review', TRUE) == 'on';

	if (!($format == 'gallery' || $format == 'video' || $is_review)) {
		return;
	}

	if ($is_review) {
		$thb_post_review_average = thb_post_review_average();

		if (!is_numeric($thb_post_review_average)) {
			return;
		}
	}
	?>
	<div class="thb-post-icon">
		<?php if ($format == 'gallery') { ?>
			<?php
				$post_gallery_photos = get_post_meta($thb_id, 'post-gallery-photos', true);
				$count = 0;
				if ($post_gallery_photos) {
					$post_gallery_photos_arr = explode(',', $post_gallery_photos);
					$count = sizeof($post_gallery_photos_arr);
				}
			?>
			<?php get_template_part('assets/img/svg/gallery.svg'); ?>
			<span class="gallery_count"><?php echo esc_attr($count); ?></span>
		<?php } else if ($format == 'video'){ ?>
			<?php get_template_part('assets/img/svg/video.svg'); ?>
		<?php } else if ($is_review) { ?>
			<?php get_template_part('assets/img/svg/review.svg'); ?>
			<span class="review_count"><?php echo esc_attr($thb_post_review_average); ?></span>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_post_icon', 'thb_post_icon');

/* Article Date & Author  */
function thb_article_after_h1() {
	$id = get_the_author_meta( 'ID' );
	$style = ot_get_option('sharing_buttons_top_style', 'style5');
	?>
	<div class="thb-post-title-bottom">
		<?php if (in_array($style, array('style2','style3', 'style4', 'style5'))) { ?>

		<div class="thb-post-title-inline-author">
			<?php if (ot_get_option('article_author_name', 'on') == 'on') { ?>
				<?php echo get_avatar( $id , '80', '', '', array('class' => 'lazyload')); ?>
			<?php } ?>
			<div class="author-and-date">
				<?php if (ot_get_option('article_author_name', 'on') == 'on') { ?>
					<?php do_action('thb_post_author'); ?>
				<?php } ?>
				<?php if (ot_get_option('article_date', 'on') == 'on') { ?>
					<div class="thb-post-date">
						<?php echo get_the_date(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php if ($style == 'style5') { do_action('thb_article_after_post_inlineauthor'); }?>
		<?php } else { ?>
			<?php if (ot_get_option('article_date', 'on') == 'on') { ?>
				<div class="thb-post-title-inline-author">
					<div class="thb-post-date">
						<?php echo get_the_date(); ?>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
	<?php
}
add_action('thb_article_after_h1', 'thb_article_after_h1');

/* Article Author */
function thb_article_author_left() {
	if (ot_get_option('article_author_name', 'on') == 'off') { return; }
	$id = get_the_author_meta( 'ID' );
	?>
	<div class="thb-article-author">
		<?php echo get_avatar( $id , '156', '', '', array('class' => 'lazyload')); ?>
		<div class="author-content">
			<a href="<?php echo get_author_posts_url( $id ); ?>" rel="author"><?php the_author_meta('display_name', $id ); ?></a>
			<p><?php echo wp_trim_words(get_the_author_meta('description', $id ), 10); ?></p>
		</div>
	</div>
	<?php
}

/* Article Read Next  */
function thb_article_read_next() {
	$next_post = get_next_post();
	if (!$next_post) {
		return;
	}
	?>
	<div class="thb-fixed-bottom">
		<div class="thb-fixed">
			<aside class="thb-read-next">
				<h6 class="thb-read-next-title"><?php esc_html_e('Read Next', 'theissue'); ?></h6>
				<div class="post read-next-post">
					<?php if (has_post_thumbnail($next_post->ID)) { ?>
						<figure class="post-gallery">
					    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo get_the_post_thumbnail($next_post->ID, 'theissue-thumbnail-x2'); ?></a>
					  </figure>
					<?php } ?>
					<?php do_action( 'thb_displayTitle', 'h5', $next_post->ID); ?>
				</a>
			</aside>
		</div>
	</div>
	<?php
}

/* Executive Summary */
function thb_executive_summary() {
	$executive_summaries = trim(get_post_meta( get_the_ID(), 'executive_summary', TRUE ));
	$executive_summaries = explode(PHP_EOL, $executive_summaries);
  if (!$executive_summaries) { return; }
	if (empty($executive_summaries) || $executive_summaries[0] == '') { return; }
	?>
	<ul class="thb-executive-summary">
		<?php foreach ($executive_summaries as $executive_summary) { ?>
		  <li><?php echo esc_html($executive_summary); ?></li>
		<?php } ?>
	</ul>
	<?php
}
add_action( 'thb_article_after_h1', 'thb_executive_summary', 99);

/* Article Featured Image */
function thb_article_featured_image($image_size) {
	$thb_id = get_the_ID();
	$article_style = thb_get_article_style($thb_id);
	$featured_image_credit = get_post_meta($thb_id, 'standard-featured-credit', true);
	$featured_image_override = get_post_meta($thb_id, 'featured_image_override', true);
	$featured_image_override_id = get_post_meta($thb_id, 'featured_image_override_id', true);
	$format = get_post_format();
  $video_url = 'video' === $format ? get_post_meta($thb_id , 'post_video', TRUE) : false;
	$cond = !in_array($article_style, array('style1', 'style4'));
	$classes[] = 'thb-article-featured-image';
	$classes[] = $cond ? 'thb-parallax' : false;

	if (!has_post_thumbnail()) { return; }
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php if ($cond ) { ?>data-video="<?php echo esc_attr($video_url); ?>"<?php } ?>>
		<?php
			if ($cond) {
				if (has_post_thumbnail()) {
					if ($featured_image_override == 'on' && !empty($featured_image_override_id)) {
						echo wp_get_attachment_image($featured_image_override_id, $image_size);
					} else {
						the_post_thumbnail($image_size);
					}
				}
			} else if ('video' === $format) {
				if ($video_url !='') { global $wp_embed; echo $wp_embed->run_shortcode('[embed]'.$video_url.'[/embed]'); }
			} else {
				if (has_post_thumbnail()) {
					if ($featured_image_override == 'on' && !empty($featured_image_override_id)) {
						echo wp_get_attachment_image($featured_image_override_id, $image_size);
					} else {
						the_post_thumbnail($image_size);
					}
				}
			}
		?>
		<?php if ($featured_image_credit) { ?>
			<div class="featured_image_credit"><?php echo esc_attr($featured_image_credit); ?></div>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_article_featured_image', 'thb_article_featured_image', 1, 1);
/* Post Navigation */
function thb_post_nav() {
	if (ot_get_option('blog_nav', 'on') == 'off') { return; }
	if (wp_doing_ajax()) { return; }
	$prev_post = get_adjacent_post(false, '', true);
	$next_post = get_adjacent_post(false, '', false);

	if (!empty($prev_post)) {
		?>
		<div class="thb-article-nav previous">
			<?php
				$nav_query = new WP_Query( array('p' => $prev_post->ID) );
				while ($nav_query->have_posts()) : $nav_query->the_post();
					get_template_part('inc/templates/post-styles/misc/post-nav');
				endwhile;
			?>
			<span class="thb-article-nav-text"><?php esc_html_e('Previous Article', 'theissue'); ?></span>
		</div>
		<?php
	}
	if (!empty($next_post)) {
		?>
		<div class="thb-article-nav next">
			<?php
				$nav_query = new WP_Query( array('p' => $next_post->ID) );
				while ($nav_query->have_posts()) : $nav_query->the_post();
					get_template_part('inc/templates/post-styles/misc/post-nav');
				endwhile;
			?>
			<span class="thb-article-nav-text"><?php esc_html_e('Next Article', 'theissue'); ?></span>
		</div>
		<?php
	}
	wp_reset_postdata();
}
add_action( 'thb_after_article', 'thb_post_nav', 99);

function thb_fixed_container() {
	?>
	<div class="thb-fixed-container">
		<div class="thb-fixed-top">
			<?php do_action('thb_article_author_left'); ?>
			<?php do_action('thb_article_fixed_socials'); ?>
		</div>
		<?php do_action('thb_article_read_next'); ?>
	</div>
	<?php
}
// Add Classes based on styles
function thb_post_class( $classes ) {
	if (is_singular('post') || wp_doing_ajax()) {
		global $post;
		$style = ot_get_option('sharing_buttons_top_style', 'style1');
		$classes[] = 'thb-post-share-'.$style;
	}
	return $classes;
}
add_filter( 'post_class', 'thb_post_class' );

// Add Shop the Look
function thb_shopthelook() {
	get_template_part('inc/templates/post-detail-bits/shopthelook');
}
add_action( 'thb_after_article', 'thb_shopthelook', 3 );

// Post pagination
add_filter( 'wp_link_pages_args', 'thb_change_link_page_args', 5 );
function thb_change_link_page_args( $defaults ) {
	$defaults['before'] = '<div class="thb-article-pagination"><span class="pages-text">'.esc_html__( 'Pages:', 'theissue' ).'</span>';
	$defaults['after'] = '</div>';
	return $defaults;
}
add_action('thb_after_article_content', 'wp_link_pages', 0);