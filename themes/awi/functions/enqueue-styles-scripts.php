<?php
/**
 * Enqueue styles and scripts
 * Theme-specific styles and scripts
 */

/****************************************************************************************************
 Actions
 ****************************************************************************************************/

// Enqueue scripts
add_action('wp_enqueue_scripts', 'awi_enqueue_styles_scripts');


// Initialize scripts 
add_action('wp_footer', 'awi_initialize_scripts', 9999);

add_action( 'wp_head', 'preload_theme_styles', 5);

function rjs_lwp_contactform_css_js() {
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7') ) {
        wp_enqueue_script('contact-form-7');
         wp_enqueue_style('contact-form-7');

    }else{
        wp_dequeue_script( 'contact-form-7' );
        wp_dequeue_style( 'contact-form-7' );
    }
}
//add_action( 'wp_enqueue_scripts', 'rjs_lwp_contactform_css_js');

/****************************************************************************************************
 Functions
 ****************************************************************************************************/

 function awi_enqueue_styles_scripts() {
	wp_enqueue_style('core', get_stylesheet_uri());
	wp_enqueue_style('theme', get_template_directory_uri().'/css/style.css');

	//wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-3.1.1.min.js');
	wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-3.6.3.min.js');
	//wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr-2.2.min.js');
	wp_enqueue_script('svgxuse', get_template_directory_uri().'/js/svgxuse.min.js', array('jquery'), false, true);
	wp_enqueue_script('awiNav', get_template_directory_uri().'/js/awiNav-1.2.1.js', array('jquery'), false, true);
	//wp_enqueue_script('parallax', get_template_directory_uri().'/js/parallax-1.2.js', array('jquery'), false, true);
	//wp_enqueue_script('fontfaceobserver', get_template_directory_uri().'/js/fontfaceobserver.js', array('jquery'), false, true);
	//wp_enqueue_script('fontloader', get_template_directory_uri().'/js/fontloader.js', array('jquery'), false, true);
	//wp_enqueue_script('fancybox', get_template_directory_uri().'/js/fancybox.umd.js', array('jquery'), false, true);
	//wp_enqueue_style('fancybox', get_template_directory_uri().'/css/fancybox.css');
}
function preload_theme_fonts()
{
    //echo '<link rel="preload" href="'. get_template_directory_uri() .'/fonts/[FONT_NAME].woff2" as="font" crossorigin="anonymous">';
}

function awi_initialize_scripts() { ?>
	  	<?php 
		  session_start();
		  if(isset($_GET['utm_source'])){
		    $_SESSION['utm_source'] = $_GET['utm_source'];
		  }elseif(!isset($_GET['utm_source']) && !isset($_SESSION['utm_source'])){
		    $_SESSION['utm_source'] = $_SERVER['HTTP_REFERER'];
		  } ?>
	<script>
		
		/*
		
	  	(function($){
		    function sticky_header() {    
		    	var windowPosition = $(window).scrollTop();
		      	var switchTarget = $('header');
		      	var $w = $(window).scroll(function() {
		        	if ($w.scrollTop() > 100) {
		          		switchTarget.addClass('sticky');
		        	} else {
		          		switchTarget.removeClass('sticky');
		        	}
		      	});
		    };
		    $(function(){
		      	sticky_header();
		    });
		    $(window).resize(function() {
		      	sticky_header();
		    });
	  	})(jQuery);
	  	
	  	*/
 
    /*wpcf7Elm.addEventListener( 'wpcf7submit', function( event ) {
       ga("send", "event", "Forms", "Form Submission")
    }, false );*/
      //new WOW().init();

      (function($){
        $(document).ready(function(){
          $("a[href^='tel']").on("click",function(){
          console.log('test call');
          gtag('event', 'click_to_call', {
            'lead_source': '<?php echo $_SESSION['utm_source']; ?>'
          });
        });
          var wpcf7Elm = document.querySelector( '.wpcf7' );

          document.addEventListener( 'wpcf7mailsent', function( e ) {
          e.preventDefault();
          console.log('test form');
          gtag('event', 'contact_form_submitted', {
            'lead_source': '<?php echo $_SESSION['utm_source']; ?>'
          });
          }, false );
        });
      })( jQuery );
	</script>

	<?php if(is_front_page()) { ?>
    
	<?php }
}