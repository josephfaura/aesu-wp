<?php
/**
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AWI_Revamped
 * 
 * Template Name: School Landing Page
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
    .header_school_logo {
        display:flex;
        max-height:45px;
        max-width:256px;
        padding-right:18px;
        border-right:2px solid white;
    }
    .trip_list{
        /*padding:0 56px;*/
        padding-bottom:32px;
    }
    .trip_list ul{
        list-style:none;
        margin:0;
        padding:0;
    }
    .trip_year_title{
        text-align:center;
        margin:32px 0 0 0;
    }
    .trip_post {
        display:flex;
        justify-content:center;
        flex-wrap:wrap;
    }
    .trip_post > li{
        display:flex;
        flex-direction:column;
            margin: 20px;
    width: calc(100% / 3 - 40px);
        text-align:center;
        box-shadow:0 3px 5px rgba(0,0,0,.25)
    }
    .trip_post > li a{
        font-size:18px;
        font-weight:bold;
    }
    .trip_main_image{
        height:300px;
        position:relative;
        width:100%;
    }
    .trip_title_lander{
        margin-bottom:5px;
        text-align:center;
        font-size:24px;
        color:<?php echo $primary_color; ?>;
        margin-top:0;
    }
    .school_custom_wrap a{
        color:<?php echo $primary_color; ?>;
        
    }
    .trip_text{
        padding:36px;
    }
    .trip_dates_lander{
        position:absolute;
        padding:3px 10px;
        right:0;
        top:20px;
        background-color:#FFFFFF;
        color:#3A3A3A;
        font-weight:bold;
    }
    .welcome_letter{
        display:flex;
        flex-wrap:wrap;
        gap:32px;
        padding-top:24px;
    }
    .welcome_letter > div{
        display:flex;
        flex-direction:column;
        width:50%;
        flex:1;
    }
    .welcome_letter_contact{
        display:flex;
        gap:32px;
        padding:32px 0;
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
        max-width:1000px;
        margin-right:32px;
    }
    .contact_info h2{
        margin-bottom:18px;
        color:<?php echo $primary_color; ?>;
        font-size:24px;
        margin-top:0;
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
    }
    .welcome_letter_copy h2{
        font-size:24px;
        color:#5E5E5E;
    }
    .testimonials_wrap{
        padding-top:36px;
    }
    .testimonials_wrap h2{
        font-size:32px;
        text-align:center;
        color:#3A3A3A;
        width:100%;
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
    }
    .past_tour_gallery li{
     width: calc(100% / 3 - 22px);
     background-position: center;
    background-size: cover;
    }
    .past_tour_gallery ul li a{
        height:250px;
        display:block;
    }
    .load_more_images{
        display:block;
        color:<?php echo $primary_color; ?>;
        font-weight:bold;
        text-align:center;
        padding:36px 0;
    }
    .payment_options{
        list-style:none;
        display:flex;
        margin:0 0 32px 0;
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
        height:250px;
    }
    .payment_options .container{
        max-width:1300px;
        padding:0 56px;
    }
    .payment_title {
        font-size:24px;
        color:#3A3A3A;
        margin-top:0;
        margin-bottom:10px
    }
    .payment_info_text{
        padding:32px 56px;
        text-align:center;
    }
    .footer_cta_landing_page{
        padding:56px 24px;
        max-width:900px;
        text-align:center;
    }
    .banner {
        height: calc(100vh - 50px);
        display: flex;
        justify-content: center;
        align-items: center;
        background-size: cover;
        background-position: center;
        position: relative;
        margin-bottom: 56px;
    }
    .welcome_letter_left {
        max-width:50%;
    }
    .anchor_nav{
        padding:0 24px;
    }
    .anchor_nav ul{
        list-style:none;
        margin:0;
        padding:0;
        display:flex;
        justify-content:center;
        align-items:center;
        gap:5px 25px;
        flex-wrap:wrap;
    }
    .anchor_nav ul li a{
        font-weight:bold;
        text-decoration:none;
        color:<?php echo $primary_color; ?>;
        font-size:18px;
    }
    .anchor_nav ul li{
        text-align:center;
    }
    .banner{
        margin-bottom:12px;
    }
    .trip_text{
        flex:1;
        display: flex;
        flex-direction: column;
    }
    .trip_post > li a{
        margin-top:auto;
    }
    @media screen and (max-width:1120px){
        .trip_post > li{
            width: calc(100% / 2 - 40px);
        }
    }
    @media screen and (max-width:800px){

        .welcome_letter_left {
            height:600px;
        }
        .welcome_letter{
            padding-top:0;
        }
        .welcome_letter > div{
            width:100%;
            flex:none;
            max-width:100%;
        }
        .welcome_letter_right{
            max-width:100%;
            padding:32px;
            padding-top:0;
        }
        .welcome_letter_copy h2{
            margin-top:0;
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
.testimonials_list_item{
    flex-direction:column;
}
.testimonial_text{
    width:100%;
}
.testimonial_image{
    width:100%;
    height:200px;
}
.payment_options{
    flex-direction:column;
}
    }
     @media screen and (max-width:527px){
        .trip_post > li{
            width: calc(100% / 1 - 10px);
        }
        .past_tour_gallery li {
            width:100%;
            background-position: center;
            background-size: cover;
}
        .trip_list {
            /*padding: 0 26px;*/
            padding-bottom: 32px;
        }
    }
    @media screen and (max-width:550px){
        .container {
            padding: 0 24px;
        }
        .banner {
            height:100vh
        }
        .welcome_letter_contact{
            flex-direction:column;
        }
        .contact_logo{
            height:200px;
        }
        .welcome_letter_contact{
            gap:14px;
            text-align: center;
        }
        .payment_options .container {
            padding:0 24px;
        }
    }
    #video_banner_schools {
        position: absolute;
        right: 0;
        bottom: 0;
        min-width: 100%; 
        min-height: 100%;
        z-index:1;
    }
    .banner{
        position:relative;
    }
