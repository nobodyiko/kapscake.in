<?php
/**
 * The Template for displaying pagination of archive events page.
 *
 * Override this template by copying it to yourtheme/wp-events-manager/pagination.php
 *
 * @author        ThimPress
 * @package       WP-Events-Manager/template
 * @version       1.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
} ?>

<a href="" class="load-more-events" data-paged="2" data-maxpage="<?php echo esc_html( $wp_query->max_num_pages ) ?>"><?php echo esc_html__( 'Load more', 'sailing' ) ?></a>
