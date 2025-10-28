<?php get_header(); ?>

<section class="menu-section section-padding">
    <div class="container">
        <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-lg-10 mx-auto text-white">
                    <div class="menu-block-wrap">
                        <h1 class="mb-3"><?php the_title(); ?></h1>
                        
                        <p class="text-muted mb-4">
                            Published on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                        </p>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-4">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content text-white">
                            <?php the_content(); ?>
                        </div>
                        
                        <?php
                        // Display news categories
                        $categories = get_the_terms(get_the_ID(), 'news_category');
                        if ($categories && !is_wp_error($categories)) : ?>
                            <div class="mt-4">
                                <h5 class="text-white mb-3">Categories:</h5>
                                <ul class="list-inline">
                                    <?php foreach ($categories as $category) : ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo esc_url(get_term_link($category)); ?>" 
                                               class="btn btn-outline-light btn-sm">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        // Display news tags
                        $tags = get_the_terms(get_the_ID(), 'news_tag');
                        if ($tags && !is_wp_error($tags)) : ?>
                            <div class="mt-4">
                                <h5 class="text-white mb-3">Tags:</h5>
                                <ul class="list-inline">
                                    <?php foreach ($tags as $tag) : ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo esc_url(get_term_link($tag)); ?>" 
                                               class="btn btn-outline-info btn-sm">
                                                #<?php echo esc_html($tag->name); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>