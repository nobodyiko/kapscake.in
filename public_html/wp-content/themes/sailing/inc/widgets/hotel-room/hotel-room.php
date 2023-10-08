<?php

/**
 * Created by PhpStorm.
 * User: dongc
 * Date: 05/23/2018
 * Time: 5:30 PM
 */
class Thim_Hotel_Room_Widget extends Thim_Widget {

	function __construct() {
		$list_cat = $this->thim_get_room_categories();
		parent::__construct(
			'hotel-room',
			esc_html__( 'Thim: Room Slider', 'sailing' ),
			array(
				'description'   => esc_html__( 'Hotel Room Slider', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'style_room'       => array(
					'type'          => 'select',
					'label'         => esc_html__( 'Style Layout Room', 'sailing' ),
					'options'       => array(
						'base'     => esc_html__( 'Default', 'sailing' ),
						'style_02' => esc_html__( 'Style 2', 'sailing' ),
						'style_03' => esc_html__( 'Style 3', 'sailing' ),
						'style_04' => esc_html__( 'Style 4', 'sailing' ),
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'style_room' )
					),
				),
				'list_room'        => array(
					'type'          => 'select',
					'label'         => esc_html__( 'Show Room By', 'sailing' ),
					'options'       => array(
						'room_type'   => esc_html__( 'Room Type', 'sailing' ),
						'room_new'    => esc_html__( 'Latest Rooms', 'sailing' ),
						'best_review' => esc_html__( 'Best Review', 'sailing' ),
						'last_review' => esc_html__( 'Last Review', 'sailing' ),
						'id_room'     => esc_html__( 'ID Room', 'sailing' ),
					),
					'default'       => 'room_new',
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'list_room' )
					),
				),
				'room_cat'         => array(
					'type'          => 'select',
					'label'         => esc_html__( 'Select Room Type', 'sailing' ),
					'default'       => 'all',
					'hide'          => true,
					'options'       => $list_cat,
					'state_handler' => array(
						'list_room[room_type]'   => array( 'show' ),
						'list_room[room_new]'    => array( 'hide' ),
						'list_room[best_review]' => array( 'hide' ),
						'list_room[last_review]' => array( 'hide' ),
						'list_room[id_room]'     => array( 'hide' ),
					),
				),
				'room_id'          => array(
					'type'          => 'text',
					'label'         => esc_html__( 'Room ID list', 'sailing' ),
					'description'   => esc_html__( 'Room ID list ex: 123,231 ...', 'sailing' ),
					'state_handler' => array(
						'list_room[room_type]'   => array( 'hide' ),
						'list_room[room_new]'    => array( 'hide' ),
						'list_room[best_review]' => array( 'hide' ),
						'list_room[last_review]' => array( 'hide' ),
						'list_room[id_room]'     => array( 'show' ),
					),
				),
				'number_show'      => array(
					'type'          => 'number',
					'label'         => esc_html__( 'Number of items', 'sailing' ),
					'default'       => '1',
					'state_handler' => array(
						'style_room[base]'     => array( 'show' ),
						'style_room[style_02]' => array( 'hide' ),
						'style_room[style_03]' => array( 'show' ),
						'style_room[style_04]' => array( 'show' ),
					),
				),
				'number_show_room' => array(
					'type'    => 'number',
					'label'   => esc_html__( 'Number of rooms to show', 'sailing' ),
					'default' => '8'
				),
				'show_button_room' => array(
					'type'          => 'select',
					'label'         => esc_html__( 'Show text all room', 'sailing' ),
					'default'       => 'no',
					'options'       => array(
						'yes' => esc_html__( 'Yes', 'sailing' ),
						'no'  => esc_html__( 'No', 'sailing' )
					),
					'description'   => esc_html__( 'Show text all for room.', 'sailing' ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'show_button_room' )
					),
					'state_handler' => array(
						'style_room[base]'     => array( 'show' ),
						'style_room[style_02]' => array( 'hide' ),
						'style_room[style_03]' => array( 'show' ),
						'style_room[style_04]' => array( 'show' ),
					),
				),
				'link_room'        => array(
					'type'          => 'text',
					'label'         => esc_html__( 'Link To Room', 'sailing' ),
					'description'   => esc_html__( 'Add link you want.', 'sailing' ),
					'default'       => '#',
					'state_handler' => array(
						'show_button_room[yes]' => array( 'show' ),
						'show_button_room[no]'  => array( 'hide' ),
					),
				),
				'link_to_room'     => array(
					'type'          => 'text',
					'label'         => esc_html__( 'Text Link All Room', 'sailing' ),
					'description'   => esc_html__( 'Text Link All Room.', 'sailing' ),
					'default'       => 'Link All Room',
					'state_handler' => array(
						'show_button_room[yes]' => array( 'show' ),
						'show_button_room[no]'  => array( 'hide' ),
					),
				),
				'link_target'      => array(
					'type'          => 'select',
					'label'         => esc_html__( 'Link Target', 'sailing' ),
					'default'       => '_self',
					'options'       => array(
						'_self'  => esc_html__( 'Same window', 'sailing' ),
						'_blank' => esc_html__( 'New window', 'sailing' ),
					),
					'state_handler' => array(
						'show_button_room[yes]' => array( 'show' ),
						'show_button_room[no]'  => array( 'hide' ),
					),
				),
				'pagination'       => array(
					'type'          => 'checkbox',
					'label'         => esc_html__( 'Show pagination', 'sailing' ),
					'default'       => false,
					'state_handler' => array(
						'style_room[base]'     => array( 'show' ),
						'style_room[style_02]' => array( 'hide' ),
						'style_room[style_03]' => array( 'show' ),
						'style_room[style_04]' => array( 'show' ),
					),
				),
				
