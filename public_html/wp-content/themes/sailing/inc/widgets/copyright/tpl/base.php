<?php
/**
 * Created by PhpStorm.
 * User: dongc
 * Date: 05/23/2018
 * Time: 5:31 PM
 */
$first_text = isset( $instance['first_text'] ) ? $instance['first_text'] : '&copy;';
$year       = isset( $instance['year'] ) ? $instance['year'] : '2018';
$site_name  = isset( $instance['site_name'] ) ? $instance['site_name'] : 'ThimPress';
$link_site  = isset( $instance['link_site'] ) ? $instance['link_site'] : 'https://thimpress.com/';
$last_text  = isset( $instance['last_text'] ) ? $instance['last_text'] : 'All rights reserved. Powered by <a href="https://wordpress.org/">WordPress</a>.';
?>
<div class="copyright-text">
	<?php echo $first_text; ?> <?php echo '<a href="' . $link_site . '" ref="nofollow">' . $site_name . '</a>' ?> <?php echo $year; ?>. <?php echo $last_text; ?>
</div>