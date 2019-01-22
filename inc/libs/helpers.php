<?php


if ( ! function_exists( 'codexin_elementor_addons_title_heading_options' ) ) {
	function codexin_elementor_addons_title_heading_options() {
		return  [
		            'h1'  => esc_html__( 'H1', 'codexin-elementor-addons' ),
		            'h2'  => esc_html__( 'H2', 'codexin-elementor-addons' ),
		            'h3'  => esc_html__( 'H3', 'codexin-elementor-addons' ),
		            'h4'  => esc_html__( 'H4', 'codexin-elementor-addons' ),
		            'h5'  => esc_html__( 'H5', 'codexin-elementor-addons' ),
		            'h6'  => esc_html__( 'H6', 'codexin-elementor-addons' ),
		        ];
	}
}

if ( ! function_exists( 'codexin_elementor_addons_latest_blog_layout_options' ) ) {
	function codexin_elementor_addons_latest_blog_layout_options() {
		return  [
		            'col-1 col-sm-3, col-1 col-sm-3, col-1 col-sm-3, col-1 col-sm-3'	=> esc_html__( '1-1-1-1', 'codexin-elementor-addons' ),
		            'col-1 col-sm-6, col-1 col-sm-3, col-1 col-sm-3'  					=> esc_html__( '2-1-1', 'codexin-elementor-addons' ),
		            'col-1 col-sm-3, col-1 col-sm-6, col-1 col-sm-3'  					=> esc_html__( '1-2-1', 'codexin-elementor-addons' ),
		            'col-1 col-sm-3, col-1 col-sm-3, col-1 col-sm-6'  					=> esc_html__( '1-1-2', 'codexin-elementor-addons' ),
		            'col-1 col-sm-4, col-1 col-sm-4, col-1 col-sm-4' 					=> esc_html__( '1-1-1', 'codexin-elementor-addons' ),
		        ];
	}
}

if ( ! function_exists( 'codexin_elementor_addons_number_input_options' ) ) {
	function codexin_elementor_addons_number_input_options() {
		return  [
		            '1'  => esc_html__( '1', 'codexin-elementor-addons' ),
		            '2'  => esc_html__( '2', 'codexin-elementor-addons' ),
		            '3'  => esc_html__( '3', 'codexin-elementor-addons' ),
		            '4'  => esc_html__( '4', 'codexin-elementor-addons' ),
		            '5'  => esc_html__( '5', 'codexin-elementor-addons' ),
		            '6'  => esc_html__( '6', 'codexin-elementor-addons' ),
		            '7'  => esc_html__( '7', 'codexin-elementor-addons' ),
		            '8'  => esc_html__( '8', 'codexin-elementor-addons' ),
		            '9'  => esc_html__( '9', 'codexin-elementor-addons' ),
		        ];
	}
}

if ( ! function_exists( 'codexin_elementor_addons_the_excerpt' ) ) {
	function codexin_elementor_addons_the_excerpt( $before='', $after='', $limit_words='55' ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit_words);
		
		if ( count( $excerpt ) >= $limit_words ) {
			array_pop($excerpt);
			$excerpt = implode( " ", $excerpt ) . '';
		} else {
			$excerpt = implode(" ", $excerpt );
		}	
		
		$excerpt = preg_replace( '`\[[^\]]*\]`' , '' , $excerpt );
		echo $before;
		echo $excerpt;
		echo $after;
	}
}