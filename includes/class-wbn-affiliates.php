<?php

class WBN_Affiliates {
    private static $instance = null;

    private function __construct() {
        add_action('init', array($this, 'generate_affiliate_url'));
        add_action('wp_ajax_redeem_affiliate_token', array($this, 'redeem_affiliate_token'));
        add_action('wp_ajax_nopriv_redeem_affiliate_token', array($this, 'redeem_affiliate_token'));
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function generate_affiliate_url() {
        $user_id = get_current_user_id();
        $affiliate_url = home_url('/?aff=' . $user_id);
        update_user_meta($user_id, '_affiliate_url', $affiliate_url);
    }

    public function redeem_affiliate_token() {
        if (!isset($_POST['token']) || !isset($_POST['user_id'])) {
            wp_send_json_error('Invalid request');
        }

        $token = sanitize_text_field($_POST['token']);
        $user_id = intval($_POST['user_id']);

        // Lógica para redimir el token de afiliado
        $points = 1200; // Puntos por afiliado
        $credits = get_user_meta($user_id, '_user_credits', true);
        $credits += $points;
        update_user_meta($user_id, '_user_credits', $credits);

        wp_send_json_success('Affiliate token redeemed successfully');
    }
}

WBN_Affiliates::get_instance();
