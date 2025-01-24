<?php
/* Template Name: Panel de Usuario */

get_header();
?>

<div class="wrap">
    <h1>Panel de Usuario</h1>
    <div class="wbn-dashboard">
        <?php
        function wbn_render_user_dashboard() {
            $user_id = get_current_user_id();
            echo '<h2>Bienvenido, ' . get_the_author_meta('display_name', $user_id) . '!</h2>';
            echo '<p>Tus Banners: </p>';
        }

        wbn_render_user_dashboard();
        ?>
    </div>
</div>

<?php get_footer(); ?>
