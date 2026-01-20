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
 * Enqueue scripts and styles.
 */
function awi_revamped_scripts() {
	// Theme CSS (cache-bust on file change)
	wp_enqueue_style(
		'awi-revamped-style',
		get_stylesheet_uri(),
		[],
		file_exists( get_stylesheet_directory() . '/style.css' ) ? filemtime( get_stylesheet_directory() . '/style.css' ) : _S_VERSION
	);
	wp_style_add_data( 'awi-revamped-style', 'rtl', 'replace' );

	// Core JS
	wp_enqueue_script( 'awi-revamped-navigation', get_template_directory_uri() . '/js/navigation.js', [], _S_VERSION, true );
	wp_enqueue_script( 'awi-revamped-svg',        get_template_directory_uri() . '/js/svgxuse.min.js', [], _S_VERSION, true );
	wp_enqueue_script( 'awiNav',                  get_template_directory_uri() . '/js/awiNav-1.2.1.js', [ 'jquery' ], false, true );

	// Flexslider
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', [ 'jquery' ], false, true );
	wp_enqueue_style ( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' );

	// Fancybox
	wp_enqueue_script( 'fancybox-js-theme',  get_template_directory_uri() . '/js/fancybox.umd.js', [ 'jquery' ], false, true );
	wp_enqueue_style ( 'fancybox-css-theme', get_template_directory_uri() . '/css/fancybox.css' );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Font Awesome is provided by the Font Awesome Official plugin (v6.7.x).
	// Remove any manual CDN enqueues to avoid duplicates.

	// Slick
	wp_enqueue_style ( 'slick',       get_template_directory_uri() . '/js/slick/slick.css', [], '1.8.1' );
	wp_enqueue_style ( 'slick-theme', get_template_directory_uri() . '/js/slick/slick-theme.css', [ 'slick' ], '1.8.1' );
	wp_enqueue_script( 'slick',       get_template_directory_uri() . '/js/slick/slick.min.js', [ 'jquery' ], '1.8.1', true );

	// Carousel fixes / initialization (depends on slick)
	wp_enqueue_script(
		'awi-carousel-fixes',
		get_stylesheet_directory_uri() . '/js/carousel-fixes.js',
		[ 'jquery', 'slick' ],
		file_exists( get_stylesheet_directory() . '/js/carousel-fixes.js' ) ? filemtime( get_stylesheet_directory() . '/js/carousel-fixes.js' ) : _S_VERSION,
		true
	);

	// Itinerary toggler (plus/minus icons, a11y)
	wp_enqueue_script( 'itinerary-toggle', get_template_directory_uri() . '/js/itinerary-toggle.js', [ 'jquery' ], _S_VERSION, true );
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

/**
 * Footer scripts that are not Slick initializations (Slick is now initialized
 * exclusively in js/carousel-fixes.js to avoid double-inits).
 */
add_action('wp_footer', 'awi_initialize_scripts', 9999);
function awi_initialize_scripts() { ?>
<script>
(function($){
	/* Accordion (legacy simple accordions not managed by itinerary-toggle.js) */
	$('.acc-button-all').on('click',function() {
		if ($(this).hasClass('acc-toggle-open')) {
			$('.acc-button').removeClass('acc-active');
			$('.acc-content').slideUp('normal');
			$(this).removeClass('acc-toggle-open');
		} else {
			$('.acc-button').addClass('acc-active');
			$('.acc-content').slideDown('normal');
			$(this).addClass('acc-toggle-open');
		}
	});
	$('.acc-button').on('click',function() {
		if ($(this).next().is(':hidden')) {
			$(this).addClass('acc-active');
			$(this).next().slideDown('normal');
		} else {
			$(this).next().slideUp('normal');
			$(this).removeClass('acc-active');
		}
	});
})( jQuery );
</script>


<script>
(function($){
	//AWT TOC Search/filter
	<?php if(is_page(898)){ ?>
	$(document).on('change','.interior_banner input',function(){
		var textentered = $(this).val().toLowerCase();
		var loop_counter = 0;
		$('.packages li').each(function(){
			let element_text = $("#"+$(this).attr('id')).text().toLowerCase();
			if(!element_text.includes(textentered)){
				$("#"+$(this).attr('id')).css('display','none');
			}else{
				$("#"+$(this).attr('id')).css('display','flex');
				loop_counter += 1;
			}
		});
		$('.awt_toc_form').css('display', loop_counter === 0 ? 'block' : 'none');
	});
	$(document).on('click','#search_submit',function(){
		$([document.documentElement, document.body]).animate({
			scrollTop: $(".packages").first().offset().top - 260
		}, 500);
	});
	<?php if(isset($_GET['show_values']) && $_GET['show_values'] === 'true'){ ?>
	$(document).ready(function(){
		$('.packages li').each(function(){
			$('footer').append($(this).find('.package_thumbnail img').attr('src') + '<br>');
		});
	});
	<?php } ?>
	<?php } ?>

	//Load more images behavior in Landing Page Gallery
     (function($){
    $(document).ready(function(){

        let itemsToShow = 6; // how many to load each click
        let $items = $('.past_tour_gallery li');
        let totalItems = $items.length;

        $('.load_more_images').on('click', function(e){
            e.preventDefault();

            // Find how many are currently visible
            let visibleCount = $items.filter(':visible').length;

            // Show the next 6
            $items.slice(visibleCount, visibleCount + itemsToShow).fadeIn();

            // After revealing, check if we reached the end
            if (visibleCount + itemsToShow >= totalItems) {
                $(this).hide(); // hide "Load More Images"
            }
        });

    });
})(jQuery);

	//GA Tracking calls and form submissions
	$(document).ready(function(){
	  $("a[href^='tel']").on("click",function(){
	    gtag('event', 'click_to_call', { 'lead_source': '<?php echo isset($_SESSION['utm_source']) ? esc_js($_SESSION['utm_source']) : '' ; ?>' });
	  });
	  var wpcf7Elm = document.querySelector('.wpcf7');
	  document.addEventListener('wpcf7mailsent', function(e) {
	    e.preventDefault();
	    gtag('event', 'contact_form_submitted', { 'lead_source': '<?php echo isset($_SESSION['utm_source']) ? esc_js($_SESSION['utm_source']) : '' ; ?>' });
	  }, false);
	});

	//Flexslider wait for page to load to animate
	$(window).on('load', function() {
		$('.flexslider').flexslider({
			animation: "slide",
			prevText: '<i class="fa-solid fa-angle-left"></i>',
			nextText: '<i class="fa-solid fa-angle-right"></i>'
		});
	});

	// NOTE: The old global .accordion_trigger handler is removed.
	// Itinerary accordions are handled by itinerary-toggle.js.

	// Keep What's Included expand/collapse-all (legacy)
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
  /* New Header scroll behavior for top nav and trip headers */
document.addEventListener("DOMContentLoaded", function() {

    let lastScrollTop = 0;
    const triggerRatio = 0.25; // 25vh trigger
    let isTripPage = <?php echo ( is_singular('trips') || is_singular('tours') ) ? 'true' : 'false'; ?>;

    // Determine scroll target dynamically
    function getScrollTarget() {
	    if (!isTripPage) {
	        // Non-trip pages → target the visible header class
	        if (window.innerWidth < 880) {
	            return document.querySelector('.mobile_header');
	        } else {
	            return document.querySelector('.desktop_header');
	        }
	    } else {
	        // Single trip pages → only mobile/tablet <=976px
	        if (window.innerWidth <= 976) {
	            return document.querySelector('.trip_header');
	        } else {
	            return null; // Desktop trip pages → sticky, no scroll behavior
	        }
	    }
	}

    // Initialize element style for smooth transform
    function initStyle(el) {
        if (!el) return;
        el.style.transition = "transform 0.3s ease";
        el.style.willChange = "transform";
        el.style.transform = "translateY(0)";
    }

    // Scroll handler
    function onScroll() {
        const currentScroll = window.scrollY;
        const triggerPoint = window.innerHeight * triggerRatio;
        const target = getScrollTarget();

        if (!target || currentScroll < triggerPoint) {
            return; // No element or not past trigger point
        }

        if (currentScroll < lastScrollTop) {
            // Scrolling UP → show
            target.style.transform = "translateY(0)";
        } else {
            // Scrolling DOWN → hide
            target.style.transform = `translateY(-${target.offsetHeight + 4}px)`;
        }

        lastScrollTop = currentScroll;
    }

    // Run init
    const initialTarget = getScrollTarget();
    initStyle(initialTarget);

    // Listen to scroll and resize
    window.addEventListener('scroll', onScroll);

    // Re-init on resize (important for trip pages)
    window.addEventListener('resize', function() {
        const target = getScrollTarget();
        initStyle(target);
    });

});
</script>

<script>
/* Autoplay Home Page Banner Video on Desktop and Click to Play in Frame on Mobile*/
(function($){

    const video = $('.banner_video').get(0);
    const playBtn = $('.play_banner_video');

    // Lazy-load when visible
    const observer = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
            if(entry.isIntersecting){
                video.load();

                // Desktop autoplay
                if(window.innerWidth >= 768){
                    video.play();
                }

                observer.disconnect();
            }
        });
    });
    observer.observe(video);

    // MOBILE: click to play
    playBtn.on('click', function(){
        video.play();
        $(this).fadeOut();
    });

})(jQuery);
</script>

<?php
}


