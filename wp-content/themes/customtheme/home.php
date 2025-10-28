<?php get_header(); ?>

<section class="menu-section section-padding" id="all-posts">
    <div class="container">
        <div class="row">
            <?php if (have_posts()) : 
                while (have_posts()) : the_post(); ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="menu-block-wrap text-white">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-image mb-3" style="height: 250px; overflow: hidden; border-radius: 10px;">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', ['class' => 'img-fluid w-100 h-100', 'style' => 'object-fit: cover;']); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="post-image mb-3" style="height: 250px; overflow: hidden; border-radius: 10px;">
                                    <div class="bg-secondary w-100 h-100 d-flex align-items-center justify-content-center text-white">
                                        <span>No Image Available</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <h4 class="text-white">
                                <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <p class="text-white"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-light mt-2">Read More</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-12 text-center">
                    <p class="text-white">No posts found.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (paginate_links()) : ?>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <div class="pagination-wrap text-white">
                    <?php
                    echo paginate_links(array(
                        'mid_size' => 2,
                        'prev_text' => __('« Previous'),
                        'next_text' => __('Next »'),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>