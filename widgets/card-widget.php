<?php
class GOEE_Card_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'card';
    }
    public function get_title()
    {
        return esc_html__('Essenial Card', 'go-ee');
    }
    public function get_icon()
    {
        return 'eicon-header';
    }
    public function get_custom_help_url()
    {
        return 'https://redirecttowidgetinfo.com';
    }
    public function get_categories()
    {
        return ['general'];
    }
    public function get_keywords()
    {
        return ['card', 'service', 'highlight', 'essential'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'go-ee'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'card_title',
            [
                'label' => esc_html__('Card title', 'go-ee'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Your card title here', 'go-ee'),
            ]
        );
        $this->add_control(
            'card_description',
            [
                'label' => esc_html__('Card Description', 'go-ee'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('Your card description here', 'go-ee'),
            ]
        );
        $this->end_controls_section();
        
        // Style section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'go-ee' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Color option
        $this->add_control(
            'title_options',
            [
                'label' => esc_html__( 'Title Options', 'essential-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'essential-elementor-widget' ),
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

        // Options widget Description

        $this->add_control(
            'description_options',
            [
                'label' => esc_html__( 'Description Options', 'essential-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );      
    
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Color', 'essential-elementor-widget' ),
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

        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        // var_dump($settings);

        // get the individual values of the input
        $card_title = $settings['card_title'];
        $card_description = $settings['card_description'];

        ?>

        <!-- Start rendering the output -->
        <div class="card">
            <h3 class="card_title">
                <?php echo $card_title; ?>
            </h3>
            <p class="card__description">
                <?php echo $card_description; ?>
            </p>
        </div>
        <!-- End rendering the output -->

        <?php

    }
}