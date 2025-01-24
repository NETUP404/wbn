<?php

class WBN_Credits {
    public function __construct() {
        // Inicializar funciones de créditos
        add_action('wp_loaded', array($this, 'track_banner_impressions'));
        add_action('wp_loaded', array($this, 'track_banner_clicks'));
    }

    public function track_banner_impressions() {
        // Lógica para rastrear impresiones de banners
    }

    public function track_banner_clicks() {
        // Lógica para rastrear clics en banners
    }
}

new WBN_Credits();
