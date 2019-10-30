<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Mighty Themes
 */

get_header();
?>
	<div class="page">
		<?php if ( have_posts() ) : ?>
			<header itemtype="https://schema.org/WPHeader" itemscope="itemscope" class="page-header text-center">
				<h3 class="page-title m-4">
					<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'mtwriter' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h3>
			</header><!-- .page-header -->

			<?php if ( get_theme_mod('pagination_type', 'numbered') == 'infinite-scroll' ) : ?>
			<div class="mtwriter-posts">
			<?php endif; ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			// Pagination for posts
			mtwriter_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		<?php if ( get_theme_mod('pagination_type', 'numbered') == 'infinite-scroll' ) : ?>
		</div>
		<?php endif; ?>

	</div><!-- Page -->

<?php
get_sidebar();
get_footer();
