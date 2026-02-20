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

// add_filter('use_block_editor_for_post', '__return_false');

/**
 * Sets up theme defaults and registers support for various WordPress features.
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
		'main_nav'       => 'Main Nav',
		'footer_nav'     => 'Footer Nav',
		'awt_footer_nav' => 'AWT Footer Nav',
	));
	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
	*/
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
	// Set up the WordPress core custom background feature.
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
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/**
	 * Add support for core custom logo.
	 */
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
 * Enqueue Google Font Open Sans Variable.
 */
function load_google_fonts() {
    wp_enqueue_style(
        'google-open-sans',
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'load_google_fonts');

/**
 * Enqueue scripts and styles.
 */
function awi_enqueue_feature_scripts() {

    $theme_version = _S_VERSION;

    // -----------------------------------------
    // Theme CSS
    // -----------------------------------------
    wp_enqueue_style(
        'awi-revamped-style',
        get_stylesheet_uri(),
        [],
        file_exists(get_stylesheet_directory() . '/style.css') ? filemtime(get_stylesheet_directory() . '/style.css') : $theme_version
    );
    wp_style_add_data('awi-revamped-style', 'rtl', 'replace');

    // -----------------------------------------
    // Core JS
    // -----------------------------------------
    wp_enqueue_script(
        'awi-revamped-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        [],
        file_exists(get_template_directory() . '/js/navigation.js') ? filemtime(get_template_directory() . '/js/navigation.js') : $theme_version,
        true
    );

    wp_enqueue_script(
        'awi-revamped-svg',
        get_template_directory_uri() . '/js/svgxuse.min.js',
        [],
        file_exists(get_template_directory() . '/js/svgxuse.min.js') ? filemtime(get_template_directory() . '/js/svgxuse.min.js') : $theme_version,
        true
    );

    wp_enqueue_script(
        'awiNav',
        get_template_directory_uri() . '/js/awiNav-1.2.1.js',
        ['jquery'],
        file_exists(get_template_directory() . '/js/awiNav-1.2.1.js') ? filemtime(get_template_directory() . '/js/awiNav-1.2.1.js') : false,
        true
    );

    // -----------------------------------------
    // Flexslider
    // -----------------------------------------
    wp_enqueue_style(
        'flexslider',
        get_template_directory_uri() . '/css/flexslider.css',
        [],
        file_exists(get_template_directory() . '/css/flexslider.css') ? filemtime(get_stylesheet_directory() . '/css/flexslider.css') : $theme_version
    );

    wp_enqueue_script(
        'flexslider',
        get_template_directory_uri() . '/js/jquery.flexslider-min.js',
        ['jquery'],
        file_exists(get_stylesheet_directory() . '/js/jquery.flexslider-min.js') ? filemtime(get_stylesheet_directory() . '/js/jquery.flexslider-min.js') : $theme_version,
        true
    );

    wp_enqueue_script(
        'flexslider-init',
        get_stylesheet_directory_uri() . '/js/flexslider-init.js',
        ['jquery','flexslider'],
        file_exists(get_stylesheet_directory() . '/js/flexslider-init.js') ? filemtime(get_stylesheet_directory() . '/js/flexslider-init.js') : $theme_version,
        true
    );

    // -----------------------------------------
    // Fancybox
    // -----------------------------------------
    wp_enqueue_style(
        'fancybox-css-theme',
        get_template_directory_uri() . '/css/fancybox.css',
        [],
        file_exists(get_stylesheet_directory() . '/css/fancybox.css') ? filemtime(get_stylesheet_directory() . '/css/fancybox.css') : $theme_version
    );

    wp_enqueue_script(
        'fancybox-js-theme',
        get_template_directory_uri() . '/js/fancybox.umd.js',
        ['jquery'],
        file_exists(get_stylesheet_directory() . '/js/fancybox.umd.js') ? filemtime(get_stylesheet_directory() . '/js/fancybox.umd.js') : $theme_version,
        true
    );

    // -----------------------------------------
    // Slick
    // -----------------------------------------
    wp_enqueue_style(
        'slick',
        get_template_directory_uri() . '/js/slick/slick.css',
        [],
        '1.8.1'
    );
    wp_enqueue_style(
        'slick-theme',
        get_template_directory_uri() . '/js/slick/slick-theme.css',
        ['slick'],
        '1.8.1'
    );
    wp_enqueue_script(
        'slick',
        get_template_directory_uri() . '/js/slick/slick.min.js',
        ['jquery'],
        '1.8.1',
        true
    );

    // Carousel fixes
    wp_enqueue_script(
        'awi-carousel-fixes',
        get_stylesheet_directory_uri() . '/js/carousel-fixes.js',
        ['jquery','slick'],
        file_exists(get_stylesheet_directory() . '/js/carousel-fixes.js') ? filemtime(get_stylesheet_directory() . '/js/carousel-fixes.js') : $theme_version,
        true
    );

    // -----------------------------------------
    // Itinerary toggle accordion
    // -----------------------------------------
    wp_enqueue_script(
        'itinerary-toggle',
        get_template_directory_uri() . '/js/itinerary-toggle.js',
        ['jquery'],
        file_exists(get_stylesheet_directory() . '/js/itinerary-toggle.js') ? filemtime(get_stylesheet_directory() . '/js/itinerary-toggle.js') : $theme_version,
        true
    );

    // -----------------------------------------
    // Header scroll behavior
    // -----------------------------------------
    wp_enqueue_script(
        'header-scroll',
        get_stylesheet_directory_uri() . '/js/header-scroll.js',
        [], // no dependencies
        file_exists(get_stylesheet_directory() . '/js/header-scroll.js') ? filemtime(get_stylesheet_directory() . '/js/header-scroll.js') : $theme_version,
        true
    );
    wp_localize_script(
        'header-scroll',
        'awiHeaderScroll',
        ['isTripPage' => is_singular(['trips','tours'])]
    );

    // -----------------------------------------
    // Banner video autoplay (homepage only)
    // -----------------------------------------
    if (is_front_page()) {
        wp_enqueue_script(
            'banner-video',
            get_stylesheet_directory_uri() . '/js/banner-video.js',
            ['jquery'],
            file_exists(get_stylesheet_directory() . '/js/banner-video.js') ? filemtime(get_stylesheet_directory() . '/js/banner-video.js') : $theme_version,
            true
        );
    }

    // -----------------------------------------
    // Popups (deals + travel tools)
    // -----------------------------------------
    wp_enqueue_script(
        'popups',
        get_stylesheet_directory_uri() . '/js/popups.js',
        ['jquery'],
        file_exists(get_stylesheet_directory() . '/js/popups.js') ? filemtime(get_stylesheet_directory() . '/js/popups.js') : $theme_version,
        true
    );

    // -----------------------------------------
    // GA Tracking (tel clicks & CF7 submissions)
    // -----------------------------------------
    wp_enqueue_script(
        'tracking',
        get_stylesheet_directory_uri() . '/js/tracking.js',
        ['jquery'],
        file_exists(get_stylesheet_directory() . '/js/tracking.js') ? filemtime(get_stylesheet_directory() . '/js/tracking.js') : $theme_version,
        true
    );
    wp_localize_script(
        'tracking',
        'awiTracking',
        [
            'utm_source' => isset($_SESSION['utm_source']) ? esc_js($_SESSION['utm_source']) : ''
        ]
    );

    // -----------------------------------------
    // AWT TOC Search (page 898)
    // -----------------------------------------
    if ( is_page(898) ) {
        wp_enqueue_script(
            'awt-toc',
            get_stylesheet_directory_uri() . '/js/awt-toc-search.js',
            ['jquery'],
            file_exists(get_stylesheet_directory() . '/js/awt-toc-search.js') ? filemtime(get_stylesheet_directory() . '/js/awt-toc-search.js') : $theme_version,
            true
        );
        wp_localize_script(
            'awt-toc',
            'awiToc',
            [
                'show_values' => isset($_GET['show_values']) && $_GET['show_values'] === 'true'
            ]
        );
    }

    // -----------------------------------------
    // CF7 recaptcha lazy
    // -----------------------------------------
    wp_enqueue_script(
        'cf7-recaptcha-lazy',
        get_stylesheet_directory_uri() . '/js/cf7-recaptcha-lazy.js',
        [],
        file_exists(get_stylesheet_directory() . '/js/cf7-recaptcha-lazy.js') ? filemtime(get_stylesheet_directory() . '/js/cf7-recaptcha-lazy.js') : $theme_version,
        true
    );

    // -----------------------------------------
    // Third-party loader
    // -----------------------------------------
    wp_register_script(
        'awi-third-party',
        get_template_directory_uri() . '/js/third-party-loader.js',
        [],
        file_exists(get_stylesheet_directory() . '/js/third-party-loader.js') ? filemtime(get_stylesheet_directory() . '/js/third-party-loader.js') : $theme_version,
        true
    );
    wp_enqueue_script('awi-third-party');
    wp_add_inline_script(
        'awi-third-party',
        'window.AWI_CONFIG = { ga_id: "G-DV23ZYP1X4", fb_pixel_id: "824453369658979" };',
        'before'
    );

    // -----------------------------------------
    // Comments reply
    // -----------------------------------------
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }

    // -----------------------------------------
    // Form helper
    // -----------------------------------------
    wp_enqueue_script(
        'form-helper',
        get_stylesheet_directory_uri() . '/js/form-helper.js',
        [],
        file_exists(get_stylesheet_directory() . '/js/form-helper.js') ? filemtime(get_stylesheet_directory() . '/js/form-helper.js') : $theme_version,
        true
    );

    // -----------------------------------------
    // Site UI helpers - Load More - Back 2 Top - 
    // -----------------------------------------
        wp_enqueue_script(
            'gallery-load-more',
            get_stylesheet_directory_uri() . '/js/site-ui.js',
            ['jquery'],
            file_exists(get_stylesheet_directory() . '/js/site-ui.js') ? filemtime(get_stylesheet_directory() . '/js/site-ui.js') : $theme_version,
            true
        );

}
add_action('wp_enqueue_scripts', 'awi_enqueue_feature_scripts', 1);


