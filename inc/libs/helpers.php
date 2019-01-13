<?php


if ( ! function_exists( 'codexin_elementor_addons_title_heading_options' ) ) {
	function codexin_elementor_addons_title_heading_options() {
		return  [
		            'h1'  => __( 'H1', 'codexin-elementor-addons' ),
		            'h2'  => esc_html__( 'H2', 'codexin-elementor-addons' ),
		            'h3'  => esc_html__( 'H3', 'codexin-elementor-addons' ),
		            'h4'  => esc_html__( 'H4', 'codexin-elementor-addons' ),
		            'h5'  => esc_html__( 'H5', 'codexin-elementor-addons' ),
		            'h6'  => esc_html__( 'H6', 'codexin-elementor-addons' ),
		            'div' => esc_html__( 'div', 'codexin-elementor-addons' ),
		        ];
	}
}