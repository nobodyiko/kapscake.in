<?php

// Right Drawer Options
thim_customizer()->add_section(
	array(
		'id'       => 'display_right_drawer',
		'title'    => esc_html__( 'Offcanvas Sidebar', 'sailing' ),
		'panel'    => 'header',
		'priority' => 16,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_show_offcanvas_sidebar',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Offcanvas', 'sailing' ),
		'tooltip' => esc_html__( 'Show Offcanvas', 'sailing' ),
		'section' => 'display_right_drawer',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_bg_offcanvas_sidebar_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background color', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color', 'sailing' ),
		'default'   => '#141414',
		'section'   => 'display_right_drawer',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.slider-sidebar',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_offcanvas_sidebar_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Text Color', 'sailing' ),
		'default'   => '#a9a9a9',
		'section'   => 'display_right_drawer',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.slider-sidebar p',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_offcanvas_sidebar_link_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Link Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Link Color', 'sailing' ),
		'default'   => '#ffffff',
		'section'   => 'display_right_drawer',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.slider-sidebar a',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_icon_offcanvas_sidebar',
		'type'    => 'text',
		'label'   => esc_html__( 'Icon', 'sailing' ),
		'tooltip' => esc_html__( 'Icon', 'sailing' ),
		'section' => 'display_right_drawer',
		'default' => 'fa-bars',
		'tooltip' => 'Enter <a href=\"http://fontawesome.io/icons/\" target=\"_blank\" >FontAwesome</a> icon name. For example: fa-bars, fa-user',
	)
);

