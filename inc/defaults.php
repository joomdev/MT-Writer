<?php
/**
 * Default values of Customizer options
 *
 * @package MT_Writer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'mt_get_defaults' ) ) {
	/**
	 * Set default options
	 */
	function mt_get_defaults() {
		return apply_filters( 'mt_option_defaults',
			array(
                'site_identity_status' => true,
                'preloader_status' => false,
                'preloader_type' => 'rotating-plane',
                'preloader_size' => 40,

                'backtotop_status' => false,
                'backtotop_icon' => 'fas fa-arrow-up',
                'backtotop_size' => 20,
                'backtotop_shape' => 'square',
                'backtotop_mobile' => false,

                'show_hero_area' => true,
                'hero_title' => '<h2>Hello, I’m <strong>Jane Doe</strong> </h2>',
                'hero_bio' => '<div>A <strong>creative content writer</strong> and a passionate blogger who loves marketing and technology. I can help you with copywriting, UI/UX design and grow your <strong class="bio-color">agency</strong> speedily.</div>',
                'show_profile_pic' => true,
                'hero_profile_pic' => '',
                'show_hero_brands' => true,
                'brand_one' => get_template_directory_uri() . '/inc/assets/images/medium.jpg',
                'brand_two' => get_template_directory_uri() . '/inc/assets/images/csstricks.png',
                'brand_three' => get_template_directory_uri() . '/inc/assets/images/forbes.jpg',
                'brand_four' => get_template_directory_uri() . '/inc/assets/images/smashing.png',
                'brand_five' => get_template_directory_uri() . '/inc/assets/images/tnw.png',

                'default_sidebar' => 'none',
                'singlepost_sidebar' => 'default',
                'singlepage_sidebar' => 'default',
                'archive_sidebar' => 'default',
                'sidebar_width' => '250',
                'header_style' => 'horizontal',
                'header_tagline' => false,
                'show_search' => true,
                'show_search_mobile' => true,
                'ads_posts' => false,
                'ads_pages' => false,
                'ad_code_post_begin' => '',
                'ad_code_post_middle' => '',
                'ad_code_post_end' => '',
                'ad_before_last_paragraph' => '',
                'paragraph_number' => '',
                'ad_after_numbered_paragraph' => '',
                'pagination_type' => 'numbered',
                'show_author' => true,
                'show_readtime' => true,
                'show_date' => true,
                'show_category' => true,
                'show_tags' => true,
                'social_share_enable' => true,
                'show_authorinfobox' => true,
                'show_comments' => true,
                'related_post_enable' => false,
                'related_post_by' => 'categories',
                'related_post_count' => '3',
                'estimated_read_time_archive' => true,
                'show_author_archive' => true,
                'show_category_archive' => true,
                'show_date_archive' => true,
                'show_excerpt' => true,
                'excerpt_length' => 30,
                'enable_read_more' => true,
                'read_more_text' => 'Read More',
                '404_page_content' => '<h1>404</h1>',
                'calltoaction' => 'Back To Home',
                'copyright_text' => 'Copyright © 2019, MT Writer. by <a href="https://www.mightythemes.com" target="_blank">Mighty Themes</a>',

                'facebook' => '#',
                'twitter' => '#',
                'instagram' => '#',
                'youtube' => '#',
                'linkedin' => '',
                'spotify' => '',
                'messenger' => '',
                'github' => '',
                'whatsapp' => '',
                'telegram' => '',

                'tracking_code' => '',
                'space_before_head' => '',
                'space_before_body' => ''
			)
		);
	}
}

if ( ! function_exists( 'mt_get_color_defaults' ) ) {
	/**
	 * Set default options
	 */
	function mt_get_color_defaults() {
		return apply_filters( 'mt_color_option_defaults',
			array(
                'color_preloader' => '#5A4692',
                'backtotop_color' => '#fff',
                'backtotop_bgcolor' => '#5A4692',

				'color_primary' => '#5A4692',
				'color_site' => '#252525',
				'color_logo_text' => '#FF4642',
				'color_header_text' => '#5A4692',
				'color_header_background' => '#ffffff',
                'color_background' => '#ebeff5',
                'color_boxed_background' => '#ffffff',
				'color_menu' => '#252525',
				'color_menu_hover' => '#5A4692',
				'color_menu_active' => '#5A4692',
				'color_dropdown_background' => '#fff',
				'color_dropdown_link' => '#050D26',
				'navigation_text_color' => '#ffffff',
				'color_dropdown_activelink' => '#5A4692',
				'color_link_hover' => '#5A4692',
				'color_copyright' => '#000',
				'color_copyright_link' => '#5A4692',
                'color_copyright_linkhover' => '#5A4692',
			)
		);
	}
}

