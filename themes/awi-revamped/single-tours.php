<?php
/**
 * Single Tours Template
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
	$trip_name                     = get_field('trip_name', $tour_id);
	$destinations                  = get_field('destinations', $tour_id);
	$description                   = get_field('description', $tour_id);
	$main_trip_content             = get_field('main_trip_content', $tour_id);
	$experiences                   = get_field('experiences', $tour_id);
	$level                         = (int) get_field('activity_level', $tour_id);
	$tour_trip_highlights_title    = get_field('trip_highlights_title', $tour_id);
	$trip_highlights               = get_field('trip_highlights', $tour_id);
	$whats_included_title          = get_field('whats_included_title', $tour_id);
	$whats_included_accordion      = get_field('highlight_accordion', $tour_id);
	$additional_whats_included_text= get_field('additional_whats_included_text', $tour_id);
	$whats_included_image          = get_field('whats_included_image', $tour_id);
	$interactive_map 			   = get_field('interactive_map', $tour_id);
    $itinerary_title               = get_field('itinerary_title', $tour_id);
	$itinerary_items               = get_field('itinerary_items', $tour_id);
	$hotels_title                  = get_field('hotels_title', $tour_id);
	$hotels_content                = get_field('hotels_content', $tour_id);
	$hotels_items                  = get_field('hotels_items', $tour_id);
	$trip_options_title            = get_field('trip_options_title', $tour_id);
	$trip_options_content          = get_field('trip_options_content', $tour_id);
	$trip_option_items             = get_field('trip_option_items', $tour_id);
	$travel_tools                  = get_field('travel_tools', $tour_id);
	$deals_popup                   = get_field('deals_popup', $tour_id);
}
?>

<style>
	.trip_cta_list { justify-content:center; }
	.trip_cta_list > *:last-child { margin-left:0; }
	.experiences { justify-content:center; }
	.whats_included_accordion_section h3{ max-width:calc(100% - 109px); }
	#page section.trip_main_content_wrap{ text-align:center; padding:0; }
	.tour_deals_popup_content a, .tour_deals_popup_content strong{ margin:0!important; display:inline!important; }
	header{ position:static; }
	.single-tours .trip_header{
		padding:.67em;
		position:sticky;
		top:0;
		background-color:#fff;
		box-shadow:0px 3px 10px rgba(0,0,0,.25);
		z-index:9999;
	}
	/*.single-tours h1{ margin:.67em !important; }*/
	.accordion_item{ clear:both; }
	.slick-next{ right:-14px; }
	.whats_included_accordion_section{ margin-bottom:32px }
	/*.itinerary_image{
		max-width:300px;
		width:100%;
	}*/
	@media screen and (max-width: 976px){
		#chat-widget-push-to-talk{ bottom:130px !important; }
	}
</style>

<?php if ( ! post_password_required() ) : ?>

	<?php if ( is_user_logged_in() ) : ?>
		<style>
			.single-tours .trip_header{ top:32px; }

			@media screen and (max-width: 782px) {
				.single-tours .trip_header{ 
					top:46px;
				}
			}
		</style>
	<?php endif; ?>

	<section class="trip_header">
		<h1><?php the_title(); ?></h1>
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

			<ul class="list--unstyled trip_cta_list">
				<li class="travel_tools"><a href="#">Travel Tools</a></li>
				<li class="deals_cta"><a href="#">Deals</a></li>
			</ul>
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

							<!-- make this label simple; JS will sync it -->
							<a href="#" class="toggle_all_trigger">Expand All <i class="fa-solid fa-plus"></i></a>

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

				<?php
				$stops = get_field('itinerary_stops', $tour_id);

				$route_points = [];

				if (is_array($stops)) {
				  foreach ($stops as $stop) {
				    $loc = $stop['stop_location'] ?? null;

				    // Expecting Raw data return format from the OpenStreetMap field
				    $lat = is_array($loc) ? ($loc['lat'] ?? null) : null;
				    $lng = is_array($loc) ? ($loc['lng'] ?? null) : null;

				    if ($lat !== null && $lng !== null) {
				      $route_points[] = [
				        'lat'   => (float) $lat,
				        'lng'   => (float) $lng,
				        'title' => (string) ($stop['stop_title'] ?? ''),
				        'popup' => (string) ($stop['stop_popup'] ?? ''),
				      ];
				    }
				  }
				}

				$has_route = count($route_points) >= 1;
				$map_id = 'wi-map-' . (int) $tour_id;

				$pin_url = get_stylesheet_directory_uri() . '/img/location-icon.svg';
				?>

				<div class="whats_included_image">
				  <?php if ($has_route) : ?>
				    <div class="whats_included_map">
				      <div
				        id="<?php echo esc_attr($map_id); ?>"
				        class="wi-map-canvas"
				        data-route="<?php echo esc_attr(wp_json_encode($route_points)); ?>"
				        data-pin="<?php echo esc_attr($pin_url); ?>"
				      ></div>
				    </div>
				  <?php else : ?>
				    <img src="<?php echo esc_url($whats_included_image['url'] ?? ''); ?>"
				         alt="<?php echo esc_attr($whats_included_image['alt'] ?? ''); ?>">
				  <?php endif; ?>
				</div>
				
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