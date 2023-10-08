<?php
wp_enqueue_script('owl-carousel');
global $hb_settings;
$list_room        = $instance['list_room'];
$room_cat         = $instance['room_cat'];
$number_show      = $instance['number_show'];
$link_to_room     = $instance['link_to_room'];
$link_room        = $instance['link_room'];
$number_show_room = isset( $instance['number_show_room'] ) ? $instance['number_show_room'] : 3;

if ( $list_room == 'room_type' ) {
	$room_type = array(
		'post_type'           => 'hb_room',
		'posts_per_page'      => $number_show_room,
		'ignore_sticky_posts' => true,
		'tax_query'           => array(
			array(
				'taxonomy' => 'hb_room_type',
				'field'    => 'term_id',
				'terms'    => $room_cat
			)
		)
	);
} elseif ( $list_room == 'best_review' ) {
	$room_type = array(
		'post_type'           => 'hb_room',
		'posts_per_page'      => $number_show_room,
		'ignore_sticky_posts' => true,
		'meta_key'            => 'arveger_rating',
		'order'               => 'DESC',
		'orderby'             => array( 'meta_value_num' => 'DESC' )
	);
} elseif ( $list_room == 'last_review' ) {
	$room_type = array(
		'post_type'           => 'hb_room',
		'posts_per_page'      => $number_show_room,
		'ignore_sticky_posts' => true,
		'meta_key'            => 'arveger_rating_last_modify',
		'order'               => 'DESC',
		'orderby'             => array( 'meta_value_num' => 'DESC' )
	);
} elseif ( $list_room == 'room_new' ) {
	$room_type = array(
		'post_type'           => 'hb_room',
		'posts_per_page'      => $number_show_room,
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	);
} elseif ( $list_room == 'id_room' ) {
	if ( !is_array( $instance['room_id'] ) ) {
		$ids = explode( ",", $instance['room_id'] );
	} else {
		$ids = $instance['room_id'];
	}

	$room_type = array(
		'post_type'           => 'hb_room',
		'post__in'            => $ids,
		'posts_per_page'      => $number_show_room,
		'ignore_sticky_posts' => true,
	);
}

$list_room_show = new WP_Query( $room_type );
$sliderId       = 'hotel_booking_slider_' . uniqid();
$src            = wp_get_attachment_image_src( $instance['image_background'], 'full' );

?>

<div id="<?php echo esc_attr( $sliderId ); ?>" class="style_new hb_room_carousel_container tp-hotel-booking room-slider-style-2">
	<!--navigation-->
	<?php if ( count( $list_room_show->posts ) > $number_show ) { ?>
		<div class="navigation owl-buttons">
			<div class="prev"><span class="ion-ios-arrow-left"></span></div>
			<div class="next"><span class="ion-ios-arrow-right"></span></div>
		</div>
	<?php } ?>
	<!--end navigation-->

	<div id="<?php echo esc_attr( $sliderId ); ?>" class="hb_room_carousel_container tp-hotel-booking">
		<div class="hb_room_carousel">
			<ul class="rooms owl-carousel tp-hotel-booking hb-catalog-column-<?php echo esc_attr( $hb_settings->get( 'catalog_number_column', 4 ) ) ?>">
				<?php while ( $list_room_show->have_posts() ) : $list_room_show->the_post(); ?>
					<li id="room-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						/**
						 * hotel_booking_before_loop_room_summary hook
						 *
						 * @hooked hotel_booking_show_room_sale_flash - 10
						 * @hooked hotel_booking_show_room_images - 20
						 */
						do_action( 'hotel_booking_before_loop_room_item' ); ?>
						<div class="summary entry-summary">
							<div class="content-room">
								<div class="footer-content-room">
									<?php
									$price_display = apply_filters( 'hotel_booking_loop_room_price_display_style', $hb_settings->get( 'price_display' ) );
									$prices        = hb_room_get_selected_plan( get_the_ID() );
									$prices        = isset( $prices->prices ) ? $prices->prices : array();
									if ( $prices ) {
										$min_price = is_numeric( min( $prices ) ) ? min( $prices ) : 0;
										$max_price = is_numeric( max( $prices ) ) ? max( $prices ) : 0;
										$min       = $min_price + ( hb_price_including_tax() ? ( $min_price * hb_get_tax_settings() ) : 0 );
										$max       = $max_price + ( hb_price_including_tax() ? ( $max_price * hb_get_tax_settings() ) : 0 );
										?>
										<div class="price">
											<?php if ( $price_display === 'max' ) { ?>
												<span class="price_value price_max"><?php echo hb_format_price( $max ) ?></span>
												<span class="unit"><?php _e( 'per night', 'sailing' ); ?></span>
											<?php } elseif ( $price_display === 'min_to_max' && $min !== $max ) { ?>
												<span class="price_value price_min_to_max"><?php echo hb_format_price( $min ) ?> - <?php echo hb_format_price( $max ) ?></span>
												<span class="unit"><?php _e( 'per night', 'sailing' ); ?></span>
											<?php } else { ?>
												<span class="price_value price_min"><?php echo hb_format_price( $min ) ?></span>
												<span class="unit"><?php _e( 'per night', 'sailing' ); ?></span>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
								<div class="title-room">
									<?php
									/**
									 * hotel_booking_loop_room_title hook
									 */
									do_action( 'hotel_booking_loop_room_title' );
									/**
									 * hotel_booking_loop_room_price hook
									 */
									do_action( 'hotel_booking_loop_room_rating' ); ?>
								</div>
								<?php
								/**
								 * rooms description
								 */
								if ( get_theme_mod( 'thim_show_info_room' ) == true ) {
									echo '<div class="description">';
									if ( has_excerpt() ) {
										echo get_the_excerpt();
									}
									echo '</div>';
								}
								?>
							</div>
							<div class="media">
								<?php thim_thumbnail( get_the_ID(), '815x655', 'post', true ); ?>
								<div class="actions">
									<div class="action-btn">
										<a href="<?php the_permalink(); ?>" class="button readmore">
											<?php echo esc_html__( 'See Room', 'sailing' ); ?>
											<img src="<?php echo TP_THEME_URI . 'assets/images/see_room.png'; ?>" alt="see_room">
										</a>
									</div>
								</div>
							</div>
						</div><!-- .summary -->
						<?php
						/**
						 * hotel_booking_after_loop_room_item hook
						 *
						 * @hooked hotel_booking_show_room_sale_flash - 10
						 * @hooked hotel_booking_show_room_images - 20
						 */
						do_action( 'hotel_booking_after_loop_room_item' );
						?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
	<div class="background-image">
		<?php if ( $src ) { ?>
			<img src="<?php echo $src['0']; ?>" alt="background">
		<?php } ?>
	</div>
</div>
