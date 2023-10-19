<?php

/**
 * Plugin Name: Go Essential Elementor
 * Description: Elementor custom widgets from Eessential Web Apps.
 * Plugin URI:  https://govindahal.com.np/
 * Version:     1.0.0
 * Author:      Govinda Dahal
 * Author URI:  https://govindahal.com.np/
 * Text Domain: go-essential-elementor
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

// Exit if accessed directly.
if (!defined('ABSPATH'))
    exit;

if (!defined('GOEE_PBNAME'))
    define('GOEE_PBNAME', plugin_basename(__FILE__));
if (!defined('GOEE_PATH'))
    define('GOEE_PATH', plugin_dir_path(__FILE__));
if (!defined('GOEE_ADMIN'))
    define('GOEE_ADMIN', GOEE_PATH . 'admin/');
if (!defined('GOEE_ADMIN_URL'))
    define('GOEE_ADMIN_URL', plugins_url('/', __FILE__) . 'admin/');
if (!defined('GOEE_ELEMENTS'))
    define('GOEE_ELEMENTS', GOEE_PATH . 'elements/');
if (!defined('GOEE_EXTENSIONS'))
    define('GOEE_EXTENSIONS', plugin_dir_path(__FILE__) . 'extensions/');
if (!defined('GOEE_TEMPLATES'))
    define('GOEE_TEMPLATES', GOEE_PATH . 'includes/template-parts/');
if (!defined('GOEE_URL'))
    define('GOEE_URL', plugins_url('/', __FILE__));
if (!defined('GOEE_ASSETS_URL'))
    define('GOEE_ASSETS_URL', GOEE_URL . 'assets/');
if (!defined('GOEE_PLUGIN_VERSION'))
    define('GOEE_PLUGIN_VERSION', '1.0.0');
if (!defined('MINIMUM_ELEMENTOR_VERSION'))
    define('MINIMUM_ELEMENTOR_VERSION', '2.0.0');
if (!defined('MINIMUM_PHP_VERSION'))
    define('MINIMUM_PHP_VERSION', '8.0');
if (!defined('GOEE_TEXTDOMAIN')) 
    define('GOEE_TEXTDOMAIN', 'go-essential-elementor');

function goee_initiate_plugin()
{

    // Check if Elementor installed and activated
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', 'goee_admin_notice_missing_elementor');
        return;
    }

    // Check for required Elementor version
    if (!version_compare(ELEMENTOR_VERSION, MINIMUM_ELEMENTOR_VERSION, '>=')) {
        add_action('admin_notices', 'goee_admin_notice_minimum_elementor_version');
        return;
    }

    // Check for required PHP version
    if (version_compare(PHP_VERSION, MINIMUM_PHP_VERSION, '<')) {
        add_action('admin_notices', 'goee_admin_notice_minimum_php_version');
        return;
    }
}
add_action('plugins_loaded', 'goee_initiate_plugin');
function goee_register_widget($widgets_manager)
{

    // include the widget file
    require_once( GOEE_PATH . 'classes/Helper.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Testimonial_Addon.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Accordion.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Pricing_Table.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Progressbar.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Iconbox.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Image_Carousel.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Gallery_Slider.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Flipbox.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Button.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Dual_Button.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Post_Grid.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Business_Hours.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Dropcap.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Heading.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Alert.php' );
    require_once( GOEE_PATH . 'widgets/GOEE_Contact_Form_7.php' );

    // require_once(__DIR__ . '/widgets/GOEE_Countdown.php');
    // $widgets_manager->register(new GOEE_Countdown());

    // register the widget
    $widgets_manager->register(new GOEE_Testimonial_Addon());
    $widgets_manager->register(new GOEE_Accordion());
    $widgets_manager->register(new GOEE_Pricing_Table());
    $widgets_manager->register(new GOEE_Progressbar());
    $widgets_manager->register(new GOEE_Iconbox());
    $widgets_manager->register(new GOEE_Image_Carousel());
    $widgets_manager->register(new GOEE_Gallery_Slider());
    $widgets_manager->register(new GOEE_Flipbox());
    $widgets_manager->register(new GOEE_Button());
    $widgets_manager->register(new GOEE_Dual_Button());
    $widgets_manager->register(new GOEE_Post_Grid());
    $widgets_manager->register(new GOEE_Business_Hours());
    $widgets_manager->register(new GOEE_Dropcap());
    $widgets_manager->register(new GOEE_Heading());
    $widgets_manager->register(new GOEE_Alert());
    $widgets_manager->register(new GOEE_Contact_Form_7());
}
add_action('elementor/widgets/register', 'goee_register_widget');

function goee_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'goee-category',
		[
			'title' => esc_html__( 'GOEE Category', 'go-essential-elementor' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'goee_add_elementor_widget_categories' );

function goee_frontend_stylesheets() {

	wp_register_style( 'goee-style-1', GOEE_ASSETS_URL.'css/goee-style.css' );

	wp_enqueue_style( 'goee-style-1' );

}
add_action( 'elementor/frontend/after_enqueue_styles', 'goee_frontend_stylesheets' );

function goee_frontend_scripts() {

	wp_register_script( 'goee-script-1', GOEE_ASSETS_URL.'js/goee-script.js', array(), false, true );

	wp_enqueue_script( 'goee-script-1' );
}
add_action( 'elementor/frontend/after_register_scripts', 'goee_frontend_scripts' );


/**
 * Admin notice
 * Warning when the site doesn't have Elementor installed or activated.
 *
 * @since 1.0.0
 *
 * @access public
 */
function goee_admin_notice_missing_elementor()
{

    $message = sprintf(
        __('%1$s requires %2$s to be installed and activated to function properly. %3$s', 'go-essential-elementor'),
        '<strong>' . __('GO Essential Elementor', 'go-essential-elementor') . '</strong>',
        '<strong>' . __('Elementor', 'go-essential-elementor') . '</strong>',
        '<a href="' . esc_url(admin_url('plugin-install.php?s=Elementor&tab=search&type=term')) . '">' . __('Please click here to install/activate Elementor', 'go-essential-elementor') . '</a>'
    );

    printf('<div class="notice notice-warning is-dismissible"><p style="padding: 5px 0">%1$s</p></div>', $message);
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
function goee_admin_notice_minimum_elementor_version()
{

    if (isset($_GET['activate']))
        unset($_GET['activate']);

    $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
        esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'go-essential-elementor'),
        '<strong>' . esc_html__('GO Essential Elementor', 'go-essential-elementor') . '</strong>',
        '<strong>' . esc_html__('Elementor', 'go-essential-elementor') . '</strong>',
        MINIMUM_ELEMENTOR_VERSION
    );

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
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
function goee_admin_notice_minimum_php_version()
{

    if (isset($_GET['activate']))
        unset($_GET['activate']);

    $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
        esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'go-essential-elementor'),
        '<strong>' . esc_html__('GO Essential Elementor', 'go-essential-elementor') . '</strong>',
        '<strong>' . esc_html__('PHP', 'go-essential-elementor') . '</strong>',
        MINIMUM_PHP_VERSION
    );

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
}
