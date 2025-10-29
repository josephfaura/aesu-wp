<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<?php // Wrap Design Around This Block ?>
<h1>Search Results</h1>
<?php if (have_posts()) : ?>
<div class="pagination">
	<?php global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	)); ?>
</div>
<?php // Start Loop, Code Will Repeat ?>
<ul class="wp-posts-list">
	<?php while (have_posts()) : the_post(); ?>
	<li>
		<div <?php post_class() ?>>
			<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
				</a></h3>
			<a href="<?php the_permalink() ?>" class="search-results-url" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_permalink() ?>
			</a>
			<?php the_excerpt(); ?>
		</div>
	</li>
	<?php endwhile; ?>
</ul>
<?php // End Loop ?>
<div class="pagination">
	<?php global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	)); ?>
</div>
<?php else : ?>
<p>No results found. Try a different search?</p>
<?php get_search_form(); ?>
<?php endif; ?>
<?php // End Block ?>

<?php get_footer(); ?>