<?php
/**
 * Template for displaying a single park.
 *
 * This template displays detailed information about a single park including
 * name, location, operating hours, and description.
 *
 * @package Parks_Plugin
 */

/**
 * Retrieves and sets park information for display.
 *
 * Variables:
 * @var string $name          The name of the park. Defaults to the post title if not set.
 * @var string $location      The location of the park.
 * @var string $weekday_hours The operating hours of the park on weekdays.
 * @var string $weekend_hours The operating hours of the park on weekends.
 * @var string $description   The description of the park.
 */
$name = get_post_meta(get_the_ID(), '_park_name', true) ?: get_the_title();
$location = get_post_meta(get_the_ID(), '_park_location', true);
$weekday_hours = get_post_meta(get_the_ID(), '_park_weekday_hours', true);
$weekend_hours = get_post_meta(get_the_ID(), '_park_weekend_hours', true);
$description = get_post_meta(get_the_ID(), '_park_description', true);
?>
<article class="single-park">

    <div class="park-details">
        <?php
        /**
         * Display park name section if name exists
         * 
         * Outputs HTML markup for the park name detail section containing:
         * - A heading "Park Name"
         * - The escaped park name value
         * 
         * @param string $name The name of the park to display
         * @uses esc_html() WordPress function to escape HTML
         */
        if ($name): ?>
            <div class="park-detail-item park-fname">
                <h2 class="detail-title">
                    Park Name
                </h2>
                <div class="detail-content">
                    <?php echo esc_html($name); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        /**
         * Displays the location section for a single park if a location value exists.
         * 
         * Output is wrapped in a div with classes 'park-detail-item' and 'park-location'.
         * Location value is escaped for security using esc_html() before output.
         * 
         * @param string|null $location The location of the park to be displayed
         */
        if ($location): ?>
            <div class="park-detail-item park-location">
                <h2 class="detail-title">
                    Location
                </h2>
                <div class="detail-content">
                    <?php echo esc_html($location); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($weekday_hours || $weekend_hours): ?>
            <div class="park-detail-item park-hours-container">
                <h2 class="detail-title">
                    Operating Hours
                </h2>
                <div class="detail-content hours-content">
                    <?php
                    /**
                     * Displays the weekday hours section for a park
                     * 
                     * This template section renders the weekday operating hours if they exist.
                     * The hours are wrapped in a div with class 'hours-block weekday-hours'
                     * and include a heading and the actual hours in a separate div.
                     * 
                     * @param string $weekday_hours The weekday operating hours of the park
                     * @uses esc_html() WordPress function to escape HTML output
                     */
                    if ($weekend_hours): ?>
                        <div class="hours-block weekend-hours">
                            <h3>Weekend Hours</h3>
                            <div class="hours"><?php echo esc_html($weekend_hours); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        /**
         * Displays the park description section if a description exists
         * 
         * This template part renders an HTML section containing the park's description.
         * The description is sanitized using wp_kses_post() before output for security.
         * 
         * @see wp_kses_post() For allowed HTML filtering
         * 
         * @global string $description The park description content to be displayed
         * 
         * @since 1.0.0
         */
        if ($description): ?>
            <div class="park-detail-item park-description">
                <h2 class="detail-title">About This Park</h2>
                <div class="detail-content">
                    <?php echo wp_kses_post($description); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</article>