<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MT_Writer
 */

?>
			</div><!-- Content-area -->

			<?php
				/* Right Sidebar */
				// Metabox Sidebar Status (Gutenberg)
				$metabox_sidebar_status = get_post_meta(get_the_ID(), 'mtwriter-sidebar-status', true) ? get_post_meta(get_the_ID(), 'mtwriter-sidebar-status', true) : "default";

				// Post Level
				if(is_single()) :
					if ( $metabox_sidebar_status == "default" ) {
						if ( get_theme_mod('singlepost_sidebar', 'default') == 'default' ) {
							if ( get_theme_mod('default_sidebar') == 'right' ) {
								get_template_part( 'template-parts/sidebar/sidebar', 'right' );
							}
						} elseif ( get_theme_mod('singlepost_sidebar', 'default') == 'right') {
							get_template_part( 'template-parts/sidebar/sidebar', 'right' );
						}
					}
					elseif ( $metabox_sidebar_status == "right" ) {
						get_template_part( 'template-parts/sidebar/sidebar', 'right' );
					}
				endif;
				
				// Page Level
				if(is_page()) :
					if( $metabox_sidebar_status == "default" ) {
						if ( get_theme_mod('singlepage_sidebar', 'default') == 'default' ) {
							if ( get_theme_mod('default_sidebar') == 'right' ) {
								get_template_part( 'template-parts/sidebar/sidebar', 'right' );
							}
						} elseif ( get_theme_mod('singlepage_sidebar', 'default') == 'right') {
							get_template_part( 'template-parts/sidebar/sidebar', 'right' );
						}
					}
					elseif( $metabox_sidebar_status == "right" ) {
						get_template_part( 'template-parts/sidebar/sidebar', 'right' );
					}
				endif;

				// Homepage level
				if( is_home() ) :
					if ( get_theme_mod('archive_sidebar', 'default') == 'default' ) {
						if ( get_theme_mod('default_sidebar', 'none') == 'right' ) {
							get_template_part( 'template-parts/sidebar/sidebar', 'right' );
						}
					} elseif ( get_theme_mod('archive_sidebar', 'default') == 'right') {
						get_template_part( 'template-parts/sidebar/sidebar', 'right' );
					}

				endif;
			?>

			</div> <!-- container End -->

			<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" class="footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="footer-wrap">
								<?php get_template_part( 'template-parts/social', 'profiles' ); ?>
								<div class="copyright-info">
									<?php echo get_theme_mod('copyright_text', 'Powered by <a href="' .  esc_url( "https://mightythemes.com" ) . '" target="_blank">Mighty Themes</a>'); ?>
								</div>
							</div><!-- Footer social end-->
						</div> <!-- col-md-12 end-->
					</div><!-- Row end-->
				</div><!-- Container end-->
			</footer> <!-- Footer End -->

		</div> <!-- main-container end -->
	</div> <!-- inner-body end -->
</div> <!-- inner-body-wrap end -->

<?php wp_footer(); ?>

<?php if (get_theme_mod('space_before_body') ) : ?>
    <div class="space-before-body-code">
        <?php echo get_theme_mod('space_before_body'); ?>
    </div>
<?php endif; ?>

</body>

<?php 
    if (get_theme_mod('tracking_code') ) :
        echo get_theme_mod('tracking_code'); 
    endif;
?>

</html>
