<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

<?php // ACF - Set fields to variables
if(function_exists('get_field')) {
	$sidebar_content = get_field('sidebar_content');
} ?>

<aside>

	<?php if((is_home() || is_single() || is_archive()) && is_active_sidebar('sidebar-2')) { ?>

		<div class="sidebar sidebar--dynamic">
			<ul>
				<?php dynamic_sidebar('sidebar-2'); ?>
			</ul>
		</div>

	<?php } elseif(is_active_sidebar('sidebar-1')) { ?>
		
			<div class="sidebar sidebar--dynamic">
				<ul>
					<?php dynamic_sidebar('sidebar-1'); ?>
				</ul>
			</div>

	<?php } ?>

	<?php if($sidebar_content) { ?>	
		<div class="sidebar">
			<?php echo $sidebar_content; ?>
		</div>
	<?php } ?>

</aside>