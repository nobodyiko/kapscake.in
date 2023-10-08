<?php
/**
 * thim functions and definitions
 *
 * @package thim
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
update_site_option( 'thim_core_product_registration_themes', [ 'sailing' => [ 'site_key' => '********' ] ] );

define( 'TP_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'TP_THEME_URI', trailingslashit( get_template_directory_uri() ) ); 
define( 'TP_THEME_VERSION', '4.2.9.129' );

if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'thim_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thim, use a find and replace
		 * to change 'sailing' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'sailing', get_stylesheet_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'thim-core' );
//		add_theme_support( 'sailing-demo-data' );
		add_filter( 'thim_prefix_folder_download_data_demo', function () { 
			return 'sailing';
		} );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'sailing' ),
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

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio'
		) );

		add_theme_support( "title-tag" );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thim_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Support Gutenberg
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'editor-styles' );

		add_editor_style( 'style-editor.css' );

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Primary Color', 'sailing' ),
				'slug'  => 'primary',
				'color' => get_theme_mod( 'thim_body_primary_color', '#2eb0d1' ),
			),
			array(
				'name'  => esc_html__( 'Title Color', 'sailing' ),
				'slug'  => 'title',
				'color' => get_theme_mod( 'thim_font_title_color', '#2a2a2a' ),
			),
			array(
				'name'  => esc_html__( 'Sub Title Color', 'sailing' ),
				'slug'  => 'sub-title',
				'color' => '#666666',
			),
			array(
				'name'  => esc_html__( 'Border Color', 'sailing' ),
				'slug'  => 'border-input',
				'color' => '#dddddd',
			),
		) );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'sailing' ),
					'shortName' => __( 'S', 'sailing' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'sailing' ),
					'shortName' => __( 'M', 'sailing' ),
					'size'      => 15,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'sailing' ),
					'shortName' => __( 'L', 'sailing' ),
					'size'      => 28,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'sailing' ),
					'shortName' => __( 'XL', 'sailing' ),
					'size'      => 36,
					'slug'      => 'huge',
				),
			)
		);
		// don't enqueue file css when save customizer
		add_filter( 'thim_core_enqueue_file_css_customizer', '__return_false' );
		// remove wp_global_styles_render_svg_filters
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	}

endif;
add_action( 'after_setup_theme', 'thim_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

function thim_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sailing' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toolbar', 'sailing' ),
		'id'            => 'toolbar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	if ( get_theme_mod( 'thim_header_style' ) == 'header_v2' ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Logo Left', 'sailing' ),
			'id'            => 'logo_left',
			'description'   => 'Display widgets in left of logo, using with header layout 02',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Logo Right', 'sailing' ),
			'id'            => 'logo_right',
			'description'   => 'Display widgets in right of logo, using with header layout 02',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	} else {
		register_sidebar( array(
			'name'          => 'Menu Left',
			'id'            => 'menu_left',
			'description'   => esc_html__( 'Menu Left', 'sailing' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => 'Menu Right',
			'id'            => 'menu_right',
			'description'   => esc_html__( 'Menu Right', 'sailing' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
	}

	if ( class_exists( 'WP_Hotel_Booking' ) || class_exists( 'TP_Hotel_Booking' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Rooms Sidebar', 'sailing' ),
			'id'            => 'sidebar_hotel',
			'description'   => esc_html__( 'Sidebar Of Rooms', 'sailing' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Search Rooms Sidebar', 'sailing' ),
			'id'            => 'search_sidebar_hotel',
			'description'   => esc_html__( 'Sidebar Of Room Search Page', 'sailing' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	if ( class_exists( 'WPEMS' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Events', 'sailing' ),
			'id'            => 'sidebar_events',
			'description'   => esc_html__( 'Sidebar Events', 'sailing' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Offcanvas Sidebar', 'sailing' ),
		'id'            => 'offcanvas_sidebar',
		'description'   => 'Offcanvas Sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Main Bottom', 'sailing' ),
		'id'            => 'main-bottom',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'sailing' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'sailing' ),
		'id'            => 'footer_copyright',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'thim_widgets_init' );

if ( ! function_exists( 'thim_get_option_var_css' ) ) :
	function thim_get_option_var_css() {
		$css           = '';
		$theme_options = array(

			// hearder
			'thim_body_primary_color'                => '#ffb606',
			'thim_body_bg_color'                     => '#fff',
			'thim_body_border_color'				 => '#eeeeee',

			// Thim Logo
			'thim_width_logo'                        => '155px',
			'thim_body_container'        		     => '1200px',
			// Thim ToolBar
			'thim_color_toolbar'                     => '#ffffff',
			'thim_color_toolbar_hover'               => '#4e9db5',
			'thim_font_size_top_header'              => array(
 				'font-size'   => '13px',
			),
			//header
			'thim_header_bg_color'                   => 'rgba(255, 255, 255, 0)',
			'thim_header_text_color'                 => '#fff',
			'thim_header_text_color_hover'           => '#2eb0d1',
			'thim_header_typography'                 => array(
				'font-family' => 'Roboto',
				'variant'     => '700',
				'font-size'   => '13px',
			),
			// Main Menu
			'thim_bg_main_menu_color'                => 'rgba(255,255,255,0)',
			'thim_main_menu'                         => array(
				'font-family'    => 'Roboto',
				'variant'        => '700',
				'font-size'      => '13px',
				'line-height'    => '1.3em',
				'text-transform' => 'uppercase',
			),
			'thim_main_menu_text_color'              => '#ffffff',
			'thim_main_menu_text_hover_color'        => '#2eb0d1',
			// Sticky Menu
			'thim_sticky_bg_main_menu_color'         => '#fff',
			'thim_sticky_main_menu_text_color'       => '#2a2a2a',
			'thim_sticky_main_menu_text_hover_color' => '#2eb0d1',
			// Sub Menu
			'thim_sub_menu_bg_color'                 => '#fff',
			'thim_sub_menu_border_color'             => 'rgba(43,43,43,0)',
			'thim_sub_menu_text_color'               => '#999',
			'thim_sub_menu_text_color_hover'         => '#333',

			// Mobile Menu
			'thim_bg_mobile_menu_color'              => '#ffffff',
			'thim_mobile_menu_text_color'            => '#d8d8d8',
			'thim_mobile_menu_text_hover_color'      => '#2eb0d1',
			'thim_icon_mobile_menu_color_background' => '#fff',

			//offcanvas
			'thim_bg_offcanvas_color'                => '#141414',
			'thim_offcanvas_text_color'              => '#a9a9a9',
			'thim_offcanvas_link_color'              => '#fff',

			'thim_font_body'       => array(
				'font-family' => 'Roboto',
				'variant'     => '400',
				'font-size'   => '15px',
				'line-height' => '1.7em',
				'color'       => '#666666',
			),
			'thim_font_title'      => array(
				'font-family' => 'Roboto Slab',
				'color'       => '#333333',
				'variant'     => '700',
			),
			'thim_font_h1'         => array(
				'font-size'      => '36px',
				'line-height'    => '1.6em',
				'text-transform' => 'none',
			),
			'thim_font_h2'         => array(
				'font-size'      => '28px',
				'line-height'    => '1.6em',
				'text-transform' => 'none',
			),
			'thim_font_h3'         => array(
				'font-size'      => '24px',
				'line-height'    => '1.6em',
				'text-transform' => 'none',
			),
			'thim_font_h4'         => array(
				'font-size'      => '18px',
				'line-height'    => '1.6em',
				'text-transform' => 'none',
			),
			'thim_font_h5'         => array(
				'font-size'      => '16px',
				'line-height'    => '1.6em',
				'text-transform' => 'none',
			),
			'thim_font_h6'         => array(
				'font-size'      => '16px',
				'line-height'    => '1.4em',
				'text-transform' => 'none',
			),
			'thim_preload_bg_color' => '#fff',
			'thim_page_title_top_image' 		 	=> TP_THEME_URI . 'assets/images/bg-blog.jpg',
			'thim_page_title_heading_bg_color' 	 	=> '#000',
			'thim_page_title_heading_text_color' 	=> '#fff',

			'thim_hb_single_top_content_bg'  	=> '#FFF4EC',
			'thim_hb_single_top_content_color'  => '#000000',

			'thim_footer_bg_color' => '#111',
			//		'thim_footer_background_img' => '',
			'thim_footer_color'    => array(
				'text' => '#2a2a2a',
				'link' => '#2a2a2a',
				'line' => '#eeeeee',
			),

			'thim_copyright_text_color' => '#5a5a5a',
			'thim_copyright_link_color' => '#5a5a5a',

			'thim_bg_pattern'        => TP_THEME_URI . 'images/patterns/pattern1.png',
			'thim_bg_pattern_upload' => '',
			'thim_bg_repeat'         => 'no-repeat',
			'thim_bg_position'       => 'center',
			'thim_bg_attachment'     => 'inherit',
			'thim_bg_size'           => 'inherit',

		);
		foreach ( $theme_options as $key => $val ) {
			$val_opt = thim_get_theme_option( $key, $val );
			if ( is_array( $val_opt ) ) {
				// get options default
				foreach ( $val as $attr => $value ) {
					$val_ar = isset( $val_opt[$attr] ) ? $val_opt[$attr] : $value;
					if ( $val_ar != '' ) {
						$css    .= '--' . $key . '-' . $attr . ':' . $val_ar . ';';
					}
				}
			} else {
				if ( $val_opt != '' ) {
					if ( in_array( $key, array( 'thim_bg_pattern', 'thim_bg_pattern_upload' ) ) ) {
						$val_opt = 'url("' . $val_opt . '")';
					}
					$css .= '--' . $key . ':' . $val_opt . ';';
					// convert primary color to rga
					if ( $key == 'thim_body_primary_color' || $key == 'thim_sticky_main_menu_text_color' || $key == 'thim_main_menu_text_color' || $key == 'thim_offcanvas_text_color' ) {
						if ( $val_opt[0] == '#' ) {
							list( $r, $g, $b ) = sscanf( $val_opt, "#%02x%02x%02x" );
							$css .= '--' . $key . '_rgb: ' . $r . ',' . $g . ',' . $b . ';';
						} else {
							$rgba    = explode( ',', $val_opt );
							$rgba_rr = explode( '(', $rgba['0'] );
							$css     .= '--' . $key . '_rgb: ' . $rgba_rr['1'] . ',' . $rgba['1'] . ',' . $rgba['2'] . ';';
						}
					}
				}
			}
			// get data for on type is image
		}

		return apply_filters( 'thim_get_var_css_customizer', $css );
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function thim_scripts() {

	wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), TP_THEME_VERSION );
	$var_css = ':root{' . preg_replace(
			array( '/\s*(\w)\s*{\s*/', '/\s*(\S*:)(\s*)([^;]*)(\s|\n)*;(\n|\s)*/', '/\n/', '/\s*}\s*/' ),
			array( '$1{ ', '$1$3;', "", '} ' ), thim_get_option_var_css()
		) . '}';

	wp_add_inline_style( 'thim-style', $var_css );

	wp_enqueue_style( 'sailing-slick', TP_THEME_URI . 'assets/css/slick.css', array() );

	if ( ! class_exists( 'Thim_EL_Kit' ) ) {
		wp_enqueue_style( 'elementor-icons-thim-ekits-fonts', TP_THEME_URI . 'assets/css/thim-ekits-icons.min.css', array(), TP_THEME_VERSION );
	}
	wp_enqueue_style( 'font-pe-icon-7', TP_THEME_URI . 'assets/css/font-pe-icon-7.css', array(), TP_THEME_VERSION );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_register_script( 'waypoints', TP_THEME_URI . 'assets/js/libs/waypoints.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_register_script( 'theia-sticky-sidebar', TP_THEME_URI . 'assets/js/libs/theia-sticky-sidebar.js', array( 'jquery' ), TP_THEME_VERSION, true );
	//wp_enqueue_script( 'smooth-scoll', TP_THEME_URI . 'assets/js/libs/smooth-scoll.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_enqueue_script( 'slick', TP_THEME_URI . 'assets/js/libs/slick.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_enqueue_script( 'select2', TP_THEME_URI . 'assets/js/libs/select2.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	//wp_enqueue_script( 'pikaday', TP_THEME_URI . 'assets/js/libs/pikaday.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	//wp_enqueue_script( 'parallax', TP_THEME_URI . 'assets/js/libs/parallax.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	//wp_enqueue_script( 'navigation', TP_THEME_URI . 'assets/js/libs/navigation.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_enqueue_script( 'moment', TP_THEME_URI . 'assets/js/libs/moment.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_enqueue_script( 'modernizr', TP_THEME_URI . 'assets/js/libs/modernizr.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_register_script( 'magnific-popup', TP_THEME_URI . 'assets/js/libs/magnific-popup.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_register_script( 'isotope', TP_THEME_URI . 'assets/js/libs/isotope.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_enqueue_script( 'greensock', TP_THEME_URI . 'assets/js/libs/greensock.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_register_script( 'fancybox', TP_THEME_URI . 'assets/js/libs/fancybox.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_register_script( 'owl-carousel', TP_THEME_URI . 'assets/js/libs/carousel.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_register_script( 'cookie', TP_THEME_URI . 'assets/js/libs/cookie.min.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_register_script( 'flexslider', TP_THEME_URI . 'assets/js/libs/flexslider-min.js', array( 'jquery' ), TP_THEME_VERSION, true );

	wp_register_script( 'thim-daterangepicker', TP_THEME_URI . 'assets/js/libs/daterangepicker.min.js', array( 'jquery' ), TP_THEME_VERSION, true );

	wp_enqueue_script( 'thim-main', TP_THEME_URI . 'assets/js/main.min.js', array('imagesloaded'), TP_THEME_VERSION, true );

	wp_enqueue_script( 'prettyPhoto' );
	wp_enqueue_script( 'prettyPhoto-init' );
	wp_enqueue_style( 'woocommerce_prettyPhoto_css' );

	wp_dequeue_script( 'sb-font-awesome' );
	/**
	 * Load css rtl.
	 */
	if ( is_rtl() || get_theme_mod( 'thim_rtl_support' ) == true ) {
		wp_enqueue_style( 'thim-css-rtl', TP_THEME_URI . 'rtl.css', array() );
	}
}

