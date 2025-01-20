<div class="parks-form-container">
    <form method="POST" class="parks-filter-form material">

        <?php
        // Facilities dropdown
        $facilities = get_terms([
            'taxonomy' => 'facilities',
            'hide_empty' => false,
        ]);
        ?>

        <select name="facility_filter">
            <option value="">All Facilities</option>
            <?php foreach ($facilities as $facility): ?>
                <option value="<?php echo esc_attr($facility->term_id); ?>" <?php selected(isset($_POST['facility_filter']) ? $_POST['facility_filter'] : '', $facility->term_id); ?>>
                    <?php echo esc_html($facility->name); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="park_search" placeholder="Search parks..."
            value="<?php echo esc_attr(isset($_POST['park_search']) ? $_POST['park_search'] : ''); ?>">

        <button type="submit">Search</button>
    </form>
</div>