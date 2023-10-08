<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class Thim_Elementor_Extend_Icons {
	private static $instance = null;

	public function __construct() {
		add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'font_setup' ) );
	}

	public function font_setup() {
		wp_enqueue_style( 'thim-font-icon', TP_THEME_URI . 'assets/css/thim-icons.css' );
		wp_enqueue_style( 'font-pe-icon-7', TP_THEME_URI . 'assets/css/font-pe-icon-7.css' );
	}

	public static function get_font_7_stroke() {
		$strokeicons = apply_filters( 'thim_list_stroke_icon', array(
			'pe-7s-album' => 'album',
			'pe-7s-arc'   => 'arc',
		) );

		return $strokeicons;
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

Thim_Elementor_Extend_Icons::get_instance();