<?php
wp_enqueue_script('owl-carousel');
global $hb_settings;
$list_room        = $instance['list_room'];
$room_cat         = $instance['room_cat'];
$number_show      = $instance['number_show'];
$link_to_room     = $instance['link_to_room'];
$link_room        = $instance['link_room'];
$number_show_room = $instance['number_show_room'];
$pagination = $instance['pagination'];
if($pagination == 1 || $pagination == 'yes'){
	$pagination = 'true';
}else{
	$pagination = 'false';
}

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
?>

<div id="<?php echo esc_attr( $sliderId ); ?>" data-number-show="<?php echo esc_attr($number_show) ?>" data-pagination="<?php echo esc_attr($pagination) ?>" class="hb_room_carousel_container tp-hotel-booking room-slider-4">
	
	<div class="navigation-swapper  container">
		<!--navigation-->
		<?php if ( ( $instance['navigation'] == 1 || $instance['navigation'] == 'yes' ) && count( $list_room_show->posts ) > $number_show ) { ?>
        <div class="navigation owl-buttons">
            <div class="prev"><span class="pe-7s-angle-left"></span></div>
            <div class="next"><span class="pe-7s-angle-right"></span></div>
        </div>
		<?php } ?>

		<!--text_link-->
		<?php if ( $instance['show_button_room'] == 'yes' ) { ?>
			<div class="text_link top">
				<a target="<?php echo $instance['link_target'] ?>" href="<?php echo $link_room; ?>"><?php echo esc_html( $link_to_room ); ?></a>
			</div>
		<?php } ?>	
	</div>
	<div id="<?php echo esc_attr( $sliderId ); ?>" class="style-4 hb_room_carousel_container tp-hotel-booking">
		<div class="hb_room_carousel">
			<ul class="rooms tp-hotel-booking ">
				<?php while ( $list_room_show->have_posts() ) : $list_room_show->the_post(); ?>

					<li id="room-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php
						/**
						 * hotel_booking_before_loop_room_summary hook
						 *
						 * @hooked hotel_booking_show_room_sale_flash - 10
						 * @hooked hotel_booking_show_room_images - 20
						 */
						do_action( 'hotel_booking_before_loop_room_item' );
						?>

						<div class="summary entry-summary">

							<?php
							/**
							 * hotel_booking_loop_room_thumbnail hook
							 */
							do_action( 'hotel_booking_loop_room_thumbnail' );
							?>
							<div class="content-room">
								<div class="title-room">
									<?php
									/**
									 * hotel_booking_loop_room_title hook
									 */
									do_action( 'hotel_booking_loop_room_title' );

									/**
									 * hotel_booking_loop_room_price hook
									 */
									// do_action( 'hotel_booking_loop_room_rating' ); ?>
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
								<?php
								/**
								 * hotel_booking_loop_room_price hook
								 */
								do_action( 'hotel_booking_loop_room_price' );
								?>
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
</div>
