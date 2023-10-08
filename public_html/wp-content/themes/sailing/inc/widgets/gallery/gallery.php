<?php

class Gallery_Widget extends Thim_Widget
{
    function __construct()
    {
        parent::__construct(
            'gallery',
            esc_attr__('Thim: Filter Gallery ', 'sailing'),
            array(
                'description' => esc_attr__('gallery', 'sailing'),
                'help' => '',
                'panels_groups' => array('thim_widget_group'),
            ),
            array(),
            array(
                'cat' => array(
                    'type' => 'select',
                    'label' => esc_attr__('Select Category', 'sailing'),
                    'options' => $this->thim_get_categories()
                ),

                'limit' => array(
                    'type' => 'number',
                    'label' => esc_attr__('Limit Post', 'sailing'),
                    'default' => '5',
                ),
            ),
            TP_THEME_DIR . 'inc/widgets/gallery/'
        );
    }

    /**
     * Initialize the CTA widget
     */

    function get_template_name($instance)
    {
        return 'base';
    }

    function get_style_name($instance)
    {
        return false;
    }

// Get list category
    function thim_get_categories()
    {
        $args = array(
            'orderby' => 'id',
            'parent' => 0
        );
        $items = array();
        $items['all'] = '---------';
        $categories = get_categories($args);
        if (isset($categories)) {
            foreach ($categories as $key => $cat) {
                $items[$cat->cat_ID] = $cat->cat_name;
                $childrens = get_term_children($cat->term_id, $cat->taxonomy);
                if ($childrens) {
                    foreach ($childrens as $key => $children) {
                        $child = get_term_by('id', $children, $cat->taxonomy);
                        $items[$child->term_id] = '--' . $child->name;

                    }
                }
            }
        }
        return $items;
    }

    function enqueue_frontend_scripts()
    {
        wp_enqueue_style('thim-fancybox', TP_THEME_URI . 'inc/widgets/gallery/css/jquery.fancybox.css');
    }
}

function thim_gallery_widget()
{
    register_widget('Gallery_Widget');
}

add_action('widgets_init', 'thim_gallery_widget');