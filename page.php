<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MT_Writer
 */

get_header();
?>
	
	<?php wp_link_pages(); ?>
	
	<div class="mt-title-wrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="entry-single-title">
						<?php the_title(); ?>
					</h2>

					<?php
						/* Assigning Ad in the Beginning of Post */
						if (get_theme_mod('ads_pages')) {
							if (get_theme_mod('ad_code_post_begin')) {
							?>
							<div class="ad-page-begin">
								<?php echo get_theme_mod('ad_code_post_begin'); // WPCS: XSS ok. ?>
							</div>
					<?php } } ?>

				</div><!-- Col End -->
			</div><!-- Main Row End -->
		</div><!-- Container End -->
	</div>

	<div class="page">
		<?php
		while ( have_posts() ) :
			the_post();
		?>
			<div class="mt-featured-image">
				<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail(); ?>
			</div><!-- mt-featured-image-->
			<div class="mt-page-content">
				
				<div class="mt-page-intro">
					<?php the_content(); ?>
				</div>
			</div><!-- mt-page-content-->
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<?php
		/* Assigning Ad in the End of Post */
		if (get_theme_mod('ads_pages')) {
			if (get_theme_mod('ad_code_post_end')) {
			?>
				<div class="ad-page-end">
					<?php echo get_theme_mod('ad_code_post_end'); // WPCS: XSS ok. ?>
				</div>
		<?php } } ?>
	</div><!-- .page -->

<?php
get_sidebar();
get_footer();
