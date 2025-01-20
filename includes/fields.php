<?php

// Add Meta Box
function add_park_meta_boxes()
{
    add_meta_box(
        'park_details', // Unique ID
        'Park Details', // Box title
        'park_details_html', // Content callback, must be of type callable
        'parks' // Post type
    );
}

// Meta Box HTML
function park_details_html($post)
{
    // Add nonce for security
    wp_nonce_field('park_details_nonce', 'park_details_nonce');

    // Get existing values
    $name = get_post_meta($post->ID, '_park_name', true) ?: $post->post_title;
    $location = get_post_meta($post->ID, '_park_location', true);
    $weekday_hours = get_post_meta($post->ID, '_park_weekday_hours', true);
    $weekend_hours = get_post_meta($post->ID, '_park_weekend_hours', true);
    $description = get_post_meta($post->ID, '_park_description', true);

    // Output the fields
    ?>
    <table class="form-table">
        <tr>
            <th><label for="park_name" aria-required="true">Name<span class="error-message">*</span></label></th>
            <td>
                <input type="text" id="park_name" name="park_name" value="<?php echo esc_attr($name); ?>"
                    class="regular-text" required>
            </td>
        </tr>
        <tr>
            <th><label for="park_location">Location<span class="error-message">*</span></label></th>
            <td>
                <input type="text" id="park_location" name="park_location" value="<?php echo esc_attr($location); ?>"
                    class="regular-text" required>
            </td>
        </tr>
        <tr>
            <th><label for="park_weekday_hours">Weekday Hours</label></th>
            <td>
                <input type="text" id="park_weekday_hours" name="park_weekday_hours"
                    value="<?php echo esc_attr($weekday_hours); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="park_weekend_hours">Weekend Hours</label></th>
            <td>
                <input type="text" id="park_weekend_hours" name="park_weekend_hours"
                    value="<?php echo esc_attr($weekend_hours); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="park_description">Short Description</label></th>
            <td>
                <textarea id="park_description" name="park_description" rows="4"
                    class="regular-text"><?php echo esc_textarea($description); ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

// Save Meta Box data
function save_park_meta_data($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (
        !isset($_POST['park_details_nonce']) ||
        !wp_verify_nonce($_POST['park_details_nonce'], 'park_details_nonce') ||
        !current_user_can('edit_post', $post_id)
    ) {
        return;
    }

    $fields = array(
        '_park_name' => 'park_name',
        '_park_location' => 'park_location',
        '_park_weekday_hours' => 'park_weekday_hours',
        '_park_weekend_hours' => 'park_weekend_hours',
        '_park_description' => 'park_description'
    );

    foreach ($fields as $meta_key => $post_key) {
        if (isset($_POST[$post_key])) {
            $value = $post_key === 'park_description' ?
                sanitize_textarea_field($_POST[$post_key]) :
                sanitize_text_field($_POST[$post_key]);
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}


// Syncronize the title with park name
function add_post_script()
{
    global $post_type;
    if ($post_type === 'parks') {
         wp_enqueue_script(
            'parks-title-js',
            plugins_url('../assets/js/title.js', __FILE__),
            array(), // Dependencies
            '1.0.0', // version number
            true // load in footer
        );
    }
}