/* ---------- AESU Trips Home Page Search Functions  ---------- */

/* ---------------------------------------------------------------
 * Build a search index for Trip CPT including linked Tour content
 * --------------------------------------------------------------- */
add_action('acf/save_post', 'awi_build_trip_search_index', 20);
function awi_build_trip_search_index($post_id) {

    // Only target Trips
    if (get_post_type($post_id) !== 'trips') return;

    // Prevent autosave / revisions
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) return;

    // Slight delay to ensure all ACF fields (including Post Objects) are saved
    // This avoids timing issues
    // Run in the next tick
    add_action('shutdown', function() use ($post_id) {

        $index = [];

        // Trip-native content
        $index[] = get_the_title($post_id);
        $content = get_post_field('post_content', $post_id);
        if (!empty($content)) $index[] = $content;

        // Get the Tour Post Object
        $tour_obj = get_field('tour', $post_id);
        if ($tour_obj instanceof WP_Post) {
            $tour_id = $tour_obj->ID;

            // Tour title
            $index[] = get_the_title($tour_id);

            // Top-level fields
            $description  = get_field('description', $tour_id);
            $destinations = get_field('destinations', $tour_id);
            if (!empty($description)) $index[] = $description;
            if (!empty($destinations)) $index[] = $destinations;

            // Repeaters
            $repeaters = [
                'trip_highlights',
                'highlight_accordion',
                'itinerary_items',
                'hotels_items',
                'manual_search_terms'
            ];

            foreach ($repeaters as $repeater) {
                $rows = get_field($repeater, $tour_id);
                if (empty($rows) || !is_array($rows)) continue;

                foreach ($rows as $row) {
                    if (!is_array($row)) continue;
                    foreach ($row as $value) {
                        if (is_string($value) && trim($value) !== '') {
                            $index[] = $value;
                        }
                    }
                }
            }
        }

        // Normalize + save
        $index_string = strtolower(
            wp_strip_all_tags(
                implode(' ', $index)
            )
        );
        update_field('search_index', $index_string, $post_id);

    }, 0);
}


