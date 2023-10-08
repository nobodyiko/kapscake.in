<?php
	if(get_theme_mod( 'thim_header_style' ) == 'header_v1' && (is_active_sidebar( 'menu_left' ) || is_active_sidebar( 'menu_right' ))){
		$flex_class = ' navigation-flex ';
	}else{
		$flex_class = '';
	}
?>
<div class="inner-navigation <?php echo esc_attr($flex_class) ?>">
	<?php if ( 'header_v2' === get_theme_mod( 'thim_header_style' ) && is_active_sidebar( 'logo_right' ) ) { ?>
		<div class="header-right">
			<?php
				dynamic_sidebar( 'logo_right' );
			
			?>
		</div>
	<?php }elseif(is_active_sidebar( 'menu_left' )){ ?>
		<div class="menu-left">
			<?php
				dynamic_sidebar( 'menu_left' );
			?>
		</div>	
	<?php } ?>
	<ul class="nav navbar-nav menu-main-menu">
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
		//sidebar menu_right
		?>
	</ul>

	<?php
	if ( is_active_sidebar( 'menu_right' ) || ( get_theme_mod( 'thim_show_offcanvas_sidebar' ) == true && is_active_sidebar( 'offcanvas_sidebar' ) ) ) {
		echo '<ul class="menu-right">';
		if ( is_active_sidebar( 'menu_right' ) ) {
			dynamic_sidebar( 'menu_right' );
		}
		if ( get_theme_mod( 'thim_show_offcanvas_sidebar' ) == true && is_active_sidebar( 'offcanvas_sidebar' ) ) {
			?>
			<li class="sliderbar-menu-controller">
				<?php
				$icon = '';
				if ( get_theme_mod( 'thim_icon_offcanvas_sidebar' ) ) {
					$icon = 'fa ' . get_theme_mod( 'thim_icon_offcanvas_sidebar' );
				}
				?>
				<span>
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
			</span>
			</li>
			<?php
		}
		echo '</ul>';
	} ?>
	<?php if ('header_v2' === get_theme_mod( 'thim_header_style' ) &&  is_active_sidebar( 'logo_left' ) ) { ?>
		<div class="header-left">
			<?php
			
				dynamic_sidebar( 'logo_left' );
			
			?>
		</div>
	<?php } ?>
</div>
<!--</div>-->