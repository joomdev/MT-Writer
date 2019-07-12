<?php
//
// ─── CUSTOMIZER CONTROLS ────────────────────────────────────────────────────────
//
function mtwriter_customize_register($wp_customize)
{
    // Google Web Fonts
    $googleFonts = getGoogleFonts();

    // Defaults
    $defaults = mt_get_defaults();
    $defaultColors = mt_get_color_defaults();
    $defaultFonts = mt_get_default_fonts();
    
    //
    // ─── CHECKING FOR CUSTOM SECTION AND CONTROLS STATUS ────────────────────────────
    //
    if ( method_exists( $wp_customize, 'register_section_type' ) ) {
        $wp_customize->register_section_type( 'Horizontal_Separator' );
    }

    $altFontFamily = array(
        "Arial" => "Arial",
        "Arial Black" => "Arial Black",
        "Bookman Old Style" => "Bookman Old Style",
        "Comic Sans MS" => "Comic Sans MS",
        "Courier" => "Courier",
        "Garamond" => "Garamond",
        "Georgia" => "Georgia",
        "Impact" => "Impact",
        "Lucida Console" => "Lucida Console",
        "Lucida Sans Unicode" => "Lucida Sans Unicode",
        "MS Sans Serif" => "MS Sans Serif",
        "MS Serif" => "MS Serif",
        "Palatino Linotype" => "Palatino Linotype",
        "Tahoma" => "Tahoma",
        "Times New Roman" => "Times New Roman",
        "Trebuchet MS" => "Trebuchet MS",
        "Verdana" => "Verdana"
    );

    // Removing WordPress Default Color Section
    $wp_customize->remove_section('colors');

    //
    // ─── SEPARATOR FOR MIGHTYTHEMES OPTIONS ─────────────────────────────────────────
    //
    $wp_customize->add_section(
        new Horizontal_Separator( $wp_customize, 'Horizontal_Separator-MT_options',
            array(
                'pro_text' => __( 'MT Writer Options', 'mtwriter' ),
                'type' => 'horizontal-separator',
                'priority' => 120,
            )
        )
    );

    // Enable/Disable Title and tagline fron site identity
    $wp_customize->add_setting('site_identity_status', array (
        'default' => $defaults['site_identity_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        'site_identity_status',
        array (
            'label' => __('Display Site Title and Tagline', 'mtwriter'),
            'section' => 'title_tagline',
            'type' => 'checkbox',
        )
    );

    //
    // ─── BASIC SETTINGS ─────────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('basic_settings', array (
        'title' => __( 'Basic Settings', 'mtwriter' ),
    ));
    
    //──── Preloader ───────────────────────────────────────────────────────────────────
    $wp_customize->add_section('preloader', array (
        'title' => __('Preloader', 'mtwriter'),
        'description' => '',
        'panel' => 'basic_settings',
    ));
    
    // Enable Preloader
	$wp_customize->add_setting( 'preloader_status', array(
        'default' => $defaults['preloader_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'preloader_status',
        array(
            'label' => __( 'Enable Preloader', 'mtwriter' ),
            'section' => 'preloader'
        )
    ));

    // Types of preloader
    $wp_customize->add_setting( 'preloader_type', array(
        'default' => $defaults['preloader_type'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));

    $wp_customize->add_control(
        new MightyThemes_Preloaders_Custom_Control(
        $wp_customize,
        'preloader_type',
        array(
            'label' => __( 'Choose Preloader', 'mtwriter' ),
            'section' => 'preloader',
            'choices' => array(
                'rotating-plane' => array(
                    'code' => '<div class="sk-rotating-plane"></div>',                
                ),
                'fading-circle' => array(
                    'code' => '<div class="sk-fading-circle">
                        <div class="sk-circle1 sk-circle"></div>
                        <div class="sk-circle2 sk-circle"></div>
                        <div class="sk-circle3 sk-circle"></div>
                        <div class="sk-circle4 sk-circle"></div>
                        <div class="sk-circle5 sk-circle"></div>
                        <div class="sk-circle6 sk-circle"></div>
                        <div class="sk-circle7 sk-circle"></div>
                        <div class="sk-circle8 sk-circle"></div>
                        <div class="sk-circle9 sk-circle"></div>
                        <div class="sk-circle10 sk-circle"></div>
                        <div class="sk-circle11 sk-circle"></div>
                        <div class="sk-circle12 sk-circle"></div>
                    </div>',
                    
                ),

                'folding-cube' => array(
                    'code' => '<div class="sk-folding-cube">
                        <div class="sk-cube1 sk-cube"></div>
                        <div class="sk-cube2 sk-cube"></div>
                        <div class="sk-cube4 sk-cube"></div>
                        <div class="sk-cube3 sk-cube"></div>
                    </div>',
                    
                ),
                'double-bounce' => array(
                    'code' => '<div class="sk-double-bounce">
                        <div class="sk-child sk-double-bounce1"></div>
                        <div class="sk-child sk-double-bounce2"></div>
                    </div>',
                    
                ),
                'wave' => array(
                    'code' => '<div class="sk-wave">
                        <div class="sk-rect sk-rect1"></div>
                        <div class="sk-rect sk-rect2"></div>
                        <div class="sk-rect sk-rect3"></div>
                        <div class="sk-rect sk-rect4"></div>
                        <div class="sk-rect sk-rect5"></div>
                    </div>',
                    
                ),
                'wandering-cubes' => array(
                    'code' => '<div class="sk-wandering-cubes">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                    </div>',
                    
                ),
                'pulse' => array(
                    'code' => '<div class="sk-spinner sk-spinner-pulse"></div>',
                    
                ),
                'chasing-dots' => array(
                    'code' => '<div class="sk-chasing-dots">
                        <div class="sk-child sk-dot1"></div>
                        <div class="sk-child sk-dot2"></div>
                    </div>',
                    
                ),
                'circle' => array(
                    'code' => '<div class="sk-circle">
                        <div class="sk-circle1 sk-child"></div>
                        <div class="sk-circle2 sk-child"></div>
                        <div class="sk-circle3 sk-child"></div>
                        <div class="sk-circle4 sk-child"></div>
                        <div class="sk-circle5 sk-child"></div>
                        <div class="sk-circle6 sk-child"></div>
                        <div class="sk-circle7 sk-child"></div>
                        <div class="sk-circle8 sk-child"></div>
                        <div class="sk-circle9 sk-child"></div>
                        <div class="sk-circle10 sk-child"></div>
                        <div class="sk-circle11 sk-child"></div>
                        <div class="sk-circle12 sk-child"></div>
                    </div>',
                    
                ),
                'cube-grid' => array(
                    'code' => '<div class="sk-cube-grid">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                        <div class="sk-cube sk-cube3"></div>
                        <div class="sk-cube sk-cube4"></div>
                        <div class="sk-cube sk-cube5"></div>
                        <div class="sk-cube sk-cube6"></div>
                        <div class="sk-cube sk-cube7"></div>
                        <div class="sk-cube sk-cube8"></div>
                        <div class="sk-cube sk-cube9"></div>
                    </div>',
                    
                ),
                'donut' => array(
                    'code' => '<div class="donut"></div>',
                    
                ),
                'bouncing-loader' => array(
                    'code' => '<div class="bouncing-loader">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>',                    
                ),
                'three-bounce' => array(
                    'code' => '<div class="sk-three-bounce">
                        <div class="sk-child sk-bounce1"></div>
                        <div class="sk-child sk-bounce2"></div>
                        <div class="sk-child sk-bounce3"></div>
                    </div>',                    
                ),
                
            )
        )
    ));
    
    // Preloader Color
    $wp_customize->add_setting('color_preloader', array (
        'default' => $defaultColors['color_preloader'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_preloader',
        array(
            'label'      => __( 'Preloader Color', 'mtwriter' ),
            'section'    => 'preloader',
        ) )
    );
    // Preloader size
    $wp_customize->add_setting( 'preloader_size', array(
        'default' => $defaults['preloader_size'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'preloader_size',
        array(
            'label' => __( 'Preloader Size', 'mtwriter' ),
            'section' => 'preloader',
            'input_attrs' => array(
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => $defaults['preloader_size'],
            ),
        )
    ));
    //──── Back to top ───────────────────────────────────────────────────────────────────────
    $wp_customize->add_section('backtotop', array (
        'title' => __('Back To Top', 'mtwriter'),
        'description' => '',
        'panel' => 'basic_settings',
    ));
    // Back to top (Enable/Disable)    
    $wp_customize->add_setting( 'backtotop_status', array(
        'default' => $defaults['backtotop_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'backtotop_status',
        array(
            'label' => __( 'Enable Back To Top', 'mtwriter' ),
            'section' => 'backtotop'
        )
    ));

    // Icons for Back to top
    $wp_customize->add_setting('backtotop_icon', array (
        'default' => $defaults['backtotop_icon'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'backtotop_icon', array(
        'label' => __('Choose Icon for button', 'mtwriter'),
        'section' => 'backtotop',
        'type' => 'select',
        'choices' => array(
            'fas fa-long-arrow-alt-up' => "Alternate Long Arrow Up",
            'fas fa-arrow-up' => 'Arrow Up',
            'fas fa-arrow-circle-up' => 'Arrow Cicle Up',
            'fas fa-arrow-alt-circle-up' => 'Alternate Arrow Circle Up',
            'fas fa-angle-double-up' => 'Angle Double Up',
            'fas fa-sort-up' => 'Sort Up (Ascending)',
            'fas fa-level-up-alt' => 'Level Up Alternate',
            'fas fa-chevron-up' => 'Chevron Up',
            'fas fa-chevron-circle-up' => 'Chevron Circle Up',
            'fas fa-hand-point-up' => 'Hand Pointing Up (Solid)',
            'far fa-hand-point-up' => 'Hand Pointing Up (Regular)',
            'fas fa-caret-square-up' => 'Caret Square Up (Solid)',
            'far fa-caret-square-up' => 'Caret Square Up (Regular)',
        ),
    ));
    // Back to top font size
    $wp_customize->add_setting( 'backtotop_size', array(
        'default' => $defaults['backtotop_size'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'backtotop_size',
        array(
            'label' => __( 'Back To Top Size', 'mtwriter' ),
            'section' => 'backtotop',
            'input_attrs' => array(
                'min' => 1,
                'max' => 200 ,
                'step' => 1,
                'default' => $defaults['backtotop_size'],
            ),
        )
    ));
    // Back to top font color
    $wp_customize->add_setting('backtotop_color', array (
        'default' => $defaultColors['backtotop_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'backtotop_color',
        array(
            'label' => __( 'Back To Top Color', 'mtwriter' ),
            'section' => 'backtotop',
        ) )
    );
    // Back to top Background color
    $wp_customize->add_setting('backtotop_bgcolor', array (
        'default' => $defaultColors['backtotop_bgcolor'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'backtotop_bgcolor',
        array(
            'label' => __( 'Back To Top Background Color', 'mtwriter' ),
            'section' => 'backtotop',
        ) )
    );
    // Back to top shape
    $wp_customize->add_setting('backtotop_shape', array (
        'default' => $defaults['backtotop_shape'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));

    $wp_customize->add_control('backtotop_shape', array (
        'label' => __('Shape', 'mtwriter'),
        'description' => __('Shape of Back To Top', 'mtwriter'),
        'type' => 'select',
        'section' => 'backtotop',
        'choices' => array(
            'square' => 'Square',
            'rounded' => 'Rounded',
            'circle' => 'Circle',
        ),
    ));
    // Enable Back to top on mobile
    $wp_customize->add_setting( 'backtotop_mobile', array(
        'default' => $defaults['backtotop_mobile'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'backtotop_mobile',
        array(
            'label' => __( 'Hide on Mobile', 'mtwriter' ),
            'description' => __('Show/Hide the button on mobile view.', 'mtwriter'),
            'section' => 'backtotop'
        )
    ));
    //──── Hero Area ─────────────────────────────────────────────────────────────────────
    $wp_customize->add_section('hero_area', array (
        'title' => __('Hero Area', 'mtwriter'),
        'description' => '',
        'panel' => 'basic_settings',
    ));

    // Hide/Show hero area
    $wp_customize->add_setting( 'show_hero_area', array(
        'default' => $defaults['show_hero_area'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_hero_area',
        array(
            'label' => __( 'Show Hero Area', 'mtwriter' ),
            'section' => 'hero_area'
        )
    ));

    // Hero Area Title
    $wp_customize->add_setting('hero_title', array (
        'default' => $defaults['hero_title'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control(
        'hero_title',
        array (
            'label' => __('Title', 'mtwriter'),
            'section' => 'hero_area',
            'type' => 'textarea',
        )
    );
    // Hero Area Bio
    $wp_customize->add_setting('hero_bio', array (        
        'default' => $defaults['hero_bio'],        
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control(
        'hero_bio',
        array (
            'label' => __('Bio', 'mtwriter'),
            'section' => 'hero_area',
            'type' => 'textarea',
        )
    );
    
    // Hero Social Icons (Can be set from social icons section)

    // Show Brands checkbox
    $wp_customize->add_setting( 'show_profile_pic', array(
        'default' => $defaults['show_profile_pic'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_profile_pic',
        array(
            'label' => __( 'Show Display Picture', 'mtwriter' ),
            'section' => 'hero_area'
        )
    ));

    // Admin profile picture
    $wp_customize->add_setting('hero_profile_pic', array (
        'default' => $defaults['hero_profile_pic'],
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Upload_Control( 
        $wp_customize, 
        'hero_profile_pic', 
        array(
            'label'      => __( 'Display Picture', 'mtwriter' ),
            'section'    => 'hero_area',
        ) ) 
    );
    // Show Brands checkbox
    $wp_customize->add_setting( 'show_hero_brands', array(
        'default' => $defaults['show_hero_brands'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_hero_brands',
        array(
            'label' => __( 'Show Brands', 'mtwriter' ),
            'section' => 'hero_area'
        )
    ));

    // Brands
    $wp_customize->add_setting('brand_one', array (
        'default' => $defaults['brand_one'],
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Upload_Control( 
        $wp_customize, 
        'brand_one', 
        array(
            'label'      => __( 'Brand One', 'mtwriter' ),
            'section'    => 'hero_area',
        ) ) 
    );

    $wp_customize->add_setting('brand_two', array (
        'default' => $defaults['brand_two'],
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Upload_Control( 
        $wp_customize, 
        'brand_two', 
        array(
            'label'      => __( 'Brand Two', 'mtwriter' ),
            'section'    => 'hero_area',
        ) ) 
    );

    $wp_customize->add_setting('brand_three', array (
        'default' => $defaults['brand_three'],
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Upload_Control( 
        $wp_customize, 
        'brand_three', 
        array(
            'label'      => __( 'Brand Three', 'mtwriter' ),
            'section'    => 'hero_area',
        ) ) 
    );
    
    $wp_customize->add_setting('brand_four', array (
        'default' => $defaults['brand_four'],
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Upload_Control( 
        $wp_customize, 
        'brand_four', 
        array(
            'label'      => __( 'Brand Four', 'mtwriter' ),
            'section'    => 'hero_area',
        ) ) 
    );
    
    $wp_customize->add_setting('brand_five', array (
        'default' => $defaults['brand_five'],
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Upload_Control( 
        $wp_customize, 
        'brand_five', 
        array(
            'label'      => __( 'Brand Five', 'mtwriter' ),
            'section'    => 'hero_area',
        ) ) 
    );
    

    //
    // ─── COLORS MANAGEMENT ──────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('colors_mgt', array (
        'title' => __( 'Colors Management', 'mtwriter'),
    ));

    $wp_customize->add_section('main_colors', array (
        'title' => __('Colors', 'mtwriter'),
        'panel' => 'colors_mgt',
    ));
    // Color controls
    $wp_customize->add_setting('color_primary', array (
        'default' => $defaultColors['color_primary'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_primary',
        array(
            'label'      => __( 'Primary Color', 'mtwriter' ),
            'section'    => 'main_colors',
        ) )
    );

    $wp_customize->add_setting('color_site', array (
        'default' => $defaultColors['color_site'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_site',
        array(
            'label'      => __( 'Site Color', 'mtwriter' ),
            'section'    => 'main_colors',
        ) )
    );

    // Logo Color
    $wp_customize->add_section('logo_colors', array (
        'title' => __('Logo Color', 'mtwriter'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_logo_text', array (
        'default' => $defaultColors['color_logo_text'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_logo_text',
        array(
            'label'      => __( 'Logo Text Color', 'mtwriter' ),
            'section'    => 'logo_colors',
        ) )
    );

    // Header Colors
    $wp_customize->add_section('header_colors', array (
        'title' => __('Header Color', 'mtwriter'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_header_text', array (
        'default' => $defaultColors['color_header_text'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_header_text',
        array(
            'label'      => __( 'Header Text Color', 'mtwriter' ),
            'section'    => 'header_colors',
        ) )
    );

    $wp_customize->add_setting('color_header_background', array (
        'default' => $defaultColors['color_header_background'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_header_background',
        array(
            'label'      => __( 'Header Background Color', 'mtwriter' ),
            'section'    => 'header_colors',
        ) )
    );

    // Background Color
    $wp_customize->add_section('background_colors', array (
        'title' => __('Background Color', 'mtwriter'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_background', array (
        'default' => $defaultColors['color_background'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_background',
        array(
            'label'      => __( 'Background Color', 'mtwriter' ),
            'section'    => 'background_colors',
        ) )
    );

    $wp_customize->add_setting('color_boxed_background', array (
        'default' => $defaultColors['color_boxed_background'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_boxed_background',
        array(
            'label'      => __( 'Boxed Background Color', 'mtwriter' ),
            'section'    => 'background_colors',
        ) )
    );

    // Menu Colors
    $wp_customize->add_section('menu_colors', array (
        'title' => __('Menu Color', 'mtwriter'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_menu', array (
        'default' => $defaultColors['color_menu'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_menu',
        array(
            'label'      => __( 'Menu Color', 'mtwriter' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_menu_hover', array (
        'default' => $defaultColors['color_menu_hover'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_menu_hover',
        array(
            'label'      => __( 'Menu Hover Color', 'mtwriter' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_menu_active', array (
        'default' => $defaultColors['color_menu_active'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_menu_active',
        array(
            'label'      => __( 'Menu Active Color', 'mtwriter' ),
            'section'    => 'menu_colors',
        ) )
    );

    // Dropdown Colors
    $wp_customize->add_setting('color_dropdown_background', array (
        'default' => $defaultColors['color_dropdown_background'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_dropdown_background',
        array(
            'label'      => __( 'Dropdown Background Color', 'mtwriter' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_dropdown_link', array (
        'default' => $defaultColors['color_dropdown_link'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_dropdown_link',
        array(
            'label'      => __( 'Dropdown Link Color', 'mtwriter' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_dropdown_activelink', array (
        'default' => $defaultColors['color_dropdown_activelink'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_dropdown_activelink',
        array(
            'label'      => __( 'Dropdown Active Link Color', 'mtwriter' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_link_hover', array (
        'default' => $defaultColors['color_link_hover'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_link_hover',
        array(
            'label'      => __( 'Dropdown Hover Link Color', 'mtwriter' ),
            'section'    => 'menu_colors',
        ) )
    );

    // Copyright's Colors
    $wp_customize->add_section('copyright_colors', array (
        'title' => __('Copyright Color', 'mtwriter'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_copyright', array (
        'default' => $defaultColors['color_copyright'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_copyright',
        array(
            'label'      => __( 'Copyright Color', 'mtwriter' ),
            'section'    => 'copyright_colors',
        ) )
    );
    
    $wp_customize->add_setting('color_copyright_link', array (
        'default' => $defaultColors['color_copyright_link'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_copyright_link',
        array(
            'label'      => __( 'Copyright Link Color', 'mtwriter' ),
            'section'    => 'copyright_colors',
        ) )
    );
    // Link hover
    $wp_customize->add_setting('color_copyright_linkhover', array (
        'default' => $defaultColors['color_copyright_linkhover'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_copyright_linkhover',
        array(
            'label'      => __( 'Copyright Link Hover Color', 'mtwriter' ),
            'section'    => 'copyright_colors',
        ) )
    );

    //
    // ─── TYPOGRAPHY MANAGEMENT ──────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('typography_mgt', array (
        'title' => __( 'Typography Management', 'mtwriter' ),
    ));

    // Body Typography Management
    $wp_customize->add_section('body_typography', array (
        'title' => __('Body', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Body',
        'panel' => 'typography_mgt',
    ));

    $wp_customize->add_setting('body_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['body_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'body_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'body_fontsize', array(
        'default' => $defaultFonts['body_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'body_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['body_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('body_fontsize_unit', array (
        'default' => $defaultFonts['body_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'body_fontsize_unit', array(
        'section' => 'body_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('body_texttransform', array (
        'default' => $defaultFonts['body_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'body_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('body_alt_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['body_alt_fontfamily'],
        'sanitize_callback' => 'mtwriter_sanitize_select',
    ));
    $wp_customize->add_control( 'body_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'body_letterspacing', array(
        'default' => $defaultFonts['body_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'body_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['body_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('body_fontweight', array (
        'default' => $defaultFonts['body_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'body_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'body_lineheight', array(
        'default' => $defaultFonts['body_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'body_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['body_lineheight'],
            ),
        )
    ));

    //
    // ──────────────────────────────────────────────────────────────────────────── I ──────────
    //   :::::: H E A D I N G   T Y P O G R A P H Y : :  :   :    :     :        :          :
    // ──────────────────────────────────────────────────────────────────────────────────────
    //

    $wp_customize->add_section('heading_typography', array (
        'title' => __('Headings', 'mtwriter'),
        'description' => 'Manage typography for H1 - h6',
        'panel' => 'typography_mgt',
    ));

    // Separator for H1 headings
    $wp_customize->add_setting( 'h1_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h1_separator',
        array(
            'label' => __( 'Heading 1', 'mtwriter' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 1 */
    $wp_customize->add_setting('h1_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h1_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h1_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h1_fontsize', array(
        'default' => $defaultFonts['h1_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h1_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 40,
            ),
        )
    ));

    $wp_customize->add_setting('h1_fontsize_unit', array (
        'default' => $defaultFonts['h1_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h1_texttransform', array (
        'default' => $defaultFonts['h1_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h1_alt_fontfamily', array (
        'default' => $defaultFonts['h1_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h1_letterspacing', array(
        'default' => $defaultFonts['h1_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h1_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h1_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h1_fontweight', array (
        'default' => $defaultFonts['h1_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h1_lineheight', array(
        'default' => $defaultFonts['h1_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h1_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h1_lineheight'],
            ),
        )
    ));

    // Separator for H2 headings
    $wp_customize->add_setting( 'h2_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h2_separator',
        array(
            'label' => __( 'Heading 2', 'mtwriter' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 2 */
    $wp_customize->add_setting('h2_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h2_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h2_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h2_fontsize', array(
        'default' => $defaultFonts['h2_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h2_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h2_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h2_fontsize_unit', array (
        'default' => $defaultFonts['h2_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h2_texttransform', array (
        'default' => $defaultFonts['h2_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h2_alt_fontfamily', array (
        'default' => $defaultFonts['h2_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h2_letterspacing', array(
        'default' => $defaultFonts['h2_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h2_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h2_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h2_fontweight', array (
        'default' => $defaultFonts['h2_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h2_lineheight', array(
        'default' => $defaultFonts['h2_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h2_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h2_lineheight'],
            ),
        )
    ));

    // Separator for H3 headings
    $wp_customize->add_setting( 'h3_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h3_separator',
        array(
            'label' => __( 'Heading 3', 'mtwriter' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 3 */
    $wp_customize->add_setting('h3_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h3_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h3_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h3_fontsize', array(
        'default' => $defaultFonts['h3_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h3_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h3_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h3_fontsize_unit', array (
        'default' => $defaultFonts['h3_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h3_texttransform', array (
        'default' => $defaultFonts['h3_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h3_alt_fontfamily', array (
        'default' => $defaultFonts['h3_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h3_letterspacing', array(
        'default' => $defaultFonts['h3_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h3_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h3_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h3_fontweight', array (
        'default' => $defaultFonts['h3_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h3_lineheight', array(
        'default' => $defaultFonts['h3_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h3_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h3_lineheight'],
            ),
        )
    ));

    // Separator for H4 headings
    $wp_customize->add_setting( 'h4_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h4_separator',
        array(
            'label' => __( 'Heading 4', 'mtwriter' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 4 */
    $wp_customize->add_setting('h4_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h4_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h4_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h4_fontsize', array(
        'default' => $defaultFonts['h4_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h4_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h4_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h4_fontsize_unit', array (
        'default' => $defaultFonts['h4_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h4_texttransform', array (
        'default' => $defaultFonts['h4_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h4_alt_fontfamily', array (
        'default' => $defaultFonts['h4_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h4_letterspacing', array(
        'default' => $defaultFonts['h4_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h4_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h4_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h4_fontweight', array (
        'default' => $defaultFonts['h4_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h4_lineheight', array(
        'default' => $defaultFonts['h4_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h4_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h4_lineheight'],
            ),
        )
    ));

    // Separator for H5 headings
    $wp_customize->add_setting( 'h5_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h5_separator',
        array(
            'label' => __( 'Heading 5', 'mtwriter' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 4 */
    $wp_customize->add_setting('h5_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h5_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h5_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h5_fontsize', array(
        'default' => $defaultFonts['h5_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h5_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h5_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h5_fontsize_unit', array (
        'default' => $defaultFonts['h5_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h5_texttransform', array (
        'default' => $defaultFonts['h5_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h5_alt_fontfamily', array (
        'default' => $defaultFonts['h5_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h5_letterspacing', array(
        'default' => $defaultFonts['h5_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h5_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h5_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h5_fontweight', array (
        'default' => $defaultFonts['h5_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h5_lineheight', array(
        'default' => $defaultFonts['h5_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h5_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h5_lineheight'],
            ),
        )
    ));

    // Separator for H6 headings
    $wp_customize->add_setting( 'h6_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h6_separator',
        array(
            'label' => __( 'Heading 6', 'mtwriter' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 4 */
    $wp_customize->add_setting('h6_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h6_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h6_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h6_fontsize', array(
        'default' => $defaultFonts['h6_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h6_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h6_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h6_fontsize_unit', array (
        'default' => $defaultFonts['h6_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h6_texttransform', array (
        'default' => $defaultFonts['h6_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h6_alt_fontfamily', array (
        'default' => $defaultFonts['h6_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h6_letterspacing', array(
        'default' => $defaultFonts['h6_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h6_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h6_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h6_fontweight', array (
        'default' => $defaultFonts['h6_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h6_lineheight', array(
        'default' => $defaultFonts['h6_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize,
        'h6_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h6_lineheight'],
            ),
        )
    ));



    // Logo Typography Management
    $wp_customize->add_section('logo_typography', array (
        'title' => __('Logo', 'mtwriter'),
        'description' => 'Typography Management for your website\'s Logo',
        'panel' => 'typography_mgt',
    ));

    $wp_customize->add_setting('logo_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['logo_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'logo_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'logo_fontsize', array(
        'default' => $defaultFonts['logo_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'logo_fontsize',
        array(
            'label' => __( 'Logo Fontsize', 'mtwriter' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['logo_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('logo_fontsize_unit', array (
        'default' => $defaultFonts['logo_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_fontsize_unit', array (
        'section' => 'logo_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('logo_texttransform', array (
        'default' => $defaultFonts['logo_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('logo_alt_fontfamily', array (
        'default' => $defaultFonts['logo_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'logo_letterspacing', array(
        'default' => $defaultFonts['logo_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'logo_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['logo_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('logo_fontweight', array (
        'default' => $defaultFonts['logo_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'logo_lineheight', array(
        'default' => $defaultFonts['logo_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'logo_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['logo_lineheight'],
            ),
        )
    ));

    // Main Menu Typography Management
    $wp_customize->add_section('mainmenu_typography', array (
        'title' => __('Main Menu', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Main Menu',
        'panel' => 'typography_mgt',
    ));

    $wp_customize->add_setting('mainmenu_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['mainmenu_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'mainmenu_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'mainmenu_fontsize', array(
        'default' => $defaultFonts['mainmenu_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['mainmenu_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('mainmenu_fontsize_unit', array (
        'default' => $defaultFonts['mainmenu_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_fontsize_unit', array(
        'section' => 'mainmenu_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('mainmenu_texttransform', array (
        'default' => $defaultFonts['mainmenu_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('mainmenu_alt_fontfamily', array (
        'default' => $defaultFonts['mainmenu_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'mainmenu_letterspacing', array(
        'default' => $defaultFonts['mainmenu_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['mainmenu_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('mainmenu_fontweight', array (
        'default' => $defaultFonts['mainmenu_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'mainmenu_lineheight', array(
        'default' => $defaultFonts['mainmenu_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['mainmenu_lineheight'],
            ),
        )
    ));

    // Dropdown Menu Typography Management
    $wp_customize->add_section('dropdown_typography', array (
        'title' => __('Dropdown Menu', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Dropdown Menus',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('dropdown_fontfamily', array (
        'default' => $defaultFonts['dropdown_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'dropdown_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'dropdown_fontsize', array(
        'default' => $defaultFonts['dropdown_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['dropdown_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('dropdown_fontsize_unit', array (
        'default' => $defaultFonts['dropdown_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_fontsize_unit', array(
        'section' => 'dropdown_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('dropdown_texttransform', array (
        'default' => $defaultFonts['dropdown_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('dropdown_alt_fontfamily', array (
        'default' => $defaultFonts['dropdown_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'dropdown_letterspacing', array(
        'default' => $defaultFonts['dropdown_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['dropdown_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('dropdown_fontweight', array (
        'default' => $defaultFonts['dropdown_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'Normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'dropdown_lineheight', array(
        'default' => $defaultFonts['dropdown_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['dropdown_lineheight'],
            ),
        )
    ));

    // Entry Title Typography Management
    $wp_customize->add_section('entrytitle_typography', array (
        'title' => __('Entry Title', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Body',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('entrytitle_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['entrytitle_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'entrytitle_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'entrytitle_fontsize', array(
        'default' => $defaultFonts['entrytitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['entrytitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('entrytitle_fontsize_unit', array (
        'default' => $defaultFonts['entrytitle_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_fontsize_unit', array(
        'section' => 'entrytitle_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('entrytitle_texttransform', array (
        'default' => $defaultFonts['entrytitle_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('entrytitle_alt_fontfamily', array (
        'default' => $defaultFonts['entrytitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'entrytitle_letterspacing', array(
        'default' => $defaultFonts['entrytitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['entrytitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('entrytitle_fontweight', array (
        'default' => $defaultFonts['entrytitle_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'Normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'entrytitle_lineheight', array(
        'default' => $defaultFonts['entrytitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['entrytitle_lineheight'],
            ),
        )
    ));

    // Single Post Title Typography Management
    $wp_customize->add_section('posttitle_typography', array (
        'title' => __('Single Post Title', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Body',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('posttitle_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['posttitle_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'posttitle_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'posttitle_fontsize', array(
        'default' => $defaultFonts['posttitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['posttitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('posttitle_fontsize_unit', array (
        'default' => $defaultFonts['posttitle_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_fontsize_unit', array(
        'section' => 'posttitle_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('posttitle_texttransform', array (
        'default' => $defaultFonts['posttitle_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('posttitle_alt_fontfamily', array (
        'default' => $defaultFonts['posttitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'posttitle_letterspacing', array(
        'default' => $defaultFonts['posttitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['posttitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('posttitle_fontweight', array (
        'default' => $defaultFonts['posttitle_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => array (
            'Normal' => 'Normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'posttitle_lineheight', array(
        'default' => $defaultFonts['posttitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['posttitle_lineheight'],
            ),
        )
    ));

    // Meta Typography Management
    $wp_customize->add_section('meta_typography', array (
        'title' => __('Meta', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Body',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('meta_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['meta_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'meta_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'meta_fontsize', array(
        'default' => $defaultFonts['meta_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'meta_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['meta_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('meta_fontsize_unit', array (
        'default' => $defaultFonts['meta_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_fontsize_unit', array(
        'section' => 'meta_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('meta_texttransform', array (
        'default' => $defaultFonts['meta_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('meta_alt_fontfamily', array (
        'default' => $defaultFonts['meta_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'meta_letterspacing', array(
        'default' => $defaultFonts['meta_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'meta_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['meta_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('meta_fontweight', array (
        'default' => $defaultFonts['meta_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'meta_lineheight', array(
        'default' => $defaultFonts['meta_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'meta_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['meta_lineheight'],
            ),
        )
    ));

    // Widget Title Typography Management
    $wp_customize->add_section('widgettitle_typography', array (
        'title' => __('Widget Title', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Body',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('widgettitle_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['widgettitle_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'widgettitle_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'widgettitle_fontsize', array(
        'default' => $defaultFonts['widgettitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['widgettitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('widgettitle_fontsize_unit', array (
        'default' => $defaultFonts['widgettitle_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_fontsize_unit', array(
        'section' => 'widgettitle_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('widgettitle_texttransform', array (
        'default' => $defaultFonts['widgettitle_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('widgettitle_alt_fontfamily', array (
        'default' => $defaultFonts['widgettitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'widgettitle_letterspacing', array(
        'default' => $defaultFonts['widgettitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['widgettitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('widgettitle_fontweight', array (
        'default' => $defaultFonts['widgettitle_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'widgettitle_lineheight', array(
        'default' => $defaultFonts['widgettitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['widgettitle_lineheight'],
            ),
        )
    ));

    // Copyright Typography Management
    $wp_customize->add_section('copyright_typography', array (
        'title' => __('Copyright', 'mtwriter'),
        'description' => 'Manage fonts for your website\'s Body',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('copyright_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['copyright_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'copyright_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'copyright_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'copyright_fontsize', array(
        'default' => $defaultFonts['copyright_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'copyright_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'copyright_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['copyright_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('copyright_fontsize_unit', array (
        'default' => $defaultFonts['copyright_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'copyright_fontsize_unit', array(
        'section' => 'copyright_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('copyright_texttransform', array (
        'default' => $defaultFonts['copyright_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'copyright_texttransform', array (
        'label' => __('Text Transform', 'mtwriter'),
        'section' => 'copyright_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('copyright_alt_fontfamily', array (
        'default' => $defaultFonts['copyright_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'copyright_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'copyright_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'copyright_letterspacing', array(
        'default' => $defaultFonts['copyright_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'copyright_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'copyright_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['copyright_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('copyright_fontweight', array (
        'default' => $defaultFonts['copyright_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'copyright_fontweight', array (
        'label' => __('Font Weight', 'mtwriter'),
        'section' => 'copyright_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'copyright_lineheight', array(
        'default' => $defaultFonts['copyright_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'copyright_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'copyright_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['copyright_lineheight'],
            ),
        )
    ));

    //
    // ─── LAYOUT MANAGEMENT ──────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('layout_mgt', array(
        'title' => __( 'Layout Management', 'mtwriter' ),
    ));

    // Sidebar Position
    $wp_customize->add_section('sidebar_position', array (
        'title' => __('Sidebar Position', 'mtwriter'),
        'description' => 'Manage Sidebar Position for your site.',
        'panel' => 'layout_mgt',
    ));
    // Homepage Sidebar
    $wp_customize->add_setting('default_sidebar', array (
        'default' => $defaults['default_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'default_sidebar', array (
        'label' => __('Default Sidebar Position', 'mtwriter'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'none' => 'No Sidebar',
        ),
    ));

    // Single post sidebar
    $wp_customize->add_setting('singlepost_sidebar', array (
        'default' => $defaults['singlepost_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'singlepost_sidebar', array (
        'label' => __('Single Post Sidebar', 'mtwriter'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'default' => $defaults['singlepost_sidebar'],
        ),
    ));

    // Single page sidebar
    $wp_customize->add_setting('singlepage_sidebar', array (
        'default' => $defaults['singlepage_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'singlepage_sidebar', array (
        'label' => __('Single Page Sidebar', 'mtwriter'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'default' => $defaults['singlepage_sidebar'],
        ),
    ));

    // Archive sidebar
    $wp_customize->add_setting('archive_sidebar', array (
        'default' => $defaults['archive_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'archive_sidebar', array (
        'label' => __('Archive Sidebar', 'mtwriter'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'default' => $defaults['archive_sidebar'],
        ),
    ));

    // Sidebar Width
    $wp_customize->add_setting( 'sidebar_width', array(
        'default' => $defaults['sidebar_width'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'sidebar_width',
        array(
            'label' => __( 'Sidebar Width', 'mtwriter' ),
            'section' => 'sidebar_position',
            'input_attrs' => array(
                'min' => 200,
                'max' => 400,
                'step' => 1,
                'default' => $defaults['sidebar_width'],
            ),
        )
    ));

    //
    // ─── HEADER MANAGEMENT ──────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('header_mgt', array(
        'title' => __( 'Header Management', 'mtwriter' ),
    ));

    // Header Style
    $wp_customize->add_section('header_style', array (
        'title' => __('Header Style', 'mtwriter'),
        'description' => 'Manage Header Styles for your site.',
        'panel' => 'header_mgt',
    ));

    $wp_customize->add_setting( 'header_style',
        array(
            'default' => $defaults['header_style'],
            'transport' => 'refresh',
            'sanitize_callback' => 'mtwriter_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new MightyThemes_Image_Radio_Button_Custom_Control(
        $wp_customize,
        'header_style',
        array(
            'label' => __( 'Choose Header Style', 'mtwriter' ),
            'section' => 'header_style',
            'choices' => array(
                'stacked' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'inc/assets/images/controls/stacked.svg',
                    'name' => __( 'Stacked', 'mtwriter' )
                ),
                'horizontal' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'inc/assets/images/controls/horizontal.svg',
                    'name' => __( 'Horizontal', 'mtwriter' )
                ),                
            )
        )
    ));


    // Header Tagline
    $wp_customize->add_setting('header_tagline', array (
        'default' => $defaults['header_tagline'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'enable_header_tagline', array(
        'label' => __('Enable Tagline', 'mtwriter'),
        'section' => 'header_style',
        'type' => 'checkbox',
    ));

    // Enable/Disable search in header
    $wp_customize->add_setting( 'show_search', array(
        'default' => $defaults['show_search'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_search',
        array(
            'label' => __( 'Enable Search', 'mtwriter' ),
            'section' => 'header_style'
        )
    ));
    // Enable/Disable search in mobile view
    $wp_customize->add_setting( 'show_search_mobile', array(
        'default' => $defaults['show_search_mobile'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_search_mobile',
        array(
            'label' => __( 'Enable Search on Mobile', 'mtwriter' ),
            'section' => 'header_style'
        )
    ));

    //
    // ─── AD MANAGEMENT ──────────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('ad_mgt', array(
        'title' => __( 'Ad Management', 'mtwriter' ),
    ));

    // Enable/Disable Adverts
    $wp_customize->add_section('ad_appearance', array (
        'title' => __('Appearance', 'mtwriter'),
        'description' => 'Enable/Disable Ads on your site.',
        'panel' => 'ad_mgt',
    ));
    
    $wp_customize->add_setting( 'ads_posts', array(
        'default' => $defaults['ads_posts'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'ads_posts',
        array(
            'label' => __( 'Posts', 'mtwriter' ),
            'section' => 'ad_appearance'
        )
    ));

    $wp_customize->add_setting( 'ads_pages', array(
        'default' => $defaults['ads_pages'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'ads_pages',
        array(
            'label' => __( 'Pages', 'mtwriter' ),
            'section' => 'ad_appearance'
        )
    ));

    // Adverts on position
    $wp_customize->add_section('adverts_position', array (
        'title' => __('Assign Position', 'mtwriter'),
        'description' => 'Code for showing ad in the specified position.',
        'panel' => 'ad_mgt',
    ));
    // Adverts on Beginning of Post/Page
    $wp_customize->add_setting('ad_code_post_begin', array (
        'default' => $defaults['ad_code_post_begin'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_code_post_begin', array(
        'label' => __('Code of advert at the Beginning of Post/Page.', 'mtwriter'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on Middle of Post/Page
    $wp_customize->add_setting('ad_code_post_middle', array (
        'default' => $defaults['ad_code_post_middle'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_code_post_middle', array(
        'label' => __('Code of advert at the Middle of Post/Page.', 'mtwriter'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on End of Post/Page
    $wp_customize->add_setting('ad_code_post_end', array (
        'default' => $defaults['ad_code_post_end'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_code_post_end', array(
        'label' => __('Code of advert at the End of Post/Page.', 'mtwriter'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on Right before the last paragraph
    $wp_customize->add_setting('ad_before_last_paragraph', array (
        'default' => $defaults['ad_before_last_paragraph'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_before_last_paragraph', array(
        'label' => __('Code of advert before the last paragraph.', 'mtwriter'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on [number] paragraph
    $wp_customize->add_setting('paragraph_number', array (
        'default' => $defaults['paragraph_number'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control( 'paragraph_number', array(
        'label' => __('Paragraph Number', 'mtwriter'),
        'section' => 'adverts_position',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 200,
            'step' => 1,
        ),
    ));

    $wp_customize->add_setting('ad_after_numbered_paragraph', array (
        'default' => $defaults['ad_after_numbered_paragraph'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_after_numbered_paragraph', array(
        'label' => __('Code of advert after the [number] paragraph.', 'mtwriter'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));

    //
    // ─── MISCELLANEOUS ──────────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('misc', array(
        'title' => __( 'Miscellaneous', 'mtwriter' ),
    ));

    /* Pagination */
    $wp_customize->add_section('pagination', array (
        'title' => __('Pagination', 'mtwriter'),
        'panel' => 'misc',
    ));
    $wp_customize->add_setting('pagination_type', array (
        'default' => $defaults['pagination_type'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'pagination_type', array(
        'label' => __('Pagination Type', 'mtwriter'),
        'section' => 'pagination',
        'description' => 'Enable Pagination type',
        'type' => 'select',
        'choices' => array(
            'prev-next' => 'Prev/Next',
            'infinite-scroll' => 'Infinite Scroll',
            'numbered' => 'Numbered'
        )
    ));

    /* Single Post */
    $wp_customize->add_section('single_post', array (
        'title' => __('Single Post', 'mtwriter'),
        'panel' => 'misc',
    ));
    
    // Post-meta options
    $wp_customize->add_setting( 'show_author', array(
        'default' => $defaults['show_author'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_author',
        array(
            'label' => __( 'Show Author', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_readtime', array(
        'default' => $defaults['show_readtime'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_readtime',
        array(
            'label' => __( 'Enable Estimated Read Time', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_category', array(
        'default' => $defaults['show_category'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_category',
        array(
            'label' => __( 'Show Categories', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_tags', array(
        'default' => $defaults['show_tags'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_tags',
        array(
            'label' => __( 'Show Tags', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    // Enable/Disable Social Share Icon
    $wp_customize->add_setting( 'social_share_enable', array(
        'default' => $defaults['social_share_enable'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'social_share_enable',
        array(
            'label' => __( 'Enable Social Share Icons', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_authorinfobox', array(
        'default' => $defaults['show_authorinfobox'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_authorinfobox',
        array(
            'label' => __( 'Enable Author Info Box', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_comments', array(
        'default' => $defaults['show_comments'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_comments',
        array(
            'label' => __( 'Show Comments', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    // Enable/Disable Related Posts
    $wp_customize->add_setting( 'related_post_enable', array(
        'default' => $defaults['related_post_enable'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'related_post_enable',
        array(
            'label' => __( 'Enable Related Posts', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));
    // Related posts by control
    $wp_customize->add_setting('related_post_by', array (
        'default' => 'related_post_by',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'related_post_by', array(
        'label' => __('Related Posts By', 'mtwriter'),
        'section' => 'single_post',
        'type' => 'select',
        'choices' => array(
            'categories' => 'Categories',
            'tags' => 'Tags',
        )
    ));
    // Related posts count control
    $wp_customize->add_setting('related_post_count', array (
        'default' => $defaults['related_post_count'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control( 'related_post_count', array(
        'label' => __('Related Posts Count', 'mtwriter'),
        'section' => 'single_post',
        'type' => 'number',
    ));

    /* Archive */
    $wp_customize->add_section('archive', array (
        'title' => __('Archive', 'mtwriter'),
        'description' => '',
        'panel' => 'misc',
    ));

    $wp_customize->add_setting( 'estimated_read_time_archive', array(
        'default' => $defaults['estimated_read_time_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'estimated_read_time_archive',
        array(
            'label' => __( 'Show Read Time', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_author_archive', array(
        'default' => $defaults['show_author_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_author_archive',
        array(
            'label' => __( 'Show Author', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_category_archive', array(
        'default' => $defaults['show_category_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_category_archive',
        array(
            'label' => __( 'Show Categories', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_date_archive', array(
        'default' => $defaults['show_date_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_date_archive',
        array(
            'label' => __( 'Show Date', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_excerpt', array(
        'default' => $defaults['show_excerpt'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_excerpt',
        array(
            'label' => __( 'Show Excerpt', 'mtwriter' ),
            'section' => 'archive'
        )
    ));
    
    // Excerpt length (when enabled)
    $wp_customize->add_setting( 'excerpt_length', array(
        'default' => $defaults['excerpt_length'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'excerpt_length',
        array(
            'label' => __( 'Excerpt Length', 'mtwriter' ),
            'section' => 'archive',
            'input_attrs' => array(
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => $defaults['excerpt_length'],
            ),
        )
    ));

    // Enable Read more
    $wp_customize->add_setting( 'enable_read_more', array(
        'default' => $defaults['enable_read_more'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'enable_read_more',
        array(
            'label' => __( 'Enable Read More', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    // Read more text
    $wp_customize->add_setting('read_more_text', array (
        'default' => $defaults['read_more_text'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'read_more_text', array(
        'label' => __('Read More Text', 'mtwriter'),
        'section' => 'archive',
        'type' => 'text',
    ));
    
    /* 404 Error Page */
    $wp_customize->add_section('404_error_page', array (
        'title' => __('404 Error Page', 'mtwriter'),
        'description' => '',
        'panel' => 'misc',
    ));

    $wp_customize->add_setting('404_page_content', array (
        'default' => $defaults['404_page_content'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( '404_page_content', array(
        'label' => __('404 Page Content', 'mtwriter'),
        'section' => '404_error_page',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('calltoaction', array (
        'default' => $defaults['calltoaction'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'calltoaction', array(
        'label' => __('Call To Action', 'mtwriter'),
        'section' => '404_error_page',
        'type' => 'text'
    ));

    /* Footer Options */
    $wp_customize->add_section('footer_options', array (
        'title' => __('Footer', 'mtwriter'),
        'description' => '',
        'panel' => 'misc',
    ));
    
    // Copyright Text
    $wp_customize->add_setting('copyright_text', array (
        'default' => $defaults['copyright_text'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'copyright_text', array (
        'label' => __('Copyright Text', 'mtwriter'),
        'section' => 'footer_options',
        'type' => 'textarea',
    ));

    //
    // ─── SOCIAL PROFILES ────────────────────────────────────────────────────────────
    //

    // Social Profiles Section
    $wp_customize->add_section( 'social_profiles', array(
        'title' => __('Social Profiles', 'mtwriter'),
        'description' => '',
    ));

    // Social Profiles Controls
    $wp_customize->add_setting('facebook', array (
        'default' => $defaults['facebook'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'facebook', array(
        'label' => __('Facebook', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('twitter', array (
        'default' => $defaults['twitter'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'twitter', array(
        'label' => __('Twitter', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('instagram', array (
        'default' => $defaults['instagram'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'instagram', array(
        'label' => __('Instagram', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('youtube', array (
        'default' => $defaults['youtube'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'youtube', array(
        'label' => __('YouTube', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('linkedin', array (
        'default' => $defaults['linkedin'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'linkedin', array(
        'label' => __('LinkedIn', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('spotify', array (
        'default' => $defaults['spotify'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'spotify', array(
        'label' => __('Spotify', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('messenger', array (
        'default' => $defaults['messenger'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'messenger', array(
        'label' => __('Messenger', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('github', array (
        'default' => $defaults['github'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'github', array(
        'label' => __('GitHub', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('whatsapp', array (
        'default' => $defaults['whatsapp'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'whatsapp', array(
        'label' => __('WhatsApp', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('telegram', array (
        'default' => $defaults['telegram'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'telegram', array(
        'label' => __('Telegram', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));

    //
    // ─── CUSTOM CODE ────────────────────────────────────────────────────────────
    //
    // Custom Code Section
    $wp_customize->add_section( 'custom_code', array(
        'title' => __('Custom Code', 'mtwriter'),
        'description' => '',
    ));

    // Custom Code Controls
    $wp_customize->add_setting('tracking_code', array (
        'default' => $defaults['tracking_code'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'tracking_code', array(
        'label' => __('Tracking Code', 'mtwriter'),
        'section' => 'custom_code',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('space_before_head', array (
        'default' => $defaults['space_before_head'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'space_before_head', array(
        'label' => __('Space Before </head>', 'mtwriter'),
        'section' => 'custom_code',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('space_before_body', array (
        'default' => $defaults['space_before_body'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( 'space_before_body', array(
        'label' => __('Space Before </body>', 'mtwriter'),
        'section' => 'custom_code',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'mtwriter_customize_register');

//
// ─── LIVE PREVIEW WITH INSTANTNEOUS CHANGES ─────────────────────────────────────
//
function mtwriter_preview_customizer() {
	wp_enqueue_script('mtwriter_preview_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'jquery','customize-preview' ), '', true	);
}
add_action( 'customize_preview_init', 'mtwriter_preview_customizer' );

//
// ─── CONTROLS MANIPULATION ON CONDITIONS ────────────────────────────────────────
//
function mtwriter_panels_js() {
	wp_enqueue_script( 'mtwriter-customize-controls', get_theme_file_uri( '/inc/customizer/js/customize-controls.js' ), array(), '20181231', true );
}
add_action( 'customize_controls_enqueue_scripts', 'mtwriter_panels_js' );

//
// ─── FONT FAMILY OF ELEMENTS ────────────────────────────────────────────────────
//
function add_font_styles()
{
    /* Body Font */
    $body_font = esc_html( get_theme_mod( 'body_fontfamily' ) );
    if ( $body_font ) {
        wp_enqueue_style( 'body-font', '//fonts.googleapis.com/css?family=' . $body_font );
    }

    /* Headings Font */
    $h1_font = esc_html( get_theme_mod( 'h1_fontfamily' ) );
    if ( $h1_font ) {
        wp_enqueue_style( 'heading1-font', '//fonts.googleapis.com/css?family=' . $h1_font );
    }

    $h2_font = esc_html( get_theme_mod( 'h2_fontfamily' ) );
    if ( $h2_font ) {
        wp_enqueue_style( 'heading2-font', '//fonts.googleapis.com/css?family=' . $h2_font );
    }

    $h3_font = esc_html( get_theme_mod( 'h3_fontfamily' ) );
    if ( $h3_font ) {
        wp_enqueue_style( 'heading3-font', '//fonts.googleapis.com/css?family=' . $h3_font );
    }

    $h4_font = esc_html( get_theme_mod( 'h4_fontfamily' ) );
    if ( $h4_font ) {
        wp_enqueue_style( 'heading4-font', '//fonts.googleapis.com/css?family=' . $h4_font );
    }

    $h5_font = esc_html( get_theme_mod( 'h5_fontfamily' ) );
    if ( $h5_font ) {
        wp_enqueue_style( 'heading5-font', '//fonts.googleapis.com/css?family=' . $h5_font );
    }

    $h6_font = esc_html( get_theme_mod( 'h6_fontfamily' ) );
    if ( $h6_font ) {
        wp_enqueue_style( 'heading6-font', '//fonts.googleapis.com/css?family=' . $h6_font );
    }

    /* Logo Font */
    $logo_font = esc_html( get_theme_mod( 'logo_fontfamily' ) );
    if ( $logo_font ) {
        wp_enqueue_style( 'logo-font', '//fonts.googleapis.com/css?family=' . $logo_font );
    }

    /* MainMenu Font */
    $mainmenu_font = esc_html( get_theme_mod( 'mainmenu_fontfamily' ) );
    if ( $mainmenu_font ) {
        wp_enqueue_style( 'mainmenu-font', '//fonts.googleapis.com/css?family=' . $mainmenu_font );
    }

    /* Entry Title Font */
    $entrytitle_font = esc_html( get_theme_mod( 'entrytitle_fontfamily' ) );
    if ( $entrytitle_font ) {
        wp_enqueue_style( 'entrytitle-font', '//fonts.googleapis.com/css?family=' . $entrytitle_font );
    }

    /* Single Post Title Font */
    $posttitle_font = esc_html( get_theme_mod( 'posttitle_fontfamily' ) );
    if ( $posttitle_font ) {
        wp_enqueue_style( 'posttitle-font', '//fonts.googleapis.com/css?family=' . $posttitle_font );
    }

    /* Meta Font */
    $meta_font = esc_html( get_theme_mod( 'meta_fontfamily' ) );
    if ( $meta_font ) {
        wp_enqueue_style( 'meta-font', '//fonts.googleapis.com/css?family=' . $meta_font );
    }

    /* Footer Font */
    $footertitle_font = esc_html( get_theme_mod( 'footertitle_fontfamily' ) );
    if ( $footertitle_font ) {
        wp_enqueue_style( 'footertitle-font', '//fonts.googleapis.com/css?family=' . $footertitle_font );
    }

    /* Copyright Font */
    $copyright_font = esc_html( get_theme_mod( 'copyright_fontfamily' ) );
    if ( $copyright_font ) {
        wp_enqueue_style( 'copyright-font', '//fonts.googleapis.com/css?family=' . $copyright_font );
    }

    /* Widget Title Font */
    $widgettitle_font = esc_html( get_theme_mod( 'widgettitle_fontfamily' ) );
    if ( $widgettitle_font ) {
        wp_enqueue_style( 'widgettitle-font', '//fonts.googleapis.com/css?family=' . $widgettitle_font );
    }

    /* Dropdown Font */
    $dropdown_font = esc_html( get_theme_mod( 'dropdown_fontfamily' ) );
    if ( $dropdown_font ) {
        wp_enqueue_style( 'dropdown-font', '//fonts.googleapis.com/css?family=' . $dropdown_font );
    }

}
add_action('wp_enqueue_scripts', 'add_font_styles');