/* Interactive Trip Map Enqueue */
add_action('wp_enqueue_scripts', function () {
  if (!is_singular(['tour','tours','trip','trips'])) return;

  wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', [], '1.9.4');
  wp_enqueue_script('leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', [], '1.9.4', true);

  wp_enqueue_script(
    'awi-trip-map',
    get_stylesheet_directory_uri() . '/js/interactive-trip-map.js',
    ['leaflet'],
    '1.0.0',
    true
  );
});


/* Include Search Helpers */
require_once get_stylesheet_directory() . '/inc/search-helpers.php';				

/* Include AWT Referrer Modal Override */
require_once get_stylesheet_directory() . '/inc/awt-modal.php';                


/**
 * Route Tours to bespoke single template when selected via ACF/meta.
 * Field: tour_template_type (standard|bespoke)
 */
add_filter('template_include', function ($template) {

    if ( ! is_singular('tours') ) {
        return $template;
    }

    $post_id = get_queried_object_id();
    $type    = get_post_meta($post_id, 'tour_template_type', true);

    // Default to "standard" when unset (so existing tours don't need edits)
    if ( empty($type) ) {
        $type = 'standard';
    }

    if ( $type === 'bespoke' ) {
        $bespoke = locate_template('single-tours-bespoke.php');
        if ( $bespoke ) {
            return $bespoke;
        }
    }

    return $template;
}, 99);

