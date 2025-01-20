<?php
// Register the shortcode
function register_park_list_shortcode() {
    add_shortcode('park_list', 'display_parks_list');
}
function display_parks_list() {
    // Start output buffering
    ob_start();

    // Get search and filter parameters
    $search_term = isset($_POST['park_search']) ? sanitize_text_field($_POST['park_search']) : '';
    $facility_filter = isset($_POST['facility_filter']) ? sanitize_text_field($_POST['facility_filter']) : '';
    
    include PARKS_PLUGIN_PATH . 'templates/forms/filter.php';
    
    // Build query arguments
    $query_args = array(
        'post_type' => 'parks',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    // Add taxonomy query if facility filter is set
    if (!empty($facility_filter)) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'facilities',
                'field' => 'term_id',
                'terms' => $facility_filter
            )
        );
    }

    // Add meta query if search term is present
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

    // Query parks
    $parks_query = new WP_Query($query_args);

    if ($parks_query->have_posts()) {
        include PARKS_PLUGIN_PATH . 'templates/parks-grid.php';
    } else {
        echo '<p>No parks found.</p>';
    }
    
    wp_reset_postdata();
    
    // Return the buffered content
    return ob_get_clean();
}
