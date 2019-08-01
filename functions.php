<?php
/**
 * MT Writer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MT_Writer
 */

if ( ! function_exists( 'mtwriter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mtwriter_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'mtwriter' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mtwriter_custom_background_args', array(
			'default-color' => esc_html(get_theme_mod('color_background', '#ebeff5')),
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'flex-width'  => true,
		) );
		
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		
	}
endif;
add_action( 'after_setup_theme', 'mtwriter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mtwriter_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mtwriter_content_width', 640 );
}
add_action( 'after_setup_theme', 'mtwriter_content_width', 0 );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return get_theme_mod( 'excerpt_length', 30);
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function mtwriter_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'mtwriter_skip_link_focus_fix' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mtwriter_widgets_init() {
    // Widgets for right sidebar
    register_sidebar(
		array(
			'name'          => __( 'Sidebar Right', 'mtwriter' ),
			'id'            => 'sidebar-right',
			'description'   => __( 'Add widgets here to appear in right sidebar.', 'mtwriter' ),
			'before_widget' => '<section class="widget"><div class="widget-content"><div class="widget-content-inner">',
			'after_widget'  => '</div></div></section>',
			'before_title'  => '<div class="sidebar-heading-wrapper"><h4 class="widget-title sidebar-heading">',
			'after_title'   => '</h4></div>',
		)
    );
    
    // Widgets for left sidebar
    register_sidebar(
		array(
			'name'          => __( 'Sidebar Left', 'mtwriter' ),
			'id'            => 'sidebar-left',
			'description'   => __( 'Add widgets here to appear in right sidebar.', 'mtwriter' ),
			'before_widget' => '<section class="widget"><div class="widget-content"><div class="widget-content-inner">',
			'after_widget'  => '</div></div></section>',
			'before_title'  => '<div class="sidebar-heading-wrapper"><h4 class="widget-title sidebar-heading">',
			'after_title'   => '</h4></div>',
		)
	);
}
add_action( 'widgets_init', 'mtwriter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mtwriter_scripts() {
	wp_enqueue_style( 'mtwriter-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'mtwriter-fontawesome', "//use.fontawesome.com/releases/v5.8.1/css/all.css?ver=5.2.2" );
	wp_enqueue_style( 'mtwriter-style', get_stylesheet_uri() );
	wp_enqueue_style( 'mtwriter-responsive', get_template_directory_uri() . '/css/responsive.css' );

	// Scripts
	wp_enqueue_script( 'mtwriter-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '20190719', true );
	wp_enqueue_script( 'mtwriter-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );

	wp_enqueue_script('mtwriter-main', get_template_directory_uri() . '/js/main.js', array('jquery'));
	
	if ( get_theme_mod('pagination_type', 'numbered') == 'infinite-scroll' ) :
		wp_enqueue_script( 'mtwriter-infinitescroll', get_template_directory_uri() . '/js/infinite-scroll.min.js', array(), '20151215', true );
	endif;	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mtwriter_scripts' );

/**
 * Famous Posts Custom Widget For MT-Writer
 */
require get_template_directory() . '/inc/customizer/custom/widget/mtwriter-popular-posts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * MightyThemes Custom Controls
 */
require get_template_directory() . '/inc/customizer/custom/controls/custom-controls.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Theme Customizer Defaults
 */
require get_template_directory() . '/inc/defaults.php';
$defaults = mt_get_defaults();
$defaultColors = mt_get_color_defaults();
$defaultFonts = mt_get_default_fonts();
	
/**
 * Functions to sanitize customizer controls
 */
require get_template_directory() . '/inc/sanitize-functions.php';

/**
 * Advertisement Manager
 */
require get_template_directory() . '/inc/customizer/ad-manager.php';

/**
 * Customizer Menu Options
 */
require get_template_directory() . '/inc/customizer/controls.php';

/**
 * Styles for Live Preview
 */
require get_template_directory() . '/inc/customizer/live-preview-css.php';

/*
 * Admin Level Scripts
 */
if ( is_admin() ) {
    //
    // ─── CUSTOM METABOXES FOR POST LEVEL EDITOR ─────────────────────────────────────
    //
    require get_template_directory() . '/inc/guten/custom-meta-boxes.php';
}

/**
 * Core Update Features
 */
require get_template_directory() . '/inc/mt-core/mt-checker.php';
$mtupdater = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/mightythemes/mt-writer/',
	__FILE__,
	'mtwriter'
);

$mtupdater->setBranch('master');