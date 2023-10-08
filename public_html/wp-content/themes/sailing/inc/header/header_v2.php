<!-- 2 -->
<div class="container">
	<div class="row">
		<div class="col-sm-12 inner-header-top">
			<div class="header-left table-cell">
				<?php 
					if ( is_active_sidebar( 'logo_left' ) ) { 
						dynamic_sidebar( 'logo_left' ); 
					} 
				?>
			</div>
			<div class="width-logo sm-logo table-cell">
				<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</div>
				<?php
				do_action( 'thim_logo' );
				do_action( 'thim_sticky_logo' );
				do_action( 'thim_mobile_logo' );
				?>
			</div>
			<div class="header-right table-cell">
				<?php 
					if ( is_active_sidebar( 'logo_right' ) ) { 
						dynamic_sidebar( 'logo_right' ); 
					} 
				?>
			</div>
			<!--end .row-->
		</div>
		<div class="navigation col-sm-12">
			<div class="tm-table">
				<nav class="width-navigation table-cell table-center">
					<?php
						get_template_part( 'inc/header/main-menu' );
					?>
				</nav>
			</div>
			<!--end .row-->
		</div>
	</div>
</div>