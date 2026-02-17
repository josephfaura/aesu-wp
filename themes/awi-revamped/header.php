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
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php if ( is_front_page() ) : ?>
		<style id="critical-css">
		/* =========================
		   Critical CSS – Homepage
		   (Mobile-safe, CLS-safe)
		========================= */

		/* Base */
		html {
		    box-sizing: border-box;
		    line-height: 1.15;
		    -webkit-text-size-adjust: 100%;
		}

		*, *::before, *::after {
		    box-sizing: inherit;
		}

		body {
		    margin: 0;
		    background: #fff;
		}

		/* Typography */
		body,
		input {
		    font-family: 'open-sans', -apple-system, BlinkMacSystemFont,
		                 "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell,
		                 "Helvetica Neue", sans-serif;
		    font-size: 1rem;
		    line-height: 1.5;
		    font-weight: 500;
		    color: #5E5E5E;
		}

		h1 {
		    font-size: 3.5em;
		    font-weight: 700;
		    line-height: 1.25em;
		}

		h2 {
		    font-size: 2.6em;
		    font-weight: 700;
		    line-height: 1.25em;
		}

		/* Layout container */
		.container {
		    max-width: 1300px;
		    margin: 0 auto;
		    padding: 0 32px;
		    position: relative;
		}

		/* Header – lock height & position */
		header {
		    position: fixed;
		    top: 0;
		    left: 0;
		    width: 100%;
		    min-height: 80px;
		    z-index: 9999;
		    background-color: #3a3a3a;
		    color: #fff;
		    padding: 18px 56px;
		}

		header a {
		    color: #fff;
		    text-decoration: none;
		}

		/* Hero / Banner (structure only) */
		.banner {
		    min-height: 100vh;
		    display: flex;
		    align-items: center;
		    justify-content: center;
		    background-size: cover;
		    background-position: center;
		    position: relative;
		    margin-bottom: 56px;
		}

		.banner::after {
		    content: '';
		    position: absolute;
		    inset: 0;
		    background-color: rgba(0, 0, 0, 0.4);
		    z-index: 1;
		}

		.banner > * {
		    position: relative;
		    z-index: 2;
		    color: #fff;
		    text-align: center;
		}

		/* Hero text */
		.banner h1 {
		    font-size: 75px;
		    line-height: 1em;
		    margin-bottom: 1.25rem;
		}

		.banner h2 {
		    font-size: 1.5rem;
		    font-weight: 500;
		    letter-spacing: 0.05rem;
		}

		/* Search form (above-the-fold) */
		.search-form {
		    display: flex;
		    align-items: center;
		    gap: 0.75rem;
		    width: 100%;
		}

		.search-form label {
		    width: 100%;
		    position: relative;
		}

		.search-form input[type="search"] {
		    width: 100%;
		    padding: 8px;
		    border: 0;
		}
		</style>
	<?php endif; ?>

	<?php wp_head(); ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<?php if(is_singular('trips')){ ?>
		<?php $hero_image_for_og = get_field('trip_hero_image',get_the_ID()); ?>
		<?php //print_r($hero_image_for_og); ?>
		<meta property="og:image" content="<?php echo $hero_image_for_og['url'] ?>">
	<?php } ?>
	<?php 
	$css_commits = get_field('css_commits','option');
	foreach($css_commits as $css_commit){ ?>
		<?php if($css_commit['activate_css'] == 'True'){ ?>
			<style>
				<?php echo $css_commit['css_code'] ?>
			</style>
		<?php } ?>
	<?php } ?>
	<style>
		#menu-aesu-main-nav-1 > li{
			display:none;
		}
		#menu-aesu-main-nav > li{
			display:none;
		}
		.awiNav-wrap #menu-aesu-main-nav-1 > li{
			display:block;
		}
		.awiNav-wrap #menu-aesu-main-nav > li{
			display:block;
		}
	</style>
	<?php if($_SERVER['REMOTE_ADDR'] != "50.242.219.73" && $_SERVER['REMOTE_ADDR'] != "71.244.235.248" && $_SERVER['REMOTE_ADDR'] != "68.33.31.231" && $_SERVER['REMOTE_ADDR'] != "174.172.196.238"){ ?>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-DV23ZYP1X4');
	</script>
	<?php } ?>

<!-- Meta Pixel Code -->

<script>

!function(f,b,e,v,n,t,s)

