<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Mighty Themes
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
        'posts_per_page'  => get_theme_mod('related_post_count', 3),
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
                                                <?php the_category( ', ' ); ?>
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
                                                <?php esc_html_e('Updated on ', 'mtwriter'); ?>
                                                <?php mtwriter_get_date(); ?>
                                            </span>
                                            <span class="grid-post-author">
                                                <?php esc_html_e('By', 'mtwriter'); ?>    
                                                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a>
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
            'posts_per_page' => get_theme_mod('related_post_count', 3), // Number of related posts that will be shown.
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
                                                    <?php the_category( ', ' ); ?>
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
                                                    <?php esc_html_e('Updated on', 'mtwriter'); ?>
                                                    <?php mtwriter_get_date(); ?>
                                                </span>
                                                <span class="grid-post-author">
                                                    <?php esc_html_e('By', 'mtwriter'); ?>
                                                    <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a>
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
    if( ! function_exists( 'mtwriter_my_post_queries' ) ) :
        function mtwriter_my_post_queries( $query ) {
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
        add_action( 'pre_get_posts', 'mtwriter_my_post_queries' );
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
function mtwriter_getJSONData($name)
{
    $fontsJSON = wp_remote_get(get_template_directory_uri() . '/inc/customizer/json/webfonts.json');
    $response = wp_remote_retrieve_body( $fontsJSON );
    
    return json_decode($response, true);
}

function mtwriter_getGoogleFonts()
{
    $fonts = mtwriter_getJSONData('webfonts');

    foreach ($fonts['items'] as $font) {
        $googleFonts["$font[family]"] = $font['family'];
    }

    return $googleFonts;
}

// Sanitize Fonts
function mtwriter_custom_sanitize_fonts($input)
{
    $valid = mtwriter_getGoogleFonts();
    
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Date Template
 */

function mtwriter_get_date() {
    $mt_modified_date = apply_filters( 'mtwriter_date', true );

    $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    // If our date is enabled, show it.
    if ( $mt_modified_date ) {
        echo apply_filters( 'mtwriter_date_output', sprintf( '%1$s', // phpcs:ignore, sanitization ok.
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
                esc_url( get_permalink() ),
                esc_attr( get_the_time() ),
                $time_string
            )
        ), $time_string );
    }
}

/**
 * Adds the copyright to the footer
 */
if ( ! function_exists( 'mtwriter_footer_info' ) ) {
	
	function mtwriter_footer_info() {
		$copyright = sprintf( '&copy; %1$s %2$s &bull; %4$s <a href="%3$s" itemprop="url">%5$s</a>',
			date( 'Y' ),
			get_bloginfo( 'name' ),
			esc_url( 'https://mightythemes.com/themes/' ),
			_x( 'Powered by', 'MT Writer', 'mtwriter' ),
			__( 'MT Writer', 'mtwriter' )
        );
        
        echo $copyright; // phpcs:ignore.
	}
}

/**
 * Comments Template
 */
function mtwriter_comment($comment, $args, $depth) { ?>

    <li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">

        <?php if ( 'div' != $args['style'] ) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment first">
        <?php } ?>

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
        
        <?php if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation">
                <?php esc_html( 'Your comment is awaiting moderation.', 'mtwriter' ); // phpcs:ignore. ?>
            </em>
            <br/>
        <?php } ?>

        <div class="comment-body">
            <div class="meta-data">
                <span class="comment-author"><?php echo get_comment_author_link(); ?></span>
                <span class="comment-date">
                    <?php
                        printf( // phpcs:ignore.
                            /* translators: 1: date, 2: time */
                            esc_html__('%1$s at %2$s', 'mtwriter'),
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
    </li>
<?php
}
