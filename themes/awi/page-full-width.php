<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Full Width
 */

?>

<?php get_header(); ?>

<main>
	<div class="container">
		<article class="full-width">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="post" id="post-<?php the_ID(); ?>">
					<div class="entry">
						<?php the_content(); ?>
					</div>
				</div>
				
			<?php endwhile; endif; ?>

		</article>
	</div>
</main>

<?php get_footer(); ?>