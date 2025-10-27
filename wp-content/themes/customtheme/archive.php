<?php get_header(); ?>

<section class="menu-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white mb-5">
                <h1 class="mb-3">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        echo 'Posts tagged: ' . single_tag_title('', false);
                    } else {
                        the_archive_title();
                    }
                    ?>
                </h1>
                <?php the_archive_description('<p>', '</p>'); ?>
            </div>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-lg-12 mb-4">
                        <div class="menu-block-wrap">
                            <div class="text-center mb-4 pb-lg-2">
                                <h4 class="text-white"><?php the_title(); ?></h4>
                                <div class="menu-block text-white">
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-light mt-3">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <div class="col-12 text-center">
                    <p class="text-white">No posts found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
