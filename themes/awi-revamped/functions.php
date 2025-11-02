<?php
/**
 * AWI Revamped functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AWI_Revamped
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
//add_filter('use_block_editor_for_post', '__return_false');
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function awi_revamped_setup() {
	load_theme_textdomain( 'awi-revamped', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// WordPress manages document title.
	add_theme_support( 'title-tag' );

	// Featured images.
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'main_nav'      => 'Main Nav',
		'footer_nav'    => 'Footer Nav',
		'awt_footer_nav'=> 'AWT Footer Nav',
	));

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'awi_revamped_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'awi_revamped_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function awi_revamped_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'awi_revamped_content_width', 640 );
}
add_action( 'after_setup_theme', 'awi_revamped_content_width', 0 );

/**
 * Register widget area.
 */
function awi_revamped_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'awi-revamped' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'awi-revamped' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'awi_revamped_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function awi_revamped_scripts() {
	wp_enqueue_style( 'awi-revamped-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'awi-revamped-style', 'rtl', 'replace' );

	wp_enqueue_script( 'awi-revamped-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'awi-revamped-svg',        get_template_directory_uri() . '/js/svgxuse.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'awiNav',                   get_template_directory_uri() . '/js/awiNav-1.2.1.js', array( 'jquery' ), false, true );

	wp_enqueue_script( 'flexslider',               get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), false, true );
	wp_enqueue_style ( 'flexslider',               get_template_directory_uri() . '/css/flexslider.css' );

	wp_enqueue_script( 'fancybox-js-theme',        get_template_directory_uri() . '/js/fancybox.umd.js', array( 'jquery' ), false, true );
	wp_enqueue_style ( 'fancybox-css-theme',       get_template_directory_uri() . '/css/fancybox.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Font Awesome 6 (needed for + / − icons)
	wp_enqueue_style(
	  'fontawesome',
	  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
	  array(),
	  '6.5.2'
	);

	// Slick
	wp_enqueue_script( 'slick',        get_template_directory_uri() . '/js/slick/slick.min.js', array( 'jquery' ), false, true );
	wp_enqueue_style ( 'slick',        get_template_directory_uri() . '/js/slick/slick.css' );
	wp_enqueue_style ( 'slick-theme',  get_template_directory_uri() . '/js/slick/slick-theme.css' );

	// NEW: Itinerary toggler (Font Awesome icons, expand/collapse all sync)
	wp_enqueue_script( 'itinerary-toggle', get_template_directory_uri() . '/js/itinerary-toggle.js', array( 'jquery' ), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'awi_revamped_scripts', 1 );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('wp_footer', 'awi_initialize_scripts', 9999);
function awi_initialize_scripts() { ?>
<script>
(function($){
	$('.trip_highlight_items').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		dots:true,
		arrows:true,
		responsive: [
			{ breakpoint: 1023, settings: { slidesToShow: 2, slidesToScroll: 1 } },
			{ breakpoint:  767, settings: { slidesToShow: 1, slidesToScroll: 1 } }
		]
	});
	$('.hotels_slider').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		autoplaySpeed: 2000,
		dots:true,
		responsive: [
			{ breakpoint: 1023, settings: { slidesToShow: 2, slidesToScroll: 1 } },
			{ breakpoint:  767, settings: { slidesToShow: 1, slidesToScroll: 1 } }
		]
	});
	$('.trip_options_slider').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		dots:true,
		responsive: [
			{ breakpoint: 1023, settings: { slidesToShow: 2, slidesToScroll: 1 } },
			{ breakpoint:  767, settings: { slidesToShow: 1, slidesToScroll: 1 } }
		]
	});
})( jQuery );
</script>
<script>
(function($){
	$('.acc-button-all').click(function() {
		if ($(this).hasClass('acc-toggle-open')) {
			$('.acc-button').removeClass('acc-active');
			$('.acc-content').slideUp('normal');
			$(this).removeClass('acc-toggle-open')
		} else {
			$('.acc-button').addClass('acc-active');
			$('.acc-content').slideDown('normal');
			$(this).addClass('acc-toggle-open')
		}
	});	
	$('.acc-button').click(function() {
		if ($(this).next().is(':hidden') == true) {
			$(this).addClass('acc-active');
			$(this).next().slideDown('normal');
		} else { 
			$(this).next().slideUp('normal');
			$(this).removeClass('acc-active');
		}
	});
})( jQuery );
</script>
<?php if(is_page(898)){ ?>
<script>
(function($){
	$(document).on('change','.interior_banner input',function(e){
		var textentered = $(this).val().toLowerCase();
		var loop_counter = 0;
		$('.packages li').each(function(index,element){
			let element_text = $("#"+$(this).attr('id')).text().toLowerCase();
			if(!element_text.includes(textentered)){
				$("#"+$(this).attr('id')).css('display','none');
			}else{
				$("#"+$(this).attr('id')).css('display','flex');
				loop_counter += 1;
			}
		});
		if(loop_counter == 0){ $('.awt_toc_form').css('display','block'); }
		else { $('.awt_toc_form').css('display','none'); }
	});
	$(document).on('click','#search_submit',function(e){
		$([document.documentElement, document.body]).animate({
			scrollTop: $(".packages").first().offset().top - 260
		}, 500);
	});
})( jQuery );
</script>
<?php if($_GET['show_values'] == 'true'){ ?>
<script>
(function($){
	$(document).ready(function(){
		$('.packages li').each(function(index,element){
			$('footer').append($(this).find('.package_thumbnail img').attr('src') + '<br>');
		});
	});
})( jQuery );
</script>
<?php } ?>
<?php } ?>
<?php 
  session_start();
  if(isset($_GET['utm_source'])){
    $_SESSION['utm_source'] = $_GET['utm_source'];
  }elseif(!isset($_GET['utm_source']) && !isset($_SESSION['utm_source'])){
    $_SESSION['utm_source'] = $_SERVER['HTTP_REFERER'];
  } ?>
