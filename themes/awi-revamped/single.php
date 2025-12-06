<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AWI_Revamped
 */

get_header();
?>

<style>
	.postmetadata-postdate, .postmetadata-taxonomy{
		font-size: 24px;
		margin: 1em auto;
		text-align: center;
	}
	.sidebar ul{
		padding:0;
	}
	.sidebar{
		max-width:300px;
	}
	.wp-block-search__button{
		max-width:71px;
	}
	.sidebar h2{
		font-size:26px;
	}
	.wp-posts-list h2{
		font-size:26px;
		margin-top:0;
	}
	.wp-posts-list li{
		display:flex;
		gap:30px;
	}
	.blog_thumbnail{
		min-width:300px;
	}
	body main article{
		width: 80%;
		max-width: 768px;
	}

	@media screen and (max-width:982px){
		.single-post main .container{
			display:block;
		}
		article, aside{
			float:none;
			width:100%!important;
		}
	}
	@media screen and (max-width:672px){
		.wp-posts-list li{
			display:block;
		}
		.blog_thumbnail{
			height:200px;
			min-width:100%;
			margin-bottom:20px;
		}
		#primary{
			padding-top:0;
		}
	}
</style>

<div class="banner_interior">
	<div class="flexslider clearfix">
		<ul class="slides">
			
			<li style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);">
				
			</li>
		</ul>
	</div>
</div>
	<main id="primary" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		    <h1><?php the_title(); ?></h1>

		    <div class="entry">

		        <p class="postmetadata-postdate">
		            <small><?php the_date(); ?></small>
		        </p>

		        <?php the_content(); ?>

		        <?php wp_link_pages( array(
		            'before' => '<p><strong>Pages:</strong> ',
		            'after'  => '</p>',
		            'next_or_number' => 'number'
		        ) ); ?>

		        <?php the_taxonomies( 'before=<div class="postmetadata-taxonomy">&after=</div>&sep=  |  &template=<strong>%s:</strong> %l' ); ?>

		        <?php 
		            // Navigation links
		            $prev = get_previous_post_link('%link','<i class="fa-solid fa-arrow-left"></i> Previous');
		            $next = get_next_post_link('%link','Next <i class="fa-solid fa-arrow-right"></i>');

		            if ( $prev || $next ) : ?>
		                <div class="navigation clearfix">
		                    <div class="alignleft"><strong><?php echo $prev; ?></strong></div>
		                    <div class="alignright"><strong><?php echo $next; ?></strong></div>
		                </div>

		        <?php endif; ?>
		        <p class="postmetadata alt">
		            <center><small>
		            This entry was posted on <?php the_time('l, F jS, Y'); ?> at <?php the_time(); ?>.

		            <?php if ( comments_open() && pings_open() ) : ?>
		                You can follow any responses through <?php post_comments_feed_link('RSS 2.0'); ?>.
		                You can <a href="#respond">leave a response</a>, or
		                <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a>.
		            
		            <?php elseif ( !comments_open() && pings_open() ) : ?>
		                Responses are closed, but you can
		                <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a>.
		            
		            <?php elseif ( comments_open() && !pings_open() ) : ?>
		                You can skip to the end and leave a response. Pinging is not allowed.
		            
		            <?php else : ?>
		                Both comments and pings are currently closed.
		            <?php endif; ?>

		            <?php edit_post_link( 'Edit this entry', '', '.' ); ?>

		            </small></center>
		        </p>

		    </div><!-- .entry -->

		</article>

		<?php endwhile; else : ?>

		<p>Sorry, no posts matched your criteria.</p>

		<?php endif; ?>
	</div>

	</main><!-- #main -->

<?php
get_footer();
