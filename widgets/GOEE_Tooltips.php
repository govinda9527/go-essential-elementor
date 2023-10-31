<?php
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class GOEE_Tooltips extends Widget_Base {

    public function get_name() {
        return 'goee-tooltip';
    }
    
    public function get_title() {
        return __( 'Tooltip', GOEE_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'goee goee-logo eicon-tools';
    }

    public function get_keywords() {
        return [ 'hover', 'title' ];
    }

    public function get_categories() {
        return [ 'goee-category' ];
    }

    protected function register_controls() {
        $goee_primary_color = get_option( 'goee_primary_color_option', '#7a56ff' );

        $this->start_controls_section(
            'tooltip_button_content',
            [
                'label' => __( 'Content Settings', GOEE_TEXTDOMAIN )
            ]
        );

        $this->add_control(
			'goee_tooltip_type',
			[
                'label'       => esc_html__( 'Content Type', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::CHOOSE,
                'toggle'      => false,
                'label_block' => true,
                'options'     => [
					'icon'      => [
						'title' => esc_html__( 'Icon', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-info-circle'
					],
					'text'      => [
						'title' => esc_html__( 'Text', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-area'
					],
					'image'     => [
						'title' => esc_html__( 'Image', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-image-bold'
					]
				],
				'default'     => 'icon'
			]
		);

  		$this->add_control(
			'goee_tooltip_content',
			[
                'label'       => esc_html__( 'Content', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'Hover Me!', GOEE_TEXTDOMAIN ),
                'condition'   => [
					'goee_tooltip_type' => [ 'text' ]
				]
			]
        );
		
		$this->add_control(
			'goee_tooltip_icon_content',
			[
                'label'       => esc_html__( 'Icon', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fab fa-linux',
                    'library' => 'fa-brands'
                ],
                'condition'   => [
					'goee_tooltip_type' => [ 'icon' ]
				]
			]
		);

		$this->add_control(
			'goee_tooltip_img_content',
			[
                'label'     => esc_html__( 'Image', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
                'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'goee_tooltip_type' => [ 'image' ]
				]
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'goee_tooltip_image_size',
                'default'   => 'thumbnail',
                'condition' => [
                    'goee_tooltip_type'              => [ 'image' ],
                    'goee_tooltip_img_content[url]!' => ''
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'goee_tooltip_image_css_filter',
                'selector' => '{{WRAPPER}} .goee-tooltip .goee-tooltip-content img',
                'condition' => [
                    'goee_tooltip_type' => [ 'image' ],
                    'goee_tooltip_img_content[url]!' => ''
				]
			]
		);

        $this->add_control(
            'tooltip_style_section_align',
            [
                'label'   => __( 'Alignment', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
                    'left'      => [
                        'title' => __( 'Left', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => __( 'Right', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'default'       => 'center',
                'prefix_class'  => 'goee-tooltip-align-'
            ]
        );

        $this->add_control(
            'goee_tooltip_enable_link',
            [
                'label'        => __( 'Show Link', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', GOEE_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'goee_tooltip_link',
            [
                'label'           => __( 'Link', GOEE_TEXTDOMAIN ),
                'type'            => Controls_Manager::URL,
                'placeholder'     => __( 'https://your-link.com', GOEE_TEXTDOMAIN ),
                'show_external'   => true,
                'default'         => [
                    'url'         => '',
                    'is_external' => true
                ],
                'condition'       => [
                    'goee_tooltip_enable_link'=>'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tooltip_options',
            [
                'label' => __( 'Tooltip Options', GOEE_TEXTDOMAIN )
            ]
        );

        $this->add_control(
            'goee_tooltip_text',
            [
                'label'       => esc_html__( 'Tooltip Text', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'These are some dummy tooltip contents.', GOEE_TEXTDOMAIN ),
                'dynamic'     => [ 'active' => true ]
            ]
        );

        $this->add_control(
          'goee_tooltip_direction',
            [
                'label'         => esc_html__( 'Direction', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'tooltip-right',
                'label_block'   => false,
                'options'       => [
                    'tooltip-left'   => esc_html__( 'Left', GOEE_TEXTDOMAIN ),
                    'tooltip-right'  => esc_html__( 'Right', GOEE_TEXTDOMAIN ),
                    'tooltip-top'    => esc_html__( 'Top', GOEE_TEXTDOMAIN ),
                    'tooltip-bottom' => esc_html__( 'Bottom', GOEE_TEXTDOMAIN )
                ]
            ]
        );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'tooltip_style_section',
            [
                'label' => __( 'General Styles', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => __( 'Text Typography', GOEE_TEXTDOMAIN ),
                'name'      => 'goee_tooltip_button_text_typography',
                'selector'  => '{{WRAPPER}} .goee-tooltip .goee-tooltip-content',
                'condition' => [
                    'goee_tooltip_type' => [ 'text' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_tooltip_button_icon_size',
            [
                'label'        => __( 'Icon Size', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 18
                ],
                'selectors'    => [
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-content i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'goee_tooltip_type' => [ 'icon' ]
                ]
            ]
        );

		$this->add_responsive_control(
			'goee_tooltip_content_width',
		    [
                'label' => __( 'Content Width', GOEE_TEXTDOMAIN ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100,
                        'step' => 1
		            ]
                ],
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 150
                ],
		        'selectors'  => [
		            '{{WRAPPER}} .goee-tooltip .goee-tooltip-content' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

		$this->add_responsive_control(
			'goee_tooltip_content_padding',
			[
                'label'      => esc_html__( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20
                ],
				'selectors'  => [
	 				'{{WRAPPER}} .goee-tooltip .goee-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			]
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'goee_tooltip_hover_border',
                'selector' => '{{WRAPPER}} .goee-tooltip .goee-tooltip-content'
            ]
        );

    
        $this->add_responsive_control(
            'goee_tooltip_content_radius',
            [
                'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->start_controls_tabs( 'goee_tooltip_content_style_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'goee_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );
                
				$this->add_control(
					'goee_tooltip_content_color',
					[
                        'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $goee_primary_color,
                        'condition' => [
                            'goee_tooltip_type!' => [ 'image' ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .goee-tooltip .goee-tooltip-content, {{WRAPPER}} .goee-tooltip .goee-tooltip-content a' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'goee_tooltip_content_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .goee-tooltip .goee-tooltip-content' => 'background-color: {{VALUE}};'
						]
					]
				);

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'goee_tooltip_content_shadow',
                        'selector' => '{{WRAPPER}} .goee-tooltip .goee-tooltip-content'
                    ]
                );

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'goee_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

				$this->add_control(
					'goee_tooltip_content_hover_color',
					[
                        'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'condition' => [
                            'goee_tooltip_type!' => [ 'image' ]
                        ],
                        'default'   => '#212121',
                        'selectors' => [
                            '{{WRAPPER}} .goee-tooltip .goee-tooltip-content:hover'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} .goee-tooltip .goee-tooltip-content a:hover' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'goee_tooltip_content_hover_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .goee-tooltip .goee-tooltip-content:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
                
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'goee_tooltip_hover_shadow',
                        'selector' => '{{WRAPPER}} .goee-tooltip .goee-tooltip-content:hover'
                    ]
                );
				
			$this->end_controls_tab();

        $this->end_controls_tabs();
                
        $this->end_controls_section();

        // Tooltip Style tab section
        $this->start_controls_section(
            'goee_tooltip_style_section',
            [
                'label' => __( 'Tooltip Styles', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hover_tooltip_content_typography',
                'selector' => '{{WRAPPER}} .goee-tooltip .goee-tooltip-text'
            ]
        );

        $this->add_control(
            'goee_tooltip_style_color',
            [
                'label'     => __( 'Text Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-item .goee-tooltip-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hover_tooltip_content_background',
                'types'    => [ 'classic', 'gradient' ],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => $goee_primary_color
                    ]
                ],
                'selector' => '{{WRAPPER}} .goee-tooltip .goee-tooltip-text'
            ]
        );

        $this->add_responsive_control(
			'goee_tooltip_text_width',
		    [
                'label' => __( 'Tooltip Width', GOEE_TEXTDOMAIN ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100
		            ]
		        ],
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 200
                ],
		        'selectors'    => [
		            '{{WRAPPER}} .goee-tooltip .goee-tooltip-text' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

        $this->add_responsive_control(
            'goee_tooltip_text_padding',
            [
                'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10
                ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  =>'before'
            ]
        );

        $this->add_responsive_control(
            'goee_tooltip_content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;'
                ]
            ]
        );
    
        $this->add_control(
            'goee_tooltip_arrow_color',
            [
                'label'     => __( 'Arrow Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $goee_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-item.tooltip-top .goee-tooltip-text:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-item.tooltip-left .goee-tooltip-text:after' => 'border-color: transparent transparent transparent {{VALUE}};',
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-item.tooltip-bottom .goee-tooltip-text:after' => 'border-color: transparent transparent {{VALUE}} transparent;',
                    '{{WRAPPER}} .goee-tooltip .goee-tooltip-item.tooltip-right .goee-tooltip-text:after' => 'border-color: transparent {{VALUE}} transparent transparent;'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings        = $this->get_settings_for_display();

        $this->add_render_attribute( 'goee_tooltip_wrapper', 'class', 'goee-tooltip' );

        if( isset( $settings['goee_tooltip_link']['url'] ) ) {
            $this->add_render_attribute( 'goee_tooltip_link', 'href', esc_url( $settings['goee_tooltip_link']['url'] ) );
            if( $settings['goee_tooltip_link']['is_external'] ) {
                $this->add_render_attribute( 'goee_tooltip_link', 'target', '_blank' );
            }
            if( $settings['goee_tooltip_link']['nofollow'] ) {
                $this->add_render_attribute( 'goee_tooltip_link', 'rel', 'nofollow' );
            }
        }

        $this->add_inline_editing_attributes( 'goee_tooltip_content', 'basic' );

        ?>
       
        <div <?php echo $this->get_render_attribute_string( 'goee_tooltip_wrapper' ); ?>>
            <div class="goee-tooltip-item <?php echo esc_attr( $settings['goee_tooltip_direction'] ); ?>">
                <div class="goee-tooltip-content">

                    <?php if( 'yes' === $settings['goee_tooltip_enable_link'] && !empty( $settings['goee_tooltip_link']['url'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'goee_tooltip_link' ); ?>>
                    <?php endif; ?>

                    <?php if( 'text' === $settings['goee_tooltip_type'] && !empty( $settings['goee_tooltip_content'] ) ) : ?>
                        <span <?php echo $this->get_render_attribute_string( 'goee_tooltip_content' ); ?>><?php echo wp_kses_post( $settings['goee_tooltip_content'] ); ?></span>

                    <?php elseif( 'icon' === $settings['goee_tooltip_type'] && !empty( $settings['goee_tooltip_icon_content']['value'] ) ) : ?>
                        <?php Icons_Manager::render_icon( $settings['goee_tooltip_icon_content'] ); ?>

                    <?php elseif( 'image' === $settings['goee_tooltip_type'] && !empty( $settings['goee_tooltip_img_content']['url'] ) ) : ?>
                        <?php if ( $settings['goee_tooltip_img_content']['url'] || $settings['goee_tooltip_img_content']['id'] ) { ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'goee_tooltip_image_size', 'goee_tooltip_img_content' ); ?>
                        <?php } ?>
                    <?php endif; ?>

                    <?php if( 'yes' === $settings['goee_tooltip_enable_link'] && !empty( $settings['goee_tooltip_link']['url'] ) ) : ?>
                        </a>
                    <?php endif; ?>

                </div>

                <?php $settings['goee_tooltip_text'] ? printf( '<div class="goee-tooltip-text">%s</div>', wp_kses_post( $settings['goee_tooltip_text'] ) ) : ''; ?>
            </div>
        </div>
        <?php
    }

}