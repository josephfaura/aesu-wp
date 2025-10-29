<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

?>

<?php get_header(); ?>


<main>
	<div class="container">
		<article>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();
				$prev = get_previous_post_link('%link','&laquo; Previous');
				$next = get_next_post_link('%link','Next &raquo;');

				if ($prev || $next) { ?>
					<div class="navigation clearfix">
						<div class="alignleft"><?php echo $prev; ?></div>
						<div class="alignright"><?php echo $next; ?></div>
					</div>
				<?php } ?>

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h1><?php the_title(); ?></h1>
					<div class="entry">
						<p class="postmetadata-postdate"><small><?php the_date(); ?></small></p>
						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						<p class="postmetadata alt">
							<small>
							<?php the_taxonomies( 'before=<div class="postmetadata-taxonomy">&after=</div>&sep=  |  &template=<strong>%s:</strong> %l' ); ?>
							This entry was posted on <?php the_time('l, F jS, Y'); ?> at <?php the_time(); ?>.
							<?php if ( comments_open() && pings_open() ) { ?>
							You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.
							<?php } elseif ( !comments_open() && pings_open() ) { ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.
							<?php } elseif ( comments_open() && !pings_open() ) { ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.
							<?php } elseif ( !comments_open() && !pings_open() ) { ?>
							Both comments and pings are currently closed.
							<?php } edit_post_link('Edit this entry','','.'); ?>
							</small></p>
					</div>
				</div>

				<?php //comments_template(); ?>

			<?php endwhile; else: ?>

				<p>Sorry, no posts matched your criteria.</p>
			
			<?php endif; ?>

		</article>
		<?php get_sidebar(); ?>
	</div>
</main>
<?php get_footer(); ?>