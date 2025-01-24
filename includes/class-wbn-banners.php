<?php

class WBN_Banners {
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_banner_meta_boxes'));
        add_action('save_post', array($this, 'save_banner_meta'));
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
}

new WBN_Banners();
