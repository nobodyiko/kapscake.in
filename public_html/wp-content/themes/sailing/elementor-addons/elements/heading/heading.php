<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Heading_Element extends Widget_Base {

	public function get_name() {
		return 'thim-heading';
	}

	public function get_title() {
		return esc_html__( 'Thim: Heading', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-heading';
	}
	protected function get_html_wrapper_class() {
		return 'thim-widget-heading';
	} 
	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'heading_settings',
			[
				'label' => esc_html__( 'Heading Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Box Style Image', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'      => esc_attr__( 'Style Old', 'sailing' ),
					'style_new' => esc_attr__( 'Style New', 'sailing' )
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'small_title',
			[
				'label'       => esc_html__( 'Small Heading Text', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Small Heading Text', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'style_new' ]
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Heading Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Heading Title', 'sailing' ),
				'default'     => 'Default value'
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label'       => esc_html__( 'Sub Heading', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Sub Title', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'background_title',
			[
				'label'       => esc_html__( 'Background Heading', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Background Title', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'style_new' ]
				]
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description Heading', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Description Title', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'style_new' ]
				]
			]
		);

		$this->add_control(
			'line',
			[
				'label'     => esc_html__( 'Show Separator', 'sailing' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => [
					'style' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'textcolor',
			[
				'label'     => esc_html__( 'Text Heading Color', 'sailing' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'style' => [ 'base' ]
				]
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => esc_html__( 'Size Heading', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h2' => esc_html__( 'H2', 'sailing' ),
					'h3' => esc_html__( 'H3', 'sailing' ),
					'h4' => esc_html__( 'H4', 'sailing' ),
					'h5' => esc_html__( 'H5', 'sailing' ),
					'h6' => esc_html__( 'H6', 'sailing' )
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'show_button_heading',
			[
				'label'   => esc_html__( 'Show Button', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'yes' => esc_html__( 'Yes', 'sailing' ),
					'no'  => esc_html__( 'No', 'sailing' )
				],
				'default' => 'no',
				'condition'   => [
					'style' => [ 'style_new' ]
				]
			]
		);

		$this->add_control(
			'title_button',
			[
				'label'       => esc_html__( 'Title Button Heading', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title Button', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'show_button_heading' => [ 'yes' ]
				]
			]
		);

		$this->add_control(
			'link_button',
			[
				'label'         => __( 'Link Button', 'sailing' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'sailing' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
				'condition'     => [
					'show_button_heading' => [ 'yes' ]
				]
			]
		);

		$this->add_control(
			'css_animation',
			[
				'label'   => esc_html__( 'CSS Animation', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''              => esc_attr__( 'No', 'sailing' ),
					'top-to-bottom' => esc_attr__( 'Top to bottom', 'sailing' ),
					'bottom-to-top' => esc_attr__( 'Bottom to top', 'sailing' ),
					'left-to-right' => esc_attr__( 'Left to right', 'sailing' ),
					'right-to-left' => esc_attr__( 'Right to left', 'sailing' ),
					'appear'        => esc_attr__( 'Appear from center', 'sailing' )
				],
				'default' => '',
			]
		);

		$this->add_control(
			'font_heading',
			[
				'label'   => esc_html__( 'Style Heading', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'sailing' ),
					'custom'  => esc_html__( 'Custom', 'sailing' )
				],
				'default' => 'default',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'custom_font_heading',
			[
				'label'     => esc_html__( 'Custom Font Heading', 'sailing' ),
				'condition' => [
					'font_heading' => [ 'custom' ]
				]
			]
		);

		$this->add_control(
			'custom_font_size',
			[
				'label'   => esc_html__( 'Font Size', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '14'
			]
		);

		$this->add_control(
			'custom_font_weight',
			[
				'label'   => esc_html__( 'Custom Font Weight', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'normal' => esc_html__( 'Normal', 'sailing' ),
					'bold'   => esc_html__( 'Bold', 'sailing' ),
					'100'    => esc_html__( '100', 'sailing' ),
					'200'    => esc_html__( '200', 'sailing' ),
					'300'    => esc_html__( '300', 'sailing' ),
					'400'    => esc_html__( '400', 'sailing' ),
					'500'    => esc_html__( '500', 'sailing' ),
					'600'    => esc_html__( '600', 'sailing' ),
					'700'    => esc_html__( '700', 'sailing' ),
					'800'    => esc_html__( '800', 'sailing' ),
					'900'    => esc_html__( '900', 'sailing' ),
				],
				'default' => '300',
			]
		);

		$this->add_control(
			'custom_font_style',
			[
				'label'   => esc_html__( 'Custom Font Style', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'inherit' => esc_html__( 'Inherit', 'sailing' ),
					'initial' => esc_html__( 'Initial', 'sailing' ),
					'italic'  => esc_html__( 'Italic', 'sailing' ),
					'normal'  => esc_html__( 'Normal', 'sailing' ),
					'oblique' => esc_html__( 'Oblique', 'sailing' )
				],
				'default' => 'normal',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array();

		$instance['style'] = $settings['style'];

		$instance = array(
			'small_title'         => $settings['small_title'],
			'title'               => $settings['title'],
			'line'                => $settings['line'],
			'textcolor'           => $settings['textcolor'],
			'size'                => $settings['size'],
			'font_heading'        => $settings['font_heading'],
			'sub-title'           => $settings['sub_title'],
			'background_title'    => $settings['background_title'],
			'description'         => $settings['description'],
			'show_button_heading' => $settings['show_button_heading'],
			'title_button'        => $settings['title_button'],
			'link_button'         => ! empty( $settings['link_button']['url'] ) ? $settings['link_button']['url'] : '',
			'css_animation'       => $settings['css_animation'],
		);

		$instance['custom_font_heading'] = array(
			'custom_font_size'   => $settings['custom_font_size'],
			'custom_font_weight' => $settings['custom_font_weight'],
			'custom_font_style'  => $settings['custom_font_style']
		);

		if ( isset( $settings['link_button']['url'] ) && $settings['link_button']['is_external'] == 1 ) {
			$instance['link_target'] = '_blank';
		} else {
			$instance['link_target'] = '_self';
		}

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), $settings['style'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Heading_Element() );
