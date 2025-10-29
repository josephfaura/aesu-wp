<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<?php // Wrap Design Around This Block ?>
<h1><?php echo get_page(get_option('page_for_posts'))->post_title; ?></h1>
<?php if (have_posts()) : ?>
<ul class="wp-posts-list">
	<?php // Start Loop, Code Will Repeat ?>
	<?php while (have_posts()) : the_post(); ?>
	<li>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
				</a></h2>
			<small>
			<ul class="postmetadata-list clearfix">
				<li><span class="postmetadata-date">
					<?php the_time('F jS, Y'); ?>
					</span></li>
				<li><span class="postmetadata-cats">Posted in
					<?php the_category(', '); ?>
					</span></li>
				<?php if(get_tags()) { ?>
				<li><span class="postmetadata-tags">
					<?php the_tags('Tags: ', ', '); ?>
					</span></li>
				<?php } ?>
			</ul>
			</small>
			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</li>
	<?php endwhile; ?>
	<?php // End Loop ?>
</ul>
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
<p>Sorry, but there currently aren't any posts.</p>
<?php endif; ?>
<?php // End Block ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>