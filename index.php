<?php
get_header(); // Charge le header
?>

<h1>Bienvenue sur le site MotaPhoto</h1>

<?php
// Boucle WordPress pour afficher les articles
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php the_excerpt(); ?></p>
        </article>
    <?php endwhile;
else :
    echo '<p>Aucun article trouvé.</p>';
endif;
?>

<?php
get_footer(); // Charge le footer
?>