<?php 
/**
 * Template for displaying a grid of parks.
 *
 * This template is used to display a grid of park cards by including the 'park-card.php' template
 * for each park post retrieved by the $parks_query.
 *
 * @package ParksPlugin
 * @subpackage Templates
 *
 * @var WP_Query $parks_query The query object containing the park posts.
 */
?>
<div class="parks-grid">
    <?php while ($parks_query->have_posts()) : $parks_query->the_post(); 
        include plugin_dir_path(__FILE__) . 'park-card.php';
    endwhile; ?>
</div>
