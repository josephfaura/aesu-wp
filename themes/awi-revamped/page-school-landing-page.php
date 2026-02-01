<?php
/**
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AWI_Revamped
 * 
 * Template Name: Landing Page
 */

get_header();
if(function_exists('get_field')){
	//banner
	$banner_image = get_field('banner_image');
	$banner_title = get_field('banner_title');
	$banner_tagline = get_field('banner_taqline');
	$banner_cta = get_field('banner_cta');
    $primary_color = get_field('primary_color');

    //school
    $school_shortcode = get_field('school_shortcode');
    $school_logo = get_field('school_logo');
    $school_logo_background = get_field('school_logo_background');
    $welcome_letter_image = get_field('welcome_letter_image');
    $welcome_letter_title = get_field('welcome_letter_title');
    $welcome_letter_text = get_field('welcome_letter_text');
    $welcome_letter_contact_header = get_field('welcome_letter_contact_header');
    $welcome_letter_contact_info = get_field('welcome_letter_contact_info');
    $welcome_letter_contact_name = get_field('welcome_letter_contact_name');
    $welcome_letter_contact_phone_number = get_field('welcome_letter_contact_phone_number');
    $welcome_letter_contact_email = get_field('welcome_letter_contact_email');
    $testimonial_header = get_field('testimonial_header');
    $testimonial_items = get_field('testimonial_items');
    $testimonial_thumbnail = get_field('testimonial_thumbnail');
    $testimonial_youtube_link = get_field('testimonial_youtube_link');
    $past_tour_items = get_field('past_tour_items');
    $payment_info = get_field('payment_info');
    $footer_cta_text = get_field('footer_cta_text');
    $welcome_letter_contact_address = get_field('welcome_letter_contact_address');
    $banner_video = get_field('banner_video');
    $contact_website = get_field('contact_website');
}
?>
<style>
    .school_custom_wrap a{
        color:<?php echo $primary_color; ?>;
    }
    .header_school_logo {
        display:flex;
        max-height:45px;
        max-width:256px;
        padding-right:18px;
        border-right:2px solid white;
    }
    .trip_list{
        margin:32px auto;
    }
    .trip_list ul{
        list-style:none;
        margin:0 0 32px;
        padding:0;
    }
    .trip_year_title{
        text-align:center;
        margin:0 0 24px;
    }
    .trip_post {
        display:flex;
        justify-content:center;
        flex-wrap:wrap;
        gap: 32px;
    }
    .trip_post > li{
        display:flex;
        flex-direction:column;
        width: calc(34% - 32px);
        /* width: calc(100% / 3 - 32px); // can't understand why this math produces a narrow grid and 34% - 32px fits perfect when the math doesn't add up ¯\_(ツ)_/¯ */
        text-align:center;
        border-radius: 6px;
        box-shadow:0 3px 10px rgba(0,0,0,.25)
    }
    .trip_post > li a{
        font-size:18px;
        font-weight:bold;
    }
    .trip_main_image{
        position:relative;
        width:100%;
        height:30vh;
        border-radius: 6px 6px 0 0;
        overflow:hidden;
    }
    .trip_title_lander{
        margin:0;
        text-align:center;
        font-size:24px;
        color:<?php echo $primary_color; ?>;
    }
    .trip_dates_lander{
        font-size: 14px;
        font-weight: 600;
        color: #777;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: inline-block;
    }
    .trip_text{
        padding:32px;
        flex:1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    /*.trip_post > li a:last-child{
        margin-top:auto;
    }*/

    .welcome_letter{
        display:flex;
        flex-wrap:wrap;
        margin:56px auto;
        /*gap:32px;
        padding-top:24px;*/
    }
    .welcome_letter > div{
        display:flex;
        flex-direction:column;
        width:50%;
        /*flex:1;*/
    }
    .welcome_letter_contact{
        display:flex;
        gap:32px;
        padding:16px 0;
    }
    .welcome_letter_contact > div{
        display:flex;
        flex-direction:column;
        width:100%;
        background-size:contain;
        background-position:center;
        background-repeat:no-repeat;
    }
    .welcome_letter_right{
        background: #f2f2f2;
        padding: 36px 56px 40px 56px;
    }
    .contact_info h2{
        margin-bottom:18px;
        color:<?php echo $primary_color; ?>;
        font-size:24px;
        margin-top:0;
    }
    .contact_info a{
        font-weight: 700;
    }
    .testimonial_quote_icon_left i{
        color:<?php echo $primary_color; ?>;
    }
    .testimonial_quote_icon_right i{
        color:<?php echo $primary_color; ?>;
    }
    .contact_info h3{
        font-size:20px;
        margin:0;
        color:#5E5E5E;
    }
    .contact_info p{
        margin:5px 0;
    }
    .contact_logo{
    background-color:<?php echo $school_logo_background; ?>;
    height: 100%;
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    }
    .contact_logo_wrap{
        background-color:<?php echo $school_logo_background; ?>;
        padding:24px;
        border-radius: 6px;
    }
    .welcome_letter_copy h2{
        font-size:32px;
        color:#5E5E5E;
    }
    .testimonials_wrap h2{
        text-align:center;
        width:100%;
    }
    .past_tour_gallery{
        margin:56px auto;
    }
    .past_tour_gallery h2{
        text-align:center;
    }
    .past_tour_gallery ul{
        list-style:none;
        margin:0;
        padding:0;
        display:flex;
        gap:32px;
        flex-wrap:wrap;
        justify-content: center;
    }
    .past_tour_gallery li{
     width: calc(100% / 3 - 22px);
     background-position: center;
    background-size: cover;
    border-radius:6px;
    }
    .past_tour_gallery ul li a{
        height:30vh;
        display:block;
    }
    .load_more_images{
        display:block;
        color:<?php echo $primary_color; ?>;
        font-weight:bold;
        text-align:center;
        margin:32px auto;
    }
    .payment_options{
        list-style:none;
        display:flex;
        margin:32px auto;
        padding:0;
        gap:32px;
    }
    .payment_options > li{
        display:flex;
        background-color:#F2F2F2;
        flex-direction:column;
        flex:1;
    }
    .payment_thumb{
        height:30vh;
    }
    /*.payment_options .container{
        max-width:1300px;
        padding:0 56px;
    }*/
    .payment_title {
        font-size:2rem;
        margin:.5em auto;
    }
    .payment_info_text{
        padding:32px 56px;
        text-align:center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        height:calc(100% - 30vh);
    }
    .footer_cta_landing_page{
        padding:56px 24px;
        max-width:900px;
        text-align:center;
    }
    .banner {
        height: calc(100vh - 48px);
        /*display: flex;
        justify-content: center;
        align-items: center;
        background-size: cover;
        background-position: center;
        position: relative;*/
        margin-bottom: 0;
    }
    .welcome_letter_left {
        max-width:50%;
    }
    .anchor_nav{
        padding:12px 24px;
        background: #3a3a3a;
        /*background: <?php echo $school_logo_background; ?>;*/
    }
    .anchor_nav ul{
        list-style:none;
        margin:0;
        padding:0;
        display:flex;
        justify-content:center;
        align-items:center;
        gap:5px 42px;
        flex-wrap:wrap;
    }
    .anchor_nav ul li a{
        text-decoration:none;
        color:#d7d7d7;
        text-transform: uppercase;
        font-size: 80%;
        letter-spacing: .05em;
        font-weight: 600;
        
    }
    .anchor_nav ul li a:hover{
        color:#f2f2f2;
    }
    .anchor_nav ul li{
        text-align:center;
    }
    
    @media screen and (max-width:1120px){
        .trip_post > li{
            width: calc(100% / 2 - 16px);
        }
        .past_tour_gallery li{
            width: calc(100% / 2 - 16px);
        }
        .welcome_letter_left {
            height:600px;
        }
        .welcome_letter > div{
            width:100%;
            flex:none;
            max-width:100%;
        }
        .welcome_letter_right{
            max-width:100%;
            padding:32px;
        }
        .welcome_letter_copy h2{
            margin-top:0;
        }

    }
    @media screen and (max-width:954px){
            .anchor_nav {
                padding:12px;
            }
            .payment_options{
            flex-direction:column;
        }
    }

    @media screen and (max-width:720px){
        .trip_post > li{
            width: calc(100% / 1 - 10px);
        }
        .past_tour_gallery li {
            width: calc(100% / 2 - 22px);
            background-position: center;
            background-size: cover;
        }
    }
     @media screen and (max-width:527px){
        .trip_post > li {
            width: calc(100% / 1 - 10px);
        }
        .past_tour_gallery li {
            width:100%;
            background-position: center;
            background-size: cover;
        }
    }
    @media screen and (max-width:550px){
        .trip_list .container,  .testimonials_wrap .container, .past_tour_gallery .container, .payment_options .container {
            padding: 0 24px;
        }
        .banner {
            height:100vh
        }
        .page-id-1464 .banner {
            background-position: calc(50% - 100px) center !important;
        }
        .anchor_nav {
            display: none;
        }
        .welcome_letter_contact{
            flex-direction:column;
        }
        .contact_logo{
            height:200px;
        }
        .welcome_letter_contact{
            text-align: center;
        }sdxz z  
    }
    #video_banner_schools {
        position: absolute;
        right: 0;
        bottom: 0;
        min-width: 100%; 
        min-height: 100%;
        z-index:1;
    }
