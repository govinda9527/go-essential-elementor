<?php

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;


if (!defined('ABSPATH')) exit;

class GOEE_Button extends Widget_Base
{

    public function get_name()
    {
        return 'goee-button';
    }

    public function get_title()
    {
        return esc_html('Button', GOEE_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'goee goee-logo eicon-button';
    }

    public function get_keywords()
    {
        return ['goee', 'goee-button', 'button'];
    }

    public function get_categories()
    {
        return ['goee-category'];
    }

    protected function register_controls()
    {
        $goee_primary_color = get_option('goee_primary_color_option', '#7a56ff');

        // content controls
        $this->start_controls_section(
            'goee_section_button_content',
            [
                'label' => esc_html__('Contents', 'goee-essential-elementor')
            ]
        );

        $this->add_control(
            'goee_button_text',
            [
                'label' => __('Button Text', 'go-essential-elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Download!', 'go-essential-elementor'),
                'placeholder' => __('Enter button text', 'go-essential-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'goee_button_link_url',
            [
                'label' => esc_html__('Link Url', 'go-essential-elementor'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true
                ],
                'show_external' => true
            ]
        );

        $this->add_control(
            'goee_button_icon',
            [
                'label' => esc_html__('Icon', 'go-essential-elementor'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-download',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $this->add_control(
            'goee_button_icon_position',
            [
                'label' => esc_html__("Button Icon Position", 'go-essential-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'goee-button-icon-before-text',
                'options' => [
                    'goee-button-icon-before-text' => esc_html__('Before Text', 'go-essential-elementor'),
                    'goee-button-icon-after-text' => esc_html__("After Text", 'go-essential-elementor')
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'goee_section_button_settings',
            [
                'label' => esc_html__( 'Styles & Effects', 'go-essential-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'goee_button_effect',
            [
                'label' => esc_html__( "Button Effect", 'go-essential-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'effect-2',
                'options' => [
                    'btn-effect-1' => esc_html__( 'Effect 1', GOEE_TEXTDOMAIN ),
                    'btn-effect-2' => esc_html__( 'Effect 2', GOEE_TEXTDOMAIN ),
                    'btn-effect-3' => esc_html__( 'Effect 3', GOEE_TEXTDOMAIN ),
                    'btn-effect-4' => esc_html__( 'Effect 4', GOEE_TEXTDOMAIN ),
                    'btn-effect-5' => esc_html__( 'Effect 5', GOEE_TEXTDOMAIN ),
                    'btn-effect-6' => esc_html__( 'Effect 6', GOEE_TEXTDOMAIN ),
                    'btn-effect-7' => esc_html__( 'Effect 7', GOEE_TEXTDOMAIN ),
                    'btn-effect-8' => esc_html__( 'Effect 8', GOEE_TEXTDOMAIN ),
                    'btn-effect-9' => esc_html__( 'Effect 9', GOEE_TEXTDOMAIN ),
                    'btn-effect-10' => esc_html__( 'Effect 10', GOEE_TEXTDOMAIN ),
                    'btn-effect-11' => esc_html__( 'Effect 11', GOEE_TEXTDOMAIN ),
                    'btn-effect-12' => esc_html__( 'Effect 12', GOEE_TEXTDOMAIN )
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'goee_button_typography',
                'selector' => '{{WRAPPER}} .goee-button-wrapper .goee-button-action'
            ]
        );
        $this->add_control(
            'goee_button_enable_fixed_width',
            [
                'label' => __( 'Enable fixed Height & Width?', GOEE_TEXTDOMAIN ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', GOEE_TEXTDOMAIN ),
                'label_off' => __('Hide', GOEE_TEXTDOMAIN),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'goee_button_fixed_width_height',
            [
                'label' => __( 'Fixed Height & Width', GOEE_TEXTDOMAIN ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'Default', GOEE_TEXTDOMAIN ),
                'label_on' => __( 'Custom', GOEE_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'goee_button_enable_fixed_width' => 'yes'
                ]
            ]
        );

        $this->start_popover();

			$this->add_responsive_control(
				'goee_button_fixed_width',
				[
					'label'      => esc_html__( 'Width', GOEE_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 500,
							'step' => 1
						],
						'%'        => [
							'min'  => 0,
							'max'  => 100
						]
					],
					'default'    => [
						'unit'   => 'px',
						'size'   => 100
					],
					'selectors'  => [
						'{{WRAPPER}} .goee-button-wrapper .goee-button-action' => 'width: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'goee_button_enable_fixed_width' => 'yes'
					]
				]
			);

            $this->add_responsive_control(
				'goee_button_fixed_height',
				[
					'label'      => esc_html__( 'Height', GOEE_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 500,
							'step' => 1
						],
						'%'        => [
							'min'  => 0,
							'max'  => 100
						]
					],
					'default'    => [
						'unit'   => 'px',
						'size'   => 100
					],
					'selectors'  => [
						'{{WRAPPER}} .goee-button-wrapper .goee-button-action' => 'height: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'goee_button_enable_fixed_width' => 'yes'
					]
				]
			);

        $this->end_popover();

		$this->add_responsive_control(
			'goee_button_width',
			[
				'label'      => esc_html__( 'Width', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => '%',
					'size'   => 80
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-button-wrapper .goee-button-action' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'goee_button_enable_fixed_width!' => 'yes'
				]
			]
		);

		// $icon_gap = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'goee_button_icon_space',
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
                    '{{WRAPPER}} .goee-button-wrapper.goee-button-incon-before-text .goee-button-action i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .goee-button-wrapper.goee-button-incon-after-text .goee-button-action i'  => 'margin-left: {{SIZE}}{{UNIT}};'
				],
                'condition'   => [
                    'goee_button_icon[value]!' => ''
                ]
			]
        );
		
		$this->add_responsive_control(
			'goee_button_alignment',
			[
				'label'       => esc_html__( 'Alignment', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'toggle'      => false,
				'options'     => [
					'left'      => [
						'title' => esc_html__( 'Left', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => esc_html__( 'Center', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => esc_html__( 'Right', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'desktop_default' => 'center',
				'tablet_default' => 'center',
				'mobile_default' => 'center',
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start;',
					'center' => 'justify-content: center;',
					'right' => 'justify-content: flex-end;',
				],
				'selectors'     => [
					'{{WRAPPER}} .goee-button-wrapper' => '{{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_button_padding',
			[
				'label'      => esc_html__( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => 15,
					'right'    => 15,
					'bottom'   => 15,
					'left'     => 15,
					'unit'     => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .goee-button-wrapper .goee-button-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .goee-button-wrapper .goee-button-action, {{WRAPPER}} .goee-button-wrapper.effect-1 .goee-button-action::before'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'goee_button_separator',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'default'
			]
		);

		$this->start_controls_tabs( 'goee_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

		$this->add_control(
			'goee_button_text_color',
			[
				'label'		=> esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $goee_primary_color,
				'selectors'	=> [
					'{{WRAPPER}} .goee-button-wrapper .goee-button-action'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .goee-button.goee-button--tamaya::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .goee-button.goee-button--tamaya::after'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'goee_button_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .goee-button-wrapper .goee-button-action'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'goee_button_border',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' 	  => [
                        'default' => $goee_primary_color
                    ]
                ],
				'selector'        => '{{WRAPPER}} .goee-button-wrapper .goee-button-action'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_button_box_shadow',
				'selector' => '{{WRAPPER}} .goee-button-wrapper .goee-button-action'
			]
		);

		$this->end_controls_tab();
		
		$this->start_controls_tab( 'goee_button_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

		$this->add_control(
			'goee_button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .goee-button-wrapper .goee-button-action:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'goee_button_hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .goee-button-wrapper.effect-1 .goee-button-action::before, {{WRAPPER}} .goee-button-wrapper.effect-2 .goee-button-action:before, {{WRAPPER}} .goee-button-wrapper.effect-2 .goee-button-action:after, {{WRAPPER}} .goee-button-wrapper.effect-3 .goee-button-action::before, {{WRAPPER}} .goee-button-wrapper.effect-4 .goee-button-action::after, {{WRAPPER}} .goee-button-wrapper.effect-5 .goee-button-action::before, {{WRAPPER}} .goee-button-wrapper.effect-7 .goee-button-action::before, {{WRAPPER}} .goee-button-wrapper.effect-8 .goee-button-action span.effect-8-position, {{WRAPPER}} .goee-button-wrapper.effect-10 .goee-button-action::before, {{WRAPPER}} .goee-button-wrapper.effect-11 .goee-button-action:hover, {{WRAPPER}} .goee-button-wrapper.effect-12 .goee-button-action:hover',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $goee_primary_color
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'goee_button_border_hover',
				'selector'        => '{{WRAPPER}} .goee-button-wrapper .goee-button-action:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .goee-button-wrapper .goee-button-action:hover'
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();	
		
		$this->end_controls_section();
    }

    protected function render() {
		$settings = $this->get_settings_for_display();

        $goee_button_text = $settings['goee_button_text'];
        $goee_button_icon = $settings['goee_button_icon'];
        $goee_button_link_url = $settings['goee_button_link_url'];
        $goee_button_icon_position = $settings['goee_button_icon_position'];
        $goee_button_effect = $settings['goee_button_effect'];
        $goee_button_enable_fixed_width = $settings['goee_button_enable_fixed_width'];
		
		$this->add_render_attribute( 
			'goee_button', 
			[
				'class'	=> [ 
					'goee-button-wrapper', 
					esc_attr( $goee_button_effect ) ,
					esc_attr( $goee_button_icon_position ),
					'goee-button-fixed-height-'.esc_attr( $goee_button_enable_fixed_width )
				]
			]
		);

		if ( 'effect-8' === $goee_button_effect ) {
			$this->add_render_attribute( 'goee_button', 'class', 'mouse-hover-effect' );
		}

		$this->add_inline_editing_attributes( 'exclusive_button_text', 'none' );
		$this->add_render_attribute( 'goee_button_link_url', 'class', 'goee-button-action' );

		if( $goee_button_link_url['url'] ) {
			$this->add_render_attribute( 'goee_button_link_url', 'href', esc_url( $goee_button_link_url['url'] ) );
			if( $goee_button_link_url['is_external'] ) {
				$this->add_render_attribute( 'goee_button_link_url', 'target', '_blank' );
			}
			if( $goee_button_link_url['nofollow'] ) {
				$this->add_render_attribute( 'goee_button_link_url', 'rel', 'nofollow' );
			}
		}
		?>

		<div <?php echo $this->get_render_attribute_string( 'goee_button' ); ?>>

			<?php do_action( 'goee_button_wrapper_before' ); ?>

			<a <?php echo $this->get_render_attribute_string( 'goee_button_link_url' ); ?>>
				<?php do_action( 'goee_button_begin_anchor_tag' );

				if ( ! empty( $goee_button_icon['value'] ) ) :
					if( 'goee-button-incon-before-text' === $goee_button_icon_position ) : ?>
						<span>
							<?php Icons_Manager::render_icon( $goee_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php	
					endif;
				endif;
				?>

				<span <?php echo $this->get_render_attribute_string( 'goee_button_text' ); ?>>
					<?php echo esc_html( $goee_button_text ); ?>
				</span>

				<?php
				if ( ! empty( $goee_button_icon['value'] ) ) :
					if( 'goee-button-incon-after-text' === $goee_button_icon_position ) : ?>
						<span>
							<?php Icons_Manager::render_icon( $goee_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php	
					endif;
				endif;

				if ( 'effect-8' === $goee_button_effect ) {
					echo '<span class="effect-8-position"></span>';
				}

				do_action( 'goee_button_end_anchor_tag' ); ?>
			</a>

			<?php do_action( 'goee_button_wrapper_after' ); ?>
		</div>
		<?php	
	}
}
