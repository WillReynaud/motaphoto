<?php
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        get_template_part('template-parts/photo-card');
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>Aucune photo trouvée pour cette combinaison.</p>';
endif;
?>