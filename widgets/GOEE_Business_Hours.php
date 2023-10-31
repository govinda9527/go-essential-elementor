<?php

use Elementor\Repeater;
use Elementor\Controls_Manager;

class GOEE_Business_Hours extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'business-hours';
    }
    public function get_title()
    {
        return esc_html__('Business Hours', GOEE_TEXTDOMAIN);
    }
    public function get_icon()
    {
        return 'goee goee-logo eicon-clock eicon-clock-o';
    }
    public function get_categories()
    {
        return ['goee-category'];
    }
    public function get_keywords()
    {
        return ['card', 'service', 'highlight'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', GOEE_TEXTDOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'goee_business_hours',
            [
                'label' => esc_html__('Business Days & Timings', GOEE_TEXTDOMAIN),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'goee_bh_day',
                        'label' => esc_html__('Enter Day', GOEE_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => 'Sunday',

                    ],
                    [
                        'name' => 'goee_bh_time',
                        'label' => esc_html__('Enter Time', GOEE_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => '9:00 AM to 6:00 PM',
                    ],
                ],
                'default' => [
                    [
                        'goee_bh_day' => esc_html__('Sunday', GOEE_TEXTDOMAIN),
                        'goee_bh_time' => esc_html__('9:00 AM to 6:00 PM ', GOEE_TEXTDOMAIN),
                    ],
                    [
                        'goee_bh_day' => esc_html__('Monday', GOEE_TEXTDOMAIN),
                        'goee_bh_time' => esc_html__('9:00 AM to 6:00 PM', GOEE_TEXTDOMAIN),
                    ],
                ],
                'title_field' => '{{{goee_bh_day}}}',
            ],


        );

        $this->end_controls_section();

        // Style section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', GOEE_TEXTDOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Color option
        $this->add_control(
            'title_options',
            [
                'label' => esc_html__('Days Options', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#030303',
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Typography option
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} h3',
            ]
        );

        // Options widget Time

        $this->add_control(
            'description_options',
            [
                'label' => esc_html__('Time Options', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .card__description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .card__description',
            ]
        );


        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $goee_business_hours = $settings['goee_business_hours'];
        
        if ($goee_business_hours) {
            echo '<dl class="goee-business-hours">';
            foreach ($goee_business_hours as $item) {
                echo '<dt class="goee_bh_days goee_bh_days-' . esc_attr($item['_id']) . '">' . $item['goee_bh_day'] . '</dt>';
                echo '<dd class="goee_bh_time goee_bh_time-'.esc_attr($item['_id']) . '">' . $item['goee_bh_time'] . '</dd>';
            }
            echo '</dl>';
        }
    }
}
