<?php

thim_customizer()->add_section(
	array(
		'id'       => 'event_single',
		'title'    => esc_html__( 'Single', 'sailing' ),
		'panel'    => 'event',
		'priority' => 2,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_event_single_layout',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Single Event Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Single Event layout select.', 'sailing' ),
		'section' => 'event_single',
		'choices' => array(
			'full-content'  => TP_THEME_URI . 'assets/images/admin/layout/body-full.png',
			'sidebar-left'  => TP_THEME_URI . 'assets/images/admin/layout/sidebar-left.png',
			'sidebar-right' => TP_THEME_URI . 'assets/images/admin/layout/sidebar-right.png'
		),
		'default' => 'full-content',
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-3'
		)
	)
);