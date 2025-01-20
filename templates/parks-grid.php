<div class="parks-grid">
    <?php while ($parks_query->have_posts()) : $parks_query->the_post(); 
        include plugin_dir_path(__FILE__) . 'park-card.php';
    endwhile; ?>
</div>
