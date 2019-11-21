<?php
/**
 * The template for displaying Author archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mighty Themes
 */

get_header();
?>

    <div class="page">

        <?php if ( get_theme_mod('pagination_type', 'numbered') == 'infinite-scroll' ) : ?>
        <div class="mtwriter-posts">
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>

            <header itemtype="https://schema.org/WPHeader" itemscope="itemscope" class="page-header m-5">
                
                <?php
                    
                    /*
                    * Queue the first post, that way we know what author
                    * we're dealing with (if that is the case).
                    *
                    * We reset this later so we can run the loop properly
                    * with a call to rewind_posts().
                    */
                the_post();
                ?>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="main-author-wrapper">
                            <div class="mt-img-border">
                                <img class="img-fluid" src="<?php echo esc_url( get_avatar_url(get_the_author_meta('id'), array( "size" => 200 ))); ?>">
                            </div>
                         </div>
                    </div>
                    <div class="col-md-8 author-details">
                        <div class="card-body social-icons">
                            <h5 class="card-title">                                        
                                <?php echo esc_html( get_the_author() ); ?>
                            </h5>
                            <?php if ( get_the_author_meta( 'description' ) ) : ?>
                                <p class="card-text"><?php the_author_meta( 'description' ); ?></p>
                            <?php endif; ?>

                            <ul class="list-inline">
                                <?php if ( get_the_author_meta( 'facebook' ) ) : ?>
                                    <li class="list-inline-item social-icon">
                                        <a href="<?php esc_url( the_author_meta( 'facebook' ) ); ?>" target="_blank">
                                            <i class="fab fa-facebook-f fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ( get_the_author_meta( 'twitter' ) ) : ?>
                                    <li class="list-inline-item social-icon">
                                        <a href="<?php esc_url( the_author_meta( 'twitter' ) ); ?>" target="_blank">
                                            <i class="fab fa-twitter fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ( get_the_author_meta( 'instagram' ) ) : ?>
                                    <li class="list-inline-item social-icon">
                                        <a href="<?php esc_url( the_author_meta( 'instagram' ) ); ?>" target="_blank">
                                            <i class="fab fa-instagram fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
                                    <li class="list-inline-item social-icon">
                                        <a href="<?php esc_url( the_author_meta( 'linkedin' ) ); ?>" target="_blank">
                                            <i class="fab fa-linkedin fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ( get_the_author_meta( 'youtube' ) ) : ?>
                                    <li class="list-inline-item social-icon">
                                        <a href="<?php esc_url( the_author_meta( 'youtube' ) ); ?>" target="_blank">
                                            <i class="fab fa-youtube fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ( get_the_author_meta( 'url' ) ) : ?>
                                    <li class="list-inline-item social-icon">
                                        <a href="<?php esc_url( the_author_meta( 'url' ) ); ?>" target="_blank">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </header><!-- .page-header -->

            <?php
            /*
            * Since we called the_post() above, we need to rewind
            * the loop back to the beginning that way we can run
            * the loop properly, in full.
            */
            rewind_posts();

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_format() );

            endwhile;

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

        <?php if ( get_theme_mod('pagination_type', 'numbered') == 'infinite-scroll' ) : ?>
        </div> <!-- mtwriter-posts -->
        <?php endif; ?>

    </div><!-- .page -->

    <?php mtwriter_pagination(); ?>

<?php
get_sidebar();
get_footer();
