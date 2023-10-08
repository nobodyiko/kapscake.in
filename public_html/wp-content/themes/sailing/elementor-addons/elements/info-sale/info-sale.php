<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Info_Sale_Element extends Widget_Base {

	public function get_name() {
		return 'thim-info-sale';
	}

	public function get_title() {
		return esc_html__( 'Thim: Info Sale', 'sailing' );
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
			'info_sale_settings',
			[
				'label' => esc_html__( 'Info Sale Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Style', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'    => esc_attr__( 'Style Old', 'sailing' ),
					"style-1" => esc_attr__( "Style 1", "sailing" )
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'       => esc_html__( 'Background Image', 'sailing' ),
				'type'        => Controls_Manager::MEDIA,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'condition' => [
					'style' => [ 'style-1' ]
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'sailing' ),
				'type'        => Controls_Manager::MEDIA,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'primary_title',
			[
				'label'       => esc_html__( 'Primary Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( 'Savings', 'sailing' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'second_title',
			[
				'label'       => esc_html__( 'Second Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				"default" => esc_html__( 'Red Hot Summer', 'sailing' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'short_content',
			[
				'label'       => esc_html__( 'Short Content', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				"default" => esc_html__( 'Red Hot Summer', 'sailing' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'text_link',
			[
				'label'       => esc_html__( 'Text Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn more', 'sailing' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'sailing' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'panel',
			[
				'label'       => esc_html__( 'Panel List', 'sailing' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ primary_title }}}',
				'separator'   => 'before'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'info-sale' => $settings['panel'],
			'style'     => $settings['style'],
			'bg_image'  => $settings['bg_image'] 
		);

		thim_get_widget_template( $this->get_base(), array(
			'instance' => $instance
		),$settings['style'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Info_Sale_Element() );
