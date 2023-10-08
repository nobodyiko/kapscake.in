<?php
/**
 * Header Main Menu Template
 *
 */
?>
<ul id="primary-menu" class="nav navbar-nav menu-main-menu">
	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'link_before'    => '<span>',
			'link_after'     => '</span>'
		) );
	} else {
		wp_nav_menu( array(
			'theme_location' => '',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'link_before'    => '<span>',
			'link_after'     => '</span>'
		) );
	}
	?>
</ul>