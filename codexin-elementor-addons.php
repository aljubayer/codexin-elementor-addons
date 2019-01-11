<?php
/*
 * Plugin Name:  Codexin Elementor Addons
 * Plugin URI:   https://themeitems.com/
 * Description:  Elementor Addons For Power Pro Wordpress Theme
 * Version:      1.0.0
 * Author:       Codexin
 * Author URI:   https://codexin.com/
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  codexin-elementor-addons
 * Domain Path:  /languages/
 *
 * @package     Codexin Elementor Addons
 * @category    Elementor Addons
 * @since       1.0
 */

if ( defined( 'ABSPATH' ) && ! defined( 'CODEXIN_ELEMENTOR_EXT' ) ) {

	/**
	 * Plugin directiory initialization.
	 *
	 * @since 1.0.0
	 *
	 * @var string plugin directory.
	 */
	define( 'CODEXIN_ELEMENTOR_ADDONS_DIR', trailingslashit( wp_normalize_path( trailingslashit( plugin_dir_path( __FILE__ ) ) ) ) );

	
	require_once CODEXIN_ELEMENTOR_ADDONS_DIR . 'inc/class-codexin-elementor-addons.php';

	// Initializing the plugin.
	Codexin_Elementor_Addons::instance();
}