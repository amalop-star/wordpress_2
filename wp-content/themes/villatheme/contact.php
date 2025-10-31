<?php
/*
Template Name: Contact Page
*/
?>
<?php
get_header();
?>

<?php get_template_part('template-parts/breadcrumb', null, ['title' => the_title()]); ?>

<div class="contact-page section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h6><?= the_title() ?></h6>
                    <h2><?php the_field('heading'); ?></h2>
                </div>
                <p><?php the_field('description'); ?></p>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="item phone">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                            <h6><?php the_field('phone_number'); ?><br><span>Phone Number</span></h6>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="item email">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/email-icon.png" alt="" style="max-width: 52px;">
                            <h6><?php the_field('email'); ?><br><span>Business Email</span></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <?php get_template_part('template-parts/contact-form'); ?>

            </div>

            <div class="col-lg-12">
                <div id="map">
                    <iframe src="<?php the_field('map_embed'); ?>" width="100%" height="500px" frameborder="0"
                        style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);" allowfullscreen="">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>