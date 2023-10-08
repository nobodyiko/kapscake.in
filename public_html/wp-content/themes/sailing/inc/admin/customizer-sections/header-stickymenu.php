<?php

// header Options
thim_customizer()->add_section(
	array(
		'id'       => 'display_header_menu',
		'title'    => esc_html__( 'Sticky Menu', 'sailing' ),
		'panel'    => 'header',
		'priority' => 14,
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_header_sticky',
		'type'     => 'switch',
		'label'    => esc_html__( 'Menu Sticky', 'sailing' ),
		'tooltip'  => esc_html__( 'Turn On/Off menu sticky when up scroll mouse.', 'sailing' ),
		'section'  => 'display_header_menu',
		'default'  => true,
		'priority' => 3,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_config_att_sticky',
		'type'    => 'select',
		'label'   => esc_html__( 'Config Sticky Menu?', 'sailing' ),
		'tooltip' => 'Select style menu',
		'section' => 'display_header_menu',
		'choices' => array(
			'sticky_same'   => esc_html__( 'The same with main menu', 'sailing' ),
			'sticky_custom' => esc_html__( 'Custom', 'sailing' )
		),
		'default' => 'sticky_custom'
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_sticky_bg_main_menu_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Sticky Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for menu sticky.', 'sailing' ),
		'section'   => 'display_header_menu',
		'default'   => '#ffffff',
		'priority'  => 4,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.bg-custom-sticky.affix',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_sticky_main_menu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Text/Link Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Header text color for menu sticky.', 'sailing' ),
		'section'   => 'display_header_menu',
		'default'   => '#2a2a2a',
		'priority'  => 5,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.bg-custom-sticky.affix .navbar-nav > li > a,
					.bg-custom-sticky.affix .navbar-nav > li > span',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_sticky_main_menu_text_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Text/Link Color Hover', 'sailing' ),
		'tooltip'   => esc_html__( 'Header text color for menu sticky hover.', 'sailing' ),
		'section'   => 'display_header_menu',
		'default'   => '#2eb0d1',
		'priority'  => 6,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.bg-custom-sticky.affix .navbar-nav > li.current-menu-item > a span,
					.bg-custom-sticky.affix .navbar-nav > li .current-menu-ancestor > a span,
					.bg-custom-sticky.affix .navbar-nav > li:hover > a span,
					.bg-custom-sticky.affix .navbar-nav > li.current-menu-item > span span,
					.bg-custom-sticky.affix .navbar-nav > li .current-menu-ancestor > span span,
					.bg-custom-sticky.affix .navbar-nav > li:hover > span span',
				'property' => 'color',
			)
		)
	)
);