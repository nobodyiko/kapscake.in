<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Main_Slider_Element extends Widget_Base {

	public function get_name() {
		return 'thim-main-slider';
	}

	public function get_title() {
		return esc_html__( 'Thim: Main Slider', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-main-slider';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'main_slider_settings',
			[
				'label' => esc_html__( 'Main Slider Settings', 'sailing' )
			]
		);

		$this->add_control(
			'background_img',
			[
				'label'     => esc_html__( 'Select Background Image', 'sailing' ),
				'type'      => Controls_Manager::GALLERY,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => 'Default value'
			]
		);


		$this->add_control(
			'desc',
			[
				'label'       => esc_html__( 'Description', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Description', 'sailing' ),
				'default'     => esc_html__( 'Description', 'sailing' ),
			]
		);

		$this->add_control(
			'text_link',
			[
				'label'       => esc_html__( 'Text Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Text Link', 'sailing' ),
				'default'     => esc_html__( 'Explorer', 'sailing' ),
			]
		);
		$this->add_control(
			'link',
			[
				'label'       => esc_html__( ' Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( ' Link', 'sailing' ),
				'default'     => esc_html__( '#', 'sailing' ),
			]
		);

		$this->add_control(
			'enable_autoplay',
			[
				'label'       => esc_html__( ' Auto Play', 'sailing' ),
				'type'        => Controls_Manager::SWITCHER  ,
				'default'     => 'no',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'       => esc_html__( ' Auto Speed', 'sailing' ),
				'type'        => Controls_Manager::NUMBER ,
				'default'     => 3000,

			]
		);
		


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'background_img'         => array_map( function ( $ar ) {
				return $ar['id'];
			}, $settings['background_img'] ),
			'title'            => $settings['title'],
			'desc'             => $settings['desc'],
			'text_link'        => $settings['text_link'],
			'link'             => $settings['link'],
			'enable_autoplay'  => $settings['enable_autoplay'],
			'autoplay_speed'   => $settings['autoplay_speed']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), 'base' );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Main_Slider_Element() );