/**
 * Force the front-page search to ONLY return Trips with header_type = AESU
 */
function awi_force_trips_search_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        if ( isset($_GET['post_type']) && $_GET['post_type'] === 'trips' ) {
            $query->set( 'post_type', 'trips' );

            // Filter to only AESU trips
            $meta_query = array(
                array(
                    'key'     => 'header_type',
                    'value'   => 'AESU',
                    'compare' => '=',
                ),
            );

            $query->set( 'meta_query', $meta_query );
            $query->set( 'post_status', 'publish' );
        }
    }
}
add_action( 'pre_get_posts', 'awi_force_trips_search_query', 999 );


/**
 * Custom search for Trips CPT
 * - Searches Trip fields exactly: title, post_content, citiescountries, main_trip_content
 * - Searches Tour content (search_index) with fuzzy matching
 * - Includes optional manual_search_terms repeater
 */
add_filter( 'posts_search', 'awi_trips_acf_search', 10, 2 );
function awi_trips_acf_search( $search, $query ) {

    // Only target main query & trips search
    if ( ! $query->is_main_query() || ! $query->is_search() ) return $search;
    if ( ! isset($_GET['post_type']) || $_GET['post_type'] !== 'trips' ) return $search;

    global $wpdb;
    $raw_search = trim( $query->get('s') );
    if ( empty($raw_search) ) return $search;

    // Split keywords (no synonyms yet — we’ll use manual_search_terms in Tours instead)
    $keywords = explode( ' ', $raw_search );

    $keyword_clauses = [];
    foreach ( $keywords as $word ) {
        $word_esc = esc_sql( $word );

        // Fuzzy version only for search_index
        $fuzzy = preg_replace('/(s|es|ed|ing|ian|ianan)$/i', '', $word_esc);

        $keyword_clauses[] = "
            (
                {$wpdb->posts}.post_title LIKE '%{$word_esc}%'
                OR {$wpdb->posts}.post_content LIKE '%{$word_esc}%'
                OR EXISTS (
                    SELECT 1 FROM {$wpdb->postmeta} 
                    WHERE post_id = {$wpdb->posts}.ID 
                    AND meta_key = 'citiescountries' 
                    AND meta_value LIKE '%{$word_esc}%'
                )
                OR EXISTS (
                    SELECT 1 FROM {$wpdb->postmeta} 
                    WHERE post_id = {$wpdb->posts}.ID 
                    AND meta_key = 'main_trip_content' 
                    AND meta_value LIKE '%{$word_esc}%'
                )
                OR EXISTS (
                    SELECT 1 FROM {$wpdb->postmeta}
                    WHERE post_id = {$wpdb->posts}.ID
                    AND meta_key = 'search_index'
                    AND (meta_value LIKE '%{$word_esc}%' OR meta_value LIKE '%{$fuzzy}%')
                )
            )
        ";
    }

    if ( !empty($keyword_clauses) ) {
        $search = " AND (" . implode( " OR ", $keyword_clauses ) . ")";
    }

    return $search;
}


