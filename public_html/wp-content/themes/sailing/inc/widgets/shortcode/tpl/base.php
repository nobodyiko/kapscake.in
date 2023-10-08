<?php
$title     = $instance['title'];
$shortcode = $instance['shortcode'];
$shortcode = do_shortcode( $shortcode );
?>

<div class="thim-shortcode">
	<?php
	if ( $title ) {
		echo '<h3 class="widget-title">' . $title . '</h3>';
	}
	?>
	<?php echo $shortcode; ?>
</div>