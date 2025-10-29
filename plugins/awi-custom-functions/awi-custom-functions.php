<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.advp.com
 * @since             1.0.0
 * @package           Awi_Custom_Functions
 *
 * @wordpress-plugin
 * Plugin Name:       AWI Custom Functions
 * Description:       This plugin is meant to contain all custom post types and other functionality that can remain separate from the theme.
 * Version:           1.0.0
 * Author:            Adventure Web Interactive
 * Text Domain:       awi-custom-functions
 */
foreach(glob( plugin_dir_path( __FILE__ ) . 'functions/*.php') as $filename) {
	require_once($filename);
}
foreach(glob( plugin_dir_path( __FILE__ ) . 'functions/custom-scripts/*.php') as $filename) {
	require_once($filename);
}
foreach(glob( plugin_dir_path( __FILE__ ) . 'functions/classes/*.php') as $filename) {
	require_once($filename);
}
foreach(glob( plugin_dir_path( __FILE__ ) . 'functions/post-types/*.php') as $filename) {
	require_once($filename);
}