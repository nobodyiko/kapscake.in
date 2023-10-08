<?php
thim_customizer()->add_section(
	array(
		'id'       => 'display_copyright',
		'title'    => esc_html__( 'Copyright', 'sailing' ),
		'panel'    => 'footer',
		'priority' => 12,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_show_to_top',
		'type'    => 'switch',
		'label'   => esc_html__( 'Back To Top', 'sailing' ),
		'tooltip' => esc_html__( 'Show or hide back to top', 'sailing' ),
		'section' => 'display_copyright',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_copyright_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Copyright Text Color', 'sailing' ),
		'section'   => 'display_copyright',
		'default'   => '#5a5a5a',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'footer#colophon .text-copyright .thim-widget-copyright .copyright-text',
				'property' => 'color',
			)
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_copyright_link_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Link Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Copyright Link Color', 'sailing' ),
		'section'   => 'display_copyright',
		'default'   => '#5a5a5a',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'footer#colophon .text-copyright .thim-widget-copyright .copyright-text a',
				'property' => 'color',
			)
		),
	)
);