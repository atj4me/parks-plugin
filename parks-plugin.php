<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('PARKS_PLUGIN_VERSION', '1.0.0');
define('PARKS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PARKS_PLUGIN_URL', plugin_dir_url(__FILE__));


/**
 * Parks Plugin
 *
 * @package           Parks
 * @author            Ajith Thampi Joseph
 * @copyright         2025 Ajith Thampi Joseph
 * @license           GPL v2 or later
 *
 * @wordpress-plugin
 * Plugin Name:       Parks Plugin
 * Plugin URI:        https://github.com/atj4me/parks-plugin
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

//Include the main functions
require_once PARKS_PLUGIN_PATH . 'includes/functions.php';

// Include the main plugin post-type
require_once PARKS_PLUGIN_PATH . 'includes/parks.php';

// Include the main plugin taxonomy
require_once PARKS_PLUGIN_PATH . 'includes/facilities.php';

// Include the fields
require_once PARKS_PLUGIN_PATH . 'includes/fields.php';

// Include the ShortCode
require_once PARKS_PLUGIN_PATH . 'includes/park_list.php';

register_activation_hook(__FILE__, 'parks_plugin_activate');
register_deactivation_hook(__FILE__, 'parks_plugin_deactivate');
register_uninstall_hook(__FILE__, 'parks_plugin_uninstall');

function parks_plugin_activate()
{
    // Register the Post Type
    register_parks_post_type();

    // Register the Taxonomy
    register_facilities_taxonomy();

    // Clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}

// Deactivation Hook
function parks_plugin_deactivate()
{
    // Unregister post type and taxonomy
    unregister_post_type('parks');
    unregister_taxonomy('facilities');

    // Clear the permalinks
    flush_rewrite_rules();
}

function parks_plugin_uninstall()
{
    // Get all posts of 'park' post type
    $parks = get_posts(array(
        'post_type' => 'parks',
        'numberposts' => -1,
        'post_status' => 'any'
    ));

    // Delete all parks posts
    foreach ($parks as $park) {
        wp_delete_post($park->ID, true); // Set to true to bypass trash
    }

    // Delete taxonomy terms
    $terms = get_terms(array(
        'taxonomy' => 'facilities',
        'hide_empty' => false
    ));

    foreach ($terms as $term) {
        wp_delete_term($term->term_id, 'facilities');
    }

    // Clear the permalinks
    flush_rewrite_rules();
}

function park_get_template_part($template)
{
    $template_path = plugin_dir_path(__FILE__) . 'templates/' . $template . '.php';
    if (file_exists($template_path)) {
        include $template_path;
    }
}

add_action('wp_enqueue_scripts', 'parks_enqueue_styles');

function parks_enqueue_styles() {
    wp_enqueue_style(
        'parks-plugin-style', 
        PARKS_PLUGIN_URL . 'assets/css/styles.css', 
        array(), 
        PARKS_PLUGIN_VERSION, 
        'all'
    );
}



add_action('init', 'register_parks_post_type');
add_action('init', 'register_facilities_taxonomy');
add_action('init', 'register_park_list_shortcode');

add_action('add_meta_boxes', 'add_park_meta_boxes');
add_action('save_post_parks', 'save_park_meta_data');
add_action('admin_footer', 'add_post_script');

// Register the shortcode
add_shortcode('park_list', 'display_parks_list');