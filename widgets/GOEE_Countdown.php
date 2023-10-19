<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;

class GOEE_Countdown extends Widget_Base {

	public function get_name() {
		return 'goee-countdown-timer';
	}

	public function get_title() {
		return esc_html__( 'Countdown Timer', 'go-essential-elementor' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_keywords() {
        return [ 'exclusive', 'coming', 'soon', 'govinda' ];
    }

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_script_depends() {
		return [ 'goee-countdown' ];
	}

	protected function register_controls() {
		$goee_primary_color = get_option( 'goee_primary_color_option', '#7a56ff' );

		/**
		 * Countdown Timer Settings
		 */
		$this->start_controls_section(
  			'goee_section_countdown_settings_general',
  			[
  				'label' => esc_html__( 'Timer Settings', 'go-essential-elementor' )
  			]
  		);
		
		$this->add_control(
			'goee_countdown_time',
			[
				'label'       => esc_html__( 'Countdown Date', 'go-essential-elementor' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date("Y/m/d", strtotime("+ 1 week")),
				'description' => esc_html__( 'Set the date and time here', 'go-essential-elementor' )
			]
		);

		$this->add_control(
			'goee_countdown_expired_text',
			[
				'label'       => __( 'Countdown Expired Title', 'go-essential-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Hurray! This is the event day.', 'go-essential-elementor' ),
				'description' => __( 'This text will show when the CountDown will over.', 'go-essential-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'goee_section_countdown_container_style',
			[
				'label' => esc_html__( 'Container', 'go-essential-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'goee_countdown_container_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .goee-countdown'
			]
		);

		$this->add_responsive_control(
			'goee_countdown_container_padding',
			[
				'label'      => esc_html__( 'Padding', 'go-essential-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-countdown' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'goee_countdown_border',
				'selector' => '{{WRAPPER}} .goee-countdown'
			]
		);

		$this->add_responsive_control(
			'goee_countdown_container_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'go-essential-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-countdown' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'goee_section_countdown_box_style',
			[
				'label' => esc_html__( 'Counter Box', 'go-essential-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_section_countdown_show_box',
			[
				'label' => __( 'Enable Box', 'go-essential-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'go-essential-elementor' ),
				'label_off' => __( 'Hide', 'go-essential-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'goee_section_countdown_box_width',
			[
				'label' => __( 'Width', 'go-essential-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 150
				],
				'selectors' => [
					'{{WRAPPER}} .goee-countdown .goee-countdown-container' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'goee_section_countdown_show_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_section_countdown_box_height',
			[
				'label' => __( 'Height', 'go-essential-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 150
				],
				'selectors' => [
					'{{WRAPPER}} .goee-countdown .goee-countdown-container' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'goee_section_countdown_show_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'goee_countdown_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .goee-countdown .goee-countdown-container'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_countdown_box_shadow',
				'selector' => '{{WRAPPER}} .goee-countdown-container'
			]
		);

		$this->add_control(
			'goee_before_border',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thin'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'goee_countdown_box_border',
				'selector' => '{{WRAPPER}} .goee-countdown .goee-countdown-container'
			]
		);

		$this->add_responsive_control(
			'goee_countdown_box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'go-essential-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'    => 4,
					'right'  => 4,
					'bottom' => 4,
					'left'   => 4,
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-countdown .goee-countdown-container' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'goee_section_countdown_divider_style',
			[
				'label' => esc_html__( 'Divider', 'go-essential-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_countdown_divider_enable',
			[
				'label'        => __( 'Enable Divider', 'go-essential-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'go-essential-elementor' ),
				'label_off'    => __( 'Off', 'go-essential-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'goee_countdown_divider_color',
			[
				'label'     => __( 'Divider Color', 'go-essential-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .goee-countdown.goee-countdown-divider .goee-countdown-container::after' => 'color: {{VALUE}};'
				],
				'condition' => [
					'goee_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_countdown_divider_size',
			[
				'label'        => __( 'Size', 'go-essential-elementor' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'devices'      => [ 'desktop', 'tablet' ],
				'range'        => [
					'px'       => [
						'min'  => 50,
						'max'  => 150,
						'step' => 5
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 80
				],
				'selectors'    => [
					'{{WRAPPER}} .goee-countdown.goee-countdown-divider .goee-countdown-container::after' => 'font-size: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'goee_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_countdown_divider_position_right',
			[
				'label'        => __( 'Offset X', 'go-essential-elementor' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'devices'      => [ 'desktop', 'tablet' ],
				'range'        => [
					'%'       => [
						'min'  => -50,
						'max'  => 50,
						'step' => 1
					],
					'px'       => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 0
				],
				'selectors'    => [
					'{{WRAPPER}} .goee-countdown.goee-countdown-divider .goee-countdown-container::after' => 'right: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'goee_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'goee_countdown_divider_position_left',
			[
				'label'        => __( 'Offset Y', 'go-essential-elementor' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'devices'      => [ 'desktop', 'tablet' ],
				'range'        => [
					'%'       => [
						'min'  => -50,
						'max'  => 50,
						'step' => 1
					],
					'px'       => [
						'min'  => -200,
						'max'  => 200,
						'step' => 1
					]
				],
				'default'      => [
					'unit'     => '%',
					'size'     => -30
				],
				'selectors'    => [
					'{{WRAPPER}} .goee-countdown.goee-countdown-divider .goee-countdown-container::after' => 'top: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'goee_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		
		// Counter Styles
		$this->start_controls_section(
			'goee_section_countdown_styles_counter',
			[
				'label' => esc_html__( 'Counter', 'go-essential-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_typography',
				'selector' => '{{WRAPPER}} .goee-countdown-count'
			]
		);

		$this->add_control(
			'goee_countdown_number_color',
			[
				'label'     => __( 'Color', 'go-essential-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .goee-countdown-count' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
            'goee_countdown_number_margin',
            [
                'label'      => esc_html__( 'Margin', 'go-essential-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .goee-countdown-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->end_controls_section();
		
		// Title Styles
		$this->start_controls_section(
			'goee_countdown_styles_title',
			[
				'label' => esc_html__( 'Title', 'go-essential-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'goee_countdown_title_typography',
					'selector' => '{{WRAPPER}} .goee-countdown-title'
				]
		);

		$this->add_control(
			'goee_countdown_title_color',
			[
				'label'     => __( 'Color', 'go-essential-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .goee-countdown-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
            'goee_countdown_title_margin',
            [
                'label'      => esc_html__( 'Margin', 'go-essential-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .goee-countdown-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->end_controls_section();

		$this->start_controls_section(
			'goee_countdown_expired_title_style',
			[
				'label'     => esc_html__( 'Expired Title', 'go-essential-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_countdown_expired_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'goee_countdown_expired_title_typography',
					'selector' => '{{WRAPPER}} .goee-countdown-content-container .goee-countdown p.message'
				]
		);

		$this->add_control(
			'goee_countdown_expired_title_color',
			[
				'label'     => __( 'Color', 'go-essential-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .goee-countdown-content-container .goee-countdown p.message' => 'color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'goee-countdown-timer-attribute',
			[
				'class'             => [ 'goee-countdown' ],
				'data-day'          => esc_attr__( 'Days', 'go-essential-elementor' ),
				'data-minutes'      => esc_attr__( 'Minutes', 'go-essential-elementor' ),
				'data-hours'        => esc_attr__( 'Hours', 'go-essential-elementor' ),
				'data-seconds'      => esc_attr__( 'Seconds', 'go-essential-elementor' ),
				'data-countdown'    => esc_attr( $settings['goee_countdown_time'] ),
				'data-expired-text' => esc_attr( $settings['goee_countdown_expired_text'] )
			]
		);
		
		if ( 'yes' === $settings['goee_countdown_divider_enable'] ) {
			$this->add_render_attribute(
				'goee-countdown-timer-attribute',
				[
					'class' => [ 'goee-countdown-divider' ]
				]
			);
		}
		?>

		<div class="goee-countdown-content-container <?php echo $settings['goee_section_countdown_show_box']; ?>">
			<div <?php echo $this->get_render_attribute_string('goee-countdown-timer-attribute'); ?>></div>
		</div>
		
		<?php
	}

	/**
     * Render countDown timer widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'goee_countdown_timer_attribute', 'class', 'goee-countdown' );
			if ( 'yes' === settings.goee_countdown_divider_enable ) {
				view.addRenderAttribute( 'goee_countdown_timer_attribute', 'class', 'goee-countdown-divider' );
			}

			view.addRenderAttribute( 'goee_countdown_timer_attribute', {
				'data-day': 'Days',
				'data-minutes': 'Minutes',
				'data-hours': 'Hours',
				'data-seconds': 'Seconds',
				'data-countdown': settings.goee_countdown_time,
				'data-expired-text': settings.goee_countdown_expired_text
			} );
		#>

		<div class="goee-countdown-content-container {{ settings.goee_section_countdown_show_box }}">
			<div {{{ view.getRenderAttributeString( 'goee_countdown_timer_attribute' ) }}}>
			</div>
		</div>

		<?php
	}

}