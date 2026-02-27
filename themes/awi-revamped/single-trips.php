<?php
/**
 * Single Trips Template
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php
// ----------------------------------------------------
// 1) Preview-safe Trip ID
// ----------------------------------------------------
 $trip_id = get_the_ID();

if ( is_preview() ) {
  // Gutenberg preview URLs usually include preview_id
  $preview_id = isset($_GET['preview_id']) ? (int) $_GET['preview_id'] : 0;
  if ( $preview_id > 0 ) {
    $trip_id = $preview_id;
  }
}
// ----------------------------------------------------
// 2) Load Trip Fields (ALWAYS from $trip_id)
// ----------------------------------------------------
$days_price = $cta_button = $trip_dates = $trip_departure = '';
$e_brochure_link = $webinar_link = '';
$show_webinar_link = false;
$additional_link = null;

$trip_name = $citiescountries = '';
$hero_image = null;
$main_trip_content = '';
$travel_tools = '';
$deals_popup = '';

$trip_hero_image_text_url = '';
$toc_info = '';
$school_shortcode = '';

$school = null; // Post Object
$tour   = null; // Post Object
$school_id = 0;
$tour_id   = 0;

$school_logo = null;
$school_logo_background = '';
$primary_color = '';

$description = '';
$tour_trip_highlights_title = '';
$trip_highlights = [];
$whats_included_title = '';
$whats_included_accordion = [];
$additional_whats_included_text = '';
$whats_included_image = null;
$itinerary_title = '';
$itinerary_items = [];
$hotels_title = '';
$hotels_content = '';
$hotels_items = [];
$trip_options_title = '';
$trip_options_content = '';
$trip_option_items = [];
$experiences = [];
$level = 0;

if ( function_exists('get_field') ) {

  // Trip-specific fields
  $days_price      = get_field('days__price',     $trip_id);
  $cta_button      = get_field('cta_button',      $trip_id);
  $trip_dates      = get_field('trip_dates',      $trip_id);
  $trip_departure  = get_field('trip_departure',  $trip_id);
  $e_brochure_link = get_field('e_brochure_link', $trip_id);
  $show_webinar_link  = (bool) get_field('show_webinar_link', $trip_id);
  $webinar_link    = get_field('webinar_link',    $trip_id);
  $additional_link = get_field('additional_link', $trip_id);

  // Overrides / display fields
  $trip_name         = get_field('trip_name',        $trip_id);
  $citiescountries   = get_field('citiescountries',  $trip_id);
  $hero_image        = get_field('trip_hero_image',  $trip_id);
  $main_trip_content = get_field('main_trip_content',$trip_id);
  $travel_tools      = get_field('travel_tools',     $trip_id);
  $deals_popup       = get_field('deals_popup',      $trip_id);

  // Backwards compatible
  $trip_hero_image_text_url = get_field('trip_hero_image_text_url', $trip_id);
  $toc_info                 = get_field('toc_info',                 $trip_id);

  $school_shortcode = get_field('school_shortcode', $trip_id);

  // Relationships (CONFIRMED: Post Objects)
  $school = get_field('school', $trip_id);
  $tour   = get_field('tour',   $trip_id);

  // Preview/formatting fallback: if ACF doesn't hydrate Post Object, pull stored IDs and hydrate
	if ( (!is_object($school) || empty($school->ID)) ) {
	  $school_id_raw = (int) get_post_meta($trip_id, 'school', true);
	  if ( $school_id_raw ) $school = get_post($school_id_raw);
	}
	if ( (!is_object($tour) || empty($tour->ID)) ) {
	  $tour_id_raw = (int) get_post_meta($trip_id, 'tour', true);
	  if ( $tour_id_raw ) $tour = get_post($tour_id_raw);
	}

  $school_id = ( is_object($school) && ! empty($school->ID) ) ? (int) $school->ID : 0;
  $tour_id   = ( is_object($tour)   && ! empty($tour->ID) )   ? (int) $tour->ID   : 0;

  // School fields
  if ( $school_id ) {
    $school_logo            = get_field('school_logo',            $school_id);
    $school_logo_background = get_field('school_logo_background', $school_id);
    $primary_color          = get_field('primary_color',          $school_id);
  }

  // Tour fields + fallbacks
  if ( $tour_id ) {

    // trip_name: trip wins, else tour
    if ( $trip_name === null || trim((string)$trip_name) === '' ) {
      $trip_name = get_field('trip_name', $tour_id);
    }

    // citiescountries: trip wins, else tour destinations
    if ( empty($citiescountries) ) {
      $citiescountries = get_field('destinations', $tour_id);
    }

    // hero image: trip wins, else tour featured image
    $hero_url = is_array($hero_image) ? ($hero_image['url'] ?? '') : '';
    if ( $hero_url === '' ) {
      $tour_featured_url = get_the_post_thumbnail_url($tour_id, 'full');
      if ( $tour_featured_url ) {
        $hero_image = [ 'url' => $tour_featured_url ];

        // legacy fallback too
        if ( $trip_hero_image_text_url === null || trim((string)$trip_hero_image_text_url) === '' ) {
          $trip_hero_image_text_url = $tour_featured_url;
        }
      }
    }

    // main_trip_content: trip wins, else tour
    if ( $main_trip_content === null || $main_trip_content === false || trim((string)$main_trip_content) === '' ) {
      $main_trip_content = get_field('main_trip_content', $tour_id);
    }

    // travel_tools: trip override, else tour
    if ( $travel_tools === null || trim((string)$travel_tools) === '' ) {
      $travel_tools = get_field('travel_tools', $tour_id);
    }

    // deals_popup: trip override, else tour
    if ( $deals_popup === null || trim((string)$deals_popup) === '' ) {
      $deals_popup = get_field('deals_popup', $tour_id);
    }

    // Tour-only fields
    $description                    = get_field('description', $tour_id);
    $tour_trip_highlights_title     = get_field('trip_highlights_title', $tour_id);
    $trip_highlights                = get_field('trip_highlights', $tour_id) ?: [];
    $whats_included_title           = get_field('whats_included_title', $tour_id);
    $whats_included_accordion       = get_field('highlight_accordion', $tour_id) ?: [];
    $additional_whats_included_text = get_field('additional_whats_included_text', $tour_id);
    $whats_included_image           = get_field('whats_included_image', $tour_id);
    $itinerary_title                = get_field('itinerary_title', $tour_id);
    $itinerary_items                = get_field('itinerary_items', $tour_id) ?: [];
    $hotels_title                   = get_field('hotels_title', $tour_id);
    $hotels_content                 = get_field('hotels_content', $tour_id);
    $hotels_items                   = get_field('hotels_items', $tour_id) ?: [];
    $trip_options_title             = get_field('trip_options_title', $tour_id);
    $trip_options_content           = get_field('trip_options_content', $tour_id);
    $trip_option_items              = get_field('trip_option_items', $tour_id) ?: [];
    $experiences                    = get_field('experiences', $tour_id) ?: [];
    $level                          = (int) get_field('activity_level', $tour_id);
  }
}

// Convenience
$cta_url   = is_array($cta_button) ? ($cta_button['url'] ?? '') : '';
$cta_title = is_array($cta_button) ? ($cta_button['title'] ?? '') : '';
$hero_url  = is_array($hero_image) ? ($hero_image['url'] ?? '') : '';
if ( $hero_url === '' ) { $hero_url = (string) $trip_hero_image_text_url; }
?>

<style>
	.trip_header_cta{
		text-align:right;
	}
	#page section.trip_main_content_wrap{
		padding:0;
	}
	.trip_header_logo_wrap{
		background-color:<?php echo $school_logo_background; ?>;
	}
	.trip_header_logo{
		background-color:<?php echo $school_logo_background; ?>;
	}
	.tour_deals_popup_content a, .tour_deals_popup_content strong{
		margin:0!important;
		display:inline!important;
	}
	header{
		position:static;
	}
	.single-trips .trip_header{
		margin-top:0;
		position:sticky;
		top:0;
		background-color:#fff;
		box-shadow:0px 3px 10px rgba(0,0,0,.25);
		z-index:9999;
	}
	.mobile_cta{
		display:none;
	}
	.red_button_cta{
		display:inline-block;
		text-align: center;
		white-space: nowrap;
		color:#fff !important;
	}
	.additional_link a {
		color:<?php echo $primary_color; ?>;
	}
	.accordion_item{
		clear:both;
	}
	.slick-next{
		right:-14px;
	}
	.whats_included_accordion_section{
		margin-bottom:32px;
	}
	.whats_included_accordion_section h3{
		max-width: calc(100% - 109px);
	}
	/*.itinerary_image{
		max-width:300px;
		width:100%;
	}*/
