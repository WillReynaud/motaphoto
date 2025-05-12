<?php
get_header();
?>
    <?php while (have_posts()) : the_post(); ?>
    <section class="main-photo-container">
        <div class="upper-blocs">
            <div class="photo-info-container">
                <h1 class="photo-title"><?php the_title(); ?></h1>
                <p class="description">
                    Référence: <span id="reference"><?php echo esc_html(get_field('reference')); ?></span> <br>
                    Catégorie: <?php the_terms(get_the_ID(), 'categorie'); ?> <br>
                    Format: <?php the_terms(get_the_ID(), 'format'); ?> <br>
                    Type: <?php echo esc_html(get_field('type_de_photo')); ?> <br>
                    Année: <?php echo get_the_date('Y'); ?>
                </p>
            </div>
            <div class="photo-container">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
            </div>
        </div>

        <div class=interactions-container>
        <div class="photo-info-btn-container">
                <p>Cette photo vous intéresse ?</p>
                <button class="myBtn2">Contact</button>
            </div>
            <div class="photo-preview-container">
                <?php
                $next_post = get_next_post();
                $prev_post = get_previous_post();

                $next_thumb = $next_post ? get_the_post_thumbnail_url($next_post->ID, 'medium') : '';
                $prev_thumb = $prev_post ? get_the_post_thumbnail_url($prev_post->ID, 'medium') : '';
                ?>

                <div class="photo-preview"></div>

                <div class="arrow-btns">
                    <?php if($prev_post){ ?>
                    
                        <a href="<?php echo $prev_post ? get_permalink($prev_post) : '#'; ?>" 
                        class="arrow-btn arrow-left" 
                        data-thumb="<?php echo esc_url($prev_thumb); ?>">
                            ←
                        </a>
                    <?php } ?>

                    <?php if($next_post){ ?>
                        <a href="<?php echo $next_post ? get_permalink($next_post) : '#'; ?>" 
                        class="arrow-btn arrow-right" 
                        data-thumb="<?php echo esc_url($next_thumb); ?>">
                            →
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

    </section>

    <section class="other-pics-container">
        <h3>Vous aimerez aussi</h3>
        <div class="photo-grid">
        <?php
        get_template_part('template-parts/content-grid-related');
        ?>
    </div>
    </div>
    </section>
    <?php endwhile; ?>
<?php
get_footer();
?>