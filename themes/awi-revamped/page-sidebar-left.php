<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Default Left Sidebar
 */

get_header(); ?>
<?php if ( have_rows('slider', $dupID) ) : ?>
	<?php
	the_row(); // ← advance to FIRST slide only

	$image    = get_sub_field('slide_image');
	$title    = get_sub_field('slide_title');
	$subtitle = get_sub_field('slide_subtitle');
	$link     = get_sub_field('slide_link');
	$copy	  = get_sub_field('slide_link_copy');
	?>
	
	<div class="banner_interior" style="background-image:url(<?php echo esc_url($image['url']); ?>);">
		<div class="container">
			<?php if ( $title ) : ?>
				<h3><?php echo esc_html($title); ?></h3>
			<?php endif; ?>

			<?php if ( $subtitle ) : ?>
				<p><?php echo esc_html($subtitle); ?></p>
			<?php endif; ?>

			<?php if ( $link ) : ?>
				<a href="<?php echo esc_url($link); ?>" class="cta-button">
					<?php echo esc_html($copy); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>

<?php else : ?>
	<div class="no-banner"></div>
<?php endif; ?>
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
		<aside>
			<?php get_sidebar(); ?>
		</aside>
	</div>
</main>
<?php get_footer(); ?>
