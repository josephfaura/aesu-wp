<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Redirect all 404's to the homepage
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".site_url());
exit(); ?>