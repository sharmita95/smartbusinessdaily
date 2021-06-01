	</div> <!-- End Main -->
	<?php do_action('thb_after_main'); ?>
	<?php
		if (ot_get_option('footer', 'on') == 'on') {
			get_template_part( 'inc/templates/footer/footer-style1');
		}
	?>
	<?php
		if (ot_get_option('subfooter', 'on') == 'on') {
			get_template_part( 'inc/templates/footer/subfooter-'.ot_get_option('subfooter_style', 'style1'));
		}
	?>
	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */
		 wp_footer();
	?>
</div> <!-- End Wrapper -->
<?php do_action('thb_after_wrapper'); ?>

<script>
    let images = document.getElementsByTagName("img");
    for (var i = 0; i < images.length; i++) addAlt(images[i]);
    
    //adds alt value from file name
    function addAlt(el) {
      if (el.getAttribute("alt")) return;
    
      url = el.src;
      let filename = url.substring(url.lastIndexOf("/") + 1);
      filename = filename
        .split(".")
        .slice(0, -1)
        .join(".");
    
      el.setAttribute("alt", filename);
      //console.log("added alt: " + filename);
    }
</script>

</body>
</html>