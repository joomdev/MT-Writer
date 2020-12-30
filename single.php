<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mighty Themes
 */
get_header();

while ( have_posts() ) :
	the_post();

wp_link_pages(); 

?>
	
	<div class="page">
		<div class="post-single">
			<div class="entry-header single-entry-header">
				<?php if( get_theme_mod('show_category', 1) ) : ?>
					<span class="category-meta">
						<?php the_category( ' ' ); ?>
					</span>
				<?php endif; ?>
				<h2 class="entry-title"><?php the_title(); ?></h2>
				
				<div class="post-meta author-box">
					<?php if ( get_theme_mod('show_author', 1) ) : ?>
						<div class="mt-author-bio-img">
							<div class="mt-img-border">
								<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="post-meta-content">
						
						<?php if ( get_theme_mod('show_date', 1) ) : ?>
							<span class="list-post-date m-1">
								<?php
									echo sprintf( '%1$s %2$s %3$s',
										esc_html_e( ucfirst( get_theme_mod( 'post_date_type', 'updated' ) ), 'mtwriter' ),
										esc_html_e( ' on ', 'mtwriter' ),
										mtwriter_get_date()
									)
								?>
							</span>
						<?php endif; ?>
						<?php if ( get_theme_mod('show_author', 1) ) : ?>
							<span class="post-author" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">
								<?php esc_html_e('By', 'mtwriter'); ?>
								<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>">
									<?php the_author(); ?>
								</a>
							</span>
						<?php endif; ?>

						<?php if( get_theme_mod('show_readtime', 1) ) : ?>
							<span class="list-post-comment">
								<?php echo esc_html(mtwriter_CalculateReadTime(get_post_field( 'post_content', $post->ID ))); ?>
								<?php echo mtwriter_CalculateReadTime(get_post_field( 'post_content', $post->ID )) == 1 ? ' minute' : ' minutes'?> <?php esc_html_e('read.', 'mtwriter'); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- header end -->
			
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="featured-image">
					<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail(); ?>
				</div>
			<?php }	?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- entry content end -->
		</div><!-- Post content end -->

		<div class="post-footer clearfix">
			<?php if ( get_theme_mod('show_tags', 1) ) : ?>
				<div class="post-tags">
					<?php the_tags('','',''); ?>
				</div><!-- Post tags end -->
			<?php endif; ?>
		</div><!-- Post footer end -->
			
		<?php if ( get_theme_mod('show_authorinfobox', 1) ) : ?>
			<div class="mt-author-box author-box mt-sept">
				<div class="mt-author-bio-img">
					<div class="mt-img-border">
						<?php echo get_avatar(get_the_author_meta('ID')); ?>
					</div>
				</div>
				<div class="author-info">
					<h4 itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">
						<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>">
							<?php the_author(); ?>
						</a>
					</h4>			
					<?php if(get_the_author_meta('description')): ?>
						<p><?php echo esc_html(get_the_author_meta('description')) ?></p>
					<?php endif; ?>
					
					<?php if(get_the_author_link()): ?>
						<p><?php get_the_author_link(); ?></p>
					<?php endif; ?>
					
				</div>
			</div><!-- Author box end -->
		<?php endif; ?>
		
		<nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" class="post-navigation mt-sept d-md-flex justify-content-md-between text-center text-md-left">
			<?php
				$prev_post = get_adjacent_post(false, '', true);
				if ( !empty($prev_post->post_title) ) :
			?>
				<div class="post-previous">
					<?php
						$prev_post = get_adjacent_post(false, '', true);
						echo "<a href=" . esc_url(get_permalink($prev_post->ID)) . ">
						<span><i class='fa fa-angle-left'></i>" . esc_html__(' Previous Post', 'mtwriter') . "</span>";
						if( !empty($prev_post) ) {
							echo '<h4>' . esc_html($prev_post->post_title) . '</h4></a>';
						}
					?>
				</div>
			<?php
				endif;

				$next_post = get_adjacent_post(false, '', false);
				if ( !empty($next_post) ) :
				?>
					<div class="post-next">
						<?php
							echo "<a href=" . esc_url(get_permalink($next_post->ID)) . ">
							<span>" . esc_html__('Next Post ', 'mtwriter') . "<i class='fa fa-angle-right'></i></span>";
							if(!empty($next_post)) {
							echo '<h4>' . esc_html($next_post->post_title) . '</h4></a>'; }
						?>
					</div>
				<?php endif; ?>
		</nav>

		<?php
			if ( get_theme_mod('show_comments', 1) ) :
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endif;

		endwhile; // End of the loop.
		?>
	</div><!-- Page Ends -->

	<?php
		if(get_theme_mod('related_post_enable', 0)) {
			switch(get_theme_mod('related_post_by', 'categories')) :
				case 'categories' : mtwriter_related_posts_by_categories();
				break;
				case 'tags' : mtwriter_related_posts_by_tags();
				break;
			endswitch;
		}
	?>
	
<?php
get_sidebar();
get_footer();