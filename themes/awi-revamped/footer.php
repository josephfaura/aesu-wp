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
<?php
if(function_exists('get_field')){
	$header_type = get_field('header_type');
}
?><?php
// Get the referrer URL
$referrer = $_SERVER['HTTP_REFERER'];
$is_awt_referrer = false;
if ( $referrer ) {
    // Convert referrer into post/page ID
    $referrer_id = url_to_postid( $referrer );

    if ( $referrer_id ) {
        // Get the ACF field value
        $header_type_referrer = get_field( 'header_type', $referrer_id );
		//echo $header_type_referrer;
        if ( $header_type_referrer === 'AWT' ) {
            // Do something if the header_type is AESU
            //echo "Referring page has header_type = AESU";
			//echo $header_type_referrer;
$is_awt_referrer = true;
        }
    }
}
?>
<?php if(function_exists('get_field')){
	$social_links = get_field('social_links','options');
} ?>
	<footer class="site-footer">
		
		<section class="bottom_footer">
			<div class="container">
				<div class="bottom_footer_navinfo">
					<div class="footer_nav">
					<?php if($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu"){
						$home_link = get_home_url();
						wp_nav_menu( array( 'theme_location' => 'footer_nav') ); 
					}else{
						wp_nav_menu( array( 'theme_location' => 'awt_footer_nav') ); 
						$home_link = get_permalink(898);
					}
					?>
					</div>
					<div class="footer_info">
					<?php if($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu"){ ?>
						<ul class="bottom_footer_roundlinks">
							<?php foreach($social_links as $social_link){ ?>
							<li><a href="<?php echo $social_link['social_link_url'] ?>" target="_blank"><img src="<?php echo $social_link['social_link_image']['url'] ?>"></a></li>
							<?php } ?>
						</ul>
						<?php } ?><?php if($header_type_referrer != 'AWT' && $header_type == "AESU" || $header_type == "aesuaesu"){ ?>
							<a href="<?php echo $home_link ?>"><img src="<?php echo get_template_directory_uri() ?>/img/logo_footer.png" class="footer_logo"></a>
						<?php }else{ ?>
							<a href="<?php echo $home_link ?>"><img src="<?php echo get_template_directory_uri() ?>/img/logo_footer.png" class="footer_logo"><br><span>Alumni World Travel</span></a>
						<?php } ?>
						
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
					Website Development provided by <a href="http://www.advp.com" target="_blank">Adventure Web Digital</a></p>
					</div>
				</div>
			</div>
		</section>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
