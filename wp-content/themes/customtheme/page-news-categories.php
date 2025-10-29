<?php
/* Template Name: News Categories */
get_header();
?>

<section class="barista-section section-padding section-bg" id="news-categories">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center mb-5">
                <em class="text-white">Explore</em>
                <h2 class="text-white">All News Categories</h2>
            </div>

            <?php
            // Pagination setup
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $per_page = 4; // categories per page

            // Get all terms (not paginated yet)
            $all_categories = get_terms([
                'taxonomy'   => 'news_category',
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false,
            ]);

            if (!empty($all_categories) && !is_wp_error($all_categories)) :
                // Slice the array manually for pagination
                $total_categories = count($all_categories);
                $total_pages = ceil($total_categories / $per_page);
                $offset = ($paged - 1) * $per_page;
                $paged_categories = array_slice($all_categories, $offset, $per_page);

                foreach ($paged_categories as $category) :
                    $category_link = get_term_link($category);
            ?>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="card bg-dark text-white h-100 border-0 shadow-sm team-block-info">
                            <div class="card-body text-center d-flex flex-column">
                                <h4 class="card-title mb-2">
                                    <a href="<?php echo esc_url($category_link); ?>" class="text-white text-decoration-none">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </h4>
                                <p class="badge bg-secondary">
                                    <em><?php echo intval($category->count); ?> News</em>
                                </p>

                                <p class="text-white mb-3 flex-grow-1">
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
            <?php
                endforeach;
            else :
                echo '<p class="text-white text-center">No categories found.</p>';
            endif;
            ?>

            <?php if ($total_pages > 1) : ?>
                <div class="col-12 text-center mt-4">

                    <div class="pagination-wrap text-center mt-5">
                        <?php
                        echo paginate_links([
                            'base'      => get_pagenum_link(1) . '%_%',
                            'format'    => 'page/%#%/',
                            'current'   => max(1, $paged),
                            'total'     => $total_pages,
                            'prev_text' => '« Prev',
                            'next_text' => 'Next »',
                            'type'      => 'list',
                        ]);
                        ?>
                        
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>