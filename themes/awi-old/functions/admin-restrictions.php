<?php
/**
 * Admin Restrictions
 * Set up basic non-admin restrictions for access/white label purposes
 */

/****************************************************************************************************
 Actions
 ****************************************************************************************************/

// Removes links from navigation for non-admin users
add_action('admin_init', 'awi_remove_admin_nav_options', 999);

// Removes links from admin bar for non-admin users
add_action('admin_bar_menu', 'awi_remove_admin_bar_options', 999);

// Remove admin bar for non-admin users
add_action('after_setup_theme', 'awi_remove_admin_bar');

// Remove core update nags for non-admin users
add_action('after_setup_theme', 'awi_remove_core_update_nags');

// Remove update nags for non-admin users
add_action('admin_head', 'awi_remove_update_nags');

// Remove error nags for non-admin users
add_action('admin_head', 'awi_remove_error_notice');

// Remove WP logo from login page_link
add_action('login_head', 'awi_remove_login_logo');



/****************************************************************************************************
 Functions
 ****************************************************************************************************/

function awi_remove_admin_nav_options() {
	global $user_ID;
	if (!current_user_can('administrator')) {
		// remove_menu_page('index.php');														// Dashboard
		remove_menu_page('edit.php');															// Posts
		// remove_menu_page('edit.php?post_type=page');											// Pages
		// remove_menu_page('upload.php');														// Media
		remove_menu_page('edit-comments.php');													// Comments
		// remove_menu_page('plugins.php');														// Plugins
		// remove_menu_page('themes.php');														// Appearance
		// remove_menu_page('users.php');														// Users
		// remove_menu_page('profile.php');														// Profile
		remove_menu_page('tools.php');															// Tools
		// remove_menu_page('options-general.php');												// Settings
		remove_menu_page('jetpack');															// Jetpack
		remove_menu_page('wpcf7');																// Contact Form 7
		// remove_menu_page('CF7DBPluginSubmissions');											// Contact Form DB
		// remove_menu_page('wpseo_dashboard');													// Yoast SEO
		// remove_menu_page('edit.php?post_type=acf');											// Custom Fields
		remove_submenu_page('CF7DBPluginSubmissions', 'CF7DBPluginShortCodeBuilder');			// Contact Form DB > Shortcodes
		// remove_submenu_page('themes.php', 'widgets.php');									// Appearance > Widgets
	}
}

function awi_remove_admin_bar_options($wp_admin_bar) {
	global $user_ID;
	if (!current_user_can('administrator')) {
		$wp_admin_bar->remove_node('wp-logo');													// WP Logo
		// $wp_admin_bar->remove_node('site-name');												// Site Name
		$wp_admin_bar->remove_node('comments');													// Comments
		$wp_admin_bar->remove_node('new-content');												// Entire New Content Dropdown
		// $wp_admin_bar->remove_node('new-post');												// New Post Only
		// $wp_admin_bar->remove_node('new-media');												// New Media Only
		// $wp_admin_bar->remove_node('new-page');												// New Page Only
		// $wp_admin_bar->remove_node('new-user');												// New User Only
		$wp_admin_bar->remove_node('wpseo-menu');												// Yoast SEO
		// $wp_admin_bar->remove_node('top-secondary');											// Entire Secondary Menu
		// $wp_admin_bar->remove_node('my-account');											// Account
		// $wp_admin_bar->remove_node('search');												// Omnisearch
		$wp_admin_bar->remove_node('notes');													// Notifications
	}
}

function awi_remove_admin_bar() {
	global $user_ID;
	if (!current_user_can('administrator')) {
		show_admin_bar(false);
	}
}

function awi_remove_core_update_nags() {
	global $user_ID;
	if (!current_user_can('administrator')) {
		function awi_remove_core_updates(){
			global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
		}
		
		add_filter('pre_site_transient_update_core','awi_remove_core_updates');
		add_filter('pre_site_transient_update_plugins','awi_remove_core_updates');
		add_filter('pre_site_transient_update_themes','awi_remove_core_updates');
		
	}
}

function awi_remove_update_nags() {
	global $user_ID;
	if (!current_user_can('administrator')) {
		echo '<style>#update-nag,.update-nag{display:none!important;}</style>';
	}
}

function awi_remove_error_notice() {
	global $user_ID;
	if (!current_user_can('administrator')) {
		echo '<style>div.error{display:none!important;}</style>';
	}
}

function awi_remove_login_logo() {
	echo '<style type="text/css">.login h1{display:none;}</style>';
}