add_action( 'wp_enqueue_scripts', 'thim_scripts' );

function thim_custom_admin_scripts() {
	wp_enqueue_script( 'thim-admin-custom-script', TP_THEME_URI . 'assets/js/admin-custom-script.js', array( 'jquery' ), TP_THEME_VERSION, true );
	wp_enqueue_style( 'thim-custom-admin', TP_THEME_URI . 'assets/css/custom-admin.css', array() );
}

add_action( 'admin_enqueue_scripts', 'thim_custom_admin_scripts' );

/**
 * Add installer.
 */
require TP_THEME_DIR . 'inc/admin/installer/installer.php';
/**
 * Library.
 */
require TP_THEME_DIR . 'inc/libs/Tax-meta-class/Tax-meta-class.php';
require TP_THEME_DIR . 'inc/tax-meta.php';
require TP_THEME_DIR . 'inc/libs/theme-wrapper.php';
/**
 * Required plugin.
 */
if ( is_admin() && current_user_can( 'manage_options' ) ) {
	require TP_THEME_DIR . 'inc/data/plugins-require.php';
}
/**
 * Custom function.
 */
require TP_THEME_DIR . 'inc/custom-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */

require get_template_directory() . '/inc/extras.php';
//require TP_THEME_DIR . 'inc/aq_resizer.php';
require TP_THEME_DIR . 'inc/libs/down_image_size.php';

