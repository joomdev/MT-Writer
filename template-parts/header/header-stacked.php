<?php
/**
 * Writer functions and definitions
 *
 * @link https://mightythemes.com
 *
 * @package Mighty Themes
 */

?>

<header itemtype="https://schema.org/WPHeader" itemscope="itemscope" class="mt-header mt-header-stacked">
    <div class="container">
        <div class="row">
            <!-- Logo Area -->
            <div class="logo-area">
                <?php the_custom_logo(); ?>
                <div class="mt-logo-text list-inline">
                    <?php if (get_theme_mod('site_identity_status', true)) { ?>
                    <a itemscope="itemscope" itemtype="https://schema.org/Organization" class="brand-title"
                        href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php echo esc_html(bloginfo('title')); ?>
                    </a>

                    <?php if (get_bloginfo('description')) { ?>
                    <div class="brand-tagline"><?php echo esc_html(get_bloginfo( 'description' )); ?></div>
                    <?php }
                    } ?>
                </div>
            </div>
            <!-- Logo Area End-->
            <!-- Header action Items -->
            <div class="col-5 header-action-items d-flex d-lg-none">
                <!-- Header Search -->
                <?php if ( get_theme_mod('show_search', true) ) : ?>
                <div class="search-link <?php echo ( get_theme_mod('show_search_mobile', true) ? '' : 'd-none d-sm-block' ); ?>">

                    <form role="search" method="get" class="search-form"
                        action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <button type="button">
                            <span class="search-icon"><i class="fas icon-search fa-search"></i></span>
                            <span class="search-cross"><i class="fas fa-times icon-cross"></i></span>
                        
                        </button>
                        <div class="search-box">
                            <input type="search" class="search-field" name="s" id="search"
                                placeholder="<?php esc_html_e('Type here and Search...', 'mtwriter'); // phpcs:ignore. ?>" />
                        </div>
                    </form>

                </div> <!-- Header Search End -->
                <?php endif; ?>
                <!-- Nav toggler -->
                <button class="nav-toggler" type="button">
                    <span class="mt-nav-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
                <!-- End of Navbar toggler -->
            </div> <!-- Header action Items End -->
        </div>
        <div class="row">
            <!-- Main Menu Area -->
            <div class="col-12">
                <!-- Navbar -->
                <div itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" class="main-menu">
                <?php if ( has_nav_menu( 'menu-1' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                    ) );
                endif; ?>
                    <!-- Navbar End -->
                    <!-- Header action Items -->
                    <div class="header-action-items d-none d-lg-flex">
                        <!-- Header Search -->
                        <?php if ( get_theme_mod('show_search', true) ) : ?>
                        <div class="search-link <?php echo ( get_theme_mod('show_search_mobile', true) ? '' : 'd-none d-sm-block' ); ?>">

                            <form role="search" method="get" class="search-form"
                                action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <button type="button">
                                    <span class="search-icon"><i class="fas icon-search fa-search"></i></span>
                                    <span class="search-cross"><i class="fas fa-times icon-cross"></i></span>
                                
                                </button>
                                <div class="search-box">
                                    <input type="search" class="search-field" name="s" id="search"
                                        placeholder="Type here and Search...">
                                </div>
                            </form>

                        </div> <!-- Header Search End -->
                        <?php endif; ?>
                        <!-- Nav toggler -->
                        <button class="nav-toggler" type="button">
                            <span class="mt-nav-toggler-icon"><i class="fas fa-bars"></i></span>
                        </button>
                        <!-- End of Navbar toggler -->
                    </div> <!-- Header action Items End -->
                </div> <!-- Main Menu Area End-->
            </div>
        </div> <!-- Row End -->
    </div> <!-- Container End -->
</header> <!-- End of Header area-->