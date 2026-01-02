<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

?>

<?php get_header(); 
if(function_exists('get_field')){
    $tour_id = is_object($tour) ? $tour->ID : (int)$tour;
    $trip_name = get_field('trip_name', $tour_id);
    $destinations = get_field('citiescountries', $tour_id);
    $description = get_field('description', $tour_id);
    $tour_trip_highlights_title = get_field('trip_highlights_title', $tour_id);
    $trip_highlights = get_field('trip_highlights', $tour_id);
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
    $level = get_field('activity_level' , $tour_id); 
		$level = intval($level);
		$travel_tools = get_field('travel_tools', $tour_id);
    $deals_popup = get_field('deals_popup', $tour_id);
}

?>
<style>
	.trip_cta_list {
		justify-content: center;
	}
	.trip_cta_list > *:last-child {
		margin-left: 0;
	}
	.experiences {
		justify-content: center;
	}

	.whats_included_accordion_section h3{
		max-width: calc(100% - 109px);
	}
	#page section.trip_main_content_wrap{
		text-align: center;
		padding:0;
	}
	.tour_deals_popup_content a, .tour_deals_popup_content strong{
		margin:0!important;
		display:inline!important;
	}
	header{
		position:static;
	}
	.single-tours .trip_header{
		padding:.12px;
		position:sticky;
		top:0;
		background-color:#fff;
		box-shadow:0px 3px 10px rgba(0,0,0,.25);
		z-index:99999;
	}
	.single-tours h1 {
		margin:.67em !important;
	}
	.accordion_item{
		clear:both;
	}
	.slick-next{
		right:-14px;
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

	@media screen and (max-width: 976px){
		#chat-widget-push-to-talk {
			bottom:130px !important;
		}
}
</style>
<?php
if ( ! post_password_required() ) {
    // The password has been entered — show this content
?>

<?php if(is_user_logged_in()){ ?>
		<style>
			.single-trips .trip_header{
				top:32px;
			}
		</style>
	<?php } ?>

<section class="trip_header">
		    <h1><?php the_title(); ?></h1>
</section>

<section class="trip_main_content_wrap">
	<div class="trip_main_image" style="background-image:url(<?php echo esc_url( get_the_post_thumbnail_url() ); ?>);"></div>
	<div class="trip_main_content">
		<?php if($trip_name || $destinations){ ?>
		<h2><?php echo $trip_name; ?></h2>
		<div class="trip_dates"><?php echo $destinations; ?></div>
		<?php }?>
		<div class="trip_main_content_text">
			
			<?php
			//change to custom field 
			//
			echo do_shortcode($description); 
			?>
		</div>

<?php if($level || $experiences){ ?>

<div class="experiences">
		<div class="experiences-grid">
			<strong><a href="<?php echo get_permalink(11625) ?>" target="_blank" rel="noopener">Trip Experiences:</a></strong>
				<?php if( $experiences && is_array($experiences)){foreach ($experiences as $experiences) {echo '<i class="' . esc_attr($experiences) . '"></i>';}} ?>
		</div>
		<div class="experiences-grid">
	  	<strong>Activity Level:</strong>
	    	<?php for ($i = 1; $i <= 5; $i++): ?>
	        <div class="activity-box <?php echo ($i <= $level) ? 'active' : ''; ?>">
	            <?php echo $i; ?>
	  </div>
	    <?php endfor; ?>
	  </div>
</div>

<?php }?>

		<ul class="list--unstyled trip_cta_list">
			<li class="travel_tools"><a href="#">Travel Tools</a></li>
			<li class="deals_cta"><a href="#">Deals</a></li>
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
				<img src="<?php echo $whats_included_image['url']; ?>">
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
								<a href="<?php echo $trip_option_item['more_info']['url'] ?>" target="<?php echo $trip_option_item['more_info']['target'] ?>"><?php echo $trip_option_item['more_info']['title'] ?> <i class="fa fa-arrow-right"></i></a>
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
		<article class="full-width" style="width:100%;max-width:100%;">
		
			<?php if (have_posts()) : while (have_posts()) : the_post();?>

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<div class="entry">
						
						<?php
						$post_type = get_post_type();

						// show Tour Content first
						if ( $post_type === 'trips' && ! empty( $tour_id ) ) {

							$tour_post = get_post( $tour_id );

							if ( $tour_post ) {
								setup_postdata( $tour_post );
								the_content(); // ← Tour content
								wp_reset_postdata();
							}
						}
						// show Trip Content second
						if ( $post_type === 'trips' ) {
							the_content();
						}
						?>

					</div>
				</div>

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
          color:#aaa;
          text-decoration: none;
          position: absolute;
          top: 0;
          right: 0;
      }
      .tour_deals_close_popup:hover{
      	color:#888;
      }
      .tour_deals_popup_content a{
        color:#2C768E;
      }
      .tour_deals_popup_content a,.tour_deals_popup_content strong{
          display: block;
          margin: 15px 0;
      }
      .tour_deals_popup_content h1{
      	font-size: 2.6rem;
      	color:#E74C3C;
      }
      .tour_deals_popup_content h2{
        font-size: 2rem;
        color:#2C768E;
      }
      .tour_deals_popup_content h3{
        font-size: 1.5rem;
        color:#2C768E;
      }
	  	.tour_deals_popup_inner .popup_outline{ 
	  		background: #fff;   
				padding: 56px 56px 32px;
    		margin: .8rem;
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
          max-width:95%;
          max-height:95%;
          position: relative;
          overflow: auto;
      }
      .travel_tools_close_popup{
          display: flex;
          width: 40px;
          height: 40px;
          color:#888;
          justify-content: center;
          align-items: center;
          text-decoration: none;
          position: absolute;
          top: 0;
          right: 0;
      }
      .travel_tools_close_popup:hover{
      	color:#aaa;
      }
      .travel_tools_popup_content a{
        color: #d7d7d7;
		    display: block;
		    font-size: 80%;
		    margin: 1.5em 0;
		    text-transform: uppercase;
		    letter-spacing: .05rem;
      }
      .travel_tools_popup_content a:hover{
      	color:#f2f2f2;
      }
      .travel_tools_popup_content h2{
        font-size: 2rem;
        color:#2C768E;
      }
	  .travel_tools_popup_inner .popup_outline{
		  background: #3a3a3a;  
			padding: 75px;
	    margin: .8rem;
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
    <div id="back_to_top" class="back-to-top-inline">
        <i class="fa-solid fa-angle-up"></i>
    </div>
</div>

<?php get_footer(); ?>