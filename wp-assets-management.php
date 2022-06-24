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
            add_action('wp_enqueue_scripts', [$this, 'wpam_manage_assets']);
        }

        // manage assets for the plugin
        function wpam_manage_assets()
        {
            // here css and js will go on
        }

        // load text domain
        function wpam_loaded()
        {
            load_plugin_textdomain('wpam', false, plugin_dir_path(__FILE__) . 'languages');
        }
    }
    new Wpam();
}