</style>
<?php
if ( ! post_password_required() ) {
    // The password has been entered — show this content
?>
<div class="banner" style="background-image:url('<?php echo $banner_image['url'] ?>)">
    <?php if($banner_video){ ?>
    <video autoplay muted playsinline loop id="video_banner_schools">
  <source src="<?php echo $banner_video ?>" type="video/mp4">
  Your browser does not support HTML5 video.
</video>
<?php } ?>
    <div class="container">
        <?php if($banner_title){ ?><h1><?php echo $banner_title; ?></h1><?php } ?>
        <?php if($banner_tagline){ ?><h2><?php echo $banner_tagline; ?></h2><?php } ?>
        <?php if($banner_cta['url']){ ?><a href="<?php echo $banner_cta['url'] ?>" class="cta-button"><?php echo $banner_cta['title'] ?></a><?php } ?>
        
    </div>
    <a href="#skip_banner" class="banner_arrow"><i class="fa-solid fa-angle-down"></i></a>
</div>
<div id="skip_banner"></div>
<section class="anchor_nav">
    <ul class="clearfix list-unstyled">
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
<section class="trip_list">
    <div class="container">
<?php
$terms = get_terms( array(
    'taxonomy'   => 'trip_year',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
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
                if(function_exists('get_field')){
                    $hero_image = get_field('trip_hero_image',get_the_ID());
	                $trip_hero_image_text_url = get_field('trip_hero_image_text_url');
                    $toc_info = get_field('toc_info',get_the_ID());
                    $trip_name = get_field('trip_name',get_the_ID());
                    $trip_dates = get_field('trip_dates',get_the_ID());
                    $start_date = get_field('start_date',get_the_ID());
                }
                ?>
                <li>
                    
                        <div class="trip_main_image" style="background-image:url('<?php if($hero_image['url'] && $hero_image['url'] != ''){echo $hero_image['url'];}else{echo $trip_hero_image_text_url;} ?>')"><div class="trip_dates_lander"><?php echo $trip_dates; ?></div></div>
                        <div class="trip_text">
                        <?php //echo $start_date; ?>
                        <h3 class="trip_title_lander"><?php echo esc_html( $trip_name ); ?></h3>
                        <div><?php echo do_shortcode($toc_info); ?></div>
                <a href="<?php echo esc_url( get_permalink() ); ?>">Trip Details <i class="fa fa-arrow-right"></i></a>
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
?>
</div>
</section>
<?php if($welcome_letter_title && $welcome_letter_title !=''){ ?>
<section class="welcome_letter" id="welcome_letter">
    <div class="welcome_letter_left" style="background-image:url('<?php echo $welcome_letter_image['url'] ?>);">
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
            <div class="testimonials_video_item" style="background-image:url('<?php echo $testimonial_thumbnail['url']; ?>');"><a data-fancybox href="<?php echo $testimonial_youtube_link ?>" style="color:#fff" class="play_video_testimonials"><i class="fa fa-play"></i></a></div>
        </div>
    </div>
    <div class="testimonials_cta"><a href="<?php echo get_permalink(2349) ?>">Read what our past travelers are saying <i class="fa fa-arrow-right"></i></a></div>
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
        <a href="#" class="load_more_images">Load More Images <i class="fa fa-arrow-right"></i></a>
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
                    <a style="font-weight:bold;" href="<?php echo $payment_info_item['learn_more_cta_url'] ?>" class="button_cta">Learn More <i class="fa fa-arrow-right"></i></a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>
<!--<div class="container footer_cta_landing_page">
    <div>Email AESU Alumni World Travel at <a href="mailto:alumni@aesu.com">alumni@aesu.com</a> or call <a href="tel:800-638-7640">800-638-7640</a> and ask one of our reservations agent for more information on any of these programs</div>
</div>!-->
</div>
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

<?php get_footer(); ?>