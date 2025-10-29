<?php
/**
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AWI_Revamped
 * 
 * Template Name: Full Width
 */

get_header();
?>

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
        <?php if (the_field('h1_page_title')){ ?>
		<div class="header">
			<h1>
				<?php the_field('h1_page_title'); ?>
			</h1>
		</div>
		<?php } ?>
        <article class="full-width" style="width:100%;max-width:100%;">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                        <?php the_content(); ?>
						<?php get_template_part('inc/flexible-content'); ?>
                    </div>
                </div>
                
            <?php endwhile; endif; ?>

        </article>
    </div>
</main>

<?php get_footer(); ?>