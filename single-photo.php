<?php
get_header();
?>
    <?php while (have_posts()) : the_post(); ?>
    <section class="main-photo-container">
        <div class="photo-info-container">
            <h1 class="photo-title"><?php the_title(); ?></h1>
            <p class="description">
                Référence: <?php echo esc_html(get_field('reference')); ?> <br>
                Catégorie: <?php the_terms(get_the_ID(), 'categorie'); ?> <br>
                Catégorie: <?php the_terms(get_the_ID(), 'format'); ?> <br>
                Type: <?php echo esc_html(get_field('type_de_photo')); ?> <br>
                Année: <?php echo get_the_date('Y'); ?>
            </p>
            <div class="photo-info-btn-container">
                <p>Cette photo vous intéresse ?</p>
                <button class="myBtn2">Contact</button>
            </div>
        </div>
        <div class="photo-container">
            <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
            <div class="photo-preview-container">
                <div class="photo-preview">
                <?php
                    // Récupérer l'objet post suivant
                    $next_post = get_next_post();

                    // Vérifier si un post suivant existe
                    if ($next_post) {
                        // Afficher l'image mise en avant du post suivant
                        echo get_the_post_thumbnail($next_post->ID);
                    }
                    ?>
                </div>
                <div class="arrow-btns">
                    <a href="<?php echo get_permalink(get_previous_post()); ?>" class="arrow-btn arrow-left">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrowleft.png" alt="Précédent">
                    </a>
                     <a href="<?php echo get_permalink(get_next_post()); ?>" class="arrow-btn arrow-right">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrowright.png" alt="Suivant">
                    </a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    </section>

    <section class="other-pics-container">
        <h3>Vous aimerez aussi</h3>
        <div class="other-pics">
        <?php
        // Récupérer les catégories de l'article actuel
        $categories = wp_get_object_terms(get_the_ID(), 'categorie');

        if ($categories) {
            // Récupérer les articles de la même catégorie
            $args = array(
                'post_type' => 'photo', // Remplacez 'post' par le type de publication de vos photos si nécessaire
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie',
                        'field' => 'term_id',
                        'terms' => $categories[0]->term_id,
                    ),
                ),
                'post__not_in' => array(get_the_ID()), // Exclure l'article actuel
                'posts_per_page' => 2, // Limiter à 2 articles
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('template-parts/content-grid');
                }
                wp_reset_postdata();
            } else {
                echo '<p>Aucune autre photo trouvée dans cette catégorie.</p>';
            }
        } else {
            echo '<p>Aucune catégorie associée à cette photo.</p>';
        }
        ?>
    </div>
    </div>
    </section>

<?php
get_footer();
?>