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
	</main><!-- #main -->

<?php
get_footer();
