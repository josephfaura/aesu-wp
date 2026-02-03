<?php
/**
 * Single Tours Bespoke Template
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<?php if ( have_posts() ) : the_post(); ?>

<?php
// Always use the CURRENT tours post
$tour_id = get_the_ID();

// ACF fields (only if ACF exists)
if ( function_exists('get_field') ) {
	$trip_name                      = get_field('trip_name', $tour_id);
	$destinations                   = get_field('destinations', $tour_id);
	$description                    = get_field('description', $tour_id);
	$main_trip_content              = get_field('main_trip_content', $tour_id);
	$experiences                    = get_field('experiences', $tour_id);
	$level                          = (int) get_field('activity_level', $tour_id);
	$cta_button		                = get_field('cta_button', $tour_id);
	$tour_trip_highlights_title     = get_field('trip_highlights_title', $tour_id);
	$trip_highlights                = get_field('trip_highlights', $tour_id);
	$whats_included_title           = get_field('whats_included_title', $tour_id);
	$whats_included_accordion       = get_field('highlight_accordion', $tour_id);
	$additional_whats_included_text = get_field('additional_whats_included_text', $tour_id);
	$whats_included_image           = get_field('whats_included_image', $tour_id);
	$itinerary_title                = get_field('itinerary_title', $tour_id);
	$itinerary_items                = get_field('itinerary_items', $tour_id);
	$hotels_title                   = get_field('hotels_title', $tour_id);
	$hotels_content                 = get_field('hotels_content', $tour_id);
	$hotels_items                   = get_field('hotels_items', $tour_id);
	$trip_options_title             = get_field('trip_options_title', $tour_id);
	$trip_options_content           = get_field('trip_options_content', $tour_id);
	$trip_option_items              = get_field('trip_option_items', $tour_id);
	$travel_tools                   = get_field('travel_tools', $tour_id);
	$deals_popup                    = get_field('deals_popup', $tour_id);
}
?>

<style>
	/* Bespoke hooks: style safely without impacting standard tours */
	.single-tours.tour--bespoke {color:#323232;background:#fafafa;}
	.single-tours.tour--bespoke h3,
	.single-tours.tour--bespoke h4 {color:#323232;}
	.single-tours .tour--bespoke a {color:#323232; font-weight:700}
	.single-tours .tour--bespoke a:hover {color:#5e5e5e;}

	.single-tours.tour--bespoke .trip_main_content {background:#f2f2f2;}
	.single-tours.tour--bespoke #page section.trip_main_content_wrap{padding:0; }

	/*.single-tours.tour--bespoke .trip_cta_list { justify-content:center; }
	.single-tours.tour--bespoke .trip_cta_list > *:last-child { margin-left:0; }*/
	.single-tours.tour--bespoke .experiences {margin-top:1rem;}
	.activity-box.active {background: #323232}
	
	/* If you don't want sticky header on bespoke, keep header static */
	.single-tours.tour--bespoke header{ position:static; }

	.single-tours.tour--bespoke .trip_header{
		padding:1rem 56px;
		margin-top:0;
		position:sticky;
		top:0;
		background-color:#fff;
		border-bottom: 1px solid #dbdbdb;
		box-shadow:0px 3px 10px rgba(0,0,0,.15);
		z-index:9999;
		display: flex;
		align-items: center;
		justify-content: space-between;
	}
	h2.trip_name {margin:0}

	.mobile_cta{
		display:none;
	}
	.button_cta{
		display:inline-block;
		text-align: center;
		white-space: nowrap;

		font-size: 1.25rem;
		font-weight: 500 !important;
		color:#323233 !important;
		border: 2px solid #323232;
		border-radius: 8px;
		box-shadow: 0;
		background-color: transparent;
		padding: .8rem 1.6rem;
	}
	.button_cta:hover{background-color: #fafafa; border: 2px solid #5e5e5e !important; color: #5e5e5e !important}

	.single-tours.tour--bespoke li.slick-slide {background: #fff}

	.single-tours.tour--bespoke .whats_included_accordion_section h3{ max-width:calc(100% - 109px); }
	.single-tours.tour--bespoke .accordion_item{ clear:both; background: #fff}
	.accordion_trigger, .accordion_trigger .collapsed_indicator i {color:#323232;}
	.single-tours.tour--bespoke .slick-next{ right:-14px; }
	.single-tours.tour--bespoke .whats_included_accordion_section{ margin-bottom:32px }
	.single-tours.tour--bespoke .whats_included_image {
	    background: #f2f2f2;
	    border: 1px solid #dbdbdb;
	}	
	.single-tours.tour--bespoke .itinerary_image{
		max-width:300px;
		width:100%;
	}

	.hotel_location {
		color: #323232;
	}
	.highlight_location_days {
		font-size: 12px;
	    font-weight: 600;
	    letter-spacing: .05em;
	    text-transform: uppercase;
	}

	@media screen and (max-width:976px){
		.single-tours.tour--bespoke .trip_header {
			justify-content: center;
			padding: 24px 32px;
		}
		.trip_header_right {
			display: none;
		}
		.mobile_cta {
        display: block;
        padding: 24px 24px 32px 24px !important;
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 9999999;
        background-color: #fff;
        border-top:1px solid #dbdbdb;
		box-shadow:0px -3px 10px rgba(0,0,0,.15);
    	}
		.mobile_cta .button_cta{
			font-size: 1.25rem;
			font-weight: 500;
			width:100%;
		}
		.mobile_cta .button_cta:hover,
		.mobile_cta .button_cta:active,
		.mobile_cta .button_cta:focus {background-color: #fafafa; border: 2px solid #5e5e5e !important; color: #5e5e5e !important}

	   #chat-widget-push-to-talk {
			bottom:130px !important;
		}
		.trip_name, .trip_destination_info{
			text-align: center !important;
		}
	}

	@media screen and (max-width:686px){
		.trip_name {
			font-size: 2rem;
		}
		.trip_destination_info {
			font-size: 100%;
		}
		.accordion_content {
			padding: 20px 30px;
		}
		.itinerary_image {
		    max-width: 100%;
		    height: 300px;
		    /*float: none;*/
		    width: 100%;
		    margin: 0;
		}
	}
	@media screen and (max-width:420px){
		.mobile_cta .red_button_cta {
			font-size: 14px;
		}
		.trip_days_price {
        font-size: 80%;
    }
    .trip_name {
    	font-size: 2em;
    }
	}
	@media screen and (max-width: 320px) {
		.inner-header {
			flex-direction: column !important;
		}
    .mobile_cta {
    	display: block;
    }
    .trip_days_price {
       margin-bottom: .5rem;
    .red_button_cta{
			white-space: wrap;
		}
	}
</style>

<section class="mobile_cta">
	<div class="trip_days_price"><?php echo $days_price; ?></div>
	<a href="<?php echo $cta_button['url'] ?>" class="button_cta" target="_blank"><?php echo $cta_button['title'] ?></a>
</section>

<?php if ( ! post_password_required() ) : ?>

	<?php if ( is_user_logged_in() ) : ?>
		<style>
			.single-tours.tour--bespoke .trip_header{ top:32px; }

			@media screen and (max-width: 782px) {
				.single-tours.tour--bespoke .trip_header{ top:46px; }
			}
		</style>
	<?php endif; ?>

	<div class="tour--bespoke">

	<section class="trip_header">
		<div class="trip_header_left">
			<h2 class="trip_name"><?php echo $trip_name ?></h2>
			<h4 class="trip_destination_info"><?php echo $destinations; ?></h4>
		</div>
		<div class="trip_header_right">
			<div class="trip_days_price"><?php echo $days_price; ?></div>
			<a href="<?php echo $cta_button['url'] ?>" class="button_cta" target="_blank"><?php echo $cta_button['title'] ?></a>
			</div>
	</section>

		<section class="trip_main_content_wrap">
			<div class="trip_main_image" style="background-image:url(<?php echo esc_url( get_the_post_thumbnail_url( $tour_id, 'full' ) ); ?>);"></div>

			<div class="trip_main_content">
				<?php if ( !empty($trip_name) || !empty($destinations) ) : ?>
					<h2><?php echo esc_html( $trip_name ); ?></h2>
					<div class="trip_dates"><?php echo wp_kses_post( $destinations ); ?></div>
				<?php endif; ?>

				<div class="trip_main_content_text">
					<?php echo do_shortcode( wp_kses_post( $description ) ); ?>
					<?php echo do_shortcode( wp_kses_post( $main_trip_content ) ); ?>
				</div>

				<?php if ( !empty($experiences) || !empty($level) ) : ?>

					<div class="experiences">

						<?php if ( !empty($experiences) && is_array($experiences) ) : ?>
							<div class="experiences-grid">
								<strong>
									<a href="<?php echo esc_url( get_permalink(11625) ); ?>" target="_blank" rel="noopener">
										Trip Experiences:
									</a>
								</strong>

								<?php foreach ( $experiences as $experience_icon_class ) : ?>
									<i class="<?php echo esc_attr( $experience_icon_class ); ?>"></i>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( !empty($level) && (int) $level > 0 ) : ?>
							<div class="experiences-grid">
								<strong>Activity Level:</strong>

								<?php
									$level_int = min( 5, max( 0, (int) $level ) );
									for ( $i = 1; $i <= 5; $i++ ) :
								?>
									<div class="activity-box <?php echo ( $i <= $level_int ) ? 'active' : ''; ?>">
										<?php echo (int) $i; ?>
									</div>
								<?php endfor; ?>
							</div>
						<?php endif; ?>

					</div>

				<?php endif; ?>

				<!--<ul class="list--unstyled trip_cta_list">
					<li class="travel_tools"><a href="#">Travel Tools</a></li>
					<li class="deals_cta"><a href="#">Deals</a></li>
				</ul>-->
			</div>
		</section>

		<section class="tour_area">

			<?php if ( !empty($trip_highlights) ) : ?>
			<div class="trip_highlights">
				<h2><?php echo esc_html( $tour_trip_highlights_title ); ?></h2>
				<ul class="trip_highlight_items">
					<?php foreach ( $trip_highlights as $trip_highlight ) :
						$highlight_image       = $trip_highlight['highlight_image'] ?? null;
						$highlight_title       = $trip_highlight['highlight_title'] ?? '';
						$highlight_location    = $trip_highlight['highlight_location'] ?? '';
						$highlight_stars       = (int) ($trip_highlight['highlight_stars'] ?? 0);
						$highlight_description = $trip_highlight['highlight_description'] ?? '';
					?>
						<li>
							<div class="trip_highlights_image" style="background-image:url('<?php echo esc_url( $highlight_image['url'] ?? '' ); ?>');"></div>
							<div class="trip_highlights_content">
								<h3><?php echo esc_html( $highlight_title ); ?></h3>
								<div class="highlight_location_days"><?php echo wp_kses_post( $highlight_location ); ?></div>

								<div class="highlight_stars">
									<?php for ( $i = 0; $i < $highlight_stars; $i++ ) : ?>
										<i class="fa-solid fa-star"></i>
									<?php endfor; ?>
								</div>

								<div class="trip_highlight_content">
									<?php echo wp_kses_post( $highlight_description ); ?>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<?php if ( !empty($whats_included_accordion) ) : ?>
			<div class="whats_included">
				<h2><?php echo esc_html( $whats_included_title ); ?></h2>
				<div class="whats_included_content_wrap">
					<div class="whats_included_content">

						<?php foreach ( $whats_included_accordion as $section ) :
							$section_title = $section['whats_included_title'] ?? '';
							$rows          = $section['accordion_items'] ?? [];
							$is_open       = (($section['expand_all'] ?? '') !== "False");
						?>
							<div class="whats_included_accordion_section">
								<h3><?php echo esc_html( $section_title ); ?></h3>

								<ul>
									<?php if ( $rows && is_array($rows) ) : foreach ( $rows as $row ) : ?>
										<li class="accordion_item">
											<div class="accordion_trigger">
												<?php echo wp_kses_post( $row['accordion_trigger_text'] ?? '' ); ?>
												<span class="collapsed_indicator" aria-hidden="true">
													<i class="fa-solid <?php echo $is_open ? 'fa-minus' : 'fa-plus'; ?>"></i>
												</span>
											</div>
											<div class="accordion_content" style="display:<?php echo $is_open ? 'block' : 'none'; ?>">
												<?php echo wp_kses_post( $row['accordion_content'] ?? '' ); ?>
											</div>
										</li>
									<?php endforeach; endif; ?>
								</ul>
							</div>
						<?php endforeach; ?>

						<?php if ( !empty($additional_whats_included_text) ) : ?>
							<div class="additional_whats_included_text">
								<?php echo do_shortcode( wp_kses_post( $additional_whats_included_text ) ); ?>
							</div>
						<?php endif; ?>

					</div>

					<?php if ( !empty($whats_included_image['url']) ) : ?>
						<div class="whats_included_image">
							<img src="<?php echo esc_url( $whats_included_image['url'] ); ?>" alt="">
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( !empty($itinerary_items) ) : ?>
			<div class="itinerary">
				<h2><?php echo esc_html( $itinerary_title ); ?></h2>

				<div style="position:relative;height:40px;" class="accordion_collapse_wrap">
					<a href="#" class="toggle_all_trigger">Expand All <i class="fa-solid fa-plus"></i></a>
				</div>

				<ul>
					<?php foreach ( $itinerary_items as $itinerary_item ) :
						$default_expand = ($itinerary_item['default_expand'] ?? '') !== "False";
					?>
						<li class="accordion_item">
							<div class="itinerary_item_content">
								<div class="accordion_trigger" style="position:relative;">
									<?php echo wp_kses_post( $itinerary_item['itinerary_trigger_text'] ?? '' ); ?>
									<span class="collapsed_indicator">
										<i class="fa-solid <?php echo $default_expand ? 'fa-minus' : 'fa-plus'; ?>"></i>
									</span>
								</div>

								<div class="accordion_content" style="display:<?php echo $default_expand ? 'block' : 'none'; ?>">
									<div class="itinerary_text">
										<?php echo wp_kses_post( $itinerary_item['itinerary_content'] ?? '' ); ?>
									</div>

									<?php if ( !empty($itinerary_item['itinerary_image']['url']) ) : ?>
										<div class="itinerary_image" style="background-image:url('<?php echo esc_url( $itinerary_item['itinerary_image']['url'] ); ?>');"></div>
									<?php endif; ?>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<?php if ( !empty($hotels_items) || !empty($hotels_content) ) : ?>
			<div class="hotels" style="clear:both;">
				<h2><?php echo esc_html( $hotels_title ); ?></h2>

				<?php if ( !empty($hotels_content) ) : ?>
					<div class="hotels_content">
						<?php echo do_shortcode( wp_kses_post( $hotels_content ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( !empty($hotels_items) ) : ?>
					<ul class="hotels_slider">
						<?php foreach ( $hotels_items as $hotels_item ) : ?>
							<li>
								<div class="hotel_item_image" style="background-image:url('<?php echo esc_url( $hotels_item['hotel_item_image']['url'] ?? '' ); ?>');"></div>
								<div class="hotel_content_wrap">
									<h3><?php echo esc_html( $hotels_item['hotel_title'] ?? '' ); ?></h3>
									<div>
										<span class="hotel_location"><?php echo wp_kses_post( $hotels_item['hotel_location'] ?? '' ); ?></span>
										<span class="hotel_stars">
											<?php for ( $i=0; $i < (int)($hotels_item['hotel_stars'] ?? 0); $i++ ) : ?>
												<i class="fa-solid fa-star"></i>
											<?php endfor; ?>
										</span>
									</div>
									<div class="hotel_content">
										<?php echo wp_kses_post( $hotels_item['hotels_content'] ?? '' ); ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( !empty($trip_option_items) || !empty($trip_options_content) ) : ?>
			<div class="trip_options">
				<h2><?php echo esc_html( $trip_options_title ); ?></h2>

				<?php if ( !empty($trip_options_content) ) : ?>
					<div class="trip_options_content">
						<?php echo do_shortcode( wp_kses_post( $trip_options_content ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( !empty($trip_option_items) ) : ?>
					<ul class="trip_options_slider">
						<?php foreach ( $trip_option_items as $trip_option_item ) : ?>
							<li>
								<div class="trip_options_item_image" style="background-image:url('<?php echo esc_url( $trip_option_item['trip_option_image']['url'] ?? '' ); ?>');"></div>
								<div class="trip_options_wrap">
									<h3><?php echo esc_html( $trip_option_item['trip_option_title'] ?? '' ); ?></h3>
									<div>
										<span class="trip_options_price"><?php echo wp_kses_post( $trip_option_item['trip_option_price'] ?? '' ); ?></span>
										<span class="hotel_stars">
											<?php for ( $i=0; $i < (int)($trip_option_item['trip_option_stars'] ?? 0); $i++ ) : ?>
												<i class="fa-solid fa-star"></i>
											<?php endfor; ?>
										</span>
									</div>
									<div class="trip_option_item_content">
										<?php if ( !empty($trip_option_item['trip_options_content']) ) : ?>
											<?php echo do_shortcode( wp_kses_post( $trip_option_item['trip_options_content'] ) ); ?>
										<?php endif; ?>

										<?php if ( !empty($trip_option_item['more_info']['url']) ) : ?>
											<a href="<?php echo esc_url( $trip_option_item['more_info']['url'] ); ?>"
											   target="<?php echo esc_attr( $trip_option_item['more_info']['target'] ?? '_self' ); ?>">
												<?php echo esc_html( $trip_option_item['more_info']['title'] ?? 'More Info' ); ?>
												<i class="fa fa-arrow-right"></i>
											</a>
										<?php endif; ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</section>

		<!-- Tours editor content (classic editor / blocks) -->
		<main>
			<div class="container">
				<article class="full-width" style="width:100%;max-width:100%;">
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<div class="entry">
							<?php the_content(); ?>
						</div>
					</div>
				</article>
			</div>
		</main>

		<?php if ( !empty($deals_popup) ) : ?>
			<div class="tour_deals_popup_wrap">
				<div class="tour_deals_popup_inner">
					<div class="popup_outline">
						<a href="#" class="tour_deals_close_popup"><i class="fa-solid fa-xmark"></i></a>
						<div class="tour_deals_popup_content">
							<?php echo do_shortcode( $deals_popup ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( !empty($travel_tools) ) : ?>
			<div class="travel_tools_popup_wrap">
				<div class="travel_tools_popup_inner">
					<div class="popup_outline">
						<a href="#" class="travel_tools_close_popup"><i class="fa-solid fa-xmark"></i></a>
						<div class="travel_tools_popup_content">
							<?php echo do_shortcode( $travel_tools ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

	</div><!-- /.tour--bespoke -->

<?php endif; // !post_password_required ?>

<div class="container">
	<div id="back_to_top" class="back-to-top-inline">
		<i class="fa-solid fa-angle-up"></i>
	</div>
</div>

<?php else : ?>

	<main>
		<div class="container">
			<?php echo get_the_password_form(); ?>
		</div>
	</main>

<?php endif; ?>

<?php get_footer(); ?>