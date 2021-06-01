<?php
/*  Copyright 2018  Fuel Themes */

class thbShares {
	/**
	 * A dummy magic method to prevent thb_Shares from being loaded more than once.
	 * @since thb_Shares (1.0.0)
	 */
	private function __construct() { }

	/**
	 * A dummy magic method to prevent thb_Shares from being cloned.
	 * @since thb_Shares (1.0.0)
	 */
	public function __clone() { _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'theissue' ), '1.7' ); }

	/**
	 * A dummy magic method to prevent thb_Shares from being unserialized.
	 * @since thb_Shares (1.0.0)
	 */
	public function __wakeup() { _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'theissue' ), '1.7' ); }

	/**
	 * Magic method to prevent notices and errors from invalid method calls.
	 * @since thb_Shares (1.0.0)
	 */
	public function __call( $name = '', $args = array() ) { unset( $name, $args ); return null; }

	/**
	 * Main plugin constructor
	 * @return object instance
	 * @since  thb_Shares (1.0.0)
	 */
	public static function instance() {
		static $instance = null;

		// Only run these methods if they haven't been run previously
		if ( null === $instance ) {
			$instance = new thbShares;
			$instance->init();
		}

		// Always return the instance
		return $instance;
	}

	/**
	 * Initialize the plugin
	 * @return void
	 * @since  thb_Shares (1.0.0)
	 */
	public function init() {
		require_once('social-share-functions.php');

		add_action( 'post_submitbox_misc_actions', array( $this, 'admin_edit_shares' ) );
	}

	public function admin_edit_shares() {
		if ( empty( $_GET['post'] ) )
			return;

		if ('publish' === get_post_status( get_the_ID())) {
		?>
		<div class="misc-pub-section curshares misc-pub-curshares">
			<span id="timesshared">
				<span class="dashicons dashicons-share" style="color: #888;"></span> <?php esc_html_e( 'Total Shares', 'theissue' ); ?>: <b><?php echo get_post_meta( $_GET['post'], 'thb_all_counts', true ); ?></b>
			</span>
		</div>
		<?php
		}
	}
}
/**
 * Main function responsible for returning the instance
 * @return thb_Shares
 */
function thb_shares() {
	return thbShares::instance();
}
//Enjoy!
thb_shares();