<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( has_post_thumbnail() ): ?>

	<div class="image-event">
		<?php if ( !is_singular( 'tp_event' ) || !in_the_loop() ): ?>
			<?php echo thim_get_thumbnail( get_the_ID(), '364x246', 'post', false ); ?>
		<?php else: ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
	</div>

<?php endif; ?>