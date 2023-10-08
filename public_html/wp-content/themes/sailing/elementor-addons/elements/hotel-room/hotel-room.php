<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Hotel_Room_Element extends Widget_Base {

	public function get_name() {
		return 'thim-hotel-room';
	}

	public function get_title() {
		return esc_html__( 'Thim: Room Slider', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-carousel-categories';
	}
	
	protected function get_html_wrapper_class() {
		return 'thim-widget-hotel-room';
	} 

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	//Get list post categories
	public function thim_get_room_categories( $cats = false ) {
		global $wpdb;
		$query = $wpdb->get_results( $wpdb->prepare(
			"
				  SELECT      t1.term_id, t2.name
				  FROM        $wpdb->term_taxonomy AS t1
				  INNER JOIN $wpdb->terms AS t2 ON t1.term_id = t2.term_id
				  WHERE t1.taxonomy = %s
				  AND t1.count > %d
				  ",
			'hb_room_type', 0
		) );

		if ( empty( $cats ) ) {
			$cats = array();
		}
		if ( ! empty( $query ) ) {
			foreach ( $query as $key => $value ) {
				$cats[ $value->term_id ] = $value->name;
			}
		}

		return $cats;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'hotel_room_settings',
			[
				'label' => esc_html__( 'Room Slider Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style_room',
			[
				'label'   => esc_html__( 'Select Box Style Image', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'     => esc_attr__( 'Default', 'sailing' ),
					'style_02' => esc_attr__( 'Style 2', 'sailing' ),
					'style_03' => esc_attr__( 'Style 3', 'sailing' ),
					'style_04' => esc_html__( 'Style 4', 'sailing' ),
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'list_room',
			[
				'label'   => esc_html__( 'Select Box Style Image', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'room_type'   => esc_html__( 'Room Type', 'sailing' ),
					'room_new'    => esc_html__( 'Latest Rooms', 'sailing' ),
					'best_review' => esc_html__( 'Best Review', 'sailing' ),
					'last_review' => esc_html__( 'Last Review', 'sailing' ),
					'id_room'     => esc_html__( 'ID Room', 'sailing' ),
				],
				'default' => 'room_new',
			]
		);

		$this->add_control(
			'room_cat',
			[
				'label'     => esc_html__( 'Select Room Type', 'sailing' ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => false,
				'options'   => $this->thim_get_room_categories(),
				'condition' => [
					'list_room' => [ 'room_type' ]
				]
			]
		);

		$this->add_control(
			'room_id',
			[
				'label'       => esc_html__( 'Room ID List', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Room ID list ex: 123,231 ...', 'sailing' ),
				'default'     => '',
				'condition'   => [
					'list_room' => [ 'id_room' ]
				]
			]
		);

		$this->add_control(
			'number_show',
			[
				'label'     => esc_html__( 'Number Of Items', 'sailing' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '1',
				'condition' => [
					'style_room' => [ 'base', 'style_03', 'style_04' ]
				]
			]
		);

		$this->add_control(
			'number_show_room',
			[
				'label'   => esc_html__( 'Number of rooms to show', 'sailing' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '8'
			]
		);

		$this->add_control(
			'show_button_room',
			[
				'label'     => esc_html__( 'Show Text All Room', 'sailing' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'yes' => esc_attr__( 'Yes', 'sailing' ),
					'no'  => esc_attr__( 'No', 'sailing' )
				],
				'default'   => 'no',
				'condition' => [
					'style_room' => [ 'base', 'style_03', 'style_04' ]
				]
			]
		);

		$this->add_control(
			'link_to_room',
			[
				'label'       => esc_html__( 'Text Link Room', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add text in button link all room', 'sailing' ),
				'default'     => '',
				'condition'   => [
					'show_button_room' => [ 'yes' ],

				]
			]
		);

		$this->add_control(
			'link_room',
			[
				'label'         => __( 'Link Room', 'sailing' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'sailing' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
				'condition'     => [
					'show_button_room' => [ 'yes' ],
				]
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'     => esc_html__( 'Show Pagination', 'sailing' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => [
					'style_room' => [ 'base', 'style_03', 'style_04' ]
				]
			]
		);
		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Show Navigation', 'sailing' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => [
					'style_room' => [ 'base', 'style_03', 'style_04' ]
				]
			]
		);

		$this->add_control(
			'nagination_position',
			[
				'label'     => esc_html__( 'Nagination Position', 'sailing' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'top' => esc_attr__( 'Top', 'sailing' ),
					'bottom'  => esc_attr__( 'Bottom', 'sailing' )
				],
				'default'   => 'top',
				'condition' => [
					'style_room' => [ 'base', 'style_03' ]
				]
			]
		);

		$this->add_control(
			'image_background',
			[
				'label'     => esc_html__( 'Image Background', 'sailing' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style_room' => [ 'style_02' ]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array();

		$instance['style_room'] = $settings['style_room'];

		$instance = array(
			'list_room'        => $settings['list_room'],
			'room_cat'         => $settings['room_cat'],
			'room_id'          => $settings['room_id'],
			'number_show'      => $settings['number_show'],
			'number_show_room' => $settings['number_show_room'],
			'show_button_room' => $settings['show_button_room'],
			'link_room'        => isset( $settings['link_room']['url'] ) ? $settings['link_room']['url'] : '',
			'link_to_room'     => $settings['link_to_room'],
			'pagination'       => $settings['pagination'],
			'navigation'       => $settings['navigation'],
			'nagination_position' => $settings['nagination_position'],
			'image_background' => isset( $settings['image_background']['id'] ) ? $settings['image_background']['id'] : ''
		);

		if ( isset($settings['link_room']['is_external'] ) && $settings['link_room']['is_external'] == 1 ) {
			$instance['link_target'] = '_blank';
		} else {
			$instance['link_target'] = '_self';
		}

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), $settings['style_room'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Hotel_Room_Element() );
