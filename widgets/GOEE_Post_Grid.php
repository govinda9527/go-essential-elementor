<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Css_Filter;
use GOEE_Addons_Elementor\classes\Helper;

class GOEE_Post_Grid extends Widget_Base {

	public function get_name() {
		return 'goee-post-grid';
	}

	public function get_title() {
		return __( 'Post Grid', GOEE_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'goee-category' ];
	}

	public function get_script_depends() {
		return [ 'goee-post-grid' ];
	}

	public function get_keywords() {
        return [ 'blog' ];
    }

	protected function register_controls() {
		$goee_primary_color   = get_option( 'goee_primary_color_option', '#7a56ff' );
		$goee_secondary_color = get_option( 'goee_secondary_color_option', '#00d8d8' );

        $this->start_controls_section(
            'goee_section_post_grid_filters',
            [
                'label' => __( 'Settings', GOEE_TEXTDOMAIN )
            ]
        );
        
        $this->add_control(
            'goee_post_grid_type',
            [
				'label'   => __( 'Post Type', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => Helper::goee_get_post_types(),
				'default' => 'post'

            ]
		);
		
		$this->add_control(
            'goee_post_grid_enable_featured_post',
            [
                'label'        => esc_html__( 'Enable Featured Post', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'goee_post_grid_per_page',
            [
				'label'   => __( 'Posts Per Page', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '6'
            ]
		);

		$this->add_responsive_control(
            'goee_post_grid_column_no',
            [
				'label'   => __( 'Columns', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => esc_html__( '1', GOEE_TEXTDOMAIN ),
					'2' => esc_html__( '2', GOEE_TEXTDOMAIN ),
					'3' => esc_html__( '3', GOEE_TEXTDOMAIN ),
					'4' => esc_html__( '4', GOEE_TEXTDOMAIN ),
					'5' => esc_html__( '5', GOEE_TEXTDOMAIN ),
					'6' => esc_html__( '6', GOEE_TEXTDOMAIN )
				],
				'desktop_default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'selectors_dictionary' => [
					'1' => 'flex: 0 0 100%; max-width: 100%;',
					'2' => 'flex: 0 0 50%; max-width: 50%;',
					'3' => 'flex: 0 0 33.333333%; max-width: 33.333333%;',
					'4' => 'flex: 0 0 25%; max-width: 25%;',
					'5' => 'flex: 0 0 20%; max-width: 20%;',
					'6' => 'flex: 0 0 16.66666%; max-width: 16.66666%;',
				],
				'selectors' => [
					'{{WRAPPER}} .goee-row-wrapper .goee-col' => '{{VALUE}};'
				]
            ]
		);
		
        $this->add_control(
            'goee_post_grid_offset',
            [
				'label'   => __( 'Offset', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0'
            ]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'post_grid_image_size',
				'default'   => 'medium_large'
			]
		);
		
		$this->add_control(
        	'goee_post_grid_exclude_post',
        	[
				'label'       => __( 'Exclude Post', GOEE_TEXTDOMAIN ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::goee_get_all_posts(),
				'condition'   => [
					'goee_post_grid_type' => 'post'
				]
            ]
        );

        $this->add_control(
        	'goee_post_grid_authors',
        	[
				'label'       => __( 'Author', GOEE_TEXTDOMAIN ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::goee_get_authors()
            ]
		);

        $this->add_control(
        	'goee_post_grid_categories',
        	[
				'label'       => __( 'Categories', GOEE_TEXTDOMAIN ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::goee_get_all_categories(),
				'condition'   => [
					'goee_post_grid_type' => 'post'
				]
            ]
		);

        $this->add_control(
        	'goee_post_grid_tags',
        	[
				'label'       => __( 'Tags', GOEE_TEXTDOMAIN ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::goee_get_all_tags(),
				'condition'   => [
					'goee_post_grid_type' => 'post'
				]
            ]
        );

        $this->add_control(
            'goee_post_grid_order',
            [
				'label'    => __( 'Order', GOEE_TEXTDOMAIN ),
				'type'     => Controls_Manager::SELECT,
                'default'  => 'desc',
				'options'  => [
					'asc'  => __( 'Ascending', GOEE_TEXTDOMAIN ),
					'desc' => __( 'Descending', GOEE_TEXTDOMAIN )
                ]
            ]
        );

        $this->add_control(
            'goee_post_grid_order_by',
            [
				'label'    => __( 'Order By', GOEE_TEXTDOMAIN ),
				'type'     => Controls_Manager::SELECT,
                'default'  => 'date',
				'options'  => [
					'ID'  => __( 'ID', GOEE_TEXTDOMAIN ),
					'date'  => __( 'Date', GOEE_TEXTDOMAIN ),
					'modified' => __( 'Modified', GOEE_TEXTDOMAIN ),
					'author' => __( 'Author Name', GOEE_TEXTDOMAIN ),
					'title' => __( 'Post Title', GOEE_TEXTDOMAIN ),
					'name' => __( 'Post Name', GOEE_TEXTDOMAIN ),
					'rand' => __( 'Random', GOEE_TEXTDOMAIN ),
                ]
            ]
        );

        $this->add_control(
			'goee_post_grid_ignore_sticky',
			[
				'label'        => esc_html__( 'Ignore Sticky?', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
            'goee_post_grid_show_excerpt',
            [
                'label'        => esc_html__( 'Enable Excerpt.', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'goee_grid_excerpt_length',
            [
				'label'     => __( 'Excerpt Words', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '25',
				'condition' => [
					'goee_post_grid_show_excerpt' => 'yes'
				]
            ]
        );

        $this->add_control(
			'goee_post_grid_show_image',
			[
				'label'        => esc_html__( 'Enable Image', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'goee_post_grid_show_title',
			[
				'label'        => esc_html__( 'Enable Title', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'goee_post_grid_show_title_parmalink',
			[
				'label'        => esc_html__( 'Disable Title & Image Parmalink', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'goee_post_grid_title_full',
			[
				'label'        => esc_html__( 'Enable Title Length (Full or Short)', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'Full', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Short', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
            'goee_post_grid_title_tag',
            [
                'label'   => __('Title HTML Tag', GOEE_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::goee_title_tags(),
                'default' => 'h3',
            ]
		);

		$this->add_control(
            'goee_grid_title_length',
            [
				'label'     => __( 'Title Words Length', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '10',
				'condition' => [
					'goee_post_grid_title_full!' => 'yes'
				]
            ]
        );

        $this->add_control(
            'goee_post_grid_show_read_more_btn',
            [
                'label'        => esc_html__( 'Enable Details Button', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'goee_post_grid_read_more_btn_text',
            [   
                'label'         => esc_html__( 'Button Text', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Read More', GOEE_TEXTDOMAIN),
                'default'       => esc_html__('Read More', GOEE_TEXTDOMAIN ),
                'condition'     => [
                    '.goee_post_grid_show_read_more_btn' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

		$this->add_control(
            'goee_post_grid_show_read_more_btn_new_tab',
            [
                'label'        => esc_html__( 'Enable New Tab', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes',
				'condition'     => [
                    'goee_post_grid_show_read_more_btn' => 'yes'
				],
            ]
        );  

        $this->add_control(
            'goee_post_grid_enable_load_more_btn',
            [
                'label'        => esc_html__( 'Enable Load More Button', GOEE_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

		$this->add_control(
            'goee_post_grid_enable_load_more_btn_text',
            [   
                'label'         => esc_html__( 'Load More Button text', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Load More', GOEE_TEXTDOMAIN ),
                'condition'     => [
                    '.goee_post_grid_enable_load_more_btn' => 'yes'
                ]
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'goee_section_post_grid_meta_options',
            [
                'label' => __( 'Post Meta', GOEE_TEXTDOMAIN )
            ]
        );

        $this->add_control(
			'goee_post_grid_show_category',
			[
				'label'        => esc_html__( 'Enable Category.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'goee_post_grid_post_data_position',
			[
				'label' => __( 'Post Data Position', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_data_middle',
				'options' => [
					'post_data_middle'  => __( 'Middle', GOEE_TEXTDOMAIN ),
					'post_data_bottom'  => __( 'Bottom', GOEE_TEXTDOMAIN ),
				],
			]
		);

        $this->add_control(
			'goee_post_grid_show_user_avatar',
			[
				'label'        => esc_html__( 'Enable Avatar.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

        $this->add_control(
			'goee_post_grid_show_user_name',
			[
				'label'        => esc_html__( 'Enable Author Name.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'goee_post_grid_show_user_name_tag',
			[
				'label'        => esc_html__( 'Enable Author Name Tag.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes',
                'condition'     => [
                    '.goee_post_grid_show_user_name' => 'yes'
                ]
			]
		);

        $this->add_control(
            'goee_post_grid_user_name_tag',
            [   
                'label'         => esc_html__( 'Author Name Tag', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('By: ', GOEE_TEXTDOMAIN ),
                'condition'     => [
					'.goee_post_grid_show_user_name_tag' => 'yes',
					'.goee_post_grid_show_user_name'     => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_control(
			'goee_post_grid_show_date',
			[
				'label'        => esc_html__( 'Enable Date.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'goee_post_grid_show_date_tag',
			[
				'label'        => esc_html__( 'Enable Date Tag.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes',
                'condition'     => [
                    'goee_post_grid_show_date' => 'yes'
                ]
			]
		);

        $this->add_control(
            'goee_post_grid_date_tag',
            [   
                'label'         => esc_html__( 'Date Tag', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Date: ', GOEE_TEXTDOMAIN ),
                'condition'     => [
					'goee_post_grid_show_date_tag' => 'yes',
					'goee_post_grid_show_date'     => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_control(
			'goee_post_grid_show_read_time',
			[
				'label'        => esc_html__( 'Enable Reading Time.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'goee_post_grid_show_comment',
			[
				'label'        => esc_html__( 'Enable Comment.', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'Off', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
            'goee_section_post_grid_container',
            [
				'label' => __( 'Container', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'goee_post_grid_equal_height',
			[
				'label'        => esc_html__( 'Equal Height', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'Yes', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'No', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'goee_grid_post_bg_color',
			[
				'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-container' => 'background: {{VALUE}};'
				]

			]
		);

		$this->add_group_control(
        	Group_Control_Border::get_type(),
            [
                'name'      => 'goee_grid_post_container_border',
                'selector'  => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-container'
            ]
        );

		$this->add_responsive_control(
			'goee_post_grid_radius',
			[
				'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-container'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-container .goee-post-grid-thumbnail'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_post_grid_box_shadow',
				'fields_options'         => [
                    'box_shadow_type'    => [ 
                        'default'        =>'yes' 
                    ],
                    'box_shadow'         => [
                        'default'        => [
                            'horizontal' => 0,
                            'vertical'   => 10,
                            'blur'       => 30,
                            'spread'     => 0,
                            'color'      => 'rgba(0,0,0,.1)'
                        ]
                    ]
				],
				'selector' => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-container',
			]
		);

        $this->add_responsive_control(
            'goee_post_grid_container_margin',
            [
                'label'         => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'       => '0',
                    'right'     => '0',
                    'bottom'    => '20',
                    'left'      => '0',
                    'isLinked'  => false
                ],                
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .goee-post-grid-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
		);
		
		$this->add_responsive_control(
			'goee_post_grid_container_padding',
			[
				'label'      => esc_html__( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-container'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		// Featured Post
		$this->start_controls_section(
            'goee_section_post_grid_feature_post',
            [
				'label'     => __( 'Feature Post', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_post_grid_enable_featured_post' => 'yes'
				]
            ]
		);

		$this->add_control(
            'goee_post_grid_feature_post_layout',
            [
				'label'   => __( 'Layout', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default_layout',
				'options' => [
					'default_layout' => esc_html__( 'Default Layout', GOEE_TEXTDOMAIN ),
					'layout_one' => esc_html__( 'Layout 1', GOEE_TEXTDOMAIN ),
				]
            ]
		);

		$this->add_responsive_control(
			'goee_post_grid_feature_post_padding',
			[
				'label'      => esc_html__( 'Content Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .goee-post-grid.goee-post-grid-featured-post-yes.layout_one article.goee-post-grid-three:first-child .goee-post-grid-container .goee-post-grid-body'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		// Image Styles
		$this->start_controls_section(
            'goee_section_post_grid_image_style',
            [
				'label'     => __( 'Image', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_post_grid_show_image' => 'yes'
				]
            ]
		);

		$this->add_responsive_control(
			'goee_section_post_grid_image_padding',
			[
				'label'      => esc_html__( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-container .goee-post-grid-thumbnail'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'goee_section_post_grid_image_radius',
			[
				'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .goee-post-grid-thumbnail img'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_control(
            'goee_post_grid_image_align',
            [
                'label'         => esc_html__( 'Image Position', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'       => 'top',
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-left'
                    ],
                    'top'    	=> [
                        'title' => esc_html__( 'Top', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-up'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', GOEE_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-right'
                    ]
                ]
            ]
		);
		
		$this->add_responsive_control(
			'goee_post_grid_image-height',
			[
				'label'       => __( 'Image Min Height', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-post-grid-container.image-position-top .goee-post-grid-thumbnail > a' => 'min-height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'goee_post_grid_image_align' => 'top'
				]
			]
		);

		$this->add_control(
			'goee_post_grid_image_fixed_height',
			[
				'label'        => esc_html__( 'Fixed Height ?', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'Yes', GOEE_TEXTDOMAIN ),
				'label_off'    => __( 'No', GOEE_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
			'goee_post_grid_image_height',
			[
				'label'       => __( 'Image Height', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' , '%'],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-post-grid-container.image-position-top .goee-post-grid-thumbnail > a' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'goee_post_grid_image_align' => 'top',
					'goee_post_grid_image_fixed_height' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'goee_post_grid_image_width',
			[
				'label'       => __( 'Image Width', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ '%' ],
				'range'       => [
					'%'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-post-grid-container.image-position-left>figure' => 'width: {{SIZE}}%;',
					'{{WRAPPER}} .goee-post-grid-container.image-position-left>div.goee-post-grid-body' => 'width: calc( 100% - {{SIZE}}% );',
					'{{WRAPPER}} .goee-post-grid-container.image-position-right>div.goee-post-grid-body' => 'width: calc( 100% - {{SIZE}}% );',
					'{{WRAPPER}} .goee-post-grid-container.image-position-right>figure' => 'width: {{SIZE}}%;',
				],
				'condition' => [
					'goee_post_grid_image_align' => [ 'left', 'right' ]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'goee_post_grid_image_css_filter',
				'selector' => '{{WRAPPER}} .goee-post-grid-container.image-position-top .goee-post-grid-thumbnail > a img',
			]
		);

		$this->end_controls_section();

		// Content Styles
		$this->start_controls_section(
            'goee_post_grid_content_style',
            [
				'label' => __( 'Content', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'goee_post_grid_content_bg_color',
			[
				'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-three .goee-post-grid-body' => 'background-color: {{VALUE}};'
				]

			]
		);

        $this->add_responsive_control(
            'goee_post_grid_content_margin',
            [
                'label'         => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-three .goee-post-grid-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
			'goee_post_grid_content_padding',
			[
				'label'      => esc_html__( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
					'top'      => '20',
					'right'    => '20',
					'bottom'   => '20',
					'left'     => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-three .goee-post-grid-body'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
                'name'      => 'goee_post_grid_content_border',
                'selector'  => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-three .goee-post-grid-body'
            ]
        );

		$this->add_responsive_control(
			'goee_post_grid_content_box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-three .goee-post-grid-body'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                   => 'goee_post_grid_content_box_shadow',
				'selector'               => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-three .goee-post-grid-body'
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'goee_post_grid_title',
            [
				'label'     => __( 'Title', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_post_grid_show_title' => 'yes'
				]
            ]
        );

        $this->add_responsive_control(
            'goee_post_grid_title_margin',
            [
                'label'         => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                 
                'selectors'     => [
                    '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
			'goee_grid_title_alignment',
			[
				'label'   => __( 'Title Alignment', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'left'		=> [
						'title' => __( 'Left', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'center' 	=> [
						'title' => __( 'Center', GOEE_TEXTDOMAIN ),
						'icon' 	=> 'eicon-text-align-center'
					],
					'right' 	=> [
						'title' => __( 'Right', GOEE_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .goee-post-grid-body .goee-post-grid-title' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_grid_title_typography',
				'selector' => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-grid-title'
			]
		);

		$this->start_controls_tabs( 'goee_post_grid_title_tabs' );

			$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

			$this->add_control(
				'goee_grid_title_color',
				[
					'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#1B1D26',
					'selectors' => [
						'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-grid-title' => 'color: {{VALUE}};'
					]	
				]
			);

			$this->end_controls_tab();
			
			$this->start_controls_tab( 'hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

			$this->add_control(
				'goee_grid_title_hover_color',
				[
					'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#0A1724',
					'selectors' => [
						'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-grid-title:hover' => 'color: {{VALUE}};'
					]
	
				]
			);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
            'goee_post_grid_excerpt_style',
            [
				'label' => __( 'Excerpt', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_post_grid_show_excerpt' => 'yes'
				]
            ]
        );

        $this->add_control(
			'goee_grid_excerpt_color',
			[
				'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => [
					'{{WRAPPER}} .goee-post-grid-body .goee-post-grid-description' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'goee_grid_excerpt_alignment',
			[
				'label'   => __( 'Alignment', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'left' 		=> [
						'title' => __( 'Left', GOEE_TEXTDOMAIN ),
						'icon' 	=> 'eicon-text-align-left'
					],
					'center' 	=> [
						'title' => __( 'Center', GOEE_TEXTDOMAIN ),
						'icon' 	=> 'eicon-text-align-center'
					],
					'right' 	=> [
						'title' => __( 'Right', GOEE_TEXTDOMAIN ),
						'icon' 	=> 'eicon-text-align-right'
					],
					'justify' 	=> [
						'title' => __( 'Justified', GOEE_TEXTDOMAIN ),
						'icon' 	=> 'eicon-text-align-justify'
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .goee-post-grid-body .goee-post-grid-description' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'goee_post_grid_excerpt_typography',
				'selector' => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-grid-description'
            ]
        );

        $this->add_responsive_control(
			'goee_post_grid_excerpt_margin',
			[
				'label'      => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'      => '15',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-grid-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'goee_post_grid_category_style',
            [
				'label' => __( 'Category', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'goee_post_grid_show_category' => 'yes'
				]
            ]
        );

        $this->add_control(
			'goee_post_grid_category_default_position',
			[
				'label'        => esc_html__( 'Category Position Default?', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'goee_post_grid_category_position_over_image',
			[
				'label'   => esc_html__( 'Category Position Over Image', GOEE_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => '-bottom-left',
				'options' => [
					'-bottom-left' 	=> esc_html__( 'Bottom Left Corner', GOEE_TEXTDOMAIN ),
					'-top-right'   	=> esc_html__( 'Top Right Corner', GOEE_TEXTDOMAIN )
				],
                'condition' => [
                    '.goee_post_grid_category_default_position!' => 'yes'
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'goee_post_grid_category_typography',
				'selector' => '{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li a'
            ]
        );

		$this->add_responsive_control(
			'goee_post_grid_category_padding',
			[
				'label'      => esc_html__( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
					'top'      => '1',
					'right'    => '10',
					'bottom'   => '1',
					'left'     => '10',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
            'goee_post_grid_category_all_item_margin',
            [
				'label'      => esc_html__( 'Margin(Each Item)', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],                 
				'selectors'  => [
                    '{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_post_grid_category_each_item_margin',
            [
				'label'      => esc_html__( 'Margin(All Items)', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],                 
				'selectors'  => [
                    '{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
			'goee_post_grid_category_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'goee_post_grid_category_tabs' );

            // normal state tab
			$this->start_controls_tab( 'goee_post_grid_odd_category', [ 'label' => esc_html__( 'ODD', GOEE_TEXTDOMAIN ) ] );
			
				$this->add_control(
					'goee_grid_category_bg_odd_color',
					[
						'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $goee_secondary_color,
						'selectors' => [
							'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-category li:nth-child(2n-1)' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'goee_grid_category_odd_text_color',
					[
						'label'     => __( 'Text Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li:nth-child(2n-1) a' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'      => 'goee_grid_category_odd_border',
						'selector'  => '{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li:nth-child(2n-1)'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'      => 'goee_grid_category_odd_shadow',
						'selector'  => '{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li:nth-child(2n-1)',
						'separator' => 'before'
					]
				);

            $this->end_controls_tab();

            // hover state tab
			$this->start_controls_tab( 'goee_post_grid_even_category', [ 'label' => esc_html__( 'Even', GOEE_TEXTDOMAIN ) ] );
			
				$this->add_control(
					'goee_grid_category_bg_even_color',
					[
						'label'     => __( 'Background Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $goee_primary_color,
						'selectors' => [
							'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-category li:nth-child(2n)' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'goee_grid_category_even_text_color',
					[
						'label'     => __( 'Text Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li:nth-child(2n) a' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'      => 'goee_grid_category_even_border',
						'selector'  => '{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li:nth-child(2n)'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'      => 'goee_grid_category_even_shadow',
						'selector'  => '{{WRAPPER}} .goee-post-grid-container ul.goee-post-grid-category li:nth-child(2n)',
					]
				);

            $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
            'goee_post_grid_author_date_style',
            [
				'label' => __( 'Author & Date', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);
		
		$this->add_responsive_control(
			'goee_post_grid_author_image_size',
			[
				'label'       => __( 'Author Image Size', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 40
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-author-avatar img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
            'goee_post_grid_author_date_margin',
            [
				'label'        => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', 'em', '%' ],
				'default'      => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],                 
                'selectors'    => [
                    '{{WRAPPER}} .goee-post-grid-body .goee-post-data' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'goee_post_grid_meta_style',
			[
				'label'     => __( 'Meta', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'goee_post_grid_meta_spacing',
			[
				'label'       => __( 'Spacing Between Author & Date', GOEE_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 150
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 15
				],
				'selectors'   => [
					'{{WRAPPER}} .goee-post-grid-body .goee-post-data li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->add_control(
			'goee_grid_author_date_color',
			[
				'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-data li span' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'goee_grid_author_date_typography',
				'selector' => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-data li span'
            ]
        );

		$this->add_control(
			'goee_grid_date_style',
			[
				'label'     => __( 'Meta Link', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

        $this->add_control(
			'goee_grid_author_date_link_color',
			[
				'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-data li span a' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'goee_grid_author_date_link_typography',
				'selector' => '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body .goee-post-data li span a'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'goee_post_grid_reading_time_comment_style',
            [
				'label' => __( 'Reading Time & Comment', GOEE_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'goee_post_grid_reading_time_comment_margin',
            [
				'label'        => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', 'em', '%' ],
				'default'      => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],               
                'selectors'    => [
                    '{{WRAPPER}} .goee-row-wrapper .goee-post-grid-body ul.goee-post-grid-time-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'goee_post_grid_reading_time_style',
			[
				'label'     => __( 'Reading Time', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'goee_post_grid_show_read_time' => 'yes'
				]
			]
		);

        $this->add_control(
			'goee_post_grid_reading_time_color',
			[
				'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#90929C',
				'selectors' => [
					'{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body ul.goee-post-grid-time-comment li.goee-post-grid-read-time' => 'color: {{VALUE}};'
				],
				'condition' => [
					'goee_post_grid_show_read_time' => 'yes'
				]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'      => 'goee_post_grid_reading_time_typography',
				'selector'  => '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body ul.goee-post-grid-time-comment li.goee-post-grid-read-time',
				'condition' => [
					'goee_post_grid_show_read_time' => 'yes'
				]
            ]
        );

		$this->add_control(
			'goee_post_grid_comment_style',
			[
				'label'     => __( 'Comment', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'goee_post_grid_show_comment' => 'yes'
				]
			]
		);

        $this->add_control(
			'goee_post_grid_comment_color',
			[
				'label'     => __( 'Color', GOEE_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#90929C',
				'selectors' => [
					'{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body ul.goee-post-grid-time-comment li a.goee-post-grid-comment' => 'color: {{VALUE}};'
				],
				'condition' => [
					'goee_post_grid_show_comment' => 'yes'
				]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'      => 'goee_post_grid_comment_typography',
				'selector'  => '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body ul.goee-post-grid-time-comment li a.goee-post-grid-comment',
				'condition' => [
					'goee_post_grid_show_comment' => 'yes'
				]
            ]
        );
        
		$this->end_controls_section();
		
        /**
         * -------------------------------------------
         * button style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'goee_post_grid_details_btn_style_section',
            [
				'label'     => esc_html__( 'Button Style', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
                    '.goee_post_grid_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_post_grid_details_btn_padding',
            [
				'label'      => esc_html__( 'Padding', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,           
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
                    '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_post_grid_details_btn_margin',
            [
				'label'      => esc_html__( 'Margin', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],                 
				'selectors'  => [
                    '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'goee_post_grid_details_btn_typography',
				'selector' => '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a'
            ]
		);
		
		$this->add_responsive_control(
			'goee_post_grid_details_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', GOEE_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->start_controls_tabs( 'goee_post_grid_details_button_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'goee_post_grid_details_btn_normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );

            $this->add_control(
                'goee_post_grid_details_btn_normal_text_color',
                [
					'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $goee_primary_color,
					'selectors' => [
                        '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'goee_post_grid_details_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => 'rgba(0,0,0,0)',
                    'selectors' => [
                        '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'      => 'goee_post_grid_details_btn_border',
                    'selector'  => '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
					'name'      => 'goee_post_grid_details_button_shadow',
					'selector'  => '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a',
					'separator' => 'before'
                ]
            );

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'goee_post_grid_details_btn_hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );

            $this->add_control(
                'goee_post_grid_details_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'goee_post_grid_details_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a:hover' => 'background: {{VALUE}};'
                    ]
                ]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
					[
						'name'      => 'goee_post_grid_details_btn_border_hover',
						'selector'  => '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a:hover'
					]
				);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'goee_post_grid_details_button_hover_shadow',
                    'selector'  => '{{WRAPPER}} .goee-post-grid-container .goee-post-grid-body .goee-post-footer a:hover',
                    'separator' => 'before'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
		
		/**
         * -------------------------------------------
         * Load More Button style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'goee_post_grid_load_more_btn_style',
            [
				'label'     => esc_html__( 'Load More Button', GOEE_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
                    '.goee_post_grid_enable_load_more_btn' => 'yes'
                ]
            ]
		);

		$this->add_responsive_control(
			'goee_post_grid_load_more_btn_padding',
			[
				'label' => __( 'Padding', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '30',
					'bottom' => '10',
					'left' => '30',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .goee-post-grid-paginate-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'goee_post_grid_load_more_btn_margin',
			[
				'label' => __( 'Margin', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '20',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .goee-post-grid-paginate-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'goee_post_grid_load_more_btn_radius',
			[
				'label' => __( 'Radius', GOEE_TEXTDOMAIN ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .goee-post-grid-paginate-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goee_post_grid_load_more_btn_typography',
				'label' => __( 'Typography', GOEE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .goee-post-grid-paginate-btn',
			]
		);

		$this->start_controls_tabs( 'goee_post_grid_load_more_btn_tabs' );

            // normal state tab
			$this->start_controls_tab( 'goee_post_grid_load_more_btn_normal', [ 'label' => esc_html__( 'Normal', GOEE_TEXTDOMAIN ) ] );
			
				$this->add_control(
					'goee_post_grid_load_more_btn_normal_bg_color',
					[
						'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default' 	=> $goee_primary_color,
						'selectors' => [
							'{{WRAPPER}} .goee-post-grid-paginate-btn' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'goee_post_grid_load_more_btn_normal_text_color',
					[
						'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default' 	=> '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .goee-post-grid-paginate-btn' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'goee_post_grid_load_more_btn_normal_border',
						'label' => __( 'Border', GOEE_TEXTDOMAIN ),
						'selector' => '{{WRAPPER}} .goee-post-grid-paginate-btn',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'goee_post_grid_load_more_btn_normal_box_shadow',
						'label' => __( 'Box Shadow', GOEE_TEXTDOMAIN ),
						'selector' => '{{WRAPPER}} .goee-post-grid-paginate-btn',
					]
				);

            $this->end_controls_tab();

            // hover state tab
			$this->start_controls_tab( 'goee_post_grid_load_more_btn_Hover', [ 'label' => esc_html__( 'Hover', GOEE_TEXTDOMAIN ) ] );
			
				$this->add_control(
					'goee_post_grid_load_more_btn_hover_bg_color',
					[
						'label'     => esc_html__( 'Background Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default' 	=> "#ffffff",
						'selectors' => [
							'{{WRAPPER}} .goee-post-grid-paginate-btn:hover' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'goee_post_grid_load_more_btn_hover_text_color',
					[
						'label'     => esc_html__( 'Text Color', GOEE_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default' 	=> $goee_primary_color,
						'selectors' => [
							'{{WRAPPER}} .goee-post-grid-paginate-btn:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'goee_post_grid_load_more_btn_hover_border',
						'label' => __( 'Border', GOEE_TEXTDOMAIN ),
						'selector' => '{{WRAPPER}} .goee-post-grid-paginate-btn:hover',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'goee_post_grid_load_more_btn_hover_box_shadow',
						'label' => __( 'Box Shadow', GOEE_TEXTDOMAIN ),
						'selector' => '{{WRAPPER}} .goee-post-grid-paginate-btn:hover',
					]
				);

            $this->end_controls_tab();

        $this->end_controls_tabs();
		
		$this->end_controls_section();
	}

	protected function render() {
		$settings                  = $this->get_settings_for_display();		
		$settings['template_type'] = $this->get_name();
		$settings['post_args']     = Helper::goee_get_post_arguments( $settings, 'goee_post_grid' );
		
		$this->add_render_attribute(
			'goee_post_grid_wrapper',
			[
				'class' => "goee-row-wrapper"
			]
		);

		$this->add_render_attribute(
			'goee_post_grid_featured_post',
			[
				'class' => "goee-post-grid"
			]
		);

		if( 'yes' === $settings['goee_post_grid_enable_featured_post'] ){
			$this->add_render_attribute(
				'goee_post_grid_featured_post',
				[
					'class' => ['goee-post-grid-featured-post-'.$settings['goee_post_grid_enable_featured_post'], $settings['goee_post_grid_feature_post_layout']]
				]
			);
		}

		$this->add_render_attribute(
			'goee_post_grid_load_more_button',
			[
				'data-post-type'      => $settings['goee_post_grid_type'],
				'data-posts_per_page' => $settings['goee_post_grid_per_page'],
				'data-post-offset'    => $settings['goee_post_grid_offset'],
				'data-post-order'     => $settings['goee_post_grid_order'],
				'data-post-order_by'     => $settings['goee_post_grid_order_by'],
				'data-post-tag__in'   => $settings['goee_post_grid_tags'],
				'data-post-thumbnail' => $settings['goee_post_grid_show_image'],
				'data-post-thumb-size' => $settings['post_grid_image_size_size'],
				'data-equal_height' => $settings['goee_post_grid_equal_height'],
				'data-enable_details_btn' => $settings['goee_post_grid_show_read_more_btn'],
				'data-details_btn_text' => $settings['goee_post_grid_read_more_btn_text'],
				'data-details_btn_text_tab' => $settings['goee_post_grid_show_read_more_btn_new_tab'],
				'data-show-user-avatar' => $settings['goee_post_grid_show_user_avatar'],
				'data-show_user_name' => $settings['goee_post_grid_show_user_name'],
				'data-post_data_position' => $settings['goee_post_grid_post_data_position'],
				'data-show_title' => $settings['goee_post_grid_show_title'],
				'data-show_title_parmalink' => $settings['goee_post_grid_show_title_parmalink'],
				'data-title_full' => $settings['goee_post_grid_title_full'],
				'data-title_tag' => $settings['goee_post_grid_title_tag'],
				'data-show_read_time' => $settings['goee_post_grid_show_read_time'],
				'data-show_comment' => $settings['goee_post_grid_show_comment'],
				'data-show_excerpt' => $settings['goee_post_grid_show_excerpt'],
				'data-excerpt_length' => $settings['goee_grid_excerpt_length'],
				'data-show_user_name_tag' => $settings['goee_post_grid_show_user_name_tag'],
				'data-user_name_tag' => $settings['goee_post_grid_user_name_tag'],
				'data-show_date' => $settings['goee_post_grid_show_date'],
				'data-show_date_tag' => $settings['goee_post_grid_show_date_tag'],
				'data-date_tag' => $settings['goee_post_grid_date_tag'],
				'data-title_length' => $settings['goee_grid_title_length'],
				'data-image_align' => $settings['goee_post_grid_image_align'],
				'data-show_category' => $settings['goee_post_grid_show_category'],
				'data-category_default_position' => $settings['goee_post_grid_category_default_position'],
				'data-category_position_over_image' => $settings['goee_post_grid_category_position_over_image'],
				'data-category' => $settings['goee_post_grid_categories'],
				'data-tags' => $settings['goee_post_grid_tags'],
				'data-offset' => $settings['goee_post_grid_offset'],
				'data-exclude_post' => $settings['goee_post_grid_exclude_post']
			]
		);
		?>		

		<div <?php echo $this->get_render_attribute_string( 'goee_post_grid_featured_post' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'goee_post_grid_wrapper' ); ?>>
				<?php Helper::goee_get_posts( $settings ); ?>    
			</div>
			<div class="goee-post-grid-load-btn">
				<?php if( 'yes' === $settings['goee_post_grid_enable_load_more_btn'] ) { ?>
					<a class="goee-post-grid-paginate-btn" <?php echo $this->get_render_attribute_string( 'goee_post_grid_load_more_button' ); ?> href="#" role="button">
						<?php echo esc_html( $settings['goee_post_grid_enable_load_more_btn_text'] ); ?>
					</a>
				<?php 
				}
				?>
			</div>
		</div>

	<?php
	}

}