<?php

if ( is_admin() ) {
	/*
	   * prefix of meta keys, optional
	   */
	$prefix = 'thim_';

	/*
	   * configure your meta box
	   */
	$config = array(
		'id'             => 'category_meta_box', // meta box id, unique per meta box
		'title'          => esc_html__( 'Category Meta Box', 'sailing' ), // meta box title
		'pages'          => array( 'hb_room_type', 'product_cat' ), // taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(), // list of meta fields (can be added by field arrays)
		'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => get_template_directory_uri() . '/inc/libs/Tax-meta-class' //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$taxonomy   = ! empty( $_REQUEST['taxonomy'] ) ? $_REQUEST['taxonomy'] : 'category';
	$top_prefix = $cate_prefix = '';
	if ( $taxonomy == 'product_cat' ) {
		$top_prefix  = 'woo_';
		$cate_prefix = 'woo_cate_';
	} elseif ( $taxonomy == 'hb_room_type' ) {
		$top_prefix  = 'hb_room_';
		$cate_prefix = 'hb_room_type_';
	}

	$my_meta = new Tax_Meta_Class( $config );

	$my_meta->addCheckbox( $prefix . 'custom_heading', array(
		'name' => esc_html__( 'Custom Heading ', 'sailing' ),
		'std'  => ''
	) );

	$my_meta->addImage( $prefix . $top_prefix . 'top_image', array( 'name' => esc_html__( 'Background Image Heading', 'sailing' ) ) );
	$my_meta->Finish();
}
