<?php 
// Register Custom Post Type
function trips_post_type() {

	$labels = array(
		'name'                  => _x( 'Trips', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Trip', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Trips', 'text_domain' ),
		'name_admin_bar'        => __( 'Trip', 'text_domain' ),
		'archives'              => __( 'Trip Archives', 'text_domain' ),
		'attributes'            => __( 'Trip Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Trip:', 'text_domain' ),
		'all_items'             => __( 'All Trips', 'text_domain' ),
		'add_new_item'          => __( 'Add New Trip', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Trip', 'text_domain' ),
		'edit_item'             => __( 'Edit Trip', 'text_domain' ),
		'update_item'           => __( 'Update Trip', 'text_domain' ),
		'view_item'             => __( 'View Trip', 'text_domain' ),
		'view_items'            => __( 'View Trips', 'text_domain' ),
		'search_items'          => __( 'Search Trip', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Trip Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this trip', 'text_domain' ),
		'items_list'            => __( 'Trips list', 'text_domain' ),
		'items_list_navigation' => __( 'Trips list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Trips list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Trip', 'text_domain' ),
		'description'           => __( 'Trips offered by AESU and AWT', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'          => false,
		'taxonomies'            => array('trip_year','trip_category'),
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' => true,
		'has_archive' => false,
		'rewrite' => array(
                'slug' => 'trip'
            )
	);
	register_post_type( 'trips', $args );

}
add_action( 'init', 'trips_post_type', 0 );
// Register Custom Taxonomy
/*function tours_tax() {

	$labels = array(
		'name'                       => _x( 'Tours', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Tour', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Tours', 'text_domain' ),
		'all_items'                  => __( 'All Tours', 'text_domain' ),
		'parent_item'                => __( 'Parent Tour', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Tour:', 'text_domain' ),
		'new_item_name'              => __( 'New TourName', 'text_domain' ),
		'add_new_item'               => __( 'Add New Tour', 'text_domain' ),
		'edit_item'                  => __( 'Edit Tour', 'text_domain' ),
		'update_item'                => __( 'Update Tour', 'text_domain' ),
		'view_item'                  => __( 'View Tour', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Tours', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Tours', 'text_domain' ),
		'search_items'               => __( 'Search Tours', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Tours', 'text_domain' ),
		'items_list'                 => __( 'Tours list', 'text_domain' ),
		'items_list_navigation'      => __( 'Tours list navigation', 'text_domain' ),
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
	register_taxonomy( 'tours', array( 'trips' ), $args );

}
add_action( 'init', 'tours_tax', 0 );*/
// Register Custom Taxonomy
// Register Custom Taxonomy
function trip_year_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Trip Years', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Trip Year', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Trip Year', 'text_domain' ),
		'all_items'                  => __( 'All Trip Years', 'text_domain' ),
		'parent_item'                => __( 'Parent Trip Year', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Trip Year:', 'text_domain' ),
		'new_item_name'              => __( 'New Trip Year Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Trip Year', 'text_domain' ),
		'edit_item'                  => __( 'Edit Trip Year', 'text_domain' ),
		'update_item'                => __( 'Update Trip Year', 'text_domain' ),
		'view_item'                  => __( 'View Trip Year', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Trip Years with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Trip Years', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Trip Years', 'text_domain' ),
		'search_items'               => __( 'Search Trip Years', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Trip Years', 'text_domain' ),
		'items_list'                 => __( 'Trip Years list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'          => true,
		
	);
	register_taxonomy( 'trip_year', array( 'trips','tours' ), $args );

}
// Register Custom Taxonomy
function trip_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Trip Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Trip Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Trip Categories', 'text_domain' ),
		'all_items'                  => __( 'All Trip Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Trip Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Trip Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Trip Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Trip Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Trip Category', 'text_domain' ),
		'update_item'                => __( 'Update Trip Category', 'text_domain' ),
		'view_item'                  => __( 'View Trip Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Trip Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Trip Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Trip Categories', 'text_domain' ),
		'search_items'               => __( 'Search Trip Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Trip Categories', 'text_domain' ),
		'items_list'                 => __( 'Trip Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Trip Categories list navigation', 'text_domain' ),
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
	register_taxonomy( 'trip_category', array( 'trips', ), $args );

}
add_action( 'init', 'trip_category_taxonomy', 0 );
add_action( 'init', 'trip_year_taxonomy', 0 );
// Add new column to the Trips post type list
add_filter('manage_trips_posts_columns', 'add_slug_column_to_trips');
function add_slug_column_to_trips($columns) {
    // Insert the new column after the title column
    $new_columns = [];
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['slug'] = 'Slug';
        }
    }
    return $new_columns;
}

// Display slug in the new column
add_action('manage_trips_posts_custom_column', 'show_slug_column_trips', 10, 2);
function show_slug_column_trips($column, $post_id) {
    if ($column === 'slug') {
        $post = get_post($post_id);
        echo esc_html($post->post_name);
    }
}
// 1. Make the 'slug' column sortable
add_filter('manage_edit-trips_sortable_columns', 'make_trips_slug_sortable');
function make_trips_slug_sortable($columns) {
    $columns['slug'] = 'post_name'; // key must match the query_var
    return $columns;
}

// 2. Modify the query to sort by 'post_name' when 'slug' is requested
add_action('pre_get_posts', 'enable_slug_sorting_for_trips');
function enable_slug_sorting_for_trips($query) {
    if (!is_admin() || !$query->is_main_query()) return;

    if ($query->get('post_type') === 'trips' && $query->get('orderby') === 'post_name') {
        $query->set('orderby', 'post_name'); // post_name is the DB column for slugs
    }
}
add_filter('manage_edit-trips_sortable_columns', 'make_trip_year_sortable');
function make_trip_year_sortable($columns) {
    $columns['trip_year'] = 'trip_year';
    return $columns;
}
add_filter('manage_trips_posts_columns', 'add_trip_year_column');
function add_trip_year_column($columns) {
    $columns['trip_year'] = 'Trip Year';
    return $columns;
}

add_action('manage_trips_posts_custom_column', 'show_trip_year_column', 10, 2);
function show_trip_year_column($column, $post_id) {
    if ($column === 'trip_year') {
        $terms = get_the_terms($post_id, 'trip_year');
        if (!empty($terms) && !is_wp_error($terms)) {
            echo esc_html(join(', ', wp_list_pluck($terms, 'name')));
        }
    }
}
add_action('pre_get_posts', 'sort_trips_by_trip_year');
function sort_trips_by_trip_year($query) {
    if (!is_admin() || !$query->is_main_query()) return;

    if ($query->get('post_type') === 'trips' && $query->get('orderby') === 'trip_year') {
        $query->set('orderby', 'trip_year_name'); // we'll alias this later

        // Add JOIN and ORDERBY via filter
        add_filter('posts_clauses', 'trip_year_sorting_clauses', 10, 2);
    }
}

function trip_year_sorting_clauses($clauses, $query) {
    global $wpdb;

    $clauses['join'] .= "
        LEFT JOIN {$wpdb->term_relationships} AS tr 
            ON {$wpdb->posts}.ID = tr.object_id
        LEFT JOIN {$wpdb->term_taxonomy} AS tt 
            ON tr.term_taxonomy_id = tt.term_taxonomy_id 
            AND tt.taxonomy = 'trip_year'
        LEFT JOIN {$wpdb->terms} AS t 
            ON tt.term_id = t.term_id
    ";

    $clauses['orderby'] = "t.name " . ($query->get('order') === 'desc' ? 'DESC' : 'ASC');

    return $clauses;
}
// Add Author column to Trips CPT
add_filter( 'manage_trips_posts_columns', function( $columns ) {
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
add_action( 'manage_trips_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'author' ) {
        $author_id = get_post_field( 'post_author', $post_id );
        echo esc_html( get_the_author_meta( 'display_name', $author_id ) );
    }
}, 10, 2 );

// Make Author column sortable
add_filter( 'manage_edit-trips_sortable_columns', function( $columns ) {
    $columns['author'] = 'author';
    return $columns;
} );
// Add "School" column to Trips CPT
add_filter( 'manage_trips_posts_columns', function( $columns ) {
    $columns['school'] = __( 'School', 'textdomain' );
    return $columns;
} );

// Populate "School" column
add_action( 'manage_trips_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'school' ) {
        $school_id = get_field( 'school', $post_id ); // ACF Post Object
        if ( $school_id ) {
            echo esc_html( get_the_title( $school_id ) );
        } else {
            echo '<span style="color:#999;">—</span>';
        }
    }
}, 10, 2 );

