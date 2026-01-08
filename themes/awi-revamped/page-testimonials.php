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
.galleryItem {
	border-radius:6px;
}

.testimonials-grid {
	margin:32px auto;
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
	font-weight:500;
	font-size: 1.25rem;
	margin-top:.5rem;
}
.testimonial_author p{
	margin:.25em auto;
}
.testimonial-name {
	font-size: 1rem;
}
.testimonial-designation {
	font-weight: 400;
}

@media (max-width: 1024px) {
    .testimonial-item {
        width: calc(50% - 2rem);
    }
}
@media (max-width: 720px) {
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
    .testimonial_quote_icon_right{
		bottom:42px;
	}
}
</style>

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

<div class="container">
    <div id="back_to_top" class="back-to-top-inline">
        <i class="fa-solid fa-angle-up"></i>
    </div>
</div>

<?php get_footer(); ?>