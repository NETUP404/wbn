<?php
/*
Plugin Name: WeBanner
Description: Plugin de intercambio de banners donde los usuarios pueden ganar puntos basados en impresiones y clics.
Version: 1.0
Author: NETUP404
*/

// Evitar el acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Incluir archivos necesarios
require_once plugin_dir_path(__FILE__) . 'includes/class-wbn-registry.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-wbn-banners.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-wbn-credits.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-wbn-reports.php';

// Iniciar el plugin
function wbn_init() {
    WBN_Registry::get_instance();
}
add_action('plugins_loaded', 'wbn_init');
