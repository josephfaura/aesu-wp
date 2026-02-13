<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package AWI_Revamped
 */

get_header();
?>

<?php
$post_type = get_query_var('post_type');

if ( $post_type === 'trips' ) {
    get_template_part( 'template-parts/search', 'trips' );
    return; // stop normal search.php from continuing
}

// Otherwise use normal search template
?>

	<div class="no-banner"></div>

	<main id="primary" class="site-main">
	<div class="container">

		<?php if ( have_posts() ) : ?>

			<div class="header">
				<h2 class="page-title">
					<?php
					printf(
						esc_html__( 'Search Results: %s', 'awi-revamped' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h2>
			</div>


			<ul class="latest_posts_list">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'search' ); ?>
				<?php endwhile; ?>

			</ul>

			<?php
			global $wp_query;

			$big = 999999999; // unlikely integer for pagination base

			$pagination_links = paginate_links( array(
			    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			    'format'    => '?paged=%#%',
			    'current'   => max( 1, get_query_var('paged') ),
			    'total'     => $wp_query->max_num_pages,
			    'type'      => 'array',
			    'prev_text' => '&#8592; Previous',
			    'next_text' => 'Next &#8594;',
			) );

			if ( is_array( $pagination_links ) ) : ?>
			    <nav class="pagination-wrapper" role="navigation">
			        <ul class="pagination">
			            <?php foreach ( $pagination_links as $link ) : ?>
			                <li><?php echo $link; ?></li>
			            <?php endforeach; ?>
			        </ul>
			    </nav>
			<?php endif; ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</div>

<div class="container">

<?php
$trips_args = array(
    'post_type'      => 'trips',
    'posts_per_page' => 3,
    'post__not_in'   => array( get_the_ID() ),
    'meta_query'     => array(
        array(
            'key'     => 'header_type',
            'value'   => 'AESU',
            'compare' => '=',
        ),
    ),
    'orderby'        => 'rand',
);

$trips_query = new WP_Query( $trips_args );

if ( $trips_query->have_posts() ) : ?>
<section class="related-articles">

    <h2 class="related-articles-title">Trips We Think You&rsquo;ll Love</h2>

    <ul class="latest_posts_list">
        <?php while ( $trips_query->have_posts() ) : $trips_query->the_post();

            $trip_id = get_the_ID();

            // Trip fields
            $hero_image               = get_field('trip_hero_image', $trip_id);
            $trip_hero_image_text_url = get_field('trip_hero_image_text_url', $trip_id);
            $trip_name                = get_field('trip_name', $trip_id);
            $trip_dates               = get_field('trip_dates', $trip_id);
            $toc_info                 = get_field('toc_info', $trip_id);
            $days_price               = get_field('days__price', $trip_id);

            // Normalize hero_image so ['url'] access never warnings
            if ( !is_array($hero_image) ) {
                $hero_image = [];
            }

            // Trip -> selected Tour (change 'tour' if your field name differs)
            $tour = get_field('tour', $trip_id);
            $tour_id = $tour ? (is_object($tour) ? $tour->ID : (int)$tour) : 0;

            // 1) trip_name fallback to tour
            if ( ( $trip_name === null || $trip_name === false || $trip_name === '' ) && $tour_id ) {
                $trip_name = get_field('trip_name', $tour_id);
            }

            // 2) hero image fallback to tour featured image if trip has neither image nor text-url
            if ( empty($hero_image['url']) && ( $trip_hero_image_text_url === null || $trip_hero_image_text_url === false || $trip_hero_image_text_url === '' ) && $tour_id ) {
                $tour_featured_url = get_the_post_thumbnail_url($tour_id, 'full');
                if ( $tour_featured_url ) {
                    $hero_image['url'] = $tour_featured_url;
                    $trip_hero_image_text_url = $tour_featured_url;
                }
            }

            // 3) toc_info fallback to tour destinations + description + trip days_price
            if ( ( $toc_info === null || $toc_info === false || trim(wp_strip_all_tags($toc_info)) === '' ) && $tour_id ) {

                $destinations = get_field('destinations', $tour_id);
                $description  = get_field('description', $tour_id);

                $fallback = '';

                if ( !empty($destinations) ) {
                    $destinations_text = is_array($destinations)
                        ? implode(', ', array_filter(array_map('wp_strip_all_tags', $destinations)))
                        : wp_strip_all_tags($destinations);

                    if ( $destinations_text ) {
                        $fallback .= '<p class="destinations">' . esc_html($destinations_text) . '</p>';
                    }
                }

                if ( $description ) {
                    $fallback .= '<div class="trip_description">' . wp_kses_post($description) . '</div>';
                }

                if ( $days_price ) {
                    $fallback .= '<p class="days_price">' . wp_kses_post($days_price) . '</p>';
                }

                $toc_info = $fallback;
            }
        ?>

        <li <?php post_class( 'latest_posts_list_item' ); ?>>

            <a class="card_image_link" href="<?php echo esc_url( get_permalink() ); ?>">
                <div class="latest_post_item_thumb" style="background-image:url('<?php
                    echo !empty($hero_image['url']) ? esc_url($hero_image['url']) : esc_url($trip_hero_image_text_url);
                ?>')"></div>
            </a>

            <div class="latest_post_item_text">
                <span class="post-type-label"><?php echo esc_html($trip_dates); ?></span>

                <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <h3 class="trip_title_lander"><?php echo esc_html($trip_name); ?></h3>
                </a>

                <div><?php echo do_shortcode($toc_info); ?></div>

                <a style="font-size:18px;" href="<?php echo esc_url( get_permalink() ); ?>">Explore this AESU trip <i class="fa fa-arrow-right"></i></a>
            </div>

        </li>

        <?php endwhile; ?>
    </ul>

    <h2 class="related-articles-title" style="margin:2em 0 .5rem 0 !important;">Ready for Your Next Adventure?</h2>
    <div style="text-align: center;">
        <a class="cta-button" href="<?php echo esc_url(get_permalink(824)); ?>">View all trips <i class="fa fa-arrow-right"></i></a>
    </div>

</section>
<?php
endif;
wp_reset_postdata();
?>

</div>

	</main><!-- #main -->

<?php
get_footer();
