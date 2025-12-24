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
	.search-results .header {
		text-align: center;
	}
	.search-results .page-title {
		display: inline-block;
		font-size: 1.25rem;
		padding: 0.5rem 0.8rem;
		border:1px solid #2c768e;
		border-radius: 3px;
		font-weight: 600;
		color:#2c768e;
		box-decoration-break: clone;
	}
	.latest_post_item_thumb{
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
		background-color:rgba(0,0,0,.4); /* neutral fallback */
	}
	.pagination-wrapper {
	    text-align: center;
	    margin: 2em 0;
		}

	.pagination {
	    list-style: none;
	    padding: 0;
	    display: inline-flex;
	    flex-wrap: wrap;       /* allow wrapping on small screens */
	    gap: 0.5em;
	    justify-content: center; /* center the links */
	    align-items: center;
	}

	.pagination li a,
	.pagination li span {
	    display: block;
	    padding: 0.4em 0.6em;
	    border: 1px solid #2C768E;
	    text-decoration: none;
	    border-radius: 3px;
	    min-width: 2em;
	    text-align: center;
	}

	.pagination li .current {
	    font-weight: bold;
	    background-color:#2C768E;
	    color: #fff;
	}
	.pagination li :hover {
	    font-weight: bold;
	    background-color:#2C768E;
	    color: #fff;
	}

	/* Optional: make Previous/Next links slightly bolder */
	.pagination li:first-child a,
	.pagination li:last-child a {
	    font-weight: bold;
	}

	/* Mobile tweaks */
	@media (max-width: 480px) {
	    .pagination li a,
	    .pagination li span {
	        padding: 0.2em 0.4em;
	        min-width: 1.6em;
	        font-size: 0.8em;
	    }
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
