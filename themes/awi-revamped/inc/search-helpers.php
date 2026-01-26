<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
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
