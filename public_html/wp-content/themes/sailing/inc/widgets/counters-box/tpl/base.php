<?php
$counters_value  = $counters_label = $jugas_animation = $icon = $label = $counter_color = $border_color = '';
$jugas_animation .= thim_getCSSAnimation( $instance['css_animation'] );

if ( $instance['counters_label'] <> '' ) {
	$counters_label = $instance['counters_label'];
}

if ( $instance['border_color'] <> '' ) {
	$border_color = 'style="border: 1px solid ' . $instance['border_color'] . '"';
}

if ( $instance['counter_color'] <> '' ) {
	$counter_color = 'style="color:' . $instance['counter_color'] . '"';
}

if ( $instance['counters_value'] <> '' ) {
	$counters_value = $instance['counters_value'];
}

if ( $instance['icon'] == '' ) {
	$instance['icon'] = 'none';
}

if ( $instance['icon'] != 'none' ) {
	if ( strpos( $instance['icon'], 'fa' ) !== false ) {
		$icon = '<i class="' . $instance['icon'] . '" '. ent2ncr($border_color) .'></i>';
	} else {
		
		$icon = '<i class="fa fa-' . $instance['icon'] . '" '. ent2ncr($border_color) .' ></i>';
	}
}

echo '<div class="counter-box ' . $jugas_animation . '" ' . $counter_color . '>';
echo '<div class="counterbox-content">';
if ( $icon ) {
	echo '<div class="counter-box-icon">' . $icon . '</div>';
}
if ( $counters_label != '' ) {
	$label = '<span class="counter-box-content">' . $counters_label . '</span>';
}

if ( $counters_value != '' ) {
	echo '<div class="content-box-percentage"><span class="display-percentage" data-percentage="' . $counters_value . '">' . $counters_value . '</span>' . $label . '</div>';
}
echo '</div>';
echo '</div>';
?>