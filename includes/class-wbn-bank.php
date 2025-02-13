<?php

class WBN_Bank {
    private static $instance = null;

    private function __construct() {
        add_action('admin_menu', array($this, 'add_bank_page'));
        add_action('wp_ajax_print_points', array($this, 'print_points'));
        add_action('wp_ajax_generate_token', array($this, 'generate_token'));
        add_action('wp_ajax_redeem_token', array($this, 'redeem_token'));
        add_action('wp_ajax_nopriv_redeem_token', array($this, 'redeem_token'));
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function add_bank_page() {
        add_submenu_page('webanner', 'Banca', 'Banca', 'manage_options', 'webanner-bank', array($this, 'admin_bank_page'));
    }

    public function admin_bank_page() {
        echo '<div class="wrap">';
        echo '<h1>Panel de Banca</h1>';
        echo '<div class="wbn-dashboard">';
        echo '<h2>Ganancias de la Banca</h2>';
        echo '<p>Ganancias Totales: ' . esc_html($this->get_total_bank_earnings()) . '</p>';
        echo '<p>Ganancias Hoy: ' . esc_html($this->get_earnings_today()) . '</p>';
        echo '<p>Ganancias Últimos 7 Días: ' . esc_html($this->get_earnings_last_7_days()) . '</p>';
        echo '<p>Ganancias Últimos 30 Días: ' . esc_html($this->get_earnings_last_30_days()) . '</p>';
        echo '<button id="print-points">Imprimir Puntos</button>';
        echo '<button id="generate-token">Generar Token</button>';
        echo '</div>';
        echo '</div>';
    }

    public function print_points() {
        if (!isset($_POST['points'])) {
            wp_send_json_error('Invalid request');
        }

        $points = intval($_POST['points']);
        $bank_earnings = get_option('wbn_bank_earnings', 0);
        $bank_earnings += $points;
        update_option('wbn_bank_earnings', $bank_earnings);

        wp_send_json_success('Points printed successfully');
    }

    public function generate_token() {
        if (!isset($_POST['points'])) {
            wp_send_json_error('Invalid request');
        }

        $points = intval($_POST['points']);
        $token = bin2hex(random_bytes(16));
        $tokens = get_option('wbn_tokens', array());
        $tokens[$token] = $points;
        update_option('wbn_tokens', $tokens);

        wp_send_json_success(array('token' => $token, 'points' => $points));
    }

    public function redeem_token() {
        if (!isset($_POST['token']) || !isset($_POST['user_id'])) {
            wp_send_json_error('Invalid request');
        }

        $token = sanitize_text_field($_POST['token']);
        $user_id = intval($_POST['user_id']);
        $tokens = get_option('wbn_tokens', array());

        if (isset($tokens[$token])) {
            $points = $tokens[$token];
            unset($tokens[$token]);
            update_option('wbn_tokens', $tokens);

            $credits = get_user_meta($user_id, '_user_credits', true);
            $credits += $points;
            update_user_meta($user_id, '_user_credits', $credits);

            wp_send_json_success('Token redeemed successfully');
        } else {
            wp_send_json_error('Invalid token');
        }
    }

    private function get_total_bank_earnings() {
        return get_option('wbn_bank_earnings', 0);
    }

    private function get_earnings_today() {
        // Lógica para obtener las ganancias de hoy
    }

    private function get_earnings_last_7_days() {
        // Lógica para obtener las ganancias de los últimos 7 días
    }

    private function get_earnings_last_30_days() {
        // Lógica para obtener las ganancias de los últimos 30 días
    }
}

WBN_Bank::get_instance();
