<?php
/*
Plugin Name: WP Enqueue Deferred Style
Plugin URI:
Description: Defer CSS to the footer.
Author: Kyle Reicks
Version: 0.1.0
Author URI: http://github.com/kylereicks/
*/

define('WP_ENQUEUE_DEFERRED_STYLE_PATH', plugin_dir_path(__FILE__));
define('WP_ENQUEUE_DEFERRED_STYLE_URL', plugins_url('/', __FILE__));
define('WP_ENQUEUE_DEFERRED_STYLE_VERSION', '0.1.0');

require_once(WP_ENQUEUE_DEFERRED_STYLE_PATH . 'inc/class-wp-enqueue-deferred-style.php');
require_once(WP_ENQUEUE_DEFERRED_STYLE_PATH . 'inc/functions-wp-enqueue-deferred-style.php');

register_deactivation_hook(__FILE__, array('WP_Enqueue_Deferred_Style', 'deactivate'));

add_action('plugins_loaded', array('WP_Enqueue_Deferred_Style', 'get_instance'));
