<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Single_Post_Element extends Widget_Base {

	public function get_name() {
		return 'thim-single-post';
	}

	public function get_title() {
		return esc_html__( 'Thim: Single Post', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-list-post';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}
	protected function register_controls() {
		$this->start_controls_section(
			'single_post_settings',
			[
				'label' => esc_html__( 'Single Post Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'         => esc_attr__( 'Default', 'sailing' ),
					'style-1' => esc_attr__( 'Style 1', 'sailing' ),
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => esc_html__('From Blog','siling'),
			]
		);
		$this->add_control(
			'position_title',
			[
				'label'   => esc_html__( 'Title Position', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left' 	=> esc_html__( 'Left', 'sailing' ),
					'right'  	=> esc_html__( 'Right', 'sailing' ),
					'center'  	=> esc_html__( 'Center', 'sailing' ),
				],
				'default' => 'left',
			]
		);

		$this->add_control(
			'show_bg_color',
			[
				'label'   => esc_html__( 'Show  Background Color', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'yes' 	=> esc_html__( 'Yes', 'sailing' ),
					'no'  	=> esc_html__( 'No', 'sailing' ),
					
				],
				'default' => 'yes',
				'condition' => [
					'style' => [ 'base']
				]
			]
		);

		$this->add_control(
			'show_text_link',
			[
				'label'   => esc_html__( 'Show Text Link', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'yes' 	=> esc_html__( 'Yes', 'sailing' ),
					'no'  	=> esc_html__( 'No', 'sailing' ),
					
				],
				'default' => 'no',
				'condition' => [
					'style' => [ 'base']
				]
			]
		);

		$this->add_control(
			'text_link',
			[
				'label'       => esc_html__( 'Text Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Text Link', 'sailing' ),
				'condition' => [
					'show_text_link' => [ 'yes']
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => esc_html__( 'Link All Post', 'sailing' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => esc_html__('#','sailing'),
				'condition' => [
					'show_text_link' => [ 'yes']
				]
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'    => esc_html__( 'Post  ID', 'sailing' ),
				'type'     => Controls_Manager::TEXT,
				'description' => esc_html__('Enter only 1 post ID','sailing'),
				
			]
		);

		$this->add_control(
			'position_content',
			[
				'label'   => esc_html__( 'Content Position', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left' 	=> esc_html__( 'Left', 'sailing' ),
					'right'  	=> esc_html__( 'Right', 'sailing' ),
					
				],
				'default' => 'right',
			]
		);
		
		$this->add_control(
			'show_post_link',
			[
				'label'   =>  esc_html__( 'Show  Post Link', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'yes' 	=> esc_html__( 'Yes', 'sailing' ),
					'no'  	=> esc_html__( 'No', 'sailing' ),
					
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'post_text_link',
			[
				'label'       => esc_html__( 'Text Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__('Discover now','sailing'),
				'condition' => [
					'show_post_link' => [ 'yes']
				]
			]
		);
		
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'title'            => $settings['title'],
			'position_title'   => $settings['position_title'],
			'show_bg_color'    => $settings['show_bg_color'],
			'position_content'   => $settings['position_content'],
			'post_id'           => $settings['post_id'],
			'show_text_link'   => $settings['show_text_link'],
			'link'             => isset($settings['link']) ? $settings['link'] :'',
			'text_link'        => isset($settings['text_link']) ? $settings['text_link'] : '',
			'show_post_link'   => $settings['show_post_link'],
			'post_text_link'   => $settings['post_text_link'],
			'style'            => $settings['style']
		);

		$args                 = array();
		$args['before_title'] = '<h3 class="widget-title">';
		$args['after_title']  = '</h3>';
		$style = $instance['style'];
		
		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance, 'args' => $args ),$style );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Single_Post_Element() );
