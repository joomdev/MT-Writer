<?php
/**
 * Famous Posts Custom Widget For MT-Writer
 */

 // Popular posts meta
function mtwriter_count_views($postID) {
    $post_meta = 'mtwriter_post_views_count';
    $count = get_post_meta($postID, $post_meta, true);
    if($count == '') {
        $count = 0;
        delete_post_meta($postID, $post_meta);
        add_post_meta($postID, $post_meta, '0');
    }
    else {
        $count++;
        update_post_meta($postID, $post_meta, $count);
    }
}

// Increasing the post views counter
function mtwriter_track_views ($post_id) {
    if ( !is_single() ) { return; }
    if ( empty ( $postId) ) {
        global $post;
        $postId = $post->ID;
    }
    mtwriter_count_views($postId);
}
add_action( 'wp_head', 'mtwriter_track_views');

// Creating Widgets
function mtwriter_load_widget() {
    register_widget( 'mtwriter_widget' );
}
add_action( 'widgets_init', 'mtwriter_load_widget' );

// Popular Posts by Comments
function mtwriter_popular_posts($instance) {

	$popularByComments = new WP_Query(
		array(
			'orderby' => 'comment_count'
		)
	);

	$popularByViews  = new WP_Query( 
		array(
			'posts_per_page' => $instance['totalPosts'],
			'meta_key' => 'mtwriter_post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

	?>
		
		<?php
			if ($popularByViews->have_posts()) {
				while ($popularByViews->have_posts()) : 
				$popularByViews->the_post();
		?>
				<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="">
					<div class="post-grid">
						<div class="post-grid-view post-grid-view-md">

							<?php if ( $instance['showThumbnail'] == 'on' ) : ?>
								<div class="post-grid-image">
									<?php the_post_thumbnail(); ?>
								</div>
							<?php endif; ?>

							<div class="post-content post-content-overlay">
								<div class="post-header">
									<?php if ( $instance['showCategory'] == 'on' ) : ?>
										<span class="category-meta">
											<a href="#" rel="category tag">
												<?php the_category( ',' ); ?>
											</a>
										</span>
									<?php endif; ?>

									<h3 class="entry-post-title">
										<a href="<?php the_permalink() ?>">
											<?php the_title() ?>
										</a>
									</h3>
								</div>
								<!-- Post content right-->
								<?php if ( $instance['showDate'] == 'on' || $instance['showAuthor'] ) : ?>
									<div class="post-meta-footer">
										<?php if ( $instance['showDate'] == 'on' ) : ?>
											<span class="grid-post-date">
												Post on <?php the_time( 'M j, y' ); ?>
											</span>
										<?php endif; ?>

										<?php if ( $instance['showAuthor'] == 'on' ) : ?>
											<span class="grid-post-author">
												By <a href="#" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a>
											</span>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<!-- Post meta footer-->
							</div>
							<!-- post-content end-->
						</div><!-- post-->
					</div><!-- post-->
				</article><!-- col-lg-4-->

		<?php
				endwhile;
				// Restore original Post Data
				wp_reset_postdata();
			} else {
				while ($popularByComments->have_posts()) : 
					$popularByComments->the_post();
			?>
					<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="">
						<div class="post-grid">
							<div class="post-grid-view post-grid-view-md">
	
								<?php if ( $instance['showThumbnail'] == 'on' ) : ?>
									<div class="post-grid-image">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php endif; ?>
	
								<div class="post-content post-content-overlay">
									<div class="post-header">
										<?php if ( $instance['showCategory'] == 'on' ) : ?>
											<span class="category-meta">
												<a href="#" rel="category tag">
													<?php the_category( ',' ); ?>
												</a>
											</span>
										<?php endif; ?>
	
										<h3 class="entry-post-title">
											<a href="<?php the_permalink() ?>">
												<?php the_title() ?>
											</a>
										</h3>
									</div>
									<!-- Post content right-->
									<?php if ( $instance['showDate'] == 'on' || $instance['showAuthor'] ) : ?>
										<div class="post-meta-footer">
											<?php if ( $instance['showDate'] == 'on' ) : ?>
												<span class="grid-post-date">
													Post on <?php the_time( 'M j, y' ); ?>
												</span>
											<?php endif; ?>
	
											<?php if ( $instance['showAuthor'] == 'on' ) : ?>
												<span class="grid-post-author">
													By <a href="#" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a>
												</span>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<!-- Post meta footer-->
								</div>
								<!-- post-content end-->
							</div><!-- post-->
						</div><!-- post-->
					</article><!-- col-lg-4-->
	
			<?php
					endwhile;
					// Restore original Post Data
					wp_reset_postdata();
			}
		?>
		

<?php
}

// Creating the widget
class mtwriter_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		
		// Base ID of your widget
		'mtwriter_widget',
		
		// Widget name will appear in UI
		__('Popular Posts (MT-Writer)', 'mtwriter'),
		
		// Widget description
		array( 'description' => __( 'Popular posts widget by MightyThemes', 'mtwriter' ), )
		);
	}
 
	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// before and after widget arguments
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output		
		mtwriter_popular_posts( $instance );
		echo $args['after_widget'];
	}
         
	// Widget Backend
	public function form( $instance ) {
		if ( isset($instance[ 'title' ]) || isset($instance[ 'totalPosts' ]) || isset($instance['showThumbnail']) || isset($instance['showCategory']) || isset($instance['showDate']) || isset($instance['showAuthor']) ) {
			$title = $instance[ 'title' ];
			$totalPosts = $instance[ 'totalPosts' ];
			$showThumbnail = $instance[ 'showThumbnail' ] ? 'true' : 'false';
			$showCategory = $instance[ 'showCategory' ] ? 'true' : 'false';
			$showDate = $instance[ 'showDate' ] ? 'true' : 'false';
			$showAuthor = $instance[ 'showAuthor' ] ? 'true' : 'false';
		}
		// Widget admin form
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'mtwriter' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

				<label for="<?php echo $this->get_field_id( 'totalPosts' ); ?>"><?php esc_html_e( 'Number of Posts:', 'mtwriter' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'totalPosts' ); ?>" name="<?php echo $this->get_field_name( 'totalPosts' ); ?>" type="number" value="<?php echo esc_attr( $totalPosts ); ?>" />

				<hr>
				<p>Customization Options: </p>

				<input class="checkbox" type="checkbox" <?php checked( $instance[ 'showThumbnail' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'showThumbnail' ); ?>" name="<?php echo $this->get_field_name( 'showThumbnail' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showThumbnail' ); ?>">Show Thumbnail</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $instance[ 'showCategory' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'showCategory' ); ?>" name="<?php echo $this->get_field_name( 'showCategory' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showCategory' ); ?>">Show Category</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $instance[ 'showDate' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'showDate' ); ?>" name="<?php echo $this->get_field_name( 'showDate' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showDate' ); ?>">Show Date</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $instance[ 'showAuthor' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'showAuthor' ); ?>" name="<?php echo $this->get_field_name( 'showAuthor' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showAuthor' ); ?>">Show Author</label>


			</p>
			
		<?php
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['totalPosts'] = ( ! empty( $new_instance['totalPosts'] ) ) ? strip_tags( $new_instance['totalPosts'] ) : '';
		$instance['showThumbnail'] = ( ! empty( $new_instance['showThumbnail'] ) ) ? strip_tags( $new_instance['showThumbnail'] ) : '';
		$instance['showCategory'] = ( ! empty( $new_instance['showCategory'] ) ) ? strip_tags( $new_instance['showCategory'] ) : '';
		$instance['showDate'] = ( ! empty( $new_instance['showDate'] ) ) ? strip_tags( $new_instance['showDate'] ) : '';
		$instance['showAuthor'] = ( ! empty( $new_instance['showAuthor'] ) ) ? strip_tags( $new_instance['showAuthor'] ) : '';
		
		return $instance;
	}
} // Class mtwriter_widget ends here