<?php
/**
 * MT Writer functions and definitions
 *
 * @link https://mightythemes.com
 *
 * @package Mighty Themes
 * @subpackage MT_Writer
 * @since 1.0.0
 */

?>

<header itemtype="https://schema.org/WPHeader" itemscope="itemscope" class="mt-header mt-header-default">
    <div class="container">
        <div class="row">
            <!-- Logo Area -->
            <div class="col-7 col-lg-4 logo-area">
                <a class="mt-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php the_custom_logo(); ?>
                </a>
                <div class="mt-logo-text list-inline">
                    <?php if (get_theme_mod('site_identity_status', true)) { ?>
                        <a itemscope="itemscope" itemtype="https://schema.org/Organization" class="brand-title"
                            href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php echo esc_html(bloginfo('title')); ?>
                        </a>

                    <?php if (get_bloginfo('description')) { ?>
                        <div class="brand-tagline"><?php echo esc_html(get_bloginfo( 'description' )); ?></div>
                    <?php } } ?>
                </div>
            </div>
            
            <!-- Logo Area End-->
            <!-- Header action Items -->
            <div class="col-5 col-lg-7 header-action-items d-flex d-lg-none">
                <!-- Header Search -->
                <?php if ( get_theme_mod('show_search', true) ) : ?>
                <div class="search-link <?php echo ( get_theme_mod('show_search_mobile', true) ? '' : 'd-none d-sm-block' ); ?>">

                    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <button type="button">
                            <span class="search-icon"><i class="fas icon-search fa-search"></i></span>
                            <span class="search-cross"><i class="fas fa-times icon-cross"></i></span>
                        </button>
                        <div class="search-box">
                            <input type="search" class="search-field" name="s" id="search" placeholder="Type here and Search...">
                        </div>
                    </form>

                </div> <!-- Header Search End -->
                <?php endif; ?>

                <!-- Nav toggler -->
                <button class="nav-toggler float-right" type="button">
                    <span class="mt-nav-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
                <!-- End of Navbar toggler -->
                
                
            </div> <!-- Header action Items End -->

            <!-- Main Menu Area -->
            <?php if ( has_nav_menu( 'menu-1' ) ) : ?>
            <div class="col-lg-8">
                <!-- Navbar -->
                <div itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" class="main-menu">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                        ) );
                    ?>
                    <!-- Navbar End -->

                    <?php if ( get_theme_mod('show_search', true) ) : ?>
                    <div class="header-action-items d-none d-lg-flex">
                        <!-- Header Search -->
                        <div class="search-link ">
                            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" target="_self">
                                <button type="button">
                                    <span class="search-icon"><i class="fas icon-search fa-search"></i></span>
                                    <span class="search-cross"><i class="fas fa-times icon-cross"></i></span>
                                
                                </button>
                                <div class="search-box">
                                    <input type="search" class="search-field" name="s" id="search" placeholder="Type here and Search...">
                                </div>
                            </form>
                        </div> <!-- Header Search End -->
                    </div>
                    <?php endif; ?>
                    
                </div> <!-- Main Menu Area End-->
                
            </div>
            <?php endif; ?>
        </div> <!-- Row End -->
    </div> <!-- Container End -->
</header> <!-- End of Header area-->