<?php
add_action( 'thim_logo', 'thim_logo', 1 );
if ( ! function_exists( 'thim_logo' ) ) :
	function thim_logo() {
		$thim_logo_src = TP_THEME_URI . 'assets/images/logo.png';
		if ( get_theme_mod( 'thim_logo' ) <> '' ) {
			$thim_logo = get_theme_mod( 'thim_logo' );
			if ( $thim_logo ) {
				$thim_logo_src = $thim_logo;
			} else {
				$thim_logo_src = get_template_directory_uri() . 'assets/images/logo.png';
			}
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="no-sticky-logo no-mobile-logo"><img src="' . $thim_logo_src . '" alt="' . $site_title . '" /></a>';
		} else {
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="no-sticky-logo no-mobile-logo"><img src="' . $thim_logo_src . '" alt="' . $site_title . '" /></a>';
		}
	}
endif;


add_action( 'thim_mobile_logo', 'thim_mobile_logo', 1 );
if ( ! function_exists( 'thim_mobile_logo' ) ) :
	function thim_mobile_logo() {
		$thim_logo_src    = TP_THEME_URI . 'assets/images/sticky-logo.png';
		$thim_mobile_logo = get_theme_mod( 'thim_mobile_logo' );
		if ( $thim_mobile_logo ) {
			$thim_logo_src = $thim_mobile_logo;
		}
		$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="mobile-logo"><img src="' . $thim_logo_src . '" alt="' . $site_title . '" /></a>';
	}
endif;


add_action( 'thim_sticky_logo', 'thim_sticky_logo', 1 );
if ( ! function_exists( 'thim_sticky_logo' ) ) :
	function thim_sticky_logo() {
		if ( get_theme_mod( 'thim_sticky_logo' ) <> '' ) {
			$thim_logo_stick_logo = get_theme_mod( 'thim_sticky_logo' );
			if ( $thim_logo_stick_logo ) {
				$thim_logo_stick_logo_src = $thim_logo_stick_logo;
			} else {
				$thim_logo_stick_logo_src = TP_THEME_URI . 'assets/images/sticky-logo.png';
			}
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="sticky-logo no-mobile-logo">
					<img src="' . $thim_logo_stick_logo_src . '" alt="' . $site_title . '" /></a>';
		} elseif ( get_theme_mod( 'thim_logo' ) <> '' ) {
			$thim_logo = get_theme_mod( 'thim_logo' );
			if ( $thim_logo ) {
				$thim_logo_src = $thim_logo;
			} else {
				$thim_logo_src = TP_THEME_URI . 'assets/images/logo.png';
			}
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="sticky-logo no-mobile-logo">
				<img src="' . $thim_logo_src . '" alt="' . $site_title . '" /></a>';
		}
		if ( get_theme_mod( 'thim_sticky_logo' ) == '' && get_theme_mod( 'thim_logo' ) == '' ) {
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="sticky-logo no-mobile-logo">
			' . esc_attr( get_bloginfo( 'name' ) ) . '</a>';;
		}
	}
endif;

add_action( 'thim_preload_image', 'thim_preload_image', 1 );
if ( ! function_exists( 'thim_preload_image' ) ) :
	function thim_preload_image() {
		$thim_preload_image = get_theme_mod( 'thim_preload_image' );
		if ( $thim_preload_image ) {
			$thim_logo_src = $thim_preload_image;
		} else {
			$thim_logo_src = TP_THEME_URI . 'assets/images/logo.png';
		}
		$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
		echo '<img src="' . $thim_logo_src . '" alt="' . $site_title . '" />';
	}
endif;