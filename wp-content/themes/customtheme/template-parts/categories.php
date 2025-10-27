<?php
$categories = get_categories([
    'orderby' => 'name',
    'order'   => 'ASC',
    'hide_empty' => false,
    'exclude' => 1,
]);

if (!empty($categories)) : ?>
    <section class="barista-section section-padding section-bg" id="barista-team">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                    <em class="text-white">Explore</em>
                    <h2 class="text-white">Our Categories</h2>
                </div>

                <?php
                foreach ($categories as $category) :
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : get_template_directory_uri() . '/assets/images/team/portrait-elegant-old-man-wearing-suit.jpg';
                    $category_link = get_category_link($category->term_id);
                ?>
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="team-block-wrap">
                            <div class="team-block-info d-flex flex-column">
                                <div class="category-heading d-flex mt-auto mb-3">
                                    <h4 class="text-white mb-0"><?php echo esc_html($category->name); ?></h4>
                                    <p class="badge ms-4"><em><?php echo $category->count; ?> Posts</em></p>
                                </div>

                                <p class="text-white mb-3">
                                    <?php
                                    $description = $category->description ?: 'No description available.';
                                    echo esc_html(mb_strimwidth($description, 0, 200, '...'));
                                    ?>
                                </p>

                                <a href="<?php echo esc_url($category_link); ?>" class="btn btn-light btn-sm mt-auto align-self-start">
                                    Read More →
                                </a>
                            </div>

                            <div class="team-block-image-wrap">
                                <a href="<?php echo esc_url($category_link); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" class="team-block-image img-fluid" alt="<?php echo esc_attr($category->name); ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>