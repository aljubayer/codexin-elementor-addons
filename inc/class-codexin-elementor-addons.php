<?php
/**
 * Plugin required initializations.
 *
 * @package     Codexin Elementor Addons
 * @category    Elementor Extension
 * @since       1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Plugin loader class.
 *
 * @since 1.0
 */

final class Codexin_Elementor_Addons {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';	
	

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Codexin_Elementor_Addons The single instance of the class.
	 */
	private static $_instance = null;
	
	/**
	 * Widget enqueue list.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 *
	 * @var array  enqueue php file list.
	 */

	private $widget_enqueue_list = array(
		'inc/widgets/class-codexin-elementor-service.php', 
	);


	/**
	 * Widget list.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 *
	 * @var array widget list to register.
	 */
	
	private $widget_list = array(
		'\Codexin_Elementor_Service', 
	);

	/**
	 * Style list.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 *
	 * @var array styles to register.
	 */
	
	private $style_list = array(
			array(
				'handle'	=> 'bootstrap',
				'src'		=> CODEXIN_ELEMENTOR_ASSETS_BASE_URI . 'assets/vendor/bootstrap-4.2.1/css/bootstrap.min.css',
				'deps'		=> array(),
				'ver'		=> '4.2.1',
				'media'		=> 'all'
			),
			array(
				'handle'	=> 'codexin-elementor-addons-styles',
				'src'		=> CODEXIN_ELEMENTOR_ASSETS_BASE_URI . 'assets/css/styles.css',
				'deps'		=> array(),
				'ver'		=> '4.2.1',
				'media'		=> 'all'
			),

		);	

	/**
	 * Script list.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 *
	 * @var array scripts to register.
	 */
	
	private $script_list = array(
			array(
				'handle' 	=> 'popper',
				'src' 		=> CODEXIN_ELEMENTOR_ASSETS_BASE_URI . 'assets/vendor/popper/js/popper.min.js',
				'deps' 		=> array( 'jquery' ),
				'ver'		=> '1.14.6',
				'in_footer'	=> true
			),
			array(
				'handle' 	=> 'bootstrap',
				'src' 		=> CODEXIN_ELEMENTOR_ASSETS_BASE_URI . 'assets/vendor/bootstrap-4.2.1/js/bootstrap.min.js',
				'deps' 		=> array( 'jquery','popper' ),
				'ver'		=> '4.2.1',
				'in_footer'	=> true
			),
		);

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	 	add_action( 'elementor/init', array( $this, 'add_codexin_in_elementor_category' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
	 	add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_frontend_scripts' ), 10 );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_frontend_styles' ), 10 );
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_frontend_styles' ), 10 );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'codexin-elementor-addons' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

	}

	/**
	 * Add new category.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
    public function add_codexin_in_elementor_category() {

		\Elementor\Plugin::instance()->elements_manager->add_category( 'codexin-addons', array(
			'title' => __( 'Codexin Addons', 'codexin-elementor-addons' ),
			'icon'  => 'fa fa-plug',
		), 1 );
	}

	/**
	 * Register frontend scripts.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_frontend_scripts() {

		foreach ( $this->script_list as $key => $value) {
			if( true === wp_script_is( $value['handle'], $list = 'registered' ) ){
				continue;
			}
			wp_register_script(
				$value['handle'],
				$value['src'],
				$value['deps'],
				$value['ver'],
				$value['in_footer']
			);	
		}
	}

	/**
	 * Register frontend styles.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_frontend_styles() {

		foreach ( $this->style_list as $key => $value ) {
			if( true === wp_style_is( $value['handle'], $list = 'registered' ) ) {
				continue;
			}

			wp_register_style(
				 	$value['handle'], 
				 	$value['src'], 
				 	$value['deps'], 
				 	$value['ver'], 
				 	$value['media'] 
				);
		}

	}

	/**
	 * Enqueue frontend styles.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function enqueue_frontend_styles() {

		foreach ( $this->style_list as $key => $value ) {
			if( true === wp_style_is( $value['handle'], $list = 'enqueued' ) ) {				
				continue;
			}
			wp_enqueue_style( $value['handle'] );			
		}
		
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'codexin-elementor-addons' ),
			'<strong>' . esc_html__( 'Codexin Elementor Addons', 'codexin-elementor-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'codexin-elementor-addons' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'codexin-elementor-addons' ),
			'<strong>' . esc_html__( 'Codexin Elementor Addons', 'codexin-elementor-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'codexin-elementor-addons' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'codexin-elementor-addons' ),
			'<strong>' . esc_html__( 'Codexin Elementor Addons', 'codexin-elementor-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'codexin-elementor-addons' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets.
	 *
	 * Include widgets files and register them.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files.
		foreach ( $this->widget_enqueue_list as $key => $value ) {
			require_once( CODEXIN_ELEMENTOR_ADDONS_DIR . $value );
		}
		
		// Register widget.
		foreach ($this->widget_list as $key => $value) {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $value );
		}

	}

}