<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Determine if the current request should be treated as an AWT page
 *
 * @return bool
 */
function awi_is_awt_page(): bool {

    // Cache result so logic only runs once per request
    static $is_awt = null;

    if ($is_awt !== null) {
        return $is_awt;
    }

    // -------------------------------------
    // Check referrer header type
    // -------------------------------------
    $referrer = $_SERVER['HTTP_REFERER'] ?? '';
    $referrer_header = null;

    if ($referrer) {
        $ref_post_id = url_to_postid($referrer);
        if ($ref_post_id) {
            $referrer_header = function_exists('get_field')
                ? get_field('header_type', $ref_post_id)
                : null;
        }
    }

    // -------------------------------------
    // Check current post header type
    // -------------------------------------
    $current_header = function_exists('get_field')
        ? get_field('header_type')
        : null;

    // -------------------------------------
    // Final logic: AWT wins if referrer OR current is AWT
    // -------------------------------------
    $is_awt = (
        $referrer_header === 'AWT'
        || $current_header === 'AWT'
    );

    return $is_awt;
}

/**
 * Add body class for AWT pages
 */
add_filter('body_class', function ($classes) {
    if (awi_is_awt_page()) {
        $classes[] = 'is-awt';
    }
    return $classes;
});

/**
 * Disable Popup Maker modals server-side on AWT pages
 */
add_filter('pum_is_popup_enabled', function ($enabled, $popup_id) {

    // Only target your newsletter popup
    if ((int) $popup_id === 14384 && awi_is_awt_page()) {
        return false; // hard-disable popup
    }

    return $enabled;
}, 10, 2);