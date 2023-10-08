<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

define( 'THIM_EL_PATH', TP_THEME_DIR . 'elementor-addons/' );
define( 'THIM_EL_ADDONS_PATH', THIM_EL_PATH . 'elements/' );

require_once THIM_EL_PATH . 'inc/elementor-helper.php';
require_once THIM_EL_PATH . 'inc/class-elementor-extend-icons.php';

function thim_add_new_elements() {
	require_once THIM_EL_PATH . 'inc/helper.php';

	//Load elements
	require THIM_EL_ADDONS_PATH . 'box/box.php';
	require THIM_EL_ADDONS_PATH . 'button/button.php';
	require THIM_EL_ADDONS_PATH . 'column-post/column-post.php';
	require THIM_EL_ADDONS_PATH . 'copyright/copyright.php';
	require THIM_EL_ADDONS_PATH . 'counters-box/counters-box.php';
	//require THIM_EL_ADDONS_PATH . 'feature/feature.php';
	require THIM_EL_ADDONS_PATH . 'gallery/gallery.php';
	require THIM_EL_ADDONS_PATH . 'gallery-images/gallery-images.php';
	require THIM_EL_ADDONS_PATH . 'google-map/google-map.php';
	require THIM_EL_ADDONS_PATH . 'heading/heading.php';
	require THIM_EL_ADDONS_PATH . 'list-html/list-html.php';
	require THIM_EL_ADDONS_PATH . 'list-post/list-post.php';
	require THIM_EL_ADDONS_PATH . 'single-images/single-images.php';
	require THIM_EL_ADDONS_PATH . 'testimonials/testimonials.php';
	require THIM_EL_ADDONS_PATH . 'tour/tour.php';
	require THIM_EL_ADDONS_PATH . 'video/video.php';
	require THIM_EL_ADDONS_PATH . 'icon-box/icon-box.php';
	require THIM_EL_ADDONS_PATH . 'social/social.php';
	require THIM_EL_ADDONS_PATH . 'shortcode/shortcode.php';
	require THIM_EL_ADDONS_PATH . 'main-slider/main-slider.php';
	require THIM_EL_ADDONS_PATH . 'info-sale/info-sale.php';
	require THIM_EL_ADDONS_PATH . 'list-video/list-video.php';
	require THIM_EL_ADDONS_PATH . 'single-post/single-post.php';
	if ( is_plugin_active( 'wp-hotel-booking/wp-hotel-booking.php' ) || is_plugin_active( 'tp-hotel-booking/tp-hotel-booking.php' ) ) {
		require THIM_EL_ADDONS_PATH . 'hotel-room/hotel-room.php';
		require THIM_EL_ADDONS_PATH . 'mini-cart-room/mini-cart-room.php';
		require THIM_EL_ADDONS_PATH . 'search-room/search-room.php';
	}

	if ( class_exists( 'THIM_Portfolio' ) ) {

	}
}

add_action( 'elementor/widgets/widgets_registered', 'thim_add_new_elements' );