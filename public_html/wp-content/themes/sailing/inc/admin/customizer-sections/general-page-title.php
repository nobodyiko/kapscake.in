<?php
thim_customizer()->add_section(
	array(
		'id'       => 'page_title',
		'title'    => esc_html__( 'Page Title', 'sailing' ),
		'panel'    => 'general',
		'priority' => 6,
	)
);


thim_customizer()->add_field(
	array(
		'id'            => 'thim_top_site_main_layout',
		'type'          => 'radio-image',
		'label'         => esc_html__( 'Page Title Layout', 'sailing' ),
		'tooltip'       => esc_html__( 'Page Title Layout.', 'sailing' ),
		'section'       => 'page_title',
		'choices'       => array(
			'layout-1' => TP_THEME_URI . 'assets/images/admin/layout/page-title-layout-1.jpg',
			'layout-2' => TP_THEME_URI . 'assets/images/admin/layout/page-title-layout-2.jpg',
		),
		'default'       => 'layout-1',
		'priority'      => 5,
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-1'
		)
	)
);
thim_customizer()->add_field(
	array(
		'id'      => 'disable_breadcrumb',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Breadcrumb', 'sailing' ),
		'tooltip' => esc_html__( 'hiden breadcrumb setting.', 'sailing' ),
		'section' => 'page_title',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'              => 'thim_page_title_top_image',
		'type'            => 'image',
		'label'           => esc_html__( 'Top Image', 'sailing' ),
		'tooltip'         => esc_html__( 'Select top image for blog page.', 'sailing' ),
		'section'         => 'page_title',
		'js_vars'         => array(
			array(
				'element'  => '.top_site_main',
				'function' => 'css',
				'property' => 'background-image',
			),
		),
		'default'         => TP_THEME_URI . 'assets/images/bg-blog.jpg',
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
		'id'        => 'thim_page_title_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Heading Background Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting background color top heading.', 'sailing' ),
		'section'   => 'page_title',
		'default'   => '#000000',
		'alpha'     => true,
		'transport' => 'postMessage',
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_page_title_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Heading Text Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Setting color top heading.', 'sailing' ),
		'section'   => 'page_title',
		'default'   => '#ffffff',
		'alpha'     => true,
		'transport' => 'postMessage',
	)
);
