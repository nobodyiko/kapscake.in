<?php
/*
 * Archive Hotel Boking Setting
 */
thim_customizer()->add_section(
	array(
		'id'       => 'hb_archive',
		'title'    => esc_html__( 'Archive', 'sailing' ),
		'panel'    => 'hotel-booking',
		'priority' => 1,
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_cate_layout',
		'label'   => esc_html__( 'Archive Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Archive Layout', 'sailing' ),
		'type'    => 'radio-image',
		'section' => 'hb_archive',
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
		'id'      => 'thim_hb_cate_style_layout',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Style Rooms', 'sailing' ),
		'tooltip' => esc_html__( 'Select Style Rooms.', 'sailing' ),
		'section' => 'hb_archive',
		'default' => 'base',
		'choices' => array(
			'base'  	=> TP_THEME_URI . 'assets/images/admin/layout/room-layout-1.jpg',
			'layout-1'  => TP_THEME_URI . 'assets/images/admin/layout/room-layout-2.jpg',
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-2'
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_cate_hide_title',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show title.', 'sailing' ),
		'section' => 'hb_archive',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_cate_custom_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Hotel Booking Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hotel Booking Title', 'sailing' ),
		'section' => 'hb_archive',
		'default' => 'Sailing Hotel',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_cate_sub_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Sub Title', 'sailing' ),
		'tooltip' => esc_html__( 'Sub Title', 'sailing' ),
		'section' => 'hb_archive',
		'default' => '',
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_hb_cate_top_image',
		'type'     => 'image',
		'label'    => esc_html__( 'Top Image', 'sailing' ),
		'tooltip'  => esc_html__( 'Select Image top header for our team page.', 'sailing' ),
		'section'  => 'hb_archive',
		'default'  => TP_THEME_URI . 'assets/images/bg-blog.jpg',
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout',
				'operator' => '==',
				'value'    => 'layout-1',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_hb_cate_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for header.', 'sailing' ),
		'section'   => 'hb_archive',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main',
				'property' => 'background-color',
			)
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_hb_cate_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color Heading', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for header.', 'sailing' ),
		'section'   => 'hb_archive',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main .page-title-wrapper .banner-wrapper .heading__secondary',
				'property' => 'color',
			)
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_cate_enable_sort',
		'type'    => 'switch',
		'label'   => esc_html__( 'Enable Sort', 'sailing' ),
		'tooltip' => esc_html__( 'Enable/Disable Sort.', 'sailing' ),
		'section' => 'hb_archive',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_hb_cate_style_layout',
				'operator' => '==',
				'value'    => 'layout-1',
			),
		),
	)
);