<script>
(function($){
	$(document).ready(function(){
		$('.load_more_images').on('click',function(e){
			e.preventDefault();
			$('.past_tour_gallery li').css('display','block');
		});
	});
	var lastScrollTop = 0;
	if ($(window).width() < 880) { $(".desktop_header").remove(); }
	else { $(".mobile_header").remove(); }

	<?php if(!is_singular('trips')){ ?>
	$(window).scroll(function () {
		if (window.scrollY > 457) {
			var st = $(this).scrollTop();
			if (st < lastScrollTop){ $('header').slideDown(); }
			else { $('header').slideUp(); }
			lastScrollTop = st;
		}
	});
	<?php } ?>

	$(document).ready(function(){
	  $("a[href^='tel']").on("click",function(){
	    gtag('event', 'click_to_call', { 'lead_source': '<?php echo $_SESSION['utm_source']; ?>' });
	  });
	  var wpcf7Elm = document.querySelector( '.wpcf7' );
	  document.addEventListener( 'wpcf7mailsent', function( e ) {
	    e.preventDefault();
	    gtag('event', 'contact_form_submitted', { 'lead_source': '<?php echo $_SESSION['utm_source']; ?>' });
	  }, false );
	});

	$(window).load(function() {
		$('.flexslider').flexslider({ animation: "slide" });
	});

	// NOTE: The old global .accordion_trigger click handler was removed.
	// Itinerary expand/collapse-all handler was also removed (handled by itinerary-toggle.js).

	// Keep What's Included expand/collapse-all as-is
	$('.whats_included .toggle_all_trigger').on('click',function(e){
		e.preventDefault();
		if($(this).text()=="Expand All"){
			$(this).text('Collapse All');
			$(this).parents('.whats_included_accordion_section').find('.accordion_content').slideDown();
			$(this).parents('.whats_included_accordion_section').find('.collapsed_indicator').text('-');
		}else{
			$(this).text('Expand All');
			$(this).parents('.whats_included_accordion_section').find('.accordion_content').slideUp();
			$(this).parents('.whats_included_accordion_section').find('.collapsed_indicator').text('+');
		}
	});

	// Smooth anchor scroll
	$(document).on('click', 'a[href^="#"]', function (event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - 100
		}, 500);
	});

	// Removed checkAccordionStateItenirary() — itinerary-toggle.js manages state.
	function checkAccordionStatewhatsincluded() {
		var allHidden = true;
		$('.whats_included .accordion_item .accordion_content').each(function() {
			if ($(this).css('display') !== 'none') {
				allHidden = false;
				return false;
			}
		});
		$('.whats_included .toggle_all_trigger').text(allHidden ? 'Expand All' : 'Collapse All');
	}
	checkAccordionStatewhatsincluded();

	// Deals popup
	$('.deals_cta a').on('click',function(e){
		e.preventDefault();
		$('.tour_deals_popup_wrap').css('display','flex');
	});
	$('.tour_deals_close_popup').on('click',function(e){
		e.preventDefault();
		$('.tour_deals_popup_wrap').css('display','none');
	});
	$('.tour_deals_popup_wrap').on('click',function(){
		$('.tour_deals_popup_wrap').css('display','none');
	});
	$('.tour_deals_popup_content *').on('click',function(e){
		e.stopPropagation();
	});

	// Travel tools popup
	$('.travel_tools a').on('click',function(e){
		e.preventDefault();
		$('.travel_tools_popup_wrap').css('display','flex');
	});
	$('.travel_tools_close_popup').on('click',function(e){
		e.preventDefault();
		$('.travel_tools_popup_wrap').css('display','none');
	});
	$('.travel_tools_popup_wrap').on('click',function(){
		$('.travel_tools_popup_wrap').css('display','none');
	});
	$('.travel_tools_popup_content *').on('click',function(e){
		e.stopPropagation();
	});
})( jQuery );
</script>
<script>
(function($){
	$('.play_banner_video').on('click',function(e){
		$(this).parents('.video_wrap').find('video').first().get(0).play();
		$(this).css('display','none');
	});
})( jQuery );
</script>
<?php
}
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
// Add custom "Template" column to Pages
add_filter( 'manage_pages_columns', 'custom_add_template_column' );
function custom_add_template_column( $columns ) {
    $columns['page_type'] = 'Page Type';
    return $columns;
}

