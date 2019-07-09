<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MT_Writer
 */

get_header();
?>

	<div class="page">

		<?php if ( get_theme_mod('pagination_type', 'numbered') == 'infinite-scroll' ) : ?>
		<div class="mtwriter-posts">
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<header itemtype="https://schema.org/WPHeader" itemscope="itemscope" class="page-header m-5 text-center">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			mtwriter_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		<?php if ( get_theme_mod('pagination_type', 'numbered') == 'infinite-scroll' ) : ?>
		</div> <!-- mtwriter-posts -->
		<?php endif; ?>

	</div><!-- .page -->

<?php
get_sidebar();
get_footer();