// (Optional) Make column sortable by School title
add_filter( 'manage_edit-trips_sortable_columns', function( $columns ) {
    $columns['school'] = 'school';
    return $columns;
} );

// Handle sorting by School title
add_action( 'pre_get_posts', function( $query ) {
    if ( is_admin() && $query->is_main_query() && $query->get( 'orderby' ) === 'school' ) {
        $query->set( 'meta_key', 'school' );
        $query->set( 'orderby', 'meta_value' );
    }
} );
// 1. Make trip_category column sortable in Trips CPT admin
add_filter( 'manage_edit-trips_sortable_columns', function( $columns ) {
    $columns['taxonomy-trip_category'] = 'trip_category';
    return $columns;
} );

// 2. Handle sorting by trip_category term name
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->get( 'orderby' ) === 'trip_category' ) {
        global $wpdb;

        // Join term relationships and taxonomy tables
        $query->set( 'orderby', 'term_name' );

        add_filter( 'posts_clauses', function( $clauses ) use ( $wpdb ) {
            // Join terms for sorting
            $clauses['join'] .= "
                LEFT JOIN {$wpdb->term_relationships} AS tr ON ({$wpdb->posts}.ID = tr.object_id)
                LEFT JOIN {$wpdb->term_taxonomy} AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
                LEFT JOIN {$wpdb->terms} AS t ON (tt.term_id = t.term_id AND tt.taxonomy = 'trip_category')
            ";

            // Order by term name (handle posts with no term by putting them last)
            $clauses['orderby'] = "t.name ASC";

            return $clauses;
        } );
    }
} );
// Add "Tour" column to Trips CPT
add_filter( 'manage_trips_posts_columns', function( $columns ) {
    $columns['tour'] = __( 'Tour', 'textdomain' );
    return $columns;
} );