/**
 * Relevance scoring: title > content > Trip ACF fields > search_index
 * Exact match for Trip fields, fuzzy match on search_index
 */
add_filter( 'posts_clauses', 'awi_trips_relevance_order', 10, 2 );
function awi_trips_relevance_order( $clauses, $query ) {

    if ( ! $query->is_main_query() || ! $query->is_search() ) return $clauses;
    if ( ! isset($_GET['post_type']) || $_GET['post_type'] !== 'trips' ) return $clauses;

    global $wpdb;
    $raw_search = trim( $query->get('s') );
    if ( empty($raw_search) ) return $clauses;

    $words = explode( ' ', esc_sql( $raw_search ) );
    $relevance_sql = [];

    foreach ( $words as $word ) {
        $word_esc = esc_sql($word);
        $fuzzy = preg_replace('/(s|es|ed|ing|ian|ianan)$/i', '', $word_esc);

        // Trip title (highest weight)
        $relevance_sql[] = "(CASE WHEN {$wpdb->posts}.post_title LIKE '%{$word_esc}%' THEN 5 ELSE 0 END)";

        // Trip content
        $relevance_sql[] = "(CASE WHEN {$wpdb->posts}.post_content LIKE '%{$word_esc}%' THEN 2 ELSE 0 END)";

        // Trip ACF fields
        $relevance_sql[] = "(CASE WHEN EXISTS (
            SELECT 1 FROM {$wpdb->postmeta} 
            WHERE post_id = {$wpdb->posts}.ID 
            AND meta_key = 'citiescountries' 
            AND meta_value LIKE '%{$word_esc}%'
        ) THEN 1 ELSE 0 END)";

        $relevance_sql[] = "(CASE WHEN EXISTS (
            SELECT 1 FROM {$wpdb->postmeta} 
            WHERE post_id = {$wpdb->posts}.ID 
            AND meta_key = 'main_trip_content' 
            AND meta_value LIKE '%{$word_esc}%'
        ) THEN 1 ELSE 0 END)";

        // Search index (Tour content + manual_search_terms) with fuzzy
        $relevance_sql[] = "(CASE WHEN EXISTS (
            SELECT 1 FROM {$wpdb->postmeta} 
            WHERE post_id = {$wpdb->posts}.ID 
            AND meta_key = 'search_index' 
            AND (meta_value LIKE '%{$word_esc}%' OR meta_value LIKE '%{$fuzzy}%')
        ) THEN 1 ELSE 0 END)";
    }

    if ( !empty($relevance_sql) ) {
        $clauses['orderby'] = "(" . implode( " + ", $relevance_sql ) . ") DESC, {$wpdb->posts}.post_date DESC";
    }

    return $clauses;
}


