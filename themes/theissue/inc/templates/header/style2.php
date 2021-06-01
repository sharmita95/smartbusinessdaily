<?php

  $header_class[] = 'header style2';
  $header_class[] = 'thb-main-header';
  $header_class[] = ot_get_option('header_color', 'light-header');
?>
<header class="<?php echo esc_attr(implode(' ', $header_class)); ?>">
  <div class="row">
    <div class="small-4 columns">
      <?php do_action( 'thb_mobile_toggle' ); ?>
    </div>
		<div class="small-4 columns">
      <?php do_action( 'thb_logo' ); ?>
    </div>
    <div class="small-4 columns">
      <?php do_action( 'thb_secondary_area' ); ?>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns">
      <div class="thb-navbar">
        <?php get_template_part( 'inc/templates/header/full-menu' ); ?>
      </div>
    </div>
  </div>
</header>
