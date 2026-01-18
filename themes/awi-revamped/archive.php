<?php
/**
 * Archive Template
 *
 * @package AWI_Revamped
 */

get_header();
?>

<style>
	.archive-header {
		text-align:center;
		margin-bottom:3rem;
	}
	.category .page-title {
		margin: 0 auto;
	}
	.archive-count {
		padding-top:1em;
		font-size: 14px;
	    margin: 1em auto;
	    text-align: center;
	    text-transform: uppercase;
	    letter-spacing: .05em;
	    font-weight: 600;
	    position: relative;
	    color:#777;
	}
	.archive-count::before {
	    content: "";
	    position: absolute;
	    top: 0px;
	    left: 50%;;
	    transform: translateX(-50%);
	    display: block;
	    width: 50px;
	    height: 2px;
	    background-color: #777;
	}
	.archive-description {
		width:60%;
		margin:auto;
	}
	@media screen and (max-width:675px) {
		.archive-description {
			width:100%;
		}
	}

</style>

<div class="no-banner"></div>

<main id="primary" class="site-main">
<div class="container">

	<?php if ( have_posts() ) : ?>

		<?php
		// CATEGORY ARCHIVES — special layout
		if ( is_category() ) :

			$archive_title = single_cat_title( '', false );
			?>

			<div class="archive-header">
				<h4 class="blog-type-label">Category</h4>
				<h1 class="page-title"><?php echo esc_html( $archive_title ); ?></h1>
				<?php
				$category = get_queried_object();
				echo '<p class="archive-count">' . $category->count . ' posts</p>';
				?>
				<?php if ( get_the_archive_description() ) : ?>
					<div class="archive-description"><?php echo wp_kses_post( get_the_archive_description() ); ?></div>
				<?php endif; ?>
			</div>

		<?php
		// EVERYTHING ELSE — match search styling
		else :
			$archive_title = get_the_archive_title();
			?>

			<div class="header">
				<h2 class="page-title">
					<?php echo wp_kses_post( $archive_title ); ?>
				</h2>
			</div>

			<?php if ( get_the_archive_description() ) : ?>
				<div class="archive-description"><?php echo wp_kses_post( get_the_archive_description() ); ?></div>
			<?php endif; ?>

		<?php endif; ?>

		<ul class="latest_posts_list">
			<?php while ( have_posts() ) : the_post(); ?>
				<li <?php post_class( 'latest_posts_list_item' ); ?>>

					<?php
					$thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					if ( ! $thumb ) {
						$thumb = get_first_image_url();
					}

					$post_type = get_post_type_object( get_post_type() );
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

						<a href="<?php the_permalink(); ?>">
							Read more <i class="fa fa-arrow-right"></i>
						</a>

					</div>

				</li>
			<?php endwhile; ?>
		</ul>

		<?php
		/* pagination copied from search.php */
		global $wp_query;
		$big = 999999999;

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
		    <nav class="pagination-wrapper">
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

<?php get_footer(); ?>