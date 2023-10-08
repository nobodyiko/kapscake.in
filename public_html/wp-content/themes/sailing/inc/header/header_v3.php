<?php
/**
 * Created by PhpStorm.
 * User: dongc
 * Date: 7/25/2018
 * Time: 1:39 PM
 */
?>
<div class="navigation">
	<div class="tm-flex">
		<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</div>
		<div class="width-logo sm-logo">
			<?php do_action( 'thim_logo' ); ?>
			<?php do_action( 'thim_sticky_logo' ); ?>
			<?php do_action( 'thim_mobile_logo' ); ?>
		</div>
		<div class="header-left">
			<?php
			if ( is_active_sidebar( 'menu_left' ) ) {
				dynamic_sidebar( 'menu_left' );
			}
			?>
		</div>
		<div class="header-right">
			<div class="right-menu">
				<nav class="width-navigation main-navigation">
					<div class="inner-navigation">
						<?php get_template_part( 'inc/header/main-menu-v3' ); ?>
					</div>
				</nav>
			</div>
			<?php if ( is_active_sidebar( 'menu_right' ) ) { ?>
				<div class="menu-right">
					<?php dynamic_sidebar( 'menu_right' ); ?>
				</div>
			<?php } ?>

			<?php if ( get_theme_mod( 'header_search_display' ) ): ?>
				<div class="thim-search-wrapper">
					<div class="search-button"><span class="ion-ios-search"></span></div>
					<div class="thim-search-form">
						<span class="close-form"><i class="ion-close"></i></span>
						<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="search" class="search-field" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" required />
							<span class="search-notice"> <?php esc_html_e( 'Hit enter to search or ESC to close', 'sailing' ); ?></span>
						</form>
						<ul class="list-search list-unstyled"></ul>
					</div>
				</div>
			<?php endif; ?>
			<div class="menu-mobile-effect navbar-toggle hidden" data-effect="mobile-effect">
				<div class="icon-wrap">
					<i class="ion-navicon"></i>
				</div>
			</div>
		</div>
	</div>
</div>
