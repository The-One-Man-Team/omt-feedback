<?php
/**
 *
 * @package           OMT_Feedback
 * @author            One Man Team
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       OMT Feedback
 * Plugin URI:        https://theonemanteam.com/omt-feedback/
 * Description:       Feedback plugin. Can be integrated into a page using a shortcode or for post types
 * Author:            One Man Team
 * Author URI:        https://theonemanteam.com/
 * Text Domain:       omt-feedback
 * Domain Path:       /languages
 * Version:           0.1.0 Beta
 * Requires at least: 5.0
 * Requires PHP:      7.4
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('ABSPATH')) {
	exit; // Don't access directly.
};


if (defined('OMT_FEEDBACK_VERSION')) {
	// The user is attempting to activate a second plugin instance.
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	require_once ABSPATH . 'wp-includes/pluggable.php';
	if (is_plugin_active(plugin_basename(__FILE__))) {
		deactivate_plugins(plugin_basename(__FILE__)); // Deactivate this plugin.
		// Inform that the plugin is deactivated.
		wp_safe_redirect(add_query_arg('deactivate', 'true', remove_query_arg('activate')));
		exit;
	}
}

define('OMT_FEEDBACK_VERSION', '0.1.0');

define('OMT_FEEDBACK_REQUIRED_WP_VERSION', '5.0');

define('OMT_FEEDBACK_REQUIRED_PHP_VERSION', '7.2');

define('OMT_FEEDBACK_PLUGIN', __FILE__);

define('OMT_FEEDBACK_PLUGIN_BASENAME', plugin_basename(ADS_PLUGIN));

define('OMT_FEEDBACK_PLUGIN_NAME', trim(dirname(ADS_PLUGIN_BASENAME), '/'));

define('OMT_FEEDBACK_PLUGIN_DIR', untrailingslashit(dirname(ADS_PLUGIN)));

define('OMT_FEEDBACK_PLUGIN_URL', plugin_dir_url(__FILE__));

// Check for required PHP version
if (version_compare(PHP_VERSION, OMT_FEEDBACK_REQUIRED_PHP_VERSION, '<')) {
	exit(esc_html(sprintf('OMT Feedback for WordPress requires PHP 7.2 or higher. You’re still on %s.', PHP_VERSION)));
}

// Check for required Wordpress version
if (version_compare(get_bloginfo('version'), OMT_FEEDBACK_REQUIRED_WP_VERSION, '<')) {
	exit(esc_html(sprintf('OMT Feedback for WordPress requires Wordpress 5.0 or higher. You’re still on %s.', get_bloginfo('version'))));
}

// Load Composer Autoload file
if (file_exists(ADS_PLUGIN_DIR . '/vendor/autoload.php')) {
	require_once ADS_PLUGIN_DIR . '/vendor/autoload.php';
}

// Run plugin
if (class_exists('Tomt\\Init')) {
	new Tomt\Init();
}
