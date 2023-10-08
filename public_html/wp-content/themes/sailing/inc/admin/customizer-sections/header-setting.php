<?php
thim_customizer()->add_section(
	array(
		'id'       => 'display_header_settings',
		'title'    => esc_html__( 'Header', 'sailing' ),
		'panel'    => 'header',
		'priority' => 2,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_header_style',
		'type'    => 'radio-image',
		'label'   => esc_html__( 'Select a Layout', 'sailing' ),
		'tooltip' => esc_html__( 'Select a Layout for header', 'sailing' ),
		'section' => 'display_header_settings',
		'choices' => array(
			'header_v1' => TP_THEME_URI . 'assets/images/admin/header/header_v1.jpg',
			'header_v2' => TP_THEME_URI . 'assets/images/admin/header/header_v2.jpg',
			'header_v3' => TP_THEME_URI . 'assets/images/admin/header/header_v3.jpg',
		),
		'default' => 'header_v1',
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'enable_fullwidth',
		'type'    => 'switch',
		'label'   => esc_html__( ' Full Width', 'sailing' ),
		'tooltip' => esc_html__( 'Turn On/Off full width header.', 'sailing' ),
		'section' => 'display_header_settings',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_header_style',
				'operator' => '==',
				'value'    => 'header_v1',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_header_position',
		'type'    => 'switch',
		'label'   => esc_html__( 'Header Overlay', 'sailing' ),
		'tooltip' => esc_html__( 'Turn On/Off header overlay.', 'sailing' ),
		'section' => 'display_header_settings',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_header_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for header.', 'sailing' ),
		'section'   => 'display_header_settings',
		'default'   => 'rgba(255,255,255,0)',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header.site-header',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_header_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Text Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Text color for header version 2.', 'sailing' ),
		'section'   => 'display_header_settings',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header.site-header p, header.site-header b, header.site-header a',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_header_text_color_hover',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Color Hover', 'sailing' ),
		'tooltip'   => esc_html__( 'Header color hover for header version 2.', 'sailing' ),
		'section'   => 'display_header_settings',
		'default'   => '#2eb0d1',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim-select-language .language ul li a:hover',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_header_typography',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts', 'sailing' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for header. ', 'sailing' ),
		'section'   => 'display_header_settings',
		'default'   => array(
			'font-family' => 'Roboto',
			'variant'     => '700',
			'font-size'   => '13px',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-family',
				'element'  => 'header.site-header p, header.site-header b, header.site-header a',
				'property' => 'font-family',
			),
			array(
				'choice'   => 'variant',
				'element'  => 'header.site-header p, header.site-header b, header.site-header a',
				'property' => 'font-weight',
			),
			array(
				'choice'   => 'font-size',
				'element'  => 'header.site-header p, header.site-header b, header.site-header a',
				'property' => 'font-size',
			),
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'header_search_display',
		'type'    => 'switch',
		'label'   => esc_html__( 'Header Search Display', 'sailing' ),
		'tooltip' => esc_html__( 'Turn On/Off header search display.', 'sailing' ),
		'section' => 'display_header_settings',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);