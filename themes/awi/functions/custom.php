<?php
/**
 * Custom Functions
 * Theme-specific or non-boilerplate plugin-specific functions can be added here
 */
add_action('wp_print_scripts', function () {
	global $post;
	if ( is_a( $post, 'WP_Post' ) && !has_shortcode( $post->post_content, 'contact-form-7') ) {
		wp_dequeue_script( 'google-recaptcha' );
		wp_dequeue_script( 'wpcf7-recaptcha' );
	}
});

add_filter('use_block_editor_for_post', '__return_false');
// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );
function action_woocommerce_admin_order_data_after_order_details( $order ) {
    echo '<a href="' . $order->get_checkout_order_received_url() . '" target="_blank" class="button" style="margin-top:10px">' . __( 'Preview Order Thank You', 'woocommerce' ) . '</a>';
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'action_woocommerce_admin_order_data_after_order_details', 10, 1 );