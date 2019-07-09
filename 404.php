<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package MT_Writer
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found text-center">
				<div class="d-flex justify-content-center align-items-center" id="main">
					<div class="mr-3 pr-3 align-top border-right inline-block align-content-center 404-content">
						<?php getOption('defaults', '404_page_content'); ?>
					</div>
					<div class="inline-block align-middle">
						<a class="btn btn-primary lead font-weight-normal 404-cta" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php getOption('defaults', 'calltoaction'); ?>
						</a>
					</div>
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