// Populate "Tour" column with the linked post title
add_action( 'manage_trips_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'tour' ) {
        $tour = get_field( 'tour', $post_id ); // could be ID or object
        if ( $tour ) {
            $tour_id = is_object( $tour ) ? $tour->ID : $tour;
            echo esc_html( get_the_title( $tour_id ) );
        } else {
            echo '<span style="color:#999;">—</span>';
        }
    }
}, 10, 2 );

// Make "Tour" column sortable
add_filter( 'manage_edit-trips_sortable_columns', function( $columns ) {
    $columns['tour'] = 'tour';
    return $columns;
} );

// Handle sorting by Tour post title
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->get( 'orderby' ) === 'tour' ) {
        global $wpdb;

        // Join postmeta for tour field
        $query->set( 'meta_key', 'tour' );
        $query->set( 'orderby', 'meta_value' );

        // This sorts by the stored post ID of the tour, which may not be alphabetical by title.
        // To sort by the linked post title, we need a more complex join.

        add_filter( 'posts_join', function( $join ) use ( $wpdb ) {
            // Join posts table again to get the linked tour post title
            $join .= " LEFT JOIN {$wpdb->posts} AS tour_post ON tour_post.ID = (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'tour' LIMIT 1) ";
            return $join;
        } );

        add_filter( 'posts_orderby', function( $orderby ) {
            return "tour_post.post_title ASC";
        } );
    }
} );
// Add custom column to Trips post type
add_filter('manage_trips_posts_columns', 'add_trips_start_date_column');
function add_trips_start_date_column($columns) {
    // Insert column after the title
    $new_columns = [];
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['start_date'] = __('Start Date', 'textdomain');
        }
    }
    return $new_columns;
}

// Display custom column content
add_action('manage_trips_posts_custom_column', 'show_trips_start_date_column', 10, 2);
function show_trips_start_date_column($column, $post_id) {
    if ($column === 'start_date') {
        $start_date = get_field('start_date', $post_id); // ACF field
        if ($start_date) {
            // Format the date if it's stored as Y-m-d or timestamp
            if (strtotime($start_date)) {
                echo $start_date;
            } else {
                echo $start_date;
            }
        } else {
            echo '<em>No date set</em>';
        }
    }
}

// Make column sortable
add_filter('manage_edit-trips_sortable_columns', 'make_trips_start_date_sortable');
function make_trips_start_date_sortable($columns) {
    $columns['start_date'] = 'start_date';
    return $columns;
}

// Handle sorting by start_date
add_action('pre_get_posts', 'sort_trips_by_start_date');
function sort_trips_by_start_date($query) {
    if (!is_admin()) return;
    if (!$query->is_main_query()) return;

    $orderby = $query->get('orderby');

    if ($orderby === 'start_date') {
        $query->set('meta_query', array(
            'relation' => 'OR',
            array(
                'key' => 'start_date',
                'compare' => 'EXISTS',
            ),
            array(
                'key' => 'start_date',
                'compare' => 'NOT EXISTS',
            )
        ));
        $query->set('meta_key', 'start_date');
        $query->set('orderby', 'meta_value');
        $query->set('meta_type', 'DATE');
    }
}
add_action('admin_head', 'custom_admin_css');
function custom_admin_css() {
    echo '<style>
        .fixed .column-slug {
            width: 150px!important;
        }
    </style>';
}