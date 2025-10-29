<?php
// Fetch News Categories (your custom taxonomy)
$news_categories = get_terms([
    'taxonomy'   => 'news_category',
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => false,
]);
if (!empty($news_categories) && !is_wp_error($news_categories)) : ?>
    <section class="barista-section section-padding section-bg" id="news-categories">
        <div>
            <div class="row justify-content-center">

                <div class="col-lg-12 col-md-6 col-12 text-center mb-4 pb-lg-2">
                    <em class="text-white">Explore</em>
                    <h2 class="text-white">News Categories</h2>
                </div>
                <?php foreach ($news_categories as $category) :
                    $category_link = get_term_link($category);
                ?>
                    <div class="col-lg-2 col-md-4 col-12 mb-4">
                        <div class="card bg-dark text-white h-100 border-0 shadow-sm team-block-info">
                            <div class="card-body text-center">
                                <h4 class="card-title mb-2">
                                    <a href="<?php echo esc_url($category_link); ?>" class="text-white text-decoration-none">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </h4>
                                <p class="badge bg-secondary">
                                    <em><?php echo intval($category->count); ?> News</em>
                                </p>

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
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="col-12 text-center mt-4">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('news-categories'))); ?>" class="btn btn-outline-light">
                        View All Categories
                    </a>

                </div>

            </div>
        </div>
    </section>
<?php endif; ?>