<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

?>

<?php get_header(); 
if(function_exists('get_field')){
	$citiescountries = get_field('citiescountries',get_the_ID());
	$days_price = get_field('days__price',get_the_ID());
	$cta_button = get_field('cta_button',get_the_ID());
	$hero_image = get_field('trip_hero_image',get_the_ID());
	$trip_hero_image_text_url = get_field('trip_hero_image_text_url',get_the_ID());
	$school_shortcode = get_field('school_shortcode',get_the_ID());
	$trip_dates = get_field('trip_dates',get_the_ID());
	$e_brochure_link = get_field('e_brochure_link',get_the_ID());
	$webinar_link = get_field('webinar_link',get_the_ID());
	//$school = get_field('school',get_the_ID());
	$travel_tools = get_field('travel_tools',get_the_ID());
	$toc_info = get_field('toc_info',get_the_ID());
	$main_trip_content = get_field('main_trip_content',get_the_ID());
	//$tour = get_field('tour',get_the_ID());
	$trip_name = get_field('trip_name',get_the_ID());
	$deals_popup = get_field('deals_popup',get_the_ID());
	//school fields
	/*if($school){
		$school_logo = get_field('school_logo',$school->ID);
		$school_logo_background = get_field('school_logo_background',$school->ID);
		
	}
	if($tour){
		$tour_trip_highlights_title = get_field('trip_highlights_title',$tour->ID);
		$trip_highlights = get_field('trip_highlights',$tour->ID);
		$travel_tools = get_field('travel_tools',$tour->ID);
		
		$whats_included_title = get_field('whats_included_title',$tour->ID);
		$whats_included_accordion = get_field('highlight_accordion',$tour->ID);
		$additional_whats_included_text = get_field('additional_whats_included_text',$tour->ID);
		$whats_included_image = get_field('whats_included_image',$tour->ID);
		
		$itinerary_title = get_field('itinerary_title',$tour->ID);
		$itinerary_items = get_field('itinerary_items',$tour->ID);
		
		$hotels_title = get_field('hotels_title',$tour->ID);
		$hotels_content = get_field('hotels_content',$tour->ID);
		$hotels_items = get_field('hotels_items',$tour->ID);
		
		$trip_options_title = get_field('trip_options_title',$tour->ID);
		$trip_options_content = get_field('trip_options_content',$tour->ID);
		$trip_option_items = get_field('trip_option_items',$tour->ID);
		
		if(!$deals_popup || $deals_popup == ''){$deals_popup = get_field('deals_popup',$tour->ID);}
		
	}*/
	$trip_id = acf_preview_id_safe( get_the_ID() );

$school = get_field('school', $trip_id);
$tour   = get_field('tour', $trip_id);

// SCHOOL FIELDS
if ( $school ) {
    $school_id = is_object($school) ? $school->ID : (int)$school;
    $school_logo = get_field('school_logo', $school_id);
    $school_logo_background = get_field('school_logo_background', $school_id);
}

// TOUR FIELDS
if ( $tour ) {
    $tour_id = is_object($tour) ? $tour->ID : (int)$tour;
    $tour_trip_highlights_title = get_field('trip_highlights_title', $tour_id);
    $trip_highlights = get_field('trip_highlights', $tour_id);
    $travel_tools = get_field('travel_tools', $tour_id);
    $whats_included_title = get_field('whats_included_title', $tour_id);
    $whats_included_accordion = get_field('highlight_accordion', $tour_id);
    $additional_whats_included_text = get_field('additional_whats_included_text', $tour_id);
    $whats_included_image = get_field('whats_included_image', $tour_id);
    $itinerary_title = get_field('itinerary_title', $tour_id);
    $itinerary_items = get_field('itinerary_items', $tour_id);
    $hotels_title = get_field('hotels_title', $tour_id);
    $hotels_content = get_field('hotels_content', $tour_id);
    $hotels_items = get_field('hotels_items', $tour_id);
    $trip_options_title = get_field('trip_options_title', $tour_id);
    $trip_options_content = get_field('trip_options_content', $tour_id);
    $trip_option_items = get_field('trip_option_items', $tour_id);
    $experiences = get_field('experiences' , $tour_id);
    if ( ! $deals_popup || $deals_popup === '' ) {
        $deals_popup = get_field('deals_popup', $tour_id);
    }
}
	
}
?>
<style>
	.experiences {
		margin: 1em 0;
	}
	.whats_included_accordion_section h3{
		max-width: calc(100% - 109px);
	}
	.trip_header_info{
		width:100%;
	}
	.trip_header_cta{
		min-width:260px;
		text-align:right;
	}
	#page section.trip_main_content_wrap{
		padding:0;
	}
	.trip_header_logo{
		background-color:<?php echo $school_logo_background; ?>;
	}
	.tour_deals_popup_content a, .tour_deals_popup_content strong{
		margin:0!important;
		display:inline!important;
	}
	header{
		position:static;
	}
	.single-trips .trip_header{
		margin-top:0;
		position:sticky;
		top:0;
		background-color:#fff;
		box-shadow:0px 3px 10px rgba(0,0,0,.25);
		z-index:99999;
	}
	.mobile_cta{
		display:none;
	}
	.red_button_cta{
		display:inline-block;
		white-space: nowrap;
	}

