<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('hotel_booking_rooms_guests','thim_style_rooms_guests');

function thim_style_rooms_guests(){
	?>
	<div class="meta-data-guests">
		<?php
		if ( get_theme_mod( 'thim_adults_show' ) == true ) {
			?>
			<div class="adults-data">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 8C9.06087 8 10.0783 7.57857 10.8284 6.82843C11.5786 6.07828 12 5.06087 12 4C12 2.93913 11.5786 1.92172 10.8284 1.17157C10.0783 0.421427 9.06087 0 8 0C6.93913 0 5.92172 0.421427 5.17157 1.17157C4.42143 1.92172 4 2.93913 4 4C4 5.06087 4.42143 6.07828 5.17157 6.82843C5.92172 7.57857 6.93913 8 8 8ZM10.6667 4C10.6667 4.70724 10.3857 5.38552 9.88562 5.88562C9.38552 6.38572 8.70724 6.66667 8 6.66667C7.29276 6.66667 6.61448 6.38572 6.11438 5.88562C5.61428 5.38552 5.33333 4.70724 5.33333 4C5.33333 3.29276 5.61428 2.61448 6.11438 2.11438C6.61448 1.61428 7.29276 1.33333 8 1.33333C8.70724 1.33333 9.38552 1.61428 9.88562 2.11438C10.3857 2.61448 10.6667 3.29276 10.6667 4ZM16 14.6667C16 16 14.6667 16 14.6667 16H1.33333C1.33333 16 0 16 0 14.6667C0 13.3333 1.33333 9.33333 8 9.33333C14.6667 9.33333 16 13.3333 16 14.6667ZM14.6667 14.6613C14.6653 14.3333 14.4613 13.3467 13.5573 12.4427C12.688 11.5733 11.052 10.6667 8 10.6667C4.94667 10.6667 3.312 11.5733 2.44267 12.4427C1.53867 13.3467 1.336 14.3333 1.33333 14.6613H14.6667Z" fill="#7E7E7E"/>
				</svg>
				<span>
				<?php printf( esc_html( _n( '%s Adult', '%s Adults', get_post_meta( get_the_ID(),'_hb_room_capacity_adult', true ), 'sailing' ) ), get_post_meta( get_the_ID(),'_hb_room_capacity_adult', true ) ); ?>
				</span>
			</div>
			<?php
		}
		if ( get_theme_mod( 'thim_children_show' ) == true ) {
			?>
			<div class="children-data">
				<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M14.5068 14.4965C14.14 13.3786 13.1565 12.5252 11.9399 12.2696L9.43898 11.744L9.20544 10.9797C10.3869 10.5276 11.3328 9.61692 11.7639 8.44961C12.4246 8.35183 13.0362 7.73017 13.0163 7.05858C13.0163 6.5833 12.7642 6.16243 12.379 5.90683C12.4751 5.72683 12.5278 5.43833 12.5147 5.19896C12.5147 3.4814 11.425 1.99828 9.86033 1.32584L10.5213 0.705655L9.8148 0.0426874L9.00297 0.804405V0H8.0038V0.941717C7.99487 0.941654 7.98598 0.941404 7.97702 0.941404H7.02305C4.52099 0.941404 2.48544 2.85134 2.48544 5.19893C2.47395 5.41386 2.50959 5.68415 2.62103 5.90677C2.23658 6.16189 1.98466 6.58171 1.98376 7.05596C1.96384 7.70639 2.52944 8.33345 3.23568 8.4483C3.66656 9.61623 4.61268 10.5274 5.79463 10.9797L5.56109 11.744L3.06013 12.2696C1.84357 12.5252 0.859987 13.3785 0.493258 14.4965L0 16H15L14.5068 14.4965ZM3.48461 5.19893C3.48461 3.36824 5.07193 1.8789 7.02305 1.8789H7.97702C9.92814 1.8789 11.5155 3.36827 11.5155 5.19893C11.5193 5.32477 11.5235 5.45765 11.4193 5.59361C9.71478 5.14508 8.57899 4.37402 7.86195 3.14162L7.13818 3.14146C6.3112 4.55965 5.05494 5.19074 3.5808 5.59358C3.50686 5.51724 3.47179 5.3433 3.48461 5.19893ZM3.99093 7.4967L3.56741 7.5332C3.30689 7.54133 3.00721 7.40739 2.98293 7.05858C2.98293 6.79796 3.20891 6.58593 3.48668 6.58593H3.56778C5.40409 6.07864 6.5528 5.49336 7.49985 4.33912C8.64613 5.72261 9.92151 6.14055 11.4323 6.58593H11.5134C11.7912 6.58593 12.0171 6.79796 12.0171 7.06014C11.9926 7.37305 11.7598 7.5327 11.4371 7.53361L11.0101 7.49324C10.6747 9.18473 9.2939 10.3351 7.50005 10.3555C5.70837 10.3352 4.32668 9.18642 3.99093 7.4967ZM7.50005 11.2929C7.75267 11.2929 8.0012 11.2729 8.24403 11.235L8.50658 12.0944C8.29599 12.4304 7.93036 12.6269 7.50005 12.6269C7.06974 12.6269 6.70411 12.4304 6.49352 12.0944L6.75607 11.235C6.9989 11.2729 7.24743 11.2929 7.50005 11.2929ZM1.35301 15.0625C1.58918 14.1098 2.29267 13.3955 3.27852 13.1844L5.70267 12.675C6.10121 13.2316 6.75856 13.5644 7.50002 13.5644C8.24147 13.5644 8.89886 13.2316 9.29739 12.675L11.7216 13.1844C12.7027 13.3752 13.4307 14.1551 13.6471 15.0625H1.35301Z" fill="#7E7E7E"/>
				</svg>
				<span>
				<?php printf( esc_html( _n( '%s Child', '%s Children', get_post_meta( get_the_ID(),'_hb_max_child_per_room', true ), 'sailing' ) ), get_post_meta( get_the_ID(),'_hb_max_child_per_room', true ) ); ?>
				</span>
			</div>
			<?php
		}
		/**
		 * hotel_booking_loop_room_price hook
		 */
		do_action( 'hotel_booking_loop_room_price' );
		?>
	</div>
	<?php
}

