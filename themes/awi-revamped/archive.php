<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AWI_Revamped
 */

get_header();
?>
<style>
	.wp-posts-list{
		list-style: none;
		margin:0;
		padding:0;
	}
	.wp-posts-list > li{
		margin-left:0;
		text-align: left;
		margin-bottom:15px;
		padding-bottom:15px;
		border-bottom:1px solid #000;
	}
	.wp-posts-list p{
		margin:10px 0;
	}
	.post_list article{
		width:100%!important;
	}
	.postmetadata-list{
		list-style: none;
		display: flex;
		gap:10px;
		margin-left:0;
		padding-left:0;
	}
</style>
	<main id="primary" class="site-main">
		<div class="container">
<article>
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
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
								<?php the_time('F jS, Y'); ?> |
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
							<a href="<?php echo get_the_permalink(get_the_ID()); ?>">Read More</a>
						</div>
					</div>
				</li>
				<?php endwhile; ?>
				<?php // End Loop ?>

			</ul>
		</article><?php
get_sidebar();
		?>
</div>
	</main><!-- #main -->

<?php
get_footer();
