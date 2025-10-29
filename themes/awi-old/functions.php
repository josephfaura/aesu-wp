<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Require each file in the functions folder
foreach(glob(get_template_directory().'/functions/*.php') as $filename) {
	require_once($filename);
}

// Set mobile detect to variable
$detect = new Mobile_Detect;