@media screen and (max-width:976px){
		.mobile_cta {
        display: flex;
        justify-content: space-between;
        padding: 24px 24px 32px 24px !important;
        align-content: center;
        position: fixed;
				align-items:center;
        bottom: 0;
        width: 100%;
        z-index: 9999999;
        background-color: #fff;
				box-shadow:0px -3px 10px rgba(0,0,0,.25)
    }
	.single-trips .trip_header{
		position:static!important;
	}
		.mobile_cta .red_button_cta{
			  font-size: 18px;
        /*padding: 14px 25px;*/
		}
		.trip_days_price {
        	margin-bottom: 0;
        	font-size: 16px;
    	}
	.single-trips .trip_header{
		padding:18px;
	}
	.trip_header{
		display:block!important;
	}
	.trip_header_info {
		flex-wrap: nowrap;
		gap:18px;

	}
	/*.trip_header_info{
		display:block!important;
	}
	.trip_header_info > div{
		display:inline-block;
		vertical-align:middle;
	}
	.trip_header_info_text{
		padding-left:16px;
	}
	*/
}

	/*.whats_included_image{
		padding:20px;
	}
	.itinerary_image_item{
		float:right;
		max-height:400px;
	}*/
	.accordion_item{
		clear:both;
	}
	.slick-next{
		right:-14px;
	}
	/*@media screen and (max-width:820px){
		.itinerary_image_item{
			float:none;
		}
	}*/
	.share_section{
		font-size:20px;
		padding:15px 0 15px 15px;
		position:relative;
		float:right;
	}
	.share_options{
	display:none;    
    position: absolute;
 	right: -5px;
    bottom: 75%;
    	/*width: 200px;
    	background-color: #fff;
    	box-shadow:0 3px 10px rgba(0,0,0,.25);
    	padding: 10px 10px 2px 10px;*/
	}
		@media screen and (max-width:1092px){
				.share_options{
					right:30px;
					bottom:-5px;
				}
		}
		@media screen and (max-width:650px){
				.share_options{
					bottom:-15px;
				}
		}

	.share_section:hover .share_options{
		display:block;
	}
	.whats_included_accordion_section{
		margin-bottom:32px
	}
	.itinerary_image{
		max-width:300px;
		width:100%;
		height:300px;
		float:right;
		margin: 20px 0 16px 20px
	}

	.trip_header_info_text{
		/*max-width: calc(100% - 256px);*/
	}
	/*@media screen and (max-width:530px){
		.share_options{
			right:auto;
			left:0;
		}
	}*/
	
	@media screen and (max-width:686px){
		.accordion_content {
			padding: 20px 30px;
		}
		.itinerary_image {
		    max-width: 100%;
		    height: 300px;
		    float: none;
		    width: 100%;
		    margin: 0;
		}
	}
	@media screen and (max-width:420px){
		.mobile_cta .red_button_cta {
			font-size: 14px;
		}
		    .trip_days_price {
        margin-bottom: 0;
        font-size: 14px;
    }
	}
	@media screen and (max-width: 976px){
		#chat-widget-push-to-talk {
			bottom:130px !important;
		}
		/*.trip_header_info_text {
			max-width: calc(100%);
		}*/
	}
	@media screen and (max-width: 343px) {
    .mobile_cta {
        display: flex;
        justify-content: space-between;
        padding:15px 5px !important;
        align-content: center;
        position: fixed;
        align-items: center;
        bottom: 0;
        width: 100%;
        z-index: 9999999;
        background-color: #fff;
        box-shadow: 0px -3px 5px rgba(0, 0, 0, .25);
    }
}
/*.trip_main_image{
	box-shadow: 0px 3px 5px rgba(0, 0, 0, .25); 
}*/
</style>
<?php
if ( ! post_password_required() ) {
    // The password has been entered — show this content
?>
<section class="mobile_cta">
	<div class="trip_days_price"><?php echo $days_price; ?></div>
	<a href="<?php echo $cta_button['url'] ?>" class="red_button_cta" target="_blank"><?php echo $cta_button['title'] ?></a>
</section>

<?php if(is_user_logged_in()){ ?>
		<style>
			.single-trips .trip_header{
				top:32px;
			}
		</style>
	<?php } ?>

<section class="trip_header">
	<div class="trip_header_info">
		<?php if($school_logo['url']){ ?>
		<div style="background-color:<?php echo $school_logo_background; ?>;padding:18px;">
		<div class="trip_header_logo" style="background-position:center;background-repeat:no-repeat;background-image:url('<?php echo $school_logo['url'] ?>')"></div>
		</div>
		<?php } ?>
		<div class="trip_header_info_text">
			<?php if($school->ID != 824){ ?><h2 class="trip_school_name"><?php echo $school->post_title ?></h2><?php } ?>
			<h1 class="trip_name"><?php echo $trip_name ?></h1>
			<h4 class="trip_destination_info"><?php echo $citiescountries; ?></h4>
		</div>
	</div>
	<div class="trip_header_cta">
		<div class="trip_days_price"><?php echo $days_price; ?></div>
		<a href="<?php echo $cta_button['url'] ?>" class="red_button_cta" target="_blank"><?php echo $cta_button['title'] ?></a>
	</div>
</section>
<section class="trip_main_content_wrap">
	<div class="trip_main_image" style="background-image:url('<?php if($hero_image['url'] && $hero_image['url'] != ''){echo $hero_image['url'];}else{echo $trip_hero_image_text_url;} ?>')"></div>
	<div class="trip_main_content">
		<div class="trip_dates"><?php echo $trip_dates; ?></div>
		<div class="trip_main_content_text">
			
			<?php
			//change to custom field 
			//
			echo do_shortcode($main_trip_content); 
			?>
		</div>

		<?php if($experiences){ ?>
		<div class="experiences">
			<strong>Trip Experiences: <?php if( $experiences && is_array($experiences)){foreach ($experiences as $experiences) {echo '<i class="' . esc_attr($experiences) . '"></i>&nbsp;';}} ?></strong> | <strong><a href="http://aesu.local/experiences/" target="_blank" rel="noopener">Learn More</a></strong>
		</div>
		<?php }?>

		<?php if($e_brochure_link || $webinar_link){ ?>
		<div class="additional_links">
			<ul class="additional_link_items">
				<?php if($e_brochure_link){ ?><li><a target="_blank" href="<?php echo $e_brochure_link; ?>" class="print_brochure">Download a Print Brochure</a></li><?php } ?>
				<?php if($webinar_link){ ?><li><a target="_blank" href="<?php echo $webinar_link ?>" class="webinar_link">Sign up for a Webinar</a></li><?php } ?>
			</ul>
		</div>
		<?php } ?>
		<ul class="clearfix list--unstyled trip_cta_list">
			<li class="deals_cta"><a href="#">Deals</a></li>
			<li class="more_trips"><a href="<?php echo get_permalink($school->ID) ?>">More Trips</a></li>
			<li class="travel_tools"><a href="#">Travel Tools</a></li>
			<li class="share_section"><span><i class="fa-solid fa-arrow-up-from-bracket"></i></span>
			<div class="share_options">
				<?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]') ?>
			</div></li>
		</ul>
		<!--<ul class="clearfix list--unstyled trip_anchornav_list">
			<li class=""><a href="#"></a></li>
		</ul>-->
	</div>
