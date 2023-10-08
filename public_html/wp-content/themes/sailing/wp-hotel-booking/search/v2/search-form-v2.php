<?php

/**
 * The template for displaying search room form v2.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/search/search-form-v2.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.9.7
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit;
global $hb_settings;
$datetime = new DateTime('NOW');
$tomorrow = new DateTime('tomorrow');

$check_in_date  = hb_get_request('check_in_date');
$check_out_date = hb_get_request('check_out_date');
$adults         = hb_get_request('adults', '1');
$max_child      = hb_get_request('max_child', '0');
$uniqid         = uniqid();
$page_search    = hb_get_page_id('search');
$today   = current_time('timestamp', 1);
$tomorow = strtotime("+1 day", $today);
$format = get_option('date_format');

if ($check_in_date == '') {
	$check_in_date = $datetime->format($format);
}
if ($check_out_date == '') {
	$check_out_date = $tomorrow->format($format);
}

?>

<div id="hotel-booking-search-<?php echo uniqid(); ?>" class="hotel-booking-search">
	<?php
	// display title widget or shortcode
	$atts = array();
	if ($args && isset($args['atts'])) {
		$atts = $args['atts'];
	} elseif (isset($args)) {
		$atts = $args;
	}
	$extraclass = '';
	if (isset($atts['multidate'])) {
		$extraclass = 'layout-multidate';
	}
	if( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' && is_page($page_search)){
		$atts['show_label'] = 'true';
		?>
		<div class="thim-room-top switch-layout-container">
			<?php
			$data = array();
			hb_get_template( 'search/v2/sort-by.php', compact( 'data' ) );
			?>
		</div>
		<?php

	}

	if (!isset($atts['show_title']) || strtolower($atts['show_title']) === 'true') {
	?>
		<h3><?php _e('Check Availability', 'wp-hotel-booking'); ?></h3>
	<?php } ?>
	<form <?php echo is_page($page_search) ? 'id="hb-form-search-page" ' : ''; ?> name="hb-search-form" action="<?php echo hb_get_url(); ?>" class="hb-search-form-<?php echo esc_attr($uniqid); ?> <?php echo esc_attr($extraclass); ?>">
		<ul class="hb-form-table">
			<?php if (isset($atts['multidate'])) {
				wp_enqueue_script( 'thim-daterangepicker');
				?>
				<input type="text" id="multidate" class="multidate" value="<?php echo esc_attr($check_in_date) ?>" readonly />
				<li class="hb-form-field hb-form-check-in-check-out">
					<div class="label"><?php echo esc_html__('Check-in, Check-out', 'wp-hotel-booking') ?> <span>*</span></div>
					<div class="hb-form-field-input hb_input_field">
						<input type="text" name="check_in_date" id="check_in_date_<?php echo  esc_attr($uniqid) ?>" class="check-date" value="<?php echo esc_attr($check_in_date) ?>" readonly />
					</div>
					<div class="hb-form-field-input hb_input_field">
						<input type="text" name="check_out_date" id="check_out_date_<?php echo esc_attr($uniqid) ?>" class="check-date" value="<?php echo esc_attr($check_out_date) ?>" readonly />
					</div>
				</li>
			<?php } else { ?>
				<li class="hb-form-field">
					<?php hb_render_label_shortcode($atts, 'show_label', __('Arrival Date', 'wp-hotel-booking'), 'true'); ?>
					<div class="hb-form-field-input hb_input_field">
						<input type="text" name="check_in_date" id="check_in_date_<?php echo esc_attr($uniqid); ?>" class="hb_input_date_check" value="<?php echo esc_attr($check_in_date); ?>" placeholder="<?php _e('Arrival Date', 'wp-hotel-booking'); ?>" autocomplete="off" />
					</div>
				</li>

				<li class="hb-form-field">
					<?php hb_render_label_shortcode($atts, 'show_label', __('Departure Date', 'wp-hotel-booking'), 'true'); ?>
					<div class="hb-form-field-input hb_input_field">
						<input type="text" name="check_out_date" id="check_out_date_<?php echo esc_attr($uniqid); ?>" class="hb_input_date_check" value="<?php echo esc_attr($check_out_date); ?>" placeholder="<?php _e('Departure Date', 'wp-hotel-booking'); ?>" autocomplete="off" />
					</div>
				</li>

			<?php } ?>
				<li class="hb-form-field hb-form-number">
					<div class="label"><?php hb_render_label_shortcode($atts, 'show_label', __('Adults', 'wp-hotel-booking'), 'true'); ?></div>
					<div id="adults" class="hb-form-field-input hb_input_field">
						<input type="text" id="number" class="adults-input" value="<?php echo esc_attr($adults) ?>" readonly />
						<span><?php _e('Adults', 'hotel-wp') ?></span>
					</div>
					<div class="hb-form-field-list nav-guest">
						<span class="name"><?php echo esc_html__( 'Adults', 'wp-hotel-booking' ) ?></span>
						<div class="number-box">
							<span class="number-icons goDown"><i class="ion-minus"></i></span>
							<span class="hb-form-field-input hb-guest-field guests-number">
								<?php
								hb_dropdown_numbers(
									array(
										'name'              => 'adults_capacity',
										'min'               => 1,
										'max'               => hb_get_max_capacity_of_rooms(),
										'selected'          => $adults,
										'option_none_value' => '',
										'options'           => hb_get_capacity_of_rooms(),
									)
								);
								?>
							</span>
							<span class="number-icons goUp"><i class="ion-plus"></i></span>
						</div>
					</div>
				</li>

				<li class="hb-form-field hb-form-number">
					<div class="label"><?php hb_render_label_shortcode($atts, 'show_label', __('Children', 'wp-hotel-booking'), 'true'); ?></div>
					<div id="child" class="hb-form-field-input hb_input_field">
						<input type="text" id="number" class="child-input" value="<?php echo esc_attr($max_child) ?>" readonly />
						<span><?php _e('Children', 'hotel-wp') ?></span>
					</div>
					<div class="hb-form-field-list nav-child">
						<span class="name"><?php echo esc_html__( 'Children', 'wp-hotel-booking' ) ?></span>
						<div class="number-box">
							<span class="number-icons goDown"><i class="ion-minus"></i></span>
							<span class="hb-form-field-input hb-guest-field child-number">
								<?php
								hb_dropdown_numbers(
									array(
										'name'              => 'max_child',
										'min'               => 0,
										'max'               => hb_get_max_child_of_rooms(),
										'option_none_value' => '',
										'selected'          => $max_child,
									)
								);
								?>
							</span>
							<span class="number-icons goUp"><i class="ion-plus"></i></span>
						</div>
					</div>
				</li>
		</ul>
		<?php wp_nonce_field('hb_search_nonce_action', 'nonce'); ?>
		<input type="hidden" name="hotel-booking" value="results" />
		<input type="hidden" name="widget-search" value="<?php echo isset($atts['widget_search']) ? $atts['widget_search'] : false; ?>" />
		<input type="hidden" name="action" value="hotel_booking_parse_search_params" />
		<input type="hidden" name="paged" value="<?php echo absint($atts['paged']); ?>" />
		<p class="hb-submit">
			<button type="submit" class="wphb-button"><?php _e('Check Availability', 'wp-hotel-booking'); ?></button>
		</p>
	</form>
	<?php
	if ($page_search && is_page($page_search)) :
	?>
		<div id="hotel-booking-results">
			<?php echo wphb_skeleton_animation_html(20, '100%', 'height:20px', 'width:100%'); ?>
			<div class="detail__booking-rooms"></div>
		</div>
	<?php
	endif;
	?>
</div>
