<?php
$title          = $link_face = $link_twitter = $link_google = $link_dribble = $link_pinterest = $link_youtube = $link_digg = $link_linkedin = '';
$title          = $instance['title'];
$link_face      = $instance['link_face'];
$link_twitter   = $instance['link_twitter'];
$link_google    = $instance['link_google'];
$link_dribble   = $instance['link_dribble'];
$link_linkedin  = $instance['link_linkedin'];
$link_pinterest = $instance['link_pinterest'];
$link_digg      = $instance['link_digg'];
$link_youtube   = $instance['link_youtube'];
$link_instagram = $instance['link_instagram'];

$ref     = isset( $instance['ref'] ) ? $instance['ref'] : '';
$ref_tag = '';
if ( $ref != '' ) {
	$ref_tag .= 'ref="' . $ref . '"';
}

?>
<div class="thim-social version-old">
	<?php
	if ( $title ) {
		echo '<h3 class="widget-title">' . $title . '</h3>';
	}
	?>
	<ul class="social_link">
		<?php
		if ( $link_face != '' ) {
			echo '<li><a class="face hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_face ) . '" target="' . $instance['link_target'] . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( $link_twitter != '' ) {
			echo '<li><a class="twitter hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_twitter ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-x-twitter"></i></a></li>';
		}
		if ( $link_google != '' ) {
			echo '<li><a class="google hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_google ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( $link_dribble != '' ) {
			echo '<li><a class="dribble hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_dribble ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( $link_linkedin != '' ) {
			echo '<li><a class="linkedin hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_linkedin ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-linkedin"></i></a></li>';
		}

		if ( $link_pinterest != '' ) {
			echo '<li><a class="pinterest hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_pinterest ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( $link_digg != '' ) {
			echo '<li><a class="digg hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_digg ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-digg"></i></a></li>';
		}
		if ( $link_youtube != '' ) {
			echo '<li><a class="youtube hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_youtube ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-youtube"></i></a></li>';
		}
		if ( $link_instagram != '' ) {
			echo '<li><a class="instagram hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $link_instagram ) . '" target="' . $instance['link_target'] . '" ><i class="fa fa-instagram"></i></a></li>';
		}
		?>
	</ul>
</div>