<?php
/**
 * Launches the Filter by Category plugin.
 *
 * @package     KnowTheCode\FilterByCategory
 * @author      hellofromTonya
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Filter by Category
 * Plugin URI:  https://github.com/hellofromtonya/filterby-category
 * Description: Filter by Category - an example plugin of how to leverage AJAX for filtering posts by category.
 * Version:     1.0.0
 * Author:      hellofromtonya
 * Author URI:  https://KnowTheCode.io
 * Text Domain: filterby-cat
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace KnowTheCode\FilterByCategory;

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

/**
 * Checks if this plugin is in development mode.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function _is_in_development_mode() {
	return defined( WP_DEBUG ) && WP_DEBUG === true;
}

/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	require __DIR__ . '/src/plugin.php';
}

launch();