add_filter('body_class', function ($classes) {
    if ( is_singular('tours') ) {
        $type = get_post_meta(get_queried_object_id(), 'tour_template_type', true);
        if ( $type === 'bespoke' ) {
            $classes[] = 'tour--bespoke';
        }
    }
    return $classes;
});


/**
 * Force real HTML5 poster="" on <video> tags that EWWW rewrote to data-poster-*.
 * Runs as an output-buffer callback so it happens AFTER all server-side rewrites.
 */
add_action('template_redirect', function () {
    if (is_admin() || wp_doing_ajax() || is_feed() || is_preview()) return;

    ob_start(function ($html) {

        // Fast bailout
        if (stripos($html, '<video') === false || stripos($html, 'data-poster-') === false) {
            return $html;
        }

        return preg_replace_callback('/<video\b[^>]*>/i', function ($m) {
            $tag = $m[0];

            // If poster already present, leave it.
            if (stripos($tag, ' poster=') !== false) return $tag;

            // Pull poster from EWWW's data attributes.
            $poster = null;
            if (preg_match('/data-poster-image="([^"]+)"/i', $tag, $mm)) {
                $poster = $mm[1];
            } elseif (preg_match('/data-poster-webp="([^"]+)"/i', $tag, $mm)) {
                $poster = $mm[1];
            } else {
                return $tag;
            }

            // Inject a real poster attribute.
            $tag = preg_replace('/<video\b/i', '<video poster="' . esc_url($poster) . '"', $tag, 1);

            // Optional but recommended: prevent "blank on reload" weirdness
            // by not relying on EWWW's JS poster swap anymore.
            $tag = preg_replace('/\sdata-poster-image="[^"]*"/i', '', $tag);
            $tag = preg_replace('/\sdata-poster-webp="[^"]*"/i', '', $tag);

            // Optional: keep preload from forcing first-frame paint behavior.
            // If you want it always consistent, uncomment:
            // $tag = preg_replace('/\spreload="[^"]*"/i', ' preload="metadata"', $tag);

            return $tag;
        }, $html);
    });
}, 0);


