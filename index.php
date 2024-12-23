<?php get_header(); ?>






<main id="main-content" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
            <div><?php the_content(); ?></div>
        <?php
        endwhile;
    else :
        ?>
        <p>Aucun contenu trouvé.</p>
    <?php
    endif;
    ?>
</main>

<?php get_footer(); ?>