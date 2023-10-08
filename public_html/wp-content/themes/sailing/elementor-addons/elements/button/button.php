<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Button_Element extends Widget_Base {

	public function get_name() {
		return 'thim-button';
	}

	public function get_title() {
		return esc_html__( 'Thim: Button', 'sailing' );
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
			'button_settings',
			[
				'label' => esc_html__( 'Button Settings', 'sailing' )
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text Button', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'sailing' ),
				'default'     => 'Default value'
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'sailing' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'sailing' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
			]
		);

		$this->add_control(
			'image_icon',
			[
				'label'   => esc_html__( 'Image Icon', 'sailing' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style_settings',
			[
				'label' => esc_html__( 'Custom Style Settings', 'sailing' )
			]
		);

		$this->add_control(
			'custom',
			[
				'label'   => esc_html__( 'Custom Style', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'no'  => esc_html__( 'No', 'sailing' ),
					'yes' => esc_html__( 'Yes', 'sailing' )
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Button color', 'sailing' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c19b76',
				'condition' => [
					'custom' => [ 'yes' ]
				]
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text color', 'sailing' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'condition' => [
					'custom' => [ 'yes' ]
				]
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__( 'Button Hover Color', 'sailing' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c19b76',
				'condition' => [
					'custom' => [ 'yes' ]
				]
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'label'     => esc_html__( 'Text Hover Color', 'sailing' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'condition' => [
					'custom' => [ 'yes' ]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'text'        => $settings['text'],
			'link'        => $settings['link']['url'],
			'link_target' => $settings['link']['is_external'],
			'image_icon'  => $settings['image_icon']['id']
		);

		if ( $settings['link']['is_external'] == 1 ) {
			$instance['link_target'] = '_blank';
		} else {
			$instance['link_target'] = '_self';
		}

		$instance['button_option'] = array(
			'custom'             => $settings['custom'],
			'button_color'       => $settings['button_color'],
			'text_color'         => $settings['text_color'],
			'button_hover_color' => $settings['button_hover_color'],
			'text_hover_color'   => $settings['text_hover_color']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Button_Element() );