add_filter('hb_pagination_args','thim_hb_pagination_args');

function thim_hb_pagination_args( $array ){
	if( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' ){
		$array['prev_text'] = '<i class="tk tk-arrow-left"></i>' . esc_html__( 'Prev', 'sailing' );
		$array['next_text'] = esc_html__( 'Next', 'sailing' ) . '<i class="tk tk-arrow-right"></i>';
	}

	return $array;
}

add_action( 'hotel_booking_price_single_room', 'hotel_booking_price_single_room_function' );  

function hotel_booking_price_single_room_function(){
	global $hb_settings;
	$price_display = apply_filters('hotel_booking_loop_room_price_display_style', $hb_settings->get('price_display'));
	$prices        = hb_room_get_selected_plan(get_the_ID());
	$prices        = isset($prices->prices) ? $prices->prices : array();

    ?>
    <div class="footer-content-room price-single">
			<?php if ($prices) {
				$min_price = is_numeric(min($prices)) ? min($prices) : 0;
				$max_price = is_numeric(max($prices)) ? max($prices) : 0;
				$min       = $min_price + (hb_price_including_tax() ? ($min_price * hb_get_tax_settings()) : 0);
				$max       = $max_price + (hb_price_including_tax() ? ($max_price * hb_get_tax_settings()) : 0);
			?>
				<?php if (get_theme_mod('thim_hb_single_show_book_email') == true) { ?>
					<div class="thim-button-register-room">
						<a class="thim-enroll-room-button hb_button hb_primary" href="#"><?php esc_html_e('Register', 'sailing'); ?></a>
					</div>
				<?php } ?>

				<div class="price">

					<span class="title-price"><?php _e('Price:', 'sailing'); ?></span>

					<?php if ($price_display === 'max') { ?>
						<span class="price_value price_max"><?php echo hb_format_price($max) ?>
							<span class="unit"><?php _e('night', 'sailing'); ?></span></span>
					<?php } elseif ($price_display === 'min_to_max' && $min !== $max) { ?>
						<span class="price_value price_min_to_max"><?php echo hb_format_price($min) ?> - <?php echo hb_format_price($max) ?>
							<span class="unit"><?php _e('night', 'sailing'); ?></span></span>
					<?php } else { ?>
						<span class="price_value price_min"><?php echo hb_format_price($min) ?>
							<span class="unit"><?php _e('night', 'sailing'); ?></span></span>
					<?php } ?>

				</div>

			<?php } ?>

		</div>
    <?php
}

add_action( 'hotel_booking_single_shortcode_book_email', 'hotel_booking_single_shortcode_book_email_function' );  

function hotel_booking_single_shortcode_book_email_function(){
    ?>
    <div id="contact-form-registration">
		<?php
		$short_code = get_theme_mod('thim_hb_single_shortcode_book_email');
		if (!empty($short_code)) {
			echo do_shortcode('[contact-form-7 id="' . $short_code . '" title="Book Online"]');
		}
		?>
	</div>
    <?php
}

if ( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' ) {
	add_filter('wphb/filter/room-meta', function($sections){

		return [
			'search/v2/loop-v2/room-info/room-meta/price.php',
			'search/v2/loop-v2/room-info/room-meta/quanity.php',
			'search/v2/loop-v2/room-info/room-meta/add-to-cart.php'
		];
	});

	add_action('wphb/loop-v2/room-meta', function($room){
	?>
	<li class="hb_search_capacity">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M8 8C9.06087 8 10.0783 7.57857 10.8284 6.82843C11.5786 6.07828 12 5.06087 12 4C12 2.93913 11.5786 1.92172 10.8284 1.17157C10.0783 0.421427 9.06087 0 8 0C6.93913 0 5.92172 0.421427 5.17157 1.17157C4.42143 1.92172 4 2.93913 4 4C4 5.06087 4.42143 6.07828 5.17157 6.82843C5.92172 7.57857 6.93913 8 8 8ZM10.6667 4C10.6667 4.70724 10.3857 5.38552 9.88562 5.88562C9.38552 6.38572 8.70724 6.66667 8 6.66667C7.29276 6.66667 6.61448 6.38572 6.11438 5.88562C5.61428 5.38552 5.33333 4.70724 5.33333 4C5.33333 3.29276 5.61428 2.61448 6.11438 2.11438C6.61448 1.61428 7.29276 1.33333 8 1.33333C8.70724 1.33333 9.38552 1.61428 9.88562 2.11438C10.3857 2.61448 10.6667 3.29276 10.6667 4ZM16 14.6667C16 16 14.6667 16 14.6667 16H1.33333C1.33333 16 0 16 0 14.6667C0 13.3333 1.33333 9.33333 8 9.33333C14.6667 9.33333 16 13.3333 16 14.6667ZM14.6667 14.6613C14.6653 14.3333 14.4613 13.3467 13.5573 12.4427C12.688 11.5733 11.052 10.6667 8 10.6667C4.94667 10.6667 3.312 11.5733 2.44267 12.4427C1.53867 13.3467 1.336 14.3333 1.33333 14.6613H14.6667Z" fill="#7E7E7E"></path>
		</svg>
		<span><?php printf( esc_html( _n( '%s Adult', '%s Adults', $room->capacity, 'sailing' ) ), $room->capacity ); ?></span>
	</li>

	<li class="hb_search_max_child">
		<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M14.5068 14.4965C14.14 13.3786 13.1565 12.5252 11.9399 12.2696L9.43898 11.744L9.20544 10.9797C10.3869 10.5276 11.3328 9.61692 11.7639 8.44961C12.4246 8.35183 13.0362 7.73017 13.0163 7.05858C13.0163 6.5833 12.7642 6.16243 12.379 5.90683C12.4751 5.72683 12.5278 5.43833 12.5147 5.19896C12.5147 3.4814 11.425 1.99828 9.86033 1.32584L10.5213 0.705655L9.8148 0.0426874L9.00297 0.804405V0H8.0038V0.941717C7.99487 0.941654 7.98598 0.941404 7.97702 0.941404H7.02305C4.52099 0.941404 2.48544 2.85134 2.48544 5.19893C2.47395 5.41386 2.50959 5.68415 2.62103 5.90677C2.23658 6.16189 1.98466 6.58171 1.98376 7.05596C1.96384 7.70639 2.52944 8.33345 3.23568 8.4483C3.66656 9.61623 4.61268 10.5274 5.79463 10.9797L5.56109 11.744L3.06013 12.2696C1.84357 12.5252 0.859987 13.3785 0.493258 14.4965L0 16H15L14.5068 14.4965ZM3.48461 5.19893C3.48461 3.36824 5.07193 1.8789 7.02305 1.8789H7.97702C9.92814 1.8789 11.5155 3.36827 11.5155 5.19893C11.5193 5.32477 11.5235 5.45765 11.4193 5.59361C9.71478 5.14508 8.57899 4.37402 7.86195 3.14162L7.13818 3.14146C6.3112 4.55965 5.05494 5.19074 3.5808 5.59358C3.50686 5.51724 3.47179 5.3433 3.48461 5.19893ZM3.99093 7.4967L3.56741 7.5332C3.30689 7.54133 3.00721 7.40739 2.98293 7.05858C2.98293 6.79796 3.20891 6.58593 3.48668 6.58593H3.56778C5.40409 6.07864 6.5528 5.49336 7.49985 4.33912C8.64613 5.72261 9.92151 6.14055 11.4323 6.58593H11.5134C11.7912 6.58593 12.0171 6.79796 12.0171 7.06014C11.9926 7.37305 11.7598 7.5327 11.4371 7.53361L11.0101 7.49324C10.6747 9.18473 9.2939 10.3351 7.50005 10.3555C5.70837 10.3352 4.32668 9.18642 3.99093 7.4967ZM7.50005 11.2929C7.75267 11.2929 8.0012 11.2729 8.24403 11.235L8.50658 12.0944C8.29599 12.4304 7.93036 12.6269 7.50005 12.6269C7.06974 12.6269 6.70411 12.4304 6.49352 12.0944L6.75607 11.235C6.9989 11.2729 7.24743 11.2929 7.50005 11.2929ZM1.35301 15.0625C1.58918 14.1098 2.29267 13.3955 3.27852 13.1844L5.70267 12.675C6.10121 13.2316 6.75856 13.5644 7.50002 13.5644C8.24147 13.5644 8.89886 13.2316 9.29739 12.675L11.7216 13.1844C12.7027 13.3752 13.4307 14.1551 13.6471 15.0625H1.35301Z" fill="#7E7E7E"></path>
		</svg>
		<span><?php printf( esc_html( _n( '%s Child', '%s Children', $room->max_child, 'sailing' ) ), $room->max_child ); ?></span>
	</li>
	<?php
	}, 3, 1);
}