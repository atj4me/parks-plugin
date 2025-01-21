<?php 
/**
 * Template part for displaying a park card.
 *
 * This template displays the park's name, location, weekday hours, weekend hours, and description.
 *
 * Variables:
 * - $name (string): The name of the park. Defaults to the post title if not set.
 * - $location (string): The location of the park.
 * - $weekday_hours (string): The operating hours of the park on weekdays.
 * - $weekend_hours (string): The operating hours of the park on weekends.
 * - $description (string): The description of the park.
 *
 * @package Parks_Plugin
 */

/**
 * Retrieves and sets park information for display in a park card template.
 *
 * Variables:
 * @var string $name          The name of the park. Defaults to the post title if the '_park_name' meta field is not set.
 * @var string $location      The location of the park retrieved from the '_park_location' meta field.
 * @var string $weekday_hours The weekday operating hours of the park retrieved from the '_park_weekday_hours' meta field.
 * @var string $weekend_hours The weekend operating hours of the park retrieved from the '_park_weekend_hours' meta field.
 * @var string $description   The description of the park retrieved from the '_park_description' meta field.
 */
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
