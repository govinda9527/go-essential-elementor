<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use GOEE_Addons_Elementor\classes\Helper;

class GOEE_Heading extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'goee-exclusive-heading';
	}

	public function get_title() {
		return esc_html__( 'Heading', GOEE_TEXTDOMAIN );
	}
	public function get_icon() {
		return 'goee goee-logo goee-heading';
	}
	public function get_categories() {
		return [ 'goee-category' ];
	}

	public function get_keywords() {
        return [ 'exclusive', 'title' ];
    }
    
	protected function register_controls() {
		$goee_secondary_color = get_option( 'goee_secondary_color_option', '#00d8d8' );
		
		/**
		* Heading Content Section
		*/
		$this->start_controls_section(
			'goee_heading_content',
			[
				'label' => esc_html__( 'Content', GOEE_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_heading_title',
			[
				'label'       => esc_html__( 'Heading', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Heading Title', GOEE_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'goee_heading_title_link',
			[
				'label'       => __( 'Heading URL', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', GOEE_TEXTDOMAIN ),
				'label_block' => true
			]
		);

		
		$this->add_control(
			'goee_heading_subheading',
			[
				'label'   => esc_html__( 'Sub Heading', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore odio sint harum quasi maiores nobis dignissimos illo doloremque blanditiis illum! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore odio sint harum quasi maiores nobis digniss.', GOEE_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'goee_heading_icon_show',
            [
				'label'        => esc_html__( 'Enable Icon', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'default'      => 'yes',
				'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'goee_heading_icon',
            [
                'label'       => __( 'Icon', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
				'condition'   => [
					'goee_heading_icon_show' => 'yes'
                ]
            ]
        );

		$this->add_control(
            'goee_heading_divider',
            [
				'label'        => esc_html__( 'Enable Divider', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'default'      => 'yes',
				'return_value' => 'yes'
            ]
		);


		
        $this->add_control(
            'goee_heading_title_html_tag',
            [
                'label'   => __('Title HTML Tag', GOEE_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
				'separator' => 'after',
                'options' => Helper::goee_title_tags(),
                'default' => 'h1',
            ]
		);

		$this->end_controls_section();
		

		/*
		* Heading Styling Section
		*/
		$this->start_controls_section(
			'goee_section_heading_general_style',
			[
				'label' => esc_html__( 'General', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_responsive_control(
			'goee_heading_title_alignment',
			[
				'label'       => esc_html__( 'Alignment', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'goee-heading-left'   => [
						'title' => esc_html__( 'Left', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'goee-heading-center' => [
						'title' => esc_html__( 'Center', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'goee-heading-right'  => [
						'title' => esc_html__( 'Right', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'desktop_default' => 'goee-heading-center',
				'tablet_default' => 'goee-heading-left',
				'mobile_default' => 'goee-heading-left',
				'selectors_dictionary' => [
					'goee-heading-left' => 'text-align: left; margin-right: auto; margin-left: unset;',
					'goee-heading-center' => 'text-align: center; margin-left: auto; margin-right: auto;',
					'goee-heading-right' => 'text-align: right; margin-left: auto; margin-right: unset',
				],
				'selectors' => [
					'{{WRAPPER}} .goee-exclusive-heading' => '{{VALUE}};',
					'{{WRAPPER}} .goee-exclusive-heading .goee-heading-separator' => '{{VALUE}};',
					'{{WRAPPER}} .goee-exclusive-heading .goee-heading-icon' => '{{VALUE}};',
					'{{WRAPPER}} .goee-exclusive-heading .goee-heading-icon-box-yes .goee-heading-icon' => '{{VALUE}};',
				],
				'default'     => 'goee-heading-center'
			]
		);

		$this->end_controls_section();

		/*
		* Icon Style
		*/
		$this->start_controls_section(
			'goee_section_heading_icon_style',
			[
				'label'     => esc_html__( 'Icon', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_heading_icon_show'    => 'yes',
					'goee_heading_icon[value]!' => ''
				]
			]
		);

		$this->add_control(
            'goee_heading_icon_box',
            [
				'label'        => esc_html__( 'Icon Box', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
            ]
		);
		
		$this->add_responsive_control(
			'goee_heading_icob_box_height',
			[
				'label'     => esc_html__( 'Height', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-icon' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'goee_heading_icon_box' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'goee_heading_icon_box_width',
			[
				'label'     => esc_html__( 'Width', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-icon' => 'width: {{VALUE}}px;'
				],
				'condition' => [
					'goee_heading_icon_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'goee_heading_icon_box_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .goee-heading-icon',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $goee_secondary_color
					]
				]
			]
		);

		$this->add_responsive_control(
			'goee_heading_icon_box_padding',
			[
				'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '20',
                    'right'    => '20',
                    'bottom'   => '15',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .goee-heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_heading_icon_box_radius',
			[
				'label'        => __( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '100',
					'right'    => '100',
					'bottom'   => '100',
					'left'     => '100',
					'unit'     => '%'
				],
				'selectors'    => [
					'{{WRAPPER}} .goee-heading-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'goee_heading_icon_box_border',
				'selector'  => '{{WRAPPER}} .goee-heading-icon'
			]
		);

		$this->add_control(
			'goee_heading_icon_color',
			[
				'label'     => __('Icon Color', GOEE_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .goee-heading-icon svg path' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_heading_icon_size',
			[
				'label'      => __( 'Icon Size', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 30
				],
				'selectors' => [
					'{{WRAPPER}} .goee-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .goee-heading-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->add_responsive_control(
			'goee_heading_icon_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-heading-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();


		/*
		* Heading Content Styling Section
		*/
		$this->start_controls_section(
			'goee_section_heading_styles_heading',
			[
				'label' => esc_html__( 'Heading', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'goee_heading_type',
            [
				'label'   => esc_html__( 'Heading Type', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'goee-heading-simple',
				'options' => [
					'goee-heading-simple'          => esc_html__( 'Simple', GOEE_TEXTDOMAIN ),
					'goee-heading-text-background' => esc_html__( 'Text Background', GOEE_TEXTDOMAIN ),
					'goee-heading-image-gradient'  => esc_html__( 'Image/Gradient', GOEE_TEXTDOMAIN )
				]
            ]
		);

		$this->add_control(
			'goee_heading_outline_enable',
			[
				'label' => __( 'Enable Text Outline', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', GOEE_TEXTDOMAIN ),
				'label_off' => __( 'Hide', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'goee_heading_outline_width',
			[
				'label'      => __( 'Outline Width', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 5
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 1
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-exclusive-heading-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'goee_heading_outline_enable' => 'yes',
				]
			]
		);

		$this->add_control(
			'goee_heading_outline_color',
			[
				'label'     => __('Outline Color', GOEE_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .goee-exclusive-heading-title' => '-webkit-text-stroke-color: {{VALUE}};'
				],
				'condition' => [
					'goee_heading_outline_enable' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'goee_heading_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .goee-heading-image-gradient .goee-exclusive-heading-title',
				'condition' => [
					'goee_heading_type' => 'goee-heading-image-gradient'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_heading_typography',
				'selector' => '{{WRAPPER}} .goee-exclusive-heading-title'
			]
		);

		$this->add_control(
			'goee_heading_color',
			[
				'label'     => __('Text Color', GOEE_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .goee-exclusive-heading-title, {{WRAPPER}} a .goee-exclusive-heading-title' => 'color: {{VALUE}};'
				],
				'condition' => [
					'goee_heading_type' => ['goee-heading-simple', 'goee-heading-text-background']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'goee_heading_text_shadow',
				'label' => __( 'Text Shadow', GOEE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .goee-exclusive-heading-title',
			]
		);

		$this->add_responsive_control(
			'goee_heading_heading_margin',
			[
				'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-exclusive-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Text Background Style
		 */

		$this->start_controls_section(
			'goee_section_heading_text_background_style',
			[
				'label'     => esc_html__( 'Text Background', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_heading_type' => 'goee-heading-text-background'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_heading_text_background_typography',
				'selector' => '{{WRAPPER}} .goee-heading-text-background .goee-exclusive-heading-title::after'
			]
		);

		$this->add_control(
			'goee_heading_text_background_color',
			[
				'label'     => __('Text Color', GOEE_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeff3',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-text-background .goee-exclusive-heading-title::after' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'goee_heading_text_background_outline_enable',
			[
				'label' => __( 'Enable Text Outline', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', GOEE_TEXTDOMAIN ),
				'label_off' => __( 'Hide', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'goee_heading_text_background_outline_width',
			[
				'label'      => __( 'Outline Width', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 5
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 1
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-heading-text-background .goee-exclusive-heading-title::after' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'goee_heading_text_background_outline_enable' => 'yes',
				]
			]
		);

		$this->add_control(
			'goee_heading_text_background_outline_color',
			[
				'label'     => __('Outline Color', GOEE_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-text-background .goee-exclusive-heading-title::after' => '-webkit-text-stroke-color: {{VALUE}};'
				],
				'condition' => [
					'goee_heading_text_background_outline_enable' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Separator Style
		 */

		$this->start_controls_section(
			'goee_section_heading_style_separator',
			[
				'label'     => esc_html__( 'Divider', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_heading_divider' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_heading_divider_height',
			[
				'label'     => esc_html__( 'Height', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '2',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-separator' => 'height: {{VALUE}}px;'
				]
				
			]
		);
		
		$this->add_responsive_control(
			'goee_heading_divider_width',
			[
				'label'     => esc_html__( 'Width', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-separator' => 'width: {{VALUE}}px;'
				]
			]
		);
		$this->add_control(
			'goee_heading_divider_background',
			[
				'label'     => esc_html__( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .goee-heading-separator' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_heading_divider_margin_top',
			[
				'label'      => __( 'Top Spacing', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 12
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-heading-separator' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_heading_divider_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-heading-separator' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Subheading Style
		 */
		$this->start_controls_section(
			'goee_section_heading_styles_subheading',
			[
				'label' => esc_html__( 'Sub Heading', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_heading_description_color',
			[
				'label'     => __('Color', GOEE_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .goee-exclusive-heading-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name'     => 'goee_heading_subheading_typography',
					'selector' => '{{WRAPPER}} .goee-exclusive-heading-description'
			]
		);

		$this->add_responsive_control(
			'goee_heading_subheading_margin',
			[
				'label'      => __( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-exclusive-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		
	}
	
	protected function render() {
		$settings          = $this->get_settings_for_display();

		$this->add_render_attribute( 
			'goee_exclusive_heading_wrapper', 
			[ 
				'class' => [ 
					'goee-exclusive-heading-wrapper', 
					esc_attr( $settings['goee_heading_title_alignment'] ), 
					esc_attr( $settings['goee_heading_type'] ) 
				]
			]
		);

		$this->add_render_attribute( 
			'goee_heading_title', 
			[ 
				'data-content' => esc_attr( $settings['goee_heading_title'] ),
				'class'        => 'goee-exclusive-heading-title'
			]
		);

		if( 'yes' === $settings['goee_heading_icon_box'] ){
			$this->add_render_attribute( 'goee_exclusive_heading_wrapper', 'class', 'goee-heading-icon-box-yes');
		}

		if( $settings['goee_heading_title_link']['url'] ) {
            $this->add_render_attribute( 'goee_heading_title_link', 'href', esc_url( $settings['goee_heading_title_link']['url'] ) );
	        if( $settings['goee_heading_title_link']['is_external'] ) {
	            $this->add_render_attribute( 'goee_heading_title_link', 'target', '_blank' );
	        }
	        if( $settings['goee_heading_title_link']['nofollow'] ) {
	            $this->add_render_attribute( 'goee_heading_title_link', 'rel', 'nofollow' );
	        }
        }

		$this->add_inline_editing_attributes( 'goee_heading_title', 'basic' );

		$this->add_render_attribute( 'goee_heading_subheading', 'class', 'goee-exclusive-heading-description' );
		$this->add_inline_editing_attributes( 'goee_heading_subheading', 'basic' );
		?>

        <div class="goee-exclusive-heading">
            <div <?php echo $this->get_render_attribute_string( 'goee_exclusive_heading_wrapper' ); ?>>
			<?php
				if ( 'yes' === $settings['goee_heading_icon_show'] && !empty( $settings['goee_heading_icon']['value'] ) ) : ?>
          			<span class="goee-heading-icon">
          				<?php Icons_Manager::render_icon( $settings['goee_heading_icon'] ); ?>
          			</span>
				<?php 	  
				endif;

            	if( !empty( $settings['goee_heading_title_link']['url'] ) ) : ?>
            		<a <?php echo $this->get_render_attribute_string( 'goee_heading_title_link' ); ?>>
				<?php endif; ?>

                <<?php echo Utils::validate_html_tag( $settings['goee_heading_title_html_tag'] ); ?> <?php echo $this->get_render_attribute_string( 'goee_heading_title' ); ?>>
					<?php echo wp_kses_post( $settings['goee_heading_title'] ); ?>
				</<?php echo Utils::validate_html_tag( $settings['goee_heading_title_html_tag'] ); ?>>
	
                <?php if( !empty( $settings['goee_heading_title_link']['url'] ) ) { ?>
                    </a>
				<?php 
				}

				if ( 'yes' === $settings['goee_heading_divider'] ) : ?>
					<div class="goee-heading-separator"></div>
				<?php 	
				endif;
                
                if ( !empty( $settings['goee_heading_subheading'] ) ) : ?>
                    <p <?php echo $this->get_render_attribute_string( 'goee_heading_subheading' ); ?>>
						<?php echo wp_kses_post( $settings['goee_heading_subheading'] ); ?>
                    </p>
				<?php endif; ?>

            </div>
        </div>
	<?php 	
	}
}