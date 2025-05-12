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

    // Select2 CSS
    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');

     // Select2 JS
     wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), null, true);

    // Charger le JavaScript principal
    wp_enqueue_script('motaphoto-script', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);

    // Transmettre ajaxurl à JS
    wp_localize_script('motaphoto-script', 'ajaxurl', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_assets');


// AJAX -----
add_action('wp_ajax_charger_plus_photos', 'charger_plus_photos');
add_action('wp_ajax_nopriv_charger_plus_photos', 'charger_plus_photos');

function charger_plus_photos() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/photo-card'); // pour afficher 1 photo
        }
        wp_reset_postdata();
        $html = ob_get_clean();
        wp_send_json($html);
        //echo $html;
    }

    wp_die(); // termine proprement
}

add_action('wp_ajax_filtrer_photos', 'filtrer_photos');
add_action('wp_ajax_nopriv_filtrer_photos', 'filtrer_photos');

function filtrer_photos() {
    $category = sanitize_text_field($_POST['category']);
    $format = sanitize_text_field($_POST['format']);
    $sort = sanitize_text_field($_POST['sort']); // "ASC" ou "DESC"

    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => in_array($sort, ['ASC', 'DESC']) ? $sort : 'DESC',
    ];

    $tax_query = [];

    if ($category) {
        $tax_query[] = [
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $category,
        ];
    }

    if ($format) {
        $tax_query[] = [
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        ];
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/photo-card');
        }
    } else {
        echo '<p>Aucune photo trouvée pour cette combinaison.</p>';
    }

    wp_reset_postdata();
    wp_send_json(ob_get_clean());
}