class-wbn-report<?php

class WBN_Reports {
    public function __construct() {
        // Inicializar funciones de reportes
        add_shortcode('wbn_user_dashboard', array($this, 'render_user_dashboard'));
    }

    public function render_user_dashboard() {
        // Renderizar el panel de usuario
        ob_start();
        echo '<div class="wbn-dashboard"><h2>Panel de Usuario</h2></div>';
        return ob_get_clean();
    }
}

new WBN_Reports();s.php
