<?php
get_header(); // Charge le header
?>

<section class="hero">
<div class="hero-wrapper">
  <?php
      $args = array(
        'post_type' => 'photo', // Remplacez 'post' par le type de publication de vos photos si nécessaire
        'posts_per_page' => 1, // Limiter à 1 article
        'orderby' => 'rand'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image=get_the_post_thumbnail_url($post->ID);
            the_post_thumbnail('full', ['class' => 'hero-image', 'alt' => get_the_title()]);
            //$thumbnailID=get_the_post_thumbnail(get_the_ID(),'large');
            //var_dump($thumbnailID);
        }
    }
        wp_reset_postdata();
        ?>


    <!--<img class="hero-image" src="<?php //echo esc_url($random_image_url); ?>" alt="Photographie événementielle par Nathalie Mota">-->
    <img class="titre-header" src="<?php echo get_template_directory_uri(); ?>/assets/img/titreheader.png" alt="Titre header : Photographe Event">
</div>
</section>

    </section>

    <section class="home-pics">
    <div class="filters">
        <!-- Filtre pour la taxonomie 'categorie' -->



            <!-- Filtre Catégorie -->
            <select id="categories" class="filter-select">
            <option value="" disabled selected aria-disabled="true">Catégories</option>
                <?php foreach (get_terms(['taxonomy' => 'categorie', 'hide_empty' => false]) as $category) : ?>
                    <option value="<?= esc_attr($category->slug); ?>"><?= esc_html($category->name); ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Filtre Format -->
            <select id="formats" class="filter-select">
                <option value="" disabled selected aria-disabled="true">Formats</option>
                <?php foreach (get_terms(['taxonomy' => 'format', 'hide_empty' => false]) as $format) : ?>
                    <option value="<?= esc_attr($format->slug); ?>"><?= esc_html($format->name); ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Tri par date -->
            <div class="filter">
            <select id="sort" class="filter-select">
                    <option value="" disabled selected aria-disabled="true">Trier par</option>
                    <option value="DESC">Plus récent</option>
                    <option value="ASC">Plus ancien</option>
                </select>
            </div>

        

        </div>
    </div>
        <div class="photo-grid">
            <?php
                    get_template_part('template-parts/content-grid-home');
            ?>
        </div>
        <button id="load-more-btn">Charger plus</button>
    </section>

<?php
get_footer(); // Charge le footer
?>