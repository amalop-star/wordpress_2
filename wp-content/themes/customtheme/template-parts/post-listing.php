<section class="menu-section section-padding" id="section_3">
    <div class="container">
        <div class="row">
            <?php
            $latest_posts = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 2,
                'post_status'    => 'publish',
            ]);

            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                        <div class="menu-block-wrap h-100">
                            <div class="text-center mb-4 pb-lg-2">
                                <div class="post-image mb-3" style="height: 250px; overflow: hidden; border-radius: 10px;">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large', ['class' => 'img-fluid w-100 h-100 object-fit-cover']); ?>
                                        </a>
                                    <?php else : ?>
                                        <div class="bg-secondary w-100 h-100 d-flex align-items-center justify-content-center text-white">
                                            <span>No Image</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h4 class="text-white"><?php the_title(); ?></h4>
                                <div class="menu-block text-white">
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-light mt-3">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-white text-center">No posts found.</p>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="btn btn-light">
                    View All Posts
                </a>

            </div>
        </div>
    </div>
</section>