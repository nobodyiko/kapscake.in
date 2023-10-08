<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Counter_Box_Element extends Widget_Base {

	public function get_name() {
		return 'thim-counter-box';
	}

	public function get_title() {
		return esc_html__( 'Thim: Counters Box', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-counters-box';
	}

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {

		wp_enqueue_script( 'thim-counters-box', TP_THEME_URI . 'inc/widgets/counters-box/js/counters-box.js', array( 'jquery' ), '', true );

		$this->start_controls_section(
			'counter_box_settings',
			[
				'label' => esc_html__( 'Counters Box Settings', 'sailing' )
			]
		);

		$this->add_control(
			'counters_label',
			[
				'label'       => esc_html__( 'Counters Label', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'default'     => ''
			]
		);

		$this->add_control(
			'counters_value',
			[
				'label'   => esc_html__( 'Counters Value', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 20,
				'min'     => 0,
				'step'    => 1
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => esc_html__( 'Select Icon:', 'sailing' ),
				'type'        => Controls_Manager::ICON,
				'placeholder' => esc_html__( 'Choose...', 'sailing' )
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'   => esc_html__( 'Border Icon Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);

		$this->add_control(
			'counter_color',
			[
				'label'   => esc_html__( 'Counters Color', 'sailing' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);

		$this->add_control(
			'css_animation',
			[
				'label'   => esc_html__( 'CSS Animation', 'hotel-wp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''              => esc_attr__( 'No', 'hotel-wp' ),
					'top-to-bottom' => esc_attr__( 'Top to bottom', 'hotel-wp' ),
					'bottom-to-top' => esc_attr__( 'Bottom to top', 'hotel-wp' ),
					'left-to-right' => esc_attr__( 'Left to right', 'hotel-wp' ),
					'right-to-left' => esc_attr__( 'Right to left', 'hotel-wp' ),
					'appear'        => esc_attr__( 'Appear from center', 'hotel-wp' )
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
			'counters_label' => $settings['counters_label'],
			'counters_value' => $settings['counters_value'],
			'icon'           => $settings['icon'],
			'border_color'   => $settings['border_color'],
			'counter_color'  => $settings['counter_color'],
			'css_animation'  => $settings['css_animation']
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ) );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Counter_Box_Element() );
