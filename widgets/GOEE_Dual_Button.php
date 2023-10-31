<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class GOEE_Dual_Button extends Widget_Base {
	
	public function get_name() {
		return 'goee-dual-button';
	}

	public function get_title() {
		return esc_html__( 'Dual Button', GOEE_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'goee goee-logo eicon-dual-button';
	}

	public function get_categories() {
		return [ 'goee-category' ];
	}

    public function get_keywords() {
        return [ 'multiple', 'dual', 'anchor', 'link', 'btn', 'double' ];
    }

	protected function register_controls() {
        $goee_primary_color   = get_option( 'goee_primary_color_option', '#7a56ff' );
        $goee_secondary_color = get_option( 'goee_secondary_color_option', '#00d8d8' );

        /*
        * Exad Dual Button Content
        */
        $this->start_controls_section(
            'goee_content_section',
            [
                'label' => esc_html__( 'Content', GOEE_TEXTDOMAIN )
            ]
        );

        $this->start_controls_tabs( 'goee_dual_button_content_tabs' );

            $this->start_controls_tab( 'goee_dual_button_primary_button_content', [ 'label' => esc_html__( 'Primary', GOEE_TEXTDOMAIN ) ] );

                $this->add_control(
                    'goee_dual_button_primary_button_text',
                    [
                        'label'       => esc_html__( 'Text', GOEE_TEXTDOMAIN ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Primary', GOEE_TEXTDOMAIN ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_primary_button_url',
                    [
                        'label'         => esc_html__( 'Link', GOEE_TEXTDOMAIN ),
                        'type'          => Controls_Manager::URL,
                        'label_block'   => true,
                        'placeholder'   => __( 'https://your-link.com', GOEE_TEXTDOMAIN ),
                        'show_external' => true,
                        'default'       => [
                            'url'         => '#',
                            'is_external' => true
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_primary_button_icon',
                    [
                        'label'   => esc_html__( 'Icon', GOEE_TEXTDOMAIN ),
                        'type'    => Controls_Manager::ICONS,
                        'default' => [
                            'value'   => 'far fa-user',
                            'library' => 'fa-regular'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_primary_button_icon_position',
                    [
                        'label'     => __( 'Icon Position', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::CHOOSE,
                        'toggle'    => false,
                        'options'   => [
                            'goee-icon-pos-left'  => [
                                'title' => __( 'Left', GOEE_TEXTDOMAIN ),
                                'icon'  => 'eicon-angle-left'
                            ],
                            'goee-icon-pos-right' => [
                                'title' => __( 'Right', GOEE_TEXTDOMAIN ),
                                'icon'  => 'eicon-angle-right'
                            ]
                        ],
                        'default'   => 'goee-icon-pos-left',
                        'condition' => [
                            'goee_dual_button_primary_button_icon[value]!' => ''
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'goee_dual_button_connector_content', [ 'label' => esc_html__( 'Connector', GOEE_TEXTDOMAIN ) ] );

                $this->add_control(
                    'goee_dual_button_connector_switch',
                    [
                        'label'        => esc_html__( 'Connector Show/Hide', GOEE_TEXTDOMAIN ),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => __( 'Show', GOEE_TEXTDOMAIN ),
                        'label_off'    => __( 'Hide', GOEE_TEXTDOMAIN ),
                        'return_value' => 'yes',
                        'default'      => 'no'
                    ]
                );

                $this->add_control(
                    'goee_dual_button_connector_type',
                    [
                        'label'     => esc_html__( 'Type', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'icon',
                        'options'   => [
                            'icon'  => __( 'Icon', GOEE_TEXTDOMAIN ),
                            'text'  => __( 'Text', GOEE_TEXTDOMAIN )
                        ],
                        'condition' => [
                            'goee_dual_button_connector_switch' => 'yes'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_connector_text',
                    [
                        'label'     => esc_html__( 'Text', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => esc_html__( 'OR', GOEE_TEXTDOMAIN ),
                        'condition' => [
                            'goee_dual_button_connector_switch' => 'yes',
                            'goee_dual_button_connector_type'   => 'text'
                        ],
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_connector_icon',
                    [
                        'label'       => esc_html__( 'Icon', GOEE_TEXTDOMAIN ),
                        'type'        => Controls_Manager::ICONS,
                        'default'     => [
                            'value'   => 'fas fa-star',
                            'library' => 'fa-solid'
                        ],
                        'condition'   => [
                            'goee_dual_button_connector_switch' => 'yes',
                            'goee_dual_button_connector_type'   => 'icon'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'goee_dual_button_secondary_button_content', [ 'label' => esc_html__( 'Secondary', GOEE_TEXTDOMAIN ) ] );

                $this->add_control(
                    'goee_dual_button_secondary_button_text',
                    [
                        'label'       => esc_html__( 'Text', GOEE_TEXTDOMAIN ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Secondary', GOEE_TEXTDOMAIN ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_secondary_button_url',
                    [
                        'label'         => esc_html__( 'Link', GOEE_TEXTDOMAIN ),
                        'type'          => Controls_Manager::URL,
                        'label_block'   => true,
                        'placeholder'   => __( 'https://your-link.com', GOEE_TEXTDOMAIN ),
                        'show_external' => true,
                        'default'       => [
                            'url'         => '#',
                            'is_external' => true
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_secondary_button_icon',
                    [
                        'label'   => esc_html__( 'Icon', GOEE_TEXTDOMAIN ),
                        'type'    => Controls_Manager::ICONS,
                        'default' => [
                            'value'   => 'fas fa-plane',
                            'library' => 'fa-solid'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_secondary_button_icon_position',
                    [
                        'label'     => __( 'Icon Position', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::CHOOSE,
                        'toggle'    => false,
                        'options'   => [
                            'goee-icon-pos-left'  => [
                                'title' => __( 'Left', GOEE_TEXTDOMAIN ),
                                'icon'  => 'eicon-angle-left'
                            ],
                            'goee-icon-pos-right' => [
                                'title' => __( 'Right', GOEE_TEXTDOMAIN ),
                                'icon'  => 'eicon-angle-right'
                            ]
                        ],
                        'default'   => 'goee-icon-pos-left',
                        'condition' => [
                            'goee_dual_button_secondary_button_icon[value]!' => ''
                        ]
                    ]
                );

            $this->end_controls_tab();

	    $this->end_controls_tabs();

        $this->end_controls_section();

        /*
        * Exad Dual Button Container Style
        */
        $this->start_controls_section(
            'goee_container_style_section',
            [
                'label' => esc_html__( 'Container', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'goee_dual_button_container_alignment',
			[
                'label'   => __( 'Alignment', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
					'goee-dual-button-align-left'   => [
                        'title' => __( 'Left', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-text-align-left'
					],
					'goee-dual-button-align-center' => [
                        'title' => __( 'Center', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-text-align-center'
					],
					'goee-dual-button-align-right'  => [
                        'title' => __( 'Right', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-text-align-right'
					]
				],
                'default' => 'goee-dual-button-align-center'
			]
        );

        $this->add_responsive_control(
			'goee_dual_button_padding',
			[
                'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '12',
                    'right'    => '45',
                    'bottom'   => '12',
                    'left'     => '45',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-dual-button-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );
        
        $this->add_responsive_control(
			'goee_dual_button_container_button_margin',
			[
                'label'      => __( 'Space Between Buttons', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'     => [
						'min' => -3,
						'max' => 100
					]
                ],
                'default'  => [
					'unit' => 'px',
					'size' => 10
				],
				'selectors' => [
                    '{{WRAPPER}} .goee-dual-button-primary'                             => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .goee-dual-button-primary .goee-dual-button-connector' => 'right: calc( 0px - {{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .goee-dual-button-secondary'                           => 'margin-left: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->end_controls_section();

        /*
        * Exad Dual Button Primary Button Style
        */
        $this->start_controls_section(
            'goee_container_primary_button_style',
            [
                'label' => esc_html__( 'Primary Button', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'goee_container_primary_button_padding',
			[
                'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-dual-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'goee_container_primary_button_margin',
			[
                'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-dual-button-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'goee_container_primary_button_typography',
                'selector' => '{{WRAPPER}} .goee-dual-button-primary span'
			]
        );
        
        $this->add_responsive_control(
			'goee_dual_button_primary_button_radius',
			[
                'label'      => __( 'Border radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => 'px'
                ],
				'selectors'  => [
                    '{{WRAPPER}} .goee-dual-button-primary, 
                    {{WRAPPER}} .goee-dual-button-primary.effect-1::before,
                    {{WRAPPER}} .goee-dual-button-primary.effect-2::before,
                    {{WRAPPER}} .goee-dual-button-primary.effect-3::before,
                    {{WRAPPER}} .goee-dual-button-primary.effect-4::before,
                    {{WRAPPER}} .goee-dual-button-primary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'goee_dual_button_primary_button_icon_margin',
			[
                'label'       => __( 'Icon Space', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 10
                ],
				'selectors'   => [
                    '{{WRAPPER}} .goee-dual-button-primary .goee-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .goee-dual-button-primary .goee-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
                'condition'   => [
                    'goee_dual_button_primary_button_icon[value]!' => ''
                ]
			]
        );
        
        $this->add_control(
            'goee_dual_button_primary_button_animation',
            [
                'label'   => esc_html__( 'Hover Effect', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __( 'Effect 1', GOEE_TEXTDOMAIN ),
                    'effect-2' => __( 'Effect 2', GOEE_TEXTDOMAIN ),
                    'effect-3' => __( 'Effect 3', GOEE_TEXTDOMAIN ),
                    'effect-4' => __( 'Effect 4', GOEE_TEXTDOMAIN ),
                    'effect-5' => __( 'Effect 5', GOEE_TEXTDOMAIN ),
                    'effect-6' => __( 'Effect 6', GOEE_TEXTDOMAIN )
                ]
            ]
        );

        $this->start_controls_tabs( 'goee_dual_button_primary_button_tabs' );

            $this->start_controls_tab( 'goee_dual_button_primary_button_noemal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

                $this->add_control(
                    'goee_dual_button_primary_button_normal_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-primary' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_primary_button_normal_bg',
                    [
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $goee_primary_color,
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-primary.effect-1' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-2' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-3' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-4' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-5' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-6' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_dual_button_primary_button_normal_border',
                        'selector' => '{{WRAPPER}} .goee-dual-button-primary'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'goee_dual_button_primary_button_normal_box_shadow',
                        'selector' => '{{WRAPPER}} .goee-dual-button-primary'
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'goee_dual_button_primary_button_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

                $this->add_control(
                    'goee_dual_button_primary_button_hover_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-primary:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_primary_button_hover_bg',
                    [
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#5543dc',
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-primary.effect-1::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-2::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-3::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-4::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-5:hover'   => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-primary.effect-6::before' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_dual_button_primary_button_hover_border',
                        'selector' => '{{WRAPPER}} .goee-dual-button-primary:hover'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'goee_dual_button_primary_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .goee-dual-button-primary:hover'
                    ]
                );

            $this->end_controls_tab();

	    $this->end_controls_tabs();

        $this->end_controls_section();

        /*
        * Exad Dual Button Connector Style
        */
        $this->start_controls_section(
            'goee_dual_button_connector_style',
            [
                'label'     => esc_html__( 'Connector', GOEE_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'goee_dual_button_connector_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
			'goee_dual_button_connector_height',
			[
                'label'      => __( 'Height', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'  => [
					'unit' => 'px',
					'size' => 30
				],
				'selectors' => [
					'{{WRAPPER}} .goee-dual-button-connector' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
        );
        
        $this->add_responsive_control(
			'goee_dual_button_connector_width',
			[
                'label'      => __( 'Width', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 30
				],
				'selectors' => [
					'{{WRAPPER}} .goee-dual-button-connector' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'      => 'goee_dual_button_connector_typoghrphy',
                'selector'  => '{{WRAPPER}} .goee-dual-button-connector span',
                'condition' => [
                    'goee_dual_button_connector_type' => 'text'
                ]
			]
        );
        
        $this->add_responsive_control(
			'goee_dual_button_connector_icon_size',
			[
                'label'      => __( 'Icon Size', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 40
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 14
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-dual-button-connector span' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'goee_dual_button_connector_type'         => 'icon',
                    'goee_dual_button_connector_icon[value]!' => ''
                ]
			]
		);

        $this->add_control(
            'goee_dual_button_connector_background',
            [
                'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .goee-dual-button-connector' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'goee_dual_button_connector_color',
            [
                'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .goee-dual-button-connector span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'goee_dual_button_connector_radius',
			[
                'label'      => __( 'Border radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => '%'
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-dual-button-connector' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'     => 'goee_dual_button_connector_border',
                'selector' => '{{WRAPPER}} .goee-dual-button-connector'
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'goee_dual_button_connector_box_shadow',
                'selector' => '{{WRAPPER}} .goee-dual-button-connector'
			]
		);

        $this->end_controls_section();

        /*
        * Exad Dual Button secondary Button Style
        */
        $this->start_controls_section(
            'goee_container_secondary_button_style',
            [
                'label' => esc_html__( 'Secondary Button', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'goee_container_secondary_button_padding',
			[
                'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-dual-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'goee_container_secondary_button_margin',
			[
                'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-dual-button-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'goee_container_secondary_button_typography',
                'selector' => '{{WRAPPER}} .goee-dual-button-secondary span'
			]
        );
        
        $this->add_responsive_control(
			'goee_dual_button_secondary_button_radius',
			[
                'label'      => __( 'Border radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => 'px'
                ],
				'selectors'  => [
                    '{{WRAPPER}} .goee-dual-button-secondary, {{WRAPPER}} .goee-dual-button-secondary.effect-1::before, {{WRAPPER}} .goee-dual-button-secondary.effect-2::before, {{WRAPPER}} .goee-dual-button-secondary.effect-3::before, {{WRAPPER}} .goee-dual-button-secondary.effect-4::before, {{WRAPPER}} .goee-dual-button-secondary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'goee_dual_button_secondary_button_icon_margin',
			[
                'label'       => __( 'Icon Space', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 10
                ],
				'selectors'   => [
                    '{{WRAPPER}} .goee-dual-button-secondary .goee-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .goee-dual-button-secondary .goee-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
                'condition'   => [
                    'goee_dual_button_secondary_button_icon[value]!' => ''
                ]
			]
        );
        
        $this->add_control(
            'goee_dual_button_secondary_button_animation',
            [
                'label'   => esc_html__( 'Hover Effect', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __( 'Effect 1', GOEE_TEXTDOMAIN ),
                    'effect-2' => __( 'Effect 2', GOEE_TEXTDOMAIN ),
                    'effect-3' => __( 'Effect 3', GOEE_TEXTDOMAIN ),
                    'effect-4' => __( 'Effect 4', GOEE_TEXTDOMAIN ),
                    'effect-5' => __( 'Effect 5', GOEE_TEXTDOMAIN ),
                    'effect-6' => __( 'Effect 6', GOEE_TEXTDOMAIN )
                ]
            ]
        );

        $this->start_controls_tabs( 'goee_dual_button_secondary_button_tabs' );

            $this->start_controls_tab( 'goee_dual_button_secondary_button_noemal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

                $this->add_control(
                    'goee_dual_button_secondary_button_normal_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-secondary' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_secondary_button_normal_bg',
                    [
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $goee_secondary_color,
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-1' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-2' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-3' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-4' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-5' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-6' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_dual_button_secondary_button_normal_border',
                        'selector' => '{{WRAPPER}} .goee-dual-button-secondary'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'goee_dual_button_secondary_button_normal_box_shadow',
                        'selector' => '{{WRAPPER}} .goee-dual-button-secondary'
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'goee_dual_button_secondary_button_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

                $this->add_control(
                    'goee_dual_button_secondary_button_hover_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-secondary:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_dual_button_secondary_button_hover_bg',
                    [
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#04c1c1',
                        'selectors' => [
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-1::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-2::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-3::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-4::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-5:hover'   => 'background: {{VALUE}};',
                            '{{WRAPPER}} .goee-dual-button-secondary.effect-6::before' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_dual_button_secondary_button_hover_border',
                        'selector' => '{{WRAPPER}} .goee-dual-button-secondary:hover'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'goee_dual_button_secondary_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .goee-dual-button-secondary:hover'
                    ]
                );

            $this->end_controls_tab();

	    $this->end_controls_tabs();

        $this->end_controls_section();
    }
}