<?php

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package thim
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 *
 * @return array
 */
function thim_page_menu_args( $args ) {
	$args['show_home'] = true;

	return $args;
}

add_filter( 'wp_page_menu_args', 'thim_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function thim_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_theme_mod( 'thim_user_bg_pattern' ) == true ) {
		if ( get_theme_mod( 'thim_bg_pattern_upload' ) <> '' ) {
			$classes[] = 'bg-type-image';
		} else {
			$classes[] = 'bg-type-pattern';
		}
	} else {
		$classes[] = 'bg-type-color';
	}

	if( get_theme_mod( 'thim_blog_layout', 'layout-1') == 'layout-2' && 'post' == get_post_type() ){
		$classes[] = 'blog-layout-2';
	}
	if ( class_exists( 'WP_Hotel_Booking' ) || class_exists( 'TP_Hotel_Booking' ) ) {
		if ( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' && ('hb_room' == get_post_type() || is_page(hb_get_page_id('search')) || in_array( 'wp-hotel-booking-rooms', $classes ) || in_array( 'post-type-archive-hb_room', $classes ) || in_array( 'wp-hotel-booking-cart', $classes )) ) {
			$classes[] = 'rooms-layout-2';
		}

		if ( ('hb_room' == get_post_type() || is_page(hb_get_page_id('search')) ) &&  get_theme_mod( 'thim_hb_filter_show', false ) == true) {
			$classes[] = 'show-filter';
		}

		if ( get_theme_mod( 'thim_hb_single_style', 'layout-1' ) == 'layout-2' && is_singular('hb_room')) {
			$classes[] = 'single-room-layout-2';
		}
	}

	return $classes;
}

add_filter( 'body_class', 'thim_body_classes' );


/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function thim_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}

add_action( 'wp', 'thim_setup_author' );
