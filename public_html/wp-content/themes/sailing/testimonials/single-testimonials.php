<div class="testimonial-item-archive" id="post-<?php the_ID(); ?>">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $testimonial_id = get_the_ID(); ?>
		<div class="side-left">
			<div class="testimonial-thumbnail">
				<?php echo thim_get_thumbnail( get_the_ID(), '170x170', 'post', false ); ?>
			</div>
			<?php
			$regency = get_post_meta( $testimonial_id, 'regency', true );
			$author  = get_post_meta( $testimonial_id, 'author', true );
			echo '<div class="testimonial-info">';
			echo '<div class="author">' . esc_html( $author ) . '</div>';
			echo '<div class="regency">' . esc_html( $regency ) . '</div>';
			echo '</div>';
			?>
		</div>
		<div class="side-right">
			<div class="blockquote"><?php echo get_the_title() ?></div>
			<div class="description">
				<?php the_content(); ?>
			</div>
		</div>

		<div class="clear"></div>
	<?php endwhile; // end of the loop. ?>
</div>