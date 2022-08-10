<?php

/**
 * WooHelper
 *
 * @package       WOOHELPER
 * @author        Kostas Vrouvas
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   WooHelper
 * Plugin URI:    
 * Description:   Fix someissues showing up in WaveChecker by overriding the official Woo templates from a plugin instead. Useful for ipdating many installations at once and want one place to update the template after a WooCommerce update.
 * Version:       1.0.0
 * Author:        Kostas Vrouvas, Analogue
 * Author URI:    https://kosvrouvas.dev
 * Text Domain:   woo-helper
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Override WooCommerce templates from our plugin, the WooCommerce way.
 */
add_filter('woocommerce_locate_template', 'intercept_wc_template', 10, 3);
/**
 *
 * @param string $template      Default template file path.
 * @param string $template_name Template file slug.
 * @param string $template_path Template file name.
 *
 * @return string The new Template file path.
 */
function intercept_wc_template($template, $template_name, $template_path)
{

	$template_directory = trailingslashit(plugin_dir_path(__FILE__)) . 'woocommerce/';
	$path = $template_directory . $template_name;

	return file_exists($path) ? $path : $template;
}

add_filter('woocommerce_get_country_locale', 'custom_nz_locale');
function custom_nz_locale($locale)
{
	$locale['GR']['state']['required'] = true;
	return $locale;
}