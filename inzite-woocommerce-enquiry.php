<?php
/*
Plugin Name: Inzite Woocommerce Enquiry
Plugin URI:  http://inzite.dk
Description: Turn Woocommerce into an equiry system.
Version:     1.0.0
Author:      Inzite Media
Author URI:  http://inzite.dk
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: inzite-woocommerce-enquiry
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function inzite_enquiry_load_plugin_textdomain() {
  load_plugin_textdomain( 'inzite-woocommerce-enquiry', FALSE, basename( dirname( __FILE__ ) ) . '/' );
}
add_action( 'plugins_loaded', 'inzite_enquiry_load_plugin_textdomain' );


// Create form shortcode and swap it with the woocommerce_cart shortcode
function overwrite_shortcode_woocommerce_cart(){
	remove_shortcode('woocommerce_cart');
	function submit_form_func( $atts ){
		include( plugin_dir_path( __FILE__ ) . 'includes/mail.php');
		include( plugin_dir_path( __FILE__ ) . 'includes/submit-form.php');
	}
	add_shortcode( 'woocommerce_cart', 'submit_form_func' );
}

add_action( 'wp_loaded', 'overwrite_shortcode_woocommerce_cart' );

add_action('plugins_loaded','alter_wc_default_templates');
function alter_wc_default_templates() {
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}

// Add "Add to Enquiry" Button to sigle produkts
add_action('woocommerce_single_product_summary', 'single_add_enquiry_item_to_cart', 30);
function single_add_enquiry_item_to_cart() {
  echo '<button class="add_to_enqiry_button btn btn-brand" id="' . get_the_ID() . '" data-productname="' . get_the_title() . '" data-productpermalink="' . get_the_permalink() . '">' . __('Add to Enquiry','inzite-woocommerce-enquiry') . '</button>';
}

// Add "Add to Enquiry" Button to sigle produkts
add_action('woocommerce_after_shop_loop_item', 'archive_add_enquiry_item_to_cart', 30);
function archive_add_enquiry_item_to_cart() {
  echo '<button class="add_to_enqiry_button btn btn-brand" id="' . get_the_ID() . '" data-productname="' . get_the_title() . '" data-productpermalink="' . get_the_permalink() . '">' . __('Add to Enquiry','inzite-woocommerce-enquiry') . '</button>';
}

/**
 * Include scripts
 */
function inzite_woocommerce_enquiry_scripts() {
	wp_register_style( 'inzite-woocommerce-enquiry', plugins_url( 'inzite-woocommerce-enquiry/css/inzite-woocommerce-enquiry.css' ) );
	wp_enqueue_style( 'inzite-woocommerce-enquiry' );

	wp_enqueue_script( 'equiry-script', plugins_url( ) . '/inzite-woocommerce-enquiry/js/enquiry.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-cookie', plugins_url( ) . '/inzite-woocommerce-enquiry/js/jquery.cookie.js', array('jquery'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'inzite_woocommerce_enquiry_scripts' );
