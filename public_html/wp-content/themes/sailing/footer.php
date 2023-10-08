<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package thim
 */
$border_top = '';
$class2     = '';

if ( get_theme_mod( 'thim_footer_style' ) == true ) {
	$class  = 'container_custom';
	$class2 = 'footer_style_new';
} else {
	$class = 'container';
}

?>

<?php if ( is_active_sidebar( 'main-bottom' ) ) : ?>
	<div class="main-bottom">
		<div class="<?php echo $class; ?>">
			<div class="row">
				<?php dynamic_sidebar( 'main-bottom' ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( get_theme_mod( 'thim_footer_background_img' ) ) {
	$style = 'background-image: url(' . thim_ssl_secure_url( get_theme_mod( 'thim_footer_background_img' ) ) . ');';
} else {
	$style = '';
} ?>

<footer style="<?php echo $style; ?>" id="colophon" class="site-footer <?php echo $class2; ?>">
	<?php if ( get_theme_mod( 'thim_footer_style' ) == false ) { ?>
		<div class="<?php echo $class; ?>">
			<div class="row">
				<?php if ( is_active_sidebar( 'footer' ) ) : ?>
					<div class="footer">
						<?php $border_top = ' border-copyright' ?>
						<?php dynamic_sidebar( 'footer' ); ?>
					</div>
				<?php endif; ?>
				<?php
				if ( is_active_sidebar( 'footer_copyright' ) ) {
					echo '<div class="col-sm-12"><div class="text-copyright' . $border_top . '">';
					dynamic_sidebar( 'footer_copyright' );
					echo '</div></div>';
				}
				?>
			</div>
		</div>
	<?php } else { ?>
		<div class="<?php echo $class; ?>">
			<div class="row">
				<?php if ( is_active_sidebar( 'footer' ) ) : ?>
					<div class="footer">
						<?php $border_top = ' border-copyright' ?>
						<?php dynamic_sidebar( 'footer' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		if ( is_active_sidebar( 'footer_copyright' ) ) {
			echo '<div class="copy-right-new"><div class="text-copyright' . $border_top . '">';
			dynamic_sidebar( 'footer_copyright' );
			echo '</div></div>';
		}
		?>
	<?php } ?>

</footer><!-- #colophon -->

<?php if ( get_theme_mod( 'thim_show_to_top' ) == 1 ) { ?>
	<a id='back-to-top' class="scrollup show" title="<?php esc_attr_e( 'Go To Top', 'sailing' ); ?>"></a>
<?php } ?>
</div><!--end main-content-->
</div></div><!-- .wrapper-container -->

<?php if ( get_theme_mod( 'thim_show_offcanvas_sidebar' ) == true && is_active_sidebar( 'offcanvas_sidebar' ) ) { ?>
	<div class="slider-sidebar">
		<?php dynamic_sidebar( 'offcanvas_sidebar' ); ?>
	</div>  <!--slider_sidebar-->
<?php } ?>
<div class="covers-parallax"></div>
<?php wp_footer(); ?>
</body>
</html>

