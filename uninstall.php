<?php
/**
 * RemoveLinksScripts Uninstall
 *
 * Remove Option on uninstalling/deleting the Plugin.
 *
 * @package RemoveLinksScripts/Uninstaller
 * @since 0.3
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}

delete_option( 'remove_links_scripts' );

// Clear any cached data that has been removed
wp_cache_flush();
