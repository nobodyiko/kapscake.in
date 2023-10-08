<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Video_Element extends Widget_Base {

	public function get_name() {
		return 'thim-video';
	}

	public function get_title() {
		return esc_html__( 'Thim: Video', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-video';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'video_settings',
			[
				'label' => esc_html__( 'Video Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Layout Video', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'    => esc_html__( 'Style New', 'sailing' ),
					'default' => esc_html__( 'Style Old', 'sailing' ),
					"style-1" => esc_attr__( "Style 1", "sailing" )
				],
				'default' => 'default',
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
			'background_title',
			[
				'label'       => esc_html__( 'Background Title', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Background Title', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'default','default' ]
				]
			]
		);

		$this->add_control(
			'desc',
			[
				'label'       => esc_html__( 'Description', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Description', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'default' ]
				]
			]
		);

		$this->add_control(
			'self_poster',
			[
				'label'     => esc_html__( 'Select Cover Image', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => [ 'default','style-1' ]
				]
			]
		);

		$this->add_control(
			'button02_title',
			[
				'label'       => esc_html__( 'Video Button', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Video Button', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'background_img',
			[
				'label'     => esc_html__( 'Select Background Image', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'logo',
			[
				'label'     => esc_html__( 'Select Logo Image', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => [ 'base','style-1' ]
				]
			]
		);

		$this->add_control(
			'external_video',
			[
				'label'         => __( 'Link Video', 'sailing' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'sailing' ),
				'show_external' => false,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'style'            => $settings['style'],
			'title'            => $settings['title'],
			'background-title' => $settings['background_title'],
			'desc'             => $settings['desc'],
			'self_poster'      => ($settings['self_poster']) ? $settings['self_poster']['id'] : '',
			'button02_title'   => $settings['button02_title'],
			'background_img'   => ($settings['background_img']) ? $settings['background_img']['id']: '',
			'logo'             => ($settings['logo']) ? $settings['logo']['id'] :'',
			'external_video'   => $settings['external_video']['url'],
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), $settings['style'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Video_Element() );