{if(f.fbq)return;n=f.fbq=function(){n.callMethod?

n.callMethod.apply(n,arguments):n.queue.push(arguments)};

if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';

n.queue=[];t=b.createElement(e);t.async=!0;

t.src=v;s=b.getElementsByTagName(e)[0];

s.parentNode.insertBefore(t,s)}(window, document,'script',

'https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '824453369658979');

fbq('track', 'PageView');

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
<?php if(is_user_logged_in()){ ?>
		<style>
			header{
				top:32px;
			}
			@media screen and (max-width:879px){
				header{
					top:46px;
				}
			}
			@media screen and (max-width: 600px) {
			    #wpadminbar {
			        position: fixed;
			    }
			}
		</style>
<?php } ?>
		<style>
			.mobile_header{
				display:none;
			}
			@media screen and (max-width:879px){
				.mobile_header{
					display:block;
					padding:24px;
				}
				.desktop_header{
					display:none;
				}
				.top_nav_account_wrap{
					display: flex;
					flex-direction: row;
					gap:1rem;
				}
				.top_nav_account_wrap .top_account_area i {
					font-size: 24px;
					padding-right:0;
				}
				header .container .inner-header{
					flex-direction:row;
				}
			}
			@media screen and (max-width:443px){
				.logo_wrap svg {
					height: 35px;
					width: 85px;
				}
			}
			@media screen and (max-width:400px){
			    .inner-header {
			        flex-wrap: wrap;
			        justify-content: center !important;
			    }
			}
		</style>
		
<?php
/**
 * Header template
 */

// 1. Determine bespoke FIRST
$is_bespoke = false;

if ( function_exists('is_singular') && function_exists('get_queried_object_id') ) {

    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    if ( $post_id && is_singular( array('tours', 'tour') ) ) {
        $type = function_exists('get_field')
            ? get_field('tour_template_type', $post_id)
            : get_post_meta($post_id, 'tour_template_type', true);

        $is_bespoke = ( strtolower( trim( (string) $type ) ) === 'bespoke' );
    }
}

// --------------------------------------
// Determine referrer header type (RUN ONCE)
// --------------------------------------
$referrer = $_SERVER['HTTP_REFERER'] ?? '';
$referrer_header = null;

if ($referrer) {
    $ref_post_id = url_to_postid($referrer);
    if ($ref_post_id) {
        $referrer_header = get_field('header_type', $ref_post_id);
    }
}

// --------------------------------------
// Determine current post header type
// --------------------------------------
$current_header = get_field('header_type'); // AESU, AWT, or empty

// --------------------------------------
// FINAL LOGIC:
// AWT wins when:
//   - referrer header == AWT
//   - OR current header == AWT
// Otherwise default = AESU
// --------------------------------------
$is_awt = (
    $referrer_header === 'AWT'
    || $current_header === 'AWT'
);

// --------------------------------------
// Shared links + labels (DEFINE ONCE)
// Priority: BESPOKE > AWT > AESU
// --------------------------------------
if ($is_bespoke) {

    // BESPOKE SETTINGS
    $contact_link = get_permalink(3095);
    $home_link    = get_permalink(2934);
    $mobile_tag   = "Bespoke Journeys";
    $tagline      = "Bespoke Journeys<br />Since 1977";

} elseif ($is_awt) {
    // AWT SETTINGS
    $account_link = 'https://res.aesu.com/res/STWMain.aspx?Theme=AWT&Action=Home';
    $cart_link	  = 'https://res.aesu.com/res/STWMain.aspx?Theme=AWT&Action=ShoppingCart';
    $contact_link = get_permalink(2836);
    $home_link    = get_permalink(898);
    $mobile_tag   = "Alumni World Travel";
    $tagline      = "Alumni World Travel<br />Expanding Horizons Since 1977";
} else {
    // DEFAULT = AESU SETTINGS
    $account_link = 'https://res.aesu.com/res/STWMain.aspx?Theme=AESU&Action=Home';
    $contact_link = get_permalink(11601);
    $home_link    = get_home_url();
    $mobile_tag   = "Since 1977";
    $tagline      = "Expanding Horizons <br/>Since 1977";
}

// Defensive cleanup
$account_link = strtok($account_link, "\n");
?>

