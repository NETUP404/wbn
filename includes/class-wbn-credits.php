<?php

class WBN_Credits {
    private static $instance = null;

    private function __construct() {
        add_action('wp_loaded', array($this, 'track_banner_impressions'));
        add_action('wp_loaded', array($this, 'track_banner_clicks'));
        add_action('init', array($this, 'initialize_user_credits'));
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function initialize_user_credits() {
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $credits = get_user_meta($user_id, '_user_credits', true);
            if ($credits === '') {
                update_user_meta($user_id, '_user_credits', 400); // Otorgar 400 puntos al registrarse
            }
        }
    }

    public function track_banner_impressions() {
        // Lógica para rastrear impresiones de banners
        if (isset($_POST['banner_id'])) {
            $this->grant_credits('impression');
        }
    }

    public function track_banner_clicks() {
        // Lógica para rastrear clics en banners
        if (isset($_POST['banner_id'])) {
            $this->grant_credits('click');
        }
    }

    // Otorgar créditos basados en impresiones y clics
    private function grant_credits($type) {
        $user_id = get_current_user_id();
        $credits = get_user_meta($user_id, '_user_credits', true);
        $credits = $credits ? $credits : 0;

        if ($type === 'impression') {
            $credits += 3; // Puntos por impresión
        } elseif ($type === 'click') {
            $credits += 90; // Puntos por clic
        }

        update_user_meta($user_id, '_user_credits', $credits);

        // Descontar puntos para la banca
        $bank_credits = get_option('wbn_bank_credits', 0);
        $bank_credits += ($credits * 0.25);
        update_option('wbn_bank_credits', $bank_credits);
    }

    private function is_valid_request($type) {
        // Lógica para validar las solicitudes de impresiones y clics, evitando el fraude
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $cookie_name = 'wbn_' . $type . '_track';

        if (isset($_COOKIE[$cookie_name])) {
            $data = json_decode(stripslashes($_COOKIE[$cookie_name]), true);
            if (isset($data[$ip_address])) {
                $last_time = $data[$ip_address];
                $current_time = time();
                if (($current_time - $last_time) < 21600) { // 6 horas
                    return false; // Solicitud no válida
                }
            }
        }

        $data[$ip_address] = time();
        setcookie($cookie_name, json_encode($data), time() + 21600, COOKIEPATH, COOKIE_DOMAIN); // 6 horas

        return true; // Solicitud válida
    }
}

WBN_Credits::get_instance();
