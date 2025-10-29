<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<?php // Wrap Design Around This Block ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<div class="entry">
			<?php the_content(); ?>
		</div>
	</div>
<?php endwhile; endif; ?>
<?php // End Block ?>

<?php get_footer(); ?>