<?php
/*
 * Hotel Boking Search Page Setting
 */
thim_customizer()->add_section(
	array(
		'id'       => 'hb_search_page',
		'title'    => esc_html__( 'Search Page', 'sailing' ),
		'panel'    => 'hotel-booking',
		'priority' => 4,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_search_page_layout',
		'label'   => esc_html__( 'Search Page Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Search Page Layout', 'sailing' ),
		'type'    => 'radio-image',
		'section' => 'hb_search_page',
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
		'id'      => 'thim_hb_filter_show',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Filter', 'sailing' ),
		'tooltip' => esc_html__( 'Show filter on search page', 'sailing' ),
		'section' => 'hb_search_page',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);