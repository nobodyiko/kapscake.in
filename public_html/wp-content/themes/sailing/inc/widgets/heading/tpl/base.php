<?php
$thim_animation = $des = $html = $css = $subtitle = $line_heading  = '';
$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );
if ( $instance['textcolor'] ) {
	$css .= 'color:' . $instance['textcolor'] . ';';
}

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

if ( $instance['sub-title'] ) {
	$subtitle = '<p class="heading__secondary">' . $instance['sub-title'] . '</p>';
}
if ( $instance['line'] == true || $instance['line'] == 'yes' ) {
	$line_heading = '<span class="line-heading"><span></span></span>';
	$thim_animation        .= ' wrapper-line-heading';
}
echo '<div class="sc-heading article_heading' . $thim_animation . '">';
echo '<' . $instance['size'] . $css . ' class="heading__primary">' . $instance['title']. '</' . $instance['size'] . '>';
echo ent2ncr($subtitle);
echo ent2ncr( $line_heading );
echo '</div>';

