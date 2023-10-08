<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package thim
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?><?php
if ( is_rtl() ) {
	echo " dir=\"rtl\"";
} ?>
>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
	<?php
	$custom_sticky = $class_header = '';
	if ( get_theme_mod( 'thim_rtl_support' ) == true ) {
		$class_header .= 'rtl';
	}
	if ( get_theme_mod( 'thim_config_att_sticky' ) == 'sticky_custom' ) {
		$custom_sticky .= ' bg-custom-sticky';
	}
	if ( get_theme_mod( 'thim_header_sticky' ) == 1 ) {
		$custom_sticky .= ' sticky-header';
	}
	if ( get_theme_mod( 'thim_header_position' ) ) {
		$custom_sticky .= ' header_overlay';
		$class_header  .= ' wrapper-header_overlay';
	}

	$header_style  = get_theme_mod( 'thim_header_style' );
	$custom_sticky .= ' ' . $header_style;
	$class_header  .= ' wrapper-' . $header_style;

	if ( get_theme_mod( 'thim_box_layout' ) == 'boxed' ) {
		$class_boxed = 'boxed-area';
	} else {
		$class_boxed = '';
	}

	wp_head();
	?>
</head>

<body <?php body_class( $class_header ); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} ?>
<?php do_action( 'thim_before_body' ); ?>

<div id="wrapper-container" class="wrapper-container">
	<div class="content-pusher <?php echo esc_attr( $class_boxed ); ?>">
		<header id="masthead" class="site-header affix-top<?php echo esc_attr( $custom_sticky ); ?>">
			<?php
			// Drawer
			if ( get_theme_mod( 'thim_show_drawer' ) == true && is_active_sidebar( 'drawer_top' ) ) {
				get_template_part( 'inc/header/drawer' );
			}

			if ( 'header_v2' === get_theme_mod( 'thim_header_style' ) ) {
				get_template_part( 'inc/header/header_v2' );
			} elseif ( 'header_v3' === get_theme_mod( 'thim_header_style' ) ) {
				get_template_part( 'inc/header/header_v3' );
			}else {
				get_template_part( 'inc/header/header_v1' );
			}

			?>
		</header>
		<div id="main-content">
