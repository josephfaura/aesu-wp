<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AWI_Revamped
 */

get_header();
?>
<style>
	article.full-width{
		float:none;
	}
	#page{
		margin-top:100px;
	}
</style>
<main>
    <div class="container">
        <article class="full-width">

		<section class="error-404 not-found">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'awi-revamped' ); ?></h1>
			
		</section><!-- .error-404 -->
        </article>
    </div>
</main>
<?php
get_footer();
