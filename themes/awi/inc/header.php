<?php 
GLOBAL $detect;
if(function_exists('get_field')) {
 	$header_image = get_field('header_image') ? $header_image = get_field('header_image') : $header_image = get_field('default_header_image', 'option');
 	$header_image = ($detect->isMobile() && !$detect->isTablet()) ? $header_image['sizes']['large'] : $header_image['url'];
}
if(is_user_logged_in()){ ?>
		<style>
			.header {
				top:32px!important;
			}
			.main {
				margin-top:32px!important;
			}
		</style>
	<?php } ?>
<header class="header">
	<div class="container">
		<a href="<?php echo home_url() ?>"><!-- LOGO GOES HERE --></a>
		<nav class="nav">
			<?php wp_nav_menu( array( 'theme_location' => 'main_nav', 'menu_class' => 'awiNav' ) ); ?>
		</nav>
		
	</div>
</header>
<?php if($header_image && !is_front_page()) { ?>
	<div class="interior-banner" style="background-image:url('<?php echo $header_image; ?>');"></div>
<?php } ?>