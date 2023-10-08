<?php
/**
 * The template for displaying cart page.
 *
 * This template can be overridden by copying it to yourtheme/sailing/cart/cart.php.
 *
 * @author  ThimPress, leehld
 * @package sailing/Templates
 * @version 1.9.7.5
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $cart WPHB_Cart
 */
$cart = WP_Hotel_Booking::instance()->cart;
global $hb_settings; ?>

<?php if ( $cart->cart_items_count != 0 ) : ?>
	<div id="hotel-booking-cart">

		<form id="hb-cart-form" method="post">
			<h3><?php _e( 'Cart', 'sailing' ); ?></h3>
			<table class="hb_table">
				<thead>
				<th>&nbsp;</th>
				<th class="hb_room_type"><?php _e( 'Room', 'sailing' ); ?></th>
				<th class="hb_capacity"><?php _e( 'Capacity', 'sailing' ); ?></th>
				<!-- <th class="hb_child"><?php //_e( 'Children', 'sailing' ); ?></th> -->
				<th class="hb_quantity"><?php _e( 'Quantity', 'sailing' ); ?></th>
				<th class="hb_check_in"><?php _e( 'Check - in', 'sailing' ); ?></th>
				<th class="hb_check_out"><?php _e( 'Check - out', 'sailing' ); ?></th>
				<th class="hb_night"><?php _e( 'Night', 'sailing' ); ?></th>
				<?php
				$show_deposit = false;
				if ( defined( 'WPHB_VERSION' ) && version_compare( WPHB_VERSION, '2.0.0', '>=' ) ) {
					echo '<th class="hb_deposit">'.__( 'Deposit Payment', 'sailing' ).'</th>';
					$show_deposit = true;
				}
				?>

				<th class="hb_gross_total"><?php _e( 'Gross Total', 'sailing' ); ?></th>
				</thead>
				<?php if ( $rooms = $cart->get_rooms() ) : ?>
					<?php foreach ( $rooms as $cart_id => $room ) : ?>
						<?php
						if ( ( $num_of_rooms = (int) $room->get_data( 'quantity' ) ) == 0 ) {
							continue;
						}
						$cart_extra = $cart->get_extra_packages( $cart_id );
  						?>
						<tr class="hb_checkout_item" data-cart-id="<?php echo esc_attr( $cart_id ); ?>">
							<td<?php echo defined( 'TP_HB_EXTRA' ) && $cart_extra ? ' rowspan="' . ( count( $cart_extra ) + 2 ) . '"' : ''; ?>>
								<a href="javascript:void(0)" class="hb_remove_cart_item" data-cart-id="<?php echo esc_attr( $cart_id ); ?>">
									<i class="fa fa-times"></i>
								</a>
							</td>
							<td class="hb_room_type">
								<a href="<?php echo get_permalink( $room->ID ); ?>"><?php echo esc_html( $room->name ); ?></a>
							</td>
							<td class="hb_capacity">
								<p><?php echo sprintf( _n( '%d adult', '%d adults', $room->capacity, 'sailing' ), $room->capacity ); ?></p>
								<p><?php echo sprintf( _n( '%d child', '%d childs', $room->max_child, 'sailing' ), $room->max_child ); ?></p>
							</td>
							<!-- <td class="hb_child"> </td> -->
							<td class="hb_quantity">
								<input type="number" min="0" class="hb_room_number_edit" name="hotel_booking_cart[<?php echo esc_attr( $cart_id ); ?>]" value="<?php echo esc_attr( $num_of_rooms ); ?>" disabled />
							</td>
							<td class="hb_check_in"><?php echo date_i18n( hb_get_date_format(), strtotime( $room->get_data( 'check_in_date' ) ) ); ?></td>
							<td class="hb_check_out"><?php echo date_i18n( hb_get_date_format(), strtotime( $room->get_data( 'check_out_date' ) ) ); ?></td>
							<td class="hb_night"><?php echo hb_count_nights_two_dates( $room->get_data( 'check_out_date' ), $room->get_data( 'check_in_date' ) ); ?></td>

							<?php if($show_deposit){
 								/**
								 * check deposit
								 */
								$enable       = get_post_meta( $room->ID, '_hb_enable_deposit', true );
								$type_deposit = get_post_meta( $room->ID, '_hb_deposit_type', true );
								if ( $type_deposit == 'percent' ) {
									$deposit = get_post_meta( $room->ID, '_hb_deposit_amount', true ) . '%';
								} elseif ( $type_deposit == 'fixed' ) {
									$deposit = hb_format_price( get_post_meta( $room->ID, '_hb_deposit_amount', true ) );
								}
								?>
							<td class="hb_deposit"><?php echo $enable == 1 ? $deposit : __( 'Disable', 'sailing' ); ?></td>
							<?php }?>
							<td class="hb_gross_total">
								<?php echo hb_format_price( $room->total ); ?>
							</td>
						</tr>
						<?php do_action( 'hotel_booking_cart_after_item', $room, $cart_id ); ?>
					<?php endforeach; ?>

				<?php endif; ?>

				<?php do_action( 'hotel_booking_before_cart_total' ); ?>

				<tr class="hb_sub_total">
					<td colspan="9"><?php _e( 'Sub Total', 'sailing' ); ?>
						<span class="hb-align-right hb_sub_total_value">
								<?php echo hb_format_price( $cart->sub_total ); ?>
							</span>
					</td>
				</tr>
				<?php if ( $tax = hb_get_tax_settings() ) : ?>
					<tr class="hb_advance_tax">
						<td colspan="9">
							<?php _e( 'Tax', 'sailing' ); ?>
							<?php if ( $tax < 0 ) { ?>
								<span><?php printf( __( '(price including tax)', 'sailing' ) ); ?></span>
							<?php } ?>
							<span class="hb-align-right"><?php echo apply_filters( 'hotel_booking_cart_tax_display', abs( $tax * 100 ) . '%' ); ?></span>
						</td>
					</tr>
				<?php endif; ?>
				<tr class="hb_advance_grand_total">
					<td colspan="9">
						<?php _e( 'Grand Total', 'sailing' ); ?>
						<span class="hb-align-right hb_grand_total_value"><?php echo hb_format_price( $cart->total ); ?></span>
					</td>
				</tr>
				<?php $advance_payment = ''; ?>
				<?php if ( $advance_payment = $cart->advance_payment ) : ?>
					<tr class="hb_advance_payment">
						<td colspan="9">
							<?php echo __( 'Advance Payment', 'sailing' ); ?>
							<span class="hb-align-right hb_advance_payment_value"><?php echo hb_format_price( $advance_payment ); ?></span>
						</td>
					</tr>
				<?php endif; ?>

				<tr>
					<?php wp_nonce_field( 'hb_cart_field', 'hb_cart_field' ); ?>
				</tr>
			</table>
			<p>
				<a href="<?php echo hb_get_checkout_url(); ?>" class="hb_button hb_checkout"><?php _e( 'Check Out', 'sailing' ); ?></a>
			</p>
		</form>
	</div>

<?php else : ?>
	<!--Empty cart-->
	<div class="hb-message message">
		<div class="hb-message-content">
			<?php _e( 'Your cart is empty!', 'sailing' ); ?>
		</div>
	</div>
<?php endif; ?>
