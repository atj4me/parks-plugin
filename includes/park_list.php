<?php
/**
 * Registers a shortcode for displaying a list of parks.
 * 
 * This function creates a WordPress shortcode with the tag 'park_list'
 * that can be used in posts and pages to display a list of parks.
 * The actual display functionality is handled by the 'display_parks_list' callback function.
 * 
 * @since 1.0.0
 * @return void
 */
function register_park_list_shortcode() {
    add_shortcode('park_list', 'display_parks_list');
}

/**
 * Display a list of parks with optional search and filter functionality.
 *
 * This function outputs a list of parks based on search and filter parameters
 * provided via POST request. It supports filtering by facility and searching
 * by park name, location, weekday hours, and weekend hours.
 *
 * @return string The HTML content of the parks list.
 */
function display_parks_list() {
    // Start output buffering
    ob_start();

    // Get search and filter parameters
    $search_term = isset($_POST['park_search']) ? sanitize_text_field($_POST['park_search']) : '';
    $facility_filter = isset($_POST['facility_filter']) ? sanitize_text_field($_POST['facility_filter']) : '';
    
    /**
     * Includes the filter form template for the parks plugin.
     * 
     * This file is located at: /wp-content/plugins/parks-plugin/includes/park_list.php
     * 
     * The included file is expected to be at: PARKS_PLUGIN_PATH . 'templates/forms/filter.php'
     */
    include PARKS_PLUGIN_PATH . 'templates/forms/filter.php';
    
    /**
     * Query arguments for fetching all 'parks' posts.
     *
     * This array defines the parameters for a WP_Query to retrieve all posts
     * of the custom post type 'parks'. The query will return all posts
     * (no limit on the number of posts), ordered by the post title in ascending order.
     *
     * @var array $query_args {
     *     Array of query parameters.
     *
     *     @type string $post_type      The post type to query. Default 'parks'.
     *     @type int    $posts_per_page Number of posts to retrieve. Default -1 (all posts).
     *     @type string $orderby        Field to order posts by. Default 'title'.
     *     @type string $order          Order direction. Default 'ASC' (ascending).
     * }
     */
    $query_args = array(
        'post_type' => 'parks',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    /**
     * Adds a taxonomy query to filter parks by facility if the facility filter is not empty.
     *
     * @param array $query_args The existing query arguments.
     * @param array $facility_filter The array of facility term IDs to filter by.
     */
    if (!empty($facility_filter)) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'facilities',
                'field' => 'term_id',
                'terms' => $facility_filter
            )
        );
    }

    /**
     * Adds meta query arguments to the main query if a search term is provided.
     *
     * This function checks if the $search_term variable is not empty. If it is not empty,
     * it adds a 'meta_query' array to the $query_args array. The 'meta_query' array contains
     * multiple conditions that search for the $search_term in various meta fields of the park
     * custom post type. The search is performed using the 'LIKE' comparison operator.
     *
     * Meta fields included in the search:
     * - _park_name
     * - _park_location
     * - _park_weekday_hours
     * - _park_weekend_hours
     *
     * The 'relation' key is set to 'OR', meaning that the query will return results that match
     * any of the specified meta fields.
     *
     * @param string $search_term The term to search for in the park meta fields.
     * @param array $query_args The array of query arguments to modify.
     */
    if (!empty($search_term)) {
        $query_args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key' => '_park_name',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_park_location',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_park_weekday_hours',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_park_weekend_hours',
                'value' => $search_term,
                'compare' => 'LIKE'
            )
        );
    }

    /**
     * Executes a custom query to retrieve a list of parks based on the provided query arguments.
     *
     * @param array $query_args An associative array of query parameters to filter the parks.
     * @return WP_Query The result of the query containing the list of parks.
     */
    $parks_query = new WP_Query($query_args);

    /**
     * Checks if there are any park posts available and includes the parks grid template if there are.
     * If no park posts are found, it displays a message indicating that no parks were found.
     *
     * @global WP_Query $parks_query The query object containing the park posts.
     */
    if ($parks_query->have_posts()) {
        include PARKS_PLUGIN_PATH . 'templates/parks-grid.php';
    } else {
        echo '<p>No parks found.</p>';
    }
    
    /**
     * Resets the global $post object and restores the original query.
     * 
     * This function should be called after a custom query using WP_Query
     * to ensure that the global $post object is restored to its original state.
     * It is important to call this function to avoid conflicts with other queries
     * and to ensure that template tags and other functions relying on the global
     * $post object work correctly.
     */
    wp_reset_postdata();
    
    // Return the buffered content
    return ob_get_clean();
}
