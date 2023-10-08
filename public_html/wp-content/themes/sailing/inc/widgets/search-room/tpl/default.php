<?php
$html     = '';
$datetime = new DateTime( 'NOW' );
$tomorrow = new DateTime( 'tomorrow' );

$search         = hb_get_page_permalink( 'search' );
$check_in_date  = hb_get_request( 'check_in_date' );
$check_out_date = hb_get_request( 'check_out_date' );

$today   = current_time( 'timestamp', 1 );
$tomorow = strtotime( "+1 day", $today );

$format = get_option( 'date_format' );

if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
	if ( $check_in_date == '' ) {
		$check_in_date = $datetime->format( $format );
	}
	if ( $check_out_date == '' ) {
		$check_out_date = $tomorrow->format( $format );
	}
} elseif ( is_plugin_active( 'loco-translate/loco.php' ) ) {
	if ( $check_in_date == '' ) {
		$check_in_date = date_i18n( $format, $today );
	}
	if ( $check_out_date == '' ) {
		$check_out_date = date_i18n( $format, $tomorow );
	}
} else {
	if ( $check_in_date == '' ) {
		$check_in_date = $datetime->format( $format );
	}
	if ( $check_out_date == '' ) {
		$check_out_date = $tomorrow->format( $format );
	}
}

$adults    = hb_get_request( 'adults', 1 );
$max_child = hb_get_request( 'max_child', 1 );
$uniqid    = uniqid();

if ( $instance['show_child'] <> '' || $instance['show_child'] == 'yes' ) {
	$class_layout = 'has-child';
} else {
	$class_layout = '';
}

$html .= '<div id="hotel-booking-search-' . uniqid() . '" class="hotel-booking-search layout-special ' . esc_attr( $class_layout ) . '">';

$html .= '<form name="hb-search-form" action="' . hb_get_url() . '" class="hb-search-form-' . esc_attr( $uniqid ) . '">';
$html .= '<ul class="hb-form-table">';
$html .= '<li class="hb-form-field hb-form-check-in">';
$html .= '<div class="label">' . esc_html__( 'Check-In', 'sailing' ) . '</div>';
$html .= '<div class="hb-form-field-input hb_input_field">';
$html .= '<input type="text" id="day" class="day" value="' . $datetime->format( 'd' ) . '" readonly />';
$html .= '<input id="month" class="month" readonly type="text" value="' . date_i18n( 'M', $today ) . '" />';
$html .= '<input type="hidden" name="check_in_date" id="check_in_date_' . esc_attr( $uniqid ) . '" class="check-date" value="' . esc_attr( $check_in_date ) . '" readonly />';
$html .= '</div>';
$html .= '</li>';

$html .= '<li class="hb-form-field hb-form-check-out">';
$html .= '<div class="label">' . esc_html__( 'Check-Out', 'sailing' ) . '</div>';
$html .= '<div class="hb-form-field-input hb_input_field">';
$html .= '<input type="text" id="day2" class="day" value="' . $tomorrow->format( 'd' ) . '" readonly />';
$html .= '<input id="month2" class="month" readonly  type="text" value="' . date_i18n( 'M', $tomorow ) . '" />';
$html .= '<input type="hidden" name="check_out_date" id="check_out_date_' . esc_attr( $uniqid ) . '" class="check-date" value="' . esc_attr( $check_out_date ) . '" readonly/>';
$html .= '</div>';
$html .= '</li>';

$html .= '<li class="hb-form-field hb-form-number">';
$html .= '<div class="label">' . esc_html__( 'Guests', 'sailing' ) . '</div>';
$html .= '<div class="hb-form-field-list">';
$html .= '<div class="hb-form-field-input hb-guest-field guests-number">';
ob_start();
hb_dropdown_numbers(
	array(
		'name'              => 'adults_capacity',
		'min'               => 1,
		'max'               => hb_get_max_capacity_of_rooms(),
		'option_none_value' => 0,
		'selected'          => $adults,
		'options'           => hb_get_capacity_of_rooms()
	)
);
$html .= ob_get_clean();
$html .= '<div class="nav-guest"><span class="goUp"><i class="ion-ios-arrow-up"></i></span>';
$html .= '<span class="goDown"><i class="ion-ios-arrow-down"></i></span></div>';
$html .= '</div>';

$html .= '</div>';
$html .= '</li>';

if ( $instance['show_child'] <> '' || $instance['show_child'] == 'yes' ) {
	$html .= '<li class="hb-form-field hb-form-number">';
	$html .= '<div class="label">' . esc_html__( 'Children', 'sailing' ) . '</div>';
	$html .= '<div class="hb-form-field-list">';
	$html .= '<div class="hb-form-field-input hb-child-field child-number">';
	ob_start();
	hb_dropdown_numbers(
		array(
			'name'              => 'max_child',
			'min'               => 1,
			'max'               => hb_get_max_child_of_rooms(),
			'option_none_value' => 0,
			'selected'          => $max_child,
		)
	);
	$html .= ob_get_clean();
	$html .= '<div class="nav-child"><span class="goUp"><i class="ion-ios-arrow-up"></i></span>';
	$html .= '<span class="goDown"><i class="ion-ios-arrow-down"></i></span></div>';
	$html .= '</div>';

	$html .= '</div>';
	$html .= '</li>';
}

$html .= '</ul>';

ob_start();
wp_nonce_field( 'hb_search_nonce_action', 'nonce' );
$html .= ob_get_clean();

$html .= '<input type="hidden" name="hotel-booking" value="results" />';
$html .= '<input type="hidden" name="widget-search"
               value="' . true . '"/>';
$html .= '<input type="hidden" name="action" value="hotel_booking_parse_search_params" />';
$html .= '<p class="hb-submit">';
$html .= '<button type="submit">' . esc_html__( 'Check', 'sailing' ) . '<br> ' . esc_html__( 'Availability', 'sailing' ) . '</button>';
$html .= '</p>';

$html .= '</form>';
$html .= '</div>';

echo ent2ncr( $html );