<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Featured_Element extends Widget_Base {

	public function get_name() {
		return 'thim-featured';
	}

	public function get_title() {
		return esc_html__( 'Thim: Featured', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-button';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'featured_settings',
			[
				'label' => esc_html__( 'Featured Settings', 'sailing' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Panel Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'       => esc_html__( 'Panel Body', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'panel',
			[
				'label'       => esc_html__( 'Panel List', 'sailing' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'separator'   => 'before'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'list-html' => $settings['panel']
		);

		thim_get_widget_template( $this->get_base(), array(
			'instance' => $instance
		) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Featured_Element() );
