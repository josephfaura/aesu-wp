<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AWI_Revamped
 */

get_header();
?>

<style>
	.postmetadata-postdate, .postmetadata-taxonomy{
		margin: 1em auto;
		text-align: center;
		text-transform: uppercase;
	    letter-spacing: .05em;
		font-weight: 600;
		color:#777;
	}
	.single-post .entry p:first-of-type {
		font-size: 1.25rem;
		line-height: 1.75em;
		font-weight: 500;
		text-align: justify;
		text-align-last: center;
	}
	.single-post .entry h2{
		text-align: center;
		font-size: 2rem;
	}
	.single-post .entry a{
		font-weight: 700;
	}
	.wp-block-read-more {
		display: none;
	}
	.single-post .entry figure.alignright,
	.single-post .entry figure.alignleft {
	    display: block;
	    float: none !important;        /* cancel any float */
	    margin-left: auto;
	    margin-right: auto;
	    text-align: center;            /* center captions or inline content */
	}

	.single-post .entry figure.alignright img,
	.single-post .entry figure.alignleft img {
	    width: 100% !important;        /* override inline width */
	    height: auto !important;       /* maintain aspect ratio */
	}

	.single-post .entry figure.alignright figcaption,
	.single-post .entry figure.alignleft figcaption {
		display: block;
	    text-align: center;            /* center captions */
		font-size: 14px;
	    margin-top: 1em;       /* optional spacing above caption */
	    font-style: italic;      /* optional styling */
	}
	.navigation {
	  display: flex;
	  align-items: center;
	  justify-content: space-between;
		border-top: 2px solid #e5e5e5;
		border-bottom: 2px solid #e5e5e5;
		margin:2rem 0 0;
		padding: 1rem 0;
	}

	.nav-prev,
	.nav-next {
	  flex: 1;
	}
	.nav-next {
		text-align: right;
	}

	.nav-center {
	  flex: 0 0 auto;
	  text-align: center;
	  text-transform: uppercase;
	  letter-spacing: .05rem;
	}

	.nav-prev a,
	.nav-next a {
		color:#E74C3C !important;
	}
	
	/*.sidebar ul{
		padding:0;
	}
	.sidebar{
		max-width:300px;
	}
	.wp-block-search__button{
		max-width:71px;
	}
	.sidebar h2{
		font-size:26px;
	}
	.wp-posts-list h2{
		font-size:26px;
		margin-top:0;
	}
	.wp-posts-list li{
		display:flex;
		gap:30px;
	}
	.blog_thumbnail{
		min-width:300px;
	}*/
	body main article{
		width: 80%;
		max-width: 768px;
		margin-bottom: 0;
	}

	@media screen and (max-width:982px){
		/*.single-post main .container{
			display:block;
		}
		article, aside{
			float:none;
			width:100%!important;
		}*/
	}
	@media screen and (max-width:672px){
		.single-post .entry p:first-of-type {
			font-size: 1rem;
		    line-height: 1.5em;
		}
		/*.wp-posts-list li{
			display:block;
		}
		.blog_thumbnail{
			height:200px;
			min-width:100%;
			margin-bottom:20px;
		}
		#primary{
			padding-top:0;
		}*/
	}
	@media screen and (max-width: 350px) {
		.single-post .entry h2{
			font-size: 1.5rem;
		}
	}

</style>

<?php
$thumb_id  = get_post_thumbnail_id();
$thumb_url = get_the_post_thumbnail_url();
$valid     = false;

if ( $thumb_id && $thumb_url ) {
    // Try to verify file exists on server
    $file_path = get_attached_file( $thumb_id );

    if ( $file_path && file_exists( $file_path ) ) {
        $valid = true;
    }
}

if ( $valid ) : ?>
	<div class="banner_interior"style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');">
	</div>
<?php else : ?>
	<div class="no-banner"></div>
