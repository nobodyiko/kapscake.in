<?php
$image_left       = wp_get_attachment_image_src( $instance['image_left'], $instance['image_size'] );
$image_right      = wp_get_attachment_image_src( $instance['image_right'], $instance['image_size'] );
$image_background = wp_get_attachment_image_src( $instance['image_background'], $instance['image_size'] );

if ( $image_left ) {
	$images_size = @getimagesize( $image_left['0'] );
	$image_1     = '<img src ="' . esc_url($image_left['0']) . '" ' . $images_size['3'] . ' alt= "' . get_the_title() . '" />';
}

if ( $image_right ) {
	
	$images_size = @getimagesize( $image_right['0'] );
	$image_2     = '<img src ="' . esc_url($image_right['0']) . '" ' . $images_size['3'] . ' alt= "' . get_the_title() . '" />';
}

if ( $image_background ) {
	$images_size = @getimagesize( $image_background['0'] );
	$image_3     = '<img src ="' . esc_url($image_background['0']) . '" ' . $images_size['3'] . ' alt= "' . get_the_title() . '" />';
}

if ( $instance['image_link'] ) {
	$link_before = '<a target="' . $instance['link_target'] . '" href="' . esc_url($instance['image_link']) . '">';
	$after_link  = "</a>";
}else{
	$link_before = '';
	$after_link = '';
}

?>
<div class="box_image style_1">
	<?php echo ent2ncr($link_before); ?>
	<div class="image">
		<div class="row">
			<div class="image-left col-md-6 col-sm-6">
				<?php
					if(isset($image_1)){
						echo ent2ncr($image_1);
					}
				 ?>
			</div>
			<div class="image-right col-md-6 col-sm-6">
				<?php
					if(isset($image_2)){
						echo ent2ncr($image_2);
					}
				?>
			</div>
		</div>
	</div>
	<div class="image_background">
		<?php
			if(isset($image_3)){
				echo ent2ncr($image_3);
			}
		?>
	</div>
	<?php echo ent2ncr($after_link); ?>
</div>

