<?php

class WBN_Credits {
    private static $instance = null;

    private function __construct() {
        add_action('wp_loaded', array($this, 'track_banner_impressions'));
        add_action('wp_loaded', array($this, 'track_banner_clicks'));
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function track_banner_impressions() {
        // Lógica para rastrear impresiones de banners
        $this->grant_credits('impression');
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
}

WBN_Credits::get_instance();
