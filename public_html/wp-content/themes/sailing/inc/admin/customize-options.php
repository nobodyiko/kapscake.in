<?php
/**
 * Create Thim_Charity_Customize
 *
 */

/**
 * Class Thim_Customize_Options
 */
class Thim_Customize_Options {
	/**
	 * Thim_Customize_Options constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'thim_deregister') );
		add_action( 'thim_customizer_register', array( $this, 'thim_create_customize_options') );
	}

	/**
	 * Deregister customize default unnecessary
	 *
	 * @param $wp_customize
	 */
	public function thim_deregister( $wp_customize ) {
		$wp_customize->remove_section( 'colors' );
		//$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'header_image' );
		$wp_customize->remove_control( 'blogdescription' );
		$wp_customize->remove_control( 'blogname' );
		$wp_customize->remove_control( 'display_header_text' );
		$wp_customize->remove_section( 'static_front_page' );
		// Rename existing section
		$wp_customize->add_section( 'title_tagline', array(
			'title'    => esc_html__( 'Logo', 'sailing' ),
			'panel'    => 'general',
			'priority' => 1,
		) );
	}

	/**
	 * Create customize
	 *
	 * @param $wp_customize
	 */
	public function thim_create_customize_options( $wp_customize ) {

		$DIR = TP_THEME_DIR . "inc/admin/customizer-sections/";

		include $DIR . 'blog.php';
		include $DIR . 'blog-archive.php';
		include $DIR . 'blog-frontpage.php';
		include $DIR . 'blog-postpage.php';
		include $DIR . 'blog-setting.php';
		include $DIR . 'footer.php';
		include $DIR . 'footer-copyright.php';
		include $DIR . 'footer-options.php';
		include $DIR . 'general.php';
		include $DIR . 'general-404.php';
		include $DIR . 'general-page-title.php';
		include $DIR . 'general-featured.php';
		include $DIR . 'general-styling-layout.php';
		include $DIR . 'general-logo.php';
		include $DIR . 'general-sharing.php';
		include $DIR . 'general-styling-color.php';
		include $DIR . 'general-styling-pattern.php';
		include $DIR . 'general-typography.php';
		include $DIR . 'general-typography-heading.php';
		include $DIR . 'header.php';
		include $DIR . 'header-offcanvas.php';
		include $DIR . 'header-mainmenu.php';
		include $DIR . 'header-mobile.php';
		include $DIR . 'header-submenu.php';
		include $DIR . 'header-toolbar.php';
		include $DIR . 'header-setting.php';

		if ( class_exists( 'WP_Hotel_Booking' ) || class_exists( 'TP_Hotel_Booking' )) {
			include $DIR . 'hotelbooking-archive.php';
			include $DIR . 'hotelbooking-search-page.php';
			include $DIR . 'hotelbooking-setting.php';
			include $DIR . 'hotelbooking-share.php';
			include $DIR . 'hotelbooking-single.php';
			include $DIR . 'hotelbooking.php';
		}

		if ( class_exists( 'WPEMS' ) ) {
			include $DIR . 'event.php';
			include $DIR . 'event-archive.php';
			include $DIR . 'event-single.php';
		}

		if ( class_exists( 'WooCommerce' ) ) {
			include $DIR . 'woocommerce-archive.php';
			include $DIR . 'woocommerce-setting.php';
			include $DIR . 'woocommerce-sharing.php';
			include $DIR . 'woocommerce-single.php';
			include $DIR . 'woocommerce.php';
		}
	}
}

$thim_customize = new Thim_Customize_Options();