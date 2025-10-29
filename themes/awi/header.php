<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<title><?php wp_title(); ?></title>
<?php get_template_part('inc/utilities'); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part('inc/header'); ?>