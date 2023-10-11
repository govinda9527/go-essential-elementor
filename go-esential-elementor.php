<?php
/**
 * Plugin Name: Go Essential Elementor
 * Description: Elementor custom widgets from Eessential Web Apps.
 * Plugin URI:  https://govindahal.com.np/
 * Version:     1.0.0
 * Author:      Govinda Dahal
 * Author URI:  https://govindahal.com.np/
 * Text Domain: go-ee
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function goee_register_widget( $widgets_manager ) {

    // include the widget file
    require_once( __DIR__ . '/widgets/GOEE_Testimonial_Addon.php' );  
    require_once( __DIR__ . '/classes/Helper.php' );  


    // register the widget
    $widgets_manager->register( new GOEE_Testimonial_Addon() );

}
add_action( 'elementor/widgets/register', 'goee_register_widget' );