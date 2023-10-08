<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Single_Image_Element extends Widget_Base {

	public function get_name() {
		return 'thim-single-image';
	}

	public function get_title() {
		return esc_html__( 'Thim: Single Image', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-single-images';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'single_image_settings',
			[
				'label' => esc_html__( 'Single Image Settings', 'sailing' )
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'sailing' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'       => esc_html__( 'Image Size', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Image size', 'sailing' ),
				'description' => esc_attr__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or enter image size in pixels: 200x100 (Width x Height).', 'sailing' ),
				'default'     => 'full'
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

		$this->add_control(
			'image_alignment',
			[
				'label'   => esc_html__( 'Image Alignment', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left'   => esc_attr__( 'Align Left', 'sailing' ),
					'right'  => esc_attr__( 'Align Right', 'sailing' ),
					'center' => esc_attr__( 'Align Center', 'sailing' )
				],
				'default' => 'left',
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

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'image'           => $settings['image']['id'],
			'image_size'      => $settings['image_size'],
			'image_link'      => $settings['image_link']['url'],
			'image_alignment' => $settings['image_alignment'],
			'css_animation'   => $settings['css_animation'],
		);

		if ( $settings['image_link']['is_external'] == 1 ) {
			$instance['link_target'] = '_blank';
		} else {
			$instance['link_target'] = '_self';
		}

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Single_Image_Element() );
