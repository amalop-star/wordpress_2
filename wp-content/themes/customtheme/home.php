<?php
/*
Template Name: Listing Page
*/
get_header(); ?>

<section class="menu-section section-padding" id="all-posts">
    <div class="container">
        <div class="row">
            <?php 
            // Custom query to get all posts
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 9,
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
            );
            $posts_query = new WP_Query($args);
            
            if ($posts_query->have_posts()) : 
                while ($posts_query->have_posts()) : $posts_query->the_post(); 
            ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="menu-block-wrap text-white">
                            <div class="post-image mb-3" style="height: 250px; overflow: hidden; border-radius: 10px;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', array(
                                            'class' => 'img-fluid w-100 h-100',
                                            'style' => 'object-fit: cover;'
                                        )); ?>
                                    </a>
                                <?php else : ?>
                                    <div class="bg-secondary w-100 h-100 d-flex align-items-center justify-content-center text-white">
                                        <span>No Image Available</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h4 class="text-white"><?php the_title(); ?></h4>
                            <p class="text-white"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-light mt-2">Read More</a>
                        </div>
                    </div>
            <?php 
                endwhile; 
            else : 
            ?>
                <p class="text-white text-center">No posts found.</p>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-12 text-right mt-4">
                <div class="pagination-wrap text-white">
                    <?php
                    echo paginate_links(array(
                        'total' => $posts_query->max_num_pages,
                        'mid_size'  => 2,
                        'prev_text' => __('« Previous'),
                        'next_text' => __('Next »'),
                    ));
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>