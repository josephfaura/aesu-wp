<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AWI_Revamped
 */

?><?php if(get_field('duplicate_page_check')) {
	$dupID = get_field('duplicate_page_source');
} ?>

<?php if (is_home() || is_single() || is_archive()) { ?>

<div class="sidebar">
	<ul>
		<?php dynamic_sidebar(); ?>
	</ul>
</div>
<?php } else { ?>
<?php if(have_rows('sidebar_videos',$dupID)): ?>
<div class="embed-container">
	<?php while( have_rows('sidebar_videos',$dupID) ): the_row(); 
			$url = get_sub_field('video');
			parse_str( parse_url( $url, PHP_URL_QUERY ), $urlID );
			$videoID = $urlID ['v']; ?>
	<iframe src="https://www.youtube.com/embed/<?php echo $urlID['v']; ?>" frameborder="0" allowfullscreen></iframe>
	<?php endwhile; ?>
</div>
<?php endif; ?>
<?php if(get_field('include_newsletter_signup')) { ?>
<div class="newsletter">
	<?php if(get_field('newsletter_image')) {
		$newsletter_image = get_field('newsletter_image');
	} else {
		$newsletter_image = get_template_directory_uri().'/img/placeholder-girl-at-geyser.jpg';
	} ?>
	<div class="just-go-frame" style="background-image:url(<?php echo $newsletter_image; ?>);"><img src="<?php echo get_template_directory_uri();?>/img/mask-just-go.png"></div>
	<div class="wrapper clearfix">
		<h3>AESU Free Newsletter</h3>
		<?php echo do_shortcode('[contact-form-7 id="4e4635f" title="Newsletter Signup"]'); ?> </div>
</div>
<?php } ?>
<?php the_field('sidebar_block',$dupID); ?>
<?php } ?>
