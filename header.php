<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="nav-bar">
        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Logo de Nathalie Mota">
        <nav class="menu">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-principal',
                'container'      => 'ul',
                'menu_class'     => 'menu-wp',
            ));
            ?>
        </nav>
        <div class="burger-btn">
            <div class="burger-icon"></div>
        </div>
    </div>
    <nav class="menu-overlay">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-principal',
                'container'      => 'ul',
                'menu_class'     => 'menu-wp-overlay',
            ));
            ?>
        </nav>
    <section class="hero">
        <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/img/hero.png" alt="Photographie événementielle par Nathalie Mota">
    </section>
</header>