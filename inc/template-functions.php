<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package MT_Writer
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mtwriter_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'mtwriter_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function mtwriter_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'mtwriter_pingback_header' );

/**
 * Calculates read time of an article
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mtwriter_CalculateReadTime($string)
{
    $speed = 170;
    $word = str_word_count(strip_tags($string));
    $m = floor($word / $speed);
    $s = floor($word % $speed / ($speed / 60));

    if ($m < 1) {
        $m = 1;
    } else if ($s > 30) {
        $m = $m;
    } else {
        $m++;
    }

    return $m;
}

/**
 * Related posts by Categories
 */ 
function mtwriter_related_posts_by_categories()
{
    $post_id = get_the_ID();
    $categories_ids = array();
    $categories = get_the_category($post_id);

    if (!empty($categories) && is_wp_error($categories)) :
        foreach ($categories as $category) :
            array_push($categories_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);
    $query_args = array(
        'category__in'   => $categories_ids,
        'post_type'      => $current_post_type,
        'post_not_in'    => array($post_id),
        'posts_per_page'  => esc_html(get_theme_mod('related_post_count', 3)),
        'ignore_sticky_posts' => 1,
    );

    $related_posts_categories = new WP_Query($query_args);
    ?>

    <div class="related-posts">
		<div class="container">
			<div class="row">
            <?php
                if ($related_posts_categories->have_posts()) :
                    while ($related_posts_categories->have_posts()) : 
                        $related_posts_categories->the_post(); ?>			
                        <article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="col-lg-4 col-md-6 col-sm-6">
                            <div class="post-grid">
                                <div class="post-grid-view post-grid-view-md">
                                    <div class="post-grid-image">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="post-content post-content-overlay">
                                        <div class="post-header">
                                            <span class="category-meta">
                                                <a href="#" rel="category tag">
                                                    <?php the_category( ',' ); ?>
                                                </a>
                                            </span>
                                            <h3 class="entry-post-title">
                                                <a href="<?php the_permalink() ?>">
                                                    <?php the_title() ?>
                                                </a>
                                            </h3>
                                        </div>
                                        <!-- Post content right-->
                                        <div class="post-meta-footer">
                                            <span class="grid-post-date">
                                                <?php echo esc_html_e('Posted on', 'mtwriter'); ?>
                                                <?php the_time( 'M j, y' ); ?>
                                            </span>
                                            <span class="grid-post-author">
                                                <?php echo esc_html_e('By', 'mtwriter'); ?>    
                                                <a href="#" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a>
                                            </span>
                                        </div>
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
                endif;
            ?>
			</div> <!-- row end-->
		</div><!-- container end-->
	</div><!-- related post end-->

<?php
}

/**
 * Related posts by Tags
 */ 
function mtwriter_related_posts_by_tags()
{
    $post_id = get_the_ID();
    $tags = wp_get_post_tags($post_id);
    
    if ($tags) {

        $tag_ids = array();
        foreach ($tags as $individual_tag) {
            $tag_ids[] = $individual_tag->term_id;
        }

        $args = array(
            'tag_in' => $tag_ids,
            'post_not_in' => array($post->ID),
            'posts_per_page' => esc_html(get_theme_mod('related_post_count', 3)), // Number of related posts that will be shown.
            'ignore_sticky_posts' => 1
        );
        
        $my_query = new wp_query($args);
    ?>
        <div class="related-posts">
            <div class="container">
                <div class="row">
                <?php
                    if ($my_query->have_posts()) :
                        while ($my_query->have_posts()) : $my_query->the_post(); ?>			
                            <article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="col-lg-4 col-md-6 col-sm-6">
                                <div class="post-grid">
                                    <div class="post-grid-view post-grid-view-md">
                                        <div class="post-grid-image">
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                        <div class="post-content post-content-overlay">
                                            <div class="post-header">
                                                <span class="category-meta">
                                                    <a href="#" rel="category tag">
                                                        <?php the_category( ',' ); ?>
                                                    </a>
                                                </span>
                                                <h3 class="entry-post-title">
                                                    <a href="<?php the_permalink() ?>">
                                                        <?php the_title() ?>
                                                    </a>
                                                </h3>
                                            </div>
                                            <!-- Post content right-->
                                            <div class="post-meta-footer">
                                                <span class="grid-post-date">
                                                    <?php echo esc_html_e('Posted on', 'mtwriter'); ?>
                                                    <?php the_time( 'M j, y' ); ?>
                                                </span>
                                                <span class="grid-post-author">
                                                    <?php echo esc_html_e('By', 'mtwriter'); ?>
                                                    <a href="#" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a>
                                                </span>
                                            </div>
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
                    endif;
                ?>
                </div> <!-- row end-->
            </div><!-- container end-->
        </div><!-- related post end-->

    <?php
    }
}

/**
 * Pagination
 */ 
if (get_theme_mod('pagination_type', 'numbered') == 'prev-next') {
    if( ! function_exists( 'my_post_queries' ) ) :
        function my_post_queries( $query ) {
            // do not alter the query on wp-admin pages and only alter it if it's the main query
            if (!is_admin() && $query->is_main_query()){
                // alter the query for the home and category pages
                if( is_home() ){
                    $query->set('posts_per_page', 7);
                }

                if( is_category() ){
                    $query->set('posts_per_page', 7);
                }
            }
        }
        add_action( 'pre_get_posts', 'my_post_queries' );
    endif;
}