// Show the mapped or human-readable template name
add_action( 'manage_pages_custom_column', 'custom_show_template_column', 10, 2 );
function custom_show_template_column( $column, $post_id ) {
    if ( $column === 'page_type' ) {
        $template_slug = get_post_meta( $post_id, '_wp_page_template', true );

        $custom_labels = [
            'page-school-landing-page.php' => 'School',
            'page-awt-toc.php'             => 'TOC',
        ];

        if ( $template_slug === 'default' ) {
            echo 'Default';
        } elseif ( isset( $custom_labels[ $template_slug ] ) ) {
            echo esc_html( $custom_labels[ $template_slug ] );
        } else {
            $templates = wp_get_theme()->get_page_templates();
            $template_name = array_search( $template_slug, $templates );
            echo $template_name ? esc_html( $template_name ) : esc_html( $template_slug );
        }
    }
}

// Make the column sortable
add_filter( 'manage_edit-page_sortable_columns', 'custom_make_template_column_sortable' );
function custom_make_template_column_sortable( $columns ) {
    $columns['page_type'] = 'page_type';
    return $columns;
}

add_action( 'pre_get_posts', 'custom_sort_by_template_column' );
function custom_sort_by_template_column( $query ) {
    if ( is_admin() && $query->is_main_query() && $query->get('orderby') === 'page_type' ) {
        $query->set( 'meta_key', '_wp_page_template' );
        $query->set( 'orderby', 'meta_value' );
    }
}
// Add "Header Type" column to Pages admin list
add_filter( 'manage_pages_columns', function( $columns ) {
    $columns['header_type'] = __( 'Brand', 'textdomain' );
    return $columns;
} );

// Populate "Header Type" column for Pages
add_action( 'manage_pages_custom_column', function( $column, $post_id ) {
     if ( $column === 'header_type' ) {
        $value = get_post_meta( $post_id, 'header_type', true );
        echo $value ? esc_html( $value ) : '';
    }
}, 10, 2 );

// Make "Header Type" column sortable
add_filter( 'manage_edit-page_sortable_columns', function( $columns ) {
    $columns['header_type'] = 'header_type';
    return $columns;
} );

// Handle sorting by "Header Type" custom field in Pages admin
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }
    if ( $query->get( 'orderby' ) === 'header_type' ) {
        $query->set( 'meta_key', 'header_type' );
        $query->set( 'orderby', 'meta_value' );
    }
} );
// Register Custom Taxonomy
function page_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Page Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Page Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Page Categories', 'text_domain' ),
		'all_items'                  => __( 'All Page Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Page Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Page Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Page Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Page Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Page Category', 'text_domain' ),
		'update_item'                => __( 'Update Page Category', 'text_domain' ),
		'view_item'                  => __( 'View Page Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Page Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Page Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Page Categories', 'text_domain' ),
		'search_items'               => __( 'Search Page Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Page Categories', 'text_domain' ),
		'items_list'                 => __( 'Page Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Page Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'page_category', array( 'page' ), $args );
}
add_action( 'init', 'page_category_taxonomy', 0 );

