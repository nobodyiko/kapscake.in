<?php
thim_customizer()->add_section(
	array(
		'id'       => 'styling_layout',
		'title'    => esc_html__( 'Layout', 'sailing' ),
		'panel'    => 'general',
		'priority' => 7,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_box_layout',
		'type'    => 'select',
		'section' => 'styling_layout',
		'label'   => esc_html__( 'Select A Layout Your Site', 'sailing' ),
		'tooltip' => esc_html__( 'Select a layout your site you want.', 'sailing' ),
		'choices' => array(
			'boxed' => 'Boxed',
			'wide'  => 'Wide',
		),
		'default' => 'wide',
	)
);

// width container
thim_customizer()->add_field(
    array(
        'id'          => 'thim_body_container',
        'type'        => 'dimension',
        'label'       => esc_html__( 'Max width container','sailing' ),
        'tooltip'     => esc_html__( 'Allow to assign a value for body width. Example: 10px, 3em, 48%, 90vh, ...','sailing' ),
        'section'     => 'styling_layout',
        'default'     => '1200px',
        'priority'    => 40,
        'choices'     => array(
            'min'  => 1200,
            'max'  => 1600,
            'step' => 5,
        ),
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'choice'   => 'width',
                'element'  => 'body .container',
                'property' => 'max-width',
            )
        )
    )
);