if ( ! function_exists( 'mtwriter_pagination' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function mtwriter_pagination() {
        
        if ( get_theme_mod( 'pagination_type', 'numbered' ) == 'numbered' || get_theme_mod( 'pagination_type', 'numbered' ) == 'infinite-scroll') {
            ?>
            <div class="paging">
				<ul class="pagination justify-content-center">
                    <?php
                    if ( is_rtl() ) {
                        the_posts_pagination( array(
                            'mid_size'  => 1,
                            'prev_text' => '< ' . esc_html__( 'Previous', 'mtwriter' ),
                            'next_text' => esc_html__( 'Next', 'mtwriter' ).' >',
                        ) );
                    } else {
                        the_posts_pagination( array(
                            'mid_size'  => 1,
                            'prev_text' => '< ' . esc_html__( 'Previous', 'mtwriter' ),
                            'next_text' => esc_html__( 'Next', 'mtwriter' ).' >',
                        ) );
                    }
                    ?>
                </ul>
			</div>
        <?php
        }
        elseif( get_theme_mod('pagination_type', 'numbered') == 'prev-next' ) {
        
            if ( have_posts() ) { ?>
                <div class="col-12">
                    <div class="d-flex justify-content-between mt-5 pagination-next-prev">                        
                        <?php
                            previous_posts_link("< Previous");
                            next_posts_link("Next >");
                        ?>
                    </div>
                </div>
    <?php
            }
        }        
    }
endif;

// Google Web Fonts
function getJSONData($name)
{
    $fontsJSON = wp_remote_get(get_template_directory_uri() . '/inc/customizer/json/webfonts.json');
    $response = wp_remote_retrieve_body( $fontsJSON );
    
    return json_decode($response, true);
}

function getGoogleFonts()
{
    $fonts = getJSONData('webfonts');

    foreach ($fonts['items'] as $font) {
        $googleFonts["$font[family]"] = $font['family'];
    }

    return $googleFonts;
}

// Sanitize Fonts
function custom_sanitize_fonts($input)
{
    $valid = getGoogleFonts();
    
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Comments Template
 */
function mtwriter_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo esc_html($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment first"><?php
    } ?>
			<div class="author-box">
				<div class="mt-author-bio-img">
					<div class="mt-img-border">
						<?php
							echo get_avatar( $comment );
							get_comment_author_link();
						?>
					</div>
				</div>
			</div>
			
			<?php
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation">
						<?php esc_htmlesc_html_e( 'Your comment is awaiting moderation.', 'mtwriter' ); // WPCS: XSS ok. ?>
					</em>
					<br/>
			<?php 
				}
			?>

			<div class="comment-body">
				<div class="meta-data">
					<span class="comment-author"><?php echo get_comment_author_link(); ?></span>
					<span class="comment-date">
                        <?php
                            printf( // WPCS: XSS ok.
                                /* translators: 1: date, 2: time */
								__('%1$s at %2$s', 'mtwriter'),
								get_comment_date(),
								get_comment_time()
							);
						?>
					</span>
					|
					<b>
						<?php 
							comment_reply_link(
								array_merge( $args, 
									array( 
										'add_below' => $add_below, 
										'depth'     => $depth, 
										'max_depth' => $args['max_depth'],
										'class' => 'text-secondary'
									) 
								) 
							);
						?>
					</b>
					
					<?php edit_comment_link( __( '(Edit)', 'mtwriter' ), '  | ', '' ); ?>
				</div>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
			</div>
			
	<?php
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}

/**
 * Custom Fields for User Profile
 */
add_action( 'show_user_profile', 'custom_fields_user_profile' );
add_action( 'edit_user_profile', 'custom_fields_user_profile' );

function custom_fields_user_profile( $user ) { ?>
    <h3><?php esc_html_e("Social Handles", 'mtwriter'); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="facebook"><?php esc_html_e( 'Facebook', 'mtwriter' ); ?></label></th>
            <td>
                <input type="text" name="facebook" id="facebook"
                    value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Your facebook profile.', 'mtwriter'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php esc_html_e('Twitter', 'mtwriter'); ?></label></th>
            <td>
                <input type="text" name="twitter" id="twitter"
                    value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Your twitter profile.', 'mtwriter'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="instagram"><?php esc_html_e('Instagram', 'mtwriter'); ?></label></th>
            <td>
                <input type="text" name="instagram" id="instagram"
                    value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Your instagram profile.', 'mtwriter'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="linkedin"><?php esc_html_e('LinkedIn', 'mtwriter'); ?></label></th>
            <td>
                <input type="text" name="linkedin" id="linkedin"
                    value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Your linkedin profile.', 'mtwriter'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="youtube"><?php esc_html_e('YouTube', 'mtwriter'); ?></label></th>
            <td>
                <input type="text" name="youtube" id="youtube"
                    value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Your youtube profile.', 'mtwriter'); ?></span>
            </td>
        </tr>
    </table>
<?php }

/**
 * Saving custom fields values to Database
 */
add_action( 'personal_options_update', 'save_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_user_profile_fields' );

function save_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'facebook', isset( $_POST['facebook'] ) ? sanitize_text_field(wp_unslash($_POST['facebook'])) : '' );
    update_user_meta( $user_id, 'twitter', isset( $_POST['twitter'] ) ? sanitize_text_field(wp_unslash($_POST['twitter'])) : '' );
    update_user_meta( $user_id, 'instagram', isset( $_POST['instagram'] ) ? sanitize_text_field(wp_unslash($_POST['instagram'])) : '' );
    update_user_meta( $user_id, 'linkedin', isset( $_POST['linkedin'] ) ? sanitize_text_field(wp_unslash($_POST['linkedin'])) : '' );
    update_user_meta( $user_id, 'youtube', isset( $_POST['youtube'] ) ? sanitize_text_field(wp_unslash($_POST['youtube'])) : '' );
}
