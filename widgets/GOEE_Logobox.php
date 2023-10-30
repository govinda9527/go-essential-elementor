<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class GOEE_Logobox extends Widget_Base {
	
	public function get_name() {
		return 'goee-logo';
	}

	public function get_title() {
		return esc_html__( 'Logo Box', GOEE_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'eicon-image-box';
    }
    
    public function get_keywords() {
		return [ GOEE_TEXTDOMAIN, 'brand', 'logo', 'image' ];
	}

	public function get_categories() {
		return [ 'goee-category' ];
	}

	protected function register_controls() {

        /*
        * Logo Image
        */
        $this->start_controls_section(
            'goee_section_logo_image',
            [
                'label' => esc_html__( 'Content', GOEE_TEXTDOMAIN )
            ]
        );
        
        $this->add_control(
            'goee_logo_image',
            [
                'label'   => esc_html__( 'Logo Image', GOEE_TEXTDOMAIN ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'condition' => [
                    'goee_logo_image[url]!' => ''
                ]
            ]
        );

        $this->add_control(
            'goee_logo_box_enable_link',
            [
                'label'        => __( 'Enable Link', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', GOEE_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'goee_logo_box_link',
            [
                'label'         => __( 'Link', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', GOEE_TEXTDOMAIN ),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true
                ],
                'condition'     => [
                    'goee_logo_box_enable_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'goee_logo_box_max_height_enable',
            [
                'label'        => __( 'Minimum Height', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', GOEE_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', GOEE_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
			'goee_logo_box_max_height',
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
					'{{WRAPPER}} .goee-logo-item.goee-logo-item-max-height-yes' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'goee_logo_box_max_height_enable' => 'yes'
                ]
			]
		);
        
        $this->end_controls_section();

        /*
        * Logo Style
        *
        */
    	$this->start_controls_section(
    		'goee_section_logo_style',
    		[
                'label' => esc_html__( 'Style', GOEE_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
    		]
        );

        $this->add_control(
			'goee_section_logo_alignment',
			[
				'label' => __( 'Alignment', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'goee-logo-left' => [
						'title' => __( 'Left', GOEE_TEXTDOMAIN ),
						'icon' => 'fa fa-align-left',
					],
					'goee-logo-center' => [
						'title' => __( 'Center', GOEE_TEXTDOMAIN ),
						'icon' => 'fa fa-align-center',
					],
					'goee-logo-right' => [
						'title' => __( 'Right', GOEE_TEXTDOMAIN ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'goee-logo-center',
				'toggle' => true,
			]
		);

        $this->start_controls_tabs( 'goee_logo_tabs' );

    	# Normal tab
        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

            $this->add_control(
        		'goee_logo_background_style',
        			[
                    'label' => __( 'Background Style', GOEE_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        			]
            );

            $this->add_group_control(
        		Group_Control_Background::get_type(),
    			[
                    'name'      => 'goee_logo_background',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .goee-logo-box .goee-logo-item'
    			]
            );

            $this->add_control(
        		'goee_logo_opacity_style',
        		[
                    'label' => __( 'Opacity', GOEE_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'goee_logo_opacity',
                [
                    'label' => __('Opacity', GOEE_TEXTDOMAIN),
                    'type'  => Controls_Manager::NUMBER,
                    'range' => [
                        'min'   => 0,
                        'max'   => 1
            		],
                    'selectors' => [
                        '{{WRAPPER}} .goee-logo-box .goee-logo-item img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
    			'goee_logo_shadow_style',
    			[
                    'label' => __( 'Box Shadow', GOEE_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'goee_logo_box_shadow',
                    'selector' => '{{WRAPPER}} .goee-logo-box .goee-logo-item'
                ]
            );

        $this->end_controls_tab();

    	# Hover tab
        $this->start_controls_tab( 'goee_button_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

            $this->add_control(
    			'goee_logo_hover_background',
    			[
                    'label' => __( 'Background Style', GOEE_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'goee_logo_hover_background_hover',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .goee-logo-box .goee-logo-item:hover'
                ]
            );

            $this->add_control(
        		'goee_logo_opacity_hover_style',
        		[
                    'label' => __( 'Opacity', GOEE_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'goee_logo_hover_opacity',
                [
                    'label'     => __('Opacity', GOEE_TEXTDOMAIN),
                    'type'      => Controls_Manager::NUMBER,
                    'range'     => [
                        'min'   => 0,
                        'max'   => 1
                    ],
                    'default'   => __( 'From 0.1 to 1', GOEE_TEXTDOMAIN ),
                    'selectors' => [
                        '{{WRAPPER}} .goee-logo-box .goee-logo-item:hover img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );
        		
            $this->add_control(
                'goee_logo_shadow_hover_style',
                [
                    'label' => __( 'Box Shadow', GOEE_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'goee_logo_box_hover_shadow',
                    'selector' => '{{WRAPPER}} .goee-logo-box .goee-logo-item:hover'
                ]
            );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'goee_logo_padding',
            [
                'label'      => __( 'Padding', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator'  => 'before',
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-logo-box .goee-logo-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .goee-logo-box .goee-logo-item'
            ]
        );
        $this->add_responsive_control(
    		'goee_logo_border_radius',
            [
                'label'      => __( 'Border Radius', GOEE_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .goee-logo-box .goee-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
	}
	protected function render() {
        $settings       = $this->get_settings_for_display();
        $goee_logo_link = $settings['goee_logo_box_link'];

        if( 'yes' === $settings['goee_logo_box_enable_link'] && $goee_logo_link ) {
            $this->add_render_attribute( 'goee_logo_box_link', 'href', esc_url( $settings['goee_logo_box_link']['url'] ) );
            if( $settings['goee_logo_box_link']['is_external'] ) {
                $this->add_render_attribute( 'goee_logo_box_link', 'target', '_blank' );
            }
            if( $settings['goee_logo_box_link']['nofollow'] ) {
                $this->add_render_attribute( 'goee_logo_box_link', 'rel', 'nofollow' );
            }
        }
        ?>

        <div class="goee-logo-box one <?php echo $settings['goee_section_logo_alignment']; ?>">
            <div class="goee-logo-item goee-logo-item-max-height-<?php echo $settings['goee_logo_box_max_height_enable']; ?>">
            <?php
                if( ! empty( $settings['goee_logo_image'] ) ) :

                    if( !empty( $goee_logo_link ) && 'yes' === $settings['goee_logo_box_enable_link'] ) :
                        echo '<a '.$this->get_render_attribute_string( 'goee_logo_box_link' ).'>';
                    endif;
                    echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'goee_logo_image' );
                    if( !empty( $goee_logo_link ) && 'yes' === $settings['goee_logo_box_enable_link'] ) :
                        echo '</a>';
                    endif;
                endif;
            ?>    
            </div>
        </div>
    <?php    
	}

}