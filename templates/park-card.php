<?php
$name = get_post_meta(get_the_ID(), '_park_name', true) ?: get_the_title();
$location = get_post_meta(get_the_ID(), '_park_location', true);
$weekday_hours = get_post_meta(get_the_ID(), '_park_weekday_hours', true);
$weekend_hours = get_post_meta(get_the_ID(), '_park_weekend_hours', true);
$description = get_post_meta(get_the_ID(), '_park_description', true);
?>
<article class="park-card">
    <div class="park-content">
        <h3 class="park-name"><?php echo esc_html($name); ?></h3>
        
        <?php if ($location) : ?>
        <div class="park-location">
            <i class="parks-icon"><?php include PARKS_PLUGIN_PATH . 'templates/icons/location-icon.php'; ?></i>
            <?php echo esc_html($location); ?>
        </div>
        <?php endif; ?>
        
        <?php if ($weekday_hours) : ?>
        <div class="park-hours">
            <?php include PARKS_PLUGIN_PATH . 'templates/icons/clock-icon.php'; ?>
            <span class="hours-label">Weekday Hours:</span>
            <?php echo esc_html($weekday_hours); ?>
        </div>
        <?php endif; ?>

        <?php if ($weekend_hours) : ?>
        <div class="park-hours">
            <?php include PARKS_PLUGIN_PATH . 'templates/icons/clock-icon.php'; ?>
            <span class="hours-label">Weekend Hours:</span>
            <?php echo esc_html($weekend_hours); ?>
        </div>
        <?php endif; ?>
        
        <?php if ($description) : ?>
        <div class="park-description">
            <?php echo wp_kses_post($description); ?>
        </div>
        <?php endif; ?>
    </div>
</article>
