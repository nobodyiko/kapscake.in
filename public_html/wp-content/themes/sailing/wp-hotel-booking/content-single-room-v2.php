<?php

/**
 * The template for displaying content single room v2.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/content-single-room.php.
 *
 * @author  ThimPress
 * @package WP-Hotel-Booking/Templates
 * @version 2.0
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit();

$wrapper_class_col = thim_wrapper_layout();

/**
 * hotel_booking_before_single_product hook
 */
do_action('hotel_booking_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();

    return;
}
?>

<div id="room-<?php the_ID(); ?>" <?php post_class('hb_single_room'); ?>>

    <?php

    /**
     * hotel_booking_single_room_gallery hook
     */
    do_action('hotel_booking_single_room_gallery');
    ?>

    <div class="top-content">
        <div class="container">
            <?php
            /**
             * hotel_booking_single_room_title hook
             */
            do_action('hotel_booking_single_room_title');

            /*
            *  hotel_booking_price_single_room hook
            */
            do_action('hotel_booking_price_single_room');
        ?>
        </div>
    </div>
    <div class="container">

        <?php
        /**
         * hotel_booking_before_loop_room_summary hook
         */
        do_action('hotel_booking_before_single_room');

        ?>
        <div class="row">
            <div class="content-room <?php echo $wrapper_class_col ?>">
                <div class="summary entry-summary">
                    <?php
                    /**
                     * hotel_booking_rooms_guests hook
                     */
                    do_action('hotel_booking_rooms_guests');

                    /**
                     * hotel_booking_single_room_infomation hook
                     */
                    do_action('hotel_booking_single_room_infomation');
                    ?>

                </div>
            </div>
            <?php
            if ($wrapper_class_col != 'col-sm-12 full-width') {
                get_sidebar();
            }
            ?>
        </div>

        <?php

        /**
         * hotel_booking_after_single_room hook
         */
        do_action('hotel_booking_after_single_room');

        /*
        * hotel_booking_single_shortcode_book_email hook
        */
        do_action('hotel_booking_single_shortcode_book_email');
        /**
         * hotel_booking_after_single_product hook
         */
        do_action('hotel_booking_after_single_product'); ?>
    </div>
    <div class="bottom-content wp-hotel-booking-search-rooms">
        <div class="container">
            <h4 class="title"><?php echo esc_html__('Explore other options', 'sailing'); ?></h4>
            <?php echo do_shortcode( '[hotel_booking widget_search="' . true . '" search_page="' . esc_url( hb_get_page_permalink( 'search' ) ) . '" show_title=""]' ); ?> 
        </div>
    </div>
</div>