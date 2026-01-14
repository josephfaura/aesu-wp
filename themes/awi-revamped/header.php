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
	<?php if($_SERVER['REMOTE_ADDR'] != "50.242.219.73" && $_SERVER['REMOTE_ADDR'] != "71.244.235.248" && $_SERVER['REMOTE_ADDR'] != "98.204.75.105" && $_SERVER['REMOTE_ADDR'] != "174.172.196.238"){ ?>
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
				.single-trips .trip_header{
					top:0 !important;
				}
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
					padding:18px 32px;
				}
				.desktop_header{
					display:none;
				}
				.nav-logo {
					display: flex;
					align-items: center;
					gap: 18px;
					min-width: 0;
				}
				.top_nav_account_wrap{
					display: flex;
					flex-direction: row;
					gap:18px;
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
				.mobile_header{
					padding:20px;
				}
				.logo_wrap svg {
					height: 35px;
					width: 85px;
				}
			}
		</style>
		
<?php
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
// --------------------------------------
if ($is_awt) {
    // AWT SETTINGS
    $account_link = 'https://res.aesu.com/res/STWMain.aspx?Theme=AWT&Action=Home';
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

// Defensive cleanup (kept)
$account_link = strtok($account_link, "\n");
?>

<header class="mobile_header">
    <div class="container">
        <div class="inner-header">

            <div class="nav-logo">

                <?php if (! $is_awt) : ?>
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

                    <span class="top_account_area">
                        <a href="<?php echo esc_url($account_link); ?>" target="_blank">
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </span>

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

            <div class="logo_wrap">
                <a href="<?php echo $home_link; ?>">
                    <svg class="icon">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/icons.svg#icon-cropped-logo-full"></use>
                    </svg>
                </a>

                <span><?php echo $tagline; ?></span>
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
                    <nav>
                        <?php wp_nav_menu([
                            'theme_location' => 'main_nav',
                            'menu_class'     => 'awiNav'
                        ]); ?>
                    </nav>
                <?php endif; ?>

                <div class="top_nav_account_wrap">
                    <span class="top_account_area">
                        <a href="<?php echo esc_url($account_link); ?>" target="_blank">
                            <i class="fa-solid fa-circle-user"></i> My Account
                        </a>
                    </span>

                    <span class="top_account_area">
                        <a href="<?php echo esc_url($account_link); ?>" target="_blank">
                            <i class="fa-solid fa-cart-shopping"></i> My Cart
                        </a>
                    </span>

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