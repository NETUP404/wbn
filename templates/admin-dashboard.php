<?php
/* Template Name: Panel Admin */

get_header();
?>

<div class="wrap">
    <h1>Panel Admin</h1>
    <div class="wbn-dashboard">
        <?php echo do_shortcode('[wbn_admin_dashboard]'); ?>
    </div>
</div>

<?php get_footer(); ?>