/* ---------- Misc. Options and Backend Functions  ---------- */

// --- Require SMS consent if phone entered ---
add_filter('wpcf7_validate_tel', 'require_sms_consent_if_phone', 10, 2);
add_filter('wpcf7_validate_tel*', 'require_sms_consent_if_phone', 10, 2);
function require_sms_consent_if_phone($result, $tag) {
    if ($tag->name !== 'sms-phone') return $result;
    $phone = trim($_POST['sms-phone'] ?? '');
    $consent = $_POST['sms-consent'] ?? '';
    if ($phone && empty($consent)) {
        $result->invalidate($tag, 'Please agree to receive text messages if you provide a phone number.');
    }
    return $result;
}

// --- Validate US phone numbers ---
add_filter('wpcf7_validate_tel', 'validate_us_phone_number', 20, 2);
add_filter('wpcf7_validate_tel*', 'validate_us_phone_number', 20, 2);
function validate_us_phone_number($result, $tag) {
    if ($tag->name !== 'sms-phone') return $result;
    $phone = trim($_POST['sms-phone'] ?? '');
    if ($phone === '') return $result; // optional
    $digits = preg_replace('/\D/', '', $phone);
    if (!preg_match('/^[2-9][0-9]{2}[0-9]{3}[0-9]{4}$/', $digits)) {
        $result->invalidate($tag, 'Please enter a valid 10-digit U.S. phone number.');
    }
    return $result;
}

/* Theme options page (ACF) */
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/* Add Menu Icons to Tours and Trips Custom Post Types */
add_filter( 'register_post_type_args', 'modify_cpt_icons', 10, 2 );
function modify_cpt_icons( $args, $post_type ) {
    // Tours CPT
    if ( 'tours' === $post_type ) {
        $args['menu_icon'] = 'dashicons-location';
    }
    // Trips CPT
    if ( 'trips' === $post_type ) {
        $args['menu_icon'] = 'dashicons-airplane';
    }
    return $args;
}

// Calculate reading time in Single Posts
function get_reading_time( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    
    $words_per_minute = 225; // adjust to 200-250 if you prefer
    $minutes = ceil( $word_count / $words_per_minute );

    return $minutes;
}

