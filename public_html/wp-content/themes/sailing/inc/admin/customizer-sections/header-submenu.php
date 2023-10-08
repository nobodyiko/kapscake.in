<?php
// main menu

thim_customizer()->add_section(
	array(
		'id'       => 'display_sub_menu',
		'title'    => esc_html__( 'Sub Menu', 'sailing' ),
		'panel'    => 'header',
		'priority' => 6,
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_sub_menu_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Background Sub Menu', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for sub menu.', 'sailing' ),
		'section'   => 'display_sub_menu',
		'default'   => '#ffffff',
		'priority'  => 5,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.navigation .navbar-nav li.tc-menu-layout-default .sub-menu',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_sub_menu_border_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Color Border Bottom', 'sailing' ),
		'tooltip'   => esc_html__( 'Color Border Bottom for sub menu.', 'sailing' ),
		'section'   => 'display_sub_menu',
		'default'   => '#dddddd',
		'priority'  => 5,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.navigation .navbar-nav li.tc-menu-layout-default .sub-menu li:after',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_sub_menu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text/Link Color Sub Menu', 'sailing' ),
		'tooltip'   => esc_html__( 'Text color for sub menu.', 'sailing' ),
		'section'   => 'display_sub_menu',
		'default'   => '#666666',
		'priority'  => 6,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.navigation .navbar-nav > li .sub-menu a,
					.navigation .navbar-nav > li .sub-menu span',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_sub_menu_text_color_hover',
		'type'      => 'color',
		'label'     => esc_html__( 'Text/Link Sub Menu Color Hover', 'sailing' ),
		'tooltip'   => esc_html__( 'Text color for sub menu hover.', 'sailing' ),
		'section'   => 'display_sub_menu',
		'default'   => '#2eb0d1',
		'priority'  => 7,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.navigation .navbar-nav > li .sub-menu li:hover a,
					.navigation .navbar-nav > li .sub-menu li:hover span',
				'property' => 'color',
			)
		)
	)
);