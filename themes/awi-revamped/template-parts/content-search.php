<?php
/**
 * Template part for displaying results in search pages (card layout)
 *
 * @package AWI_Revamped
 */
?>

<li <?php post_class( 'latest_posts_list_item' ); ?>>

	<?php
	$thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	if ( ! $thumb ) {
		$thumb = get_first_image_url();
	}

	$post_type = get_post_type_object( get_post_type() );
	?>

	<a href="<?php the_permalink(); ?>">
		<div class="latest_post_item_thumb"
		     style="background-image:url(<?php echo esc_url( $thumb ); ?>)">
		</div>
	</a>

	<div class="latest_post_item_text">

		<span class="post-type-label">
			<?php echo esc_html( $post_type->labels->singular_name ); ?>
		</span>

		<a href="<?php the_permalink(); ?>">
			<h3><?php the_title(); ?></h3>
		</a>

		<p><?php echo esc_html( get_search_excerpt( get_the_ID(), 25 ) ); ?></p>

		<a href="<?php the_permalink(); ?>">
			Read more <i class="fa fa-arrow-right"></i>
		</a>

	</div>

</li>