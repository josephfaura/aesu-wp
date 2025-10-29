<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

?>

<?php get_header(); ?>

<main>
	<div class="container">
		<article>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="post" id="post-<?php the_ID(); ?>">
					<div class="entry">
						<?php the_content(); ?>
					</div>
				</div>

			<?php endwhile; endif; ?>
			
		</article>
		<?php get_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>