<header class="mobile_header">
    <div class="container">
        <div class="inner-header">

            <div class="nav-logo">

                <?php if (! $is_awt && ! $is_bespoke) : ?>
                    <nav>
                        <?php wp_nav_menu([
                            'theme_location' => 'main_nav',
                            'menu_class'     => 'awiNav'
                        ]); ?>
                    </nav>
                <?php endif; ?>

                <div class="logo_wrap">
                    <a href="<?php echo $home_link; ?>">
                        <svg class="icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons.svg#icon-cropped-logo-full"></use>
                        </svg>
                    </a>

                    <span><?php echo $mobile_tag; ?></span>
                </div>

            </div>

            <div class="header_right">

                <div class="top_nav_account_wrap">
                	<?php if (! $is_bespoke) : ?>

                	<?php if (! $is_awt) : ?>
					<span class="top_account_area search-toggle">
					    <a href="#" class="search-toggle-link js-search-toggle" aria-expanded="false">
					        <i class="fa-solid fa-magnifying-glass"></i>
					    </a>
					</span>
					<?php endif; ?>


                    <span class="top_account_area">
                        <a href="<?php echo esc_url($account_link); ?>" target="_blank">
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </span>

                    <?php endif; ?>

                    <span class="top_account_area">
                        <a class="header_phone" href="tel:8006387640">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </span>

                    <span class="top_account_area">
                        <a class="contact_page_link" href="<?php echo $contact_link; ?>">
                            <i class="fa-solid fa-message"></i>
                        </a>
                    </span>

                </div>
            </div>

        </div>
    </div>
</header>

<header class="desktop_header">
    <div class="container">
        <div class="inner-header">

        <div class="nav-logo">

        		<?php if (! $is_awt && ! $is_bespoke) : ?>
                    <nav>
                        <?php wp_nav_menu([
                            'theme_location' => 'main_nav',
                            'menu_class'     => 'awiNav'
                        ]); ?>
                    </nav>
                <?php endif; ?>

            <div class="logo_wrap">
                <a href="<?php echo $home_link; ?>">
                    <svg class="icon">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/icons.svg#icon-cropped-logo-full"></use>
                    </svg>
                </a>

                <span><?php echo $tagline; ?></span>
            </div>

        </div>

            <div class="header_right">

				<?php
				$school_logo     = get_field('school_logo');
				$school_shortcode = get_field('school_shortcode');

				if (
				    is_page_template('page-school-landing-page.php')
				    && $school_logo
				    && strtolower($school_shortcode) !== 'awt' //if field is set to awt do not show the school_logo
				) : ?>
				    <img
				        class="header_school_logo"
				        style="width:auto;"
				        src="<?php echo esc_url($school_logo['url']); ?>"
				        alt=""
				    >
				<?php endif; ?>

				<?php if (! $is_awt) : ?>
				  <div class="header-search-inline" id="header-search-desktop" aria-hidden="true">
				    <?php get_search_form(); ?>
				  </div>
				<?php endif; ?>

                <div class="top_nav_account_wrap">
                <?php if (! $is_bespoke) : ?>
                    <span class="top_account_area">
                        <a href="<?php echo esc_url($account_link); ?>" target="_blank">
                            <i class="fa-solid fa-circle-user"></i> My Account
                        </a>
                    </span>

                    <?php if (! $is_awt) : ?>
					<span class="top_account_area search-toggle">
					    <a href="#" class="search-toggle-link js-search-toggle" aria-expanded="false">
					        <i class="fa-solid fa-magnifying-glass"></i> Search
					    </a>
					</span>
					<?php else : ?>
					<span class="top_account_area">
					    <a href="<?php echo esc_url($cart_link); ?>" target="_blank">
					        <i class="fa-solid fa-cart-shopping"></i> My Cart
					    </a>
					</span>
					<?php endif; ?>
				<?php endif; ?>

                    <span class="top_account_area">
                        <a class="contact_page_link" href="<?php echo $contact_link; ?>">
                            <i class="fa-solid fa-message"></i> Contact Us
                        </a>
                    </span>

                    <span class="top_account_area">
                        <a class="header_phone" href="tel:8006387640">
                            <i class="fa-solid fa-phone"></i> 800.638.7640
                        </a>
                    </span>
                </div>

            </div>
        </div>
    </div>
</header>

<?php if (! $is_awt) : ?>
<div class="header-search header-search--mobile" id="header-search-mobile">
  <div class="container">
    <?php get_search_form(); ?>
  </div>
</div>
<?php endif; ?>