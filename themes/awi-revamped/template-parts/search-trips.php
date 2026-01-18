<?php
/**
 * Template for Trip Search Results
 * URL example: /?s=italy&post_type=trips
 */

?>

<style>
	.banner_interior h3 {
		text-transform: capitalize;
	}
</style>

<?php
global $wp_query;

$thumb_url = ''; // default empty

if ( $wp_query->have_posts() ) {
    // Peek at the first post
    $first_post = $wp_query->posts[0];
    $first_id   = $first_post->ID;

    // Featured first
    $featured = get_the_post_thumbnail_url( $first_id, 'full' );

    // ACF fallbacks
    $hero_image    = get_field( 'trip_hero_image', $first_id );
    $hero_fallback = get_field( 'trip_hero_image_text_url', $first_id );

    // Determine best available
    $thumb_url = $featured
        ?: ( !empty($hero_image['url']) ? $hero_image['url'] : $hero_fallback );
}

// If we found any usable image, show banner; otherwise show no-banner
if ( ! empty( $thumb_url ) ) : ?>
    
    <div class="banner_interior" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');">
        <div class="container">
            <h3><?php echo esc_html( get_search_query() ); ?></h3>
            
            <!--<a href="<?php echo get_permalink(824) ?>" class="button cta-button">Search Other Trips</a>-->


            <p><form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
			<label>
			<span class="screen-reader-text" for="trip-search">Where would you like to go?</span>
			<i class="fa fa-search"></i>
			<input type="search" id="trip-search" class="search-field" placeholder="Where do you want to go?" value="" name="s">
			</label>
			<input type="submit" class="search-submit" value="Find My Trip">
			<input type="hidden" name="post_type" value="trips" />
			</form></p>
        </div>
    </div>

<?php else : ?>

    <div class="no-banner"></div>

<?php endif; ?>

<main id="primary" class="site-main">
	<div class="container">

	<?php if ( have_posts() ) : ?>

			<div class="header">
				<h2 class="page-title">
					<?php
					printf(
						esc_html__( 'Trip Results: %s', 'awi-revamped' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h2>
			</div>

	<ul class="latest_posts_list trips-search-list">

		<?php while ( have_posts() ) : the_post();
			$hero_image = get_field('trip_hero_image');
			$hero_fallback = get_field('trip_hero_image_text_url');
			$trip_name = get_field('trip_name');
			$trip_dates = get_field('trip_dates');
			$toc_info = get_field('toc_info');
		?>

			<li <?php post_class( 'latest_posts_list_item' ); ?>>

				<a class="card_image_link" href="<?php the_permalink(); ?>">
					<div class="latest_post_item_thumb" style="background-image:url('<?php 
						echo (! empty($hero_image['url'])) ? esc_url($hero_image['url']) : esc_url($hero_fallback);
					?>')"></div>
				</a>

				<div class="latest_post_item_text">

					<span class="post-type-label">
						<?php echo esc_html( $trip_dates ); ?>
					</span>

					<a href="<?php the_permalink(); ?>">
						<h3 class="trip_title_lander">
							<?php echo esc_html( $trip_name ?: get_the_title() ); ?>
						</h3>
					</a>

					<div><?php echo do_shortcode( $toc_info ); ?></div>

					<a class="trip-readmore" href="<?php the_permalink(); ?>">
						Explore this trip <i class="fa fa-arrow-right"></i>
					</a>

				</div>

			</li>

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
</main>

		<section class="footer_cta">
			<h2>Ready for Your Next Adventure?</h2>
			<a href="<?php echo get_permalink(824) ?>" class="cta-button">View All Trips</a>
		</section>

<?php get_footer();