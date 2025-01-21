<?php 
/**
 * Loads and modifies the template for single park posts.
 * 
 * This function checks if the current post type is 'parks' and modifies the content
 * by appending custom park template content after the main content. It uses output
 * buffering to capture the template content from 'single-park.php'.
 * 
 * @param string $template The path of the current template being loaded.
 * @return string The path of the template to be used.
 * 
 * @global WP_Post $post The current WordPress post object.
 * 
 * @since 1.0.0
 * @uses locate_template()
 * @uses add_filter()
 * @uses is_singular()
 * @uses ob_start()
 * @uses ob_get_clean()
 * @uses PARKS_PLUGIN_PATH
 */
function load_parks_template( $template ) {
    global $post;

    if ( 'parks' === $post->post_type && locate_template( ['single-parks.php'] ) !== $template ) {
        
        add_filter('the_content', function($content) {
            if (!is_singular('parks')) {
                return $content;
            }
            
            // Start output buffering to capture the template content
            ob_start();
            // Include your template file
            include PARKS_PLUGIN_PATH . 'templates/single-park.php';
            
            // Get the template content
            $park_content = ob_get_clean();
            
            // Add your template content after the main content
            return $content . $park_content;
        });
    }

    return $template;
}
