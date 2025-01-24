<?php

class WBN_Banners {
    private static $instance = null;

    private function __construct() {
        add_action('add_meta_boxes', array($this, 'add_banner_meta_boxes'));
        add_action('save_post', array($this, 'save_banner_meta'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_track_banner_click', array($this, 'track_banner_click'));
        add_action('wp_ajax_nopriv_track_banner_click', array($this, 'track_banner_click'));
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function add_banner_meta_boxes() {
        add_meta_box('wbn_banner_meta', __('Detalles del Banner', 'webanner'), array($this, 'render_banner_meta_box'), 'wbn_banner', 'normal', 'high');
    }

    public function render_banner_meta_box($post) {
        wp_nonce_field('wbn_save_banner_meta', 'wbn_banner_meta_nonce');
        $url = get_post_meta($post->ID, '_wbn_banner_url', true);
        echo '<label for="wbn_banner_url">'.__('URL del Banner', 'webanner').'</label>';
        echo '<input type="text" id="wbn_banner_url" name="wbn_banner_url" value="'.esc_attr($url).'" size="25" />';
    }

    public function save_banner_meta($post_id) {
        if (!isset($_POST['wbn_banner_meta_nonce']) || !wp_verify_nonce($_POST['wbn_banner_meta_nonce'], 'wbn_save_banner_meta')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['wbn_banner_url'])) {
            update_post_meta($post_id, '_wbn_banner_url', sanitize_text_field($_POST['wbn_banner_url']));
        }
    }

    public function enqueue_scripts() {
        wp_enqueue_script('webanner-scripts', plugin_dir_url(__FILE__) . '../assets/js/scripts.js', array('jquery'), '1.0', true);
    }

    public function track_banner_click() {
        if (!isset($_POST['banner_id']) || !isset($_POST['user_id'])) {
            wp_send_json_error('Invalid request');
        }

        $banner_id = intval($_POST['banner_id']);
        $user_id = intval($_POST['user_id']);

        // Lógica para rastrear clics
        $clicks = get_post_meta($banner_id, '_banner_clicks', true);
        $clicks = $clicks ? $clicks + 1 : 1;
        update_post_meta($banner_id, '_banner_clicks', $clicks);

        wp_send_json_success('Click tracked successfully');
    }
}

new WBN_Banners();
