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
?>
<style>
	.top-categories-list, .top-tags-list {
    margin: 2rem 0;
    padding: 0;
    list-style: none;
    text-align: center;
	}

	.top-categories-list li, .top-tags-list li {
	    display: inline-block;
	    margin: 0 .4rem .6rem 0; /* spacing between tags and categories */
	}

	.top-categories-list a, .top-tags-list a {
	    display: inline-block;
	    padding: .5rem .8rem;
	    border: 1px solid #2c768e;
	    border-radius: 3px;
	    font-weight: 600;
	    color: #2c768e;
	    text-decoration: none;
	    box-decoration-break: clone;
	    -webkit-box-decoration-break: clone; /* Safari */
	    transition: background .2s ease, color .2s ease;
	}

	.top-categories-list a:hover, .top-tags-list a:hover {
	    background: #2c768e;
	    color: #fff;
	}

	/*.wp-posts-list{
		list-style: none;
		margin:0;
		padding:0;
	}
	.wp-posts-list > li{
		margin-left:0;
		text-align: left;
		margin-bottom:15px;
		padding-bottom:15px;
		border-bottom:1px solid #000;
	}
	.wp-posts-list p{
		margin:10px 0;
	}
	.post_list article{
		width:100%!important;
	}
	.postmetadata-list{
		list-style: none;
		display: flex;
		gap:10px;
		margin-left:0;
		padding-left:0;
	}
	.sidebar ul{
		padding:0;
	}
	.sidebar{
		max-width:300px;
		margin-left:20px;
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
	}
	body main article{
		width: calc(100% - 286px);
	}
	@media screen and (max-width:982px){
		#primary .container{
			display:block;
		}
		article, .sidebar{
			float:none!important;
			width:100%!important;
		}
	}
	@media screen and (max-width:672px){
		.wp-posts-list li{
			display:block;
		}
		.blog_thumbnail{
			height:200px;
			min-width:100%;
			margin-bottom:20px;
		}
	}*/
</style>
<?php
// Get the ID of the Posts Page (from Settings → Reading)
$posts_page_id = get_option('page_for_posts');

// Get the featured image URL for that page
$banner_img = get_the_post_thumbnail_url( $posts_page_id, 'full' );
?>

<?php if ( $banner_img ) : ?>

	<div class="banner_interior">
		<div class="flexslider clearfix">
			<ul class="slides">
				<li style="background-image:url('<?php echo esc_url( $banner_img ); ?>');"></li>
			</ul>
		</div>
	</div>

<?php else : ?>

	<div class="no-banner"></div>

<?php endif; ?>

<main id="primary" class="site-main">
<div class="container">

	<h4 class="blog-type-label">Latest From Us</h4>
	<h1 class="page-title">
		<?php echo esc_html( get_the_title( get_option('page_for_posts') ) ); ?>
	</h1>

	<?php $shown_posts = array(); ?>
	<?php $count = 0; ?>
<ul class="latest_posts_list">
<?php while ( have_posts() ) : the_post(); 
	$shown_posts[] = get_the_ID(); // store this post to avoid duplicates
	$count++;
