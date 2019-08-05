<section class="mt-author-bio-wrap">
    <div class="container">
        <div class="row main-author-wrapper mb-5">
            <div class="col-lg-8 col-md-12 order-2 order-lg-1">
                <div class="mt-author-bio">
                    <div class="hero-title">
                        <?php
                            echo get_theme_mod('hero_title', '<h2>Hello, I am <strong>Jane Doe</strong> </h2>'); // WPCS: XSS OK.
                        ?>
                    </div>

                    <div class="hero-bio">
                        <?php echo get_theme_mod('hero_bio', '<div>A <strong>creative content writer</strong> and a passionate blogger who loves marketing and technology. I can help you with copywriting, UI/UX design and grow your <strong class="bio-color">agency</strong> speedily.</div>'); // WPCS: XSS OK. ?>
                    </div>
                    
                    <div class="bio-share">
                        <span> Follow Me </span>
                        <?php get_template_part( 'template-parts/social', 'profiles' ); ?>
                    </div>
                </div>
            </div><!-- Col End -->

            <?php 
            if ( get_theme_mod('show_profile_pic', true) ) { 
                if ( get_theme_mod('hero_profile_pic') ) { 
            ?>
                    <div class="col-lg-4 col-md-12 order-1 order-lg-2">
                        <div class="mt-author-bio-img">
                            <div class="mt-img-border">
                                <img class="img-fluid" src="<?php echo esc_url(get_theme_mod('hero_profile_pic')); ?>" alt="profile">
                            </div>
                        </div>
                    </div><!-- COl End -->
                <?php } else { ?>
                    <div class="col-lg-4 col-md-12 order-1 order-lg-2">
                        <div class="mt-author-bio-img">
                            <div class="mt-img-border">
                                <img class="img-fluid" src="<?php echo esc_url(get_template_directory_uri()) ?>/inc/assets/images/aboutme.jpg" alt="profile">
                            </div>
                        </div>
                    </div><!-- COl End -->
            <?php }
            }
            ?>

        </div>
        <!-- Main Row End -->
        <?php if ( get_theme_mod('show_hero_brands', true)) { ?>
            <div class="row justify-content-lg-center d-none d-lg-block">
                <div class="col-lg-12 col-md-12">
                    <div class="featured-in">
                        
                        <?php if ( get_theme_mod('brand_one', 1) ) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('brand_one', get_template_directory_uri() . '/inc/assets/images/medium.jpg' )); ?>">
                        <?php endif; ?>

                        <?php if ( get_theme_mod('brand_two', 1) ) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('brand_two', get_template_directory_uri() . '/inc/assets/images/csstricks.png' )); ?>">
                        <?php endif; ?>

                        <?php if ( get_theme_mod('brand_three', 1) ) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('brand_three', get_template_directory_uri() . '/inc/assets/images/forbes.jpg' )); ?>">
                        <?php endif; ?>

                        <?php if ( get_theme_mod('brand_four', 1) ) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('brand_four', get_template_directory_uri() . '/inc/assets/images/smashing.png' )); ?>">
                        <?php endif; ?>

                        <?php if ( get_theme_mod('brand_five', 1) ) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('brand_five', get_template_directory_uri() . '/inc/assets/images/tnw.png' )); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Featured In End -->
    </div>
    <!-- Container End -->
</section>
<!-- Intro End -->