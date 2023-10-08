<?php
$thim_animation = $css = $html = '';
$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );

if ( $instance['font_heading'] == 'custom' ) {
	if ( $instance['custom_font_heading']['custom_font_size'] <> '' ) {
		$css .= 'font-size:' . $instance['custom_font_heading']['custom_font_size'] . 'px;';
	}
	if ( $instance['custom_font_heading']['custom_font_weight'] <> '' ) {
		$css .= 'font-weight:' . $instance['custom_font_heading']['custom_font_weight'] . ';';
	}
	if ( $instance['custom_font_heading']['custom_font_style'] <> '' ) {
		$css .= 'font-style:' . $instance['custom_font_heading']['custom_font_style'] . ';';
	}
}

if ( $css ) {
	$css = ' style="' . $css . '"';
}

$show_button_heading = $small_title = $title = $background_title = $description = '';

if ( isset( $instance['description'] ) ) {
	$description = '<div class="description-heading"><p>' . $instance['description'] . '</p></div>';
}

if ( isset( $instance['small_title'] ) ) {
	$small_title = '<div class="small-heading">' . $instance['small_title'] . '</div>';
}

if ( isset( $instance['background_title'] ) ) {
	$background_title = '<div class="background-heading">' . $instance['background_title'] . '</div>';
}

if ( $instance['show_button_heading'] == 'yes' ) {
	$show_button_heading = '<div class="button-heading"><a target="' . $instance['link_target'] . '" href="' . $instance['link_button'] . '">' . $instance['title_button'] . '</a></div>';
}

$html .= '<div class="style_new sc-heading article_heading ' . $thim_animation . '">';

$html .= '<div class="content-heading">';
$html .= $small_title;
$html .= '<' . $instance['size'] . $css . ' class="heading__primary">' . $instance['title'] . '</' . $instance['size'] . '>';
$html .= $description;
$html .= '</div>';

$html .= $background_title;

$html .= $show_button_heading;

$html .= '</div>';

echo ent2ncr( $html );