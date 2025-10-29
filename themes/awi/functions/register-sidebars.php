<?php
/**
 * Register Sidebars
 */

/****************************************************************************************************
 Actions
 ****************************************************************************************************/

// Register sidebars at widget_init
add_action( 'widgets_init', 'awi_register_sidebars' );



/****************************************************************************************************
 Functions
 ****************************************************************************************************/

function awi_register_sidebars() {

	// Pages
	register_sidebar( array(
		'id' => 'sidebar-1',
		'name' => 'Pages Sidebar',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	// Posts
	register_sidebar( array(
		'id' => 'sidebar-2',
		'name' => 'Posts Sidebar',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

}