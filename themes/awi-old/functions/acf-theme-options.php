<?php
/**
 * ACF Theme Options
 * Adds an ACF options page(s) in admin 
 */

// Add ACF Options page support
if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'redirect'		=> false
	));
}