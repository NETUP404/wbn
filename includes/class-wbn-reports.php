<?php

class WBN_Reports {
    private static $instance = null;

    private function __construct() {
        add_shortcode('wbn_user_dashboard', array($this, 'render_user_dashboard'));
        add_shortcode('wbn_admin_dashboard', array($this, 'render_admin_dashboard'));
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function render_user_dashboard() {
        ob_start();
        $user_id = get_current_user_id();
        $credits = get_user_meta($user_id, '_user_credits', true);

        echo '<div class="wbn-dashboard">';
        echo '<h2>Puntos Totales: ' . esc_html($credits) . '</h2>';
        echo '<p>Puntos Ganados Hoy: ' . esc_html($this->get_credits_earned_today($user_id)) . '</p>';
        echo '<p>Puntos Ganados Últimos 7 Días: ' . esc_html($this->get_credits_earned_last_7_days($user_id)) . '</p>';
        echo '<p>Puntos Ganados Últimos 30 Días: ' . esc_html($this->get_credits_earned_last_30_days($user_id)) . '</p>';
        echo '</div>';

        return ob_get_clean();
    }

    public function render_admin_dashboard() {
        ob_start();

        echo '<div class="wbn-dashboard">';
        echo '<h2>Estadísticas Globales</h2>';
        echo '<p>Puntos Totales de Usuarios: ' . esc_html($this->get_total_user_credits()) . '</p>';
        echo '<p>Puntos Ganados Hoy: ' . esc_html($this->get_credits_earned_today()) . '</p>';
        echo '<p>Puntos Ganados Últimos 7 Días: ' . esc_html($this->get_credits_earned_last_7_days()) . '</p>';
        echo '<p>Puntos Ganados Últimos 30 Días: ' . esc_html($this->get_credits_earned_last_30_days()) . '</p>';
        echo '</div>';

        return ob_get_clean();
    }

    private function get_total_user_credits() {
        // Lógica para obtener los puntos totales de todos los usuarios
        global $wpdb;
        $total_credits = $wpdb->get_var("SELECT SUM(meta_value) FROM $wpdb->usermeta WHERE meta_key = '_user_credits'");
        return $total_credits ? $total_credits : 0;
    }

    private function get_credits_earned_today($user_id = null) {
        // Lógica para obtener los puntos ganados hoy
        // Implementar lógica específica según usuario o global
    }

    private function get_credits_earned_last_7_days($user_id = null) {
        // Lógica para obtener los puntos ganados en los últimos 7 días
        // Implementar lógica específica según usuario o global
    }

    private function get_credits_earned_last_30_days($user_id = null) {
        // Lógica para obtener los puntos ganados en los últimos 30 días
        // Implementar lógica específica según usuario o global
    }
}

WBN_Reports::get_instance();
