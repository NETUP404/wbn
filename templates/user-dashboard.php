<?php
/* Template Name: Panel de Usuario */

get_header();
?>

<div class="wrap">
    <h1>Panel de Usuario</h1>
    <div class="wbn-dashboard">
        <?php echo do_shortcode('[wbn_user_dashboard]'); ?>
    </div>
</div>

<?php get_footer(); ?>
