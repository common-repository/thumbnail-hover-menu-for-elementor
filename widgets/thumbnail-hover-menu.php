<?php

namespace ThumbnailHoverMenuForElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class ThumbnailHoverMenu extends Widget_Base
{
    public function get_name()
    {
        return 'thumbnail-hover-menu-for-elementor';
    }
    
    public function get_title()
    {
        return __( 'Thumbnail Hover Menu', 'thumbnail-hover-menu-for-elementor' );
    }

    public function get_icon()
    {
        return 'thmfe-icon';
    }
    
    public function get_categories()
    {
        return [ 'general' ];
    }

    public function get_style_depends()
    {
        return [ 'thumbnail-hover-menu-style' ];
    }

    public function get_script_depends()
    {
        return [ 'thumbnail-hover-menu-script' ];
    }
    
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'thumbnail-hover-menu-for-elementor' ),
            ]
        );

        $this->add_control(
            'source',
            [
                'label' => __( 'Content Type', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'menu' => __( 'Menu', 'thumbnail-hover-menu-for-elementor' ),
                    'post_type' => __( 'Post Type', 'thumbnail-hover-menu-for-elementor' ),
                ],
                'default' => 'menu',
            ]
        );

        if ( $available_menus = $this->get_available_menus() ) {
            $this->add_control(
                'menu',
                [
                    'label' => __( 'Select Menu', 'thumbnail-hover-menu-for-elementor' ),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $available_menus,
                    'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'thumbnail-hover-menu-for-elementor' ), admin_url( 'nav-menus.php' ) ),
                    'label_block' => 'true',
                    'separator' => 'before',
                    'condition' => [
                        'source' => 'menu'
                    ],
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus</a> screen to create one.', 'thumbnail-hover-menu-for-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'separator' => 'before',
                    'condition' => [
                        'source' => 'menu'
                    ],
                ]
            );
        }

        $this->add_control(
            'post_type',
            [
                'label' => __( 'Select Post Type', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_available_post_types(),
                'separator' => 'before',
                'label_block' => 'true',
                'condition' => [
                    'source' => 'post_type'
                ],
            ]
        );

        $this->add_control(
            'post_status',
            [
                'label' => __( 'Post status', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'publish' => __( 'Publish', 'thumbnail-hover-menu-for-elementor' ),
                    'pending' => __( 'Pending', 'thumbnail-hover-menu-for-elementor' ),
                    'draft' => __( 'Draft', 'thumbnail-hover-menu-for-elementor' ),
                    'auto-draft' => __( 'Auto draft', 'thumbnail-hover-menu-for-elementor' ),
                    'future' => __( 'Future', 'thumbnail-hover-menu-for-elementor' ),
                    'private' => __( 'Private', 'thumbnail-hover-menu-for-elementor' ),
                    'trash' => __( 'Trash', 'thumbnail-hover-menu-for-elementor' ),
                    'any' => __( 'Any', 'thumbnail-hover-menu-for-elementor' ),
                ],
                'default' => 'publish',
                'condition' => [
                    'source' => 'post_type'
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Post number', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 5,
                'condition' => [
                    'source' => 'post_type'
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __( 'Order by', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'thumbnail-hover-menu-for-elementor' ),
                    'ID' => __( 'ID', 'thumbnail-hover-menu-for-elementor' ),
                    'author' => __( 'Author', 'thumbnail-hover-menu-for-elementor' ),
                    'title' => __( 'Title', 'thumbnail-hover-menu-for-elementor' ),
                    'name' => __( 'Name', 'thumbnail-hover-menu-for-elementor' ),
                    'type' => __( 'Type', 'thumbnail-hover-menu-for-elementor' ),
                    'date' => __( 'Date', 'thumbnail-hover-menu-for-elementor' ),
                    'modified' => __( 'Modified', 'thumbnail-hover-menu-for-elementor' ),
                    'parent' => __( 'Parent', 'thumbnail-hover-menu-for-elementor' ),
                    'rand' => __( 'Random', 'thumbnail-hover-menu-for-elementor' ),
                    'comment_count' => __( 'Comment count', 'thumbnail-hover-menu-for-elementor' ),
                    'relevance' => __( 'Relevance', 'thumbnail-hover-menu-for-elementor' ),
                    'menu_order' => __( 'Menu order', 'thumbnail-hover-menu-for-elementor' ),
                    'meta_value' => __( 'Meta value', 'thumbnail-hover-menu-for-elementor' ),
                    'meta_clause' => __( 'Meta clause', 'thumbnail-hover-menu-for-elementor' ),
                    'post__in' => __( 'Preserve post ID order given in the "Include posts by IDs" option', 'thumbnail-hover-menu-for-elementor' ),
                ],
                'default' => 'date',
                'condition' => [
                    'source' => 'post_type'
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __( 'ASC', 'thumbnail-hover-menu-for-elementor' ),
                    'DESC' => __( 'DESC', 'thumbnail-hover-menu-for-elementor' ),
                ],
                'default' => 'DESC',
                'condition' => [
                    'source' => 'post_type'
                ],
            ]
        );

        $this->add_control(
            'thumbnail_size',
            [
                'label' => __( 'Thumbnail size', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => $available_image_sizes = $this->get_available_image_sizes(),
                'default' => array_keys( $available_image_sizes )[0],
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'menu',
                                'operator' => '!==',
                                'value' => ''
                            ],
                            [
                                'name' => 'post_type',
                                'operator' => '!==',
                                'value' => ''
                            ]
                        ]
                ]
            ]
        );

        $this->add_control(
            'disable-links',
            [
                'label' => __( 'Disable links', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'thumbnail-hover-menu-for-elementor' ),
                'label_off' => __( 'No', 'thumbnail-hover-menu-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'conditions' => [
                    'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'menu',
                                'operator' => '!==',
                                'value' => ''
                            ],
                            [
                                'name' => 'post_type',
                                'operator' => '!==',
                                'value' => ''
                            ]
                        ]
                ]
            ]
        );

        $this->add_control(
            'disable-tablet',
            [
                'label' => __( 'Disable on tablet', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'thumbnail-hover-menu-for-elementor' ),
                'label_off' => __( 'No', 'thumbnail-hover-menu-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'conditions' => [
                    'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'menu',
                                'operator' => '!==',
                                'value' => ''
                            ],
                            [
                                'name' => 'post_type',
                                'operator' => '!==',
                                'value' => ''
                            ]
                        ]
                ]
            ]
        );

        $this->add_control(
            'disable-mobile',
            [
                'label' => __( 'Disable on mobile', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'thumbnail-hover-menu-for-elementor' ),
                'label_off' => __( 'No', 'thumbnail-hover-menu-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'conditions' => [
                    'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'menu',
                                'operator' => '!==',
                                'value' => ''
                            ],
                            [
                                'name' => 'post_type',
                                'operator' => '!==',
                                'value' => ''
                            ]
                        ]
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_menu',
            [
                'label' => __( 'Menu', 'thumbnail-hover-menu-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'label' => __( 'Typography', 'thumbnail-hover-menu-for-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .thmfe-cursor_trigger',
            ]
        );

        $this->add_responsive_control(
            'menu_text_align',
            [
                'label' => __( 'Text align', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'thumbnail-hover-menu-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'thumbnail-hover-menu-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'thumbnail-hover-menu-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .thmfe-menu' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tab_menu_text_color' );

        $this->start_controls_tab(
            'tab_menu_text_color_normal',
            [
                'label' => __( 'Normal', 'thumbnail-hover-menu-for-elementor' ),
            ]
        );

        $this->add_control(
            'menu_text_color_normal',
            [
                'label' => __( 'Color', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thmfe-cursor_trigger' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_menu_text_color_hover',
            [
                'label' => __( 'Hover', 'thumbnail-hover-menu-for-elementor' ),
            ]
        );

        $this->add_control(
            'menu_text_color_hover',
            [
                'label' => __( 'Color', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thmfe-cursor_trigger:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_thumbnail',
            [
                'label' => __( 'Thumbnail', 'thumbnail-hover-menu-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thumbnail_width',
            [
                'label' => __( 'Width', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .thmfe-cursor_list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_height',
            [
                'label' => __( 'Height', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .thmfe-cursor_list' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_padding',
            [
                'label' => __( 'Padding', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .thmfe-cursor_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thumbnail_border',
                'label' => __( 'Border', 'thumbnail-hover-menu-for-elementor' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .thmfe-cursor_list',
            ]
        );
        
        $this->add_responsive_control(
            'thumbnail_border_radius',
            [
                'label' => __( 'Border Radius', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thmfe-cursor_list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'thumbnail_box_shadow',
                'label' => __( 'Box Shadow', 'thumbnail-hover-menu-for-elementor' ),
                'selector' => '{{WRAPPER}} .thmfe-cursor_list',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thumbnail_background',
                'label' => __( 'Background', 'thumbnail-hover-menu-for-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .thmfe-cursor_list',
            ]
        );

        $this->add_responsive_control(
            'thumbnail_vertical_align',
            [
                'label' => __( 'Vertical Align', 'thumbnail-hover-menu-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '0' => [
                        'title' => __( 'Top', 'thumbnail-hover-menu-for-elementor' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    '-50' => [
                        'title' => __( 'Middle', 'thumbnail-hover-menu-for-elementor' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    '-100' => [
                        'title' => __( 'Bottom', 'thumbnail-hover-menu-for-elementor' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .thmfe-cursor_list' => 'transform: scale(0) translateY({{VALUE}}%);',
                    '{{WRAPPER}} .thmfe-cursor_list.thmfe-is-active' => 'transform: scale(1) translateY({{VALUE}}%);',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_available_menus()
    {
        $menus = wp_get_nav_menus();

        $options = array();

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }

    private function get_available_post_types()
    {
        $post_types = get_post_types( [ 'public' => true ], 'objects' ); 
        
        $options = array();

        foreach ( $post_types as $post_type ) {
            if ( ! in_array( $post_type->name, [ 'page' , 'attachment', 'elementor_library' ] ) ) {
                $options[ $post_type->name ] = $post_type->label;
            }
        }

        return $options;
    }

    private function get_available_image_sizes()
    {
        $intermediate_image_sizes = get_intermediate_image_sizes();
        $additional_image_sizes = wp_get_additional_image_sizes();

        $sizes = array();

        foreach( $intermediate_image_sizes as $size ) {
            $title = ucwords( str_replace( '_', ' ', $size ) );

            if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
                $width = get_option( $size . '_size_w' );
                $height = get_option( $size . '_size_h' );

                $sizes[ $size ] = $title . ' (' . $width . 'x' . $height . ')';
            } elseif ( isset( $additional_image_sizes[ $size ] ) ) {
                $width = $additional_image_sizes[ $size ]['width'];
                $height = $additional_image_sizes[ $size ]['height'];

                $sizes[ $size ] = $title . ' (' . $width . 'x' . $height . ')';
            }
        }

        $sizes['full'] = __( 'Full', 'thumbnail-hover-menu-for-elementor' );
    
        return $sizes;
    }

    protected function render()
    {
        $settings = $this->get_active_settings();

        $this->add_render_attribute( 'container', 'class', 'thmfe-container' );
        $this->add_render_attribute( 'container', 'class', ( $settings['disable-tablet'] === 'yes' ) ? 'disable-tablet' : '' );
		$this->add_render_attribute( 'container', 'class', ( $settings['disable-mobile'] === 'yes' ) ? 'disable-mobile' : '' );

        echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';

        $items = ( $settings['source'] === 'menu' )
            ? $this->get_menu_items( $settings['menu'] )
            : $this->get_posts( [
                'post_type' => $settings['post_type'],
                'post_status' => $settings['post_status'],
                'posts_per_page' => $settings['posts_per_page'],
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
            ] );

        $output = '<ul class="thmfe-menu">';

        $output .= apply_filters( 'thmfe_before_menu_items', '' );
    
        foreach ( $items as $item ) {
            $tag = ( $settings['disable-links'] === 'yes' ) ? 'span' : 'a';

            if ( $settings['disable-links'] !== 'yes' ) {
                $this->set_render_attribute( 'href', 'href', esc_url( get_the_permalink( $item ) ) );
            }

            if ( has_post_thumbnail( $item ) ) {
                $this->set_render_attribute( 'trigger-id', 'data-thmfe-cursor-trigger-id', esc_attr( $item ) );
            }

            $output .= '<li>';
            $output .= '
                <' . $tag . '
                    class="thmfe-cursor_trigger"
                    ' . $this->get_render_attribute_string( 'href' ) . '
                    ' . $this->get_render_attribute_string( 'trigger-id' ) . '
                >
            ';
            $output .= apply_filters( 'thmfe_before_menu_item', '', $item );
            $output .= get_the_title( $item );
            $output .= apply_filters( 'thmfe_after_menu_item', '', $item );
            $output .= '</' . $tag . '>';
            $output .= '</li>';
        }

        $output .= apply_filters( 'thmfe_after_menu_items', '' );

        $output .= '</ul>';

        $output .= '<div class="thmfe-cursor">';
        $output .= '<div class="thmfe-cursor_inner">';
        $output .= '<div class="thmfe-cursor_list">';
    
        foreach ( $items as $item ) {
            if ( ! has_post_thumbnail( $item ) ) {
                continue;
            }

            $this->set_render_attribute( 'item-id', 'data-thmfe-cursor-item-id', esc_attr( $item ) );

            $output .= '
                <div
                    class="thmfe-cursor_item"
                    ' . $this->get_render_attribute_string( 'item-id' ) . '
                >
                    ' . get_the_post_thumbnail( $item, $settings['thumbnail_size'], [ 'class' => 'thmfe-cursor_img' ] ) . '
                </div>
            ';
        }
    
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        if ( $items ) {
            echo $output;
        }

        echo '</div>';
    }

    private function get_posts( $args )
    {
        $posts = [];

        if ( ! $args['post_type'] ) {
            return $posts;
        }
    
        $defaults = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        );
    
        $args = wp_parse_args( $args, $defaults );
    
        $query = new \WP_Query( $args );
    
        if ( ! $query->have_posts() ) {
            wp_reset_postdata();
    
            return $posts;
        }
    
        while ( $query->have_posts() ) {
            $query->the_post();
            
            global $post;
    
            $posts[] = $post->ID;
        }
        
        wp_reset_postdata();
    
        return $posts;
    }
    
    private function get_menu_items( $menu = null )
    {
        $items = [];
    
        if ( ! $menu ) {
            return $items;
        }
    
        $menu_items = wp_get_nav_menu_items( $menu );
    
        foreach ( $menu_items as $menu_item ) {
            if ( in_array( $menu_item->object, [ 'page' ] ) ) {
                $items[] = $menu_item->object_id;
            }
        }
    
        return $items;
    }
}
