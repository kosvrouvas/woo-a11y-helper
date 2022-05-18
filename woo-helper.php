<?php

/**
 * Woo a11y Helper
 *
 * @package       WOOHELPER
 * @author        Kostas Vrouvas
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Woo a11y Helper
 * Plugin URI:    
 * Description:   Fix somne a11y issues showing up in Wave a11y Checker by overriding the official Woo templates from a plugin instead. Useful for ipdating many installations at once and want one place to update the template after a WooCommerce update.
 * Version:       1.0.0
 * Author:        Kostas Vrouvas, Analogue
 * Author URI:    https://kosvrouvas.dev
 * Text Domain:   woo-a11y-helper
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Override WooCommerce templates from our plugin, the WooCommerce way.
 */
add_filter( 'woocommerce_locate_template', 'intercept_wc_template', 10, 3 );
/**
 *
 * @param string $template      Default template file path.
 * @param string $template_name Template file slug.
 * @param string $template_path Template file name.
 *
 * @return string The new Template file path.
 */
function intercept_wc_template( $template, $template_name, $template_path ) {

	$template_directory = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'woocommerce/';
	$path = $template_directory . $template_name;

	return file_exists( $path ) ? $path : $template;

}