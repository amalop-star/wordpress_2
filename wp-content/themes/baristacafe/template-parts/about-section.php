<section class="about-section section-padding" id="section_2">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12">
                <div class="ratio ratio-1x1">
                    <?php
                    $about_video = get_theme_mod('barista_about_video', get_template_directory_uri() . '/assets/videos/pexels-mike-jones-9046237.mp4');
                    ?>
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="<?php echo esc_url($about_video); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div class="about-video-info d-flex flex-column">
                        <h4 class="mt-auto">We Started Since 2009.</h4>
                        <h4>Best Cafe in Klang.</h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-12 mt-4 mt-lg-0 mx-auto">
                <em class="text-white"><?php bloginfo('name'); ?></em>

                <h2 class="text-white mb-3">Cafe KL</h2>

                <?php
                $about_content = get_theme_mod('barista_about_content', '
                    <p class="text-white">The café had been in the town for as long as anyone could remember, and it had become a beloved institution among the locals.</p>
                    <p class="text-white">The café was run by a friendly and hospitable couple, Mr. and Mrs. Johnson.</p>
                ');
                echo wp_kses_post($about_content);
                ?>

                <a href="#barista-team" class="smoothscroll btn custom-btn custom-border-btn mt-3 mb-4">Meet Baristas</a>
            </div>
        </div>
    </div>
</section>