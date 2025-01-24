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
require_once plugin_dir_path(__FILE__) . 'includes/class-wbn-affiliates.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-wbn-bank.php';

// Crear páginas automáticamente al activar el plugin
function wbn_create_pages() {
    if (get_page_by_path('panel-de-usuario') == null) {
        $user_dashboard_page = array(
            'post_title'    => 'Panel de Usuario',
            'post_content'  => '', 
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );
        $page_id = wp_insert_post($user_dashboard_page);
        if (!is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'user-dashboard.php');
        }
    }
    if (get_page_by_path('panel-admin') == null) {
        $admin_dashboard_page = array(
            'post_title'    => 'Panel Admin',
            'post_content'  => '', 
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );
        $page_id = wp_insert_post($admin_dashboard_page);
        if (!is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'admin-dashboard.php');
        }
    }
}
register_activation_hook(__FILE__, 'wbn_create_pages');

// Iniciar el plugin
function wbn_init() {
    WBN_Registry::get_instance();
    WBN_Banners::get_instance();
    WBN_Credits::get_instance();
    WBN_Reports::get_instance();
    WBN_Affiliates::get_instance();
    WBN_Bank::get_instance();
}
add_action('plugins_loaded', 'wbn_init');

// Asegurar que todos los usuarios sean suscriptores por defecto
function wbn_set_default_user_role() {
    add_filter('default_role', function() {
        return 'subscriber';
    });
}
add_action('init', 'wbn_set_default_user_role');