/* Admin Bar in Single Trip - Allow to Edit Tour Post Type */
function add_edit_post_type_a_link($wp_admin_bar) {

    // Only show for logged-in users who can edit posts
    if (!is_user_logged_in() || !current_user_can('edit_posts')) {
        return;
    }

    // Only show on single trips CPT
    if (is_singular('trips')) {
        global $post;

        // Get the linked Tour ID from the ACF field "tour"
        $tour_id = get_field('tour', $post->ID);

        if ($tour_id) {
            $wp_admin_bar->add_node(array(
                'id'    => 'edit_tour_post',
                'title' => '<span class="ab-icon dashicons dashicons-edit"></span> Edit Tour',
                'href'  => get_edit_post_link($tour_id),
                'meta'  => array(
                    'title' => 'Edit Tour',
                ),
            ));
        }
    }
}
add_action('admin_bar_menu', 'add_edit_post_type_a_link', 100);


/* ---------- Admin list table helpers ---------- */

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

// Add Image column to Testimonial Post admin list
add_filter('manage_edit-testimonial_columns', function ($columns) {
    $new = array();

    foreach ($columns as $key => $label) {
        $new[$key] = $label;

        // Insert thumbnail after checkbox
        if ($key === 'cb') {
            $new['thumbnail'] = __('Image');
        }
    }

    return $new;
});

// Populate Image column in Testimonial admin list
add_action('manage_testimonial_posts_custom_column', function ($column, $post_id) {

    if ($column === 'thumbnail') {
        if (has_post_thumbnail($post_id)) {
            echo get_the_post_thumbnail($post_id, array(60, 60));
        } else {
            echo '—';
        }
    }

}, 10, 2);

// Make Testimonial Image column narrow
add_action('admin_head', function () {
    echo '<style>
        .wp-list-table .column-thumbnail {
            width: 70px;
            text-align: center;
        }
    </style>';
});

// Style ACF Repeater Tabs with WP blue in admin
add_action('acf/input/admin_head', function () {
    ?>
    <style>
        /* ACF Tab base */
        .acf-tab-group li a {
            background: #2271b1 !important; /* WP admin blue */
            color: #fff !important;
            border-radius: 4px 4px 0 0;
            padding: 8px 14px !important;
            border: 1px solid #1d5f8a;
            margin-right: 4px;
        }

        /* Hover state */
        .acf-tab-group li a:hover {
            background: #135e96 !important;
            color: #fff;
        }

        /* Active tab */
        .acf-tab-group li.active a {
            background: #1e8cbe !important;
            border-bottom-color: #1e8cbe;
            font-weight: 600;
        }

        /* Remove default white tab underline gap */
        .acf-tab-group {
            border-bottom: 1px solid #1e8cbe !important;
        }
    </style>
    <?php
});

// ACF admin: Search Terms repeater as pills + working per-pill delete + keep pills after Add Row
add_action('acf/input/admin_head', function () {
?>
<style>
  /* Pill layout (your original) */
  .inline-search-terms .acf-repeater table.acf-table > tbody{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
  }
  .inline-search-terms .acf-repeater tr.acf-row{
    display:inline-flex;
    width:auto !important;
    border:1px solid #ccd0d4;
    border-radius:6px;
    padding:6px 8px;
    background:#fff;
    align-items:center;
  }
  .inline-search-terms .acf-repeater td{
    padding:0 !important;
    border:none !important;
  }
  .inline-search-terms .acf-repeater input[type="text"]{
    width:auto !important;
    min-width:60px;
    max-width:240px;
  }

  /* Keep ACF handle columns hidden so layout stays pills */
  .inline-search-terms .acf-repeater .acf-row-handle{
    display:none;
  }

  /* Our delete button */
  .inline-search-terms .inline-pill-delete{
    margin-left:6px;
    border:0;
    background:none;
    cursor:pointer;
    font-size:16px;
    line-height:1;
    padding:0;
    color:#b32d2e;
  }
  .inline-search-terms .inline-pill-delete:hover{
    color:#dc3232;
  }
</style>
<?php
});

