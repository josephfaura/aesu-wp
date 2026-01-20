<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AWI_Revamped
 */

?>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("back_to_top");

  if (!btn) return; // if the markup isn't on the page, stop.

  btn.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
});
</script>

<!-- Show SMS Consent with Phone No. is entered in Newsletter Subscribe Contact Form -->
<script>
document.addEventListener('DOMContentLoaded', function () {
	const phone = document.querySelector('.subscribe_form input[name="sms-phone"]');
	const consentWrap = document.querySelector('.subscribe_form .wpcf7-acceptance');

	if (!phone || !consentWrap) return;

	// Hide initially
	consentWrap.style.display = 'none';

	phone.addEventListener('input', function () {
		if (phone.value.trim() !== '') {
			consentWrap.style.display = 'block';
		} else {
			consentWrap.style.display = 'none';
			const checkbox = consentWrap.querySelector('input[type="checkbox"]');
			if (checkbox) checkbox.checked = false;
		}
	});
});
</script>

<?php
// --------------------------------------------------
// Match header logic in footer (do NOT touch header)
// --------------------------------------------------

// Referrer check
$referrer = $_SERVER['HTTP_REFERER'] ?? '';
$referrer_header = null;

if ($referrer) {
    $ref_post_id = url_to_postid($referrer);
    if ($ref_post_id) {
        $referrer_header = get_field('header_type', $ref_post_id);
    }
}

// Current page header type
$current_header = get_field('header_type'); // AESU, AWT, empty

// Final logic: AWT wins if either is AWT, else AESU
$is_awt = (
    $referrer_header === 'AWT'
    || $current_header === 'AWT'
);

// Set footer values exactly like header logic
if ($is_awt) {
    // AWT
    $home_link = get_permalink(898);
    $footer_menu = 'awt_footer_nav';
    $show_social = false;
    $footer_label = 'Alumni World Travel';
} else {
    // AESU default
    $home_link = get_home_url();
    $footer_menu = 'footer_nav';
    $show_social = true;
    $footer_label = false;
}

// Check for social links //
$social_links = [];
if (function_exists('get_field') && !$is_awt) {
    $social_links = get_field('social_links', 'options') ?: [];
}
?>
	<footer class="site-footer">
		
		<section class="bottom_footer">
			<div class="container">
				<div class="bottom_footer_navinfo">
					<div class="footer_nav">
					    <?php wp_nav_menu( array( 'theme_location' => $footer_menu ) ); ?>
					</div>

					<div class="footer_info">

					    <?php if ( $show_social && !empty($social_links) ) : ?>
					        <ul class="bottom_footer_roundlinks">
					            <?php foreach ($social_links as $social_link) : ?>
					                <li><a href="<?php echo $social_link['social_link_url']; ?>" target="_blank">
					                    <img src="<?php echo $social_link['social_link_image']['url']; ?>">
					                </a></li>
					            <?php endforeach; ?>
					        </ul>
					    <?php endif; ?>

					    <a href="<?php echo $home_link; ?>">
					        <img src="<?php echo get_template_directory_uri() ?>/img/logo_footer.png" class="footer_logo">
					        <?php if ( $footer_label ) : ?>
					            <br><span><?php echo $footer_label; ?></span>
					        <?php endif; ?>
					    </a>

					</div>
				</div>
				<div class="bottom_footer_copyright_logos">
					<div class="bottom_footer_logos">
						<ul>
							<li class="bottom_logo_item"><img src="<?php echo get_template_directory_uri() ?>/img/logo-travel-for-good.png"></li>
							<li class="bottom_logo_item"><img src="<?php echo get_template_directory_uri() ?>/img/logo-iata.png"></li>
							<li class="bottom_logo_item"><img src="<?php echo get_template_directory_uri() ?>/img/logo-ecotourism.png"></li>
							<li class="bottom_logo_item"><img src="<?php echo get_template_directory_uri() ?>/img/logo-asta.png"></li>
							<li class="bottom_logo_item"><img src="<?php echo get_template_directory_uri() ?>/img/logo-arc.png"></li>
						</ul>
					</div>
					<div class="bottom_footer_copyright">
					<p class="copyright">© <?php echo date('Y'); ?> <span itemprop="name">AESU, Inc.</span> All Rights Reserved.<br>
					Website development in collaboration with <a href="http://www.advp.com" target="_blank">Adventure Web Digital</a></p>
					</div>
				</div>
			</div>
		</section>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
