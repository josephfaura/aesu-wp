<?php
/**
 * Theme Setup
 * Set up boilerplate theme options for core and boilerplate plugins
 */

/****************************************************************************************************
 Theme Support
 ****************************************************************************************************/

// Enable wp title tags
add_theme_support('title-tag');

// Enable RSS feed links to HTML head
add_theme_support('automatic-feed-links');

// Enable featured image
// add_theme_support('post-thumbnails');

// Enable editor style
add_editor_style(array('css/editor.css', 'style.css'));

// Set content width
if(!isset($content_width)) $content_width = 1200;



/****************************************************************************************************
 Filters
 ****************************************************************************************************/

// Modify excerpt lengh
add_filter('excerpt_length', 'awi_excerpt_length');

// Modify read more at end of excerpt
add_filter('excerpt_more', 'awi_excerpt_more');

// Remove version # from strings if non-admin page 
if (!is_admin()) {	
	add_filter('script_loader_src', 'awi_remove_script_version', 15, 1);
	add_filter('style_loader_src', 'awi_remove_script_version', 15, 1); 
}

// Remove pinkbacks completely
add_filter('xmlrpc_methods', 'awi_remove_pingbacks');

// Disable Gutenberg for posts
add_filter('use_block_editor_for_post', '__return_false');

// Disable Gutenberg for post types
add_filter('use_block_editor_for_post_type', '__return_false');



/****************************************************************************************************
 Actions
 ****************************************************************************************************/

// Enqueue scripts
add_action('wp_print_scripts', 'awi_enqueue_scripts');


// Remove Jetpack sharing on front page and search results
add_action('wp', 'awi_remove_jetpack_sharing');

// Remove Jetpack devicepx-jetpack.js for avatar images
add_action('wp_enqueue_scripts', 'awi_remove_devicepx');



/****************************************************************************************************
 Functions
 ****************************************************************************************************/

function awi_excerpt_length() {
	return 40;
}

function awi_excerpt_more() {
	return '... <a href="'. get_permalink( get_the_ID() ) . '" class="read-more">Read&nbsp;More</a>';
}

function awi_enqueue_scripts() {
	if((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
}

function awi_remove_script_version( $src ){
	$parts = explode( '?', $src);
	return $parts[0];
}

function awi_remove_pingbacks( $methods ){
	unset( $methods['pingback.ping']);
	return $methods;
}

function awi_remove_jetpack_sharing() {
	if (is_page() || is_search()) {
		remove_filter('the_content', 'sharing_display', 19);
		remove_filter('the_excerpt', 'sharing_display', 19);
	}
}

function awi_remove_devicepx() {
	wp_dequeue_script( 'devicepx' );
}

function awi_enqueue_comment_reply(){
	if((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script( 'comment-reply');
}