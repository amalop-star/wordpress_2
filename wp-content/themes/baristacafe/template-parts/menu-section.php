<section class="reviews-section section-padding section-bg" id="section_4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                <em class="text-white">Reviews by Customers</em>
                <h2 class="text-white">Testimonials</h2>
            </div>

            <div class="timeline">
                <?php
                $reviews_args = array(
                    'post_type' => 'review',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'ASC'
                );
                $reviews_query = new WP_Query($reviews_args);
                
                if ($reviews_query->have_posts()) :
                    $count = 0;
                    while ($reviews_query->have_posts()) : $reviews_query->the_post();
                        $rating = get_post_meta(get_the_ID(), 'review_rating', true);
                        $position = get_post_meta(get_the_ID(), 'review_position', true) ?: 'Customer';
                        $alignment = ($count % 2 == 0) ? 'left' : 'right';
                        $count++;
                ?>
                        <div class="timeline-container timeline-container-<?php echo $alignment; ?>">
                            <div class="timeline-content">
                                <div class="reviews-block">
                                    <div class="reviews-block-image-wrap d-flex align-items-center">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('review-thumbnail', array('class' => 'reviews-block-image img-fluid')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reviews/placeholder.jpg" class="reviews-block-image img-fluid" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        <div class="ms-3">
                                            <h6 class="text-white mb-0"><?php the_title(); ?></h6>
                                            <em class="text-white"><?php echo esc_html($position); ?></em>
                                        </div>
                                    </div>
                                    <div class="reviews-block-info">
                                        <p><?php echo wp_trim_words(get_the_content(), 25); ?></p>
                                        <div class="d-flex border-top pt-3 mt-4">
                                            <strong class="text-white"><?php echo esc_html($rating); ?> <small class="ms-2">Rating</small></strong>
                                            <div class="reviews-group ms-auto">
                                                <?php
                                                $rating_num = floatval($rating);
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating_num) {
                                                        echo '<i class="bi-star-fill"></i>';
                                                    } elseif ($i - 0.5 <= $rating_num) {
                                                        echo '<i class="bi-star-half"></i>';
                                                    } else {
                                                        echo '<i class="bi-star"></i>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Default reviews
                    $default_reviews = array(
                        array(
                            'name' => 'Sandra', 
                            'position' => 'Customer',
                            'image' => 'young-woman-with-round-glasses-yellow-sweater.jpg',
                            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'rating' => 4.5
                        ),
                        array(
                            'name' => 'Don', 
                            'position' => 'Customer',
                            'image' => 'senior-man-white-sweater-eyeglasses.jpg',
                            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'rating' => 4.5
                        ),
                        array(
                            'name' => 'Olivia', 
                            'position' => 'Customer',
                            'image' => 'young-beautiful-woman-pink-warm-sweater-natural-look-smiling-portrait-isolated-long-hair.jpg',
                            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'rating' => 4.5
                        )
                    );
                    
                    foreach ($default_reviews as $index => $review) :
                        $alignment = ($index % 2 == 0) ? 'left' : 'right';
                    ?>
                        <div class="timeline-container timeline-container-<?php echo $alignment; ?>">
                            <div class="timeline-content">
                                <div class="reviews-block">
                                    <div class="reviews-block-image-wrap d-flex align-items-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reviews/<?php echo $review['image']; ?>" class="reviews-block-image img-fluid" alt="<?php echo $review['name']; ?>">
                                        <div class="ms-3">
                                            <h6 class="text-white mb-0"><?php echo $review['name']; ?></h6>
                                            <em class="text-white"><?php echo $review['position']; ?></em>
                                        </div>
                                    </div>
                                    <div class="reviews-block-info">
                                        <p><?php echo $review['content']; ?></p>
                                        <div class="d-flex border-top pt-3 mt-4">
                                            <strong class="text-white"><?php echo $review['rating']; ?> <small class="ms-2">Rating</small></strong>
                                            <div class="reviews-group ms-auto">
                                                <?php
                                                $rating_num = floatval($review['rating']);
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating_num) {
                                                        echo '<i class="bi-star-fill"></i>';
                                                    } elseif ($i - 0.5 <= $rating_num) {
                                                        echo '<i class="bi-star-half"></i>';
                                                    } else {
                                                        echo '<i class="bi-star"></i>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>