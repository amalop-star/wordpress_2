<?php get_header(); ?>

<section class="movie-archive section-padding">
    <div class="container">
        <h2 class="text-center mb-5">All Movies</h2>

        <div class="row justify-content-center">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    $poster = get_field('movie_poster');
                    $year = get_field('released_year');
                    $rating = get_field('rating');
                    $director = get_field('director');
                    ?>

                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card bg-dark text-white h-100 border-0 shadow-lg rounded-4 overflow-hidden transition-all">

                            <div class="post-image position-relative" style="height: 250px; overflow: hidden;">
                                <?php if ($poster) : ?>
                                    <img src="<?php echo esc_url($poster['url']); ?>" alt="<?php the_title(); ?>" class="img-fluid w-100 h-100 object-fit-cover transition-scale">
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
                                <ul class="list-unstyled text-white-50 mb-4">
                                    <?php if ($year) : ?>
                                        <li><strong>Release Year:</strong> <?php echo esc_html($year); ?></li>
                                    <?php endif; ?>

                                    <?php if ($rating) : ?>
                                        <li><strong>Rating:</strong> <?php echo esc_html($rating); ?></li>
                                    <?php endif; ?>

                                    <?php if ($director) : ?>
                                        <li><strong>Director:</strong> <?php echo esc_html($director); ?></li>
                                    <?php endif; ?>
                                </ul>


                                <p class="text-white-50 small mb-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>

                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-light btn-sm px-4 rounded-pill transition-all">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else : ?>
                <p class="text-center text-muted">No movies found.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <?php
                the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => __('« Previous', 'textdomain'),
                    'next_text' => __('Next »', 'textdomain'),
                ]);
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>