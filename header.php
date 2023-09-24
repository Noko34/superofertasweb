<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= esc_url(get_site_icon_url()); ?>" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header role="banner">
        <div class="container">
            <div class="logo-header">
                <a href="<?= esc_url(home_url('/')); ?>">
                    <img src="<?= esc_url(get_template_directory_uri()); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div class="site-title">
                <?php bloginfo('name'); ?>
            </div>
            <p><?php bloginfo('description'); ?></p>
            <?php mi_barra_busqueda(); ?>
            <nav>
                <?php wp_nav_menu(['theme_location' => 'menu-principal']); ?>
            </nav>
        </div>
    </header>
