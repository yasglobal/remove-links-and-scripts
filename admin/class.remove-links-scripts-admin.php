<?php

/**
 * @package RemoveLinksScripts\Admin
 */

class Remove_Links_Scripts_Admin {
  
	/**
	 * Initializes WordPress hooks
	 */
	function __construct() {
		add_action( 'admin_menu', array($this, 'remove_links_scripts_menu') );
  }

	/**
	 * Add Settings Page in Menu
	 */
	function remove_links_scripts_menu() {
		add_menu_page('Remove Links and Scripts Settings', 'Remove Links and Scripts', 'administrator', 'remove-links-scripts-settings', array($this, 'remove_links_scripts_settings_page'));
	}

	/**
	 * Settings Page where user can choose their settings for remove links and scripts
	 */
	public function remove_links_scripts_settings_page() {
		if ( !current_user_can( 'administrator' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		if (isset($_POST['submit'])) {
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
			update_option('remove_links_scripts', serialize( $remove_settings ) );
		}
		$remove_settings = unserialize( get_option('remove_links_scripts') );
		$remove_settings_shortlink_checked = '';
		$remove_settings_rsd_link_checked = '';
		$remove_settings_wlwmanifest_link_checked = '';
		$remove_settings_feed_links_checked = '';
		$remove_settings_emoji_scripts_checked = '';
		$remove_settings_wp_embed_checked = '';
		$remove_settings_wp_json_checked = '';
		$remove_settings_emoji_styles_checked = '';
		$remove_settings_generator_checked = '';
		$remove_settings_rel_link_checked = '';

		if ( isset($remove_settings) ) {
			
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
		wp_enqueue_style( 'style', plugins_url('../css/admin-style.min.css', __FILE__) );

		echo '<div class="wrap">';
		echo '<h2>Remove Links and Scripts Settings</h2>';
		echo '<div>Change settings to remove unwanted links and scripts from the wordpress.</div>';
		echo '<form enctype="multipart/form-data" action="" method="POST" id="remove-links-scripts">';
		?>
   
		<table class="remove-links-scripts">
			<caption>Remove Links</caption>
			<tbody>
				<tr>
					<td><input type="checkbox" name="shortlink" value="on" <?php echo $remove_settings_shortlink_checked; ?> /><strong>Remove Shortlink</strong></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="rsd_link" value="on" <?php echo $remove_settings_rsd_link_checked; ?> /><strong>Remove RSD Links</strong></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="wlwmanifest_link" value="on" <?php echo $remove_settings_wlwmanifest_link_checked; ?> /><strong>Remove WLW Manifest Links</strong></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="feed_links" value="on" <?php echo $remove_settings_feed_links_checked; ?> /><strong>Remove RSS Links</strong></td>
				</tr>
			</tbody>
		</table>

		<table class="remove-links-scripts">
			<caption>Remove Scripts</caption>
			<tbody>
				<tr>
					<td><input type="checkbox" name="emoji_scripts" value="on" <?php echo $remove_settings_emoji_scripts_checked; ?> /><strong>Remove Emoji Scripts</strong></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="wp_embed" value="on" <?php echo $remove_settings_wp_embed_checked; ?> /><strong>Remove Oembed(json + xml)</strong></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="wp_json" value="on" <?php echo $remove_settings_wp_json_checked; ?> /><strong>Remove wp_json</strong></td>
				</tr>
			</tbody>
		</table>

		<table class="remove-links-scripts">
			<caption>Remove Styles</caption>
			<tbody>
				<tr>
					<td><input type="checkbox" name="emoji_styles" value="on" <?php echo $remove_settings_emoji_styles_checked; ?> /><strong>Remove Emoji Styles</strong></td>
				</tr>
			</tbody>
		</table>

		<table class="remove-links-scripts">
			<caption>Remove Meta</caption>
			<tbody>
				<tr>
					<td><input type="checkbox" name="generator" value="on" <?php echo $remove_settings_generator_checked; ?> /><strong>Remove WordPress Generator Meta</strong></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="rel_link" value="on" <?php echo $remove_settings_rel_link_checked; ?> /><strong>Remove Ajacent Relational Links (Next + Prev)</strong></td>
				</tr>
			</tbody>
		</table>

		<?php
		submit_button(); 
		echo '</form>';
		echo '</div>';
	}

}
