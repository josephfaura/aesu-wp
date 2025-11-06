<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AWI_Revamped
 */
GLOBAL $detect;

$header_type = '';
$header_type_referrer = ''; // ensure defined for later checks

if (function_exists('get_field')) {
    $header_image = get_field('header_image') ? get_field('header_image') : get_field('default_header_image', 'option');
    // $header_image = ($detect->isMobile() && !$detect->isTablet()) ? $header_image['sizes']['large'] : $header_image['url'];

    if (is_singular('trips')) {
        $header_type = get_field('header_type', get_the_ID());
    } else {
        $header_type = get_field('header_type');
    }
}

/**
 * NEW: Force 404 pages to default to AESU
 * This guarantees the AESU header/logo/links on all 404s.
 */
if (is_404()) {
    $header_type = 'AESU';
    $header_type_referrer = ''; // neutralize any referrer logic later
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<?php if (is_singular('trips')): ?>
		<?php $hero_image_for_og = get_field('trip_hero_image', get_the_ID()); ?>
		<?php if (!empty($hero_image_for_og['url'])): ?>
			<meta property="og:image" content="<?php echo esc_url($hero_image_for_og['url']); ?>">
		<?php endif; ?>
	<?php endif; ?>

	<?php 
	$css_commits = function_exists('get_field') ? get_field('css_commits','option') : [];
	if (!empty($css_commits) && is_array($css_commits)):
		foreach ($css_commits as $css_commit):
			if (!empty($css_commit['activate_css']) && $css_commit['activate_css'] === 'True'): ?>
				<style>
					<?php echo $css_commit['css_code']; ?>
				</style>
	<?php 	endif;
		endforeach;
	endif; ?>

	<style>
		#menu-aesu-main-nav-1 > li{ display:none; }
		#menu-aesu-main-nav > li{  display:none; }
		.awiNav-wrap #menu-aesu-main-nav-1 > li{ display:block; }
		.awiNav-wrap #menu-aesu-main-nav > li{  display:block; }
	</style>

	<?php if(
		$_SERVER['REMOTE_ADDR'] != "50.242.219.73" &&
		$_SERVER['REMOTE_ADDR'] != "71.244.235.248" &&
		$_SERVER['REMOTE_ADDR'] != "98.204.75.105" &&
		$_SERVER['REMOTE_ADDR'] != "174.172.196.238"
	): ?>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-DV23ZYP1X4');
</script>
<?php endif; ?>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);
t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}
(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '824453369658979'); fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=824453369658979&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'awi-revamped' ); ?></a>

	<?php if (is_user_logged_in()): ?>
		<style>
			header{ top:32px; }
		</style>
	<?php endif; ?>

	<?php
	// Decide links based on header type (and referrer later)
	if ($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu") {
		$contact_link = get_permalink(11601);
		$home_link    = get_home_url();
	} else {
		$contact_link = get_permalink(2836);
		$home_link    = get_permalink(898);
	}
	?>

	<style>
		.mobile_header{ display:none; }
		@media screen and (max-width:879px){
			.mobile_header{ display:block; padding:18px 32px; }
			.desktop_header{ display:none; }
			.nav-logo { display: flex; }
			.top_nav_account_wrap{ display: flex; flex-direction: row; }
			.top_nav_account_wrap .top_account_area i { font-size: 24px; padding-right:0; padding-left:10px; }
			header .container .inner-header{ flex-direction:row; }
			.logo_wrap span{ padding-right:10px; }
			.logo_wrap svg { height: 45px; width: 95px; padding-right: 10px; border-right: 2px solid #fff; }
			.logo_wrap{ padding-left:45px; }
			.awiNav__trigger { top: 3px; }
			.awiNav__trigger span{ margin:0; }
		}
		@media screen and (max-width:900){
			.bottom_footer .container { padding-top:30px; }
		}
		@media screen and (max-width:443px){
			.mobile_header{ padding:20px; }
			.awiNav__trigger { top: 0; }
			.logo_wrap svg { height: 35px; width: 85px; padding-right: 10px; border-right: 2px solid #fff; }
		}
		@media screen and (max-width:420px){
			header .container{ padding:0 }
			.bottom_footer .container { padding-top:15px; }
		}
		a.header_cart.:hover, a.header_cart:active { color: #fff; }
	</style>
		
	<header class="mobile_header">
		<div class="container">
			<div class="inner-header">

				<?php
				// Referrer logic (kept as in your original; neutralized on 404 by setting $header_type_referrer='')
				$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
				$is_awt_referrer = false;
				if ($referrer) {
					$referrer_id = url_to_postid($referrer);
					if ($referrer_id && function_exists('get_field')) {
						$header_type_referrer = get_field('header_type', $referrer_id);
						if ($header_type_referrer === 'AWT') {
							$is_awt_referrer = true;
						}
					}
				}
				?>

				<?php if ($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu"): ?>
					<nav>
						<?php wp_nav_menu( array( 'theme_location' => 'main_nav', 'menu_class' => 'awiNav' ) ); ?>
					</nav>
				<?php endif; ?>

				<div class="logo_wrap"><a href="<?php echo esc_url($home_link); ?>">
					<svg class="icon">
						<use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#icon-cropped-logo-full"></use>
					</svg>
				</a>
				<?php if ($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu"):
						$contact_link = get_permalink(11601);
						$home_link    = get_home_url();
					?>
					<span>Since 1977</span>
				<?php else:
						$contact_link = get_permalink(2836);
						$home_link    = get_permalink(898); ?>
					<style>
						@media screen and (max-width: 879px) {
							.logo_wrap { padding-left: 0; }
						}
					</style>
					<span>Alumni World Travel</span>
				<?php endif; ?>
				</div>

				<div class="header_right">
					<?php $school_logo = function_exists('get_field') ? get_field('school_logo') : null; ?>
					<?php if (is_page_template('page-school-landing-page.php') && $school_logo): ?>
						<?php /* <img class="header_school_logo" src="<?php echo esc_url($school_logo['url']); ?>"> */ ?>
					<?php endif; ?>

					<div class="top_nav_account_wrap">
						<span class="top_account_area"><a href="https://res.aesu.com/res/STWMain.aspx?Theme=AWT&Action=Home" target="_blank"><i class="fa-solid fa-circle-user"></i></a></span>
						<span class="top_account_area"><a class="header_phone" href="tel:8006387640"><i class="fa-solid fa-phone"></i></a></span>
						<span class="top_account_area"><a class="contact_page_link" href="<?php echo esc_url($contact_link); ?>"><i class="fa-solid fa-message"></i></a></span>
					</div>
				</div>

			</div>
		</div>
	</header><!-- #masthead -->

	<header class="desktop_header">
		<div class="container">
			<div class="inner-header">
				<div class="logo_wrap"><a href="<?php echo esc_url($home_link); ?>">
					<svg class="icon">
						<use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#icon-cropped-logo-full"></use>
					</svg>
				</a>
				<?php
				// Repeat referrer logic (as in your original; 404 neutralized)
				$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
				$is_awt_referrer = false;
				if ($referrer) {
					$referrer_id = url_to_postid($referrer);
					if ($referrer_id && function_exists('get_field')) {
						$header_type_referrer = get_field('header_type', $referrer_id);
						if ($header_type_referrer === 'AWT') {
							$is_awt_referrer = true;
						}
					}
				}
				?>

				<?php if ($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu"):
						$contact_link = get_permalink(11601);
						$home_link    = get_home_url();
					?>
					<span>Expanding Horizons <br/>Since 1977</span>
				<?php else:
						$contact_link = get_permalink(2836);
						$home_link    = get_permalink(898); ?>
					<span>Alumni World Travel<br />Expanding Horizons Since 1977</span>
				<?php endif; ?>
				</div>

				<div class="header_right">
					<?php $school_logo = function_exists('get_field') ? get_field('school_logo') : null; ?>
					<?php if (is_page_template('page-school-landing-page.php') && $school_logo): ?>
						<img class="header_school_logo" style="width:auto;" src="<?php echo esc_url($school_logo['url']); ?>">
					<?php endif; ?>

					<?php if ($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu"): ?>
						<nav>
							<?php wp_nav_menu( array( 'theme_location' => 'main_nav', 'menu_class' => 'awiNav' ) ); ?>
						</nav>
					<?php endif; ?>

					<div class="top_nav_account_wrap">
						<span class="top_account_area">
							<a href="https://res.aesu.com/res/STWMain.aspx?Theme=AWT&amp;Action=Home
https://res.aesu.com/res/STWMain.aspx?Theme=AESU&amp;Action=Home" target="_blank">
								<i class="fa-solid fa-circle-user"></i>  My Account
							</a>
						</span>

						<span class="top_account_area">
							<a class="header_cart" href="https://res.aesu.com/res/STWMain.aspx?Theme=AWT&amp;Action=Home
https://res.aesu.com/res/STWMain.aspx?Theme=AESU&amp;Action=Home" target="_blank">
								<i class="fa-solid fa-cart-shopping"></i> My Cart
							</a>
						</span>

						<span class="top_account_area">
							<a class="contact_page_link" href="<?php echo esc_url($contact_link); ?>">
								<i class="fa-solid fa-message"></i> Contact Us
							</a>
						</span>

						<span class="top_account_area">
							<a class="header_phone" href="tel:8006387640"><i class="fa-solid fa-phone"></i> 800.638.7640</a>
						</span>
          			</div>
				</div>

			</div>
		</div>
	</header><!-- #masthead -->

<?php if (!empty($header_image) && !is_front_page()) : ?>
	<div class="interior-banner" style="background-image:url('<?php echo esc_url(is_array($header_image) ? $header_image['url'] : $header_image); ?>');"></div>
<?php endif; ?>
