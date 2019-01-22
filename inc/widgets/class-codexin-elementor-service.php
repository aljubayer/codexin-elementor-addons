<?php
/**
 * Codexin Elementor Service Widget.
 *
 * Codexin Elementor widget that inserts an custom service widget of custom design.
 *
 * @since 1.0.0
 */

class Codexin_Elementor_Service extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'service';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Service', 'codexin-elementor-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-skyatlas';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array widget categories.
	 */
	public function get_categories() {
		return ['codexin-addons'];
	}

	/**
	 * Get script depends.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array widget scripts.
	 */
    public function get_script_depends() {
    	return [];
    }

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {		
		$this->service_widget_title_section();
		$this->service_widget_summary_section();
		$this->service_widget_button_section();		
		$this->service_widget_container_section();
	}

	

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo '<div class="codexin-elementor-addons-service">';
		echo '<div class="codexin-elementor-addons-contents">';

		if( !empty( $settings['service_title'] ) ){
			echo '<' . $settings['service_title_tag'] . ' class="codexin-elementor-addons-service-title">' . $settings['service_title'] . '</' . $settings['service_title_tag'] . '>';
		}
		

		if ( ! empty( $settings['service_summary'] ) ) {
			echo '<p class="codexin-elementor-addons-service-summary">' . $settings['service_summary'] . '</p>';
		}		
		
		if ( ! empty( $settings['service_button_text'] ) || ! empty( $settings['service_button_icon'] ) ) {
			echo '<div class="codexin-elementor-addons-action-container">';
			echo '<a href="' . $settings['service_button_url'] . '" class="codexin-elementor-addons-btn-item ' . $settings['service_button_style'] . '">' ;
			echo '<i class="' . $settings['service_button_icon']. '" aria-hidden="true"></i>';
			echo $settings['service_button_text'];
			echo '</a>';
			echo '</div>';
		}
		
		
		echo '</div>';
		echo '</div>';

	}

	/**
	 * Render widget output on the designer panel.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function _content_template() {
		?>
		<div class="codexin-elementor-addons-service">
			<div class="codexin-elementor-addons-contents">
				<h1 class="codexin-elementor-addons-service-title">{{{ settings.service_title }}}</h1>
				<p class="codexin-elementor-addons-service-summary">{{{ settings.service_summary }}}</p>
				<div class="codexin-elementor-addons-action-container">
					<a href="{{{ settings.service_button_url }}}" class="codexin-elementor-addons-btn-item {{{ settings.service_button_style }}}">
					<i class="{{{ settings.service_button_icon }}}" aria-hidden="true"></i>
					{{{ settings.service_button_text }}}</a>
				</div>
				
			</div>
		</div>
		<?php
	}


	/**
	 * buttton controls on service widget
	 *
	 * @since 1.0.0
	 * @access private
	 */

	private function service_widget_button_section(){
		$this->start_controls_section(
			'service_button_section',
			[
				'label' 	=> esc_html__( 'Button', 'codexin-elementor-addons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'service_button_icon',
			[
				'label' => esc_html__( 'Button Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'options' => \Elementor\Control_Icon::get_icons(),
				'default' => 'fa fa-facebook',
			]
		);

		$this->add_control(
			'service_button_text',
			[
				'label' 		=> esc_html__( 'Button text', 'codexin-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'input_type' 	=> 'text',
				'placeholder' 	=> esc_html__( 'Write Button Text', 'codexin-elementor-addons' ),
				'default' 		=> esc_html__( 'Read More', 'codexin-elementor-addons' ),
			]
		);


		$this->add_responsive_control(
			'service_icon_text_spacing',
			[
				'label' => esc_html__( 'Spacing Between', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-btn-item i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'service_button_url',
			[
				'label' 		=> esc_html__( 'Url', 'codexin-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'input_type' 	=> 'url',
				'placeholder' 	=> esc_html__( 'http://example.com', 'codexin-elementor-addons' ),
				'default' 		=> esc_html__( 'http://example.com', 'codexin-elementor-addons' ),
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> esc_html__( 'Button', 'codexin-elementor-addons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'style_tab' );
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label'	=> esc_html__( 'Normal', 'codexin-elementor-addons' ),
			]
		);



		$this->add_control(
			'service_button_style',
			[
				'label' => esc_html__( 'Select button style', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'normal-btn' => [
						'title' => esc_html__( 'Normal', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-square',
					],
					'spin circle' => [
						'title' => esc_html__( 'Circle', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-circle-o',
					],
					'draw' => [
						'title' => esc_html__( 'Draw', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-share-square',
					],
					'draw meet' => [
						'title' => esc_html__( 'Draw Meet', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-caret-square-o-right',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-caret-square-o-down',
					],
					'spin' => [
						'title' => esc_html__( 'Spin', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-circle-o-notch',
					],
					
				],
				'default' => 'center',
				'toggle' => true,
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_button_background',
				'label' => esc_html__( 'Background', 'codexin-elementor-addons' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .codexin-elementor-addons-btn-item',
			]
		);




	    $this->add_control( 
	    	'service_button_text_color', 
	    	[
	            'label'     => 	esc_html__( 'Text Color', 'codexin-elementor-addons' ),
	            'type'      =>  \Elementor\Controls_Manager::COLOR,
	            'selectors' => 	[
					            	'{{WRAPPER}} .codexin-elementor-addons-btn-item' => 'color: {{VALUE}};',
					        	],
        	] 
        );

        $this->add_responsive_control(
			'service_button_align',
			[
				'label' => esc_html__( 'Alignment', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-action-container' => 'text-align: {{VALUE}};',
				],
			]
		);



        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_button_typography',
				'label' => esc_html__( 'Typography', 'codexin-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexin-elementor-addons-btn-item, {{WRAPPER}} .codexin-elementor-addons-btn-item i',
			]
		);

		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'codexin-elementor-addons' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_button_background_hover',
				'label' => esc_html__( 'Background', 'codexin-elementor-addons' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .codexin-elementor-addons-btn-item:hover',
			]
		);

	    $this->add_control( 
	    	'service_button_hover_text_color', 
	    	[
	            'label'     => 	esc_html__( 'Text Color', 'codexin-elementor-addons' ),
	            'type'      =>  \Elementor\Controls_Manager::COLOR,
	            'selectors' => 	[
					            	//'{{WRAPPER}} .codexin-elementor-addons-btn-item.normal-btn:hover' => 'color: {{VALUE}};',
					            	'{{WRAPPER}} .codexin-elementor-addons-btn-item.spin:hover' => 'color: {{VALUE}};',
					            	'{{WRAPPER}} .codexin-elementor-addons-btn-item.center:hover' => 'color: {{VALUE}};',
					            	'{{WRAPPER}} .codexin-elementor-addons-btn-item.meet:hover' => 'color: {{VALUE}};',
					            	'{{WRAPPER}} .codexin-elementor-addons-btn-item.draw:hover' => 'color: {{VALUE}};',
					        	],
				'default'	=> 'rgba(255,255,255,1)',
        	] 
        );

		$this->add_control( 
	    	'service_button_hover_text_border_color', 
	    	[
	            'label'     => 	esc_html__( 'Hover border olor', 'codexin-elementor-addons' ),
	            'type'      =>  \Elementor\Controls_Manager::COLOR,
	            'selectors' => 	[
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.normal-btn:hover' => 'border-color: {{VALUE}};',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.spin:hover::before' => 'border-top-color: {{VALUE}};border-right-color: {{VALUE}};border-bottom-color: {{VALUE}};',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.spin:hover::after' => 'border-top:2px solid {{VALUE}};',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.center::after' => 'border-left: 2px solid {{VALUE}}; border-right: 2px solid {{VALUE}};',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.center::before' => 'border-top: 2px solid {{VALUE}}; border-bottom: 2px solid {{VALUE}};',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.meet:hover::after' => 'border-bottom-color: {{VALUE}}; border-left-color: {{VALUE}};',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.meet:hover::before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}};',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.draw:hover::after' => 'border-bottom-color: {{VALUE}};border-left-color: {{VALUE}}',
	            					'{{WRAPPER}} .codexin-elementor-addons-btn-item.draw:hover::before' => 'border-top-color: {{VALUE}};border-right-color: {{VALUE}}',
	            					
					        	],
        	] 
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * container control on service widget.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function service_widget_container_section() {

		$this->start_controls_section(
			'section_service_container_style',
			[
				'label' 	=> esc_html__( 'Container', 'codexin-elementor-addons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_container_background',
				'label' => esc_html__( 'Background', 'codexin-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .codexin-elementor-addons-service',
			]
		);

		$this->add_responsive_control(
			'container_spacing_top',
			[
				'label' => esc_html__( 'Spacing Top', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_spacing_right',
			[
				'label' => esc_html__( 'Spacing right', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_spacing_bottom',
			[
				'label' => esc_html__( 'Spacing bottom', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_spacing_left',
			[
				'label' => esc_html__( 'Spacing left', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'service_container_overlay_color',
			[
				'label' => esc_html__( 'Overlay', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service:hover:before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .codexin-elementor-addons-service:hover:after' => 'background: {{VALUE}}',
				],
				'default' => 'rgba(0,0,0,0)'
			]
		);


		$this->end_controls_section();
	}

	/**
	 * title control on service widget.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function service_widget_title_section() {
		$this->start_controls_section(
			'section_service_title',
			[
				'label' 	=> esc_html__( 'Title', 'codexin-elementor-addons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'service_title',
			[
				'label' 		=> esc_html__( 'Title', 'codexin-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'input_type' 	=> 'text',
				'placeholder' 	=> esc_html__( 'Your Service Title', 'codexin-elementor-addons' ),
				'default' 		=> esc_html__( 'Your Service Title', 'codexin-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'service_title_content_align',
			[
				'label' => esc_html__( 'Alignment', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section( 
		 	'section_service_title_style', 
		 	[
            	'label' =>	 esc_html__( 'Title', 'codexin-elementor-addons' ),
            	'tab'   =>	\Elementor\Controls_Manager::TAB_STYLE,
        	] 
        );

		$this->add_control( 
			'service_title_tag', 
			[
	            'label'   =>  esc_html__( 'Title HTML Tag', 'codexin-elementor-addons' ),
	            'type'    => \Elementor\Controls_Manager::SELECT,
	            'options' => codexin_elementor_addons_title_heading_options(),
            	'default' => 'h3',
        	] 
        );

	    $this->add_control( 
	    	'service_title_color', 
	    	[
	            'label'     => 	esc_html__( 'Color', 'codexin-elementor-addons' ),
	            'type'      =>  \Elementor\Controls_Manager::COLOR,
	            'selectors' => 	[
					            	'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-title' => 'color: {{VALUE}};',
					        	],
        	] 
        );


        $this->add_group_control( 
        	 \Elementor\Group_Control_Typography::get_type(), 
        	[
	            'name'     => 'service_title_typography',
	            'selector' => '{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-title',
	        ] 
	    );
	    $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'service_title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-title',
			]
		);

		$this->add_responsive_control(
			'title_space_bottom',
			[
				'label' => esc_html__( 'Spacing Bottom', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	/**
	 * title control on service widget.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function service_widget_summary_section() {
		$this->start_controls_section(
			'summary_section',
			[
				'label' 	=> esc_html__( 'Content', 'codexin-elementor-addons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'service_summary',
			[
				'label' 		=> esc_html__( 'Service short description', 'codexin-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'input_type' 	=> 'text',
				'default' 		=> esc_html__( 'Leverage agile frameworks to provide a robust synopsis for high level overviews.', 'codexin-elementor-addons' ),
			]
		);


		$this->add_responsive_control(
			'service_summary_content_align',
			[
				'label' => esc_html__( 'Alignment', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'codexin-elementor-addons' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile'  ],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-summary' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 
		 	'section_service_summary_style', 
		 	[
            	'label' =>	 esc_html__( 'Content', 'codexin-elementor-addons' ),
            	'tab'   =>	\Elementor\Controls_Manager::TAB_STYLE,
        	] 
        );

		
	    $this->add_control( 
	    	'service_summary_text_color', 
	    	[
	            'label'     => 	esc_html__( 'Color', 'codexin-elementor-addons' ),
	            'type'      =>  \Elementor\Controls_Manager::COLOR,
	            'selectors' => 	[
					            	'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-summary' => 'color: {{VALUE}};',
					        	],
        	] 
        );
        $this->add_group_control( 
        	 \Elementor\Group_Control_Typography::get_type(), 
        	[
	            'name'     => 'summary_typography',
	            'selector' => '{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-summary',
	        ] 
	    );

		$this->add_responsive_control(
			'summary_space_bottom',
			[
				'label' => esc_html__( 'Spacing Bottom', 'codexin-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .codexin-elementor-addons-service .codexin-elementor-addons-service-summary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

}