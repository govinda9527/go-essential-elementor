<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Utils;
use \GOEE_Addons_Elementor\classes\Helper;


class GOEE_Pricing_Table extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'goee-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', GOEE_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'goee goee-logo eicon-price-table';
	}

	public function get_categories() {
		return [ 'goee-category' ];
	}

	public function get_keywords() {
        return [ 'price', 'package', 'product', 'plan', 'go' ];
    }

	protected function register_controls() {
		$goee_secondary_color = get_option( 'goee_secondary_color_option', '#00d8d8' );

		/**
  		 * Pricing Table Feature
  		 */
  		$this->start_controls_section(
  			'goee_section_pricing_table_feature',
  			[
  				'label' => esc_html__( 'Features', GOEE_TEXTDOMAIN )
  			]
		);
		  
		$pricing_repeater = new Repeater();

		$pricing_repeater->add_control(
			'goee_pricing_table_item',
			[
				'name'        => 'goee_pricing_table_item',
				'label'       => esc_html__( 'List Item', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Pricing table list item', GOEE_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		
		$pricing_repeater->add_control(
			'goee_pricing_table_list_icon',
			[
				'name'        => 'goee_pricing_table_list_icon',
				'label'       => esc_html__( 'List Icon', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid'
				]
			]
		);
		
		$pricing_repeater->add_control(
			'goee_pricing_table_icon_mood',
			[
				'name'         => 'goee_pricing_table_icon_mood',
				'label'        => esc_html__( 'Item Active?', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );

  		$this->add_control(
			'goee_pricing_table_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'  => $pricing_repeater->get_controls(),
				'seperator'   => 'before',
				'default'     => [
					[ 'goee_pricing_table_item' => esc_html__( 'Responsive Live', GOEE_TEXTDOMAIN ) ],
					[ 'goee_pricing_table_item' => esc_html__( 'Adaptive Bitrate', GOEE_TEXTDOMAIN ) ],
					[ 'goee_pricing_table_item' => esc_html__( 'Analytics', GOEE_TEXTDOMAIN ) ],
					[ 	
						'goee_pricing_table_item'      => esc_html__( 'Creative Layouts', GOEE_TEXTDOMAIN ),
						'goee_pricing_table_icon_mood' => 'no'
					],
					[ 
						'goee_pricing_table_item'      => esc_html__( 'Free Support', GOEE_TEXTDOMAIN ),
						'goee_pricing_table_icon_mood' => 'no'
					]
				],	
				'title_field' => '{{goee_pricing_table_item}}'
			]	
		);

		$this->end_controls_section();
		  
		/**
  		 * Pricing Table Promo label
  		 */
  		$this->start_controls_section(
			'goee_section_pricing_table_promo_section',
			[
				'label' => esc_html__( 'Promo Label', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_pricing_table_promo_enable',
			[
				'label'        => esc_html__( 'Promo Label?', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'goee_pricing_table_promo_title',
			[
				'label'       => esc_html__( 'Title', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Recommended', GOEE_TEXTDOMAIN ),
				'condition'   => [
					'goee_pricing_table_promo_enable' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_promo_position',
			[
				'label'        => __( 'Position', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'promo_top',
				'options'      => [
					'promo_top'    => __( 'Top', GOEE_TEXTDOMAIN ),
					'promo_bottom' => __( 'Bottom', GOEE_TEXTDOMAIN ),
				],
				'condition'    => [
					'goee_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

  		/**
  		 * Pricing Table Settings
  		 */
  		$this->start_controls_section(
  			'goee_section_pricing_table_settings',
  			[
  				'label' => esc_html__( 'Header', GOEE_TEXTDOMAIN )
  			]
  		);

  		$this->add_control(
			'goee_pricing_table_title',
			[
				'label'       => esc_html__( 'Title', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'STANDARD', GOEE_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'goee_pricing_table_title_tag',
            [
                'label'   => __('Title HTML Tag', GOEE_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::goee_title_tags(),
                'default' => 'h3',
            ]
		);

		$this->add_control(
			'goee_pricing_table_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_featured',
			[
				'label'        => esc_html__( 'Featured?', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'goee_pricing_table_featured_type',
			[
				'label'     => esc_html__( 'Badge Type', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text-badge',
				'options'   => [
					'text-badge' => __( 'Text Badge', GOEE_TEXTDOMAIN ),
					'icon-badge' => __( 'Icon Badge', GOEE_TEXTDOMAIN )
				],
				'condition' => [
					'goee_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_featured_tag_text',
			[
				'label'       => esc_html__( 'Featured Text', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'FEATURED', GOEE_TEXTDOMAIN ),
				'condition'   => [
					'goee_pricing_table_featured'      => 'yes',
					'goee_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

  		$this->end_controls_section();

  		$this->start_controls_section(
  			'goee_section_pricing_table_price',
  			[
  				'label' => esc_html__( 'Price', GOEE_TEXTDOMAIN )
  			]
		);

		$this->add_control(
			'goee_pricing_table_price',
			[
				'label'       => esc_html__( 'Price', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', GOEE_TEXTDOMAIN )
			]
		);
		
  		$this->add_control(
			'goee_pricing_table_price_cur',
			[
				'label'       => esc_html__( 'Price Currency', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_pricing_table_price_cur_position',
			[
				'label'       => esc_html__( 'Currency Position', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'	  => false,
				'label_block' => false,
				'default'     => 'goee-pricing-cur-left',
				'options'     => [
					'goee-pricing-cur-left' => [
						'title' => __( 'Left', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-angle-left'
					],
					'goee-pricing-cur-right' => [
						'title' => __( 'Right', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-angle-right'
					]
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_price_by',
			[
				'label'       => esc_html__( 'Price By', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'mo', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_pricing_table_period_separator',
			[
				'label'       => esc_html__( 'Separated By', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '/', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_pricing_table_discount_price',
			[
				'label' => __( 'Show Discount Price', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', GOEE_TEXTDOMAIN ),
				'label_off' => __( 'Hide', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'goee_pricing_table_regular_price',
			[
				'label'       => esc_html__( 'Ragular Price', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', GOEE_TEXTDOMAIN ),
				'condition'   => [
					'goee_pricing_table_discount_price' => 'yes'
				]
			]
		);
		
  		$this->add_control(
			'goee_pricing_table_regular_price_cur',
			[
				'label'       => esc_html__( 'Regular Price Currency', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', GOEE_TEXTDOMAIN ),
				'condition'   => [
					'goee_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_price_subtitle',
			[
				'label'       => esc_html__( 'Price Subtitle', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

  		$this->end_controls_section();

  		

  		/**
  		 * Pricing Table Footer
  		 */
  		$this->start_controls_section(
  			'goee_section_pricing_table_button',
  			[
  				'label' => esc_html__( 'Button', GOEE_TEXTDOMAIN )
  			]
		);
		  

		$this->add_control(
			'goee_pricing_table_btn_position',
			[
				'label'   => esc_html__( 'Position', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'middle' => __( 'Middle', GOEE_TEXTDOMAIN ),
					'bottom' => __( 'Bottom', GOEE_TEXTDOMAIN )
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_btn',
			[
				'label'       => esc_html__( 'Text', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Choose Plan', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_pricing_table_btn_link',
			[
				'label'       => esc_html__( 'Link', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
     			'show_external' => true
			]
		);

		$this->end_controls_section();
		  
		  /**
  		 * Pricing Table Note
  		 */
  		$this->start_controls_section(
			'goee_section_pricing_table_note',
			[
				'label' => esc_html__( 'Note', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_pricing_table_note_text',
			[
				'label' => __( 'Text', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
			]
		);

		$this->end_controls_section();

  	
		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Style)
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'goee_section_pricing_tables_styles_presets',
			[
				'label' => esc_html__( 'Container', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'goee_section_pricing_tables_min_height',
			[
				'label'       => esc_html__( 'Min Height', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 2000,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-pricing-table-badge-wrapper' => 'min-height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'goee_pricing_table_bg_color_simple',
				'label' => __( 'Background', GOEE_TEXTDOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector' => '{{WRAPPER}} .goee-pricing-table-badge-wrapper',
				'condition' => [
					'goee_pricing_table_header_type' => 'simple'
				]
			]
		);
				
		$this->add_control(
			'goee_pricing_table_bg_color',
			[
				'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
				'seperator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-badge-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .goee-pricing-table-header .goee-pricing-table-header-curved svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'goee_pricing_table_header_type' => 'curved-header'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_content_padding',
			[
				'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '45',
					'right'    => '30',
					'bottom'   => '45',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-badge-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'goee_pricing_table_content_border',
				'selector' => '{{WRAPPER}} .goee-pricing-table-badge-wrapper'
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_content_border_radius',
			[
				'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                    'unit'     => 'px'
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-badge-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .goee-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .goee-pricing-table-header .goee-pricing-table-header-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_pricing_table_content_box_shadow',
				'selector' => '{{WRAPPER}} .goee-pricing-table-badge-wrapper',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
		                    'horizontal' => 0,
		                    'vertical'   => 13,
		                    'blur'       => 33,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.08)'
		                ]
		            ]
	            ]
			]
		);

		$content_align = is_rtl() ? 'right' : 'left';

		$this->add_control(
			'goee_pricing_table_content_alignment',
			[
				'label'         => __( 'Alignment', GOEE_TEXTDOMAIN ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'separator'     => 'after',
				'default'       => $content_align,
				'options'       => [
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
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_pricing_table_transition_shadow',
				'label'    => __( 'Hover Box Shadow', GOEE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper:hover .goee-pricing-table-badge-wrapper',
				'fields_options'      => [
		            'box_shadow_type' => [
		                'default'     =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 40,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.2)'
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'goee_pricing_table_transition_type',
			[
				'label'   => __( 'Hover Style', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'              =>  __( 'None', GOEE_TEXTDOMAIN ),
					'transition_top'    =>  __( 'Transition Top', GOEE_TEXTDOMAIN ),
					'transition_bottom' => __( 'Transition Bottom', GOEE_TEXTDOMAIN ),
					'transition_zoom'   => __( 'Transition Zoom', GOEE_TEXTDOMAIN )
				],
				'default' => 'none'
			]
		);

		
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Promo label)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_promo_style',
			[
				'label'     => esc_html__( 'Promo Label', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_promo_alignment',
			[
				'label'     => __( 'Alignment', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'options'   => [
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
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-promo-label' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'goee_pricing_table_promo_background',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector'  => '{{WRAPPER}} .goee-pricing-table-promo-label',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_promo_typography',
				'label'    => __( 'Typography', GOEE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .goee-pricing-table-promo-label',
			]
		);

		$this->add_control(
			'goee_pricing_table_promo_text-color',
			[
				'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-promo-label' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_promo_padding',
			[
				'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-promo-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_promo_radius',
			[
				'label'      => __( 'Border radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-promo-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_title_header_settings',
			[
				'label' => esc_html__( 'Header', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_pricing_table_header_type',
			[
				'label'   => esc_html__( 'Header Type', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [
					'simple'        => __( 'Simple', GOEE_TEXTDOMAIN ),
					'curved-header' => __( 'Curved Header', GOEE_TEXTDOMAIN )
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'goee_pricing_table_header_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .goee-pricing-table-header',
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_header_padding',
			[
				'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_header_margin',
			[
				'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_header_border_radius',
			[
				'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'goee_pricing_table_header_border',
				'selector'  => '{{WRAPPER}} .goee-pricing-table-header',
				'condition' => [
					'goee_pricing_table_header_type' => 'simple'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_pricing_table_header_shadow',
				'selector' => '{{WRAPPER}} .goee-pricing-table-header',
				'condition' => [
					'goee_pricing_table_header_type' => 'simple'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Title)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Title', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_section_pricing_table_title_heading',
			[
				'label'     => esc_html__( 'Title', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'goee_pricing_table_title_color',
			[
				'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-title' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 15
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '400'
		            ]
	            ]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_title_margin',
			[
				'label'      => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		/**
		 * -------------------------------------------
		 * Style (Sub Title)
		 * -------------------------------------------
		 */

		$this->add_control(
			'goee_section_pricing_table_subtitletitle_heading',
			[
				'label'     => esc_html__( 'Sub Title', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'goee_pricing_table_subtitle_color',
			[
				'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-subtitle' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-subtitle'
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_subtitle_margin',
			[
				'label'   => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::DIMENSIONS,
				'default' => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Pricing)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_price_style_settings',
			[
				'label' => esc_html__( 'Pricing', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_pricing_table_price_box_separator',
			[
				'label'        => esc_html__( 'Enable Separator', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'OFF', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_price_box_separator_height',
			[
				'label'     => esc_html__( 'Separator Height', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '1',
				'selectors' => [
					'{{WRAPPER}} .goee-price-bottom-separator' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'goee_pricing_table_price_box_separator' => 'yes'
				]
				
			]
		);

		$this->add_control(
			'goee_pricing_table_price_box_separator_color',
			[
				'label'     => esc_html__( 'Separator Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .goee-price-bottom-separator'  => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'goee_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_price_box_separator_spacing',
			[
				'label'       => esc_html__( 'Separator Spacing', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 30
				],
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-price-bottom-separator' => 'margin: {{SIZE}}px 0;'
				],
				'condition'   => [
					'goee_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_price_box',
			[
				'label'        => esc_html__( 'Price Box', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'OFF', GOEE_TEXTDOMAIN ),
				'separator'	   => 'before',
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_price_box_height',
			[
				'label'     => __( 'Box Height', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'height: {{VALUE}}px'
				],
				'condition' => [
					'goee_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_price_box_width',
			[
				'label'     => __( 'Box Width', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'width: {{VALUE}}px'
				],
				'condition' => [
					'goee_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'goee_pricing_table_price_box_background',
				'types'     => [ 'classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'goee_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'goee_pricing_table_price_box_border',
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'goee_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_price_box_radius',
			[
				'label'      => __( 'Box Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'goee_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_price_tag_heading',
			[
				'label'     => esc_html__( 'Original Price', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'goee_pricing_table_pricing_color',
			[
				'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price p.goee-pricing-table-new-price'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price p.goee-pricing-table-new-price',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 48
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => -3.2
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'goee_pricing_table_regular_price_heading',
			[
				'label'     => esc_html__( 'Regular Price', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before',
				'condition' => [
					'goee_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_regular_price_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-price.goee-discount-price-yes p.goee-pricing-table-regular-price',
				'condition' => [
					'goee_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_regular_price_color',
			[
				'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-price.goee-discount-price-yes p.goee-pricing-table-regular-price' => 'color: {{VALUE}};'
				],
				'condition' => [
					'goee_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_regular_price_right_spacing',
			[
				'label'       => esc_html__( 'Regular Price Right Spacing', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 10
				],
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-pricing-table-price.goee-discount-price-yes p.goee-pricing-table-regular-price' => 'margin-right: {{SIZE}}px;'
				],
				'condition' => [
					'goee_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_pricing_curency_heading',
			[
				'label'     => esc_html__( 'Pricing Curency', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'goee_pricing_table_pricing_curency_spacing',
			[
				'label' => __( 'Spacing', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', GOEE_TEXTDOMAIN ),
				'label_on' => __( 'Custom', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->start_popover();

			$this->add_responsive_control(
				'goee_pricing_table_pricing_curency_bottom_spacing',
				[
					'label'      => esc_html__( 'Bottom Spacing', GOEE_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => -100,
							'max'  => 100,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price span.goee-pricing-table-currency' => 'top: {{SIZE}}{{UNIT}};'
					],
				]
			);

            $this->add_responsive_control(
				'goee_pricing_table_pricing_curency_right_spacing',
				[
					'label'      => esc_html__( 'Right Spacing', GOEE_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price span.goee-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};'
					],
				]
			);

        $this->end_popover();

		$this->add_control(
			'goee_pricing_table_pricing_curency_color',
			[
				'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price span.goee-pricing-table-currency' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_price_curency_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price span.goee-pricing-table-currency',
			]
		);

		$this->add_control(
			'goee_pricing_table_pricing_period_heading',
			[
				'label'     => esc_html__( 'Pricing By', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'goee_pricing_table_pricing_period_color',
			[
				'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price span.goee-price-period' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-price-period',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 20
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => 0
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'goee_pricing_table_price_subtitle_heading',
			[
				'label'     => esc_html__( 'Price Subtitle', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'goee_pricing_table_price_subtitle_color',
			[
				'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price-subtitle' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_price_subtitle_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price-subtitle',
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_price_subtitle_margin',
			[
				'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'unit'   => 'px',
					'islinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-price-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Style (Feature List)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_style_featured_list_settings',
			[
				'label' => esc_html__( 'Feature List', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_list_item_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-features li'
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_featured_list_icon_size',
			[
				'label'       => esc_html__( 'Icon Size', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-pricing-li-icon' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$icon_gap = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'goee_pricing_table_featured_list_icon_space',
			[
				'label'       => esc_html__( 'Icon Space', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 7
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-pricing-table-features li .goee-pricing-li-icon' => 'margin-'.$icon_gap.': {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_list_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $goee_secondary_color,
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-features li span.goee-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_list_item_color',
			[
				'label'     => esc_html__( 'Item Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-features li' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_list_padding',
			[
				'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_list_border_bottom',
			[
				'label'        => __( 'List Border Bottom', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Hide', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'goee_pricing_table_list_border_bottom_style',
			[
				'label'     => __( 'List Border Bottom Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'defailt'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .list-border-bottom li:not(:last-child)' => 'border-bottom:1px solid {{VALUE}};'
				],
				'condition' => [
					'goee_pricing_table_list_border_bottom' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_list_disable_item_styling',
			[
				'label'     => esc_html__( 'Disable Items', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'goee_pricing_table_list_disable_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-features li.goee-pricing-table-features-disable span.goee-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_list_disable_item_color',
			[
				'label'     => esc_html__( 'Item color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-features li.goee-pricing-table-features-disable' => 'color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Featured Tag Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_featured_tag_settings',
			[
				'label'     => esc_html__( 'Featured Badge', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_featured_tag_font_size',
			[
				'label'       => esc_html__( 'Font Size', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 40
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .text-badge'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .icon-badge i' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'goee_pricing_table_featured_tag_text_color',
			[
				'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .text-badge'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-badge i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'goee_pricing_table_featured_text_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .text-badge',
				'condition' => [
					'goee_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'goee_pricing_table_featured_icon_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .icon-badge',
				'condition' => [
					'goee_pricing_table_featured_type' => 'icon-badge'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_btn_style_settings',
			[
				'label' => esc_html__( 'Button', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action'
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_button_border_radius',
			[
				'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '4',
					'right'  => '4',
					'bottom' => '4',
					'left'   => '4'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_button_padding',
			[
				'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '12',
					'right'    => '30',
					'bottom'   => '12',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_pricing_table_button_margin',
			[
				'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'goee_pricing_table_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'goee_pricing_table_btn_normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

			$this->add_control(
				'goee_pricing_table_btn_normal_text_color',
				[
					'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'goee_pricing_table_btn_normal_bg_color',
				[
					'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $goee_secondary_color,
					'selectors' => [
						'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'goee_pricing_table_btn_normal_border',
					'fields_options'  => [
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
	                        'default' => $goee_secondary_color
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'goee_pricing_table_btn_box_shadow',
					'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action'
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'goee_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

			$this->add_control(
				'goee_pricing_table_btn_hover_text_color',
				[
					'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $goee_secondary_color,
					'selectors' => [
						'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action:hover' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'goee_pricing_table_btn_hover_bg_color',
				[
					'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action:hover' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'goee_pricing_table_btn_hover_border',
					'fields_options'  => [
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
	                        'default' => $goee_secondary_color
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action:hover'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'goee_pricing_table_btn_box_shadow_hover',
					'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-action:hover'
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Note Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_section_pricing_table_note_style',
			[
				'label' => esc_html__( 'Note', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_pricing_table_note_alignment',
			[
				'label'         => __( 'Alignment', GOEE_TEXTDOMAIN ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'default'		=> 'center',
				'options'       => [
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
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_section_pricing_table_note_padding',
			[
				'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_section_pricing_table_note_margin',
			[
				'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'goee_section_pricing_table_note_background',
				'label' => __( 'Background', GOEE_TEXTDOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note',
			]
		);

		$this->add_control(
			'goee_section_pricing_table_note_text_color',
			[
				'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_section_pricing_table_note_text_typography',
				'label'    => __( 'Typography', GOEE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'goee_section_pricing_table_note_border',
				'selector' => '{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note'
			]
		);

		$this->add_responsive_control(
			'goee_section_pricing_table_note_border_radius',
			[
				'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-pricing-table-wrapper .goee-pricing-table-note' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

	}

	private function pricing_table_currency( $currency ) {
		return $currency ? '<span '.$this->get_render_attribute_string( 'goee_pricing_table_price_cur' ).'>'.esc_html( $currency ).'</span>' : '';
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$title         = $settings['goee_pricing_table_title'];
		$sub_title     = $settings['goee_pricing_table_subtitle'];
		$price         = $settings['goee_pricing_table_price'];
		$separator     = $settings['goee_pricing_table_period_separator'];
		$price_by      = $settings['goee_pricing_table_price_by'];
		$featured_text = $settings['goee_pricing_table_featured_tag_text'];

		$this->add_render_attribute( 
			'goee_pricing_table_wrapper', 
			[ 
				'class' => [ 
					'goee-pricing-table-wrapper', 
					'goee-pricing-table', 
					esc_attr( $settings['goee_pricing_table_content_alignment'] ), 
					esc_attr( $settings['goee_pricing_table_transition_type'] )
				]
			]
		);
	
		$this->add_render_attribute( 'goee_pricing_table_featured_tag_text', 'class', 'goee-pricing-featured-tag-text' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_featured_tag_text', 'basic' );

		$this->add_render_attribute( 'goee_pricing_table_promo_title', 'class', 'goee-pricing-table-promo-label' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_promo_title', 'basic' );

		$this->add_render_attribute( 'goee_pricing_table_title', 'class', 'goee-pricing-table-title' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_title', 'basic' );

		$this->add_render_attribute( 'goee_pricing_table_subtitle', 'class', 'goee-pricing-table-subtitle' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_subtitle', 'basic' );

		$this->add_render_attribute( 'goee_pricing_table_box_value', 'class', [ 'goee-pricing-table-price', 'goee-discount-price-'.$settings['goee_pricing_table_discount_price'] ] );

		if( 'yes' === $settings['goee_pricing_table_price_box'] ){
			$this->add_render_attribute( 'goee_pricing_table_box_value', 'class', 'price-box' );
		}

		$this->add_render_attribute( 'goee_pricing_table_price_cur', 'class', 'goee-pricing-table-currency' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_price_cur', 'basic' );

		$this->add_render_attribute( 'goee_pricing_table_period_separator', 'class', 'goee-pricing-table-currency-separator' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_period_separator', 'none' );

		$this->add_render_attribute( 'goee_pricing_table_price_by', 'class', 'goee-pricing-table-price-by' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_price_by', 'basic' );

		$this->add_render_attribute( 'goee_pricing_table_price', 'class', 'goee-pricing-table-price' );
		$this->add_inline_editing_attributes( 'goee_pricing_table_price', 'basic' );

		$this->add_render_attribute( 'goee_pricing_table_features', 'class', 'goee-pricing-table-features' );
		if( 'yes' === $settings['goee_pricing_table_list_border_bottom'] ){
			$this->add_render_attribute( 'goee_pricing_table_features', 'class', 'list-border-bottom' );
		}

        $this->add_render_attribute( 'goee_pricing_table_btn_link', 'class', 'goee-pricing-table-action' );
		if( $settings['goee_pricing_table_btn_link']['url'] ) {
            $this->add_render_attribute( 'goee_pricing_table_btn_link', 'href', esc_url( $settings['goee_pricing_table_btn_link']['url'] ) );
	        if( $settings['goee_pricing_table_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'goee_pricing_table_btn_link', 'target', '_blank' );
	        }
	        if( $settings['goee_pricing_table_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'goee_pricing_table_btn_link', 'rel', 'nofollow' );
	        }
        }

        $this->add_inline_editing_attributes( 'goee_pricing_table_btn', 'none' );

		?>

		<div <?php echo $this->get_render_attribute_string( 'goee_pricing_table_wrapper' ); ?>>
			<?php if( 'promo_top' === $settings['goee_pricing_table_promo_position'] ) { 
				if( 'yes' === $settings['goee_pricing_table_promo_enable'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'goee_pricing_table_promo_title' ); ?>><?php echo wp_kses_post( $settings['goee_pricing_table_promo_title'] ); ?></span>
				<?php } ?>
			<?php } ?>
			<div class="goee-pricing-table-badge-wrapper">

				<?php if ( 'yes' === $settings['goee_pricing_table_featured'] ) { ?>
					<span class="goee-pricing-table-badge <?php echo esc_attr( $settings['goee_pricing_table_featured_type'] ); ?>">
						<?php if( 'text-badge' === $settings['goee_pricing_table_featured_type'] && !empty( $featured_text ) ) { ?>
							<span <?php echo $this->get_render_attribute_string( 'goee_pricing_table_featured_tag_text' ); ?>>
								<?php echo esc_html( $featured_text ); ?>
							</span>
						<?php } ?>
						<?php if( 'icon-badge' === $settings['goee_pricing_table_featured_type'] ) { ?>
							<i class="demo-icon eicon-star"></i>
						<?php } ?>
					</span>
				<?php } ?>

				<div class="goee-pricing-table-header">
					<?php do_action( 'goee_pricing_table_header_wrapper_before' ); ?>

					<?php $title ? printf( '<'.Utils::validate_html_tag( $settings['goee_pricing_table_title_tag'] ).' ' .$this->get_render_attribute_string( 'goee_pricing_table_title' ).'>%s</'.Utils::validate_html_tag( $settings['goee_pricing_table_title_tag'] ).'>', wp_kses_post( $title ) ) : '';
					$sub_title ? printf( '<div '.$this->get_render_attribute_string( 'goee_pricing_table_subtitle' ).'>%s</div>', wp_kses_post( $sub_title ) ) : ''; ?>

					<div <?php echo $this->get_render_attribute_string( 'goee_pricing_table_box_value' ); ?>>
						<?php if( 'yes' === $settings['goee_pricing_table_discount_price'] ) { ?>
							<p class="goee-pricing-table-regular-price">				
								<span class="goee-pricing-table-regular-price-cur"><?php echo $settings['goee_pricing_table_regular_price_cur']; ?></span>
								<span class="goee-pricing-table-regular-price-text"><?php echo $settings['goee_pricing_table_regular_price']; ?></span>
							</p>
						<?php } ?>
						<p class="goee-pricing-table-new-price">							
							<?php if( 'goee-pricing-cur-left' === $settings['goee_pricing_table_price_cur_position'] ) : ?>
								<?php echo $this->pricing_table_currency( $settings['goee_pricing_table_price_cur'] ); ?>
							<?php endif; ?>

							<?php $price ? printf( '<span '.$this->get_render_attribute_string( 'goee_pricing_table_price' ).'>%s</span>', esc_html( $price ) ) : ''; ?>

							<?php if( 'goee-pricing-cur-right' === $settings['goee_pricing_table_price_cur_position'] ) : ?>
								<?php echo $this->pricing_table_currency( $settings['goee_pricing_table_price_cur'] ); ?>
							<?php endif; ?>

							<?php if( $separator || $price_by ) : ?>
								<span class="goee-price-period">
									<?php $separator ? printf( '<span '.$this->get_render_attribute_string( 'goee_pricing_table_period_separator' ).'>%s</span>', esc_html( $separator ) ) : ''; ?>
									<?php $price_by ? printf( '<span '.$this->get_render_attribute_string( 'goee_pricing_table_price_by' ).'>%s</span>', esc_html( $price_by ) ) : ''; ?>
								</span>
							<?php endif; ?>
						</p>
					</div>

					<?php if( !empty( $settings['goee_pricing_table_price_subtitle'] ) ){ ?>
						<span class="goee-pricing-table-price-subtitle"><?php echo $settings['goee_pricing_table_price_subtitle']; ?></span>
					<?php } ?>

					<?php if ( 'yes' === $settings['goee_pricing_table_price_box_separator'] ) : ?>
						<div class="goee-price-bottom-separator"></div>
					<?php endif; ?>

					<?php if( 'curved-header' === $settings['goee_pricing_table_header_type'] ) { ?>
						<div class="goee-pricing-table-header-curved">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
								<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
							</svg>
						</div>
					<?php } ?>

					<?php do_action( 'goee_pricing_table_header_wrapper_after' ); ?>
				</div>
				
				 <?php if( 'middle' === $settings['goee_pricing_table_btn_position'] && !empty( $settings['goee_pricing_table_btn'] ) ) {
					$this->pricing_table_btn();
				}

				do_action( 'goee_pricing_table_content_wrapper_before' ); ?>

				<?php if ( is_array( $settings['goee_pricing_table_items'] ) ) : ?>
					<ul <?php echo $this->get_render_attribute_string( 'goee_pricing_table_features' ); ?>>
						<?php foreach( $settings['goee_pricing_table_items'] as $index => $item ) : ?> 

							<?php $each_pricing_item = 'link_' . $index;
							$icon_mod = 'yes' !== $item['goee_pricing_table_icon_mood'] ? 'goee-pricing-table-features-disable' : 'goee-pricing-table-features-enable';
							$this->add_render_attribute( $each_pricing_item, 'class', [
								esc_attr( $icon_mod ),
								'elementor-repeater-item-'.esc_attr( $item['_id'] )
							] );

							$pricing_item = $this->get_repeater_setting_key( 'goee_pricing_table_item', 'goee_pricing_table_items', $index );
							$this->add_render_attribute( $pricing_item, 'class', 'goee-pricing-item' );
							$this->add_inline_editing_attributes( $pricing_item, 'basic' );
							$price = $item['goee_pricing_table_item']; ?>

							<li <?php echo $this->get_render_attribute_string( $each_pricing_item ); ?>>
								<?php if ( !empty( $item['goee_pricing_table_list_icon']['value'] ) ) { ?>
									<span class="goee-pricing-li-icon">
										<?php Icons_Manager::render_icon( $item['goee_pricing_table_list_icon'] ); ?>
									</span>
								<?php } ?>
								<?php $price ? printf( '<span '.$this->get_render_attribute_string( $pricing_item ).'>%s</span>', wp_kses_post( $price ) ) : ''; ?>
							</li>

						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php do_action( 'goee_pricing_table_content_wrapper_after' ); ?>

				<?php if( 'bottom' === $settings['goee_pricing_table_btn_position'] && !empty( $settings['goee_pricing_table_btn'] ) ) { ?>
					<?php $this->pricing_table_btn(); ?>
				<?php } ?> 
				<?php if( !empty( $settings['goee_pricing_table_note_text'] ) ){ ?>
					<div class="goee-pricing-table-note"><?php echo $settings['goee_pricing_table_note_text']; ?></div>
				<?php } ?>
			</div>
			<?php if( 'promo_bottom' === $settings['goee_pricing_table_promo_position'] ) {
				if( 'yes' === $settings['goee_pricing_table_promo_enable'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'goee_pricing_table_promo_title' ); ?>><?php echo $settings['goee_pricing_table_promo_title']; ?></span>
				<?php } ?>
			<?php } ?>
		</div>
		<?php
	}

    private function pricing_table_btn() {
		?>
		<a <?php echo $this->get_render_attribute_string( 'goee_pricing_table_btn_link' ); ?>>
			<span <?php echo $this->get_render_attribute_string( 'goee_pricing_table_btn' ); ?>>
				<?php echo esc_html( $this->get_settings_for_display( 'goee_pricing_table_btn' ) ); ?>
			</span>
		</a>
		<?php
	}
}