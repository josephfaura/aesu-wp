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

<style>
	.post-type-label{ /* what type of page or post type it is */
		font-size: 12px;
		font-weight: 700;
		letter-spacing: 0.05em;
		text-transform: uppercase;
		color: #777;
		margin-bottom: 8px;
		display: inline-block;
	}
	.lastest_post_item_thumb{
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
		background-color: #f2f2f2; /* neutral fallback */
	}
</style>


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


			<ul class="lastest_posts_list">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'search' ); ?>
				<?php endwhile; ?>

			</ul>

			<?php
				the_posts_navigation(
				    array(
				        'prev_text'          => __( '&#8592; Previous', 'textdomain' ),
				        'next_text'          => __( 'Next &#8594;', 'textdomain' ),
				    )
				);
			?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</div>
	</main><!-- #main -->

<?php
get_footer();
