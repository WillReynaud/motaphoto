<?php
$categories = wp_get_object_terms(get_the_ID(), 'categorie');

if ($categories) {
    $args = array(
        'post_type' => 'photo',
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'term_id',
                'terms'    => $categories[0]->term_id,
            ),
        ),
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => 2,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/photo-card');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucune autre photo trouvée dans cette catégorie.</p>';
    endif;
} else {
    echo '<p>Aucune catégorie associée à cette photo.</p>';
}