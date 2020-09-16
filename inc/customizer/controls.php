<?php
//
// ─── CUSTOMIZER CONTROLS ────────────────────────────────────────────────────────
//
function mtwriter_customize_register($wp_customize)
{
    // Google Web Fonts
    $mtwriterGoogleFonts = mtwriter_getGoogleFonts();

    // Defaults
    $mtwriterDefaults = mtwriter_get_defaults();
    $mtwriterDefaultColors = mtwriter_get_color_defaults();
    $mtwriterDefaultFonts = mtwriter_get_default_fonts();
    
    //
    // ─── CHECKING FOR CUSTOM SECTION AND CONTROLS STATUS ────────────────────────────
    //
    if ( method_exists( $wp_customize, 'register_section_type' ) ) {
        $wp_customize->register_section_type( 'MtWriter_Horizontal_Separator' );
    }

    $mtwriterAltFontFamily = array(
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

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    //
    // ─── SEPARATOR FOR MIGHTYTHEMES OPTIONS ─────────────────────────────────────────
    //
    $wp_customize->add_section(
        new MtWriter_Horizontal_Separator( $wp_customize, 'MtWriter_Horizontal_Separator-MT_options',
            array(
                'pro_text' => __( 'MT Writer Options', 'mtwriter' ),
                'type' => 'horizontal-separator',
                'priority' => 120,
            )
        )
    );

    // Enable/Disable Title and tagline fron site identity
    $wp_customize->add_setting('site_identity_status', array (
        'default' => $mtwriterDefaults['site_identity_status'],
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
        'default' => $mtwriterDefaults['preloader_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'preloader_status',
        array(
            'label' => __( 'Enable Preloader', 'mtwriter' ),
            'section' => 'preloader'
        )
    ));

    // Types of preloader
    $wp_customize->add_setting( 'preloader_type', array(
        'default' => $mtwriterDefaults['preloader_type'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));

    $wp_customize->add_control(
        new MtWriter_Preloaders_Custom_Control(
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
        'default' => $mtwriterDefaultColors['color_preloader'],
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
        'default' => $mtwriterDefaults['preloader_size'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'preloader_size',
        array(
            'label' => __( 'Preloader Size', 'mtwriter' ),
            'section' => 'preloader',
            'input_attrs' => array(
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => $mtwriterDefaults['preloader_size'],
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
        'default' => $mtwriterDefaults['backtotop_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'backtotop_status',
        array(
            'label' => __( 'Enable Back To Top', 'mtwriter' ),
            'section' => 'backtotop'
        )
    ));

    // Icons for Back to top
    $wp_customize->add_setting('backtotop_icon', array (
        'default' => $mtwriterDefaults['backtotop_icon'],
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
        'default' => $mtwriterDefaults['backtotop_size'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'backtotop_size',
        array(
            'label' => __( 'Back To Top Size', 'mtwriter' ),
            'section' => 'backtotop',
            'input_attrs' => array(
                'min' => 1,
                'max' => 200 ,
                'step' => 1,
                'default' => $mtwriterDefaults['backtotop_size'],
            ),
        )
    ));
    // Back to top font color
    $wp_customize->add_setting('backtotop_color', array (
        'default' => $mtwriterDefaultColors['backtotop_color'],
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
        'default' => $mtwriterDefaultColors['backtotop_bgcolor'],
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
        'default' => $mtwriterDefaults['backtotop_shape'],
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
        'default' => $mtwriterDefaults['backtotop_mobile'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
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
        'default' => $mtwriterDefaults['show_hero_area'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_hero_area',
        array(
            'label' => __( 'Show Hero Area', 'mtwriter' ),
            'section' => 'hero_area'
        )
    ));

    // Hero Area Title
    $wp_customize->add_setting('hero_title', array (
        'default' => $mtwriterDefaults['hero_title'],
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
        'default' => $mtwriterDefaults['hero_bio'],        
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
        'default' => $mtwriterDefaults['show_profile_pic'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_profile_pic',
        array(
            'label' => __( 'Show Display Picture', 'mtwriter' ),
            'section' => 'hero_area'
        )
    ));

    // Admin profile picture
    $wp_customize->add_setting('hero_profile_pic', array (
        'default' => $mtwriterDefaults['hero_profile_pic'],
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
        'default' => $mtwriterDefaults['show_hero_brands'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_hero_brands',
        array(
            'label' => __( 'Show Brands', 'mtwriter' ),
            'section' => 'hero_area'
        )
    ));

    // Brands
    $wp_customize->add_setting('brand_one', array (
        'default' => $mtwriterDefaults['brand_one'],
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
        'default' => $mtwriterDefaults['brand_two'],
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
        'default' => $mtwriterDefaults['brand_three'],
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
        'default' => $mtwriterDefaults['brand_four'],
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
        'default' => $mtwriterDefaults['brand_five'],
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
        'default' => $mtwriterDefaultColors['color_primary'],
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
        'default' => $mtwriterDefaultColors['color_site'],
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
        'default' => $mtwriterDefaultColors['color_logo_text'],
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
        'default' => $mtwriterDefaultColors['color_header_text'],
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
        'default' => $mtwriterDefaultColors['color_header_background'],
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
        'default' => $mtwriterDefaultColors['color_background'],
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
        'default' => $mtwriterDefaultColors['color_boxed_background'],
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
        'default' => $mtwriterDefaultColors['color_menu'],
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
        'default' => $mtwriterDefaultColors['color_menu_hover'],
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
        'default' => $mtwriterDefaultColors['color_menu_active'],
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
        'default' => $mtwriterDefaultColors['color_dropdown_background'],
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
        'default' => $mtwriterDefaultColors['color_dropdown_link'],
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
        'default' => $mtwriterDefaultColors['color_dropdown_activelink'],
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
        'default' => $mtwriterDefaultColors['color_link_hover'],
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
        'default' => $mtwriterDefaultColors['color_copyright'],
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
        'default' => $mtwriterDefaultColors['color_copyright_link'],
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
        'default' => $mtwriterDefaultColors['color_copyright_linkhover'],
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
        'default' => $mtwriterDefaultFonts['body_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'body_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'body_fontsize', array(
        'default' => $mtwriterDefaultFonts['body_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'body_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['body_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('body_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['body_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['body_texttransform'],
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
        'default' => $mtwriterDefaultFonts['body_alt_fontfamily'],
        'sanitize_callback' => 'mtwriter_sanitize_select',
    ));
    $wp_customize->add_control( 'body_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'body_letterspacing', array(
        'default' => $mtwriterDefaultFonts['body_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'body_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['body_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('body_fontweight', array (
        'default' => $mtwriterDefaultFonts['body_fontweight'],
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
        'default' => $mtwriterDefaultFonts['body_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'body_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['body_lineheight'],
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
        new MtWriter_Separator_Custom_Control( 
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
        'default' => $mtwriterDefaultFonts['h1_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h1_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'h1_fontsize', array(
        'default' => $mtwriterDefaultFonts['h1_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
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
        'default' => $mtwriterDefaultFonts['h1_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['h1_texttransform'],
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
        'default' => $mtwriterDefaultFonts['h1_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'h1_letterspacing', array(
        'default' => $mtwriterDefaultFonts['h1_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h1_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h1_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h1_fontweight', array (
        'default' => $mtwriterDefaultFonts['h1_fontweight'],
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
        'default' => $mtwriterDefaultFonts['h1_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h1_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h1_lineheight'],
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
        new MtWriter_Separator_Custom_Control( 
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
        'default' => $mtwriterDefaultFonts['h2_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h2_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'h2_fontsize', array(
        'default' => $mtwriterDefaultFonts['h2_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h2_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h2_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h2_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['h2_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['h2_texttransform'],
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
        'default' => $mtwriterDefaultFonts['h2_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'h2_letterspacing', array(
        'default' => $mtwriterDefaultFonts['h2_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h2_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h2_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h2_fontweight', array (
        'default' => $mtwriterDefaultFonts['h2_fontweight'],
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
        'default' => $mtwriterDefaultFonts['h2_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h2_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h2_lineheight'],
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
        new MtWriter_Separator_Custom_Control( 
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
        'default' => $mtwriterDefaultFonts['h3_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h3_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'h3_fontsize', array(
        'default' => $mtwriterDefaultFonts['h3_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h3_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h3_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h3_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['h3_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['h3_texttransform'],
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
        'default' => $mtwriterDefaultFonts['h3_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'h3_letterspacing', array(
        'default' => $mtwriterDefaultFonts['h3_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h3_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h3_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h3_fontweight', array (
        'default' => $mtwriterDefaultFonts['h3_fontweight'],
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
        'default' => $mtwriterDefaultFonts['h3_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h3_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h3_lineheight'],
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
        new MtWriter_Separator_Custom_Control( 
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
        'default' => $mtwriterDefaultFonts['h4_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h4_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'h4_fontsize', array(
        'default' => $mtwriterDefaultFonts['h4_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h4_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h4_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h4_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['h4_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['h4_texttransform'],
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
        'default' => $mtwriterDefaultFonts['h4_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'h4_letterspacing', array(
        'default' => $mtwriterDefaultFonts['h4_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h4_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h4_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h4_fontweight', array (
        'default' => $mtwriterDefaultFonts['h4_fontweight'],
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
        'default' => $mtwriterDefaultFonts['h4_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h4_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h4_lineheight'],
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
        new MtWriter_Separator_Custom_Control( 
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
        'default' => $mtwriterDefaultFonts['h5_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h5_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'h5_fontsize', array(
        'default' => $mtwriterDefaultFonts['h5_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h5_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h5_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h5_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['h5_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['h5_texttransform'],
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
        'default' => $mtwriterDefaultFonts['h5_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'h5_letterspacing', array(
        'default' => $mtwriterDefaultFonts['h5_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h5_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h5_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h5_fontweight', array (
        'default' => $mtwriterDefaultFonts['h5_fontweight'],
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
        'default' => $mtwriterDefaultFonts['h5_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h5_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h5_lineheight'],
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
        new MtWriter_Separator_Custom_Control( 
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
        'default' => $mtwriterDefaultFonts['h6_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h6_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'h6_fontsize', array(
        'default' => $mtwriterDefaultFonts['h6_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h6_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h6_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h6_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['h6_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['h6_texttransform'],
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
        'default' => $mtwriterDefaultFonts['h6_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'h6_letterspacing', array(
        'default' => $mtwriterDefaultFonts['h6_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'h6_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h6_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h6_fontweight', array (
        'default' => $mtwriterDefaultFonts['h6_fontweight'],
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
        'default' => $mtwriterDefaultFonts['h6_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize,
        'h6_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['h6_lineheight'],
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
        'default' => $mtwriterDefaultFonts['logo_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'logo_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'logo_fontsize', array(
        'default' => $mtwriterDefaultFonts['logo_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'logo_fontsize',
        array(
            'label' => __( 'Logo Fontsize', 'mtwriter' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['logo_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('logo_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['logo_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['logo_texttransform'],
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
        'default' => $mtwriterDefaultFonts['logo_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'logo_letterspacing', array(
        'default' => $mtwriterDefaultFonts['logo_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'logo_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['logo_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('logo_fontweight', array (
        'default' => $mtwriterDefaultFonts['logo_fontweight'],
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
        'default' => $mtwriterDefaultFonts['logo_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'logo_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['logo_lineheight'],
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
        'default' => $mtwriterDefaultFonts['mainmenu_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'mainmenu_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'mainmenu_fontsize', array(
        'default' => $mtwriterDefaultFonts['mainmenu_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['mainmenu_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('mainmenu_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['mainmenu_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['mainmenu_texttransform'],
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
        'default' => $mtwriterDefaultFonts['mainmenu_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'mainmenu_letterspacing', array(
        'default' => $mtwriterDefaultFonts['mainmenu_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['mainmenu_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('mainmenu_fontweight', array (
        'default' => $mtwriterDefaultFonts['mainmenu_fontweight'],
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
        'default' => $mtwriterDefaultFonts['mainmenu_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['mainmenu_lineheight'],
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
        'default' => $mtwriterDefaultFonts['dropdown_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'dropdown_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts,
    ));

    $wp_customize->add_setting( 'dropdown_fontsize', array(
        'default' => $mtwriterDefaultFonts['dropdown_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['dropdown_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('dropdown_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['dropdown_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['dropdown_texttransform'],
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
        'default' => $mtwriterDefaultFonts['dropdown_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'dropdown_letterspacing', array(
        'default' => $mtwriterDefaultFonts['dropdown_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['dropdown_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('dropdown_fontweight', array (
        'default' => $mtwriterDefaultFonts['dropdown_fontweight'],
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
        'default' => $mtwriterDefaultFonts['dropdown_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['dropdown_lineheight'],
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
        'default' => $mtwriterDefaultFonts['entrytitle_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'entrytitle_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts
    ));

    $wp_customize->add_setting( 'entrytitle_fontsize', array(
        'default' => $mtwriterDefaultFonts['entrytitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['entrytitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('entrytitle_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['entrytitle_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['entrytitle_texttransform'],
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
        'default' => $mtwriterDefaultFonts['entrytitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'entrytitle_letterspacing', array(
        'default' => $mtwriterDefaultFonts['entrytitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['entrytitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('entrytitle_fontweight', array (
        'default' => $mtwriterDefaultFonts['entrytitle_fontweight'],
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
        'default' => $mtwriterDefaultFonts['entrytitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['entrytitle_lineheight'],
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
        'default' => $mtwriterDefaultFonts['posttitle_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'posttitle_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts
    ));

    $wp_customize->add_setting( 'posttitle_fontsize', array(
        'default' => $mtwriterDefaultFonts['posttitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['posttitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('posttitle_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['posttitle_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['posttitle_texttransform'],
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
        'default' => $mtwriterDefaultFonts['posttitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'posttitle_letterspacing', array(
        'default' => $mtwriterDefaultFonts['posttitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['posttitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('posttitle_fontweight', array (
        'default' => $mtwriterDefaultFonts['posttitle_fontweight'],
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
        'default' => $mtwriterDefaultFonts['posttitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['posttitle_lineheight'],
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
        'default' => $mtwriterDefaultFonts['meta_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'meta_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts
    ));

    $wp_customize->add_setting( 'meta_fontsize', array(
        'default' => $mtwriterDefaultFonts['meta_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'meta_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['meta_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('meta_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['meta_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['meta_texttransform'],
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
        'default' => $mtwriterDefaultFonts['meta_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'meta_letterspacing', array(
        'default' => $mtwriterDefaultFonts['meta_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'meta_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['meta_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('meta_fontweight', array (
        'default' => $mtwriterDefaultFonts['meta_fontweight'],
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
        'default' => $mtwriterDefaultFonts['meta_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'meta_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['meta_lineheight'],
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
        'default' => $mtwriterDefaultFonts['widgettitle_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'widgettitle_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts
    ));

    $wp_customize->add_setting( 'widgettitle_fontsize', array(
        'default' => $mtwriterDefaultFonts['widgettitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['widgettitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('widgettitle_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['widgettitle_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['widgettitle_texttransform'],
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
        'default' => $mtwriterDefaultFonts['widgettitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'widgettitle_letterspacing', array(
        'default' => $mtwriterDefaultFonts['widgettitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['widgettitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('widgettitle_fontweight', array (
        'default' => $mtwriterDefaultFonts['widgettitle_fontweight'],
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
        'default' => $mtwriterDefaultFonts['widgettitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['widgettitle_lineheight'],
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
        'default' => $mtwriterDefaultFonts['copyright_fontfamily'],
        'sanitize_callback' => 'mtwriter_custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'copyright_fontfamily', array (
        'label' => __('Font Family', 'mtwriter'),
        'section' => 'copyright_typography',
        'type' => 'select',
        'choices' => $mtwriterGoogleFonts
    ));

    $wp_customize->add_setting( 'copyright_fontsize', array(
        'default' => $mtwriterDefaultFonts['copyright_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'copyright_fontsize',
        array(
            'label' => __( 'Font Size', 'mtwriter' ),
            'section' => 'copyright_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['copyright_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('copyright_fontsize_unit', array (
        'default' => $mtwriterDefaultFonts['copyright_fontsize_unit'],
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
        'default' => $mtwriterDefaultFonts['copyright_texttransform'],
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
        'default' => $mtwriterDefaultFonts['copyright_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'copyright_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtwriter'),
        'section' => 'copyright_typography',
        'type' => 'select',
        'choices' => $mtwriterAltFontFamily,
    ));

    $wp_customize->add_setting( 'copyright_letterspacing', array(
        'default' => $mtwriterDefaultFonts['copyright_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'copyright_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtwriter' ),
            'section' => 'copyright_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['copyright_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('copyright_fontweight', array (
        'default' => $mtwriterDefaultFonts['copyright_fontweight'],
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
        'default' => $mtwriterDefaultFonts['copyright_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'copyright_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtwriter' ),
            'section' => 'copyright_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $mtwriterDefaultFonts['copyright_lineheight'],
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
        'default' => $mtwriterDefaults['default_sidebar'],
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
        'default' => $mtwriterDefaults['singlepost_sidebar'],
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
            'default' => $mtwriterDefaults['singlepost_sidebar'],
        ),
    ));

    // Single page sidebar
    $wp_customize->add_setting('singlepage_sidebar', array (
        'default' => $mtwriterDefaults['singlepage_sidebar'],
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
            'default' => $mtwriterDefaults['singlepage_sidebar'],
        ),
    ));

    // Archive sidebar
    $wp_customize->add_setting('archive_sidebar', array (
        'default' => $mtwriterDefaults['archive_sidebar'],
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
            'default' => $mtwriterDefaults['archive_sidebar'],
        ),
    ));

    // Sidebar Width
    $wp_customize->add_setting( 'sidebar_width', array(
        'default' => $mtwriterDefaults['sidebar_width'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'sidebar_width',
        array(
            'label' => __( 'Sidebar Width', 'mtwriter' ),
            'section' => 'sidebar_position',
            'input_attrs' => array(
                'min' => 200,
                'max' => 400,
                'step' => 1,
                'default' => $mtwriterDefaults['sidebar_width'],
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
            'default' => $mtwriterDefaults['header_style'],
            'transport' => 'refresh',
            'sanitize_callback' => 'mtwriter_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new MtWriter_Image_Radio_Button_Custom_Control(
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
        'default' => $mtwriterDefaults['header_tagline'],
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
        'default' => $mtwriterDefaults['show_search'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_search',
        array(
            'label' => __( 'Enable Search', 'mtwriter' ),
            'section' => 'header_style'
        )
    ));
    // Enable/Disable search in mobile view
    $wp_customize->add_setting( 'show_search_mobile', array(
        'default' => $mtwriterDefaults['show_search_mobile'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_search_mobile',
        array(
            'label' => __( 'Enable Search on Mobile', 'mtwriter' ),
            'section' => 'header_style'
        )
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
        'default' => $mtwriterDefaults['pagination_type'],
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
        'default' => $mtwriterDefaults['show_author'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_author',
        array(
            'label' => __( 'Show Author', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_readtime', array(
        'default' => $mtwriterDefaults['show_readtime'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_readtime',
        array(
            'label' => __( 'Show Estimated Read Time', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_date', array(
        'default' => $mtwriterDefaults['show_date'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_date',
        array(
            'label' => __( 'Show Date', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_category', array(
        'default' => $mtwriterDefaults['show_category'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_category',
        array(
            'label' => __( 'Show Categories', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_tags', array(
        'default' => $mtwriterDefaults['show_tags'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_tags',
        array(
            'label' => __( 'Show Tags', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    // Enable/Disable Social Share Icon

    $wp_customize->add_setting( 'show_authorinfobox', array(
        'default' => $mtwriterDefaults['show_authorinfobox'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_authorinfobox',
        array(
            'label' => __( 'Enable Author Info Box', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_comments', array(
        'default' => $mtwriterDefaults['show_comments'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_comments',
        array(
            'label' => __( 'Show Comments', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));

    // Enable/Disable Related Posts
    $wp_customize->add_setting( 'related_post_enable', array(
        'default' => $mtwriterDefaults['related_post_enable'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'related_post_enable',
        array(
            'label' => __( 'Enable Related Posts', 'mtwriter' ),
            'section' => 'single_post'
        )
    ));
    // Related posts by control
    $wp_customize->add_setting('related_post_by', array (
        'default' => $mtwriterDefaults['related_post_by'],
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
        'default' => $mtwriterDefaults['related_post_count'],
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
        'default' => $mtwriterDefaults['estimated_read_time_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'estimated_read_time_archive',
        array(
            'label' => __( 'Show Read Time', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_author_archive', array(
        'default' => $mtwriterDefaults['show_author_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_author_archive',
        array(
            'label' => __( 'Show Author', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_category_archive', array(
        'default' => $mtwriterDefaults['show_category_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_category_archive',
        array(
            'label' => __( 'Show Categories', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_date_archive', array(
        'default' => $mtwriterDefaults['show_date_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_date_archive',
        array(
            'label' => __( 'Show Date', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_excerpt', array(
        'default' => $mtwriterDefaults['show_excerpt'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_excerpt',
        array(
            'label' => __( 'Show Excerpt', 'mtwriter' ),
            'section' => 'archive'
        )
    ));
    
    // Excerpt length (when enabled)
    $wp_customize->add_setting( 'excerpt_length', array(
        'default' => $mtwriterDefaults['excerpt_length'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_number'
    ));
    $wp_customize->add_control(
        new MtWriter_Slider_Custom_Control( 
        $wp_customize, 
        'excerpt_length',
        array(
            'label' => __( 'Excerpt Length', 'mtwriter' ),
            'section' => 'archive',
            'input_attrs' => array(
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => $mtwriterDefaults['excerpt_length'],
            ),
        )
    ));

    // Enable Read more
    $wp_customize->add_setting( 'enable_read_more', array(
        'default' => $mtwriterDefaults['enable_read_more'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MtWriter_Toggle_Switch_Custom_control(
        $wp_customize,
        'enable_read_more',
        array(
            'label' => __( 'Enable Read More', 'mtwriter' ),
            'section' => 'archive'
        )
    ));

    // Read more text
    $wp_customize->add_setting('read_more_text', array (
        'default' => $mtwriterDefaults['read_more_text'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'read_more_text', array(
        'label' => __('Read More Text', 'mtwriter'),
        'section' => 'archive',
        'type' => 'text',
    ));
    
    // Post Date Type
    $wp_customize->add_setting('post_date_type', array (
        'default' => $mtwriterDefaults['post_date_type'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtwriter_sanitize_select'
    ));
    $wp_customize->add_control( 'post_date_type', array(
        'label' => __( 'Post Date Type', 'mtwriter' ),
        'section' => 'archive',
        'description' => 'Choose Published date or Updated date for archive.',
        'type' => 'select',
        'choices' => array(
            'published' => 'Published Date',
            'updated' => 'Updated Date',
        )
    ));
    
    /* 404 Error Page */
    $wp_customize->add_section('404_error_page', array (
        'title' => __('404 Error Page', 'mtwriter'),
        'description' => '',
        'panel' => 'misc',
    ));

    $wp_customize->add_setting('404_page_content', array (
        'default' => $mtwriterDefaults['404_page_content'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtwriter_sanitize_textarea'
    ));
    $wp_customize->add_control( '404_page_content', array(
        'label' => __('404 Page Content', 'mtwriter'),
        'section' => '404_error_page',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('calltoaction', array (
        'default' => $mtwriterDefaults['calltoaction'],
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
        'default' => $mtwriterDefaults['facebook'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'facebook', array(
        'label' => __('Facebook', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('twitter', array (
        'default' => $mtwriterDefaults['twitter'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'twitter', array(
        'label' => __('Twitter', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('instagram', array (
        'default' => $mtwriterDefaults['instagram'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'instagram', array(
        'label' => __('Instagram', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('youtube', array (
        'default' => $mtwriterDefaults['youtube'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'youtube', array(
        'label' => __('YouTube', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('linkedin', array (
        'default' => $mtwriterDefaults['linkedin'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'linkedin', array(
        'label' => __('LinkedIn', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('spotify', array (
        'default' => $mtwriterDefaults['spotify'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'spotify', array(
        'label' => __('Spotify', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('messenger', array (
        'default' => $mtwriterDefaults['messenger'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'messenger', array(
        'label' => __('Messenger', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('github', array (
        'default' => $mtwriterDefaults['github'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'github', array(
        'label' => __('GitHub', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('whatsapp', array (
        'default' => $mtwriterDefaults['whatsapp'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'whatsapp', array(
        'label' => __('WhatsApp', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('telegram', array (
        'default' => $mtwriterDefaults['telegram'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'telegram', array(
        'label' => __('Telegram', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('xing', array (
        'default' => $mtwriterDefaults['xing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'xing', array(
        'label' => __('Xing', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('email', array (
        'default' => $mtwriterDefaults['email'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'email', array(
        'label' => __('Email', 'mtwriter'),
        'section' => 'social_profiles',
        'type' => 'text'
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
function mtwriter_add_font_styles()
{
    $fontsRequested = array(
        get_theme_mod( 'body_fontfamily' ),
        get_theme_mod( 'h1_fontfamily' ),
        get_theme_mod( 'h2_fontfamily' ),
        get_theme_mod( 'h3_fontfamily' ),
        get_theme_mod( 'h4_fontfamily' ),
        get_theme_mod( 'h5_fontfamily' ),
        get_theme_mod( 'h6_fontfamily' ),
        get_theme_mod( 'logo_fontfamily' ),
        get_theme_mod( 'mainmenu_fontfamily' ),
        get_theme_mod( 'entrytitle_fontfamily' ),
        get_theme_mod( 'posttitle_fontfamily' ),
        get_theme_mod( 'meta_fontfamily' ),
        get_theme_mod( 'footertitle_fontfamily' ),
        get_theme_mod( 'copyright_fontfamily' ),
        get_theme_mod( 'widgettitle_fontfamily' ),
        get_theme_mod( 'dropdown_fontfamily' )
    );

    $fonts = implode("|", array_filter( array_unique( $fontsRequested)));
    if( !empty($fonts) ) {
        wp_enqueue_style( 'mtwriter-fonts', '//fonts.googleapis.com/css?family=' . $fonts );
    }
}
add_action('wp_enqueue_scripts', 'mtwriter_add_font_styles');