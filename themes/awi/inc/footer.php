<footer>
	<div class="container">
		
		<?php // Footer Nav
		wp_nav_menu(
			array(
				'theme_location' => 'footer_nav',
				'container' => false,
				'menu_class' => 'footer-links list--unstyled inlineblock-fix'
			)
		); ?>

	</div>
</footer>
<ul class="copyright">
	<li>&copy; <?php echo date('Y'); ?> AWI Industries, Inc.</li>
	<li>All Rights Reserved</li>
	<li>Website Design &amp; Marketing provided by <a href="//www.advp.com" target="_blank">Adventure Web Interactive</a></li>
</ul>