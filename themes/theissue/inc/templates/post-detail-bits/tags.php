<?php
	$posttags = get_the_tags();
	if (ot_get_option('article_tags', 'on') == 'off') { return; }
?>
<?php if (!empty($posttags)) { ?>
<div class="thb-article-tags">
	<span><?php esc_html_e('Tags', 'theissue'); ?></span>
	<div>
		<?php
			if ($posttags) {
				$return = '';
				foreach($posttags as $tag) { ?>
					<a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" title="<?php echo esc_attr(get_tag_link($tag->name)); ?>"><?php echo esc_html($tag->name); ?></a>
				<?php }
			}
		?>
	</div>
</div>
<?php } ?>