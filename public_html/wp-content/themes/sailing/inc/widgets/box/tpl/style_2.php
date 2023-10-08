<?php
$image_icon       = $image_background = '';
$image_icon       = wp_get_attachment_image_src( $instance['image_icon'], $instance['image_size'] );
$image_background = wp_get_attachment_image_src( $instance['image_background'], $instance['image_size'] );

if ( $instance['small_title'] ) {
	$small_title = '<div class="small-title">' . $instance['small_title'] . '</div>';
}

if ( $instance['title'] ) {
	$title = '<h3 class="title">' . $instance['title'] . '</h3>';
}

if ( $image_icon ) {
	$images_size = @getimagesize( $image_icon['0'] );
	$image_icon  = '<img src ="' . $image_icon['0'] . '" ' . $images_size['3'] . ' alt= "' . get_the_title() . '" />';
}

if ( $image_background ) {
	$images_size      = @getimagesize( $image_background['0'] );
	$image_background = '<img src ="' . $image_background['0'] . '" ' . $images_size['3'] . ' alt= "' . get_the_title() . '" />';
}

if ( $instance['image_link'] ) {
	$link_before = '<a target="' . $instance['link_target'] . '" href="' . $instance['image_link'] . '">';
	$after_link  = "</a>";
}

?>
<div class="box_image style_2">
	<?php echo $link_before; ?>
	<div class="image_background">
		<?php echo $image_background; ?>
	</div>
	<div class="content-box">
		<div class="icon-image">
			<?php echo $image_icon; ?>
		</div>
		<div class="content-text">
			<?php echo $small_title; ?>
			<?php echo $title; ?>
		</div>
	</div>
	<?php echo $after_link; ?>
</div>

