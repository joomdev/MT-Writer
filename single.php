<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MT_Writer
 */
get_header();

// URL for social sharing
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$socialLink = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$blogTitle = get_the_title();
$twitterUrl = $blogTitle." ".$socialLink;
$encodedTitle = rawurlencode($blogTitle);
$encodedUrl = rawurlencode($socialLink);

?>
	<?php
	while ( have_posts() ) :
		the_post();
	?>
	
	<?php wp_link_pages(); ?>

	<ul class="mt-socials d-none d-xl-block">
		<b>Share</b>
		<li>
			<a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $socialLink; ?>"><i class="fab fa-facebook-f"></i></a>
		</li>
		<li>
			<a class="twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>"><i class="fab fa-twitter"></i></a>
		</li>
		<li>
			<a class="reddit" target="_blank" href="http://www.reddit.com/submit?url=<?php echo $socialLink; ?>"><i class="fab fa-reddit"></i></a>
		</li>
		<li>
			<a class="pinterest" target="_blank" href="<?php echo "http://pinterest.com/pin/create/button/?url=$encodedUrl&description=$encodedTitle" ?>"><i class="fab fa-pinterest"></i></a>
		</li>
		<li>
			<a class="whatsapp" target="_blank" href="https://wa.me/whatsappphonenumber/?text=<?php echo $socialLink; ?>"><i class="fab fa-whatsapp"></i></a>
		</li>
	</ul>
	
	<div class="page">
		<div class="post-single">
			<div class="entry-header single-entry-header">
				<?php if( get_theme_mod('show_category', 1) ) : ?>
					<span class="category-meta">
						<?php the_category( ' ' ); ?>
					</span>
				<?php endif; ?>
				<h2 class="entry-title">
					<?php the_title(); ?>
				</h2>

				<?php
					/* Assigning Ad in the Beginning of Post */
					if (get_theme_mod('ads_pages')) {
						if (get_theme_mod('ad_code_post_begin')) {
						?>
						<div class="ad-page-begin">
							<?php echo get_theme_mod('ad_code_post_begin'); ?>
						</div>
					<?php
					} }
				?>
				
				<div class="post-meta author-box">

					<?php if ( get_theme_mod('show_author', 1) ) : ?>
						<div class="mt-author-bio-img">
							<div class="mt-img-border">
								<?php echo get_avatar(get_the_author_meta('id')); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="post-meta-content">
						<?php if ( get_theme_mod('show_date', 1) ) : 
							$u_time = get_the_time('U');
							$u_modified_time = get_the_modified_time('U');
							if ($u_modified_time >= $u_time + 86400) {
						?>
								<span itemprop="dateModified" class="list-post-date m-1">Updated on <?php the_modified_time('F jS, Y'); ?></span>
						<?php
							} else {
						?>
								<span itemprop="dateModified" class="list-post-date m-1">Updated on <?php echo get_the_time('F jS, Y'); ?></span>
						<?php
							}
						?>
						<?php endif; ?>
						<?php if ( get_theme_mod('show_author', 1) ) : ?>
							<span class="post-author" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">
								By
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
									<?php the_author(); ?>
								</a>
							</span>
						<?php endif; ?>

						<?php if( get_theme_mod('show_readtime', 1) ) : ?>
							<span class="list-post-comment">
								<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )); ?>
								<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )) == 1 ? ' minute' : ' minutes'?> read.
							</span>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- header end -->
			<div class="featured-image">
				<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail(); ?>
			</div>

			<div class="entry-content">				
				<?php the_content(); ?>
			</div><!-- entry content end -->
		</div><!-- Post content end -->

		<?php
		/* Assigning Ad in the End of Post */
		if (get_theme_mod('ads_pages')) {
			if (get_theme_mod('ad_code_post_end')) {
			?>
				<div class="ad-page-end">
					<?php echo get_theme_mod('ad_code_post_end'); ?>
				</div>
		<?php } } ?>

		<div class="post-footer clearfix">
			<?php if ( get_theme_mod('show_tags', 1) ) : ?>
				<div class="post-tags">
					<?php the_tags('','',''); ?>
				</div><!-- Post tags end -->
			<?php endif; ?>

			<?php if ( get_theme_mod('social_share_enable', 1) ) :
			?>
				<div class="post-share-items">
					<strong>Share : </strong>
					<ul class="mt-share">
						<li>
							<a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $socialLink; ?>"><i class="fab fa-facebook-f"></i></a>
						</li>
						<li>
							<a class="twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>"><i class="fab fa-twitter"></i></a>
						</li>
						<li>
							<a class="reddit" target="_blank" href="http://www.reddit.com/submit?url=<?php echo $socialLink; ?>"><i class="fab fa-reddit"></i></a>
						</li>
						<li>
							<a class="pinterest" target="_blank" href="<?php echo "http://pinterest.com/pin/create/button/?url=$encodedUrl&description=$encodedTitle" ?>"><i class="fab fa-pinterest"></i></a>
						</li>
						<li>
							<a class="whatsapp" target="_blank" href="https://wa.me/whatsappphonenumber/?text=<?php echo $socialLink; ?>"><i class="fab fa-whatsapp"></i></a>
						</li>
					</ul>
				</div><!-- Share items end -->
		<?php endif; ?>
		</div><!-- Post footer end -->
			
		<?php if ( get_theme_mod('show_authorinfobox', 1) ) : ?>
			<div class="mt-author-box author-box mt-sept">
				<div class="mt-author-bio-img">
					<div class="mt-img-border">
						<?php echo get_avatar(get_the_author_meta('id')); ?>
					</div>
				</div>
				<div class="author-info">
					<h4 itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
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
							echo "<a href=" . get_permalink($prev_post->ID) . ">
							<span><i class='fa fa-angle-left'></i> Previous Post</span>";
							if(!empty($prev_post)) {
							echo '<h4>' . $prev_post->post_title . '</h4></a>'; }
						?>
					</div>
			<?php
				endif;

				$next_post = get_adjacent_post(false, '', false);
				if ( !empty($next_post) ) :
				?>
					<div class="post-next">
						<?php
							echo "<a href=" . get_permalink($next_post->ID) . ">
							<span>Next Post <i class='fa fa-angle-right'></i></span>";
							if(!empty($next_post)) {
							echo '<h4>' . $next_post->post_title . '</h4></a>'; }
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
				case 'categories' : related_posts_by_categories();
				break;
				case 'tags' : related_posts_by_tags();
				break;
			endswitch;
		}
	?>
	
<?php
get_sidebar();
get_footer();