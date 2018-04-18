<?php
/**
 * Plugin Name: Remove Links and Scripts
 * Plugin URI: https://wordpress.org/plugins/remove-links-and-scripts/
 * Description: Remove unwanted links and scripts from wordpress header.
 * Version: 0.2.4
 * Author: YAS Global Team
 * Author URI: https://www.yasglobal.com/web-design-development/wordpress/remove-links-scripts/
 * Donate link: https://www.paypal.me/yasglobal
 * License: GPLv3
 *
 * Text Domain: remove-links-and-scripts
 * Domain Path: /languages/
 *
 * @package RemoveLinksScripts
 */

/**
 *  Remove Links and Scripts - Remove extra links and scripts from WordPress
 *  Copyright (C) 2016-2018, Sami Ahmed Siddiqui <sami.siddiqui@yasglobal.com>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.

 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.

 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Make sure we don't expose any info if called directly
if ( ! defined( 'ABSPATH' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

class Remove_Links_Scripts {

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->setup_constants();
    $this->includes();

    add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
  }

  /**
   * Setup plugin constants
   *
   * @access private
   * @since 0.3
   * @return void
   */
  private function setup_constants() {
    if ( ! defined( 'REMOVE_LINKS_SCRIPTS_FILE' ) ) {
      define( 'REMOVE_LINKS_SCRIPTS_FILE', __FILE__ );
    }

    if ( ! defined( 'REMOVE_LINKS_SCRIPTS_PLUGIN_VERSION' ) ) {
      define( 'REMOVE_LINKS_SCRIPTS_PLUGIN_VERSION', '0.2.4' );
    }

    if ( ! defined( 'REMOVE_LINKS_SCRIPTS_PATH' ) ) {
      define( 'REMOVE_LINKS_SCRIPTS_PATH', plugin_dir_path( REMOVE_LINKS_SCRIPTS_FILE ) );
    }

    if ( ! defined( 'REMOVE_LINKS_SCRIPTS_BASENAME' ) ) {
      define( 'REMOVE_LINKS_SCRIPTS_BASENAME', plugin_basename( REMOVE_LINKS_SCRIPTS_FILE ) );
    }
  }

  /**
   * Include required files
   *
   * @access private
   * @since 0.3
   * @return void
   */
  private function includes() {
    require_once(
      REMOVE_LINKS_SCRIPTS_PATH . 'frontend/class-remove-links-scripts-frontend.php'
    );
    new Remove_Links_Scripts_Frontend();

    if ( is_admin() ) {
      require_once(
        REMOVE_LINKS_SCRIPTS_PATH . 'admin/class-remove-links-scripts-admin.php'
      );
      new Remove_Links_Scripts_Admin();

      register_uninstall_hook(
        REMOVE_LINKS_SCRIPTS_FILE, 'remove_links_scripts_plugin_uninstall'
      );
    }
  }

  /**
   * Loads the plugin language files
   *
   * @access public
   * @since 0.3
   * @return void
   */
  public function load_textdomain() {
    load_plugin_textdomain( 'remove-links-scripts', FALSE,
      basename( dirname( REMOVE_LINKS_SCRIPTS_FILE ) ) . '/languages/'
    );
  }
}

new Remove_Links_Scripts();
