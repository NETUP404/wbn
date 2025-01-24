<?php

class WBN_Registry {
    private static $instance = null;

    private function __construct() {
        add_action('init', array($this, 'register_custom_post_types'));
        add_action('admin_menu', array($this, 'add_admin_pages'));
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function register_custom_post_types() {
        register_post_type('wbn_banner', array(
            'labels' => array(
                'name' => __('Banners', 'webanner'),
                'singular_name' => __('Banner', 'webanner')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'banners'),
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        ));
    }

    public function add_admin_pages() {
        add_menu_page('WeBanner', 'WeBanner', 'manage_options', 'webanner', array($this, 'admin_dashboard'), 'dashicons-admin-generic', 6);
        add_submenu_page('webanner', 'Campañas', 'Campañas', 'manage_options', 'webanner-campaigns', array($this, 'admin_campaigns_page'));
        add_submenu_page('webanner', 'Afiliados', 'Afiliados', 'manage_options', 'webanner-affiliates', array($this, 'admin_affiliates_page'));
        add_submenu_page('webanner', 'Banca', 'Banca', 'manage_options', 'webanner-bank', array($this, 'admin_bank_page'));
    }

    public function admin_dashboard() {
        include plugin_dir_path(__FILE__) . '../templates/admin-dashboard.php';
    }

    public function admin_campaigns_page() {
        include plugin_dir_path(__FILE__) . '../templates/admin-campaigns.php';
    }

    public function admin_affiliates_page() {
        include plugin_dir_path(__FILE__) . '../templates/admin-affiliates.php';
    }

    public function admin_bank_page() {
        include plugin_dir_path(__FILE__) . '../templates/admin-bank.php';
    }
}

// Inicializar la clase
WBN_Registry::get_instance();
    }
}
