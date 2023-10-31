<?php

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class GOEE_Image_Carousel extends Widget_Base {
	
	public function get_name() {
		return 'goee-image-carousel';
	}

	public function get_title() {
		return esc_html__( 'Image Carousel', GOEE_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'goee goee-logo eicon-carousel';
	}

	public function get_categories() {
		return [ 'goee-category' ];
	}

	public function get_script_depends() {
		return [ 'goee-slick' ];
	}

	public function get_keywords() {
        return [ 'image', 'slider', 'thumbnail', 'brand' ];
    }
	
	protected function register_controls() {
		$goee_primary_color   = get_option( 'goee_primary_color_option', '#7a56ff' );
		
	    /*
	    * Image carousel Image
	    */
	    $this->start_controls_section(
			'goee_image_carousel_content',
			[
				'label' => esc_html__( 'Content', GOEE_TEXTDOMAIN )
			]
		);

        $image_repeater = new Repeater();

		$image_repeater->add_control(
			'goee_image_carousel_image',
			[
				'label'   => __( 'Image', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
        );
        
		$image_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image_image_size',
				'default'   => 'full',
				'condition' => [
					'goee_image_carousel_image[url]!' => ''
				]
			]
		);
        
		$image_repeater->add_control(
			'goee_image_carousel_link_to_type',
			[
				'label'   => esc_html__( 'Link to', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'separator'  => 'before',
				'options' => [
					''       => esc_html__( 'None', GOEE_TEXTDOMAIN ),
					'file'   => esc_html__( 'Media File', GOEE_TEXTDOMAIN ),
					'custom' => esc_html__( 'Custom URL', GOEE_TEXTDOMAIN ),
				],
			]
		);

		$image_repeater->add_control(
			'goee_image_carousel_image_link_to',
			[
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'dynamic'     => [ 'active' => true ],
				'separator'  => 'none',
				'show_label' => false,
				'condition' => [
					'goee_image_carousel_link_to_type' => 'custom',
				],
			]
		);

        $this->add_control(
			'goee_image_carousel_repeater',
			[
				'label'   => esc_html__( 'Image Carousel', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $image_repeater->get_controls(),
				'default' => [
					[ 'goee_image_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'goee_image_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'goee_image_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'goee_image_carousel_image' => Utils::get_placeholder_image_src() ]
				]	
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'goee_image_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_responsive_control(
			'goee_image_slide_to_show',
			[
				'label'   => esc_html__( 'Columns', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);

		$this->add_control(
			'goee_image_slide_to_scroll',
			[
				'label'   => esc_html__( 'Slide to Scroll', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1'
			]
		);

		$this->add_control(
			'goee_image_carousel_nav',
			[
				'label'     => esc_html__( 'Navigation', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'arrows',
				'separator' => 'before',
				'options' => [
                    'arrows' => esc_html__( 'Arrows', GOEE_TEXTDOMAIN ),
                    'dots'   => esc_html__( 'Dots', GOEE_TEXTDOMAIN ),
                    'both'   => esc_html__( 'Arrows and Dots', GOEE_TEXTDOMAIN ),
                    'none'   => esc_html__( 'None', GOEE_TEXTDOMAIN )
                    
                ]
			]
		);

		$this->add_control(
			'goee_image_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'default'   => 'no'
			]
		);

		$this->add_control(
			'goee_image_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'goee_image_autoplay' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_image_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'goee_image_smooth_scroll',
			[
				'label'   => esc_html__( 'Smooth Scroll', GOEE_TEXTDOMAIN ),
				'description' => __( '<b>Autoplay Speed option not working. This is not necessary for linear slide</b>', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->add_control(
			'goee_image_smooth_scroll_speed',
			[
				'label'     => esc_html__( 'Speed', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3000,
				'condition' => [
					'goee_image_smooth_scroll' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/*
		* Image Carousel Styling Section
		*/

		$this->start_controls_section(
			'goee_image_carousel_style_background',
			[
				'label' => esc_html__( 'General Style', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'goee_image_carousel_max_height_enable',
            [
                'label'        => __( 'Minimum Height', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', GOEE_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_responsive_control(
			'goee_image_carousel_max_height',
			[
				'label' => __( 'Height', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .goee-image-carousel-element.goee-image-carousel-max-height-yes .goee-image-carousel-item' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'goee_image_carousel_max_height_enable' => 'yes'
                ]
			]
		);

		$this->add_control(
			'goee_image_carousel_alignment',
			[
				'label'       => esc_html__( 'Alignment', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => true,
				'options'     => [
					'goee-image-carousel-left'   => [
						'title' => esc_html__( 'Left', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'goee-image-carousel-center' => [
						'title' => esc_html__( 'Center', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'goee-image-carousel-right'  => [
						'title' => esc_html__( 'Right', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'     => 'goee-image-carousel-center'
			]
		);

		$this->add_responsive_control(
			'goee_image_carousel_item_radius',
			[
				'label'      => esc_html__( 'Item Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_image_carousel_item_margin',
			[
				'label'      => esc_html__( 'Item margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default'    => [
					'top'    => '0',
					'right'  => '10',
					'bottom' => '20',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_image_carousel_item_padding',
			[
				'label'      => esc_html__( 'Item Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'goee_image_carousel_background_tabs' );

			$this->start_controls_tab( 'goee_image_carousel_background_control', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

				$this->add_control(
					'goee_image_carousel_background',
					[
						'label'     => esc_html__( 'Background', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-item' => 'background: {{VALUE}};'
						]
					]
				);
				$this->add_control(
					'goee_image_carousel_opacity_normal',
					[
						'label'     => __('Opacity', GOEE_TEXTDOMAIN),
						'type'      => Controls_Manager::NUMBER,
						'range'     => [
							'min'   => 0,
							'max'   => 1
						],
						'selectors' => [
							'{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item img' => 'opacity: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'goee_image_carousel_border_normal',
						'selector' => '{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'goee_image_carousel_shadow_normal',
						'selector' => '{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item'
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'goee_image_carousel_background_hover_control', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

				$this->add_control(
					'goee_image_carousel_background_hover',
					[
						'label'     => esc_html__( 'Background Hover', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-item:hover' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'goee_image_carousel_opacity_hover',
					[
						'label'     => __('Opacity', GOEE_TEXTDOMAIN),
						'type'      => Controls_Manager::NUMBER,
						'range'     => [
							'min'   => 0,
							'max'   => 1
						],
						'selectors' => [
							'{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item:hover img' => 'opacity: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'goee_image_carousel_border_hover',
						'selector' => '{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'goee_image_carousel_shadow_hover',
						'selector' => '{{WRAPPER}} .goee-image-carousel .goee-image-carousel-element .goee-image-carousel-item:hover'
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->end_controls_section();

		$this->start_controls_section(
            'goee_image_carousel_arrow_controls_style_section',
            [
                'label'     => __('Arrow Controls', GOEE_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'goee_image_carousel_nav' => ['arrows', 'both']
                ]               
            ]
        );

        $this->add_control(
            'goee_image_carousel_arrows_style',
            [
				'label' => esc_html__( 'Arrows', GOEE_TEXTDOMAIN ),
				'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_responsive_control(
            'goee_image_carousel_arrows_size',
            [
                'label'         => __( 'Size', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 20
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 70,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev i, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_image_carousel_arrow_width',
            [
                'label'         => __( 'Width', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 60
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_image_carousel_arrow_height',
            [
                'label'         => __( 'Height', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 60
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                ]
            ]
		);
		
		$this->add_control(
			'goee_image_carousel_prev_arrow_position',
			[
				'label' => __( 'Previous Arrow Position', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', GOEE_TEXTDOMAIN ),
				'label_on' => __( 'Custom', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'goee_image_carousel_prev_arrow_position_x_offset',
                [
                    'label' => __( 'X Offset', GOEE_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'goee_image_carousel_prev_arrow_position_y_offset',
                [
                    'label' => __( 'Y Offset', GOEE_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

        $this->add_control(
			'goee_image_carousel_next_arrow_position',
			[
				'label' => __( 'Next Arrow Position', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', GOEE_TEXTDOMAIN ),
				'label_on' => __( 'Custom', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'goee_image_carousel_next_arrow_position_x_offset',
                [
                    'label' => __( 'X Offset', GOEE_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'goee_image_carousel_next_arrow_position_y_offset',
                [
                    'label' => __( 'Y Offset', GOEE_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_popover();
		
		$this->add_responsive_control(
			'goee_image_carousel_arrows_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ '%'],
				'selectors'  => [
					'{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next,{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'default'    => [
					'top'    => 50,
					'right'  => 50,
					'bottom' => 50,
					'left'   => 50
				] 
			]
		);

		$this->start_controls_tabs( 'goee_image_carousel_arrows_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'goee_image_carousel_arrow_normal_style', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

		        $this->add_control(
		            'goee_image_carousel_arrows_color',
		            [
		                'label'         => __( 'Color', GOEE_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#000000',
		                'selectors'     => [
		                    '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next i, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev i' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'goee_image_carousel_arrows_bg_color',
		            [
		                'label'         => __( 'Background Color', GOEE_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#dddddd',
		                'selectors'     => [
		                    '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev' => 'background-color: {{VALUE}}'
		                ]            
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'goee_image_carousel_arrows_border',
		                'selector'  => '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev'
		            ]
		        );

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'goee_image_carousel_arrows_shadow',
						'selector' => '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next'
					]
				);

			$this->end_controls_tab();


        	// hover state tab
        	$this->start_controls_tab( 'goee_image_carousel_arrow_hover_style', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

		        $this->add_control(
		            'goee_image_carousel_arrows_hover_color',
		            [
		                'label'         => __( 'Color', GOEE_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#ffffff',
		                'selectors'     => [
		                    '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next:hover i, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev:hover i' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'goee_image_carousel_arrows_hover_bg_color',
		            [
		                'label'         => __( 'Background Color', GOEE_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => $goee_primary_color,
		                'selectors'     => [
		                    '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next:hover, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev:hover' => 'background-color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'goee_image_carousel_arrows_hover_border',
		                'selector'  => '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next:hover, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev:hover'
		            ]
		        );

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'goee_image_carousel_arrows_hover_shadow',
						'selector' => '{{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-prev:hover, {{WRAPPER}} .goee-image-carousel-element .goee-image-carousel-next:hover'
					]
				);

			$this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_image_carousel_dot_bullet_controls_style_section',
            [
                'label'     => __('Dots', GOEE_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'goee_image_carousel_nav' => ['dots', 'both']
                ]                
            ]
        );

        $this->add_responsive_control(
            'goee_image_carousel_dot_bullet_margin',
            [
                'label'      => __('Margin', GOEE_TEXTDOMAIN),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
					'top'    => 0,
					'right'  => 10,
					'bottom' => 0,
					'left'   => 0
                ], 
                'selectors'  => [
                    '{{WRAPPER}} .goee-image-carousel .slick-dots li button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'goee_image_carousel_dot_bullet_style_tabs' );

        // normal state tab
        $this->start_controls_tab( 'goee_image_carousel_dot_bullet_normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

            $this->add_responsive_control(
                'goee_image_carousel_dot_bullet_height',
                [
                    'label'  => __( 'Height', GOEE_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'default'  => [
                        'size' => 10,
                        'unit' => 'px'
                    ],
                    'selectors'=> [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'goee_image_carousel_dot_bullet_width',
                [
                    'label'  => __( 'Width', GOEE_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'default'  => [
                        'size' => 10,
                        'unit' => 'px'
                    ],
                    'selectors'=> [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'goee_image_carousel_dot_bullet_color',
                [
                    'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#dadada',
                    'selectors' => [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li button' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'            => 'goee_image_carousel_dot_bullet_border',
                    'selector'        => '{{WRAPPER}} .goee-image-carousel .slick-dots li button',
                ]
            );

            $this->add_responsive_control(
                'goee_image_carousel_dot_bullet_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'default'    => [
                        'top'    => 100,
                        'right'  => 100,
                        'bottom' => 100,
                        'left'   => 100,
                        'unit'   => '%'
                    ],                
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            // active state tab
            $this->start_controls_tab( 'goee_image_carousel_dot_bullet_active', [ 'label' => esc_html__( 'Active', GOEE_TEXTDOMAIN ) ] );

            $this->add_responsive_control(
                'goee_image_carousel_dot_bullet_active_height',
                [
                    'label'  => __( 'Height', GOEE_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'goee_image_carousel_dot_bullet_active_width',
                [
                    'label'  => __( 'Width', GOEE_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'goee_image_carousel_dot_bullet_active_color',
                [
                    'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $goee_primary_color,
                    'selectors' => [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li.slick-active button' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
					'name'     => 'goee_image_carousel_dot_bullet_active_border',
					'selector' => '{{WRAPPER}} .goee-image-carousel .slick-dots li.slick-active button'
                ]
            );

            $this->add_responsive_control(
                'goee_image_carousel_dot_bullet_active_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                    'type'       => Controls_Manager::DIMENSIONS,         
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .goee-image-carousel .slick-dots li.slick-active button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


	}
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$direction = is_rtl() ? 'true' : 'false';

		$this->add_render_attribute( 
			'goee_image_carousel', 
			[ 
				'class'               => ['goee-image-carousel-element', 'goee-image-carousel-max-height-'.esc_attr($settings['goee_image_carousel_max_height_enable'])],
				'data-carousel-nav'   => esc_attr( $settings['goee_image_carousel_nav'] ),
				'data-slidestoshow'   => esc_attr( $settings['goee_image_slide_to_show'] ),
				'data-slidestoshow-tablet'   => intval( esc_attr( isset( $settings['goee_image_slide_to_show_tablet'] ) ) ? (int)$settings['goee_image_slide_to_show_tablet'] : 2  ),
				'data-slidestoshow-mobile'   => intval( esc_attr( isset( $settings['goee_image_slide_to_show_mobile'] ) ) ? (int)$settings['goee_image_slide_to_show_mobile'] : 1),
				'data-slidestoscroll' => esc_attr( $settings['goee_image_slide_to_scroll'] ),
				'data-direction'      => esc_attr( $direction ),
			]
		);

		if ( 'yes' === $settings['goee_image_loop'] ) {
			$this->add_render_attribute( 'goee_image_carousel', 'data-loop', 'true' );
		}
		if ( 'yes' === $settings['goee_image_autoplay'] ) {
			$this->add_render_attribute( 'goee_image_carousel', 'data-autoplay', 'true' );
			$this->add_render_attribute( 'goee_image_carousel', 'data-autoplayspeed', esc_attr( $settings['goee_image_autoplay_speed'] ) );
		}
		if ( 'yes' === $settings['goee_image_smooth_scroll'] ) {
			$this->add_render_attribute( 'goee_image_carousel', 'data-smooth', 'true' );
			$this->add_render_attribute( 'goee_image_carousel', 'data-smooth-speed', esc_attr( $settings['goee_image_smooth_scroll_speed'] ) );
		}

		if ( is_array( $settings['goee_image_carousel_repeater'] ) ) : ?>
			<div class="goee-image-carousel">
				<div <?php echo $this->get_render_attribute_string('goee_image_carousel') ;?> >
					<?php foreach ( $settings['goee_image_carousel_repeater'] as $index => $image ) :?>
						<?php $image_link = 'goee-image-link-' . $index ;?>
						<div class="goee-image-carousel-item <?php echo esc_attr( $settings['goee_image_carousel_alignment'] );?>">
						<?php 
							if ( ! empty( $image['goee_image_carousel_image_link_to']['url'] ) ) {
								$this->add_render_attribute( $image_link, 'href', $image['goee_image_carousel_image_link_to']['url'] );

								if ( $image['goee_image_carousel_image_link_to']['is_external'] ) {
									$this->add_render_attribute( $image_link, 'target', '_blank' );
								}

								if ( $image['goee_image_carousel_image_link_to']['nofollow'] ) {
									$this->add_render_attribute( $image_link, 'rel', 'nofollow' );
								}
							} else if( "file" === $image['goee_image_carousel_link_to_type'] ) {
								$this->add_render_attribute( $image_link, 'href', $image['goee_image_carousel_image']['url'] );
								$this->add_render_attribute( $image_link, 'class', 'goee-image-carousel-lightbox' );
								$this->add_render_attribute( $image_link, 'data-elementor-open-lightbox', 'yes' );
							}
							if( ! empty( $image['goee_image_carousel_link_to_type'] ) ){
						?>
						<a <?php echo $this->get_render_attribute_string( $image_link ); ?> > <?php } ?>

							<?php echo Group_Control_Image_Size::get_attachment_image_html( $image, 'image_image_size', 'goee_image_carousel_image' ); ?>

						<?php if( ! empty( $image['goee_image_carousel_link_to_type'] ) ){ ?>
							</a>
						<?php } ?>

						</div>					
					<?php endforeach; ?>
				</div>
			</div>
		<?php
		endif;
        ?>
        <div class="main">
            <div class="slider slider-for">
                <div><h3>1</h3></div>
                <div><h3>2</h3></div>
                <div><h3>3</h3></div>
                <div><h3>4</h3></div>
                <div><h3>5</h3></div>
            </div>
        </div>
        <?php
        if ( is_array( $settings['goee_image_carousel_repeater'] ) ) : ?>
			<div class="goee-image-carousel">
					<?php foreach ( $settings['goee_image_carousel_repeater'] as $index => $image ) :?>
						<?php $image_link = 'goee-image-link-' . $index ;?>
						<div class="goee-image-carousel-item <?php echo esc_attr( $settings['goee_image_carousel_alignment'] );?>">
						<?php 
							if ( ! empty( $image['goee_image_carousel_image_link_to']['url'] ) ) {
								$this->add_render_attribute( $image_link, 'href', $image['goee_image_carousel_image_link_to']['url'] );

								if ( $image['goee_image_carousel_image_link_to']['is_external'] ) {
									$this->add_render_attribute( $image_link, 'target', '_blank' );
								}

								if ( $image['goee_image_carousel_image_link_to']['nofollow'] ) {
									$this->add_render_attribute( $image_link, 'rel', 'nofollow' );
								}
							} else if( "file" === $image['goee_image_carousel_link_to_type'] ) {
								$this->add_render_attribute( $image_link, 'href', $image['goee_image_carousel_image']['url'] );
								$this->add_render_attribute( $image_link, 'class', 'goee-image-carousel-lightbox' );
								$this->add_render_attribute( $image_link, 'data-elementor-open-lightbox', 'yes' );
							}
							if( ! empty( $image['goee_image_carousel_link_to_type'] ) ){
						?>
						<a <?php echo $this->get_render_attribute_string( $image_link ); ?> > <?php } ?>

							<?php echo Group_Control_Image_Size::get_attachment_image_html( $image, 'image_image_size', 'goee_image_carousel_image' ); ?>

						<?php if( ! empty( $image['goee_image_carousel_link_to_type'] ) ){ ?>
							</a>
						<?php } ?>

						</div>					
					<?php endforeach; ?>
			</div>
		<?php
		endif;
        ?>
<?php
	}
}