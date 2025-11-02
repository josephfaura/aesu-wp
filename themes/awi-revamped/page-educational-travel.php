<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Educational Travel
 */

get_header(); ?>
<?php if(have_rows('slider',$dupID)) { ?>
<div class="banner_interior">
	<div class="flexslider clearfix">
		<ul class="slides">
			<?php while( have_rows('slider',$dupID) ): the_row();
				$image = get_sub_field('slide_image');
				$title = get_sub_field('slide_title');
				$subtitle = get_sub_field('slide_subtitle');
				$link = get_sub_field('slide_link'); ?>
			<li style="background-image:url(<?php echo $image['url']; ?>);">
				<div class="flex-caption">
					<div>
						<?php if($title) { ?>
						<h3><?php echo $title; ?></h3>
						<?php } if($subtitle) { ?>
						<p><?php echo $subtitle; ?></p>
						<?php } if($link) { ?>
						<a href="<?php echo $link; ?>" class="button">Deals</a>
						<?php } ?>
					</div>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
</div>
<?php } else { ?>
<div class="no-banner"></div>
<?php } ?>
<main>
	<div class="container">
		<div class="header">
			<h1>
				<?php the_field('h1_page_title'); ?>
			</h1>
			<?php
				$page_id = 215;
				$page_id = get_post($page_id);
				$content = $page_id->post_content;
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]>', $content);
				echo $content;
				?>
		<?php if(is_page(2356)) { ?>
		<article>
			<section id="trip-home" class="grid-4-col grid clearfix">
				<div class="grid-col-1 col">
					<div class="block-1x1 block"><a href="<?php echo get_the_permalink(2355); ?>" class="grid-link link-blue"><span>Sample<br>
						Itineraries</span><span>Day-to-Day<br>
						Activities</span></a></div>
					<div class="block-1x2 block-img block" style="background-image:url(<?php the_field('grid_image_1'); ?>);"></div>
				</div>
				<div class="grid-col-2 col">
					<div class="block-1x2 block-img block" style="background-image:url(<?php the_field('grid_image_2'); ?>);"></div>
					<div class="block-1x1 block"><a href="<?php echo get_the_permalink(2347); ?>" class="grid-link link-red"><span>FAQ</span><span>Help &amp; Answers</span></a></div>
				</div>
				<div class="grid-col-3 col">
					<div class="block-1x1 block"><a href="<?php echo get_the_permalink(2605); ?>" class="grid-link link-red"><span>About Us</span><span>Learn More</span></a></div>
					<div class="block-1x1 block-img block" style="background-image:url(<?php the_field('grid_image_3'); ?>);"></div>
					<div class="block-1x1 block"><a href="<?php echo get_the_permalink(2351); ?>" class="grid-link link-green"><span>Faculty-Led Programs</span><span>Study Abroad</span></a></div>
				</div>
				<div class="grid-col-4 col">
					<div class="block-1x1 block-img block" style="background-image:url(<?php the_field('grid_image_4'); ?>);"></div>
					<div class="block-1x1 block"><a href="<?php echo get_the_permalink(2352); ?>" class="grid-link link-gold"><span>Customized Groups</span><span>Any Age,<br>
						Any Budget</span></a></div>
					<div class="block-1x1 block"><a href="<?php echo get_the_permalink(2836); ?>" class="grid-link link-blue"><span>Contact</span><span>Reach Out</span></a></div>
				</div>
			</section>
		</article>
		<?php } else { ?>
		<article>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<?php the_content(); ?>
				</div>
				<?php get_template_part('inc/flexible-content'); ?>
			</div>
			<?php endwhile; endif; ?>
		</article>
		<?php } ?>
	</div>
</main>
<?php /*?><main>
	<div class="container">
		<div class="header">
			<h1>
				<?php the_field('h1_page_title'); ?>
			</h1>
		</div>
		<article>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<?php the_content(); ?>
				</div>
				<?php get_template_part('inc/flexible-content'); ?>
			</div>
			<?php endwhile; endif; ?>
		</article>
	</div>
</main><?php */?>

<?php get_footer(); ?>
