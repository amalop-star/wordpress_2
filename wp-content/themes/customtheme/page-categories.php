<?php

/**
 * Template Name: All Categories Page
 */
get_header();
?>
<section class="menu-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white mb-5">
                <h1 class="mb-3 text-white">Our Blog Categories</h1>
                <p class="text-white">Discover articles by category</p>
            </div>
        </div>

        <div class="row">
            <?php
            $categories = get_categories([
                'orderby' => 'name',
                'order'   => 'ASC',
                'hide_empty' => false,
                'exclude' => 1,
            ]);

            if (!empty($categories)) :
                foreach ($categories as $category) :
                    $category_link = get_category_link($category->term_id);
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
            ?>
                    <div class="col-lg-4 mb-4">
                        <div class="menu-block-wrap">
                            <div class="text-center mb-4 pb-lg-2">

                                <h4 class="text-white"><?php echo esc_html($category->name); ?></h4>
                                <div class="menu-block text-white">
                                    <?php
                                    $description = $category->description ?: 'Explore News in this category.';
                                    echo esc_html(wp_trim_words($description, 15, '...'));
                                    ?>
                                    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-light mt-3">Read More</a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                endforeach;
            else :
                ?>
                <div class="col-12">
                    <p class="text-white text-center">No categories found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>