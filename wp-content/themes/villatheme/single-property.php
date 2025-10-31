<?php
/*
Template Name: Single Property Template
*/
?>
<?php
get_header();

if (have_posts()) :
  while (have_posts()) : the_post();
    $category = get_field('category');
    $price = get_field('price');
    $bedrooms = get_field('bedrooms');
    $bathrooms = get_field('bathrooms');
    $area = get_field('area');
    $floor = get_field('floor');
    $parking = get_field('parking');
    $main_image = get_field('image');
  ?>
   <?php get_template_part('template-parts/breadcrumb'); ?>


    <div class="single-property section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="main-image">
              <?php if ($main_image) : ?>
                <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php the_title(); ?>">
              <?php elseif (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
              <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image.jpg" alt="No image available">
              <?php endif; ?>
            </div>

            <div class="main-content">
              <?php if ($category) : ?><span class="category"><?php echo esc_html($category); ?></span><?php endif; ?>
              <h4><?php the_title(); ?></h4>
              <p><?php the_content(); ?></p>
            </div>

            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    Property Details
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    <ul>
                      <?php if ($area) : ?><li><strong>Area:</strong> <?php echo esc_html($area); ?> m²</li><?php endif; ?>
                      <?php if ($bedrooms) : ?><li><strong>Bedrooms:</strong> <?php echo esc_html($bedrooms); ?></li><?php endif; ?>
                      <?php if ($bathrooms) : ?><li><strong>Bathrooms:</strong> <?php echo esc_html($bathrooms); ?></li><?php endif; ?>
                      <?php if ($floor) : ?><li><strong>Floor:</strong> <?php echo esc_html($floor); ?></li><?php endif; ?>
                      <?php if ($parking) : ?><li><strong>Parking:</strong> <?php echo esc_html($parking); ?></li><?php endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="info-table">
              <ul>
                <li>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                  <h4><?php echo esc_html($area ?: 'N/A'); ?> m²<br><span>Total Space</span></h4>
                </li>
                <li>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info-icon-02.png" alt="" style="max-width: 52px;">
                  <h4>Floor<br><span><?php echo esc_html($floor ?: 'N/A'); ?></span></h4>
                </li>
                <li>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                  <h4>Bedrooms<br><span><?php echo esc_html($bedrooms ?: 'N/A'); ?></span></h4>
                </li>
                <li>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info-icon-04.png" alt="" style="max-width: 52px;">
                  <h4>Bathrooms<br><span><?php echo esc_html($bathrooms ?: 'N/A'); ?></span></h4>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  endwhile;
endif;

get_footer();
