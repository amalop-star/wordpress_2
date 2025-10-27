    <footer class="site-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-12 me-auto">
                    <em class="text-white d-block mb-4">Where to find us?</em>

                    <strong class="text-white">
                        <i class="bi-geo-alt me-2"></i>
                        <?php echo esc_html(get_theme_mod('barista_address', 'Bandra West, Mumbai, Maharashtra 400050, India')); ?>
                    </strong>

                    <ul class="social-icon mt-4">
                        <?php if (get_theme_mod('barista_facebook')) : ?>
                        <li class="social-icon-item">
                            <a href="<?php echo esc_url(get_theme_mod('barista_facebook')); ?>" class="social-icon-link bi-facebook"></a>
                        </li>
                        <?php endif; ?>
    
                        <?php if (get_theme_mod('barista_twitter')) : ?>
                        <li class="social-icon-item">
                            <a href="<?php echo esc_url(get_theme_mod('barista_twitter')); ?>" class="social-icon-link bi-twitter"></a>
                        </li>
                        <?php endif; ?>

                        <?php if (get_theme_mod('barista_whatsapp')) : ?>
                        <li class="social-icon-item">
                            <a href="<?php echo esc_url(get_theme_mod('barista_whatsapp')); ?>" class="social-icon-link bi-whatsapp"></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="col-lg-3 col-12 mt-4 mb-3 mt-lg-0 mb-lg-0">
                    <em class="text-white d-block mb-4">Contact</em>

                    <p class="d-flex mb-1">
                        <strong class="me-2">Phone:</strong>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('barista_phone')); ?>" class="site-footer-link">
                            <?php echo esc_html(get_theme_mod('barista_phone', '(65) 305 2409 671')); ?>
                        </a>
                    </p>

                    <p class="d-flex">
                        <strong class="me-2">Email:</strong>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('barista_email')); ?>" class="site-footer-link">
                            <?php echo esc_html(get_theme_mod('barista_email', 'hello@barista.co')); ?>
                        </a>
                    </p>
                </div>

                <div class="col-lg-5 col-12">
                    <em class="text-white d-block mb-4">Opening Hours.</em>

                    <ul class="opening-hours-list">
                        <li class="d-flex">
                            Monday - Friday
                            <span class="underline"></span>
                            <strong><?php echo esc_html(get_theme_mod('barista_monday_friday_hours', '9:00 - 18:00')); ?></strong>
                        </li>

                        <li class="d-flex">
                            Saturday
                            <span class="underline"></span>
                            <strong><?php echo esc_html(get_theme_mod('barista_saturday_hours', '11:00 - 16:30')); ?></strong>
                        </li>

                        <li class="d-flex">
                            Sunday
                            <span class="underline"></span>
                            <strong><?php echo esc_html(get_theme_mod('barista_sunday_hours', 'Closed')); ?></strong>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-8 col-12 mt-4">
                    <p class="copyright-text mb-0">
                        Copyright © <?php bloginfo('name'); ?> <?php echo date('Y'); ?> 
                        - Design: <a rel="sponsored" href="https://www.tooplate.com" target="_blank">Tooplate</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</main>

<?php wp_footer(); ?>
</body>
</html>