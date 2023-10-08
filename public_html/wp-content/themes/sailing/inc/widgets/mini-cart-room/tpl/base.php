<?php

$title = '';
if($instance['title'] <> ''){
	$title = $instance['title'];
}

if(!class_exists('TP_Hotel_Booking') && !class_exists('WP_Hotel_Booking') ) {
	return;
}

$html = '[hotel_booking_mini_cart][/hotel_booking_mini_cart]';

if($title <> ''){
	echo '<div class="wrapper-line-heading">';
	echo '<h3 class="heading__primary">'.esc_attr($title).'</h3>';
	echo '<span class="line-heading"><span></span></span>';
	echo '</div>';
}
echo do_shortcode($html);

?>