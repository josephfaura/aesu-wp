<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: AWT TOC
 */

get_header(); ?>
<?php
if(function_exists('get_field')){
	$banner_background = get_field('banner_background');
	$institutions = get_field('institutions');
	$banner_text = get_field('banner_text');
}
?>
<style>
	.interior_banner {
		height:calc(100vh - 100px);
		display: flex;
		justify-content: center;
		align-items:center;
		background-position: center;
		background-size:cover;
		background-attachment: fixed;
		position: relative;
		margin-bottom:32px;
	}
	main .interior_banner .container{
		width:100%;
		display: flex;
    	flex-direction: column;
    	align-items: center;
    	max-width:800px;
	}
	.interior_banner *{
		position: relative;
		z-index:9;
		color:#fff;
	}

	.interior_banner h1{
		position: relative;
		z-index:9;
		color:#fff!important;
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
	.packages{
		padding-left:0;
	}
	.interior_banner h1{
		font-weight:bold;
		font-size:56px;
		line-height:1.25em;
		color:#fff;
	}
	.interior_banner p{
		font-size:24px;
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
    	padding-left: 44px;
	}
	.interior_banner i{
		position: absolute;
		color:#5e5e5e;
		left:10px;
		top:4px;
		z-index:99999;
		font-size:24px;
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
	    padding: 0px 20px;
	    border:0;
	    border-radius:0;
	}
	.interior_banner .button:hover{
	color:#fff!important;
	background-color:#d13b2d;
	}
	a:active {
	transform:translateY(5px);
  	}
	.packages{
		list-style: none;
		margin:0;
		display: flex;
		flex-wrap:wrap;
		justify-content: center;
	}
	.packages li {
		width:calc(100% / 3 - 20px);
		margin:10px;
		display: flex;
		flex-direction: column;
	}
	.packages li > a{
		display: flex;
		flex-direction: column;
		color:#5e5e5e;
		height:100%;
		transition:.3s all;
	}
	.packages li > a:hover{
		text-decoration: none;
		transform:translateY(-10px);
	}
	.packages div.package_thumbnail{
		height:250px;
		background-size: contain;
		background-position: center;
		background-repeat: no-repeat;
		flex-shrink: 0;
		position: relative;
	}
	.university_link{
		display: flex;
		justify-content: center;
		align-items: center;
		position: absolute;
		left:0;
		top:0;
		width:100%;
		height:100%;
		background:none!important;
		padding:25px;
	}
	.university_link img{
   	 	max-height: 100%;
	}
	.packages div.package_content{
		padding:24px;
		text-align: center;
		background-color:#f2f2f2;
		height:100%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		transition:.3s all;
	}
	.packages li > a:hover div.package_content{
		background-color:#f5f5f5;
	}
	article{
		width:100%!important;
		max-width:100%;
	}
	main .container{
		max-width:1400px;
	}
	.package_price{    
		margin-top: auto;
	    font-size: 18px;
	    color: #646464;
	}
	.package_overlayed_text{
		color:#5e5e5e;
		position: absolute;
		right:0;
		top:10px;
		padding:5px 10px;
		font-weight:bold;
		background-color:rgba(255,255,255,.8);
		text-transform:uppercase;
	}
	.package_description{
		margin-bottom:10px;
		font-size:16px;
		color:#5e5e5e;
	}
	.package_content h3{
		margin:10px 0;
		color:#5e5e5e;
	}
	main article h2{
		font-weight:bold;
		margin:0;
	}
	.header {
		border:none;
	}
	.no-banner{
		display: none;
	}
	.individual_trips{
		background:#b5b5b5;
		color:#5e5e5e;
		font-weight:bold;
		padding:5px;
		text-align: center;
		display: block;
		margin-bottom:5px;
		transition:.2s all;
	}
	.individual_trips:hover{
		background-color:#cbcbcb;
		text-decoration:none;
	}
	@media screen and (max-width:998px){
		.package_content h3{
			font-size: 24px;
		}
		.packages li {
			width:calc(100% / 2 - 20px);
		}
	}
	@media screen and (max-width: 767px) {
    .interior_banner {
    	height:100vh;
        background-attachment: scroll;
    }
	@media screen and (max-width:600px){

		.interior_banner h1 {
			font-size: 42px;
		}
		.interior_banner .form_banner {
			flex-direction:column;
			gap:20px;
		}
		.packages li {
			width:calc(100% / 1 - 20px);
		}
		.packages div.package_thumbnail{
			height:200px;
		}
	}
	@media screen and (max-width:450px){
		.interior_banner .form_banner {
			width:100%;
		}
	}

form .list--unstyled {
	margin: 0 -6px;
	list-style:none;
}

form .list--unstyled li {
	margin: 12px 6px;
}

.list--unstyled .form-field--half {
	float: left;
	width: calc(50% - 12px);
	margin: 6px;
}

.list--unstyled .form-field--third {
	float: left;
	width: calc(33.3333% - 12px);
	margin: 6px;
}

form .list--unstyled li:first-child,
form .list--unstyled .form-field--half:first-child,
form .list--unstyled .form-field--half:first-child + .form-field--half,
form .list--unstyled .form-field--third:first-child,
form .list--unstyled .form-field--third:first-child + .form-field--third,
form .list--unstyled .form-field--third:first-child + .form-field--third + .form-field--third {
	margin-top: 0;
}

form .list--unstyled li:last-child,
form .list--unstyled .form-field--half:last-child,
form .list--unstyled li:not(.form-field--half) + .form-field--half:nth-last-child(2),
form .list--unstyled .form-field--third:last-child,
form .list--unstyled li:not(.form-field--third) + .form-field--third:nth-last-child(3),
form .list--unstyled li:not(.form-field--third) + .form-field--third:nth-last-child(3) + .form-field--third:nth-last-child(2) {
	margin-bottom: 0;
}

.form-field--half + li:not(.form-field--half):not(.form-field--third),
.form-field--third + li:not(.form-field--half):not(.form-field--third) {
	clear: both;
	margin-top: 0;
	padding-top: 6px;
}

li:not(.form-field--half):not(.form-field--third) + .form-field--half,
li:not(.form-field--half):not(.form-field--third) + .form-field--half + .form-field--half,
li:not(.form-field--half):not(.form-field--third) + .form-field--third,
li:not(.form-field--half):not(.form-field--third) + .form-field--third + .form-field--third,
li:not(.form-field--half):not(.form-field--third) + .form-field--third + .form-field--third + .form-field--third {
	margin-top: 0;
}

@media screen and (max-width: 567px) {
	.list--unstyled .form-field--half,
	.list--unstyled .form-field--third {
		float: none;
		width: auto;
		margin: 12px 6px;
	}

	.form-field--half + li:not(.form-field--half):not(.form-field--third),
	.form-field--third + li:not(.form-field--half):not(.form-field--third) {
		margin-top: 12px;
		padding-top: 0;
	}

	form .list--unstyled .form-field--half:first-child + .form-field--half,
	form .list--unstyled .form-field--third:first-child + .form-field--third,
	form .list--unstyled .form-field--third:first-child + .form-field--third + .form-field--third,
	li:not(.form-field--half):not(.form-field--third) + .form-field--half,
	li:not(.form-field--half):not(.form-field--third) + .form-field--half + .form-field--half,
	li:not(.form-field--half):not(.form-field--third) + .form-field--third,
	li:not(.form-field--half):not(.form-field--third) + .form-field--third + .form-field--third,
	li:not(.form-field--half):not(.form-field--third) + .form-field--third + .form-field--third + .form-field--third {
		margin-top: 12px;
	}

	form .list--unstyled li:not(.form-field--half) + .form-field--half:nth-last-child(2),
	form .list--unstyled li:not(.form-field--third) + .form-field--third:nth-last-child(3),
	form .list--unstyled li:not(.form-field--third) + .form-field--third:nth-last-child(3) + .form-field--third:nth-last-child(2) {
		margin-bottom: 12px;
	}
}
input, textarea, select, button, .button {
    padding: 8px;
    width: 100%;
    height: 40px;
    height: auto\9;
    font: inherit;
    background: #fff;
    /*border: 1px solid #ccc;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;*/
}
button, html input[type="button"], input[type="reset"], input[type="submit"], .button {
    padding: 0 60px;
    width: auto;
    height: 56px;
    font-weight: 600;
    font-size: 26px;
    color: #fff;
    text-transform: uppercase;
    background: #e74c3c;
    border: none;
    /*border-bottom: 3px solid #c0392b;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;*/
    cursor: pointer;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<main>
	<div class="interior_banner" style="background-image:url('<?php echo $banner_background['url'] ?>');">
		<div class="container">
			<?php echo do_shortcode($banner_text); ?>
			<div class="form_banner">
				<i class="fa fa-search"></i>
				<input type="text" id="search_packages" placeholder="What school are you looking for?">
				<a href="#" id="search_submit" class="button">Search</a>
			</div>
		</div>
	</div>
	<div class="container">
		<!--<div class="header">
			<h1 style="color:#666 !important;">
				<?php the_field('h1_page_title'); ?>
			</h1>
		</div>-->
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
							?>
							<li id="package_<?php echo $looping_index; ?>">
								<div class="thumbnail_wrap" style="background-color:<?php echo $school_logo_background; ?>;padding:24px;"><div class="package_thumbnail" style="background-size:80% contain;background-position:center;background-repeat:no-repeat;background-image:url('<?php echo $school_logo['url'] ?>');background-color:<?php echo $school_logo_background; ?>"><a href="<?php echo get_the_permalink(); ?>" class="university_link"><img src="<?php echo $institution['institution_logo']['url'] ?>"></a></div></div>
								<div class="package_content">
									<a href="<?php echo get_the_permalink(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
									
									<div style="display:none;">
										<?php echo $institution['manual_search_terms']; ?>
									</div>
								</div>
							</li>
						<?php }$looping_index++;} ?>
					</ul>
				</div>
			</div>
			<?php wp_reset_postdata();} ?>
		</article>
	</div>
</main>
<?php get_footer(); ?>
