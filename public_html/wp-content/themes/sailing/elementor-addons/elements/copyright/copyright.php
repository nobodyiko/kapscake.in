<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Copyright_Element extends Widget_Base {

	public function get_name() {
		return 'thim-copyright';
	}

	public function get_title() {
		return esc_html__( 'Thim: Copyright', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-link';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'copyright_settings',
			[
				'label' => esc_html__( 'Copyright Settings', 'sailing' )
			]
		);

		$this->add_control(
			'first_text',
			[
				'label'       => esc_html__( 'First Text', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'default'     => '&copy;'
			]
		);

		$this->add_control(
			'year',
			[
				'label'       => esc_html__( 'Year', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'default'     => '2019'
			]
		);

		$this->add_control(
			'site_name',
			[
				'label'       => esc_html__( 'Site Name', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'default'     => 'ThimPress'
			]
		);

		$this->add_control(
			'link_site',
			[
				'label'         => __( 'Link Site', 'sailing' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'sailing' ),
				'show_external' => true,
				'default'       => [
					'url'         => 'https://thimpress.com/',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$this->add_control(
			'last_text',
			[
				'label'       => esc_html__( 'Last Text', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'default'     => 'All rights reserved. Powered by WordPress.'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'first_text' => $settings['first_text'],
			'year'       => $settings['year'],
			'site_name'  => $settings['site_name'],
			'link_site'  => $settings['link_site']['url'],
			'last_text'  => $settings['last_text']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Copyright_Element() );
