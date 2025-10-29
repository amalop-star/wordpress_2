<section class="about-section section-padding" id="section_2">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-12">
                <div class="ratio ratio-1x1">
                    <video autoplay loop muted class="custom-video">
                        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/pexels-mike-jones-9046237.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div class="about-video-info d-flex flex-column">
                        <h4 class="mt-auto">Fresh Stories Daily</h4>
                        <h4>Our Latest Blogs</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12 mt-4 mt-lg-0 mx-auto">
                <em class="text-white">Latest from Our Blog</em>
                <h2 class="text-white mb-3">Recent News</h2>
                <?php
                $recent_posts = new WP_Query([
                    'post_type' => 'news',
                    'posts_per_page' => 2,
                    'post_status' => 'publish',
                ]);

                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                        <div class="blog-item mb-4">
                            <h4 class="text-white mb-1">
                                <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <small class="text-light mb-2 d-block">
                                <i class="bi bi-calendar-event me-1"></i>
                                <?php echo get_the_date(); ?>
                            </small>
                            <p class="text-white mb-2">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm custom-border-btn text-white">Read More</a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p class="text-white">No recent News found.</p>
                <?php endif; ?>
                <a class="smoothscroll btn custom-btn custom-border-btn mt-3 mb-4" href="#section_3"> View All News </a>

            </div>
        </div>
    </div>
</section>