/**
 * Customizer additions.
 */
require TP_THEME_DIR . 'inc/header/logo.php';
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
 * Function Thim Core.
 */
if ( thim_plugin_active( 'thim-core' ) ) {
	require TP_THEME_DIR . 'inc/widgets/widgets.php';
	require TP_THEME_DIR . 'inc/customizer.php';
	require TP_THEME_DIR . 'inc/thim-core-function.php';
}
/**
 * Woocommerce.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/woocommerce/woocommerce.php';
}

if ( class_exists( 'WP_Hotel_Booking' ) ) {
	require get_template_directory() . '/wp-hotel-booking/wp-hotel-booking.php';
}

if ( thim_plugin_active( 'elementor' ) ) {
	require_once TP_THEME_DIR . 'elementor-addons/elementor-addons.php';
}


// Remove wp Blocks style Woo
function thim_disable_wp_blocks() {
	$wstyles = array(
		"wc-blocks-style",
		"wc-blocks-style-active-filters",
		"wc-blocks-style-add-to-cart-form",
		"wc-blocks-packages-style",
		"wc-blocks-style-all-products",
		"wc-blocks-style-all-reviews",
		"wc-blocks-style-attribute-filter",
		"wc-blocks-style-breadcrumbs",
		"wc-blocks-style-catalog-sorting",
		"wc-blocks-style-customer-account",
		"wc-blocks-style-featured-category",
		"wc-blocks-style-featured-product",
		"wc-blocks-style-mini-cart",
		"wc-blocks-style-price-filter",
		"wc-blocks-style-product-add-to-cart",
		"wc-blocks-style-product-button",
		"wc-blocks-style-product-categories",
		"wc-blocks-style-product-image",
		"wc-blocks-style-product-image-gallery",
		"wc-blocks-style-product-query",
		"wc-blocks-style-product-results-count",
		"wc-blocks-style-product-reviews",
		"wc-blocks-style-product-sale-badge",
		"wc-blocks-style-product-search",
		"wc-blocks-style-product-sku",
		"wc-blocks-style-product-stock-indicator",
		"wc-blocks-style-product-summary",
		"wc-blocks-style-product-title",
		"wc-blocks-style-rating-filter",
		"wc-blocks-style-reviews-by-category",
		"wc-blocks-style-reviews-by-product",
		"wc-blocks-style-product-details",
		"wc-blocks-style-single-product",
		"wc-blocks-style-stock-filter",
		"wc-blocks-style-cart",
		"wc-blocks-style-checkout",
		"wc-blocks-style-mini-cart-contents", "classic-theme-styles-inline"
	);

	foreach ( $wstyles as $wstyle ) {
		wp_deregister_style( $wstyle );
	}

	$wscripts = array(
		"wc-blocks-middleware",
		"wc-blocks-data-store"
	);
	foreach ( $wscripts as $wscript ) {
		wp_deregister_script( $wscript );
	}
}

if ( get_theme_mod( 'thim_disable_style_blocks_woo', true ) ) {
	add_action( "init", "thim_disable_wp_blocks", 100 );
}


if ( ! function_exists( 'thim_enable_upload_svg' ) ) {
	function thim_enable_upload_svg( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	add_filter( 'upload_mimes', 'thim_enable_upload_svg' );
}