/* ---------- General Search Parameters and Helper Functions  ---------- */

/* Exclude CPT from Search Querry */
function exclude_cpt_from_search( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {

		$post_types = get_post_types(
			array(
				'public' => true,
				'exclude_from_search' => false,
			),
			'names'
		);

		// Removes CPTs you do NOT want searchable
		unset( $post_types['tours'] );

		$query->set( 'post_type', $post_types );
	}
}
add_action( 'pre_get_posts', 'exclude_cpt_from_search' );

/* Search Results Query helper */

/*
 * Set posts per page for Search + Archive pages
 */
function awi_custom_posts_per_page( $query ) {

	// Only affect the main front-end query
	if ( ! is_admin() && $query->is_main_query() ) {

		// Search pages → 9 posts
		if ( $query->is_search() ) {
			$query->set( 'posts_per_page', 9 );
		}

		// Archive pages → 9 posts
		if ( $query->is_archive() ) {
			$query->set( 'posts_per_page', 9 );
		}

	}

}
add_action( 'pre_get_posts', 'awi_custom_posts_per_page' );

/* Search Results excerpt fields helper */
function get_search_excerpt( $post_id = null, $word_limit = 25 ) {

    $post_id = $post_id ?: get_the_ID();

    $clean_text = function( $text ) use ( $word_limit ) {
        if ( ! $text ) {
            return false;
        }

        // 1. Remove shortcodes
        $text = strip_shortcodes( $text );

        // 2. Replace block-level tags with spaces to prevent word smashing
        $block_tags = [
            'p', 'div', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
            'li', 'ul', 'ol', 'section', 'article', 'header', 'footer', 'blockquote'
        ];

        foreach ( $block_tags as $tag ) {
            // Add a space before and after each block tag
            $text = preg_replace( '#</?' . $tag . '[^>]*>#i', ' ', $text );
        }

        // 3. Replace <br> and <br /> with space
        $text = preg_replace( '#<br\s*/?>#i', ' ', $text );

        // 4. Strip any remaining HTML tags
        $text = wp_strip_all_tags( $text );

        // 5. Collapse multiple spaces
        $text = trim( preg_replace( '/\s+/', ' ', $text ) );

        // 6. Trim to word limit
        return wp_trim_words( $text, $word_limit, '...' );
    };

    // Try ACF WYSIWYG / textarea fields first
    if ( function_exists( 'get_field_objects' ) ) {

        $fields = get_field_objects( $post_id );

        if ( $fields ) {
            foreach ( $fields as $field ) {

                if ( in_array( $field['type'], [ 'wysiwyg', 'textarea' ], true ) && ! empty( $field['value'] ) ) {

                    $excerpt = $clean_text( $field['value'] );

                    if ( $excerpt ) {
                        return $excerpt;
                    }
                }
            }
        }
    }

    // Fall back to post content
    $content = get_post_field( 'post_content', $post_id );
    $excerpt = $clean_text( $content );
    if ( $excerpt ) {
        return $excerpt;
    }

    // Fall back to manual excerpt
    $excerpt = $clean_text( get_post_field( 'post_excerpt', $post_id ) );
    if ( $excerpt ) {
        return $excerpt;
    }

    return '';
}

