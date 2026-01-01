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
if(function_exists('get_field')) {
 	$header_image = get_field('header_image') ? $header_image = get_field('header_image') : $header_image = get_field('default_header_image', 'option');
 	//$header_image = ($detect->isMobile() && !$detect->isTablet()) ? $header_image['sizes']['large'] : $header_image['url'];
	if(is_singular('trips')){
	$header_type = get_field('header_type',get_the_ID());
	}else{
	$header_type = get_field('header_type');
	}
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
				}
				.top_nav_account_wrap{
					display: flex;
					flex-direction: row;
				}
				.top_nav_account_wrap .top_account_area i {
					font-size: 24px;
					padding-right:0;
					padding-left:10px;
				}
				header .container .inner-header{
						flex-direction:row;
					}
				.logo_wrap svg {
			    height: 45px;
			    width: 95px;
			    padding-right: 10px;
			    border-right: 2px solid #fff;
				}
				/*.logo_wrap{
					margin-left: 18px;
				}
				.logo_wrap span{
					padding-right:10px;
				}
				.awiNav__trigger {
				    top: 3px;
				}
				.awiNav__trigger span{
				  	margin:8px 0 0 0;
				}*/
			}
			@media screen and (max-width:900){
				.bottom_footer .container {
	    				padding-top:30px;
					}
				}
				@media screen and (max-width:443px){
					.mobile_header{
						padding:20px;
					}
					/*.awiNav__trigger {
						top: 0;
					}*/
					.logo_wrap svg {
					    height: 35px;
					    width: 85px;
					    padding-right: 10px;
					    border-right: 2px solid #fff;
					}
				}
				@media screen and (max-width:420px){
			    header .container{
					padding:0
				}
				.bottom_footer .container {
	    			padding-top:15px;
				}
			}
			a.header_cart.:hover, a.header_cart:active {
   				color: #fff;
   			}
		</style>
		
<?php
// --------------------------------------
// Determine referrer header type
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
// Set links and labels
// --------------------------------------
if ($is_awt) {
    // AWT SETTINGS
    $contact_link = get_permalink(2836);
    $home_link    = get_permalink(898);
    $mobile_tag   = "Alumni World Travel";
} else {
    // DEFAULT = AESU SETTINGS
    $contact_link = get_permalink(11601);
    $home_link    = get_home_url();
    $mobile_tag   = "Since 1977";
}
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
                        <a href="https://res.aesu.com/res/STWMain.aspx?Theme=AESU&Action=Home" target="_blank">
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


<?php
// --------------------------------------
// Determine referrer header type
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
// Set links and titles
// --------------------------------------
if ($is_awt) {
    // AWT SETTINGS
    $contact_link = get_permalink(2836);
    $home_link    = get_permalink(898);
    $tagline      = "Alumni World Travel<br />Expanding Horizons Since 1977";
} else {
    // DEFAULT = AESU SETTINGS
    $contact_link = get_permalink(11601);
    $home_link    = get_home_url();
    $tagline      = "Expanding Horizons <br/>Since 1977";
}
?>

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
                $school_logo = get_field('school_logo');
                if (is_page_template('page-school-landing-page.php') && $school_logo) : ?>
                    <img class="header_school_logo" style="width:auto;" src="<?php echo $school_logo['url'] ?>">
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
                        <a href="https://res.aesu.com/res/STWMain.aspx?Theme=AESU&Action=Home" target="_blank">
                            <i class="fa-solid fa-circle-user"></i> My Account
                        </a>
                    </span>

                    <span class="top_account_area">
                        <a class="header_cart" href="https://res.aesu.com/res/STWMain.aspx?Theme=AESU&Action=Home" target="_blank">
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


<?php if($header_image && !is_front_page()) { ?>
	<div class="interior-banner" style="background-image:url('<?php echo $header_image; ?>');"></div>
<?php } ?>