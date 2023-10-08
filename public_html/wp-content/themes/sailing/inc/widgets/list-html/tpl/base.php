<?php
echo '<div class="list-html-content">';
if ( $instance['list-html'] ) {
	foreach ( $instance['list-html'] as $i => $list_html ) {
		if ( $i % 2 != 0 ) {
			echo '<div class="col-sm-6"><div class="item-content">';
			echo '<div class="title-list"><h5>' . ( $i + 1 ) . '. ' . $list_html['title'] . ' </h5></div>';
			echo '<div class="desc-list">' . $list_html['content'] . '</div>';

			echo '</div></div>';
			echo '</div>';
		} else {
			echo '<div class="row">';
			echo '<div class="col-sm-6"><div class="item-content">';
			echo '<div class="title-list"><h5>' . ( $i + 1 ) . '. ' . $list_html['title'] . ' </h5></div>';
			echo '<div class="desc-list">' . $list_html['content'] . '</div>';

			echo '</div></div>';
		}
	}
}
$surplus = count( $instance['list-html'] );
if ( $surplus % 2 != 0 ) {
	echo '</div>';
}
echo '<span class="line-center"></span></div>';
?>