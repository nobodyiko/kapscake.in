<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Box_Element extends Widget_Base {

	public function get_name() {
		return 'thim-box';
	}

	public function get_title() {
		return esc_html__( 'Thim: Box Image', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-login-form';
	}
	protected function get_html_wrapper_class() {
		return 'thim-widget-box';
	}
	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Box Style Image', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'    => esc_attr__( 'Style Two Image', 'sailing' ),
					'style_2' => esc_attr__( 'Style One Image', 'sailing' )
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'image_left',
			[
				'label'     => esc_html__( 'Image Left', 'sailing' ),
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
			'image_right',
			[
				'label'     => esc_html__( 'Image Right', 'sailing' ),
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
			'image_icon',
			[
				'label'     => esc_html__( 'Image Icon', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => [ 'style_2' ]
				]
			]
		);

		$this->add_control(
			'small_title',
			[
				'label'       => esc_html__( 'Small Text Box Image', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Small Text Box Image', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'style_2' ]
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Heading Text Box Image', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Heading Text Box Image', 'sailing' ),
				'default'     => 'Default value',
				'condition'   => [
					'style' => [ 'style_2' ]
				]
			]
		);

		$this->add_control(
			'image_background',
			[
				'label'   => esc_html__( 'Image Background', 'sailing' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'exclude'   => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_link',
			[
				'label'         => __( 'Image Link', 'sailing' ),
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

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array();

		$instance['style'] = $settings['style'];
		
		$instance = array(
			'image_left'       => ($settings['image_left']) ? $settings['image_left']['id'] : '',
			'image_right'      => ($settings['image_right']) ? $settings['image_right']['id'] :'',
			'image_icon'       => ($settings['image_icon']) ? $settings['image_icon']['id'] :'',
			'small_title'      => $settings['small_title'],
			'title'            => $settings['title'],
			'image_background' => $settings['image_background']['id'],
			'image_size'       => $settings['image_size'],
			'image_link'       => $settings['image_link']['url']
		);

		if ( $settings['image_link']['is_external'] == 1 ) {
			$instance['link_target'] = '_blank';
		} else {
			$instance['link_target'] = '_self';
		}

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), $settings['style'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Box_Element() );
