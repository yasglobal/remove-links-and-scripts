<?php
/**
 * @package RemoveLinksScripts\Admin
 */

class Remove_Links_Scripts_Admin {
  
	/**
	 * Initializes WordPress hooks.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_filter( 'plugin_action_links_' . REMOVE_LINKS_SCRIPTS_BASENAME,
			array( $this, 'settings_link' ) );
  }

	/**
	 * Add Settings Page in Menu.
	 */
	public function admin_menu() {
		add_menu_page( 'Remove Links and Scripts Settings', 'Remove Links and Scripts',
			'administrator', 'remove-links-scripts-settings',
			array( $this, 'admin_settings_page' )
		);
	}

	/**
	 * Settings Page where user can choose their settings for remove links and scripts.
	 */
	public function admin_settings_page() {
		if ( ! current_user_can( 'administrator' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		if ( isset( $_POST['submit'] ) ) {
			$remove_settings =  array(
				'shortlink'					=>	$_POST['shortlink'],
				'rsd_link'					=>	$_POST['rsd_link'],
				'wlwmanifest_link'	=>	$_POST['wlwmanifest_link'],
				'feed_links'				=>	$_POST['feed_links'],
				'emoji_scripts'			=>	$_POST['emoji_scripts'],
				'wp_embed'					=>	$_POST['wp_embed'],
				'wp_json'						=>	$_POST['wp_json'],
				'emoji_styles'			=>	$_POST['emoji_styles'],
				'generator'					=>	$_POST['generator'],
				'rel_link'					=>	$_POST['rel_link'],
			);
			update_option( 'remove_links_scripts', serialize( $remove_settings ) );
		}
		$remove_settings = unserialize( get_option('remove_links_scripts') );
		$remove_settings_shortlink_checked        = '';
		$remove_settings_rsd_link_checked         = '';
		$remove_settings_wlwmanifest_link_checked = '';
		$remove_settings_feed_links_checked       = '';
		$remove_settings_emoji_scripts_checked    = '';
		$remove_settings_wp_embed_checked         = '';
		$remove_settings_wp_json_checked          = '';
		$remove_settings_emoji_styles_checked     = '';
		$remove_settings_generator_checked        = '';
		$remove_settings_rel_link_checked         = '';

		if ( isset( $remove_settings ) ) {
			if ( esc_attr( $remove_settings['shortlink'] ) == 'on' ) {
				$remove_settings_shortlink_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['rsd_link'] ) == 'on' ) {
				$remove_settings_rsd_link_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['wlwmanifest_link'] ) == 'on' ) {
				$remove_settings_wlwmanifest_link_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['feed_links'] ) == 'on' ) {
				$remove_settings_feed_links_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['emoji_scripts'] ) == 'on' ) {
				$remove_settings_emoji_scripts_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['wp_embed'] ) == 'on' ) {
				$remove_settings_wp_embed_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['wp_json'] ) == 'on' ) {
				$remove_settings_wp_json_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['emoji_styles'] ) == 'on' ) {
				$remove_settings_emoji_styles_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['generator'] ) == 'on' ) {
				$remove_settings_generator_checked = 'checked';
			}

			if ( esc_attr( $remove_settings['rel_link'] ) == 'on' ) {
				$remove_settings_rel_link_checked = 'checked';
			}
		}
		wp_enqueue_style( 'style',
			plugins_url( '/admin/css/admin-style.min.css', REMOVE_LINKS_SCRIPTS_FILE )
		);
		?>
		<div class="wrap">
			<h1><?php _e( 'Remove Links and Scripts Settings', 'remove-links-scripts' ); ?></h1>
			<div><?php _e( 'Change settings to remove unwanted links and scripts from the wordpress.', 'remove-links-scripts' ); ?></div>
			<form enctype="multipart/form-data" action="" method="POST" id="remove-links-scripts">
   
				<table class="remove-links-scripts">
					<caption>Remove Links</caption>
					<tbody>
						<tr>
							<td><input type="checkbox" name="shortlink" value="on" <?php echo $remove_settings_shortlink_checked; ?> /><strong><?php _e( 'Remove Shortlink', 'remove-links-scripts' ); ?></strong></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="rsd_link" value="on" <?php echo $remove_settings_rsd_link_checked; ?> /><strong><?php _e( 'Remove RSD Links', 'remove-links-scripts' ); ?></strong></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="wlwmanifest_link" value="on" <?php echo $remove_settings_wlwmanifest_link_checked; ?> /><strong><?php _e( 'Remove WLW Manifest Links', 'remove-links-scripts' ); ?></strong></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="feed_links" value="on" <?php echo $remove_settings_feed_links_checked; ?> /><strong><?php _e( 'Remove RSS Links', 'remove-links-scripts' ); ?></strong></td>
						</tr>
					</tbody>
				</table>

				<table class="remove-links-scripts">
					<caption>Remove Scripts</caption>
					<tbody>
						<tr>
							<td><input type="checkbox" name="emoji_scripts" value="on" <?php echo $remove_settings_emoji_scripts_checked; ?> /><strong><?php _e( 'Remove Emoji Scripts', 'remove-links-scripts' ); ?></strong></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="wp_embed" value="on" <?php echo $remove_settings_wp_embed_checked; ?> /><strong><?php _e( 'Remove Oembed(json + xml)', 'remove-links-scripts' ); ?></strong></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="wp_json" value="on" <?php echo $remove_settings_wp_json_checked; ?> /><strong><?php _e( 'Remove wp_json', 'remove-links-scripts' ); ?></strong></td>
						</tr>
					</tbody>
				</table>

				<table class="remove-links-scripts">
					<caption>Remove Styles</caption>
					<tbody>
						<tr>
							<td><input type="checkbox" name="emoji_styles" value="on" <?php echo $remove_settings_emoji_styles_checked; ?> /><strong><?php _e( 'Remove Emoji Styles', 'remove-links-scripts' ); ?></strong></td>
						</tr>
					</tbody>
				</table>

				<table class="remove-links-scripts">
					<caption>Remove Meta</caption>
					<tbody>
						<tr>
							<td><input type="checkbox" name="generator" value="on" <?php echo $remove_settings_generator_checked; ?> /><strong><?php _e( 'Remove WordPress Generator Meta', 'remove-links-scripts' ); ?></strong></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="rel_link" value="on" <?php echo $remove_settings_rel_link_checked; ?> /><strong><?php _e( 'Remove Ajacent Relational Links (Next + Prev)', 'remove-links-scripts' ); ?></strong></td>
						</tr>
					</tbody>
				</table>

				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Changes', 'remove-links-scripts' ); ?>" /></p>
			</form>
		</div>
		<?php
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
	}

	/**
	 * Add Rating Message in the footer of Admin Pages of Remove Links and Scripts.
	 */
	public function admin_footer_text() {
		/* translators: %s: five stars */
		$footer_text = sprintf( __( 'If you like <strong>Remove Links and Scripts</strong> please leave us a %s rating. A huge thanks in advance!', 'remove-links-scripts' ), '<a href="https://wordpress.org/support/plugin/remove-links-and-scripts/reviews?rate=5#new-post" title="5 star" target="_blank" data-rated="' . esc_attr__( 'Thanks :)', 'remove-links-scripts' ) . '">&#9733;&#9733;&#9733;&#9733;&#9733;</a>' );
		return $footer_text;
	}

	/**
	 * Plugin Settings Page Link on the Plugin Page under the Plugin Name.
	 */
	public function settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=remove-links-scripts-settings" title="Settings">Settings</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}
}