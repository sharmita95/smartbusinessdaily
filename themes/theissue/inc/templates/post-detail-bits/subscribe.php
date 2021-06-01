<?php if ( !class_exists('TheIssue_plugin') ) { return; } ?>
<aside class="thb-article-subscribe thb-newsletter-form">
  <div class="thb-subscribe-icon-container"><?php get_template_part('assets/img/svg/subscribe.svg'); ?></div>
  <h4><?php esc_html_e('Sign Up to Our Newsletter', 'theissue'); ?></h4>
 	<p><?php esc_html_e('Get notified about exclusive offers every week!', 'theissue'); ?></p>
	<form class="newsletter-form" action="#" method="post">
		<input placeholder="<?php esc_attr_e("Your E-Mail",'theissue'); ?>" type="text" name="widget_subscribe" class="widget_subscribe large">
		<button type="submit" name="submit" class="btn large"><?php esc_html_e("SIGN UP",'theissue'); ?></button>
    <?php do_action('thb_after_newsletter_submit'); ?>
	</form>
  <?php do_action('thb_after_newsletter_form'); ?>
</aside>