				'navigation'       => array(
					'type'          => 'checkbox',
					'label'         => esc_html__( 'Show navigation', 'sailing' ),
					'default'       => true,
					'state_handler' => array(
						'style_room[base]'     => array( 'show' ),
						'style_room[style_02]' => array( 'hide' ),
						'style_room[style_03]' => array( 'show' ),
						'style_room[style_04]' => array( 'show' ),
					),
				),
				'nagination_position' => array(
					'type'          => 'select',
					'label'         => esc_html__( 'Nagination Position', 'sailing' ),
					'default'       => 'top',
					'options'       => array(
						'top' => esc_html__( 'Top', 'sailing' ),
						'bottom'  => esc_html__( 'Bottom', 'sailing' )
					),
					'state_handler' => array(
						'style_room[base]'     => array( 'show' ),
						'style_room[style_02]' => array( 'hide' ),
						'style_room[style_03]' => array( 'show' ),
						'style_room[style_04]' => array( 'hide' ),
					),
				),
				'image_background' => array(
					'type'          => 'media',
					'label'         => esc_html__( 'Image Background', 'sailing' ),
					'description'   => esc_html__( 'Select image from media library.', 'sailing' ),
					'state_handler' => array(
						'style_room[base]'     => array( 'hide' ),
						'style_room[style_02]' => array( 'show' ),
						'style_room[style_03]' => array( 'hide' ),
						'style_room[style_04]' => array( 'hide' ),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/hotel-room/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return isset( $instance['style_room'] ) ? $instance['style_room'] : 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

	// Get list category
	function thim_get_room_categories( $cats = false ) {
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
		if ( !empty( $query ) ) {
			foreach ( $query as $key => $value ) {
				$cats[$value->term_id] = $value->name;
			}
		}

		return $cats;
	}
}

function thim_hotel_room_slider_widget() {
	register_widget( 'Thim_Hotel_Room_Widget' );
}

add_action( 'widgets_init', 'thim_hotel_room_slider_widget' );