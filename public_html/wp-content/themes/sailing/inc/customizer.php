<?php
/**
 * Charity WP Customizer.
 *
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function thim_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register', 'thim_customize_register' );

if ( thim_plugin_active( 'thim-core' ) ) {
	require_once TP_THEME_DIR . 'inc/admin/customize-options.php';
}
