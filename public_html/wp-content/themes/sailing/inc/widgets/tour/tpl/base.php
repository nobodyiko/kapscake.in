<?php
wp_enqueue_script('owl-carousel');
$number_show = $instance['number_show'];

echo '<div class="thim_tours_slider">';

$surplus = count( $instance['tours'] );
if ( $surplus > $number_show ) {
	echo '<div class="navigation owl-buttons">';
	echo '<div class="prev"><span class="ion-ios-arrow-left"></span></div>';
	echo '<div class="next"><span class="ion-ios-arrow-right"></span></div>';
	echo '</div>';
}

echo '<ul class="owl-carousel">';
if ( $instance['tours'] ) {
	foreach ( $instance['tours'] as $tours ) {
		echo '<li>';
		$img_url     = wp_get_attachment_image_url( $tours['image'], array(434,446) );
		echo '<img src="' . $img_url . '" alt="' . get_the_title() . '" class="no-lazy">';

		echo '<div class="tour_price">';
		echo '<span class="price">';
		echo $tours['price'];
		echo '</span>';
		echo '<span class="unit">';
		echo esc_html__( 'per night', 'sailing' );
		echo '</span>';
		echo '</div>';

		echo '<div class="tour_content">';
		echo '<span class="tour_infosale">';
		echo $tours['info_sale'];
		echo '</span>';
		echo '<h3 class="tour_name">';
		echo '<a href="' . $tours['link'] . '" target="_self">';
		echo $tours['name'];
		echo '</a>';
		echo '</h3>';
		echo '</div>';

		echo '</li>';
	}
}
echo '</ul></div>';
?>

