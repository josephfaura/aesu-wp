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
	h4.article-category {
	    font-weight: 500;
	    text-transform: uppercase;
	    letter-spacing: .25em;
	    line-height: 1.25em;
	    margin: 1rem auto;
	    text-align: center;
	}
	.postmetadata-postdate, .postmetadata-taxonomy{
		font-size: 18px;
		margin: 1em auto;
		text-align: center;
		text-transform: uppercase;
	    letter-spacing: .05em;
		font-weight: 600;
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
		border-top: 2px solid #e5e5e5;
		border-bottom: 2px solid #e5e5e5;
		margin:2rem 0;
		padding: 1rem 0;
	}
	.navigation a {
		color:#E74C3C !important;
	}
	.alignleft {
		margin-right:0;
		margin-bottom:0;
	}
	.alignright {
		margin-left:0;
		margin-bottom:0;
	}
	.related-articles-title {
		text-align: center;
		font-size: 32px;
		margin-bottom: 2rem;
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
	}

	@media screen and (max-width:982px){
		.single-post main .container{
			display:block;
		}
		article, aside{
			float:none;
			width:100%!important;
		}
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
</style>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="banner_interior">
		<div class="flexslider clearfix">
			<ul class="slides">
				<li style="background-image:url(<?php echo esc_url( get_the_post_thumbnail_url() ); ?>);">
				</li>
			</ul>
		</div>
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
			<h4 class="article-category"><?php echo esc_html( $cat->name ); ?></h4>
		<h1><?php the_title(); ?></h1>
			<p class="postmetadata-postdate">
		         <small>Published on <?php echo get_the_date('M j, Y'); ?></small>
		     </p>
	</div>

	<div class="container">
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		    <div class="entry">

		        <?php the_content(); ?>

		        <?php 
		            // Navigation links
		            $prev = get_previous_post_link('%link','<i class="fa-solid fa-arrow-left"></i> Previous');
		            $next = get_next_post_link('%link','Next <i class="fa-solid fa-arrow-right"></i>');

		            if ( $prev || $next ) : ?>
		                <div class="navigation clearfix">
		                    <div class="alignleft"><strong><?php echo $prev; ?></strong></div>
		                    <div class="alignright"><strong><?php echo $next; ?></strong></div>
		                </div>

		        <?php endif; ?>

				<?php if ( $cat ) : ?>
				    <div class="center">
				        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
				            Explore more stories in this category
				            <i class="fa fa-arrow-right"></i>
				        </a>
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
                Other Stories Like This
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
        </section>
    <?php
    endif;

    wp_reset_postdata();

endif;
?>
</div>

<div class="container">

<?php
// Arguments for trips with ACF header-type = AESU
$trips_args = array(
    'post_type'      => 'trips',          // custom post type
    'posts_per_page' => 6,                // number of trips to show
    'post__not_in'   => array( get_the_ID() ), // exclude current post
    'meta_query'     => array(             // filter by ACF field
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

        <h2 class="related-articles-title">Trips You Will Love</h2>

        <ul class="latest_posts_list">
            <?php while ( $trips_query->have_posts() ) : $trips_query->the_post(); 
            	if ( function_exists('get_field') ) {
		            $hero_image = get_field('trip_hero_image', get_the_ID());
		            $trip_hero_image_text_url = get_field('trip_hero_image_text_url');
		            $toc_info = get_field('toc_info', get_the_ID());
		            $trip_name = get_field('trip_name', get_the_ID());
		            $trip_dates = get_field('trip_dates', get_the_ID());
		        }
            ?>

                <li <?php post_class( 'latest_posts_list_item' ); ?>>

                    <a class="card_image_link" href="<?php echo esc_url( get_permalink() ); ?>">
		                <div class="latest_post_item_thumb" style="background-image:url('<?php 
		                    echo ($hero_image['url'] ?? '') !== '' ? esc_url($hero_image['url']) : esc_url($trip_hero_image_text_url); 
		                ?>')">
		                </div>
		            </a>

                    <div class="latest_post_item_text">
                    	<span class="post-type-label"><?php echo esc_html($trip_dates); ?></span>
                        <a href="<?php echo esc_url( get_permalink() ); ?>">
		                    <h3 class="trip_title_lander"><?php echo esc_html($trip_name); ?></h3>
		                </a>
		                <div><?php echo do_shortcode($toc_info); ?></div>
		                <a href="<?php echo esc_url( get_permalink() ); ?>">Explore this AESU trip <i class="fa fa-arrow-right"></i></a>
		            </div>
		        </li>

            <?php endwhile; ?>
        </ul>

        <h2 class="related-articles-title" style="margin:2em 0 .5rem 0 !important;">Ready for your next adventure?</h2>
        <div style="text-align: center;"><a class="cta-button" style="font-size:20px;" href="<?php echo get_permalink(824) ?>">View all AESU trips <i class="fa fa-arrow-right"></i></a></div>

    </section>
<?php
endif;
wp_reset_postdata();
?>

</div>

</main><!-- #main -->

<?php
get_footer();