add_action('acf/input/admin_footer', function () {
?>
<script>
(function(){
  function applyPillStylesToRow(row){
    if (!row || row.classList.contains('acf-clone')) return;

    // Force pill styles (survives ACF append/inline/table resets)
    row.style.setProperty('display', 'inline-flex', 'important');
    row.style.setProperty('width', 'auto', 'important');
    row.style.setProperty('alignItems', 'center', 'important');

    row.querySelectorAll('td').forEach(function(td){
      td.style.setProperty('padding', '0', 'important');
      td.style.setProperty('border', 'none', 'important');
    });
  }

  function applyPillStyles(scope){
    scope = scope || document;

    // Force tbody flex too (some ACF flows can reset it)
    scope.querySelectorAll('.inline-search-terms .acf-repeater table.acf-table > tbody').forEach(function(tbody){
      tbody.style.setProperty('display', 'flex', 'important');
      tbody.style.setProperty('flex-wrap', 'wrap', 'important');
      tbody.style.setProperty('gap', '8px', 'important');
    });

    scope.querySelectorAll('.inline-search-terms .acf-repeater tr.acf-row').forEach(applyPillStylesToRow);
  }

  function fireRealClick(el){
    // Some ACF handlers are happier with full mouse sequence
    ['mousedown','mouseup','click'].forEach(function(type){
      el.dispatchEvent(new MouseEvent(type, {bubbles:true, cancelable:true, view:window}));
    });
  }

  function addDeleteButtons(scope){
    scope = scope || document;

    scope.querySelectorAll('.inline-search-terms .acf-repeater tr.acf-row').forEach(function(row){
      if (row.classList.contains('acf-clone')) return;
      if (row.querySelector('.inline-pill-delete')) return;

      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'inline-pill-delete';
      btn.innerHTML = '×';
      btn.setAttribute('aria-label', 'Delete search term');

      btn.addEventListener('click', function(e){
        e.preventDefault();
        e.stopPropagation();

        // Use ACF’s own remove-row link inside THIS row
        var removeLink = row.querySelector('a[data-event="remove-row"]');
        if (!removeLink) return;

        // If ACF ignores hidden elements in some flows, temporarily unhide the remove cell
        var removeCell = removeLink.closest('td');
        var prevDisplay = removeCell && removeCell.style ? removeCell.style.display : '';

        if (removeCell) removeCell.style.display = 'block';

        // Prefer jQuery trigger if present (WP admin usually has it)
        if (window.jQuery) {
          window.jQuery(removeLink).trigger('mousedown').trigger('click');
        } else {
          fireRealClick(removeLink);
        }

        // Restore
        if (removeCell) removeCell.style.display = prevDisplay;
      });

      row.appendChild(btn);
    });
  }

  function enhance(scope){
    applyPillStyles(scope);
    addDeleteButtons(scope);
  }

  // Initial load
  document.addEventListener('DOMContentLoaded', function(){
    enhance(document);
  });

  // When ACF adds/duplicates/appends rows
  if (window.acf) {
    acf.addAction('ready append', function($el){
      enhance(($el && $el[0]) ? $el[0] : document);
    });
  }
})();
</script>
<?php
});


// Register Custom Taxonomy for Pages
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

// Make the taxonomy column sortable in Pages list.
add_filter( 'manage_edit-page_sortable_columns', function( $columns ) {
    $columns['taxonomy-page_category'] = 'page_category';
    return $columns;
} );

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

