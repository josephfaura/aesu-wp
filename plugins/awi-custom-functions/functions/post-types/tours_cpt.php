<?php 
// Register Custom Post Type
function Tours_post_type() {

	$labels = array(
		'name'                  => _x( 'Tours', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Tour', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Tours', 'text_domain' ),
		'name_admin_bar'        => __( 'Tour', 'text_domain' ),
		'archives'              => __( 'Tour Archives', 'text_domain' ),
		'attributes'            => __( 'Tour Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Tour:', 'text_domain' ),
		'all_items'             => __( 'All Tours', 'text_domain' ),
		'add_new_item'          => __( 'Add New Tour', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Tour', 'text_domain' ),
		'edit_item'             => __( 'Edit Tour', 'text_domain' ),
		'update_item'           => __( 'Update Tour', 'text_domain' ),
		'view_item'             => __( 'View Tour', 'text_domain' ),
		'view_items'            => __( 'View Tours', 'text_domain' ),
		'search_items'          => __( 'Search Tour', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Tour Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Tour', 'text_domain' ),
		'items_list'            => __( 'Tours list', 'text_domain' ),
		'items_list_navigation' => __( 'Tours list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Tours list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Tour', 'text_domain' ),
		'description'           => __( 'Tours offered by AESU and AWT', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'          => false,
		'taxonomies'            => array( 'tour_category','trip_year_taxonomy'),
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest' => true,
	);
	register_post_type( 'tours', $args );

}
add_action( 'init', 'tours_post_type', 0 );
// Register Custom Taxonomy
function tour_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Tour Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Tour Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Tour Categories', 'text_domain' ),
		'all_items'                  => __( 'All Tour Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Tour Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Tour Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Tour Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Tour Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Tour Category', 'text_domain' ),
		'update_item'                => __( 'Update Tour Category', 'text_domain' ),
		'view_item'                  => __( 'View Tour Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Tour Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Tour Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Tour Categories', 'text_domain' ),
		'search_items'               => __( 'Search Tour Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Tour Categories', 'text_domain' ),
		'items_list'                 => __( 'Tour Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Tour Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'tour_category', array( 'tours' ), $args );

}
add_action( 'init', 'tour_category_taxonomy', 0 );
// Add Author column to Tours CPT
add_filter( 'manage_tours_posts_columns', function( $columns ) {
    // Insert Author column after Title
    $new_columns = [];
    foreach ( $columns as $key => $label ) {
        $new_columns[ $key ] = $label;
        if ( $key === 'title' ) {
            $new_columns['author'] = __( 'Author', 'textdomain' );
        }
    }
    return $new_columns;
} );

// Populate Author column
add_action( 'manage_tours_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'author' ) {
        $author_id = get_post_field( 'post_author', $post_id );
        echo esc_html( get_the_author_meta( 'display_name', $author_id ) );
    }
}, 10, 2 );

// Make Author column sortable
add_filter( 'manage_edit-tours_sortable_columns', function( $columns ) {
    $columns['author'] = 'author';
    return $columns;
} );
// Add Slug column to Tours CPT
add_filter( 'manage_tours_posts_columns', function( $columns ) {
    // Insert Slug column after Title
    $new_columns = [];
    foreach ( $columns as $key => $label ) {
        $new_columns[ $key ] = $label;
        if ( $key === 'title' ) {
            $new_columns['slug'] = __( 'Slug', 'textdomain' );
        }
    }
    return $new_columns;
} );

// Populate Slug column
add_action( 'manage_tours_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'slug' ) {
        $post = get_post( $post_id );
        echo esc_html( $post->post_name );
    }
}, 10, 2 );

// Make Slug column sortable
add_filter( 'manage_edit-tours_sortable_columns', function( $columns ) {
    $columns['slug'] = 'slug';
    return $columns;
} );
// Add Trip Year taxonomy column to Tours CPT
add_filter( 'manage_tours_posts_columns', function( $columns ) {
    $columns['trip_year'] = __( 'Trip Year', 'textdomain' );
    return $columns;
} );

// Populate Trip Year taxonomy column
add_action( 'manage_tours_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'trip_year' ) {
        $terms = get_the_terms( $post_id, 'trip_year' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $term_links = [];
            foreach ( $terms as $term ) {
                $term_links[] = sprintf(
                    '<a href="%s">%s</a>',
                    esc_url( add_query_arg( [
                        'post_type'  => 'tours',
                        'trip_year'  => $term->slug
                    ], admin_url( 'edit.php' ) ) ),
                    esc_html( $term->name )
                );
            }
            echo implode( ', ', $term_links );
        } else {
            echo '<span style="color:#999;">—</span>';
        }
    }
}, 10, 2 );

// Make Trip Year column sortable
add_filter( 'manage_edit-tours_sortable_columns', function( $columns ) {
    $columns['trip_year'] = 'trip_year';
    return $columns;
} );

// Handle sorting by Trip Year
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }
    if ( $query->get( 'orderby' ) === 'trip_year' ) {
        $query->set( 'tax_query', [
            [
                'taxonomy' => 'trip_year',
                'field'    => 'slug',
                'terms'    => [], // No filtering, just join for ordering
            ]
        ] );
        // Note: Real taxonomy term sorting in admin is tricky — WP doesn't do it natively.
        // This will group by term but may not sort alphabetically unless we join manually.
    }
} );
// 1. Make trip_category column sortable in Trips CPT admin
add_filter( 'manage_edit-tours_sortable_columns', function( $columns ) {
    $columns['taxonomy-tour_category'] = 'tour_category';
    return $columns;
} );

// 2. Handle sorting by tour_category term name
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->get( 'orderby' ) === 'tour_category' ) {
        global $wpdb;

        // Join term relationships and taxonomy tables
        $query->set( 'orderby', 'term_name' );

        add_filter( 'posts_clauses', function( $clauses ) use ( $wpdb ) {
            // Join terms for sorting
            $clauses['join'] .= "
                LEFT JOIN {$wpdb->term_relationships} AS tr ON ({$wpdb->posts}.ID = tr.object_id)
                LEFT JOIN {$wpdb->term_taxonomy} AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
                LEFT JOIN {$wpdb->terms} AS t ON (tt.term_id = t.term_id AND tt.taxonomy = 'tour_category')
            ";

            // Order by term name (handle posts with no term by putting them last)
            $clauses['orderby'] = "t.name ASC";

            return $clauses;
        } );
    }
} );
// Add "Header Type" column to Trips CPT
add_filter( 'manage_trips_posts_columns', function( $columns ) {
    $columns['header_type'] = __( 'Brand', 'textdomain' );
    return $columns;
} );

// Populate "Header Type" column (only once)
add_action( 'manage_trips_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'header_type' ) {
        $value = get_post_meta( $post_id, 'header_type', true );
        //echo $value ? esc_html( $value ) : '';
		if($value == "aesuaesu" || $value == "AESU"){
			echo "AESU";
		}elseif($value == "awtawt" || $value == "AWT"){
			echo "AWT";
		}
    }
}, 10, 2 );

// (Optional) Make column sortable
add_filter( 'manage_edit-trips_sortable_columns', function( $columns ) {
    $columns['header_type'] = 'header_type';
    return $columns;
} );

// Handle sorting by header_type
add_action( 'pre_get_posts', function( $query ) {
    if ( is_admin() && $query->is_main_query() && $query->get( 'orderby' ) === 'header_type' ) {
        $query->set( 'meta_key', 'header_type' );
        $query->set( 'orderby', 'meta_value' );
    }
} );