<?php endif; ?>
	<main id="primary" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php
			$categories = get_the_category();
			$cat = ! empty( $categories ) ? $categories[0] : null;
			?>
			<h4 class="blog-type-label"><?php echo esc_html( $cat->name ); ?></h4>
		<h1><?php the_title(); ?></h1>
			<p class="postmetadata-postdate">
		         <small>Published on <?php echo get_the_date('M j, Y'); ?> | <?php echo get_reading_time(); ?>-min read</small>
		    </p>
	</div>

	<div class="container">
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		    <div class="entry">

		        <?php the_content(); ?>

		        <?php 
				// Navigation links
				$prev = get_previous_post_link('%link','<i class="fa-solid fa-arrow-left"></i> Prev');
				$next = get_next_post_link('%link','Next <i class="fa-solid fa-arrow-right"></i>');

				// Get blog page URL (WordPress posts page)
				$blog_url = get_permalink( get_option('page_for_posts') );

				if ( $prev || $next ) : ?>
				    <div class="navigation clearfix">

				        <div class="nav-prev">
				            <?php if ( $prev ) : ?>
				                <strong><?php echo $prev; ?></strong>
				            <?php endif; ?>
				        </div>

				        <div class="nav-center">
				            <strong>
				                <a href="<?php echo esc_url( $blog_url ); ?>" class="top-stories">
				                    Top Stories
				                </a>
				            </strong>
				        </div>

				        <div class="nav-next">
				            <?php if ( $next ) : ?>
				                <strong><?php echo $next; ?></strong>
				            <?php endif; ?>
				        </div>

				    </div>
				<?php endif; ?>

		    </div><!-- .entry -->

		</article>

		<?php endwhile; else : ?>

		<p>Sorry, no posts matched your criteria.</p>

		<?php endif; ?>
	</div>

<div class="container">
	<?php
if ( $cat ) :

    $current_year = date_i18n('Y');

    $related_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post__not_in'   => array( get_the_ID() ),
        'category__in'   => array( $cat->term_id ),
        'date_query'     => array(
            array(
                'after'     => $current_year . '-01-01',
                'inclusive' => true,
            ),
        ),
        'orderby'        => 'rand',
    );

    $related_query = new WP_Query( $related_args );

    // If we got fewer than 3 posts, relax the date to include all older posts
    if ( $related_query->found_posts < 3 ) {

        $remaining = 3 - $related_query->found_posts;

        $related_args['posts_per_page'] = $remaining;
        $related_args['date_query'] = array(); // remove year filter
        $older_query = new WP_Query( $related_args );

        if ( $older_query->have_posts() ) {
            // Merge post IDs so we can display them in one loop
            $merged_ids = array_merge(
                wp_list_pluck( $related_query->posts, 'ID' ),
                wp_list_pluck( $older_query->posts, 'ID' )
            );

            $final_args = array(
                'post_type' => 'post',
                'post__in'  => $merged_ids,
                'orderby'   => 'post__in',
            );

            $final_query = new WP_Query( $final_args );
        }

        wp_reset_postdata();

    } else {
        $final_query = $related_query;
    }

    // Display posts if any
    if ( $final_query->have_posts() ) : ?>
        <section class="related-articles">
            <h2 class="related-articles-title">
                Similar <?php echo esc_html( $cat->name ); ?> Stories
            </h2>

            <ul class="latest_posts_list">
                <?php while ( $final_query->have_posts() ) : $final_query->the_post(); ?>
                    <li <?php post_class( 'latest_posts_list_item' ); ?>>
                        <?php
                        $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( ! $thumb ) {
                            $thumb = get_first_image_url();
                        }
                        ?>
                        <a class="card_image_link" href="<?php the_permalink(); ?>">
                            <div class="latest_post_item_thumb"
                                 style="background-image:url(<?php echo esc_url( $thumb ); ?>)">
                            </div>
                        </a>

                        <div class="latest_post_item_text">
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <span class="post-type-label">Published on <?php echo get_the_date( 'm.d.y' ); ?></span>
                            <p><?php echo esc_html( get_search_excerpt( get_the_ID(), 25 ) ); ?></p>
                            <a href="<?php the_permalink(); ?>">Read more <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>

            <?php if ( $cat ) : ?>
				    <div class="center">
				        <strong><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
				            Explore more stories in <?php echo esc_html( $cat->name ); ?> <i class="fa fa-arrow-right"></i></a></strong>
				    </div>
			<?php endif; ?>

        </section>
    <?php
    endif;

    wp_reset_postdata();

endif;
?>
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
