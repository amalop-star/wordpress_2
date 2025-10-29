<?php get_header(); ?>

<section class="menu-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white mb-5">
                <h1 class="mb-3 text-white">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        echo 'News tagged: ' . single_tag_title('', false);
                    } else {
                        the_archive_title();
                    }
                    ?>
                </h1>
                <?php the_archive_description('<p class="text-white">', '</p>'); ?>
            </div>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card bg-dark text-white h-100 border-0 shadow-sm overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
                                </a>
                            <?php else : ?>
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary" style="height: 200px;">
                                    <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none fw-bold">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="card-body text-center">
                                <h4 class="card-title mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                                <div class="card-text mb-3">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-light">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <div class="col-12 text-center">
                    <p class="text-white">No News found.</p>
                </div>
            <?php endif; ?>


        </div>
    </div>
</section>

<?php get_footer(); ?>