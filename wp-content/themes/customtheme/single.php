<?php get_header(); ?>

<section class="menu-section section-padding">
    <div class="container">
        <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-lg-12 mx-auto text-white">
                        <div class="menu-block-wrap">
                            <h1 class="mb-4"><?php the_title(); ?></h1>

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="mb-4">
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                                </div>
                            <?php endif; ?>

                            <div class="post-content ">
                                <div class="mb-4 text-white">
                                    <?php the_content(); ?>
                                </div>
                                <?php
                                $post_tags = get_the_tags();
                                if ($post_tags) :
                                ?>
                                    <div class="post-tags mt-4">
                                        <h5 class="text-white mb-3">Tags:</h5>
                                        <ul class="list-inline">
                                            <?php foreach ($post_tags as $tag) : ?>
                                                <li class="list-inline-item">
                                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                                        class="btn btn-outline-light btn-sm">
                                                        <?php echo esc_html($tag->name); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php endwhile;
            else : ?>
                <div class="col-12 text-center">
                    <p class="text-white">Sorry, no News found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>