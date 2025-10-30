<?php if(get_field('duplicate_page_check')) {
	$dupID = get_field('duplicate_page_source');
} ?>

<?php
if( have_rows('flexible_content',$dupID ) ):
	while ( have_rows('flexible_content',$dupID) ) : the_row();
		// Text Block
		if( get_row_layout() == 'text_block'):
			the_sub_field('text_editor');
		
		// Accordion Blocks
		elseif( get_row_layout() == 'accordion' ): ?>
		<div class="acc-block">
			<?php if(get_sub_field('accordion_header')) { ?>
			<h2>
				<?php the_sub_field('accordion_header'); ?>
			</h2>
			<?php } ?>
			<?php if( have_rows('accordion_sections') ): ?>
			<div class="acc-row">
				<div class="acc-button acc-button-all">All</div>
			</div>
			<?php while ( have_rows('accordion_sections') ) : the_row();
					$accTitle = get_sub_field('accordion_section_title');
					$accContent = get_sub_field('accordion_section_content'); ?>
			<div class="acc-row">
				<div class="acc-button"><?php echo $accTitle; ?></div>
				<div class="acc-content" style="display:none;"><?php echo $accContent; ?></div>
			</div>
			<?php endwhile; ?>
		</div>
		<?php endif;

        // Gallery Blocks
		elseif( get_row_layout() == 'image_gallery' ):
			$galleryImages = get_sub_field('gallery');
			if( $galleryImages ): ?>
				<div class="image-gallery">
					<?php if(get_sub_field('gallery_header')) { ?>
					<h2>
						<?php the_sub_field('gallery_header'); ?>
					</h2>
					<?php } ?>
					<ul class="gallery-list clearfix">
						<?php foreach( $galleryImages as $galleryImage ): ?>
						<li><a href="<?php echo $galleryImage['url']; ?>" class="image-link">
							<div class="play-frame"><img src="<?php echo $galleryImage['sizes']['thumbnail']; ?>" alt="<?php echo $galleryImage['alt']; ?>">
								<div class="play-button"><span></span><i class="fa fa-search"></i></div>
							</div>
							</a> </li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; 
		
		// Video Library Blocks
		elseif( get_row_layout() == 'video_library' ): ?>
			<div class="video-gallery">
				<?php if(get_sub_field('library_header')) { ?>
				<h2>
					<?php the_sub_field('library_header'); ?>
				</h2>
				<?php } ?>
				<ul class="video-list clearfix">
					<?php while( have_rows('library') ): the_row(); 
								$caption = get_sub_field('caption');
								$url = get_sub_field('video');
								parse_str( parse_url( $url, PHP_URL_QUERY ), $urlID );
								$videoID = $urlID ['v']; ?>
					<li><a href="<?php echo $url; ?>" class="video-link">
						<div class="play-frame"><img src="http://img.youtube.com/vi/<?php echo $urlID['v']; ?>/hqdefault.jpg" alt="">
							<div class="play-button"><span></span><i class="fa fa-play-circle-o"></i></div>
						</div>
						</a><p class="video-caption"><?php echo $caption; ?></p></li>
					<?php endwhile; ?>
				</ul>
			</div>
		<?php endif; 
		//endif;
	endwhile;
endif; ?>

<?php /*if( have_rows('flexible_content',$dupID )) { ?>
<script>
$('.acc-button-all').click(function() {
		if ($(this).hasClass('acc-toggle-open')) {
			$('.acc-button').removeClass('acc-active');
			$('.acc-content').slideUp('normal');
			$(this).removeClass('acc-toggle-open')
		} else {
			$('.acc-button').addClass('acc-active');
			$('.acc-content').slideDown('normal');
			$(this).addClass('acc-toggle-open')
		}
	 });	
	$('.acc-button').click(function() {
		if ($(this).next().is(':hidden') == true) {
			$(this).addClass('acc-active');
			$(this).next().slideDown('normal');
		 } else { 
		 	$(this).next().slideUp('normal');
			$(this).removeClass('acc-active');
		}
	 });	
</script>
<?php }*/ ?>
