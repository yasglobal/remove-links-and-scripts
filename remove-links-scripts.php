<?php

/**
 * Plugin Name: Remove Links and Scripts
 * Version: 0.1
 * Plugin URI: https://wordpress.org/plugins/remove-links-and-scripts/
 * Description: Remove unwanted links and scripts from wordpress header.
 * Donate link: https://www.paypal.me/yasglobal
 * Author: Sami Ahmed Siddiqui
 * Author URI: http://www.yasglobal.com/web-design-development/wordpress/remove-links-scripts/
 * Text Domain: remove-links-scripts
 * License: GPL v3
 */

/**
 *  Remove Links and Scripts Plugin
 *  Copyright (C) 2016, Sami Ahmed Siddiqui <sami@samisiddiqui.com>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.

 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.

 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function remove_links_scripts_settings_link($links) { 
   $settings_link = '<a href="admin.php?page=remove-links-scripts-settings">Settings</a>'; 
   array_unshift($links, $settings_link); 
   return $links; 
}

function remove_links_scripts_menu() {
	add_menu_page('Remove Links and Scripts Settings', 'Remove Links and Scripts', 'administrator', 'remove-links-scripts-settings', 'remove_links_scripts_settings_page');
}

function remove_links_scripts_settings_page() {
	if ( !current_user_can( 'administrator' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
   if (isset($_POST['submit'])){
      $remove_settings =  array(
                     'shortlink'             =>    $_POST['shortlink'],
                     'rsd_link'              =>    $_POST['rsd_link'],
                     'wlwmanifest_link'      =>    $_POST['wlwmanifest_link'],
                     'feed_links'            =>    $_POST['feed_links'],
                     'emoji_scripts'         =>    $_POST['emoji_scripts'],
                     'wp_embed'              =>    $_POST['wp_embed'],
                     'wp_json'               =>    $_POST['wp_json'],
                     'emoji_styles'          =>    $_POST['emoji_styles'],
                     'generator'             =>    $_POST['generator'],
                     'rel_link'              =>    $_POST['rel_link'],
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
   if( isset($remove_settings) ){
      if( esc_attr( $remove_settings['shortlink'] ) == 'on' ){
         $remove_settings_shortlink_checked = 'checked';
      }
      if( esc_attr( $remove_settings['rsd_link'] ) == 'on' ){
         $remove_settings_rsd_link_checked = 'checked';
      }
      if( esc_attr( $remove_settings['wlwmanifest_link'] ) == 'on' ){
         $remove_settings_wlwmanifest_link_checked = 'checked';
      }
      if( esc_attr( $remove_settings['feed_links'] ) == 'on' ){
         $remove_settings_feed_links_checked = 'checked';
      }
      if( esc_attr( $remove_settings['emoji_scripts'] ) == 'on' ){
         $remove_settings_emoji_scripts_checked = 'checked';
      }
      if( esc_attr( $remove_settings['wp_embed'] ) == 'on' ){
         $remove_settings_wp_embed_checked = 'checked';
      }
      if( esc_attr( $remove_settings['wp_json'] ) == 'on' ){
         $remove_settings_wp_json_checked = 'checked';
      }
      if( esc_attr( $remove_settings['emoji_styles'] ) == 'on' ){
         $remove_settings_emoji_styles_checked = 'checked';
      }
      if( esc_attr( $remove_settings['generator'] ) == 'on' ){
         $remove_settings_generator_checked = 'checked';
      }
      if( esc_attr( $remove_settings['rel_link'] ) == 'on' ){
         $remove_settings_rel_link_checked = 'checked';
      }
   }
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

function remove_links_scripts(){
   $remove_settings = unserialize( get_option('remove_links_scripts') );

   if( esc_attr( $remove_settings['shortlink'] ) == 'on' ){
      remove_action('wp_head', 'wp_shortlink_wp_head');
      remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
   }
   if( esc_attr( $remove_settings['rsd_link'] ) == 'on' ){
      remove_action( 'wp_head', 'rsd_link' );
   }
   if( esc_attr( $remove_settings['wlwmanifest_link'] ) == 'on' ){
      remove_action( 'wp_head', 'wlwmanifest_link' );
   }
   if( esc_attr( $remove_settings['feed_links'] ) == 'on' ){
      remove_action( 'wp_head', 'feed_links', 2 );
      remove_action('wp_head','feed_links_extra', 3);
   }
   if( esc_attr( $remove_settings['emoji_scripts'] ) == 'on' ){
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
   }
   if( esc_attr( $remove_settings['wp_embed'] ) == 'on' ){
      remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
      add_action( 'wp_footer', 'remove_links_scripts_deregister' );
   }
   if( esc_attr( $remove_settings['emoji_styles'] ) == 'on' ){
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
   }
   if( esc_attr( $remove_settings['wp_json'] ) == 'on' ){
      remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
   }
   if( esc_attr( $remove_settings['generator'] ) == 'on' ){
      remove_action('wp_head', 'wp_generator');
   }
   if( esc_attr( $remove_settings['rel_link'] ) == 'on' ){
      remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
   }
}

function remove_links_scripts_attachment() {
   wp_register_style( 'style', plugins_url('/style.css', __FILE__) );
   wp_enqueue_style( 'style' );
}

function remove_links_scripts_deregister(){
   wp_deregister_script( 'wp-embed' );
}

if (function_exists("add_action") && function_exists("add_filter")) {
   add_filter( 'init', 'remove_links_scripts');
   $plugin = plugin_basename(__FILE__); 
   add_filter( "plugin_action_links_$plugin", 'remove_links_scripts_settings_link' );

   add_action( 'admin_menu', 'remove_links_scripts_menu' );   
   if ( isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] == 'remove-links-scripts-settings') {
      add_action('admin_print_styles', 'remove_links_scripts_attachment');
   }
}
