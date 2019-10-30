<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mighty Themes
 */

?>

<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="entry-blog">
	<div class="entry-blog-listing clearfix">
		<div class="post-standard-view">
			<div class="entry-blog-list-left">
				<div class="entry-format">
					<div class="featured-image" data-color="#ee0000">
						<?php mtwriter_post_thumbnail(); ?>
					</div>
				</div>
			</div>
			<div class="entry-blog-list-right">
				<div class="post-content">
					
					<div class="post-header">
						<?php if( get_theme_mod('show_category_archive', true) ) : ?>
							<span class="category-meta"><a href="#" rel="category tag"><?php the_category(', '); ?></a></span>
						<?php endif; ?>
						<?php
							if ( is_singular() ) :
								the_title( '<h1 class="entry-post-title">', '</h1>' );
							else :
								the_title( '<h3 class="entry-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
							endif;
						?>
					</div>
					
					<!-- Post content right-->
					<div class="post-meta-list">
						<?php if ( get_theme_mod('show_author_archive', 1) ) : ?>
							<span class="list-post-author">
								by
								<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>">
									<?php the_author(); ?>
								</a>
							</span>
						<?php endif; ?>

						<?php if ( get_theme_mod('show_date_archive', 1) ) : ?>							
							<span class="list-post-date">
								<?php echo get_the_date(); ?>
							</span>							
						<?php endif; ?>

						<?php if( get_theme_mod('estimated_read_time_archive', 1) ) : ?>
							<span class="list-post-comment">
								<?php 
								echo esc_html(mtwriter_CalculateReadTime( get_post_field( 'post_content', $post->ID ) ));
								echo mtwriter_CalculateReadTime( get_post_field( 'post_content', $post->ID ) ) == 1 ? ' minute' : ' minutes' // WPCS: XSS ok. ?> <?php echo esc_html_e('read.', 'mtwriter'); ?>
							</span>
						<?php endif; ?>
					</div> <!-- Post meta footer-->
					<?php if ( get_theme_mod('show_excerpt', true) ) : ?>
						<div class="post-intro-text">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>
					<?php if ( get_theme_mod('enable_read_more', true) ) : ?>
						<div class="post-btn">
							<a href="<?php the_permalink(); ?>" class="btn btn-primary more-btn">
								<?php echo get_theme_mod( 'read_more_text', 'Read More'); // WPCS: XSS ok. ?>
							</a>
						</div>
					<?php endif; ?>
				</div> <!-- post-content end-->
			</div> <!-- entry-blog-list-right end-->
		</div><!-- post-standard-view-->
	</div><!--entry-blog-listing-->
</article><!-- #post-<?php the_ID(); ?> -->
