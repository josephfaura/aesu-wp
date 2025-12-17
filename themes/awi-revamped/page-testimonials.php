<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Testimonials
 */

get_header(); ?>

<style>
.slider-prev-next-wrapper {
	display:none;
}
#g-review .swiper {
	padding: 0 0 56px;
}
.wp-block-vgb-video-gallery .filter {
	border-bottom:0;
	padding:0;
	margin: 0 0 32px;
}
.vgbVideoGallery .filter button {
	width:auto;
	font-weight:700;
}

.testimonials-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
}
.testimonial-item {
    display: flex;
    flex-direction: column;
    width: calc(33.333% - 2rem);
}

.testimonial-image {
    aspect-ratio: 1.25 / 1;
    width: 100%;
    overflow: hidden;
}
.testimonial-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.testimonial-content {
	padding: 3rem 4rem 3rem 5rem;
	position: relative;
	background-color:#f2f2f2;
	flex: 1;
    display: flex;
    flex-direction: column;
}
.testimonial-text p{
	font-size: 1.25rem;
	margin-top:.5rem;
}
.testimonial_quote_icon_left{
	top:16px;
}
.testimonial_quote_icon_right{
	right:32px;
}
.testimonial_author {
	margin-top: auto;
}
.testimonial_author p{
	margin:.5em auto;
}
.testimonial-name {
	font-size: 1rem;
    font-weight: 600;
}

@media (max-width: 1024px) {
    .testimonial-item {
        width: calc(50% - 2rem);
    }
}
@media (max-width: 640px) {
    .testimonial-item {
        width: 100%;
    }
    .testimonial-image {
    	aspect-ratio: 1.5 / 1;
	}
    .testimonial-content {
        padding: 2rem;
    }
    .testimonial-text p {
        font-size: 1.125rem;
    }
    .testimonial_quote_icon_left {
        display: none;
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
        <article class="full-width" style="width:100%;max-width:100%;">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                        <?php the_content(); ?>
                    </div>
                </div>
                
            <?php endwhile; endif; ?>

		 <?php
		 // TESTIMONIALS GRID (secondary query)
		$args = array(
		    'post_type'      => 'testimonial',
		    'posts_per_page' => -1,
		    'post_status'    => 'publish',
		);

		$testimonial = new WP_Query($args);

		if ($testimonial->have_posts()) : ?>
		    
		    <div class="testimonials-grid">

		        <?php while ($testimonial->have_posts()) : $testimonial->the_post();

		            // ACF fields
		            $name        = get_field('name');
		            $school      = get_field('school'); // Post Object
		            $designation = get_field('designation');
		        ?>

		            <div class="testimonial-item">

		                <?php if (has_post_thumbnail()) : ?>
						    <div class="testimonial-image">
						        <?php the_post_thumbnail('large', array(
						            'class' => 'testimonial-img'
						        )); ?>
						    </div>
						<?php endif; ?>

		                <div class="testimonial-content">

		                	<div class="testimonial_quote_icon_left"><i class="fa fa-quote-left"></i></div>

		                    <div class="testimonial-text">
		                        <?php the_content(); ?>
		                    </div>

		                    <div class="testimonial_author">
		                        <?php if ($name) : ?>
		                            <p class="testimonial-name"><?php echo esc_html($name); ?></p>
		                        <?php endif; ?>

		                        <?php if ($school) : ?>
		                            <p class="testimonial-school">
		                                <?php echo esc_html($school->post_title); ?>
		                            </p>
		                        <?php elseif ($designation) : ?>
		                            <p class="testimonial-designation">
		                                <?php echo esc_html($designation); ?>
		                            </p>
		                        <?php endif; ?>
		                    </div>

		                    <div class="testimonial_quote_icon_right"><i class="fa fa-quote-right"></i></div>

		                </div>

		            </div>

		        <?php endwhile; ?>

		    </div>

		<?php endif; wp_reset_postdata(); ?>
		</article>
	</div>
</main>
<?php get_footer(); ?>
