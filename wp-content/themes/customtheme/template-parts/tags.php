<section class="reviews-section section-padding section-bg" id="section_4">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                <em class="text-white">Browse by Tags</em>
                <h2 class="text-white">Explore Topics</h2>
            </div>

            <div class="timeline">
                <?php
                $tags = get_tags([
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => false,
                    'taxonomy' => 'news_tag'
                ]);

                if (!empty($tags)) :
                    $side = 'left';
                    foreach ($tags as $tag) :
                        $side = ($side === 'left') ? 'right' : 'left';
                        $image_url = get_template_directory_uri() . '/assets/images/reviews/young-woman-with-round-glasses-yellow-sweater.jpg';
                        $desc = $tag->description ? wp_trim_words($tag->description, 20) : 'Explore News under this tag.';
                ?>
                        <div class="timeline-container timeline-container-<?php echo esc_attr($side); ?>">
                            <div class="timeline-content">
                                <div class="reviews-block">
                                    <div class="reviews-block-image-wrap d-flex align-items-center">
                                        <img src="<?php echo esc_url($image_url); ?>" class="reviews-block-image img-fluid" alt="<?php echo esc_attr($tag->name); ?>">
                                        <div class="">
                                            <h6 class="text-white mb-0"><?php echo esc_html($tag->name); ?></h6>
                                            <em class="text-white"><?php echo esc_html($tag->count); ?> Posts</em>
                                        </div>
                                    </div>

                                    <div class="reviews-block-info">
                                        <p><?php echo esc_html($desc); ?></p>

                                        <div class="d-flex border-top pt-3 mt-4">
                                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="btn btn-sm btn-light ms-auto">
                                                View Posts
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                else :
                    echo '<p class="text-center text-white">No tags available.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>
</section>