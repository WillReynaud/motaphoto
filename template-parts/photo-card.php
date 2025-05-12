<?php
$categories = get_the_terms(get_the_ID(), 'categorie');
$categorie = ($categories && !is_wp_error($categories)) ? $categories[0]->name : '';
$reference = esc_html(get_field('reference'));
?>

<div class="grid-item">
    <div class="overlay">
        <img class="fullscreenlogo" src="<?php echo get_template_directory_uri(); ?>/assets/img/fullscreenlogo.png" alt="plein écran">
        <a href="<?php the_permalink(); ?>"><img class="eyelogo" src="<?php echo get_template_directory_uri(); ?>/assets/img/eyelogo.png" alt="aperçu"></a>
        <p class="overlay-reference"><?php echo esc_html(get_field('reference')); ?></p>
        <p class="overlay-category"><?php echo esc_html($categorie); ?></p>
    </div>   
    
    <div class="image-photo" data-url="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" data-categorie="<?php echo esc_attr($categorie); ?>" data-ref="<?php echo $reference; ?>">
        <?php the_post_thumbnail('medium'); ?>
    </div>
</div>



