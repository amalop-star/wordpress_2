<?php
get_header();
?>

<section class="menu-section section-padding" id="all-posts">
    <div class="container">
        <div class="row">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $news_query = new WP_Query([
                'post_type'      => 'news',
                'posts_per_page' => 9,
                'paged'          => $paged,
                'post_status'    => 'publish',
            ]);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post(); ?>
                 <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card custom-bg text-white h-100 border-0 shadow-lg rounded-4 overflow-hidden transition-all">

                            <div class="post-image position-relative" style="height: 250px; overflow: hidden;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', ['class' => 'img-fluid w-100 h-100 object-fit-cover transition-scale']); ?>
                                    </a>
                                <?php else : ?>
                                    <div class="bg-secondary w-100 h-100 d-flex align-items-center justify-content-center">
                                        <span class="text-white-50">No Image</span>
                                    </div>
                                <?php endif; ?>

                                <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 opacity-0 hover-opacity-100 transition-all"></div>
                            </div>

                            <div class="card-body text-center p-4">
                                <h4 class="card-title text-uppercase fw-semibold mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none hover-text-light">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                                <p class="text-white-50 small mb-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-light btn-sm px-4 rounded-pill transition-all">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="col-12 text-center mt-4">
                    <div class="pagination-wrap text-white">
                        <?php
                        echo paginate_links([
                            'total'     => $news_query->max_num_pages,
                            'mid_size'  => 2,
                            'prev_text' => __('« Previous'),
                            'next_text' => __('Next »'),
                        ]);
                        ?>
                    </div>
                </div>

            <?php else : ?>
                <div class="col-12 text-center">
                    <p class="text-white">No news found.</p>
                </div>
            <?php endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
