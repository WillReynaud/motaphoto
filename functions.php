<?php

function motaphoto_register_menus() {
    register_nav_menus(array(
        'menu-principal' => __('Menu Principal', 'motaphoto'),
        'menu-footer' => __('Menu Footer', 'motaphoto'),
    ));
}
add_action('after_setup_theme', 'motaphoto_register_menus');

function motaphoto_enqueue_assets() {
    // Charger le CSS principal
    wp_enqueue_style('motaphoto-style', get_stylesheet_directory_uri() . '/assets/css/style.css');

    // Charger le JavaScript
    wp_enqueue_script('motaphoto-script', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_assets');