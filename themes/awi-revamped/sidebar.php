<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AWI_Revamped
 */

?><?php if(get_field('duplicate_page_check')) {
	$dupID = get_field('duplicate_page_source');
} ?>

<?php if (is_home() || is_single() || is_archive()) { ?>

<div class="sidebar">
	<ul>
		<?php dynamic_sidebar(); ?>
	</ul>
</div>
<?php } else { ?>

<?php the_field('sidebar_block',$dupID); ?>
<?php } ?>
