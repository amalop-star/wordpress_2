<?php get_header(); ?>

<section class="movie-detail section-padding">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php
            $poster = get_field('movie_poster');
            $year = get_field('released_year');
            $rating = get_field('rating');
            $desc = get_field('description');
            $director = get_field('director');
            $trailer = get_field('trailer_link'); 
            ?>

            <div class="row align-items-start g-5">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="poster-wrapper shadow-lg rounded-4 overflow-hidden">
                        <?php if ($poster) : ?>
                            <img src="<?php echo esc_url($poster['url']); ?>" alt="<?php the_title(); ?>" class="img-fluid w-100 object-fit-cover">
                        <?php else : ?>
                            <div class="bg-secondary w-100 d-flex align-items-center justify-content-center text-white-50" style="height: 300px;">
                                No Poster Available
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6 col-12">
                    <h1 class="text-uppercase fw-bold mb-3"><?php the_title(); ?></h1>

                    <ul class="list-unstyled text-white-50 mb-4">
                        <?php if ($year) : ?>
                            <li><strong>Release Year:</strong> <?php echo esc_html($year); ?></li>
                        <?php endif; ?>

                        <?php if ($rating) : ?>
                            <li><strong>Rating:</strong> <?php echo esc_html($rating); ?>/5</li>
                        <?php endif; ?>

                        <?php if ($director) : ?>
                            <li><strong>Director:</strong> <?php echo esc_html($director); ?></li>
                        <?php endif; ?>
                    </ul>

                    
                    <?php if ($trailer) : ?>
                        <a href="<?php echo esc_url($trailer); ?>" target="_blank" class="btn btn-outline-dark mt-3 px-4 rounded-pill">
                            🎬 Watch Trailer
                        </a>
                    <?php endif; ?>

                    <div class="mt-5">
                        <a href="<?php echo esc_url(get_post_type_archive_link('movie')); ?>" class="btn btn-secondary rounded-pill">
                            ← Back to Movies
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-5 border-light opacity-25">

            <!-- Full content or extra ACF fields -->
            <div class="movie-content text-light">
                <?php the_content(); ?>
            </div>

        <?php endwhile;
        endif; ?>
    </div>
</section>

<?php get_footer(); ?>
