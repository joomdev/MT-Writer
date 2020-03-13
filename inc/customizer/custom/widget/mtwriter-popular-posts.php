<?php
/**
 * Famous Posts Custom Widget For MT-Writer
 */

// Creating Widgets
function mtwriter_load_widget() {
    register_widget( 'mtwriter_widget' );
}
add_action( 'widgets_init', 'mtwriter_load_widget' );

// Popular Posts by Comments
function mtwriter_popular_posts($instance) {

	$recentPosts = new WP_Query(
		array(
			'posts_per_page'      => $instance['totalPosts'],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		)
	);

	$sortedPosts = $recentPosts;
	?>

	<div class="mt-popular-post-list">
	<?php
	while( $sortedPosts->have_posts() ) :
		$sortedPosts->the_post();
	?>
		<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="">
                <div class="post-grid">
                    <div class="post-grid-view post-grid-view-md">

						<?php if ( has_post_thumbnail() && $instance['showThumbnail'] == 'on' ) : ?>
                            <div class="post-grid-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content post-content-overlay">
                            <div class="post-header">
                                <?php if ( $instance['showCategory'] == 'on' ) : ?>
                                    <span class="category-meta">
										<?php the_category( ', ' ); ?>
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
                                            Updated on <?php mtwriter_get_date(); ?>
										</span>
                                    <?php endif; ?>

                                    <?php if ( $instance['showAuthor'] == 'on' ) : ?>
                                        <span class="grid-post-author">
											<?php esc_html_e('by', 'mtwriter') ?>
                                            <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a>
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
		__('Recent Posts (MT-Writer)', 'mtwriter'),
		
		// Widget description
		array( 'description' => __( 'Recent posts widget by MightyThemes', 'mtwriter' ), )
		);
	}
 
	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// before and after widget arguments
		echo $args['before_widget']; // WPCS: XSS ok.
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok.

		// This is where you run the code and display the output		
		mtwriter_popular_posts( $instance );
		echo $args['after_widget']; // WPCS: XSS ok.
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
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Recent Posts', 'mtwriter' );
		$totalPosts = isset( $instance['totalPosts'] ) ? absint( $instance['totalPosts'] ) : 3;
		$showThumbnail = isset( $instance['showThumbnail'] ) ? (bool) $instance['showThumbnail'] : true;
		$showCategory = isset( $instance['showCategory'] ) ? (bool) $instance['showCategory'] : true;
		$showDate = isset( $instance['showDate'] ) ? (bool) $instance['showDate'] : true;
		$showAuthor = isset( $instance['showAuthor'] ) ? (bool) $instance['showAuthor'] : true;
		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'mtwriter' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

				<label for="<?php echo esc_attr( $this->get_field_id( 'totalPosts' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'mtwriter' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'totalPosts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'totalPosts' ) ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr($totalPosts); ?>" />

				<hr>
				<p>Customization Options: </p>
				<input class="checkbox" type="checkbox" <?php checked( $showThumbnail ); ?> id="<?php echo esc_attr( $this->get_field_id( 'showThumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showThumbnail' ) ); ?>" /> 
				<label for="<?php echo esc_attr( $this->get_field_id( 'showThumbnail' ) ); ?>"><?php echo __( 'Show Thumbnail', 'mtwriter' ) ?></label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showCategory ); ?> id="<?php echo esc_attr( $this->get_field_id( 'showCategory' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showCategory' ) ); ?>" /> 
				<label for="<?php echo esc_attr( $this->get_field_id( 'showCategory' ) ); ?>"><?php echo __( 'Show Category', 'mtwriter' ) ?></label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showDate ); ?> id="<?php echo esc_attr( $this->get_field_id( 'showDate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showDate' ) ); ?>" /> 
				<label for="<?php echo esc_attr( $this->get_field_id( 'showDate' ) ); ?>"><?php echo __( 'Show Date', 'mtwriter' ) ?></label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showAuthor ); ?> id="<?php echo esc_attr( $this->get_field_id( 'showAuthor' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showAuthor' ) ); ?>" /> 
				<label for="<?php echo esc_attr( $this->get_field_id( 'showAuthor' ) ); ?>"><?php echo __( 'Show Author', 'mtwriter' ) ?></label>
			</p>			
		<?php
	}
} // Class mtwriter_widget ends here