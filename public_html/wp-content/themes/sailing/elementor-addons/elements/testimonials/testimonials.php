<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Testimonial_Element extends Widget_Base {

	public function get_name() {
		return 'thim-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Thim: Testimonials', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-testimonials';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'testimonials_settings',
			[
				'label' => esc_html__( 'Testimonials Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Style Testimonial', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'    => esc_attr__( 'Style Old', 'sailing' ),
					'default' => esc_attr__( 'Style New', 'sailing' ),
					'style-1' => esc_attr__( 'Style 1', "sailing" ),
					'style-2' => esc_attr__( 'Style 2', "sailing" ),
					'style-3' => esc_attr__( 'Style 3', "sailing" ),
					'style-4' => esc_attr__( 'Style 4', "sailing" )
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => 'Testimonials',
				'condition'   => [
					'style' => [ 'base','style-1','style-2','style-4' ]
				]
			]
		);

		$this->add_control(
			'des',
			[
				'label'       => esc_html__( 'Description', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Description', 'sailing' ),
				'default'               => esc_attr__( 'Lorem ipsum dolor sit amet', 'sailing' ),
				'condition'   => [
					'style' => [ 'style-1' ]
				]
			]
		);

		$this->add_control(
			'bg_title',
			[
				'label'       => esc_html__( 'Background Title', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Description', 'sailing' ),
				'default'               => esc_attr__( 'testimonial', 'sailing' ),
				'condition'   => [
					'style' => [ 'style-3' ]
				]
			]
		);

		$this->add_control(
			'number',
			[
				'label'   => esc_html__( 'Number Post', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4'
			]
		);

		$this->add_control(
			'number_column',
			[
				'label'   => esc_html__( 'Number Column', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
				'condition'   => [
					'style' => [ 'base','default','style-1','style-3','style-4' ]
				]
				
			]
		);

		$this->add_control(
			'time',
			[
				'label'   => esc_html__( 'Autoplay Timeout', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '10000',
				'condition'   => [
					'style' => [ 'base','default','style-1','style-3','style-4' ]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance['style'] = $settings['style'];

		$instance = array(
			'number' => $settings['number'],
			'number_column' => $settings['number_column'],
			'time'   => $settings['time'],
			'des'  => isset($settings['des']) ? $settings['des'] : '',
			'title'  => isset($settings['title']) ? $settings['title'] : '',
			'bg_title' => isset($settings['bg_title']) ? $settings['bg_title'] :''
		);

		$args                 = array();
		$args['before_title'] = '<h3 class="widget-title">';
		$args['after_title']  = '</h3>';

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance, 'args' => $args ), $settings['style'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Testimonial_Element() );
