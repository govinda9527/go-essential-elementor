<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;

class GOEE_News_Ticker extends Widget_Base {

    public function get_name() {
        return 'goee-news-ticker';
    }

    public function get_title() {
        return esc_html__( 'News Ticker', GOEE_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return [ 'goee-category' ];
    }

    public function get_keywords() {
        return [ 'exclusive', 'bar', 'horizontal' ];
    }
    
    public function get_script_depends() {
        return [ 'goee-news-ticker' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'goee_news_ticker_all_items',
            [
                'label' => esc_html__( 'Items', GOEE_TEXTDOMAIN )
            ]
        );

        $this->add_control(
            'goee_news_ticker_label',
            [   
                'label'         => esc_html__( 'Label', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('Today\'s Hot News', GOEE_TEXTDOMAIN ),
                'label_block'     => true,
                'dynamic' => [
					'active' => true,
				]
            ]
        ); 

        $news_ticker_repeater = new Repeater();
        
        $news_ticker_repeater->add_control(
            'goee_news_ticker_title',
            [
                'label'   => esc_html__( 'Content', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'News item description', GOEE_TEXTDOMAIN ),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $news_ticker_repeater->add_control(
            'goee_news_ticker_link',
            [
                'label'           => esc_html__( 'Link', GOEE_TEXTDOMAIN ),
                'type'            => Controls_Manager::URL,
                'label_block'     => true,
                'default'         => [
                    'url'         => '#',
                    'is_external' => ''
                ],
                'show_external'   => true
            ]
        );

        $this->add_control(
            'goee_news_ticker_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $news_ticker_repeater->get_controls(),
                'title_field' => '{{{ goee_news_ticker_title }}}',
                'default'     => [
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 1', GOEE_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 2', GOEE_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 3', GOEE_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 4', GOEE_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 5', GOEE_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 6', GOEE_TEXTDOMAIN ) ]
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_settings',
            [
                'label' => esc_html__( 'Settings', GOEE_TEXTDOMAIN )
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_animation_direction',
            [
                'label'     => esc_html__( 'Direction', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ltr',
                'options'   => [
                    'ltr'   => esc_html__( 'Left to Right', GOEE_TEXTDOMAIN ),
                    'rtl'   => esc_html__( 'Right to Left', GOEE_TEXTDOMAIN )
                ],
                'description'   => esc_html__('If you enable Right-to-left(RTL) in your website than by default it will be working in RTL and this option won\'t work.', GOEE_TEXTDOMAIN)

            ]
        ); 

        $this->add_control(
            'goee_news_ticker_set_fixed_position',
            [
                'type'         => Controls_Manager::SELECT,
                'label'        => esc_html__( 'Set Position', GOEE_TEXTDOMAIN ),
				'default' => 'none',
				'options' => [
					'none'  => __( 'None', GOEE_TEXTDOMAIN ),
					'fixed-top'  => __( 'Fixed Top', GOEE_TEXTDOMAIN ),
					'fixed-bottom'  => __( 'Fixed Bottom', GOEE_TEXTDOMAIN ),
				],
                'description'  => esc_html__('Stick the news ticker to the top or bottom of the page.', GOEE_TEXTDOMAIN)
            ]
        );

        $this->add_control(
            'goee_news_ticker_animation_type',
            [
                'label'     => esc_html__( 'Animation Type', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'scroll',
                'options'   => [
                    'scroll'      => esc_html__( 'Scroll', GOEE_TEXTDOMAIN ),
                    'slide'       => esc_html__( 'Slide', GOEE_TEXTDOMAIN ),
                    'fade'        => esc_html__( 'Fade', GOEE_TEXTDOMAIN ),
                    'slide-up'    => esc_html__( 'Slide Up', GOEE_TEXTDOMAIN ),
                    'slide-down'  => esc_html__( 'Slide Down', GOEE_TEXTDOMAIN ),
                    'slide-left'  => esc_html__( 'Slide Left', GOEE_TEXTDOMAIN ),
                    'slide-right' => esc_html__( 'Slide Right', GOEE_TEXTDOMAIN ),
                    'typography'  => esc_html__( 'Typography', GOEE_TEXTDOMAIN )
                ]               
            ]
        );  

        $this->add_control(
            'goee_news_ticker_autoplay_interval',
            [   
                'label'         => esc_html__( 'Autoplay Interval', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '4000',
                'condition'     => [
                    '.goee_news_ticker_animation_type!' => 'scroll'
                ]              
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_animation_speed',
            [   
                'label'         => esc_html__( 'Animation Speed', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '2',
                'condition'     => [
                    '.goee_news_ticker_animation_type' => 'scroll'
                ]                
            ]
        ); 

        $this->add_responsive_control(
            'goee_news_ticker_height',
            [   
                'label'         => esc_html__( 'Height', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 70
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 20,
                        'max'   => 100
                    ]
                ]
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_autoplay',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Autoplay', GOEE_TEXTDOMAIN ),
                'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );        

        $this->add_control(
            'goee_news_ticker_pause_on_hover',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Pause On Hover', GOEE_TEXTDOMAIN ),
                'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    '.goee_news_ticker_autoplay' => 'yes'
                ]                
            ]
        );

        $this->add_control(
            'goee_news_ticker_show_label',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label', GOEE_TEXTDOMAIN ),
                'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'goee_news_ticker_show_label_arrow',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label Arrow', GOEE_TEXTDOMAIN ),
                'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'goee_news_ticker_show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_show_label_icon',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label Icon', GOEE_TEXTDOMAIN ),
                'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'goee_news_ticker_show_label' => 'yes'
                ]
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_show_controls',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Controls', GOEE_TEXTDOMAIN ),
                'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'goee_news_ticker_show_pause_control',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Play/Pause Control', GOEE_TEXTDOMAIN ),
                'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'goee_news_ticker_show_controls' => 'yes'
                ]
            ]
        );         

        $this->add_control(
            'goee_news_ticker_label_icon',
            [
                'label'       => __( 'Label Icon', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-home',
                    'library' => 'fa-solid'
                ],
                'condition'   => [
                    'goee_news_ticker_show_label'      => 'yes',
                    'goee_news_ticker_show_label_icon' => 'yes'
                ]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_container_style',
            [
                'label'         => esc_html__( 'Container', GOEE_TEXTDOMAIN ),
                'tab'           => Controls_Manager::TAB_STYLE                    
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'goee_news_ticker_container_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .goee-news-ticker'            
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'goee_news_ticker_container_border',
                'selector'       => '{{WRAPPER}} .goee-news-ticker',
                'fields_options' => [
                    'border'      => [
                        'default' => 'solid'
                    ],
                    'width'       => [
                        'default' => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color'       => [
                        'default' => '#DADCEA'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_container_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .goee-news-ticker'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'goee_news_ticker_container_box_shadow',
                'selector' => '{{WRAPPER}} .goee-news-ticker'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_label_style',
            [
                'label'     => esc_html__( 'Label', GOEE_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '.goee_news_ticker_show_label' => 'yes'
                ]             
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_news_ticker_label_typography',
                'selector' => '{{WRAPPER}} .goee-news-ticker .goee-bn-label'
            ]
        );

        $this->add_control(
            'goee_news_ticker_label_color',
            [
                'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .goee-news-ticker .goee-bn-label' => 'color: {{VALUE}};'
                ]              
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'goee_news_ticker_label_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .goee-news-ticker .goee-bn-label, {{WRAPPER}} .goee-news-ticker .goee-bn-label.yes-small:after'            
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_padding',
            [
                'label'         => esc_html__( 'Padding(Left & Right)', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'default'       => [
                    'size'      => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .goee-news-ticker .goee-bn-label' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'goee_news_ticker_label_border',
                'selector'       => '{{WRAPPER}} .goee-news-ticker .goee-bn-label',
                'fields_options' => [
                    'border'      => [
                        'default' => 'solid'
                    ],
                    'width'       => [
                        'default' => [
                            'top'    => '0',
                            'right'  => '1',
                            'bottom' => '0',
                            'left'   => '0'
                        ]
                    ],
                    'color'       => [
                        'default' => '#DADCEA'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .goee-news-ticker .goee-bn-label'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_label_icon_style',
            [
                'label'     => esc_html__( 'Label Icon', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_icon_size',
            [
                'label'        => esc_html__( 'Size', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .goee-news-ticker-icon i' => 'font-size: {{SIZE}}px;'
                ],
                'condition' => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_label_icon_color',
            [
                'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .goee-news-ticker-icon i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]            
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_icon_padding',
            [
                'label'        => __('Padding', GOEE_TEXTDOMAIN),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
                    'top'      => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'right'    => '10',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .goee-news-ticker-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'    => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_items_style',
            [
                'label' => esc_html__( 'Items', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE                    
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_news_ticker_typography',
                'selector' => '{{WRAPPER}} .goee-news-ticker ul li, {{WRAPPER}} .goee-news-ticker ul li a'
            ]
        );

        $this->add_control(
            'goee_news_ticker_color',
            [
                'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .goee-news-ticker li, {{WRAPPER}} .goee-news-ticker li a' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'goee_news_ticker_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3878ff',
                'selectors' => [
                    '{{WRAPPER}} .goee-news-ticker li:hover, {{WRAPPER}} .goee-news-ticker li:hover a' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'goee_news_ticker_bg_color',
            [
                'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .goee-news-ticker' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_each_item_padding',
            [
                'label'      => esc_html__( 'Padding Each Item(Left & Right)', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default'    => [
                    'size'   => 15
                ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-news-ticker .goee-nt-news ul li' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'goee_news_ticker_items_border',
                'selector' => '{{WRAPPER}} .goee-news-ticker .goee-nt-news'
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_items_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .goee-news-ticker .goee-nt-news'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_control_style',
            [
                'label'     => esc_html__( 'Controls', GOEE_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '.goee_news_ticker_show_controls' => 'yes'
                ]             
            ]
        );

        $this->add_responsive_control(
			'goee_news_ticker_control_spacing',
			[
				'label' => __( 'Spacing (Left & Right)', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .goee-news-ticker .goee-nt-controls' => 'padding: 0 {{SIZE}}{{UNIT}} 0;',
				],
			]
		);

        $this->add_control(
            'goee_news_ticker_control_box_style',
            [
                'label' => esc_html__( 'Control Box', GOEE_TEXTDOMAIN ),
                'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'goee_news_ticker_control_bg_color',
            [
                'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .goee-news-ticker .goee-nt-controls' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'goee_news_ticker_controls_box_border',
                'selector' => '{{WRAPPER}} .goee-news-ticker .goee-nt-controls'
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_controls_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .goee-news-ticker .goee-nt-controls' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_control_box_item_style',
            [
                'label'     => esc_html__( 'Control Items', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_controls_size',
            [
                'label'      => esc_html__( 'Size', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default'    => [
                    'size'   => 30
                ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'goee_news_ticker_control_item_spacing',
			[
				'label' => __( 'Control Item Spacing', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .goee-news-ticker .goee-nt-controls button:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'goee_news_ticker_controls_tabs' );

            # Normal State Tab
            $this->start_controls_tab( 'goee_news_ticker_controls_normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );
                $this->add_control(
                    'goee_news_ticker_controls_color',
                    [
                        'label'     => esc_html__( 'Icon Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#999999',
                        'selectors' => [
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button .bn-arrow::before, {{WRAPPER}} .goee-news-ticker .goee-nt-controls button .bn-arrow::after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button .bn-pause::before, {{WRAPPER}} .goee-news-ticker .goee-nt-controls button .bn-pause::after' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_news_ticker_controls_bg_color',
                    [
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => 'rgba(0,0,0,0)',
                        'selectors' => [
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_news_ticker_control_items_border',
                        'selector' => '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button'
                    ]
                );

                $this->add_responsive_control(
                    'goee_news_ticker_control_items_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px'],
                        'selectors'  => [
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );


            $this->end_controls_tab();

            #Hover State Tab
            $this->start_controls_tab( 'goee_news_ticker_controls_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );
                $this->add_control(
                    'goee_news_ticker_controls_hover_color',
                    [
                        'label'     => esc_html__( 'Icon Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#999999',
                        'selectors' => [
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button:hover .bn-arrow::before, {{WRAPPER}} .goee-news-ticker .goee-nt-controls button:hover .bn-arrow::after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button:hover .bn-pause::before, {{WRAPPER}} .goee-news-ticker .goee-nt-controls button:hover .bn-pause::after' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_news_ticker_controls_bg_hover_color',
                    [
                        'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => 'rgba(0,0,0,0)',
                        'selectors' => [
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_news_ticker_control_items_hover_border',
                        'selector' => '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button:hover'
                    ]
                );

                $this->add_responsive_control(
                    'goee_news_ticker_control_items_hover_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px'],
                        'selectors'  => [
                            '{{WRAPPER}} .goee-news-ticker .goee-nt-controls button:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $label          = $settings['goee_news_ticker_label'];
        $show_label     = $settings['goee_news_ticker_show_label'];
        $direction      = $settings['goee_news_ticker_animation_direction'];
        $ticker_height  = $settings['goee_news_ticker_height']['size'];
        $autoplay       = $settings['goee_news_ticker_autoplay'];
        $fixed_position   = $settings['goee_news_ticker_set_fixed_position'];
        $animation_type = $settings['goee_news_ticker_animation_type'];

        $arrow             = 'yes'    === $settings['goee_news_ticker_show_label_arrow'] ? ' yes-small' : ' no';
        $pause_on_hover    = 'yes'    === $autoplay ? $settings['goee_news_ticker_pause_on_hover'] : '';
        $animation_speed   = 'scroll' === $animation_type ? $settings['goee_news_ticker_animation_speed'] : '';
        $autoplay_interval = 'scroll' !== $animation_type ? $settings['goee_news_ticker_autoplay_interval'] : '';

        $this->add_render_attribute( 'goee-news-ticker-wrapper', 'class', 'goee-news-ticker' );

        $this->add_render_attribute( 
            'goee-news-ticker-wrapper', 
            [ 
                'data-autoplay'          => esc_attr( 'yes' === $autoplay ? 'true' : 'false' ),
                'data-fixed_position'      => esc_attr( $fixed_position ),
                'data-pause_on_hover'    => esc_attr( 'yes' === $pause_on_hover ? 'true' : 'false' ),
                'data-direction'         => 'rtl' === $direction || is_rtl() ? 'rtl' : 'ltr',
                'data-autoplay_interval' => esc_attr( $autoplay_interval ),
                'data-animation_speed'   => esc_attr( $animation_speed ),
                'data-ticker_height'     => esc_attr( $ticker_height ),
                'data-animation'         => esc_attr( $animation_type )
            ]
        );

        $this->add_inline_editing_attributes( 'goee_news_ticker_label', 'basic' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'goee-news-ticker-wrapper' );?>>
            <?php do_action( 'goee_news_ticker_wrapper_before' );
            if( 'yes' === $show_label ): ?>
                <div class="goee-bn-label <?php  echo esc_attr( $arrow ) ?>" >
                    <div class="goee-nt-label">
                    <?php if( 'yes' === $settings['goee_news_ticker_show_label_icon'] && !empty( $settings['goee_news_ticker_label_icon'] ) ){ ?>
                        <span class="goee-news-ticker-icon">
                            <?php Icons_Manager::render_icon( $settings['goee_news_ticker_label_icon'], [ 'aria-hidden' => 'true' ] );?>
                        </span>                               
                    <?php 
                    }
                    if( !empty( $label ) ) { ?>
                        <span <?php echo $this->get_render_attribute_string( 'goee_news_ticker_label' );?> ><?php echo wp_kses_post( $label ) ;?></span>
                    <?php } ?>
                    </div>
                </div>
            <?php endif;?>

            <div class="goee-nt-news">
                <?php if( is_array( $settings['goee_news_ticker_items'] ) ) : ?>
                    <ul>
                    <?php foreach ( $settings['goee_news_ticker_items'] as $key => $list ) :
                        $link_key  = 'link_' . $key;

                        $title = $this->get_repeater_setting_key( 'goee_news_ticker_title', 'goee_news_ticker_items', $key );
                        $this->add_inline_editing_attributes( $title, 'basic' );

                        if( $list['goee_news_ticker_link']['url'] ) :
                            $this->add_render_attribute( $link_key, 'href', esc_url( $list['goee_news_ticker_link']['url'] ) );
                            if( $list['goee_news_ticker_link']['is_external'] ) {
                                $this->add_render_attribute( $link_key, 'target', '_blank' );
                            }
                            if( $list['goee_news_ticker_link']['nofollow'] ) {
                                $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            } ?>
                            <li>
                                <a <?php echo $this->get_render_attribute_string( $link_key );?> >
                                    <span <?php echo $this->get_render_attribute_string( $title );?> ><?php echo wp_kses_post( $list['goee_news_ticker_title'] );?></span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li>
                                <span <?php echo $this->get_render_attribute_string( $title );?>><?php echo wp_kses_post( $list['goee_news_ticker_title'] );?></span>
                            </li>
                        <?php endif;
                    endforeach ;?>
                    </ul>
                <?php endif;?>
            </div>

            <?php if ( 'yes' === $settings['goee_news_ticker_show_controls'] ) :?>
                <div class="goee-nt-controls">
                    <button><span class="bn-arrow bn-prev"></span></button>
                    <?php if( 'yes' === $settings['goee_news_ticker_show_pause_control'] ) :?>
                        <button><span class="bn-action"></span></button>
                    <?php endif;?>
                    <button><span class="bn-arrow bn-next"></span></button>
                </div>
            <?php endif;
            do_action( 'goee_news_ticker_wrapper_after' ); ?>
        </div>
    <?php 
    }

}
