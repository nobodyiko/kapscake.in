<!-- 1 -->
<?php
	$full_width = get_theme_mod('enable_fullwidth');
	if($full_width == true){
		$class = '-fluid full-width';
	}else{
		$class = '';
	}
?>
<div class="container<?php echo esc_attr($class) ?>">
	<div class="row">
		<div class="navigation col-sm-12">
			<div class="tm-table">
				<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</div>
				<div class="width-logo table-cell sm-logo">
					<?php
					do_action( 'thim_logo' );
					do_action( 'thim_sticky_logo' );
					do_action( 'thim_mobile_logo' );
					?>
				</div>
				<?php
					if(get_theme_mod('thim_topbar_show') == 1){
						$has_topbar = 'has-topbar';
					}else{
						$has_topbar = '';
					}
				?>
				<nav class="width-navigation table-cell table-right <?php echo esc_attr($has_topbar) ?>">
					<?php
					if ( get_theme_mod('thim_topbar_show') == 1 ) {
						get_template_part( 'inc/header/top-header' );
					}
					get_template_part( 'inc/header/main-menu' );
					?>
				</nav>
			</div>
			<!--end .row-->
		</div>
	</div>
</div>