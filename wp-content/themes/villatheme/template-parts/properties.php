<?php
/*
Template Name: Properties Section
*/
get_header();
?>

<section class="properties section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="section-heading text-center">
                    <h6>| Properties</h6>
                    <h2>We Provide The Best Property You Like</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            // Custom Query: Fetch 'property' post type
            $properties = new WP_Query([
                'post_type'      => 'property',
                'posts_per_page' => 6,
                'post_status'    => 'publish'
            ]);

            if ($properties->have_posts()) :
                while ($properties->have_posts()) : $properties->the_post();
                    // Use get_post_meta instead of get_field
                    $category     = get_post_meta(get_the_ID(), 'category', true) ?: '';
                    $price        = get_post_meta(get_the_ID(), 'price', true) ?: '';
                    $bedrooms     = get_post_meta(get_the_ID(), 'bedrooms', true) ?: '';
                    $bathrooms    = get_post_meta(get_the_ID(), 'bathrooms', true) ?: '';
                    $area         = get_post_meta(get_the_ID(), 'area', true) ?: '';
                    $floor        = get_post_meta(get_the_ID(), 'floor', true) ?: '';
                    $parking      = get_post_meta(get_the_ID(), 'parking', true) ?: '';

                    // For images with get_post_meta, you'll get the attachment ID
                    $image_id     = get_post_meta(get_the_ID(), 'image', true);
                    $image        = $image_id ? wp_get_attachment_image_src($image_id, 'full') : false;
            ?>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="item h-100">
                            <a href="<?php the_permalink(); ?>">
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid w-100 object-fit-cover transition-scale">
                                <?php else : ?>
                                    <div class="bg-secondary w-100 h-100 d-flex align-items-center justify-content-center" style="height:250px;">
                                        <span class="text-white-50">No Image Available</span>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <?php if ($category) : ?><span class="category"><?php echo esc_html($category); ?></span><?php endif; ?>
                            <?php if ($price) : ?><h6>$<?php echo esc_html($price); ?></h6><?php endif; ?>

                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                            <ul>
                                <?php if ($bedrooms) : ?><li>Bedrooms: <span><?php echo esc_html($bedrooms); ?></span></li><?php endif; ?>
                                <?php if ($bathrooms) : ?><li>Bathrooms: <span><?php echo esc_html($bathrooms); ?></span></li><?php endif; ?>
                                <?php if ($area) : ?><li>Area: <span><?php echo esc_html($area); ?></span></li><?php endif; ?>
                                <?php if ($floor) : ?><li>Floor: <span><?php echo esc_html($floor); ?></span></li><?php endif; ?>
                                <?php if ($parking) : ?><li>Parking: <span><?php echo esc_html($parking); ?></span></li><?php endif; ?>
                            </ul>

                            <div class="main-button">
                                <a href="<?php the_permalink(); ?>">Schedule a visit</a>
                            </div>
                        </div>
                    </div>

            <?php endwhile;
                wp_reset_postdata(); // Don't forget this!
            else :
                echo '<div class="col-12 text-center"><p>No properties found.</p></div>';
            endif;
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>