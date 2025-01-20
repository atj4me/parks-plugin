<?php 

// Add server-side validation to the save function
function validate_time_format($time_string) {
    if (empty($time_string)) {
        return true;
    }
    return preg_match('/^(1[0-2]|0?[1-9])(AM|PM)\s*-\s*(1[0-2]|0?[1-9])(AM|PM)$/i', $time_string);
}
