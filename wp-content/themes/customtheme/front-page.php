<?php get_header(); ?>


<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-12 mx-auto">
                <em class="small-text">Welcome to Our Blog</em>

                <h2 class="text-white mb-3"><?php the_field('hero_title'); ?></h2>

                <p class="text-white mb-4 pb-lg-2">
                    Discover insights, stories, and updates brewed fresh for you.
                </p>

                <a class="btn custom-btn custom-border-btn smoothscroll me-3" href="#section_2">
                    Recent Posts
                </a>

                <a class="btn custom-btn smoothscroll me-2 mb-2" href="#section_3"><strong>All Posts</strong></a>
            </div>

        </div>
    </div>

    <div class="hero-slides"></div>
</section>

<section class="about-section section-padding" id="section_2">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-12">
                <div class="ratio ratio-1x1">
                    <video autoplay loop muted class="custom-video">
                        <source src="<?php echo get_template_directory_uri(); ?>/videos/pexels-mike-jones-9046237.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div class="about-video-info d-flex flex-column">
                        <h4 class="mt-auto">Fresh Stories Daily</h4>
                        <h4>Our Latest Blogs</h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-12 mt-4 mt-lg-0 mx-auto">
                <em class="text-white">Latest from Our Blog</em>
                <h2 class="text-white mb-3">Recent Posts</h2>

                <?php
                $recent_posts = new WP_Query([
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'post_status' => 'publish',
                ]);

                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                        <div class="blog-item mb-4">
                            <h4 class="text-white mb-1">
                                <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <small class="text-light mb-2 d-block">
                                <i class="bi bi-calendar-event me-1"></i>
                                <?php echo get_the_date(); ?>
                            </small>
                            <p class="text-white mb-2">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm custom-border-btn text-white">Read More</a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p class="text-white">No recent posts found.</p>
                <?php endif; ?>
                <a class="smoothscroll btn custom-btn custom-border-btn mt-3 mb-4" href="#section_3"> View All Posts </a>

            </div>
        </div>
    </div>
</section>


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

<section class="menu-section section-padding" id="section_3">
    <div class="container">
        <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-lg-12 mb-4">
                        <div class="menu-block-wrap">
                            <div class="text-center mb-4 pb-lg-2">
                                <h4 class="text-white"><?php the_title(); ?></h4>
                                <div class="menu-block text-white">
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-light mt-3">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>


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
                ]);

                if (!empty($tags)) :
                    $side = 'left';
                    foreach ($tags as $tag) :
                        $side = ($side === 'left') ? 'right' : 'left';
                        $image_url = get_template_directory_uri() . '/assets/images/reviews/young-woman-with-round-glasses-yellow-sweater.jpg';
                        $desc = $tag->description ? wp_trim_words($tag->description, 20) : 'Explore posts under this tag.';
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







<section class="contact-section section-padding" id="section_5">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <em class="text-white">Say Hello</em>
                <h2 class="text-white mb-4 pb-lg-2">Contact</h2>
            </div>

            <div class="col-lg-6 col-12">
                <form action="#" method="post" class="custom-form contact-form" role="form">

                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <label for="name" class="form-label">Name <sup class="text-danger">*</sup></label>

                            <input type="text" name="name" id="name" class="form-control" placeholder="Jackson" required="">
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="email" class="form-label">Email Address</label>

                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jack@gmail.com" required="">
                        </div>

                        <div class="col-12">
                            <label for="message" class="form-label">How can we help?</label>

                            <textarea name="message" rows="4" class="form-control" id="message" placeholder="Message" required=""></textarea>

                        </div>
                    </div>

                    <div class="col-lg-5 col-12 mx-auto mt-3">
                        <button type="submit" class="form-control">Send Message</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 col-12 mx-auto mt-5 mt-lg-0 ps-lg-5">
                <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5039.668141741662!2d72.81814769288509!3d19.043340656729775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c994f34a7355%3A0x2680d63a6f7e33c2!2sLover%20Point!5e1!3m2!1sen!2sth!4v1692722771770!5m2!1sen!2sth" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>