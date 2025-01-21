<?php
/**
 * Parks
 *
 * @package           Parks
 * @author            Ajith Thampi Joseph
 * @copyright         2025 Ajith Thampi Joseph
 * @license           GPL v2 or later
 *
 * @wordpress-plugin
 * Plugin Name:       Parks
 * Plugin URI:        https://github.com/atj4me/parks
 * Description:       A simple WordPress plugin that registers a custom post type, implement a custom taxonomy, and includes a short code to display and filter a list of those posts.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ajith Thampi Joseph
 * Author URI:        https://github.com/atj4me
 * Text Domain:       parks-plugin // Changed from plugin-slug to match plugin name
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/atj4me/parks-plugin
 */

if (!defined('WPINC')) {
    die;
}

define('PARKS_PLUGIN_VERSION', '1.0.0');
define('PARKS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PARKS_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Includes the functions.php file from the includes directory of the parks plugin.
 * 
 * This file contains various helper functions used throughout the parks plugin.
 * 
 * @see includes/functions.php
 */
require_once PARKS_PLUGIN_PATH . 'includes/functions.php';

/**
 * Includes the parks custom post type configuration.
 * 
 * This line of code includes the 'parks.php' file located in the 'includes' directory
 * of the PARKS_PLUGIN_PATH. The 'parks.php' file contains the general configuration of the custom post type
 * 
 * @see PARKS_PLUGIN_PATH
 */
require_once PARKS_PLUGIN_PATH . 'includes/parks.php';

/**
 * Includes the facilities taxonomy file.
 * 
 * This file contains configuration and functions related to the 'facilities' taxonomy
 * for the parks plugin. 
 * 
 * @since 1.0.0
 * @uses PARKS_PLUGIN_PATH WordPress plugin directory path constant
 */
require_once PARKS_PLUGIN_PATH . 'includes/facilities.php';

/**
 * Include the parks fields configuration file
 * 
 * This file contains the field definitions and settings for the parks plugin
 * The path is relative to the plugin's root directory using the PARKS_PLUGIN_PATH constant
 * 
 * @since 1.0.0
 */
require_once PARKS_PLUGIN_PATH . 'includes/fields.php';

/**
 * Include the parks short code file
 *
 * This file contains the short code function [park-list] for the parks plugin
 * The path is relative to the plugin's root directory using the PARKS_PLUGIN_PATH constant
 *
 * @since 1.0.0
 */
require_once PARKS_PLUGIN_PATH . 'includes/park_list.php';

/**
 * Includes the parks template file.
 * This file contains template functions for displaying park-related content.
 * The path is relative to the plugin's root directory.
 * 
 * @uses PARKS_PLUGIN_PATH Constant defining the root path of the parks plugin
 */
require_once PARKS_PLUGIN_PATH . 'includes/parks-template.php';

/**
 * Registers the activation hook for the Parks Plugin.
 *
 * This function will be called when the plugin is activated.
 *
 * @param string $file The path to the main plugin file.
 * @param callable $function The function to be called when the plugin is activated.
 */
register_activation_hook(__FILE__, 'parks_activate');

/**
 * Registers the deactivation hook for the Parks Plugin.
 *
 * This function registers the 'parks_deactivate' function to be called
 * when the plugin is deactivated. The deactivation hook is used to perform
 * cleanup tasks when the plugin is deactivated.
 *
 * @see https://developer.wordpress.org/reference/functions/register_deactivation_hook/
 *
 * @param string $__FILE__ The path to the main plugin file.
 * @param string 'parks_deactivate' The name of the function to be called on plugin deactivation.
 */
register_deactivation_hook(__FILE__, 'parks_deactivate');

/**
 * Registers the uninstall hook for the Parks Plugin.
 *
 * This hook will be triggered when the plugin is uninstalled, allowing
 * the `parks_uninstall` function to run and perform any necessary
 * cleanup tasks.
 *
 * @see parks_uninstall()
 */
register_uninstall_hook(__FILE__, 'parks_uninstall');

/**
 * Registers the 'parks' custom post type.
 *
 * This function is hooked into the 'init' action and is used to register
 * a custom post type called 'parks' for the plugin.
 *
 * @return void
 */
add_action('init', 'register_parks_post_type');

/**
 * Registers the 'facilities' custom taxonomy.
 *
 * This function hooks into the 'init' action to register a custom taxonomy
 * called 'facilities' for use with custom post types or other purposes.
 *
 * @return void
 */
add_action('init', 'register_facilities_taxonomy');

/**
 * Hook into the 'init' action to register the 'park_list' shortcode.
 *
 * This function will be called during the WordPress initialization phase
 * to register a custom shortcode that can be used to display a list of parks.
 *
 * @see https://developer.wordpress.org/reference/hooks/init/
 */
add_action('init', 'register_park_list_shortcode');

/**
 * Enqueues the styles for the Parks plugin.
 *
 * This function hooks into the 'wp_enqueue_scripts' action to load the necessary stylesheets
 * for the Parks plugin.
 *
 * @hook wp_enqueue_scripts
 */
add_action('wp_enqueue_scripts', 'parks_enqueue_styles');

/**
 * Hook into the 'admin_init' action to add custom meta boxes for parks.
 *
 * This function is called during the WordPress admin initialization process.
 * It registers custom meta boxes for the parks plugin.
 *
 * @see https://developer.wordpress.org/reference/hooks/admin_init/
 */
add_action('admin_init', 'add_park_meta_boxes');

/**
 * Hook into the 'save_post_parks' action to save custom meta data for parks.
 *
 * This function is triggered whenever a post of type 'parks' is saved.
 *
 * @param int $post_id The ID of the post being saved.
 */
add_action('save_post_parks', 'save_park_meta_data');

/**
 * Hooks a function to the 'admin_footer' action.
 *
 * This function will be called when the admin footer is rendered.
 *
 * @see https://developer.wordpress.org/reference/hooks/admin_footer/
 */
add_action('admin_footer', 'add_post_script');

/**
 * Registers a shortcode [park_list] that triggers the display_parks_list function.
 *
 * Shortcodes are a simple way to add custom content to WordPress posts and pages.
 * This shortcode can be used to display a list of parks.
 *
 * Usage: [park_list]
 *
 * @see display_parks_list()
 */
add_shortcode('park_list', 'display_parks_list');
/**
 * Filters the single template to load a custom template for parks.
 *
 * This function hooks into the 'single_template' filter to load a custom template
 * for displaying single park posts.
 *
 * @param string $single_template The path to the single template.
 * @return string The path to the custom single template for parks.
 */

add_filter( 'single_template', 'load_parks_template' );
