<?php
$title = '';
$title = $instance['title'];

$ref     = isset( $instance['ref'] ) ? $instance['ref'] : '';
$ref_tag = '';
if ( $ref != '' ) {
	$ref_tag .= 'ref="' . $ref . '"';
}

?>
<div class="thim-social version-new">
	<?php
	if ( $title ) {
		echo '<h3 class="widget-title">' . $title . '</h3>';
	}
	?>
	<ul class="social_link">
		<?php
		if ( $instance['new_version'] ) {
			foreach ( $instance['new_version'] as $key => $social ) {
				echo '<li><a class="' . $social['social_name'] . ' hasTooltip" ' . $ref_tag . ' href="' . esc_attr( $social['social_url'] ) . '" target="' . $instance['link_target'] . '"><i class="fa fa-' . $social['social_name'] . '"></i></a></li>';
			}
		}
		?>
	</ul>
</div>