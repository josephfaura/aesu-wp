<?php
/**
 * Expired Trip Template
 */

$trip = $GLOBALS['expired_trip'];

if ( ! $trip ) {
    get_header();
    echo '<h1>Trip Not Found</h1>';
    get_footer();
    exit;
}

$trip_id = $trip->ID;


/**
 * Get Trip Relationships
 */
$school = get_field('school', $trip_id);
$tour   = get_field('tour', $trip_id);

$school_id = is_object($school) ? (int) $school->ID : (int) $school;
$tour_id   = is_object($tour) ? (int) $tour->ID : (int) $tour;


/**
 * Trip Fields
 */
$trip_name       = get_field('trip_name', $trip_id);
$trip_dates      = get_field('trip_dates', $trip_id);
$hero_image      = get_field('trip_hero_image', $trip_id);


/**
 * Tour fallback fields
 */
if ( $tour_id ) {

    if ( empty($trip_name) ) {
        $trip_name = get_field('trip_name', $tour_id);
    }

    if ( empty($citiescountries) ) {
        $citiescountries = get_field('destinations', $tour_id);
    }

    if ( empty($hero_image) ) {
        $tour_hero = get_field('trip_hero_image', $tour_id);

        if ( !empty($tour_hero) ) {
            $hero_image = $tour_hero;
        }
    }

    // Final fallback: featured image from Tour post
    if ( empty($hero_image) ) {

        $tour_featured = get_the_post_thumbnail_url($tour_id, 'full');

        if ( $tour_featured ) {
            $hero_image = array(
                'url' => $tour_featured
            );
        }
    }
}


/**
 * Hero URL
 */
$hero_url = '';

if ( is_array($hero_image) && !empty($hero_image['url']) ) {
    $hero_url = $hero_image['url'];
}


/**
 * School Info
 */
$school_name = '';

if ( $school_id ) {
    $school_name = get_the_title($school_id);
}

$school_url = $school_id ? get_permalink($school_id) : home_url('/trips/');


get_header();

?>

<style>
	main {
		margin: 0;
	}
	.no-banner {
		margin:0;
	}
	.trip_main_content_wrap {
		min-height: 70vh;
	}
	.trip_main_content {
		text-align: center;
	}
	.trip_name_expired {
		color: #2c768E;
		text-align: center !important;
		margin:.5rem auto;
	}
	.trip_school_name, .trip_dates {
		font-size: 1.25em;
		color:#5e5e5e;
	}
	.site-footer {
		padding: 0;
	}
	@media screen and (max-width: 527px) {
		.trip_school_name, .trip_dates {
			font-size:1em;
		}
	}
</style>

<main>

	<div class="no-banner"></div>

<section class="trip_main_content_wrap">

    <?php if ( $hero_url ) : ?>

        <div 
            class="trip_main_image"
            style="background-image:url('<?php echo esc_url($hero_url); ?>');">
        </div>

    <?php endif; ?>


    <div class="trip_main_content">

        <?php if ( $school_name ) : ?>
            <h2 class="trip_school_name">
                <?php echo esc_html($school_name); ?>
            </h2>
        <?php endif; ?>


        <?php if ( $trip_name ) : ?>
            <h1 class="trip_name_expired">
                <?php echo esc_html($trip_name); ?>
            </h1>
        <?php endif; ?>


        <?php if ( $trip_dates ) : ?>
            <h3 class="trip_dates">
                <?php echo wp_kses_post($trip_dates); ?>
            </h3>
        <?php endif; ?>


        <p>
            This departure has concluded and is no longer available.
        </p>


        <a 
            href="<?php echo esc_url($school_url); ?>" 
            class="blue-primary-button">
            <i class="fa-solid fa-arrow-left"></i> More Trips
        </a>

    </div>

</section>

</main>


<?php get_footer(); ?>