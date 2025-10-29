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
if(function_exists('get_field')){
	//banner
	$banner_image = get_field('banner_image');
	$banner_title = get_field('banner_title');
	$banner_tagline = get_field('banner_tagline');
	$banner_cta = get_field('banner_cta');
	//featured trip
	$featured_trip_title = get_field('featured_trip_title');
	$featured_trip = get_field('featured_trip_group');
	//why travel
	$why_travel_with_us_title = get_field('why_travel_with_us_title');
	$why_travel_items = get_field('why_travel_items');
	//trips for young adults
	$trips_for_young_adults_title = get_field('trips_for_young_adults_title');
	$trips_for_young_adults = get_field('trips_for_young_adults');
	//who we are
	$who_are_we_title = get_field('who_are_we_title');
	$who_are_we_text = get_field('who_are_we_text');
	$who_are_we_cta = get_field('who_are_we_cta');
	$who_are_we_video_background = get_field('who_are_we_video_background');
	$who_are_we_video_youtube_link = get_field('who_are_we_video_youtube_link');
	//testimonials
	$testimonials = get_field('testimonials');
	$testimonial_cta = get_field('testimonial_cta');
	$testimonial_videos = get_field('testimonial_videos');
	//bespoke travel
	$bespoke_travel_title = get_field('bespoke_travel_title');
	$bespoke_travel_text = get_field('bespoke_travel_text');
	$bespoke_travel_cta = get_field('bespoke_travel_cta');
	$bespoke_travel_slider = get_field('bespoke_travel_slider');
	//travel for good
	$travel_for_good_title = get_field('travel_for_good_title');
	$travel_for_good_text = get_field('travel_for_good_text');
	$travel_for_good_items = get_field('travel_for_good_items');
	//Homepage Builder
	$home_section_builder = get_field('home_section_builder');
}
?>

	<main id="primary" class="site-main">
	<?php foreach($home_section_builder as $home_section_builder_item){ ?>
		<?php if($home_section_builder_item['section_type'] == 'Banner Area'){ ?>
			<div class="banner" style="background-image:url('<?php echo $home_section_builder_item['banner_area']['banner_image']['url'] ?>)">
				<div class="container">
					<h1><?php echo $home_section_builder_item['banner_area']['banner_title']; ?></h1>
					<h2><?php echo $home_section_builder_item['banner_area']['banner_tagline']; ?></h2>
					<a href="<?php echo $home_section_builder_item['banner_area']['banner_cta']['url'] ?>" class="cta-button"><?php echo $home_section_builder_item['banner_area']['banner_cta']['title'] ?></a>
					
				</div>
				<a href="#skip_banner" class="banner_arrow"><i class="fa-solid fa-angle-down"></i></a>
			</div>
			<div id="skip_banner"></div>
		<?php }elseif($home_section_builder_item['section_type'] == 'Featured Trip'){ ?>
			<section class="featured_trip">
				<div class="trip_body">
					<div class="trip_featured_image" style="background-image:url(<?php echo $home_section_builder_item['featured_trip']['featured_trip_group']['featured_trip_image']['url']; ?>)">
					</div>
					<div class="trip_details">
						<h2 class="featured_trip_title"><?php echo $home_section_builder_item['featured_trip']['featured_trip_title'] ?></h2>
						<h3><?php echo $home_section_builder_item['featured_trip']['featured_trip_group']['featured_trip_title'] ?></h3>
						<h4><?php echo $home_section_builder_item['featured_trip']['featured_trip_group']['featured_trip_destination'] ?></h4>
						<?php echo $home_section_builder_item['featured_trip']['featured_trip_group']['featured_trip_description'] ?>
						<strong class="trip_summary_details"><?php echo $home_section_builder_item['featured_trip']['featured_trip_group']['featured_trip_price'] ?></strong>
						<a href="<?php echo $home_section_builder_item['featured_trip']['featured_trip_group']['featured_trip_cta']['url'] ?>" class="cta-button"><?php echo $home_section_builder_item['featured_trip']['featured_trip_group']['featured_trip_cta']['title'] ?></a>
						<a href="<?php echo get_permalink(824) ?>" class="see_all_trips">See all available trips  <i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
			</section>
		<?php }elseif($home_section_builder_item['section_type'] == 'Trips for young Adults'){ ?>
			<section class="young_adult_trips">
				<div class="young_adult_trips_title"><h2><?php echo $home_section_builder_item['trips_for_young_adults']['trips_for_young_adults_title']; ?></h2></div>
				<div class="container">
					<ul class="young_adult_trips_list">
						<?php foreach($home_section_builder_item['trips_for_young_adults']['trips_for_young_adults'] as $trip_for_young_adults){ ?>
							<li class="young_adult_trip">
								<div class="young_adult_trip_image" style="background-image:url('<?php echo $trip_for_young_adults['trip_image']['url'] ?>')"></div>
								<div class="young_adult_trip_content">
									<h3><?php echo $trip_for_young_adults['trip_title'] ?></h3>
									<?php echo $trip_for_young_adults['trip_description'] ?>
									<a href="<?php echo $trip_for_young_adults['trip_cta']['url'] ?>" class="cta-button"><?php echo $trip_for_young_adults['trip_cta']['title'] ?></a>
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>
			</section>
		<?php }elseif($home_section_builder_item['section_type'] == 'Why Travel With Us'){ ?>
			<section class="why_travel_with_us">
				<div class="why_travel_title"><h2><?php echo $home_section_builder_item['why_travel_with_us']['why_travel_with_us_title'] ?></h2></div>
				<div class="container">
					<ul class="why_travel_list">
						<?php foreach($home_section_builder_item['why_travel_with_us']['why_travel_items'] as $why_travel_item){ ?>
							<li class="why_travel_item">
								<div class="why_travel_item_image" style="background-image:url('<?php echo $why_travel_item['why_travel_image']['url'] ?>')"></div>
								<h3><?php echo $why_travel_item['why_travel_title']; ?></h3>
								<a href="<?php echo $why_travel_item['why_travel_link']['url'] ?>" class=""><?php echo $why_travel_item['why_travel_link']['title'] ?> <i class="fa fa-arrow-right"></i></a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</section>
		<?php }elseif($home_section_builder_item['section_type'] == 'Content/Banner Combo'){ ?>
			<section class="who_are_we">
				<div class="who_are_we_wrap">
					<div class="who_are_we_content">
						<h2><?php echo $home_section_builder_item['contentbanner_combo']['contentbanner_combo_title']; ?></h2>
						<?php echo do_shortcode($home_section_builder_item['contentbanner_combo']['contentbanner_combo_text']); ?>
						<a href="<?php echo $home_section_builder_item['contentbanner_combo']['contentbanner_combo_cta']['url']; ?>" class="cta-button"><?php echo $home_section_builder_item['contentbanner_combo']['contentbanner_combo_cta']['title']; ?></a>
					</div>
					<?php if($home_section_builder_item['contentbanner_combo']['banner_type'] == 'Video Lightbox'){ ?>
					<div class="video_wrap" style="background-image:url('<?php echo $home_section_builder_item['contentbanner_combo']['contentbanner_combo_background']['url'] ?>')">
						<a href="<?php echo $home_section_builder_item['contentbanner_combo']['contentbanner_combo_youtube_link'] ?>" data-fancybox class="video_lightbox_link"><i class="fa fa-play"></i></a>
					</div>
					<?php }elseif($home_section_builder_item['contentbanner_combo']['banner_type'] == 'Carousel'){ ?>
					<div class="slider_wrap flexslider" style="">
						<ul class="slides">
							<?php foreach($home_section_builder_item['contentbanner_combo']['bespoke_travel_slider'] as $bespoke_travel_slider_item_new){ ?>

								<li class="slider_item" style="background-image:url('<?php echo $bespoke_travel_slider_item_new['bespoke_travel_slider_image']['url'] ?>')"><h2><?php echo $bespoke_travel_slider_item_new['bespoke_travel_slider_title']; ?></h2></li>
							<?php } ?>
						</ul>
					</div>
					<?php }elseif($home_section_builder_item['contentbanner_combo']['banner_type'] == 'Static Image'){ ?>
						<div class="video_wrap" style="background-image:url('<?php echo $home_section_builder_item['contentbanner_combo']['contentbanner_combo_background']['url'] ?>')">
						</div>
					<?php }elseif($home_section_builder_item['contentbanner_combo']['banner_type'] == 'Play In Frame Video'){ ?>
						<div class="video_wrap" style="background-image:url('<?php //echo $home_section_builder_item['contentbanner_combo']['contentbanner_combo_background']['url'] ?>')">
							<i class="fa fa-play play_banner_video"></i>
						<video poster="<?php echo $home_section_builder_item['contentbanner_combo']['video_file_thumbnail']['url']  ?>">
  <source src="<?php echo $home_section_builder_item['contentbanner_combo']['video_file']['url'] ?>" type="video/mp4">
  Your browser does not support the video tag.
</video></div>
					<?php } ?>
				</div>
			</section>
		<?php }elseif($home_section_builder_item['section_type'] == 'Testimonials Section'){ ?>
			<section class="testimonials_wrap">
				<div class="container">
					<div class="testimonials_text_wrap">
						<ul class="testimonials_list">
							<?php foreach($home_section_builder_item['testimonials_section']['testimonials'] as $testimonial){ ?>
								<li class="testimonials_list_item">
									<div class="testimonial_image" style="background-image:url('<?php echo $testimonial['testimonial_image']['url'] ?>')"></div>
									<div class="testimonial_text">
										<div class="testimonial_quote_icon_left"><i class="fa fa-quote-left"></i></div>
										<p><?php echo $testimonial['testimonial_text'] ?></p>
										<p class="testimonial_author"><?php echo $testimonial['testimonial_author'] ?></p>
										<div class="testimonial_quote_icon_right"><i class="fa fa-quote-right"></i></div>
									</div>
								</li>
							<?php } ?>
						</ul>
					</div>
					<div class="testimonials_video_wrap">
						<?php foreach($home_section_builder_item['testimonials_section']['testimonial_videos'] as $testimonial_video){ ?>
							<div class="testimonials_video_item" style="background-image:url('<?php echo $testimonial_video['testimonial_video_background']['url']; ?>');"><a data-fancybox href="<?php echo $testimonial_video['testimonial_link'] ?>" class="play_video_testimonials"><i class="fa fa-play"></i></a></div>
						<?php } ?>
					</div>
				</div>
				<div class="testimonials_cta"><a href="<?php echo get_permalink(2349) ?>">Read what other travelers are saying <i class="fa fa-arrow-right"></i></a></div>
			</section>
		<?php }elseif($home_section_builder_item['section_type'] == 'Travel For Good'){ ?>
			<section class="travel_for_good">
				<div class="travel_for_good_title"><h2><?php echo $home_section_builder_item['travel_for_good']['travel_for_good_title'] ?></h2><p><?php echo $home_section_builder_item['travel_for_good']['travel_for_good_text'] ?></p></div>
				<div class="container">
					<ul class="travel_for_good_list">
						<?php foreach($home_section_builder_item['travel_for_good']['travel_for_good_items'] as $travel_for_good_item){ ?>
							<li class="travel_for_good_item">
								<div class="travel_for_good_item_image" style="background-image:url('<?php echo $travel_for_good_item['travel_for_good_item_image']['url'] ?>')"></div>
								<h3><?php echo $travel_for_good_item['travel_for_good_item_title'] ?></h3>
								<p><?php echo $travel_for_good_item['travel_for_good_item_text'] ?></p>
								<?php if($travel_for_good_item['travel_for_good_item_link']['url']){ ?><a href="<?php echo $travel_for_good_item['travel_for_good_item_link']['url'] ?>"><?php echo $travel_for_good_item['travel_for_good_item_link']['title'] ?> <i class="fa fa-arrow-right"></i></a><?php } ?>
							</li>
						<?php } ?>
					</ul>
				</div>
			</section>
		<?php }elseif($home_section_builder_item['section_type'] == 'Latest Blogs'){ ?>
			
		<section class="latest_from_us">
			<div class="container">
				<div class="latest_post_header">
					<h2>Stories from Us</h2>
				</div>
				<ul class="lastest_posts_list">
					<?php 
					$args = array( 
						'post_type'   => 'post',
						'post_status' => 'publish',
						'posts_per_page' => 3
					);
					$latest_from_us = new WP_Query( $args );

					if ( $latest_from_us->have_posts() ) : 
					?>
						<?php while( $latest_from_us->have_posts() ) : $latest_from_us->the_post() ?>
							<li class="lastest_posts_list_item">
								<div class="lastest_post_item_thumb" style="background-image:url(<?php echo get_the_post_thumbnail_url() ?>)"></div>
								<div class="latest_post_item_text">
									<h3><?php echo get_the_title(); ?></h3>
									<p><?php echo get_the_excerpt(); ?></p>
									<a href="<?php echo get_the_permalink(); ?>">Read more <i class="fa fa-arrow-right"></i></a>
								</div>
							</li>
						<?php endwhile;wp_reset_postdata(); ?>
					<?php else : ?>
						<!-- Content If No Posts -->
					<?php endif ?>
				</ul>
				<div class="testimonials_cta"><a href="<?php echo get_permalink(7) ?>">Explore more stories, news, and travel tips <i class="fa fa-arrow-right"></i></a></div>
			</div>
		</section>
		<?php } ?>
	<?php } ?>
	<?php if(false){ ?>
		<div class="banner" style="background-image:url('<?php echo $banner_image['url'] ?>)">
			<div class="container">
				<h1><?php echo $banner_title; ?></h1>
				<h2><?php echo $banner_tagline; ?></h2>
			</div>
		</div>
		<section class="featured_trip">
			<div class="featured_trip_title">
				<h2>Featured Trip</h2>
			</div>
			<div class="trip_body">
				<div class="trip_featured_image" style="background-image:url(<?php echo $featured_trip['featured_trip_image']['url']; ?>)">
				</div>
				<div class="trip_details">
					<h3><?php echo $featured_trip['featured_trip_title'] ?></h3>
					<h4><?php echo $featured_trip['featured_trip_destination'] ?></h4>
					<p><?php echo $featured_trip['featured_trip_description'] ?></p>
					<strong class="trip_summary_details"><?php echo $featured_trip['featured_trip_price'] ?></strong>
					<a href="<?php echo $featured_trip['featured_trip_cta']['url'] ?>" class="cta-button"><?php echo $featured_trip['featured_trip_cta']['title'] ?></a>
					<a href="#" class="see_all_trips">See all available trips <i class="fa fa-arrow-right"></i></a>
				</div>
			</div>
		</section>
		<section class="young_adult_trips">
			<div class="young_adult_trips_title"><h2><?php echo $trips_for_young_adults_title; ?></h2></div>
			<div class="container">
				<ul class="young_adult_trips_list">
					<?php foreach($trips_for_young_adults as $trip_for_young_adults){ ?>
						<li class="young_adult_trip">
							<div class="young_adult_trip_image" style="background-image:url('<?php echo $trip_for_young_adults['trip_image']['url'] ?>')"></div>
							<div class="young_adult_trip_content">
								<h3><?php echo $trip_for_young_adults['trip_title'] ?></h3>
								<p class="young_adult_trip_details"><?php echo $trip_for_young_adults['trip_description'] ?></p>
								<a href="<?php echo $trip_for_young_adults['trip_cta']['url'] ?>" class="cta-button"><?php echo $trip_for_young_adults['trip_cta']['title'] ?></a>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</section>
		<section class="why_travel_with_us">
			<div class="why_travel_title"><h2>Why Travel With Us</h2></div>
			<div class="container">
				<ul class="why_travel_list">
					<?php foreach($why_travel_items as $why_travel_item){ ?>
						<li class="why_travel_item">
							<div class="why_travel_item_image" style="background-image:url('<?php echo $why_travel_item['why_travel_image']['url'] ?>')"></div>
							<h3><?php echo $why_travel_item['why_travel_title']; ?></h3>
							<a href="<?php echo $why_travel_item['why_travel_link']['url'] ?>" class=""><?php echo $why_travel_item['why_travel_link']['title'] ?> <i class="fa fa-arrow-right"></i></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</section>
		<section class="who_are_we">
			<div class="who_are_we_wrap">
				<div class="who_are_we_content">
					<h2><?php echo $who_are_we_title; ?></h2>
					<?php echo do_shortcode($who_are_we_text); ?>
					<a href="<?php echo $who_are_we_cta['url']; ?>" class="cta-button"><?php echo $who_are_we_cta['title']; ?></a>
				</div>
				<div class="video_wrap" style="background-image:url('<?php echo $who_are_we_video_background['url'] ?>')">
					<a href="<?php echo $who_are_we_video_youtube_link ?>" data-fancybox class="video_lightbox_link"><i class="fa fa-play"></i></a>
				</div>
			</div>
		</section>
		<section class="testimonials_wrap">
			<div class="container">
				<div class="testimonials_text_wrap">
					<ul class="testimonials_list">
						<?php foreach($testimonials as $testimonial){ ?>
							<li class="testimonials_list_item">
								<div class="testimonial_image" style="background-image:url('<?php echo $testimonial['testimonial_image']['url'] ?>')"></div>
								<div class="testimonial_text">
									<div class="testimonial_quote_icon"><i class="fa fa-quote-left"></i></div>
									<p><?php echo $testimonial['testimonial_text'] ?></p>
									<p class="testimonial_author"><?php echo $testimonial['testimonial_author'] ?></p>
								</div>
							</li>
						<?php } ?>
					</ul>
					<div class="testimonials_cta"><a href="#">Read what other travelers are saying <i class="fa fa-arrow-right"></i></a></div>
				</div>
				<div class="testimonials_video_wrap">
					<?php foreach($testimonial_videos as $testimonial_video){ ?>
						<div class="testimonials_video_item" style="background-image:url('<?php echo $testimonial_video['testimonial_video_background']['url']; ?>');"><a data-fancybox href="<?php echo $testimonial_video['testimonial_link'] ?>" class="play_video_testimonials"><i class="fa fa-play"></i></a></div>
					<?php } ?>
				</div>
			</div>
		</section>
		<section class="latest_from_us">
			<div class="container">
				<div class="latest_post_header">
					<h2>Latest From Us</h2>
					<strong><a href="#">Explore More Stories, news, and travel tips <i class="fa fa-arrow-right"></i></a></strong>
				</div>
				<ul class="lastest_posts_list">
					<?php 
					$args = array( 
						'post_type'   => 'post',
						'post_status' => 'publish',
						'posts_per_page' => 3
					);
					$latest_from_us = new WP_Query( $args );

					if ( $latest_from_us->have_posts() ) : 
					?>
						<?php while( $latest_from_us->have_posts() ) : $latest_from_us->the_post() ?>
							<li class="lastest_posts_list_item">
								<div class="lastest_post_item_thumb" style="background-image:url(<?php echo get_the_post_thumbnail_url() ?>)"></div>
								<div class="latest_post_item_text">
									<h3><?php echo get_the_title(); ?></h3>
									<p><?php echo get_the_excerpt(); ?></p>
									<a href="<?php echo get_the_permalink(); ?>">Read more <i class="fa fa-arrow-right"></i></a></p>
								</div>
							</li>
						<?php endwhile;wp_reset_postdata(); ?>
					<?php else : ?>
						<!-- Content If No Posts -->
					<?php endif ?>
				</ul>
			</div>
		</section>
		<section class="bespoke_travel">
			<div class="bespoke_travel_wrap">
				<div class="bespoke_travel_content">
					<h2><?php echo $bespoke_travel_title ?></h2>
					<?php echo do_shortcode($bespoke_travel_text) ?>
					<a href="<?php echo $bespoke_travel_cta['url'] ?>" class="button"><?php echo $bespoke_travel_cta['title'] ?></a>
				</div>
				<div class="slider_wrap flexslider" style="">
					<ul class="slides">
						<?php foreach($bespoke_travel_slider as $bespoke_travel_slider_item){ ?>
							<li class="slider_item" style="background-image:url('<?php echo $bespoke_travel_slider_item['bespoke_travel_slider_image']['url'] ?>')"><h2><?php echo $bespoke_travel_slider_item['bespoke_travel_slider_title'] ?></h2></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</section>
		<section class="travel_for_good">
			<div class="travel_for_good_title"><h2>Travel for Good</h2><p><?php echo $travel_for_good_text ?></p></div>
			<div class="container">
				<ul class="travel_for_good_list">
					<?php foreach($travel_for_good_items as $travel_for_good_item){ ?>
						<li class="travel_for_good_item">
							<div class="travel_for_good_item_image" style="background-image:url('<?php echo $travel_for_good_item['travel_for_good_item_image']['url'] ?>')"></div>
							<h3><?php echo $travel_for_good_item['travel_for_good_item_title'] ?></h3>
							<p><?php echo $travel_for_good_item['travel_for_good_item_text'] ?></p>
							<a href="<?php echo $travel_for_good_item['travel_for_good_item_link']['url'] ?>"><?php echo $travel_for_good_item['travel_for_good_item_link']['title'] ?> <i class="fa fa-arrow-right"></i></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</section>
		<?php } ?>
		<div class="container">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php
					the_content();
					?>
				</div>
			</article>
		</div>
	</main><!-- #main -->
<section class="subscription_section">
			<div class="subscribe_title_area">
				<h2>Just Go!</h2>
			</div>
			<div class="subscribe_form">
				<div>
					<h2>Subscribe to our newsletter for great deals, trends and travel tips!</h2>
					<?php echo do_shortcode('[contact-form-7 id="cbea9ad" title="Subscribe Form"]'); ?>
					<p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
				</div>
			</div>
		</section>
		<section class="footer_cta">
			<h2>Want to Get in Touch?</h2>
			<a href="<?php echo get_permalink(11601) ?>" class="cta-button">CONTACT US</a>
		</section>
		<section class="connect_with_us">
			<div class="connect_with_us_header_wrap">
				<h2 class="connect_header">Connect with Us</h2>
			</div>
			<?php if(function_exists('get_field')){
				$social_links = get_field('social_links','options');
			} ?>
			<ul class="connect_links">
				
				<?php foreach($social_links as $social_link){ ?>
				<li><a class="connect_link" href="<?php echo $social_link['social_link_url'] ?>" target="_blank"><img src="<?php echo $social_link['social_link_image']['url'] ?>"></a></li>
				<?php } ?>
			</ul>
		</section>
<?php
get_footer();
