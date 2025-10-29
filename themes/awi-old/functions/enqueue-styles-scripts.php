<?php
/**
 * Enqueue styles and scripts
 * Theme-specific styles and scripts
 */

/****************************************************************************************************
 Actions
 ****************************************************************************************************/

// Enqueue scripts
add_action('wp_enqueue_scripts', 'awi_enqueue_styles_scripts');


// Initialize scripts 
add_action('wp_footer', 'awi_initialize_scripts', 9999);



/****************************************************************************************************
 Functions
 ****************************************************************************************************/

 function awi_enqueue_styles_scripts() {
	wp_enqueue_style('core', get_stylesheet_uri());
	wp_enqueue_style('theme', get_template_directory_uri().'/css/style.css');
	// if(is_front_page()) wp_enqueue_style('flexslider', get_template_directory_uri().'/css/flexslider.css');

	wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-3.1.1.min.js');
	wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr-2.2.min.js');
	wp_enqueue_script('svgxuse', get_template_directory_uri().'/js/svgxuse.min.js', array('jquery'), false, true);

	wp_enqueue_script('awiNav', get_template_directory_uri().'/js/awiNav-1.2.1.js', array('jquery'), false, true);
	// wp_enqueue_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js');

	wp_enqueue_script('fontfaceobserver', get_template_directory_uri().'/js/fontfaceobserver.js', array('jquery'), false, true);
	wp_enqueue_script('fontloader', get_template_directory_uri().'/js/fontloader.js', array('jquery'), false, true);
}

function awi_initialize_scripts() {
	if(is_front_page()) { ?>
    
	<?php }
}