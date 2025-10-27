<section class="menu-section section-padding" id="section_3">
    <div class="container">
        <div class="row">
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
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>