// Sitemap shortcode
function generate_sitemap() {

	$tmp_storage = array();
	// Start sitemap
	$sitemap = '<div class="sitemap-wrapper">';
 	$sitemap .= '<ul class="sitemap-list clearfix">';

	// Pages
	$pages_args = array(
		'exclude' => '', // ID of pages to be excluded, separated by comma
		'post_type' => 'page',
		'post_status' => 'publish',
		'sort_column' => 'post_title',
    	'sort_order'  => 'ASC'

	);
	$sitemap .= '<li><h3>Pages</h3>';
	$sitemap .= '<ul class="pages-list clearfix">';
	$pages = get_pages($pages_args);

	foreach ( $pages as $page ) :
		$sitemap .= '<li><a href="'.get_permalink( $page->ID ).'" rel="bookmark">'.$page->post_title.'</a></li>';
	endforeach;

	$sitemap .= '</ul></li>';

	// Custom Post Types
$allowed_cpts = array( 'trips' ); // only allow these post types

foreach ( get_post_types( array( 'public' => true ) ) as $post_type ) {
    if ( ! in_array( $post_type, $allowed_cpts ) ) continue;

    $cpt_object = get_post_type_object( $post_type );
    $sitemap .= '<li><h3>' . $cpt_object->labels->name . '</h3>';
    $sitemap .= '<ul class="custom-post-types-list clearfix">';

    // 1. Get all Trip Year terms — sort by year DESC (newest first)
    $years = get_terms( array(
        'taxonomy'   => 'trip_year',
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'DESC',   // ← NEWEST → OLDEST
    ));

    if ( ! empty( $years ) && ! is_wp_error( $years ) ) {

        foreach ( $years as $year ) {

            // Year heading
            $sitemap .= '<li><h4>' . esc_html( $year->name ) . '</h4>';
            $sitemap .= '<ul class="trip-year-sublist">';

            // 2. Get alphabetized trips inside this year
            $posts_in_year = get_posts( array(
                'post_type'      => 'trips',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'trip_year',
                        'field'    => 'term_id',
                        'terms'    => $year->term_id,
                    ),
                ),
            ));

            // 3. Output posts
            foreach ( $posts_in_year as $post_item ) {
                $sitemap .= '<li><a href="' . get_permalink( $post_item->ID ) . '" rel="bookmark">'
                          . esc_html( $post_item->post_title ) . '</a></li>';
            }

            $sitemap .= '</ul></li>'; // end year group
        }
    }

    $sitemap .= '</ul></li>'; // end CPT wrapper
}

	// Posts by Category
	//$cats = get_categories();
	//foreach ($cats as $cat) :
		$posts_args = array(
			'exclude' => '', // ID of pages to be excluded, separated by comma
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'   => -1	,
			//'category' => $cat->term_id
		);
		$sitemap .= '<li><h3>Posts</h3>';
		$sitemap .= '<ul class="posts-list clearfix">';
		$posts = get_posts($posts_args);

		foreach ( $posts as $post ) :
			$tmp_var = get_permalink( $post->ID );
			if (!in_array($tmp_var, $tmp_storage)) {
					$sitemap .= '<li><a href="'.get_permalink( $post->ID ).'" rel="bookmark">'.$post->post_title.'</a></li>';
					$tmp_storage[] = $tmp_var;
			}
		endforeach;

		$sitemap .= '</ul></li>';
	//endforeach;

	$sitemap .= '</ul></div>';

	return $sitemap;
}
add_shortcode( 'sitemap','generate_sitemap' );

// Small admin CSS tweak - Adjust width as needed
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

/* ACF preview helpers */
add_filter( 'acf/pre_load_post_id', function( $post_id ) {
    // Only run in preview mode
    if ( ! is_preview() || ! isset( $_GET['preview_id'] ) ) {
        return $post_id;
    }
    $preview_id = absint( $_GET['preview_id'] );
    $current_id = get_the_ID();

    // If ACF is trying to load the current post or a revision of it
    if ( in_array( (int) $post_id, [ (int) $current_id, (int) get_post_meta( $preview_id, '_edit_last', true ) ], true )
        || (int) $post_id === (int) $preview_id
        || (int) $post_id === (int) get_post_meta( $preview_id, '_wp_old_slug', true ) ) {
        return $preview_id;
    }
    // Otherwise, leave other referenced posts untouched
    return $post_id;
});

function acf_preview_id_safe( $post_id = null ) {
    if ( is_preview() && isset($_GET['preview_id']) ) {
        return absint($_GET['preview_id']);
    }
    return $post_id ?: get_the_ID();
}