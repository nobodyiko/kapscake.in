<?php

/**
 * Created by PhpStorm.
 * User: dongc
 * Date: 7/27/2018
 * Time: 9:52 AM
 */
class Thim_Column_Post_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'column-post',
			esc_attr__( 'Thim: Post Column', 'sailing' ),
			array(
				'description'   => esc_attr__( 'Show Post Column', 'sailing' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'cat_id'       => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'Select Categories', 'sailing' ),
					'default' => 'none',
					'options' => $this->get_categories()
				),
				'number_posts' => array(
					'type'    => 'number',
					'label'   => esc_attr__( 'Number Post', 'sailing' ),
					'default' => '3'
				),
				'column'       => array(
					'type'    => 'select',
					'label'   => __( 'Column', 'sailing' ),
					'options' => array(
						'2' => esc_attr__( '2', 'sailing' ),
						'3' => esc_attr__( '3', 'sailing' ),
						'4' => esc_attr__( '4', 'sailing' ),
					),
				),
				'orderby'      => array(
					'type'    => 'select',
					'label'   => __( 'Order by', 'sailing' ),
					'options' => array(
						'popular' => esc_attr__( 'Popular', 'sailing' ),
						'recent'  => esc_attr__( 'Recent', 'sailing' ),
						'title'   => esc_attr__( 'Title', 'sailing' ),
						'random'  => esc_attr__( 'Random', 'sailing' ),
					),
				),
				'order'        => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'Order by', 'sailing' ),
					'options' => array(
						'asc'  => esc_attr__( 'ASC', 'sailing' ),
						'desc' => esc_attr__( 'DESC', 'sailing' )
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/column-post/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

	// Get list category
	function get_categories() {
		$args         = array(
			'orderby' => 'id',
			'parent'  => 0
		);
		$items        = array();
		$items['all'] = 'All';
		$categories   = get_categories( $args );
		if ( isset( $categories ) ) {
			foreach ( $categories as $key => $cat ) {
				$items[$cat->cat_ID] = $cat->cat_name;
				$childrens           = get_term_children( $cat->term_id, $cat->taxonomy );
				if ( $childrens ) {
					foreach ( $childrens as $key => $children ) {
						$child                  = get_term_by( 'id', $children, $cat->taxonomy );
						$items[$child->term_id] = '--' . $child->name;

					}
				}
			}
		}

		return $items;
	}
}

function thim_column_post_register_widget() {
	register_widget( 'Thim_Column_Post_Widget' );
}

add_action( 'widgets_init', 'thim_column_post_register_widget' );