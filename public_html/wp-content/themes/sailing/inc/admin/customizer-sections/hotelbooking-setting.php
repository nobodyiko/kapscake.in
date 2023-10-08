<?php
/*
 * Single Hotel Booking Display Settings
 */
thim_customizer()->add_section(
	array(
		'id'       => 'hb_setting',
		'title'    => esc_html__( 'Settings', 'sailing' ),
		'panel'    => 'hotel-booking',
		'priority' => 5,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_children_show',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Children', 'sailing' ),
		'tooltip' => esc_html__( 'Show children if is On.', 'sailing' ),
		'section' => 'hb_setting',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_adults_show',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Adults', 'sailing' ),
		'tooltip' => esc_html__( 'Show adults if is On.', 'sailing' ),
		'section' => 'hb_setting',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_show_info_room',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show More Info Room', 'sailing' ),
		'tooltip' => esc_html__( 'Show More Info Room get from Excerpt room.', 'sailing' ),
		'section' => 'hb_setting',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);