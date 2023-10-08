<?php
function thim_get_all_plugins_require( $plugins ) {
	return array(

		array(
			'name' => 'Widget Logic',
			'slug' => 'widget-logic',
		),

		array(
			'name' => 'Instagram Feed',
			'slug' => 'instagram-feed',
		),

		array(
			'name'       => 'SiteOrigin Page Builder',
			'slug'       => 'siteorigin-panels',
			'required'   => false,
			'no-install' => true,
		),

		array(
			'name'       => 'SiteOrigin Widgets Bundle',
			'slug'       => 'so-widgets-bundle',
			'required'   => false,
			'no-install' => true,
		),

		array(
			'name'        => 'Elementor Page Builder',
			'slug'        => 'elementor',
			'required'    => false,
			'description' => 'The most advanced frontend drag & drop page builder. Create high-end, pixel perfect websites at record speeds. Any theme, any page, any design.',
		),

		//		array(
		//			'name'        => 'Anywhere Elementor',
		//			'slug'        => 'anywhere-elementor',
		//			'required'    => false,
		//			'description' => 'Allows you to insert elementor pages and library templates anywhere using shortcodes.',
		//			'add-on'      => true,
		//		),
		array(
			'name'       => 'Thim Elementor Kit',
			'slug'       => 'thim-elementor-kit',
			// 'premium'     => true,
			'no-install' => true,
			'required'   => false,
		),
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7'
		),

		array(
			'name' => 'MailChimp for WordPress',
			'slug' => 'mailchimp-for-wp',
		),

		array(
			'name' => 'WooCommerce',
			'slug' => 'woocommerce',
		),

		array(
			'name'     => 'WP Hotel Booking',
			'slug'     => 'wp-hotel-booking',
			'required' => true,
		),

		array(
			'name'       => 'Revolution Slider',
			'slug'       => 'revslider',
//			'version'    => '5.4.8.2',
			'premium'    => true,
			'no-install' => true,
			'icon'       => 'https://plugins.thimpress.com/downloads/images/revslider.png',
		),

		array(
			'name'    => 'Thim Testimonials',
			'slug'    => 'thim-testimonials',
			'version' => '1.3.1',
			'premium' => true,
			'icon'    => 'https://plugins.thimpress.com/downloads/images/thim-testimonials.png',
		),

		array(
			'name'   => 'WP Hotel Booking Authorize Sim',
			'slug'   => 'wp-hotel-booking-authorize-payment',
			'add-on' => true,
		),

		//
		//		array(
		//			'name'   => 'WP Hotel Booking Coupon',
		//			'slug'   => 'wp-hotel-booking-coupon',
		//			'add-on' => true,
		//		),

		array(
			'name'   => 'WP Hotel Booking Report',
			'slug'   => 'wp-hotel-booking-report',
			'add-on' => true,
		),

		array(
			'name'   => 'WP Hotel Booking Stripe',
			'slug'   => 'wp-hotel-booking-stripe-payment',
			'add-on' => true,
		),

		array(
			'name'   => 'WP Hotel Booking WooCommerce',
			'slug'   => 'wp-hotel-booking-woocommerce',
			'add-on' => true,
		),

		array(
			'name'   => 'WP Hotel Booking WPML Support',
			'slug'   => 'wp-hotel-booking-wpml-support',
			'add-on' => true,
		),

		//		array(
		//			'name'   => 'WP Hotel Booking Room',
		//			'slug'   => 'wp-hotel-booking-booking-room',
		//			'add-on' => true,
		//		),
		//		array(
		//			'name'        => 'Sailing Demo Data',
		//			'slug'        => 'sailing-demo-data',
		//			'version'     => '2.0',
		//			'description' => 'Demo data for the theme Sailing.',
		//			'premium'     => true
		//		),
		array(
			'name'     => 'Classic Editor',
			'slug'     => 'classic-editor',
			'required' => false,
		),
		array(
			'name'       => 'HubSpot – CRM, Email Marketing, Live Chat, Forms & Analytics',
			'slug'       => 'leadin',
			'required'   => false,
			'no-install' => true,
		),
	);
}

add_filter( 'thim_core_get_all_plugins_require', 'thim_get_all_plugins_require' );

function thim_envato_item_id() {
	return '13321455';
}

add_filter( 'thim_envato_item_id', 'thim_envato_item_id' );
