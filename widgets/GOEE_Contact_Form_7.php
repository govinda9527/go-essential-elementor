<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use GOEE_Addons_Elementor\classes\Helper;

/**
 * Contact Form 7 Element
 */
class GOEE_Contact_Form_7 extends Widget_Base {
    
    /**
	 * Retrieve contact form 7 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'goee-contact-form-7';
    }

    /**
	 * Retrieve contact form 7 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Contact Form 7', GOEE_TEXTDOMAIN );
    }

    /**
	 * Retrieve the list of categories the contact form 7 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'goee-category' ];
    }

    public function get_keywords() {
        return [ 'cf7', 'form', 'contact form' ];
    }

    /**
	 * Retrieve contact form 7 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'goee goee-logo eicon-envelope';
    }

    /**
	 * Register contact form 7 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function register_controls() {
        $goee_primary_color = get_option( 'goee_primary_color_option', '#7a56ff' );

        if( ! class_exists( 'WPCF7_ContactForm' ) ) {
            $this->start_controls_section(
                'goee_contact_from_panel_notice',
                [
                    'label' => __('Notice!', GOEE_TEXTDOMAIN),
                ]
            );

            $this->add_control(
                'goee_contact_from_panel_notice_text',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __('<strong>contact Form 7</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=contact+form+7&tab=search&type=term" target="_blank">Contact Form 7</a> first.',
                        GOEE_TEXTDOMAIN),
                    'content_classes' => 'goee-panel-notice',
                ]
            );

            $this->end_controls_section();
            return;
        }
        
        /**
         * Content Tab: Contact Form
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'goee_section_contact_intro',
            [
                'label'  => __( 'Contact Form', GOEE_TEXTDOMAIN ),
            ]
        );
		
		$this->add_control(
			'goee_contact_form_list',
			[
                'label'       => esc_html__( 'Select Form', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => Helper::goee_retrive_contact_form(),
                'default'     => '0'
			]
		);
        
		$this->add_control(
			'goee_contact_form_title_text',
			[
                'label'       => esc_html__( 'Title', GOEE_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
					'active' => true,
				]
			]
		);

        $this->add_control(
            'goee_contact_form_title_tag',
            [
                'label'   => __('Title HTML Tag', GOEE_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::goee_title_tags(),
                'default' => 'h3',
            ]
		);
        
        $this->end_controls_section();

        /**
         * Content Tab: Errors
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'goee_section_errors',
            [
                'label'   => __( 'Errors', GOEE_TEXTDOMAIN )
            ]
        );
        
        $this->add_control(
            'goee_error_messages',
            [
                'label'   => __( 'Error Messages', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => __( 'Show', GOEE_TEXTDOMAIN ),
                    'hide' => __( 'Hide', GOEE_TEXTDOMAIN )
                ],
                'selectors_dictionary'  => [
                    'show' => 'block',
                    'hide' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_control(
            'goee_validation_errors',
            [
                'label'   => __( 'Validation Errors', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => __( 'Show', GOEE_TEXTDOMAIN ),
                    'hide' => __( 'Hide', GOEE_TEXTDOMAIN )
                ],
                'selectors_dictionary'  => [
                    'show' => 'block',
                    'hide' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}} !important;'
                ]
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Form Container
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'goee_section_container_style',
            [
                'label' => __( 'Form Container', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'goee_contact_form_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .goee-contact-form'
            ]
        );

  		$this->add_responsive_control(
  			'goee_contact_form_width',
  			[
                'label'      => esc_html__( 'Form Width', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px'      => [
						'min' => 10,
						'max' => 1500
					],
					'em'      => [
						'min' => 1,
						'max' => 80
					]
				],
				'default'    => [
				        'unit' => '%',
                        'size' => '100'
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-contact-form' => 'width: {{SIZE}}{{UNIT}};'
				]
  			]
  		);
		
		$this->add_responsive_control(
			'goee_contact_form_padding',
			[
                'label'      => esc_html__( 'Form Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
					'{{WRAPPER}} .goee-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
                'default'    => [
                    'top'    => 40,
                    'right'  => 40,
                    'bottom' => 40,
                    'left'   => 40,
                    'unit'   => 'px'
                ]
			]
        );

        $this->add_responsive_control(
			'goee_cf7_container_margin',
			[
                'label'      => esc_html__( 'Form Margin', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'separator'  => 'after',
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
					'{{WRAPPER}} .goee-contact-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ]
			]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'     => 'goee_cf7_container_border',
                'selector' => '{{WRAPPER}} .goee-contact-form'
			]
		);

		$this->add_responsive_control(
			'goee_cf7_container_border_radius',
			[
                'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '0',
                    'right'  => '0',
                    'bottom' => '0',
                    'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'goee_cf7_container_shadow',
                'selector' => '{{WRAPPER}} .goee-contact-form'
			]
		);

        $this->end_controls_section();

        /**
         * Style Tab: Title & Description
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'goee_contact_section_title',
            [
                'label' => __( 'Title', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .goee-contact-form-7-title' => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'goee_contact_heading_alignment',
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
                'selectors'     => [
                    '{{WRAPPER}} .goee-contact-form-7 .goee-contact-form-7-title' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_contact_title_typography',
                'selector' => '{{WRAPPER}} .goee-contact-form-7 .goee-contact-form-7-title'
            ]
        ); 

        $this->add_responsive_control(
			'goee_contact_title_margin',
			[
                'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-contact-form-7 .goee-contact-form-7-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
        
        $this->end_controls_section();
        
        /**
         * Style Tab: Input & Textarea
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_fields_style',
            [
                'label' => __( 'Input & Textarea', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'goee_contact_field_bg',
            [
                'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EDEDED',
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'goee_contact_field_text_color',
            [
                'label'     => __( 'Text Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'goee_contact_field_placeholder_color',
            [
                'label'     => __( 'Placeholher Text Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 input[type="text"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="email"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="url"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="password"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="search"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="number"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="tel"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="range"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="date"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="month"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="week"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="time"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="datetime"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="datetime-local"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 input[type="color"]::placeholder,
                        {{WRAPPER}} .goee-contact-form-7 textarea::placeholder' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_contact_field_typography',
                'selector' => '{{WRAPPER}} .goee-contact-form-7 input[type="text"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="email"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="url"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="password"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="search"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="number"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="tel"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="range"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="date"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="month"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="week"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="time"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="datetime"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="datetime-local"],
                        {{WRAPPER}} .goee-contact-form-7 input[type="color"],
                        {{WRAPPER}} .goee-contact-form-7 textarea'
            ]
        );
        
        $this->add_responsive_control(
            'goee_contact_input_field_height',
            [
                'label'        => esc_html__( 'Input Field Height', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 150,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 50
                ],
                'selectors'    => [
                    '{{WRAPPER}} .goee-contact-form-7 input[type="text"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="email"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="url"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="password"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="search"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="number"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="tel"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="range"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="date"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="month"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="week"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="time"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="datetime"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="datetime-local"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="color"]' => 'height: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_contact_textarea_field_height',
            [
                'label'        => esc_html__( 'Textarea Height', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 150
                ],
                'selectors'    => [
                    '{{WRAPPER}} .goee-contact-form-7 textarea' => 'height: {{SIZE}}px;'
                ]
            ]
        );

		$this->add_responsive_control(
			'goee_contact_field_padding',
			[
                'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'unit'   => 'px',
					'size'   => 15
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
            'goee_contact_field_margin',
            [
                'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-contact-form-7 input, {{WRAPPER}} .goee-contact-form-7 textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_contact_field_width',
            [
                'label'         => __( 'Field Width', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1
                    ]
                ],
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'unit'      => '%',
					'size'      => 100
                ],
                'selectors'     => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_contact_input_field_bottom_spacing',
            [
                'label'        => esc_html__( 'Field Bottom Spacing', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 20
                ],
                'selectors'    => [
                    '{{WRAPPER}} .goee-contact-form-7 input[type="text"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="email"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="url"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="password"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="search"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="number"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="tel"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="range"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="date"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="month"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="week"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="time"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="datetime"],
                    {{WRAPPER}} .goee-contact-form-7 input[type="datetime-local"],
                    {{WRAPPER}} .goee-contact-form-7 textarea,
                    {{WRAPPER}} .goee-contact-form-7 input[type="color"]' => 'margin-bottom: {{SIZE}}px;'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'        => 'goee_contact_field_border',
                'selector'    => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-select'
			]
		);

		$this->add_responsive_control(
			'goee_contact_field_radius',
			[
                'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
					'{{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .goee-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Label Section
         */
        $this->start_controls_section(
            'goee_contact_section_label_style',
            [
                'label' => __( 'Labels', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'text_color_label',
            [
                'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_contact_typography_label',
                'selector' => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form label'
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
            'goee_contact_section_submit_button_style',
            [
                'label' => __( 'Submit Button', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'goee_contact_section_submit_button_alignment',
            [
                'label'   => __( 'Alignment', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
					'left'  => __( 'Button Left', GOEE_TEXTDOMAIN ),
					'center'  => __( 'Button Center', GOEE_TEXTDOMAIN ),
					'right'  => __( 'Button Right', GOEE_TEXTDOMAIN ),
					'justify'  => __( 'Button Justify', GOEE_TEXTDOMAIN ),
				],
				'desktop_default' => 'center',
				'tablet_default' => 'center',
				'mobile_default' => 'center',
				'selectors_dictionary' => [
					'left' => 'margin-right: auto;',
					'center' => 'margin-left: auto; margin-right: auto;',
					'right' => 'margin-left: auto;',
					'justify' => 'width: 100%; justify-content: center;',
				],
                'selectors'     => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]' => '{{VALUE}};'
                ]
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_contact_button_typography',
                'label'    => __( 'Button Typography', GOEE_TEXTDOMAIN ),
                'selector' => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]'
            ]
        );

        $this->add_responsive_control(
            'goee_contact_button_border_radius',
            [
                'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default'      => [
                    'top'      => 20,
                    'right'    => 50,
                    'bottom'   => 20,
                    'left'     => 50,
                    'unit'     => 'px',
                    'isLinked' => false
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_contact_button_spacing',
            [
                'label'         => __( 'Top Spacing', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ]
                ],
                'size_units'    => [ 'px' ],
                'default'       => [
                    'unit'      => 'px',
					'size'      => 10
                ],
                'selectors'     => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'goee_cf7_button_shadow',
                'selector'       => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]',
                'fields_options' => [
                    'box_shadow_type' => [ 
                        'default'     =>'yes' 
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 13,
                            'blur'       => 33,
                            'spread'     => 0,
                            'color'      => 'rgba(51, 77, 128, 0.2)'
                        ]
                    ]
                ]
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'goee_contact_tab_button_normal',
            [
                'label' => __( 'Normal', GOEE_TEXTDOMAIN )
            ]
        );

        $this->add_control(
            'goee_contact_button_text_color_normal',
            [
                'label'     => __( 'Text Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'goee_contact_button_bg_color_normal',
            [
                'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $goee_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'               => 'goee_contact_button_border',
                'fields_options'     => [
                    'border'         => [
                        'default'    => 'solid'
                    ],
                    'width'          => [
                        'default'    => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color'          => [
                        'default'    => $goee_primary_color
                    ]
                ],
                'selector'           => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'goee_contact_button_box_shadow_normal',
                'label'          => __( 'Box Shadow', GOEE_TEXTDOMAIN ),
                'selector'       => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]',
                'fields_options' => [
                    'box_shadow_type' => [ 
                        'default'     =>'yes' 
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 13,
                            'blur'       => 33,
                            'spread'     => 0,
                            'color'      => 'rgba(51, 77, 128, 0.2)'
                        ]
                    ]
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'  => __( 'Hover', GOEE_TEXTDOMAIN )
            ]
        );

        $this->add_control(
            'goee_contact_button_text_color_hover',
            [
                'label'     => __( 'Text Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $goee_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'goee_contact_button_bg_color_hover',
            [
                'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'goee_contact_button_border_hover',
                'selector' => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'goee_contact_button_box_shadow_hover',
                'label'          => __( 'Box Shadow', GOEE_TEXTDOMAIN ),
                'selector'       => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-form input[type="submit"]:hover'
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Errors
         */
        $this->start_controls_section(
            'goee_section_error_style',
            [
                'label' => __( 'Errors', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control(
            'goee_contact_error_messages_heading',
            [
                'label'     => __( 'Error Messages', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
					'goee_error_messages' => 'show'
				]
            ]
        );

        $this->add_control(
            'goee_contact_error_alert_text_color',
            [
                'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-not-valid-tip' => 'color: {{VALUE}}'
                ],
				'condition' => [
					'goee_error_messages' => 'show'
				]
            ]
        );

        $this->add_control(
            'goee_contact_error_field_bg_color',
            [
                'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-not-valid-tip' => 'background: {{VALUE}}',
                ],
				'condition' => [
					'goee_error_messages' => 'show'
				]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'        => 'goee_contact_error_field_border',
                'selector'    => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-not-valid-tip',
                'condition'   => [
					'goee_error_messages' => 'show'
				]
			]
		);
        
        $this->add_control(
            'goee_contact_validation_errors_heading',
            [
                'label'     => __( 'Validation Errors', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
					'goee_validation_errors' => 'show'
				]
            ]
        );

        $this->add_control(
            'goee_contact_validation_errors_color',
            [
                'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-validation-errors' => 'color: {{VALUE}}'
                ],
                'condition' => [
                    'goee_validation_errors' => 'show'
                ]
            ]
        );

        $this->add_control(
            'goee_contact_validation_errors_bg_color',
            [
                'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .goee-contact-form-7 .wpcf7-validation-errors' => 'background: {{VALUE}}'
                ],
				'condition' => [
					'goee_validation_errors' => 'show'
				]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'        => 'validation_errors_border',
                'selector'    => '{{WRAPPER}} .goee-contact-form-7 .wpcf7-validation-errors',
                'condition'   => [
					'goee_validation_errors' => 'show'
				]
			]
		);
        
        $this->end_controls_section();

    }

    /**
	 * @access protected
	 */
    protected function render() {
        if( ! class_exists( 'WPCF7_ContactForm' ) ) {
            return;
        }        

        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'goee-contact-form', 'class', [
				'goee-contact-form',
				'goee-contact-form-7',
                'goee-contact-form-'.esc_attr($this->get_id())
			]
		);
        
        if ( ! empty( $settings['goee_contact_form_list'] ) ) { ?>
            <div <?php echo $this->get_render_attribute_string( 'goee-contact-form' ); ?>>
                    
                <?php if ( '' != $settings['goee_contact_form_title_text'] ) { ?>
                    <<?php echo Utils::validate_html_tag( $settings['goee_contact_form_title_tag'] ); ?> class="goee-contact-form-title goee-contact-form-7-title">
                        <?php echo esc_html( $settings['goee_contact_form_title_text'] ); ?>
                    </<?php echo Utils::validate_html_tag( $settings['goee_contact_form_title_tag'] ); ?>>
                <?php } ?>
                        
                <?php echo do_shortcode( '[contact-form-7 id="' . $settings['goee_contact_form_list'] . '" ]' ); ?>
            </div>
            
            <?php
        }
        
    }
}