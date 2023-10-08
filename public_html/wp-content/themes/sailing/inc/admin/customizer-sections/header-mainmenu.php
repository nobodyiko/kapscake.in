<?php
// main menu
thim_customizer()->add_section(
	array(
		'id'       => 'display_main_menu',
		'title'    => esc_html__( 'Main Menu', 'sailing' ),
		'panel'    => 'header',
		'priority' => 5,
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_bg_main_menu_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background color', 'sailing' ),
		'tooltip'   => esc_html__( 'Pick a background color for main menu. It is working only header 2.', 'sailing' ),
		'section'   => 'display_main_menu',
		'alpha'     => true,
		'default'   => 'rgba(255,255,255,0)',
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.width-navigation .navbar-nav',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_main_menu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text color', 'sailing' ),
		'tooltip'   => esc_html__( 'Pick a text color for main menu', 'sailing' ),
		'section'   => 'display_main_menu',
		'alpha'     => true,
		'transport' => 'postMessage',
		'default'   => '#ffffff',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.navigation .navbar-nav > li > a,
					.navigation .navbar-nav > li > span',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_main_menu_text_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Hover color', 'sailing' ),
		'tooltip'   => esc_html__( 'Pick a text hover color for main menu', 'sailing' ),
		'section'   => 'display_main_menu',
		'alpha'     => true,
		'transport' => 'postMessage',
		'default'   => '#2eb0d1',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.navigation .navbar-nav > li.current-menu-item > a,
					.navigation .navbar-nav > li:hover > a,
					.navigation .navbar-nav > li.current-menu-item > span,
				    .navigation .navbar-nav > li:hover > span',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_main_menu',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts Main Menu', 'sailing' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for main menu. ', 'sailing' ),
		'section'   => 'display_main_menu',
		'default'   => array(
			'font-family'    => 'Roboto',
			'variant'        => '700',
			'font-size'      => '13px',
			'line-height'    => '2.33em',
			'text-transform' => 'uppercase',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-family',
				'element'  => '
					.navigation .navbar-nav > li > a,
					.navigation .navbar-nav > li > span',
				'property' => 'font-family',
			),
			array(
				'choice'   => 'variant',
				'element'  => '
					.navigation .navbar-nav > li > a,
					.navigation .navbar-nav > li > span',
				'property' => 'font-weight',
			),
			array(
				'choice'   => 'font-size',
				'element'  => '
					.navigation .navbar-nav > li > a,
					.navigation .navbar-nav > li > span',
				'property' => 'font-size',
			),
			array(
				'choice'   => 'line-height',
				'element'  => '
					.navigation .navbar-nav > li > a,
					.navigation .navbar-nav > li > span',
				'property' => 'line-height',
			),
			array(
				'choice'   => 'text-transform',
				'element'  => '
					.navigation .navbar-nav > li > a,
					.navigation .navbar-nav > li > span',
				'property' => 'text-transform',
			),
		)
	)
);