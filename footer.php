<nav class="footer-menu">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'menu-footer',
        'menu_class' => 'footer-menu-wp',
        'container' => 'ul',
    ));
    ?>
</nav>
<?php get_template_part('template-parts/lightbox'); ?>
<?php get_template_part('template-parts/modal-contact'); ?>
<?php wp_footer(); ?>

</body>
</html>