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
	main{
		margin-top:114px;
		display: flex;
		align-items: center;
	}
	.error-404 {
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  text-align: center;
	}
	.error-inner {
	  max-width: 640px;
	}
	.error-code {
	  font-size: clamp(10rem, 20vw, 15rem);
	  font-weight: 700;
	  opacity: 0.1;
	  margin: -4rem 0;
	}
	.error-title {
	  font-size: 2.5rem;
	  margin-bottom: 1rem;
	}
	.error-message {
	  font-size: 1.1rem;
	  margin-bottom: 1rem;
	}
	.error-actions {
	  display: flex;
	  flex-direction: column;
	  gap: 2rem;
	  align-items: center;
	}
</style>
<main>
    <div class="container">
        <article class="full-width">
		<section class="error-404">
		  <div class="error-inner">

		    <p class="error-code">404</p>

		    <h1 class="error-title">Page Not Found</h1>

		    <p class="error-message">
		      Sorry — the page you’re looking for doesn’t exist or may have been moved.
		    </p>

		    <div class="error-actions">
		    	<?php get_search_form(); ?>

		      	<a href="<?php echo esc_url( home_url('/') ); ?>" class="btn-primary">&#8592; Return Home</a>
		    </div>

		  </div>
		</section><!-- .error-404 -->
        </article>
    </div>
</main>
<?php
get_footer();