if ( ! function_exists( 'mt_get_default_fonts' ) ) {
	/**
	 * Set default options.
	 *
	 * @since 0.1
	 *
	 * @param bool $filter Whether to return the filtered values or original values.
	 * @return array Option defaults.
	 */
	function mt_get_default_fonts( ) {
		$defaults = array(
			'body_fontfamily' => 'Roboto',
			'body_fontsize' => '16',
			'body_fontsize_unit' => 'px',
			'body_texttransform' => 'none',
			'body_alt_fontfamily' => 'Arial',
            'body_letterspacing' => '0',
            'body_fontweight' => 'normal',
            'body_lineheight' => '1.2', // no unit
            
            'h1_fontfamily' => 'Heebo',
			'h1_fontsize' => '40',
			'h1_fontsize_unit' => 'px',
			'h1_texttransform' => 'none',
			'h1_alt_fontfamily' => 'Arial',
            'h1_letterspacing' => '0',
            'h1_fontweight' => '700',
            'h1_lineheight' => '1.2', // no unit

            'h2_fontfamily' => 'Heebo',
			'h2_fontsize' => '32',
			'h2_fontsize_unit' => 'px',
			'h2_texttransform' => 'none',
			'h2_alt_fontfamily' => 'Arial',
            'h2_letterspacing' => '1',
            'h2_fontweight' => '700',
            'h2_lineheight' => '1.2', // no unit

            'h3_fontfamily' => 'Heebo',
			'h3_fontsize' => '32',
			'h3_fontsize_unit' => 'px',
			'h3_texttransform' => 'none',
			'h3_alt_fontfamily' => 'Arial',
            'h3_letterspacing' => '1',
            'h3_fontweight' => '700',
            'h3_lineheight' => '1.2', // no unit

            'h4_fontfamily' => 'Heebo',
			'h4_fontsize' => '24',
			'h4_fontsize_unit' => 'px',
			'h4_texttransform' => 'none',
			'h4_alt_fontfamily' => 'Arial',
            'h4_letterspacing' => '1',
            'h4_fontweight' => '700',
            'h4_lineheight' => '1.2', // no unit

            'h5_fontfamily' => 'Heebo',
			'h5_fontsize' => '20',
			'h5_fontsize_unit' => 'px',
			'h5_texttransform' => 'none',
			'h5_alt_fontfamily' => 'Arial',
            'h5_letterspacing' => '1',
            'h5_fontweight' => '700',
            'h5_lineheight' => '1.2', // no unit

            'h6_fontfamily' => 'Heebo',
			'h6_fontsize' => '16',
			'h6_fontsize_unit' => 'px',
			'h6_texttransform' => 'none',
			'h6_alt_fontfamily' => 'Arial',
            'h6_letterspacing' => '1',
            'h6_fontweight' => '700',
            'h6_lineheight' => '1.2', // no unit

            'logo_fontfamily' => 'Roboto',
			'logo_fontsize' => '20',
			'logo_fontsize_unit' => 'px',
			'logo_texttransform' => 'none',
			'logo_alt_fontfamily' => 'Arial',
            'logo_letterspacing' => '0',
            'logo_fontweight' => 'normal',
            'logo_lineheight' => '0', // no unit

            'mainmenu_fontfamily' => 'Roboto',
			'mainmenu_fontsize' => '16',
			'mainmenu_fontsize_unit' => 'px',
			'mainmenu_texttransform' => 'none',
			'mainmenu_alt_fontfamily' => 'Arial',
            'mainmenu_letterspacing' => '0',
            'mainmenu_fontweight' => 'normal',
            'mainmenu_lineheight' => '1.2', // no unit

            'dropdown_fontfamily' => 'Roboto',
			'dropdown_fontsize' => '16',
			'dropdown_fontsize_unit' => 'px',
			'dropdown_texttransform' => 'none',
			'dropdown_alt_fontfamily' => 'Arial',
            'dropdown_letterspacing' => '0',
            'dropdown_fontweight' => 'normal',
            'dropdown_lineheight' => '1.2', // no unit

            'entrytitle_fontfamily' => 'Roboto',
			'entrytitle_fontsize' => '20',
			'entrytitle_fontsize_unit' => 'px',
			'entrytitle_texttransform' => 'none',
			'entrytitle_alt_fontfamily' => 'Arial',
            'entrytitle_letterspacing' => '1',
            'entrytitle_fontweight' => '600',
            'entrytitle_lineheight' => '1.2', // no unit

            'posttitle_fontfamily' => 'Roboto',
			'posttitle_fontsize' => '32',
			'posttitle_fontsize_unit' => 'px',
			'posttitle_texttransform' => 'none',
			'posttitle_alt_fontfamily' => 'Arial',
            'posttitle_letterspacing' => '1',
            'posttitle_fontweight' => '700',
            'posttitle_lineheight' => '1.2', // no unit

            'meta_fontfamily' => 'Roboto',
			'meta_fontsize' => '12',
			'meta_fontsize_unit' => 'px',
			'meta_texttransform' => 'none',
			'meta_alt_fontfamily' => 'Arial',
            'meta_letterspacing' => '1',
            'meta_fontweight' => '600',
            'meta_lineheight' => '1.2', // no unit

            'widgettitle_fontfamily' => 'Roboto',
			'widgettitle_fontsize' => '16',
			'widgettitle_fontsize_unit' => 'px',
			'widgettitle_texttransform' => 'none',
			'widgettitle_alt_fontfamily' => 'Arial',
            'widgettitle_letterspacing' => '0',
            'widgettitle_fontweight' => '500',
            'widgettitle_lineheight' => '1.2', // no unit
            
            'copyright_fontfamily' => 'Roboto',
			'copyright_fontsize' => '16',
			'copyright_fontsize_unit' => 'px',
			'copyright_texttransform' => 'none',
			'copyright_alt_fontfamily' => 'Arial',
            'copyright_letterspacing' => '0',
            'copyright_fontweight' => 'normal',
            'copyright_lineheight' => '1.2', // no unit
		);

		return $defaults;
	}
}


if ( ! function_exists( 'getValue' ) ) {
    /**
	 * Get customizer values if set else return default values
	 */

    function getOption($type, $property) {

        $defaults = mt_get_defaults();
        $defaultColors = mt_get_color_defaults();
        $defaultFonts = mt_get_default_fonts();

        switch( $type ) {
            case 'defaults': echo get_theme_mod( $property, $defaults[$property] );
            break;
            case 'color': echo esc_html( get_theme_mod( $property, $defaultColors[$property] ) );
            break;
            case 'fonts': echo esc_html( get_theme_mod( $property, $defaultFonts[$property] ) );
            break;
            default: echo "<b>Notice: <big>" . $type . '</big></b> Property not found.';
        }

    }
}
