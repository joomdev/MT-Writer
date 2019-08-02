<?php
/**
 * Famous Posts Custom Widget For MT-Minimag
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

	$recentPosts = new WP_Query(
		apply_filters( 'widget_posts_args',
			array(
				'posts_per_page'      => $instance['totalPosts'],
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			) )
	);

	$popularByViews  = new WP_Query( 
		array(
			'posts_per_page' => $instance['totalPosts'],
			'meta_key' => 'mtwriter_post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		)
	);

	if ( $popularByViews->have_posts() ) {
		$sortedPosts = $popularByViews;
	} elseif ( $recentPosts->have_posts() ) {
		$sortedPosts = $recentPosts;
	}
	?>

	<div class="mt-popular-post-list">
	<?php
	while( $sortedPosts->have_posts() ) :
		$sortedPosts->the_post();
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
	?>
	</div>
	<?php
	wp_reset_postdata();
		
}

// Creating the widget
class mtwriter_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		
		// Base ID of your widget
		'mtwriter_widget',
		
		// Widget name will appear in UI
		__('Popular Posts (MT-Minimag)', 'mtwriter'),
		
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

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['totalPosts'] = (int) $new_instance['totalPosts'];
		$instance['showThumbnail'] = isset( $new_instance['showThumbnail'] ) ? (bool) $new_instance['showThumbnail'] : false;
		$instance['showCategory'] = isset( $new_instance['showCategory'] ) ? (bool) $new_instance['showCategory'] : false;
		$instance['showDate'] = isset( $new_instance['showDate'] ) ? (bool) $new_instance['showDate'] : false;
		$instance['showAuthor'] = isset( $new_instance['showAuthor'] ) ? (bool) $new_instance['showAuthor'] : false;
		
		return $instance;
	}
         
	// Widget Backend
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$totalPosts    = isset( $instance['totalPosts'] ) ? absint( $instance['totalPosts'] ) : 3;
		$showThumbnail = isset( $instance['showThumbnail'] ) ? (bool) $instance['showThumbnail'] : true;
		$showCategory = isset( $instance['showCategory'] ) ? (bool) $instance['showCategory'] : true;
		$showDate = isset( $instance['showDate'] ) ? (bool) $instance['showDate'] : true;
		$showAuthor = isset( $instance['showAuthor'] ) ? (bool) $instance['showAuthor'] : true;
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'mtwriter' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />

				<label for="<?php echo $this->get_field_id( 'totalPosts' ); ?>"><?php esc_html_e( 'Number of Posts:', 'mtwriter' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'totalPosts' ); ?>" name="<?php echo $this->get_field_name( 'totalPosts' ); ?>" type="number" min="1" step="1" value="<?php echo $totalPosts; ?>" />

				<hr>
				<p>Customization Options: </p>
				<input class="checkbox" type="checkbox" <?php checked( $showThumbnail ); ?> id="<?php echo $this->get_field_id( 'showThumbnail' ); ?>" name="<?php echo $this->get_field_name( 'showThumbnail' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showThumbnail' ); ?>">Show Thumbnail</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showCategory ); ?> id="<?php echo $this->get_field_id( 'showCategory' ); ?>" name="<?php echo $this->get_field_name( 'showCategory' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showCategory' ); ?>">Show Category</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showDate ); ?> id="<?php echo $this->get_field_id( 'showDate' ); ?>" name="<?php echo $this->get_field_name( 'showDate' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showDate' ); ?>">Show Date</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showAuthor ); ?> id="<?php echo $this->get_field_id( 'showAuthor' ); ?>" name="<?php echo $this->get_field_name( 'showAuthor' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showAuthor' ); ?>">Show Author</label>
			</p>			
		<?php
	}
} // Class mtwriter_widget ends here