// 1. Make trip_category column sortable in Trips CPT admin
add_filter( 'manage_edit-page_sortable_columns', function( $columns ) {
    $columns['taxonomy-page_category'] = 'page_category';
    return $columns;
} );

// 2. Handle sorting by page_category term name
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }
    if ( $query->get( 'orderby' ) === 'page_category' ) {
        global $wpdb;
        $query->set( 'orderby', 'term_name' );
        add_filter( 'posts_clauses', function( $clauses ) use ( $wpdb ) {
            $clauses['join'] .= "
                LEFT JOIN {$wpdb->term_relationships} AS tr ON ({$wpdb->posts}.ID = tr.object_id)
                LEFT JOIN {$wpdb->term_taxonomy} AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
                LEFT JOIN {$wpdb->terms} AS t ON (tt.term_id = t.term_id AND tt.taxonomy = 'page_category')
            ";
            $clauses['orderby'] = "t.name ASC";
            return $clauses;
        } );
    }
} );

// (Legacy taxonomy scaffold — still commented out above.)

// Sitemap shortcode
function generate_sitemap() {
	$tmp_storage = array();
	$sitemap  = '<div class="sitemap-wrapper">';
 	$sitemap .= '<ul class="sitemap-list clearfix">';

	// Pages
	$pages_args = array(
		'exclude'      => '',
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'sort_column'  => 'menu_order'
	);
	$sitemap .= '<li><h3>Pages</h3><ul class="pages-list clearfix">';
	$pages = get_pages($pages_args);
	foreach ( $pages as $page ) :
		$sitemap .= '<li><a href="'.get_permalink( $page->ID ).'" rel="bookmark">'.$page->post_title.'</a></li>';
	endforeach;
	$sitemap .= '</ul></li>';

	// Custom Post Types
	foreach( get_post_types( array('public' => true) ) as $post_type ) {
		if ( in_array( $post_type, array('post','page','attachment'))) continue;

		$custom_post_type  = get_post_type_object( $post_type );
		$custom_post_types_args = array(
			'exclude'        => '',
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
		);
		$sitemap .= '<li><h3>'.$custom_post_type->labels->name.'</h3><ul class="custom-post-types-list clearfix">';
		$custom_post_types = get_posts($custom_post_types_args);
		foreach ( $custom_post_types as $custom_post_type ) :
			$sitemap .= '<li><a href="'.get_permalink( $custom_post_type->ID ).'" rel="bookmark">'.$custom_post_type->post_title.'</a></li>';
		endforeach;
		$sitemap .= '</ul></li>';
	}

	// Posts
	$posts_args = array(
		'exclude'        => '',
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	$sitemap .= '<li><h3>Posts</h3><ul class="posts-list clearfix">';
	$posts = get_posts($posts_args);
	foreach ( $posts as $post ) :
		$tmp_var = get_permalink( $post->ID );
		if (!in_array($tmp_var, $tmp_storage)) {
			$sitemap .= '<li><a href="'.get_permalink( $post->ID ).'" rel="bookmark">'.$post->post_title.'</a></li>';
			$tmp_storage[] = $tmp_var;
		}
	endforeach;
	$sitemap .= '</ul></li>';

	$sitemap .= '</ul></div>';
	return $sitemap;
}
add_shortcode( 'sitemap','generate_sitemap' );

add_action('admin_head', function () {
    echo '<style>.wp-list-table .column-title{width:25% !important;}</style>';
});

/*______________________________________________ */
add_action('pre_get_posts', function ($query) {
    if ($query->is_main_query() && !is_admin()) {
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
});

add_filter( 'acf/pre_load_post_id', function( $post_id ) {
    if ( ! is_preview() || ! isset( $_GET['preview_id'] ) ) {
        return $post_id;
    }
    $preview_id = absint( $_GET['preview_id'] );
    $current_id = get_the_ID();

    if ( in_array( (int) $post_id, [ (int) $current_id, (int) get_post_meta( $preview_id, '_edit_last', true ) ], true )
        || (int) $post_id === (int) $preview_id
        || (int) $post_id === (int) get_post_meta( $preview_id, '_wp_old_slug', true ) ) {
        return $preview_id;
    }
    return $post_id;
});

function acf_preview_id_safe( $post_id = null ) {
    if ( is_preview() && isset($_GET['preview_id']) ) {
        return absint($_GET['preview_id']);
    }
    return $post_id ?: get_the_ID();
}
