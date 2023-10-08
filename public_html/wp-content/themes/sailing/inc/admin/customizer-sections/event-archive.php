<?php

thim_customizer()->add_section(
	array(
		'id'       => 'event_archive',
		'title'    => esc_html__( 'Archive', 'sailing' ),
		'panel'    => 'event',
		'priority' => 1,
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_event_cate_layout',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Archive Event Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Archive Event layout select.', 'sailing' ),
		'section' => 'event_archive',
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

thim_customizer()->add_field(
	array(
		'id'      => 'thim_event_layout_style',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Archive Event Layout Style', 'sailing' ),
		'tooltip' => esc_html__( 'Archive Event layout select style.', 'sailing' ),
		'section' => 'event_archive',
		'choices' => array(
			'layout-list'  => TP_THEME_URI . 'assets/images/admin/layout/event-layout-list.jpg',
			'layout-tab'  => TP_THEME_URI . 'assets/images/admin/layout/event-layout-tab.jpg',
		),
		'default' => 'layout-list',
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-2'
		)
	)
);