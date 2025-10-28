<?php get_header(); ?>

<main class="container py-5">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_title('<h1 class="mb-3">', '</h1>');
    ?>
            <div class="text-white">
                <?php the_content(); ?>
            </div>
    <?php
        endwhile;
    else :
        echo '<p>No content found.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>