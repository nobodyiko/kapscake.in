<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Search_Room_Element extends Widget_Base {


	public function get_name() {
		return 'thim-search-room';
	}

	public function get_title() {
		return esc_html__( 'Thim: Search Room', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-courses-searching';
	}

	public function get_categories() {
		return array( 'thim-elements' );
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'search_room_settings',
			array(
				'label' => esc_html__( 'Search Room Settings', 'sailing' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Select Box Style Image', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'base'    => esc_attr__( 'Style Old', 'sailing' ),
					'default' => esc_attr__( 'Style New', 'sailing' ),
				),
				'default' => 'base',
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title', 'sailing' ),
				'default'     => 'Your Reservation',
				'condition'   => array(
					'style' => array( 'base' ),
				),
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'sailing' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2eb0d1',
				'condition' => array(
					'style' => array( 'base' ),
				),
			)
		);

		$this->add_control(
			'background_image',
			array(
				'label'     => esc_html__( 'Background Image', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'style' => array( 'base' ),
				),
			)
		);

		$this->add_control(
			'show_child',
			array(
				'label'     => esc_html__( 'Show Child', 'sailing' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'style' => array( 'default' ),
				),
			)
		);

		$this->add_control(
			'multidate',
			array(
				'label'     => esc_html__( 'Use MultiDate ', 'sailing' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'style' => array( 'base' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array();

		$instance['style'] = $settings['style'];

		$instance = array(
			'title'            => $settings['title'],
			'background_color' => $settings['background_color'],
			'background_image' => ( $settings['background_image'] ) ? $settings['background_image']['id'] : '',
			'show_child'       => $settings['show_child'],
			'multidate'	       => $settings['multidate'],
			'extra_class' =>  ($settings['style']  == 'base' && ! $settings['multidate']) ? ' thim-search-room' : ''
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), $settings['style'] );
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Search_Room_Element() );
