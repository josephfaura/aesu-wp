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
document.addEventListener('DOMContentLoaded', function() {

    // Helper to load external scripts asynchronously
    function loadScript(src, async = true, defer = true) {
        const s = document.createElement('script');
        s.src = src;
        s.async = async;
        s.defer = defer;
        document.body.appendChild(s);
    }

    // Load scripts after first interaction OR after page load
    function initThirdParty() {
        // GA / GTM
        loadScript('https://www.googletagmanager.com/gtag/js?id=G-DV23ZYP1X4');
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-DV23ZYP1X4');

        // Facebook Pixel
        loadScript('https://connect.facebook.net/en_US/fbevents.js');
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}
        (window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '824453369658979');
        fbq('track', 'PageView');

        // ContentSquare
        loadScript('https://t.contentsquare.net/smb/tag.js');
    }

    // Trigger on first user interaction
    ['mousemove','keydown','touchstart','scroll','focus'].forEach(event => {
        window.addEventListener(event, initThirdParty, {once:true});
    });

    // Fallback: after 5 seconds if no interaction
    setTimeout(initThirdParty, 5000);
});
</script>

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