</style>
<?php
if ( ! post_password_required() ) {
    // The password has been entered — show this content
?>
<div class="banner" style="background-image:url(<?php echo $banner_image['url'] ?>)">
    <?php if($banner_video){ ?>
    <video autoplay muted playsinline loop id="video_banner_schools">
  <source src="<?php echo $banner_video ?>" type="video/mp4">
  Your browser does not support HTML5 video.
</video>
<?php } ?>
    <div class="container">
        <?php if($banner_title){ ?><h1><?php echo $banner_title; ?></h1><?php } ?>
        <?php if($banner_tagline){ ?><h2><?php echo $banner_tagline; ?></h2><?php } ?>
        <?php if($banner_cta){ ?><a href="<?php echo $banner_cta['url'] ?>" class="cta-button" style="background-color:<?php echo $primary_color; ?>; border: 1px solid #5e5e5e";><?php echo $banner_cta['title'] ?></a><?php } ?>
        
    </div>
    <a href="#skip_banner" class="banner_arrow"><i class="fa-solid fa-angle-down"></i></a>
</div>
<div id="skip_banner"></div>
<section class="anchor_nav">
    <ul class="list-unstyled">
        <?php $terms = get_terms( array(
    'taxonomy'   => 'trip_year',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    foreach ( $terms as $term ) {
        
        $trips_query = new WP_Query( array(
            'post_type'      => 'trips',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'trip_year',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ),
            ),
            'meta_query'	  => array(
                array(
                    'key' => 'school',
                    'value' => get_the_ID(),
                    'compare' => 'IN'
                )
            )
        ) );
        
        if ( $trips_query->have_posts() ) {
        echo '<li>';
        echo '<a href="#' . $term->slug . '_trips">' . esc_html( $term->name ) . '</a></li>';?>
<?php }}} ?>
<?php if($welcome_letter_title && $welcome_letter_title !=''){ ?>
        <li><a href="#welcome_letter">Welcome</a></li>
        <?php } ?>
        <li><a href="#testimonials">Testimonials</a></li>
        <?php if($past_tour_items){ ?><li><a href="#image_gallery">Gallery</a></li><?php } ?>
        
            <?php foreach($payment_info as $payment_info_item){ ?>
                
        <li><a href="#<?php echo strtolower(preg_replace("/[^a-zA-Z]/", "", $payment_info_item['payment_info_title'])) ?>"><?php echo $payment_info_item['payment_info_title'] ?></a></li>
            <?php } ?>
    </ul>
