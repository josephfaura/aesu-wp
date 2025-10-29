<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<main>
	<div class="container">
		<article>

			<?php if (have_posts()) : ?>
			<?php $post = $posts[0]; ?>
			<?php if (is_category()) { ?>
				<h1>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
			<?php } elseif( is_tag() ) { ?>
				<h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
			<?php } elseif (is_day()) { ?>
				<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
			<?php } elseif (is_month()) { ?>
				<h1>Archive for <?php the_time('F, Y'); ?></h1>
			<?php } elseif (is_year()) { ?>
				<h1>Archive for <?php the_time('Y'); ?></h1>
			<?php } elseif (is_author()) { ?>
				<h1>Author Archive</h1>
			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1>Archives</h1>
			<?php } ?>

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

			<?php else :
				if ( is_category() ) { 
					printf("<p>Sorry, but there aren't any posts in the %s category yet.</p>", single_cat_title('',false));
				} else if ( is_date() ) {
					echo("<p>Sorry, but there aren't any posts with this date.</p>");
				} else if ( is_author() ) {
					$userdata = get_userdatabylogin(get_query_var('author_name'));
					printf("<p>Sorry, but there aren't any posts by %s yet.</p>", $userdata->display_name);
				} else {
					echo("<p>Sorry, but there aren't any posts.</p>");
				}
				get_search_form();
			
			endif; ?>
			
		</article>
		<?php get_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>