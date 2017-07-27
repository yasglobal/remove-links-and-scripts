<?php

/**
 * @package RemoveLinksScripts\Main
 */

// Make sure we don't expose any info if called directly
if ( !defined('ABSPATH') ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

if ( !function_exists("add_action") || !function_exists("add_filter") ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

define('REMOVE_LINKS_SCRIPTS_PLUGIN_VERSION', '0.2');

if ( !defined('REMOVE_LINKS_SCRIPTS_PATH') ) {
	define('REMOVE_LINKS_SCRIPTS_PATH', plugin_dir_path( __FILE__ ));
}

require_once(REMOVE_LINKS_SCRIPTS_PATH.'frontend/class.remove-links-scripts-frontend.php');	
	 
$remove_links_scripts_frontend = new Remove_Links_Scripts_Frontend();
$remove_links_scripts_frontend->init();

if ( is_admin() ) {
	require_once(REMOVE_LINKS_SCRIPTS_PATH.'admin/class.remove-links-scripts-admin.php');
	new Remove_Links_Scripts_Admin();

	$plugin = plugin_basename( REMOVE_LINKS_SCRIPTS_FILE );
  add_filter( "plugin_action_links_$plugin", 'remove_links_scripts_settings_link' );
}

/**
 * Plugin Settings Page Link on the Plugin Page under the Plugin Name
 */
 function remove_links_scripts_settings_link($links) { 
	$settings_link = '<a href="admin.php?page=remove-links-scripts-settings">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
