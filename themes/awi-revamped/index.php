<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
	.sidebar ul{
		padding:0;
	}
	.sidebar{
		max-width:300px;
		margin-left:20px;
	}
	.wp-block-search__button{
		max-width:71px;
	}
	.sidebar h2{
		font-size:26px;
	}
	.wp-posts-list h2{
		font-size:26px;
		margin-top:0;
	}
	.wp-posts-list li{
		display:flex;
		gap:30px;
	}
	.blog_thumbnail{
		min-width:300px;
	}
	body main article{
		width: calc(100% - 286px);
	}
	@media screen and (max-width:982px){
		#primary .container{
			display:block;
		}
		article, .sidebar{
			float:none!important;
			width:100%!important;
		}
	}
	@media screen and (max-width:672px){
		.wp-posts-list li{
			display:block;
		}
		.blog_thumbnail{
			height:200px;
			min-width:100%;
			margin-bottom:20px;
		}
	}
</style>
<?php if(function_exists('get_field')){
	$blog_page_banner = get_field('blog_page_banner','options');
} ?>
<div class="banner_interior">
	<div class="flexslider clearfix">
		<ul class="slides">
			<li style="background-image:url(<?php echo $blog_page_banner['url']; ?>);">
				<div class="flex-caption">
					<div>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>
	<main id="primary" class="site-main">
		<div class="container">
<article>
	<h1>Stories</h1>
		<?php  ?>
		<ul class="wp-posts-list">

				<?php // Start Loop, Code Will Repeat ?>
				<?php while (have_posts()) : the_post(); ?>
				<li>
					<?php if(get_the_post_thumbnail_url() && get_the_post_thumbnail_url() != ''){ ?>
					<div class="blog_thumbnail" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>')">

					</div>
					<?php } ?>
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
		</article><?php
get_sidebar();
		?>
</div>
	</main><!-- #main -->

<?php
get_footer();