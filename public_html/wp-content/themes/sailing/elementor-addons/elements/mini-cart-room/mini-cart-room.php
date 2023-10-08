<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Mini_Cart_Room_Element extends Widget_Base {

	public function get_name() {
		return 'thim-mini-cart-room';
	}

	public function get_title() {
		return esc_html__( 'Thim: Mini Cart Room', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-one-course-instructors';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'mini_cart_room_settings',
			[
				'label' => esc_html__( 'Mini Cart Room Settings', 'sailing' )
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => 'Your Book'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'title'       => $settings['title']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Mini_Cart_Room_Element() );