//* Search Results image Thumbnail helper */
function get_first_image_url( $post_id = null ) {

	$post_id = $post_id ?: get_the_ID();

	// 1. ACF hero image
	if ( function_exists( 'get_field' ) ) {

		$hero_image = get_field( 'hero_image', $post_id );
		if ( ! empty( $hero_image['url'] ) ) {
			return $hero_image['url'];
		}

		$welcome_letter_image = get_field( 'welcome_letter_image', $post_id );
		if ( ! empty( $welcome_letter_image['url'] ) ) {
			return $welcome_letter_image['url'];
		}

		// Text-based URL fallback
		$trip_hero_image_text_url = get_field( 'trip_hero_image_text_url', $post_id );
		if ( ! empty( $trip_hero_image_text_url ) ) {
			return $trip_hero_image_text_url;
		}

		// 2. Slider repeater (first slide image)
		if ( have_rows( 'slider', $post_id ) ) {
			the_row(); // first row only
			$image = get_sub_field( 'slide_image' );

			if ( ! empty( $image['url'] ) ) {
				return $image['url'];
			}
		}
	}

	// 3. Fallback to content <img>
	$content = get_post_field( 'post_content', $post_id );
	if ( $content && preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/', $content, $matches ) ) {
		return $matches[1];
	}

	return false;
}

// Cache results
$thumb = get_post_meta( get_the_ID(), '_first_image', true );

if ( ! $thumb ) {
	$thumb = get_first_image_url();
	update_post_meta( get_the_ID(), '_first_image', $thumb );
}
																									     																																																																	



/* ---------- Misc. Options and Backend Functions  ---------- */

// Require SMS consent only when phone number is entered 
add_filter('wpcf7_validate_tel', 'require_sms_consent_if_phone', 10, 2);
add_filter('wpcf7_validate_tel*', 'require_sms_consent_if_phone', 10, 2);
function require_sms_consent_if_phone($result, $tag) {
	if ($tag->name !== 'sms-phone') {
		return $result;
	}
	$phone   = isset($_POST['sms-phone']) ? trim($_POST['sms-phone']) : '';
	$consent = isset($_POST['sms-consent']) ? $_POST['sms-consent'] : '';
	if ($phone && empty($consent)) {
		$result->invalidate(
			$tag,
			'Please agree to receive text messages if you provide a phone number.'
		);
	}
	return $result;
}
// Validate US phone numbers in forms
add_filter('wpcf7_validate_tel', 'validate_us_phone_number', 20, 2);
add_filter('wpcf7_validate_tel*', 'validate_us_phone_number', 20, 2);
function validate_us_phone_number($result, $tag) {
	if ($tag->name !== 'sms-phone') {
		return $result;
	}
	$phone = isset($_POST['sms-phone']) ? trim($_POST['sms-phone']) : '';
	if ($phone === '') {
		return $result; // optional field
	}
	// Strip non-digits
	$digits = preg_replace('/\D/', '', $phone);

	// US NANP: must be 10 digits and not start with 0 or 1
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

// Makes ACF Field Search Terms align as Rows on the backend
add_action('acf/input/admin_head', function () {
    ?>
    <style>
        /* Inline layout for manual search terms repeater */
        .inline-search-terms .acf-repeater table.acf-table > tbody {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .inline-search-terms .acf-repeater tr.acf-row {
            display: inline-flex;
            width: auto !important;
            border: 1px solid #ccd0d4;
            border-radius: 6px;
            padding: 6px 8px;
            background: #fff;
        }
        .inline-search-terms .acf-repeater td {
            padding: 0 !important;
            border: none !important;
        }
        .inline-search-terms .acf-repeater input[type="text"] {
            width: auto !important;
            min-width: 60px;
            max-width: 240px;
        }
        .inline-search-terms .acf-repeater .acf-row-handle {
            display: none;
        }
        .inline-search-terms .acf-repeater .acf-icon.-minus {
            margin-left: 6px;
        }
    </style>
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