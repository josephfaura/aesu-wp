<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Alumni World Travel
 */

get_header(); ?>

<style>
	.interior_banner {
		height:60vh;
		display: flex;
		justify-content: center;
		align-items:center;
		background-position: center;
		background-size:cover;
		background-attachment: fixed;
		position: relative;
		margin-bottom:32px;
	}
	.interior_banner .container{
		width:100%;
		display: flex;
    	flex-direction: column;
    	align-items: center;
    	max-width:800px;
	}
	.interior_banner *{
		position: relative;
		z-index:999;
		color:#fff;
	}
	.interior_banner:after{
		content:'';
		position: absolute;
		left:0;
		top:0;
		width:100%;
		background-color:rgba(0,0,0,.4);
		height:100%;
	}
	.interior_banner .form_banner{
		display: flex;
		width:70%;
		gap:10px;
		align-items: center;
		justify-content: center;
		margin:18px 0;
		position: relative;
	}
	.interior_banner input{
		color:#5e5e5e;
    	padding: 6px 6px 6px 40px;
    	border: 0;
    	border-radius: 0;
	}
	.interior_banner i{
		position: absolute;
		color:#5e5e5e;
	    /*top: 50%;*/
	    left: 15px;
	    /*transform: translateY(-50%);*/
	    pointer-events: none;
	    font-size: 1rem;
	    z-index:9999;
	}
	.interior_banner .button{
		background: #e74c3c;
	    max-width: 120px;
	    height: auto;
	    font-size: 18px;
	    font-weight:700;
	    line-height: 37px;
		text-align: center;
	    text-transform: uppercase;
	    margin: 0;
	    padding: 0px 20px;
	    border:0;
	    border-radius:3px;
	}
	.interior_banner .button:hover{
	color:#fff!important;
	background-color:#d13b2d;
	}
	a:active {
	transform:translateY(3px);
  	}
	.packages{
		list-style: none;
		margin:32px 0;
		display: flex;
		flex-wrap:wrap;
		justify-content: center;
		gap:32px;
		padding-left:0;
	}
	.packages li {
		width:calc(100% / 3 - 32px);
		display: flex;
		flex-direction: column;
		box-shadow: 0 3px 10px rgba(0,0,0,.25);
		border-radius: 6px;
	}
	.packages div.thumbnail_wrap{
		border-radius:6px 6px 0 0;
		padding: 32px;
	}
	.packages div.package_thumbnail{
		height:20vh;
		position: relative;
		background-size:contain;
		background-position:center;
		background-repeat:no-repeat;
		transition:.25s all;
	}
	.packages a:hover div.package_thumbnail{
		transform: scale(.975);
	}
	.packages div.package_content{
		padding:32px;
		text-align: center;
		/*background-color:#f2f2f2;*/
		height:100%;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		align-items: center;
		transition:.3s all;
	}
	article{
		width:100%!important;
		max-width:100%;
	}
	main .container{
		max-width:1300px;
	}
	.package_content h3{
		font-size:1.5em;
		margin-top:0;
		color:#5e5e5e;
	}
	.search-terms {
	    display: none;
	}
	.awt_toc_form {
		width:80%;
		margin: auto;
	}
	@media screen and (max-width:998px){
		.packages li {
			width:calc(100% / 2 - 20px);
		}
	}
	@media screen and (max-width: 767px) {
	    .interior_banner {
	    	height:100vh;
	        background-attachment: scroll;
	    }
	}
	@media screen and (max-width:600px){
		.interior_banner .button{
				width: 100%;
				max-width: 100%;
			}
		.interior_banner h3 {
			font-size: 42px;
		}
		.interior_banner .form_banner {
			flex-direction:column;
			gap:20px;
		}
		.interior_banner i {
			transform:translateY(-175%);
		}
		.packages li {
			width:calc(100% / 1 - 20px);
		}
		.packages div.package_thumbnail{
			height:200px;
		}
		.awt_toc_form {
			width:100%;
		}
	}
	@media screen and (max-width:450px){
		.interior_banner .form_banner {
			width:100%;
		}
	}
</style>

<main>

<?php if ( have_rows('slider', $dupID) ) : ?>
	<?php
	the_row(); // ← advance to FIRST slide only

	$image    = get_sub_field('slide_image');
	$title    = get_sub_field('slide_title');
	?>
	
	<div class="banner_interior interior_banner" style="background-image:url(<?php echo esc_url($image['url']); ?>);">
		<div class="container">
			<?php if ( $title ) : ?>
				<h3><?php echo esc_html($title); ?></h3>
			<?php endif; ?>
				<div class="form_banner">
					<i class="fa fa-search"></i>
					<input type="text" id="search_packages" placeholder="What school are you looking for?">
					<a href="#" id="search_submit" class="button">Search</a>
				</div>
		</div>
	</div>

<?php else : ?>
	<div class="no-banner"></div>
<?php endif; ?>

	<div class="container">
		<article class="full-width" style="max-width:100%;">
			<?php
			$args = [
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
			'meta_query'     => [
				[
					'key'     => '_wp_page_template',
					'value'   => 'page-school-landing-page.php',
					'compare' => '=',
				],
			],
		];
		$query = new WP_Query($args);
		if ($query->have_posts()) {
			?>
			<div class="post" id="post">
				<div class="entry">
					<?php the_content(); ?>
					<ul class="packages">
						<?php 
							$looping_index = 0;
							while ($query->have_posts()) {
       						 $query->the_post();
							 if(get_field('exclude_from_archive',get_the_ID()) != 'True' && get_the_ID()!= 824 && get_the_ID()!=1705){
							 $school_logo = get_field('school_logo', get_the_ID());
							 $school_logo_background = get_field('school_logo_background', get_the_ID());
							 $primary_color = get_field('primary_color', get_the_ID());
							?>
							<li id="package_<?php echo $looping_index; ?>">
								<div class="thumbnail_wrap" style="background-color:<?php echo $school_logo_background; ?>;">
									<a class="card_image_link" href="<?php echo get_the_permalink(); ?>">
										<div class="package_thumbnail" style="background-image:url('<?php echo $school_logo['url'] ?>');background-color:<?php echo $school_logo_background; ?>">
										</div>
									</a>
								</div>
								<div class="package_content">
									<a href="<?php echo get_the_permalink(); ?>"><h3><?php echo get_the_title(); ?></h3></a>

									 <a style="color:<?php echo $primary_color; ?> !important;font-weight:700;" href="<?php echo get_the_permalink(); ?>">Explore our trips <i class="fa fa-arrow-right"></i></a>
									
									<?php if ( have_rows('search_terms') ) : ?>
									    <div class="search-terms">
									        <?php while ( have_rows('search_terms') ) : the_row(); ?>
									            <span><?php echo esc_html( get_sub_field('term') ); ?></span>
									        <?php endwhile; ?>
									    </div>
									<?php endif; ?>
								</div>
							</li>
						<?php }$looping_index++;} ?>
					</ul>

					<!-- Fallback form -->
				<div class="awt_toc_form" style="display:none;">
					<h3 class="center">Can’t find your school? Fill out this form and we’ll help:</h3>
					<?php echo do_shortcode('[contact-form-7 id="a3118b0" title="Contact Alumni"]'); ?>
				</div>

				</div>
			</div>
			<?php wp_reset_postdata();} ?>
		</article>
	</div>
</main>

<div class="container">
    <div id="back_to_top" class="back-to-top-inline">
        <i class="fa-solid fa-angle-up"></i>
    </div>
</div>

<?php get_footer(); ?>