?>
    <li <?php post_class( $count === 1 ? 'latest_posts_list_item first-post' : 'latest_posts_list_item' ); ?>>
        <?php
        $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: get_first_image_url();
        ?>
        
        <?php if ( $count === 1 ) : ?>
            <!-- Featured Layout for First Post -->
            <div class="first-post-container">
                <div class="first-post-image" style="background-image:url('<?php echo esc_url($thumb); ?>');"></div>
                <div class="first-post-content">
					<?php
					$categories = get_the_category();
					$cat = ! empty( $categories ) ? $categories[0] : null;
					?>
					<h4 class="first-post-category"><?php echo esc_html( $cat->name ); ?></h4>
                   <h3><?php the_title(); ?></h3>
                    <span class="post-type-label">Published on <?php echo get_the_date('m.d.y'); ?></span>
                    <p><?php echo esc_html( get_search_excerpt( get_the_ID(), 50 ) ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="cta-button first-post-cta">Read The Full Story</a>
                </div>
            </div>
        <?php else : ?>
            <!-- Normal Post Layout -->
            <a class="card_image_link" href="<?php the_permalink(); ?>">
                <div class="latest_post_item_thumb" style="background-image:url('<?php echo esc_url($thumb); ?>')"></div>
            </a>
            <div class="latest_post_item_text">
                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                <span class="post-type-label">Published on <?php echo get_the_date('m.d.y'); ?></span>
                <p><?php echo esc_html( get_search_excerpt( get_the_ID(), 25 ) ); ?></p>
                <a href="<?php the_permalink(); ?>">Read more <i class="fa fa-arrow-right"></i></a>
            </div>
        <?php endif; ?>
    </li>
<?php endwhile; ?>
</ul>

<?php
// Top 10 Tags by Post Count (Displayed Once After Main Loop)
$top_tags = get_terms( array(
    'taxonomy'   => 'post_tag',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'number'     => 10,
    'hide_empty' => true,
) );

if ( ! empty( $top_tags ) && ! is_wp_error( $top_tags ) ) : ?>

	<h4 class="center">Popular Topics</h4>

    <ul class="top-tags-list">
        <?php foreach ( $top_tags as $tag ) : ?>
            <li>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">
                    <?php echo esc_html( $tag->name ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>




<?php
// 1. Get categories (we'll sort them manually)
$categories = get_categories(array(
    'hide_empty' => true
));

$category_dates = array();

// 2. Get most recent post date for each category
foreach ( $categories as $cat ) {

    $latest_post = get_posts(array(
        'category'       => $cat->term_id,
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids'
    ));

    if ( !empty($latest_post) ) {
        $latest_post_id = $latest_post[0];
        $category_dates[$cat->term_id] = get_the_date('U', $latest_post_id); // UNIX timestamp
    }
}

// 3. Sort categories by most recent post
arsort($category_dates);

// 4. Keep the top 2 category IDs
$top_cat_ids = array_slice(array_keys($category_dates), 0, 2, true);

// 5. Loop through each category in that order
$displayed_cats = array(); // before the loop

foreach ( $top_cat_ids as $cat_id ) :
    $displayed_cats[] = $cat_id; // store displayed category IDs

    $cat = get_category( $cat_id );

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'cat'            => $cat_id,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post__not_in'   => $shown_posts, // ⬅ avoid duplicates
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) : ?>


<section class="related-articles">
    <h2 class="related-articles-title">Latest in <?php echo esc_html( $cat->name ); ?></h2>

    <ul class="latest_posts_list">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <li <?php post_class( 'latest_posts_list_item' ); ?>>
            <?php
            $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            if ( ! $thumb && function_exists('get_first_image_url') ) {
                $thumb = get_first_image_url();
            }
            ?>
            <a class="card_image_link" href="<?php the_permalink(); ?>">
                <div class="latest_post_item_thumb" style="background-image:url('<?php echo esc_url($thumb); ?>');"></div>
            </a>

            <div class="latest_post_item_text">
                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                <span class="post-type-label">Published on <?php echo get_the_date('m.d.y'); ?></span>
                <p><?php echo wp_trim_words( get_the_excerpt(), 25 ); ?></p>
                <a class="blog_cta" href="<?php the_permalink(); ?>">Read more <i class="fa fa-arrow-right"></i></a>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>

    <div class="center" style="margin-top: 32px;">
        <strong>
            <a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>">
                Explore more stories in <?php echo esc_html( $cat->name ); ?> <i class="fa fa-arrow-right"></i>
            </a>
        </strong>
    </div>

</section>

<?php
    endif;
    wp_reset_postdata();

endforeach;

?>

<?php
// Exclude categories already displayed
$exclude_ids = $displayed_cats ?? array();

// Get all categories with posts only (post_type = 'post')
$all_cats = get_terms( array(
    'taxonomy'   => 'category',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => false, // we’ll filter manually
    'exclude'    => $exclude_ids,
) );

$top_cats = array();

foreach ( $all_cats as $cat ) {
    // Check if this category has posts of type 'post'
    $post_count = wp_count_posts_in_category( $cat->term_id, 'post' );
    if ( $post_count > 0 ) {
        $top_cats[] = $cat;
    }
    // Stop after 10 categories
    if ( count( $top_cats ) >= 10 ) {
        break;
    }
}

// Helper function
function wp_count_posts_in_category( $cat_id, $post_type = 'post' ) {
    $count_posts = new WP_Query( array(
        'post_type'      => $post_type,
        'posts_per_page' => 1,
        'cat'            => $cat_id,
        'fields'         => 'ids',
    ) );
    return $count_posts->found_posts;
}

if ( ! empty( $top_cats ) ) : ?>
    
    <h4 class="center">Popular Categories</h4>

    <ul class="top-categories-list">
        <?php foreach ( $top_cats as $cat ) : ?>
            <li>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>



<?php

// Check if every post has a start_date value
$all_have_start_date = true;
foreach ( $all_trips as $trip_id ) {
    if ( ! get_field( 'start_date', $trip_id ) ) {
        $all_have_start_date = false;
        break;
    }
}

// Arguments for trips with ACF header-type = AESU
$trips_args = array(
    'post_type'      => 'trips',          // custom post type
    'posts_per_page' => 3,                // number of trips to show
    'post__not_in'   => array( get_the_ID() ), // exclude current post
    'meta_query'     => array(             // filter by ACF field
        array(
            'key'     => 'header_type',
            'value'   => 'AESU',
            'compare' => '=',
        ),
    ),
);

if ( $all_have_start_date ) {
    $trips_args['meta_key']  = 'start_date';
    $trips_args['orderby']   = 'meta_value';
    $trips_args['meta_type'] = 'DATE';
    $trips_args['order']     = 'ASC';
} else {
    // fallback ordering if not all have start_date
    $trips_args['meta_key'] = 'trip_name';
    $trips_args['orderby']  = 'meta_value';
    $trips_args['order']    = 'ASC';
}


$trips_query = new WP_Query( $trips_args );

if ( $trips_query->have_posts() ) : ?>
    <section class="related-articles">

        <h2 class="related-articles-title">Latest Trips</h2>

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
		                <a href="<?php echo esc_url( get_permalink() ); ?>">Explore this trip <i class="fa fa-arrow-right"></i></a>
		            </div>
		        </li>

            <?php endwhile; ?>
        </ul>

    </section>
<?php
endif;
wp_reset_postdata();
?>

</div>
</main>

		<section class="footer_cta">
			<h2>Ready for Your Next Adventure?</h2>
			<a href="<?php echo get_permalink(824) ?>" class="cta-button">View All Trips</a>
		</section>

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

<?php get_footer(); ?>