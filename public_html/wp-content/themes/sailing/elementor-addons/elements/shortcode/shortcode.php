<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Shortcode_Element extends Widget_Base {

	public function get_name() {
		return 'thim-shortcode';
	}

	public function get_title() {
		return esc_html__( 'Thim: Shortcode Title', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-timetable';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'shortcode_settings',
			[
				'label' => esc_html__( 'Shortcode Settings', 'sailing' )
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => 'Default value',
			]
		);

		$this->add_control(
			'shortcode',
			[
				'label'       => __( 'Enter your shortcode', 'elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => '[gallery id="123" size="medium"]',
				'default'     => '',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'title'     => $settings['title'],
			'shortcode' => $settings['shortcode'],
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Shortcode_Element() );
