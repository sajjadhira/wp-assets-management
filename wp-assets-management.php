<?php
/*
Plugin Name: WP Aseets Management
Plugin URI: http://pluginoo.com/wpassetsmanagement
Description: This is a WordPress Plugin asset management boilerplate thats manage CSS JS Enqueue Plugin Easily
Author: Pluginoo
Author URI: http://pluginoo.com
Text Domain: wpam
Version: 1.0.0
*/
defined('ABSPATH') or die('Direct access forbidden!');

define('wpam_plugin_directory_path', plugin_dir_url(__FILE__));
define('wpam_public_assets', wpam_plugin_directory_path . 'assets/public/');
define('wpam_admin_assets', wpam_plugin_directory_path . 'assets/admin/');
define('wpam_version', time());

if (!class_exists('Wpam')) {

    class Wpam
    {

        // constructor for the class
        function __construct()
        {
            add_action('plugins_loaded', [$this, 'wpam_loaded']);
            add_action('init', [$this, 'wpam_init']);
        }

        // initial components
        function wpam_init()
        {
            // here init option will go on
            add_action('admin_enqueue_scripts', [$this, 'wpam_manage_admin_assets']);
        }

        // manage assets for the plugin
        function wpam_manage_admin_assets()
        {
            // here css and js will go on


            // get screen
            $screen = get_current_screen();

            // get curren user
            $current_user = wp_get_current_user();

            // access granted to only plugins page
            if ('plugins' != $screen->base && '' == $screen->post_type) {
                return false;
            }
            // enque scripts

            $scripts = [
                'wpam-main' => ['path' => wpam_admin_assets . 'js/main.js', 'dependencies' => ['jquery']],
            ];

            foreach ($scripts as $handler => $script) {
                // now enqueue the scrips 
                wp_enqueue_script($handler, $script['path'], $script['dependencies'], wpam_version, true);
            }


            // localizing script and sending our PHP data to javascript by object
            $wpam_message = [
                'message' => 'Hi ' . $current_user->display_name . ' we are now in ' . $screen->base . ' page!',
            ];
            wp_localize_script('wpam-main', 'wpam', $wpam_message);
        }

        // load text domain
        function wpam_loaded()
        {
            load_plugin_textdomain('wpam', false, plugin_dir_path(__FILE__) . 'languages');
        }
    }
    new Wpam();
}
