<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_site_icon(); ?>
	<?php
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
	<meta property="og:image" content="https://www.smartbusinessdaily.com/wp-content/uploads/2019/01/favicon_new.png" />
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3K5PTE9887"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-3K5PTE9887');
    </script>

</head>
	<meta name="ahrefs-site-verification" content="77667af790002d38f6c1ed8ce662ad7d313b8d8d615ab2cb776e88707b152442">
	<meta name="ahrefs-site-verification" content="77667af790002d38f6c1ed8ce662ad7d313b8d8d615ab2cb776e88707b152442">
<body <?php body_class(); ?>>
<?php do_action('thb_before_wrapper'); ?>
 <!-- Start Wrapper -->
<div id="wrapper" class="thb-page-transition-<?php echo esc_attr(ot_get_option('page_transition', 'on')); ?>">

	<!-- Start Content Click Capture -->
	<div class="click-capture"></div>
	<!-- End Content Click Capture -->

	<?php do_action('thb_mobile_menu'); ?>

	<?php do_action( 'thb_shop_filters' ); ?>

	<?php if (ot_get_option('fixed_header', 'on') == 'on' && !thb_is_mobile()) { ?>
	<!-- Start Fixed Header -->
	<?php
		if (ot_get_option('header_style', 'style1') == 'style4') {
			$fixed = 'fixed-style2';
		} else {
			$fixed = 'fixed-style1';
		}
		if (is_singular('post')) {
			$fixed = 'fixed-article';
		}
		get_template_part( 'inc/templates/header/'.$fixed);
	?>
	<!-- End Fixed Header -->
	<?php } ?>

	<?php do_action('thb_before_header'); ?>
	<?php get_template_part( 'inc/templates/header/mobile-style1'); ?>
	<?php if (!thb_is_mobile()) { ?>
		<!-- Start Header -->
		<?php get_template_part( 'inc/templates/header/'.ot_get_option('header_style', 'style1')); ?>
		<!-- End Header -->
	<?php } ?>
	<?php do_action('thb_before_main'); ?>
	<div role="main">
