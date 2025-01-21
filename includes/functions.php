<?php 
/**
 * Activates the Parks Plugin.
 *
 * This function is called when the Parks Plugin is activated. It performs the following tasks:
 * - Registers the custom post type for parks.
 * - Registers the custom taxonomy for facilities.
 * - Clears the permalinks to ensure the new post type and taxonomy are recognized.
 *
 * @return void
 */
function parks_activate()
{
    // Register the Post Type
    register_parks_post_type();

    // Register the Taxonomy
    register_facilities_taxonomy();

    // Clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}

/**
 * Deactivate the Parks Plugin.
 *
 * This function is called when the Parks Plugin is deactivated. It performs the following actions:
 * - Unregisters the custom post type 'parks'.
 * - Unregisters the custom taxonomy 'facilities'.
 * - Clears the permalinks to remove any rewrite rules associated with the custom post type and taxonomy.
 *
 * @return void
 */
function parks_deactivate()
{
    // Unregister post type and taxonomy
    unregister_post_type('parks');
    unregister_taxonomy('facilities');

    // Clear the permalinks
    flush_rewrite_rules();
}

/**
 * Uninstall callback for the Parks Plugin.
 *
 * This function performs the following actions during the uninstallation process:
 * 1. Retrieves all posts of the custom post type 'parks' and deletes them permanently.
 * 2. Retrieves all terms from the 'facilities' taxonomy and deletes them.
 * 3. Clears the permalinks to remove any rewrite rules associated with the deleted posts and terms.
 *
 * @return void
 */
function parks_uninstall()
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

    // Delete all terms from the 'facilities' taxonomy
    foreach ($terms as $term) {
        wp_delete_term($term->term_id, 'facilities');
    }

    // Clear the permalinks
    flush_rewrite_rules();
}

/**
 * Retrieves and includes a template part for the park plugin.
 *
 * This function constructs the path to a template file within the plugin's
 * templates directory and includes it if it exists.
 *
 * @param string $template The name of the template file (without the .php extension) to include.
 */
function park_get_template_part($template)
{
    $template_path = plugin_dir_path(__FILE__) . 'templates/' . $template . '.php';
    if (file_exists($template_path)) {
        include $template_path;
    }
}

/**
 * Enqueues the styles for the Parks Plugin.
 *
 * This function registers and enqueues the stylesheet for the Parks Plugin.
 * The stylesheet is located in the 'assets/css' directory of the plugin.
 *
 * @return void
 */
function parks_enqueue_styles() {
    wp_enqueue_style(
        'parks-plugin-style', 
        PARKS_PLUGIN_URL . 'assets/css/styles.css', 
        array(), 
        PARKS_PLUGIN_VERSION, 
        'all'
    );
}