</section>
<section class="tour_area">
	<div class="trip_highlights">
		<h2><?php echo $tour_trip_highlights_title ?></h2>
		<ul class="trip_highlight_items">
			<?php foreach($trip_highlights as $trip_highlight){
				$highlight_image = $trip_highlight['highlight_image'];
				$highlight_title = $trip_highlight['highlight_title'];
				$highlight_location = $trip_highlight['highlight_location'];
				$highlight_stars = $trip_highlight['highlight_stars'];
				$highlight_description = $trip_highlight['highlight_description'];
				?>
				<li>
					<div class="trip_highlights_image" style="background-image:url('<?php echo $highlight_image['url'] ?>');"></div>
					<div class="trip_highlights_content">
						<h3><?php echo $highlight_title; ?></h3>
						<div class="highlight_location_days"><?php echo $highlight_location ?></div>
						<div class="highlight_stars">
							<?php
								$index = 0;
								while($index < $highlight_stars){
									?>
										<i class="fa-solid fa-star"></i>
									<?php
								$index++;}
							?>
						</div>
						<div class="trip_highlight_content">
							<?php echo $highlight_description; ?>
						</div>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="whats_included">
		<h2><?php echo $whats_included_title; ?></h2>
		<div class="whats_included_content_wrap">
			<div class="whats_included_content">
				<?php foreach($whats_included_accordion as $whats_included_accordion_item){
					$whats_included_accordion_title = $whats_included_accordion_item['whats_included_title'];
					$accordion_items = $whats_included_accordion_item['accordion_items'];
					?>
					<div class="whats_included_accordion_section">
  <h3><?php echo $whats_included_accordion_title ?></h3>

  <!-- make this label simple; JS will sync it -->
  <!-- <a href="#" class="toggle_all_trigger">Expand All <i class="fa-solid fa-plus"></i></a>-->

  <ul>
    <?php foreach ($whats_included_accordion_item['accordion_items'] as $row) { 
      $is_open = ($whats_included_accordion_item['expand_all'] !== "False"); ?>
      <li class="accordion_item">
        <div class="accordion_trigger">
          <?php echo $row['accordion_trigger_text']; ?>
          <span class="collapsed_indicator" aria-hidden="true">
            <i class="fa-solid <?php echo $is_open ? 'fa-minus' : 'fa-plus'; ?>"></i>
          </span>
        </div>
        <div class="accordion_content" style="display:<?php echo $is_open ? 'block' : 'none'; ?>">
          <?php echo $row['accordion_content']; ?>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>

				<?php } ?>

				<div class="additional_whats_included_text">
					<?php echo do_shortcode($additional_whats_included_text); ?>
				</div>
			</div>
			<div class="whats_included_image">
				<div class="" style="height:100%;background-size: contain;background-repeat: no-repeat;background-position: center top;background-image:url('<?php echo $whats_included_image['url']; ?>');"></div>
			</div>
		</div>
	</div>
	
	
	<div class="itinerary">
  <h2><?php echo $itinerary_title ?></h2>

  <div style="position:relative;height:40px;" class="accordion_collapse_wrap">
    <a href="#" class="toggle_all_trigger">Expand All <i class="fa-solid fa-plus"></i></a>
  </div>

  <ul>
    <?php foreach($itinerary_items as $itinerary_item){ ?>
      <li class="accordion_item">
        <div class="itinerary_item_content">
          
          <div class="accordion_trigger" style="position:relative;">
            <?php echo $itinerary_item['itinerary_trigger_text']; ?>
            <span class="collapsed_indicator">
              <?php if($itinerary_item['default_expand'] == "False"){ ?>
                <i class="fa-solid fa-plus"></i>
              <?php } else { ?>
                <i class="fa-solid fa-minus"></i>
              <?php } ?>
            </span>
          </div>

          <div class="accordion_content" 
            <?php if($itinerary_item['default_expand'] == "False"){ ?>
              style="display:none;"
            <?php } else { ?>
              style="display:block;"
            <?php } ?>>
            
            <div class="itinerary_text">
              <?php echo $itinerary_item['itinerary_content']; ?>
            </div>

            <div class="itinerary_image" style="background-image:url('<?php echo $itinerary_item['itinerary_image']['url'] ?>');"></div>
          </div>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>

	<div class="hotels" style="clear:both;">
		<h2><?php echo $hotels_title ?></h2>
		<div class="hotels_content">
			<?php echo do_shortcode($hotels_content); ?>
		</div>
		<ul class="hotels_slider">
			<?php foreach($hotels_items as $hotels_item){ ?>
				<li>
					<div class="hotel_item_image" style="background-image:url('<?php echo $hotels_item['hotel_item_image']['url'] ?>');"></div>
					<div class="hotel_content_wrap">
						<h3><?php echo $hotels_item['hotel_title'] ?></h3>
						<div><span class="hotel_location"><?php echo $hotels_item['hotel_location']; ?></span>
							<span class="hotel_stars">
								<?php
									$index = 0;
									while($index < $hotels_item['hotel_stars']){
										?>
											<i class="fa-solid fa-star"></i>
										<?php
									$index++;}
								?>
							</span>
						</div>
						<div class="hotel_content">
							<?php echo $hotels_item['hotels_content'] ?>
						</div>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="trip_options">
		<h2><?php echo $trip_options_title ?></h2>
		<div class="trip_options_content">
			<?php echo do_shortcode($trip_options_content); ?>
									</div>
		<?php if($trip_option_items){ ?>
		<ul class="trip_options_slider">
			<?php foreach($trip_option_items as $trip_option_item){ ?>
				<li>
					<div class="trip_options_item_image" style="background-image:url('<?php echo $trip_option_item['trip_option_image']['url'] ?>');"></div>
					<div class="trip_options_wrap">
						<h3><?php echo $trip_option_item['trip_option_title'] ?></h3>
						<div><span class="trip_options_price"><?php echo $trip_option_item['trip_option_price']; ?></span>
							<span class="hotel_stars">
								<?php
									$index = 0;
									while($index < $trip_option_item['trip_option_stars']){
										?>
											<i class="fa-solid fa-star"></i>
										<?php
									$index++;}
								?>
							</span>
						</div>
						<div class="trip_option_item_content">
							<?php if($trip_option_item['trip_options_content']){ ?>
							<?php echo do_shortcode($trip_option_item['trip_options_content']); ?>
							<?php } ?>
							<?php if($trip_option_item['more_info'] ){ ?>
								<a style="display:block;"href="<?php echo $trip_option_item['more_info']['url'] ?>" target="<?php echo $trip_option_item['more_info']['target'] ?>"><?php echo $trip_option_item['more_info']['title'] ?> <i class="fa-solid fa-arrow-right"></i></a>
							<?php } ?>
						</div>
					</div>
				</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
</section>
<main>
	<div class="container">
		<article>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();
				/*$prev = get_previous_post_link('%link','&laquo; Previous');
				$next = get_next_post_link('%link','Next &raquo;');

				if ($prev || $next) { ?>
					<div class="navigation clearfix">
						<div class="alignleft"><?php echo $prev; ?></div>
						<div class="alignright"><?php echo $next; ?></div>
					</div>
				<?php } */ ?>

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h1><?php //the_title(); ?></h1>
					<div class="entry">
						<?php //the_content(); ?>
					</div>
				</div>

				<?php //comments_template(); ?>

			<?php endwhile; else: ?>
			
			<?php endif; ?>

		</article>
	</div>
</main>
<?php if($deals_popup || get_field('deals_popup',$tour->ID)){ ?>
<style>
  .tour_deals_popup_wrap{
        display: none;
        align-items: center;
        justify-content: center;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0,0,0,.5);
        z-index: 99999999999999;
      }
      .tour_deals_popup_wrap.active_tour_deals_popup{
        display: flex;
      }
      .tour_deals_popup_inner{
          max-width: 650px;
          max-height:90%;
          position: relative;
          overflow: auto;
      }
      .tour_deals_close_popup{
          display: flex;
          width: 40px;
          height: 40px;
          justify-content: center;
          align-items: center;
          text-decoration: none;
          position: absolute;
          top: 0;
          right: 0;
      }
      .tour_deals_popup_content a{
        color:#2C768E;
      }
      .tour_deals_popup_content a,.tour_deals_popup_content strong{
          display: block;
          margin: 15px 0;
      }
      .tour_deals_popup_content h1{
      	font-size: 42px;
      	color:#E74C3C;
      }
      .tour_deals_popup_content h2{
        font-size: 32px;
        color:#2C768E;
      }
      .tour_deals_popup_content h3{
        font-size: 24px;
        color:#2C768E;
      }
	  	.popup_outline{    
				padding: 20px 42px;
    		margin: 12px;
    		/*border: 1px solid #bebebe;*/
				box-shadow:0px 3px 10px rgba(0,0,0,.25);
				position:relative;
	  }
</style>
<div class="tour_deals_popup_wrap">
    <div class="tour_deals_popup_inner">
	<div class="popup_outline">
      <a href="#" class="tour_deals_close_popup"><i class="fa-solid fa-xmark"></i></a>
      <div class="tour_deals_popup_content">
        <?php if($deals_popup != '' && $deals_popup){ ?>
			<?php echo do_shortcode($deals_popup); ?>
		<?php }else{ ?>
			<?php echo do_shortcode(get_field('deals_popup',$tour->ID)) ?>
		<?php } ?>
    </div>
	</div>
  </div>
</div>
<?php } ?>
<?php if($travel_tools){ ?>
<style>
  .travel_tools_popup_wrap{
        display: none;
        align-items: center;
        justify-content: center;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0,0,0,.5);
        z-index: 99999999999999;
      }
      .travel_tools_popup_wrap.active_travel_tools_popup{
        display: flex;
      }
      .travel_tools_popup_inner{
          max-width: 650px;
          max-height: 90%;
          position: relative;
          overflow: auto;
      }
      .travel_tools_close_popup{
          display: flex;
          width: 40px;
          height: 40px;
          justify-content: center;
          align-items: center;
          text-decoration: none;
          position: absolute;
          top: 0;
          right: 0;
      }
      .travel_tools_popup_content a{
        color:#2C768E;
      }
      .travel_tools_popup_content a,.travel_tools_popup_content strong{
          display: block;
          margin: 15px 0;
      }
      .travel_tools_popup_content h2{
        font-size: 32px;
        color:#2C768E;
      }
	  .popup_outline{
	  background: #fff;  
		padding: 20px 42px;
    margin: 12px;
    /*border: 1px solid #bebebe;*/
		box-shadow:0px 3px 10px rgba(0,0,0,.25);
		position:relative;
	  }
</style>
<div class="travel_tools_popup_wrap">
    <div class="travel_tools_popup_inner">
	<div class="popup_outline">
      <a href="#" class="travel_tools_close_popup"><i class="fa-solid fa-xmark"></i></a>
      <div class="travel_tools_popup_content">
        <?php echo do_shortcode($travel_tools); ?>
		
    </div>
	</div>
  </div>
</div>
<?php } ?>
<?php } ?>
<div class="container">
<?php the_content(); ?>
	</div>

<?php get_footer(); ?>
