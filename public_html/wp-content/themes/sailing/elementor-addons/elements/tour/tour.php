<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Tour_Element extends Widget_Base {

	public function get_name() {
		return 'thim-tour';
	}

	public function get_title() {
		return esc_html__( 'Thim: Tour', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-portfolio';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'tour_settings',
			[
				'label' => esc_html__( 'Tour Settings', 'sailing' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'sailing' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => esc_html__( 'Name', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'default'     => 'Name Default'
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your link here', 'sailing' ),
				'label_block' => true,
				'default'     => '#'
			]
		);

		$repeater->add_control(
			'info_sale',
			[
				'label'       => esc_html__( 'Info Sale', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Info Sale', 'sailing' ),
				'label_block' => true,
				'default'     => '40% Off'
			]
		);

		$repeater->add_control(
			'price',
			[
				'label'       => esc_html__( 'Price', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your price here', 'sailing' ),
				'label_block' => true,
				'default'     => '$300'
			]
		);

		$this->add_control(
			'panel',
			[
				'label'       => esc_html__( 'Panel List', 'sailing' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'number_show',
			[
				'label'   => esc_html__( 'Number Of Items', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'tours'       => $settings['panel'],
			'number_show' => $settings['number_show'],
		);
		
		require THIM_EL_ADDONS_PATH . 'tour/tpl/base.php';
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Tour_Element() );
