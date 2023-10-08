<?php
thim_customizer()->add_section(
	array(
		'id'       => 'share_archive',
		'title'    => esc_html__( 'Sharing', 'sailing' ),
		'panel'    => 'general',
		'priority' => 11,
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_sharing_facebook',
		'type'    => 'switch',
		'section' => 'share_archive',
		'label'   => esc_html__( 'Share Facebook', 'sailing' ),
		'tooltip' => esc_html__( 'Share on facebook.', 'sailing' ),
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_sharing_twitter',
		'type'    => 'switch',
		'section' => 'share_archive',
		'label'   => esc_html__( 'Share Twitter', 'sailing' ),
		'tooltip' => esc_html__( 'Share on twitter.', 'sailing' ),
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_sharing_google',
		'type'    => 'switch',
		'section' => 'share_archive',
		'label'   => esc_html__( 'Share Google', 'sailing' ),
		'tooltip' => esc_html__( 'Share on Google.', 'sailing' ),
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_archive_sharing_pinterest',
		'type'    => 'switch',
		'section' => 'share_archive',
		'label'   => esc_html__( 'Share Pinterest', 'sailing' ),
		'tooltip' => esc_html__( 'Share on Pinterest.', 'sailing' ),
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

