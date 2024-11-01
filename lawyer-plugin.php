<?php
/*
Plugin Name: Lawyer Theme Plugin
Plugin URI: https://themeforest.net/user/ThemeMakers
Author: ThemeMakers
Author URI: https://themeforest.net/user/ThemeMakers
Version: 1.1.2
Description: Includes Portfolio Custom Post Types and Visual Composer Shortcodes
Text Domain: lawyer-plugin
*/

// add in constant name path
defined('EF_ROOT') or define('EF_ROOT', dirname(__FILE__));
defined('EF_URI') or define('EF_URI',  plugin_dir_url(__FILE__));
defined('T_URI') or define('T_URI',   get_template_directory_uri());
defined('T_PATH') or define('T_PATH',  get_template_directory());

include_once ABSPATH . 'wp-includes/pluggable.php';

// Custom post types Integration.
require_once EF_ROOT . '/post-types/inc.php';

// Custom widgets Integration.
require_once EF_ROOT . '/widgets/inc.php';

// Theme options and metaboxes.
require_once EF_ROOT . '/options/cs-framework.php';

// Add file with helper functions for plugin.
require_once EF_ROOT . '/helper-functions.php';

// Style builder include.
require_once EF_ROOT . '/style-builder.php';


if (! class_exists('Lawyer_Plugin')) {

	class Lawyer_Plugin
	{

		public function __construct()
		{

			include_once(ABSPATH . 'wp-admin/includes/plugin.php');

			if (is_plugin_active('js_composer/js_composer.php') && file_exists(WP_PLUGIN_DIR . '/js_composer/js_composer.php')) {

				require_once(WP_PLUGIN_DIR . '/js_composer/js_composer.php');

				add_action('admin_init', array($this, 'lawyer_plugin_init'));
				add_action('wp', array($this, 'lawyer_plugin_init'));
			}
		}

		//include custom map 
		public function lawyer_plugin_init()
		{

			require_once(EF_ROOT . '/shortcodes/init.php');

			foreach (glob(EF_ROOT . '/shortcodes/lawyer_*.php') as $shortcode) {
				require_once(EF_ROOT . '/shortcodes/' . basename($shortcode));
			}
		}
	} // end of class

	new Lawyer_Plugin;
} // end of class_exists