@media (min-width: 977px) {
  .single-trips .trip_header {
    transform: none !important;
  }
}
@media screen and (max-width:976px){
		.bottom_footer {
			padding-bottom: 150px;
		}
		.mobile_cta {
        display: flex;
        justify-content: space-between;
        gap:18px;
        padding: 24px 24px 32px 24px !important;
        position: fixed;
				align-items:center;
        bottom: 0;
        width: 100%;
        z-index: 9999999;
        background-color: #fff;
				box-shadow:0px -3px 10px rgba(0,0,0,.25);
    }
		/*.single-trips .trip_header{
				position:static!important;
		}*/
		.mobile_cta .red_button_cta{
				font-size: 18px;
	      /*padding: 14px 25px;*/
		}
		.trip_days_price {
	      margin:0 .5rem 0 0
	   }
	   #chat-widget-push-to-talk {
			bottom:130px !important;
		}
		/*.trip_header{
			display:block!important;
		}
		.trip_header_info{
			display:block!important;
		}
		.trip_header_info > div{
			display:inline-block;
			vertical-align:middle;
		}
		.trip_header_info_text{
			padding-left:16px;
		}
		*/
}

	@media screen and (max-width:686px){
		.accordion_content {
			padding: 20px 30px;
		}
		/*.itinerary_image {
		    max-width: 100%;
		    height: 300px;
		    float: none;
		    width: 100%;
		    margin: 0;
		}*/
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
/*.trip_main_image{
	box-shadow: 0px 3px 5px rgba(0, 0, 0, .25); 
}*/
</style>

<?php if ( ! post_password_required() ) : ?>

  <section class="mobile_cta">
    <div class="trip_days_price"><?php echo wp_kses_post($days_price); ?></div>
    <?php if ( $cta_url ) : ?>
      <a href="<?php echo esc_url($cta_url); ?>" class="red_button_cta" target="_blank" rel="noopener">
        <?php echo esc_html($cta_title); ?>
      </a>
    <?php endif; ?>
  </section>

  <?php if ( is_user_logged_in() ) : ?>
    <style>
      .single-trips .trip_header{ top:32px; }
      @media screen and (max-width: 782px) { .single-trips .trip_header{ top:46px; } }
    </style>
  <?php endif; ?>

  <section class="trip_header">
    <div class="trip_header_info">

      <?php if ( is_array($school_logo) && ! empty($school_logo['url']) && $school_id ) : ?>
        <div class="trip_header_logo_wrap">
          <a
            class="trip_header_logo"
            href="<?php echo esc_url( get_permalink($school_id) ); ?>"
            style="background-image:url('<?php echo esc_url($school_logo['url']); ?>')"
            aria-label="<?php echo esc_attr( get_the_title($school_id) ); ?>"
          ></a>
        </div>
      <?php endif; ?>

      <div class="trip_header_info_text">
        <?php if ( $school_id && $school_id != 824 ) : ?>
          <h2 class="trip_school_name"><?php echo esc_html( get_the_title($school_id) ); ?></h2>
        <?php endif; ?>

        <h1 class="trip_name"><?php echo esc_html($trip_name); ?></h1>
        <h4 class="trip_destination_info"><?php echo wp_kses_post($citiescountries); ?></h4>
      </div>
    </div>

    <div class="trip_header_cta">
      <div class="trip_days_price"><?php echo wp_kses_post($days_price); ?></div>
      <?php if ( $cta_url ) : ?>
        <a href="<?php echo esc_url($cta_url); ?>" class="red_button_cta" target="_blank" rel="noopener">
          <?php echo esc_html($cta_title); ?>
        </a>
      <?php endif; ?>
    </div>
  </section>

  <section class="trip_main_content_wrap">
    <div class="trip_main_image" style="background-image:url('<?php echo esc_url($hero_url); ?>')"></div>

    <div class="trip_main_content">

      <?php
      // trip_status stored on TOUR
      if ( $tour_id ) {
        $status_value = get_field('trip_status', $tour_id);
        if ( $status_value ) {
          $field_obj = function_exists('get_field_object') ? get_field_object('trip_status', $tour_id) : null;
          $status_label = '';

          if ( is_array($field_obj) && !empty($field_obj['choices']) && isset($field_obj['choices'][$status_value]) ) {
            $status_label = $field_obj['choices'][$status_value];
          }
          if ( $status_label === '' ) {
            $status_label = ucwords(str_replace(['_', '-'], ' ', (string) $status_value));
          }
          ?>
          <span class="trip_status_badge trip_status_badge--<?php echo esc_attr($status_value); ?> trip_status">
            <?php echo esc_html($status_label); ?>
          </span>
          <?php
        }
      }
      ?>

      <div class="trip_dates"><?php echo wp_kses_post($trip_dates); ?></div>

      <div class="trip_main_content_text">
        <?php echo do_shortcode((string)$main_trip_content); ?>
        <?php echo do_shortcode((string)$trip_departure); ?>
      </div>

      <div class="trip_main_content_links">
        <?php if ( $e_brochure_link || $webinar_link || $show_webinar_link || (is_array($additional_link) && !empty($additional_link['url'])) ) : ?>
          <div class="additional_links">
            <ul class="additional_link_items">
              <?php if ( $e_brochure_link ) : ?>
                <li><a target="_blank" rel="noopener" href="<?php echo esc_url($e_brochure_link); ?>" class="print_brochure">Download Brochure</a></li>
              <?php endif; ?>

              <?php if ( $show_webinar_link ) : ?>
							  <li><a href="<?php echo esc_url( get_permalink(11615) ); ?>" class="webinar_link">Live Webinars</a></li>
							<?php endif; ?>
              <?php if ( $webinar_link ) : ?>
                <li><a target="_blank" rel="noopener" href="<?php echo esc_url($webinar_link); ?>" class="webinar_link">Live Webinars</a></li>
              <?php endif; ?>

              <?php if ( is_array($additional_link) && !empty($additional_link['url']) ) : ?>
                <li class="additional_link">
                  <a target="_blank" rel="noopener" href="<?php echo esc_url($additional_link['url']); ?>">
                    <?php echo esc_html($additional_link['title'] ?? 'More Info'); ?>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        <?php endif; ?>

        <?php if ( (!empty($experiences) && is_array($experiences)) || (!empty($level) && (int)$level > 0) ) : ?>
          <div class="experiences">

            <?php if ( !empty($experiences) && is_array($experiences) ) : ?>
              <div class="experiences-grid">
                <strong>
                  <a href="<?php echo esc_url( get_permalink(11625) ); ?>" target="_blank" rel="noopener">Trip Experiences:</a>
                </strong>
                <?php foreach ( $experiences as $experience_icon_class ) : ?>
                  <i class="<?php echo esc_attr($experience_icon_class); ?>"></i>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <?php if ( !empty($level) && (int)$level > 0 ) : ?>
              <div class="experiences-grid">
                <strong>Activity Level:</strong>
                <?php
                  $level_int = min(5, max(0, (int)$level));
                  for ($i=1; $i<=5; $i++) :
                ?>
                  <div class="activity-box <?php echo ($i <= $level_int) ? 'active' : ''; ?>"><?php echo (int)$i; ?></div>
                <?php endfor; ?>
              </div>
            <?php endif; ?>

          </div>
        <?php endif; ?>

        <ul class="trip_cta_list">
          <?php if ( $school_id ) : ?>
            <li class="more_trips">
              <a href="<?php echo esc_url( get_permalink($school_id) ); ?>"><i class="fa-solid fa-arrow-left"></i> More Trips</a>
            </li>
          <?php endif; ?>
          <li class="travel_tools"><a href="#">Travel Tools</a></li>
          <li class="deals_cta"><a href="#">Deals</a></li>
          <li class="share_section">
            <span><i class="fa-solid fa-arrow-up-from-bracket"></i></span>
            <div class="share_options">
              <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
            </div>
          </li>
        </ul>

      </div>
    </div>
  </section>

  <?php if ( $tour_id ) : ?>
    <section class="tour_area">

      <?php if ( $tour_trip_highlights_title && !empty($trip_highlights) && is_array($trip_highlights) ) : ?>
        <div class="trip_highlights">
          <h2><?php echo esc_html($tour_trip_highlights_title); ?></h2>
          <ul class="trip_highlight_items">
            <?php foreach ( $trip_highlights as $trip_highlight ) :
              $highlight_image = $trip_highlight['highlight_image'] ?? null;
              $highlight_title = $trip_highlight['highlight_title'] ?? '';
              $highlight_location = $trip_highlight['highlight_location'] ?? '';
              $highlight_stars = (int) ($trip_highlight['highlight_stars'] ?? 0);
              $highlight_description = $trip_highlight['highlight_description'] ?? '';
            ?>
              <li>
                <div class="trip_highlights_image" style="background-image:url('<?php echo esc_url($highlight_image['url'] ?? ''); ?>');"></div>
                <div class="trip_highlights_content">
                  <h3><?php echo esc_html($highlight_title); ?></h3>
                  <span class="highlight_location"><?php echo esc_html($highlight_location); ?></span>

                  <span class="highlight_stars">
                    <?php for ($i=0; $i<$highlight_stars; $i++) : ?>
                      <i class="fa-solid fa-star"></i>
                    <?php endfor; ?>
                  </span>

                  <div class="trip_highlight_content">
                    <?php echo wp_kses_post($highlight_description); ?>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <div class="whats_included">
        <h2><?php echo esc_html($whats_included_title); ?></h2>

        <div class="whats_included_content_wrap">
          <div class="whats_included_content">

            <?php if ( !empty($whats_included_accordion) && is_array($whats_included_accordion) ) : ?>
              <?php foreach ( $whats_included_accordion as $section ) :
                $section_title = $section['whats_included_title'] ?? '';
                $accordion_rows = $section['accordion_items'] ?? [];
                $expand_all = $section['expand_all'] ?? "False";
              ?>
                <div class="whats_included_accordion_section">
                  <h3><?php echo esc_html($section_title); ?></h3>
                  <a href="#" class="toggle_all_trigger">Expand All <i class="fa-solid fa-plus"></i></a>

                  <?php if ( !empty($accordion_rows) && is_array($accordion_rows) ) : ?>
                    <ul>
                      <?php foreach ( $accordion_rows as $row ) :
                        $is_open = ($expand_all !== "False");
                      ?>
                        <li class="accordion_item">
                          <div class="accordion_trigger">
                            <?php echo wp_kses_post($row['accordion_trigger_text'] ?? ''); ?>
                            <span class="collapsed_indicator" aria-hidden="true">
                              <i class="fa-solid <?php echo $is_open ? 'fa-minus' : 'fa-plus'; ?>"></i>
                            </span>
                          </div>
                          <div class="accordion_content" style="display:<?php echo $is_open ? 'block' : 'none'; ?>">
                            <?php echo wp_kses_post($row['accordion_content'] ?? ''); ?>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

            <div class="additional_whats_included_text">
              <?php echo do_shortcode((string)$additional_whats_included_text); ?>
            </div>
          </div>

          <?php
          // Map logic (itinerary_stops stored on TOUR)
          $stops = get_field('itinerary_stops', $tour_id);
          $route_points = [];

          if ( is_array($stops) ) {
            foreach ( $stops as $stop ) {
              $loc = $stop['stop_location'] ?? null;
              $lat = is_array($loc) ? ($loc['lat'] ?? null) : null;
              $lng = is_array($loc) ? ($loc['lng'] ?? null) : null;

              if ( $lat !== null && $lng !== null ) {
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
            <?php if ( $has_route ) : ?>
              <div class="whats_included_map">
                <div
                  id="<?php echo esc_attr($map_id); ?>"
                  class="wi-map-canvas"
                  data-route="<?php echo esc_attr( wp_json_encode($route_points) ); ?>"
                  data-pin="<?php echo esc_attr($pin_url); ?>"
                ></div>
              </div>
            <?php else : ?>
              <img
                src="<?php echo esc_url($whats_included_image['url'] ?? ''); ?>"
                alt="<?php echo esc_attr($whats_included_image['alt'] ?? ''); ?>"
              >
            <?php endif; ?>
          </div>

        </div>
      </div>

      <?php if ( $itinerary_title && !empty($itinerary_items) && is_array($itinerary_items) ) : ?>
        <div class="itinerary">
          <h2><?php echo esc_html($itinerary_title); ?></h2>

          <div style="position:relative;height:40px;" class="accordion_collapse_wrap">
            <a href="#" class="toggle_all_trigger">Expand All <i class="fa-solid fa-plus"></i></a>
          </div>

          <ul>
            <?php foreach ( $itinerary_items as $itinerary_item ) :
              $default_expand = $itinerary_item['default_expand'] ?? "False";
              $open = ($default_expand !== "False");
            ?>
              <li class="accordion_item">
                <div class="itinerary_item_content">
                  <div class="accordion_trigger" style="position:relative;">
                    <?php echo wp_kses_post($itinerary_item['itinerary_trigger_text'] ?? ''); ?>
                    <span class="collapsed_indicator">
                      <i class="fa-solid <?php echo $open ? 'fa-minus' : 'fa-plus'; ?>"></i>
                    </span>
                  </div>

                  <div class="accordion_content" style="display:<?php echo $open ? 'flex' : 'none'; ?>;">
                    <div class="itinerary_text">
                      <?php echo wp_kses_post($itinerary_item['itinerary_content'] ?? ''); ?>
                    </div>
                    <div class="itinerary_image" style="background-image:url('<?php echo esc_url($itinerary_item['itinerary_image']['url'] ?? ''); ?>');"></div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ( $hotels_title ) : ?>
        <div class="hotels" style="clear:both;">
          <h2><?php echo esc_html($hotels_title); ?></h2>
          <div class="hotels_content"><?php echo do_shortcode((string)$hotels_content); ?></div>

          <?php if ( !empty($hotels_items) && is_array($hotels_items) ) : ?>
            <ul class="hotels_slider">
              <?php foreach ( $hotels_items as $hotels_item ) : ?>
                <li>
                  <div class="hotel_item_image" style="background-image:url('<?php echo esc_url($hotels_item['hotel_item_image']['url'] ?? ''); ?>');"></div>
                  <div class="hotel_content_wrap">
                    <h3><?php echo esc_html($hotels_item['hotel_title'] ?? ''); ?></h3>
                    <div>
                      <span class="hotel_location"><?php echo esc_html($hotels_item['hotel_location'] ?? ''); ?></span>
                      <span class="hotel_stars">
                        <?php for ($i=0; $i<(int)($hotels_item['hotel_stars'] ?? 0); $i++) : ?>
                          <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                      </span>
                    </div>
                    <div class="hotel_content">
                      <?php echo wp_kses_post($hotels_item['hotels_content'] ?? ''); ?>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if ( $trip_options_title ) : ?>
        <div class="trip_options">
          <h2><?php echo esc_html($trip_options_title); ?></h2>
          <div class="trip_options_content"><?php echo do_shortcode((string)$trip_options_content); ?></div>

          <?php if ( !empty($trip_option_items) && is_array($trip_option_items) ) : ?>
            <ul class="trip_options_slider">
              <?php foreach ( $trip_option_items as $trip_option_item ) : ?>
                <li>
                  <div class="trip_options_item_image" style="background-image:url('<?php echo esc_url($trip_option_item['trip_option_image']['url'] ?? ''); ?>');"></div>
                  <div class="trip_options_wrap">
                    <h3><?php echo esc_html($trip_option_item['trip_option_title'] ?? ''); ?></h3>
                    <div>
                      <span class="trip_options_price"><?php echo wp_kses_post($trip_option_item['trip_option_price'] ?? ''); ?></span>
                      <span class="hotel_stars">
                        <?php for ($i=0; $i<(int)($trip_option_item['trip_option_stars'] ?? 0); $i++) : ?>
                          <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                      </span>
                    </div>
                    <div class="trip_option_item_content">
                      <?php
                        $opt_content = $trip_option_item['trip_options_content'] ?? '';
                        if ( $opt_content ) echo do_shortcode((string)$opt_content);

                        $more = $trip_option_item['more_info'] ?? null;
                        if ( is_array($more) && !empty($more['url']) ) :
                      ?>
                        <a href="<?php echo esc_url($more['url']); ?>" target="<?php echo esc_attr($more['target'] ?? '_self'); ?>">
                          <?php echo esc_html($more['title'] ?? 'More info'); ?> <i class="fa fa-arrow-right"></i>
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
  <?php endif; // end tour_id ?>

  <main>
    <div class="container">
      <article class="full-width" style="width:100%;max-width:100%;">
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <div class="entry">
            <?php
            // Show Tour content first (the_content() of tour post), then Trip content
            global $post;
						$original_post = $post;

						if ( $tour_id ) {
						  $tour_post = get_post($tour_id);

						  if ( $tour_post ) {
						    $post = $tour_post;          // set global $post
						    setup_postdata($post);
						    the_content();               // Tour content
						    wp_reset_postdata();
						    $post = $original_post;      // restore global
						  }
						}

            the_content(); // Trip content
            ?>
          </div>
        </div>
      </article>
    </div>
  </main>

  <?php
  // Deals Popup (trip override else tour)
  $tour_deals_popup = $tour_id ? get_field('deals_popup', $tour_id) : '';
  if ( $deals_popup || $tour_deals_popup ) :
  ?>
    <div class="tour_deals_popup_wrap">
      <div class="tour_deals_popup_inner">
        <div class="popup_outline">
          <a href="#" class="tour_deals_close_popup"><i class="fa-solid fa-xmark"></i></a>
          <div class="tour_deals_popup_content">
            <?php
            if ( $deals_popup ) {
              echo do_shortcode((string)$deals_popup);
            } else {
              echo do_shortcode((string)$tour_deals_popup);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ( $travel_tools ) : ?>
    <div class="travel_tools_popup_wrap">
      <div class="travel_tools_popup_inner">
        <div class="popup_outline">
          <a href="#" class="travel_tools_close_popup"><i class="fa-solid fa-xmark"></i></a>
          <div class="travel_tools_popup_content">
            <?php echo do_shortcode((string)$travel_tools); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

<?php endif; // password ?>

<div class="container">
  <div id="back_to_top" class="back-to-top-inline">
    <i class="fa-solid fa-angle-up"></i>
  </div>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>