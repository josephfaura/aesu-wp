<?php
/**
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AWI_Revamped
 * 
 * Template Name: Media Library
 */

get_header();
if(function_exists('get_field')){
	$media_items = get_field('media_items');
}
?>
<style>
	.media_item{
		display:inline-block;
		vertical-align:top;
		margin:10px;
		width:calc(100% / 3 - 23px);
	}
	@media screen and (max-width:900px){
		
	.media_item{
		display:inline-block;
		vertical-align:top;
		margin:10px;
		width:calc(100% / 2 - 23px);
	}
	}
	@media screen and (max-width:600px){
		
	.media_item{
		display:inline-block;
		vertical-align:top;
		margin:10px;
		width:calc(100% / 1 - 23px);
	}
	}
</style>
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
		</div>
        <article class="full-width" style="width:100%;max-width:100%;">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                        <?php the_content(); ?>
						<?php get_template_part('inc/flexible-content'); ?>
                    </div>
					<?php foreach($media_items as $media_item){ ?>
						<div class="media_item">
							<a href="<?php echo $media_item['media_video'] ?>" data-fancybox>
								<img src="<?php echo $media_item['media_thumbnail']['url'] ?>">
								<h3><?php echo $media_item['media_title'] ?></h3>
							</a>
						</div>
					<?php } ?>
                </div>
                
            <?php endwhile; endif; ?>

        </article>
    </div>
</main>

<?php get_footer(); ?>