</section>


<div class="school_custom_wrap">
<section class="trip_list" id="trip_list">
    <div class="container">
<?php
$terms = get_terms( array(
    'taxonomy'   => 'trip_year',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

    // Only show the "Trips" title if there is at least 1 matching trip post (across any term)
    $has_any_trips = false;
    foreach ( $terms as $term ) {
        $check_trips = get_posts( array(
            'post_type'      => 'trips',
            'fields'         => 'ids',
            'posts_per_page' => 1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'trip_year',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ),
            ),
            'meta_query'     => array(
                array(
                    'key'     => 'school',
                    'value'   => get_the_ID(),
                    'compare' => 'IN'
                )
            )
        ) );

        if ( ! empty( $check_trips ) ) {
            $has_any_trips = true;
            break;
        }
    }

    if ( $has_any_trips ) {
        echo ' <h4 class="blog-type-label">Trips</h4>';
        echo '<ul>';
        foreach ( $terms as $term ) {
            
// First, get all post IDs for this term/school
$all_trips = get_posts( array(
    'post_type'      => 'trips',
    'fields'         => 'ids',
    'posts_per_page' => -1,
    'tax_query'      => array(
        array(
            'taxonomy' => 'trip_year',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
        ),
    ),
    'meta_query'     => array(
        array(
            'key'     => 'school',
            'value'   => get_the_ID(),
            'compare' => 'IN'
        )
    )
) );

// Check if every post has a start_date value
$all_have_start_date = true;
foreach ( $all_trips as $trip_id ) {
    if ( ! get_field( 'start_date', $trip_id ) ) {
        $all_have_start_date = false;
        break;
    }
}

// Build the query based on the check
$args = array(
    'post_type'      => 'trips',
    'posts_per_page' => -1,
    'tax_query'      => array(
        array(
            'taxonomy' => 'trip_year',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
        ),
    ),
    'meta_query'     => array(
        array(
            'key'     => 'school',
            'value'   => get_the_ID(),
            'compare' => 'IN'
        )
    )
);

if ( $all_have_start_date ) {
    $args['meta_key']  = 'start_date';
    $args['orderby']   = 'meta_value';
    $args['meta_type'] = 'DATE';
    $args['order']     = 'ASC';
} else {
    // fallback ordering if not all have start_date
    $args['meta_key'] = 'trip_name';
    $args['orderby']  = 'meta_value';
    $args['order']    = 'ASC';
}

$trips_query = new WP_Query( $args );
            
            if ( $trips_query->have_posts() ) {
            echo '<li>';
            echo '<h2 id="' . $term->slug . '_trips" class="trip_year_title">' . esc_html( $term->name ) . '</h2>';

            // Query trips assigned to this term

                echo '<ul class="trip_post">';
                while ( $trips_query->have_posts() ) {
                $trips_query->the_post();

                $trip_id = get_the_ID();

                // Trip-side fields
                $hero_image               = get_field('trip_hero_image', $trip_id);
                $trip_hero_image_text_url = get_field('trip_hero_image_text_url', $trip_id);
                $trip_dates               = get_field('trip_dates', $trip_id);
                $trip_name                = get_field('trip_name', $trip_id);
                $toc_info                 = get_field('toc_info', $trip_id);
                $days_price               = get_field('days__price', $trip_id);
                $start_date               = get_field('start_date', $trip_id);

                // Get the selected Tour from this Trip (adjust field name if yours differs)
                $tour = get_field('tour', $trip_id); // <-- if your relationship field is named differently, change this
                $tour_id = $tour ? (is_object($tour) ? $tour->ID : (int)$tour) : 0;

                // -----------------------------
                // 1) trip_name override (trip wins, else tour)
                // -----------------------------
                if ( ( $trip_name === null || $trip_name === false || $trip_name === '' ) && $tour_id ) {
                    $trip_name = get_field('trip_name', $tour_id);
                }

                // -----------------------------
                // 2) hero image override (trip wins, else tour featured image)
                // -----------------------------
                $tour_featured_url = $tour_id ? get_the_post_thumbnail_url($tour_id, 'full') : '';

                if ( empty($hero_image) || empty($hero_image['url']) ) {
                    // if trip_hero_image_text_url is empty too, fallback to tour featured
                    if ( ( $trip_hero_image_text_url === null || $trip_hero_image_text_url === false || $trip_hero_image_text_url === '' ) && $tour_featured_url ) {
                        $hero_image = ['url' => $tour_featured_url];          // keeps your existing markup happy
                        $trip_hero_image_text_url = $tour_featured_url;       // optional, but makes your else path work too
                    }
                }

                // -----------------------------
                // 3) toc_info override: if empty, build fallback from tour destinations + description
                // -----------------------------
                if ( ( $toc_info === null || $toc_info === false || $toc_info === '' ) && $tour_id ) {

                    // Tour fallback content
                    $destinations = get_field('destinations', $tour_id);
                    $description  = get_field('description', $tour_id);

                    // Trip-only field (still from trip)
                    $days_price = get_field('days__price', $trip_id);

                    $fallback = '';

                    if ( !empty($destinations) ) {
                        if ( is_array($destinations) ) {
                            $destinations_text = implode(', ', array_filter(array_map('wp_strip_all_tags', $destinations)));
                        } else {
                            $destinations_text = wp_strip_all_tags($destinations);
                        }

                        if ( $destinations_text ) {
                            $fallback .= '<p class="destinations">' . esc_html($destinations_text) . '<p>';
                        }
                    }

                    if ( $description ) {
                        $fallback .= '<div class="trip_description">' . wp_kses_post($description) . '</div>';
                    }

                    // Inject days/price into the same override block
                    if ( $days_price ) {
                        $fallback .= '<p class="days_price">' . wp_kses_post($days_price) . '</p>';
                    }

                    $toc_info = $fallback;
                }

                ?>
                <li>
                    <a class="card_image_link" href="<?php echo esc_url( get_permalink() ); ?>">
                        <div class="trip_main_image" style="background-image:url('<?php
                            if ( !empty($hero_image['url']) ) {
                                echo esc_url($hero_image['url']);
                            } else {
                                echo esc_url($trip_hero_image_text_url);
                            }
                        ?>')"></div>
                    </a>

                    <div class="trip_text">
                        <div class="trip_dates_lander"><?php echo wp_kses_post($trip_dates); ?></div>

                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                            <h3 class="trip_title_lander"><?php echo esc_html( $trip_name ); ?></h3>
                        </a>

                        <div><?php echo do_shortcode($toc_info); ?></div>

                        <a href="<?php echo esc_url( get_permalink() ); ?>">Explore this trip <i class="fa fa-arrow-right"></i></a>
                    </div>
                </li>
                <?php
                }
                echo '</ul>';
                wp_reset_postdata();
            }

            echo '</li>';
        }
        echo '</ul>';
    }
}
?>
</div>
</section>
<?php if($welcome_letter_title && $welcome_letter_title !=''){ ?>
<section class="welcome_letter" id="welcome_letter">
    <div class="welcome_letter_left" style="background-image:url(<?php echo $welcome_letter_image['url'] ?>);">
    </div>
    <div class="welcome_letter_right">
        <div class="welcome_letter_copy">
         <h2><?php echo $welcome_letter_title; ?></h2>
         <?php echo do_shortcode($welcome_letter_text); ?> 
        </div>
        <div class="welcome_letter_contact">
            <div class="contact_logo_wrap"><div class="contact_logo" style="background-image:url('<?php echo $school_logo['url'] ?>')"></div></div>
            <div class="contact_info">
                <?php if($welcome_letter_contact_header){ ?>
                    <h2><?php echo $welcome_letter_contact_header; ?></h2>
                <?php } ?>
                <?php if($welcome_letter_contact_name){ ?>
                    <h3><?php echo $welcome_letter_contact_name; ?></h3>
                <?php } ?>
                <?php if($welcome_letter_contact_info){ ?>
                    <?php echo $welcome_letter_contact_info; ?>
                <?php } ?><?php if($welcome_letter_contact_address){ ?>
                    <?php echo $welcome_letter_contact_address; ?>
                <?php } ?>
                <?php if($welcome_letter_contact_phone_number){ ?>
                    <p>
                    <a href="tel:<?php echo $welcome_letter_contact_phone_number ?>"><?php echo $welcome_letter_contact_phone_number; ?></a></p>
                <?php } ?><?php if($welcome_letter_contact_email){ ?>
                    <p>
                    <a href="mailto:<?php echo $welcome_letter_contact_email ?>"><?php echo $welcome_letter_contact_email; ?></a></p>
                <?php } ?>
                <?php if($contact_website){ ?>
                    <p><a href="https://<?php echo $contact_website; ?>" target="_blank">Visit Website</a></p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<section class="testimonials_wrap" id="testimonials">
    <div class="container">
        <?php if($testimonial_header){ ?><h2><?php echo $testimonial_header ?></h2><?php } ?>
        <div class="testimonials_text_wrap">
            <ul class="testimonials_list">
                <?php foreach($testimonial_items as $testimonial){ ?>
                    <li class="testimonials_list_item">
                        <div class="testimonial_image" style="background-image:url('<?php echo $testimonial['testimonial_image']['url'] ?>')"></div>
                        <div class="testimonial_text">
                            <div class="testimonial_quote_icon_left"><i class="fa fa-quote-left"></i></div>
                            <p><?php echo $testimonial['testimonial_content'] ?></p>
                            <p class="testimonial_author"><?php echo $testimonial['testimonial_author'] ?></p>
                            <div class="testimonial_quote_icon_right"><i class="fa fa-quote-right"></i></div>
                            
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="testimonials_video_wrap">
            <div
                class="testimonials_video_item"
                style="background-image:url('<?php echo esc_url( $testimonial_thumbnail['url'] ); ?>');"
            >
                <a
                    data-fancybox
                    data-type="html5video"
                    data-width="1080"
                    data-height="1920"
                    href="<?php echo esc_url( $testimonial_youtube_link ); ?>"
                    class="play_video_testimonials"
                >
                    <i class="fa fa-circle-play"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="testimonials_cta"><a href="<?php echo get_permalink(2349) ?>">What our past travelers are saying <i class="fa fa-arrow-right"></i></a></div>
</section>
<?php if($past_tour_items){ ?>
<section class="past_tour_gallery" id="image_gallery">
    <h2>Photo Gallery</h2>
    <div class="container">
        <ul>
            <?php
            $loop_index = 0;
            foreach($past_tour_items as $past_tour_item){ ?>
                <li style="background-image:url('<?php echo $past_tour_item['url'] ?>');<?php if($loop_index > 5){echo "display:none;";} ?>"><a data-fancybox="gallery1" href="<?php echo $past_tour_item['url'] ?>"></a></li>
            <?php $loop_index++;} ?>
        </ul>
        <a href="#" class="load_more_images">Load more images to view <i class="fa fa-arrow-right"></i></a>
    </div>
</section>
<?php } ?>
<section class="payment_options">
    <div class="container">
        <ul class="payment_options">
            <?php foreach($payment_info as $payment_info_item){ ?>
            <li id="<?php echo strtolower(preg_replace("/[^a-zA-Z]/", "", $payment_info_item['payment_info_title'])) ?>">
                <div class="payment_thumb" style="background-image:url('<?php echo $payment_info_item['payment_info_image']['url'] ?>')"></div>
                <div class="payment_info_text">
                    <h2 class="payment_title"><?php echo $payment_info_item['payment_info_title'] ?></h2>
                    <?php echo do_shortcode($payment_info_item['payment_info_content']) ?>
                    <a style="color:#fff !important; font-size: 18px; background-color:<?php echo $primary_color; ?>" href="<?php echo $payment_info_item['learn_more_cta_url'] ?>" class="cta-button">Learn more <i class="fa fa-arrow-right"></i></a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>
<?php if($footer_cta_text){ ?>
<div class="container">
         <?php echo do_shortcode($footer_cta_text); ?> 
</div>
</div>
<?php } ?>
<?php } ?>
<?php
if ( post_password_required() ) {
    ?>
    <style>
        .entry {
            margin-top: 100px;
        }
    </style>
    <?php
}
?>
<main>
    <div class="container">
        <article class="full-width">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                        <?php the_content(); ?>
                    </div>
                </div>
                
            <?php endwhile; endif; ?>

        </article>
    </div>
</main>

<div class="container">
    <div id="back_to_top" class="back-to-top-inline">
        <i class="fa-solid fa-angle-up"></i>
    </div>
</div>

<?php get_footer(); ?>