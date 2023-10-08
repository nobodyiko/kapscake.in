<?php
$link_before    = $after_link = $image = $thim_animation = $images_size = '';
$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );

$src = wp_get_attachment_image_src( $instance['image'], $instance['image_size'] );

if ( !is_array( $instance['image_size'] ) ) {
	$img_size = explode( "x", $instance['image_size'] );
}

if ( $src ) {
	$images_size = @getimagesize( $src['0'] );
	$image       = '<img src ="' . $src['0'] . '" ' . $images_size['3'] . ' alt= "' . get_the_title() . '" />';
}

if ( $img_size[0] != 'full' && $img_size[0] != 'thumbnail' && $img_size[0] != 'medium' && $img_size[0] != 'large' ) {
	$image = '<img style="height:' . $img_size[1] . ';" src ="' . $src['0'] . '" width="' . $img_size[0] . '" height="' . $img_size[1] . '" alt= "' . get_the_title() . '" />';
}

if ( $instance['image_link'] ) {
	$link_before = '<a href="' . $instance['image_link'] . '" target="' . $instance['link_target'] . '">';
	$after_link  = "</a>";
}

echo '<div class="single-image ' . $instance['image_alignment'] . $thim_animation . '">' . $link_before . $image . $after_link . '</div>';