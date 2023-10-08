<?php
/**
 * The template for displaying shortcode rooms carousel.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/shortcodes/carousel.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
wp_enqueue_script('owl-carousel');
global $hb_settings;
$sliderId = 'hotel_booking_slider_' . uniqid();
$items    = isset( $atts['number'] ) ? (int) $atts['number'] : 4;
?>
<div id="<?php echo esc_attr( $sliderId ); ?>" class="hb_room_carousel_container tp-hotel-booking">
	<?php if ( isset( $atts['title'] ) && $atts['title'] ): ?>
		<h3><?php echo esc_html( $atts['title'] ); ?></h3>
	<?php endif; ?>
	<!--navigation-->
	<?php if ( ( !isset( $atts['navigation'] ) || $atts['navigation'] ) && count( $query->posts ) > $items ): ?>
		<div class="navigation owl-buttons">
			<div class="prev"><span class="pe-7s-angle-left"></span></div>
			<div class="next"><span class="pe-7s-angle-right"></span></div>
		</div>
	<?php endif; ?>
	<!--pagination-->
	<?php if ( !isset( $atts['pagination'] ) || $atts['pagination'] ): ?>
		<div class="pagination"></div>
	<?php endif; ?>
	<!--text_link-->
	<?php if ( isset( $atts['text_link'] ) && $atts['text_link'] !== '' ): ?>
		<div class="text_link">
			<a href="<?php echo get_post_type_archive_link( 'hb_room' ); ?>"><?php echo esc_html( $atts['text_link'] ); ?></a>
		</div>
	<?php endif; ?>
	<div class="hb_room_carousel">
		<ul class="rooms owl-carousel tp-hotel-booking hb-catalog-column-<?php echo esc_attr( $hb_settings->get( 'catalog_number_column', 4 ) ) ?>">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

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

						<?php
						/**
						 * hotel_booking_loop_room_price hook
						 */
						do_action( 'hotel_booking_loop_room_price' );
						?>
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
<script type="text/javascript">
	(function ($) {
		"use strict";
		$(document).ready(function () {
			var thimpress_hotel_booking_carousel = $('#<?php echo esc_js( $sliderId ) ?> .hb_room_carousel .rooms');
			thimpress_hotel_booking_carousel.owlCarousel({
				nav               : false,
				dots              : <?php echo esc_js( ( !isset( $atts['pagination'] ) || $atts['pagination'] ) ? 'true' : 'false' )  ?>,
				items             : <?php echo esc_js( $items ); ?>,
				dotsSpeed         : 600,
				smartSpeed        : 600,
				autoplay          : true,
				autoplayHoverPause: true,
				loop              : true,
				responsive        : {
					// breakpoint from 0 up
					0   : {
						items: 1
					},
					// breakpoint from 480 up
					480 : {
						items: 1
					},
					// breakpoint from 768 up
					768 : {
						items: 2
					},
					// breakpoint from 1024 up
					1024: {
						items: <?php echo esc_js( $items ); ?>
					}
				}
			});
			// next
			$('#<?php echo esc_js( $sliderId ); ?> .navigation .next').click(function () {
				thimpress_hotel_booking_carousel.trigger('next.owl.carousel');
			});
			// prev
			$('#<?php echo esc_js( $sliderId ); ?> .navigation .prev').click(function () {
				thimpress_hotel_booking_carousel.trigger('prev.owl.carousel');
			});
		});
	})(jQuery);
</script>