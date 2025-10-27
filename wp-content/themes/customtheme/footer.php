</main>
<footer class="site-footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 mt-4 text-center mx-auto">
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_menu',
                    'container'      => false,
                    'menu_class'     => 'list-inline text-center mb-4',
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                    'link_before'    => '<span class="text-white text-decoration-none">',
                    'link_after'     => '</span>',
                ]);
                ?>

                <p class="copyright-text mb-0 text-white">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                    All Rights Reserved. - Design by <a rel="sponsored" href="https://www.tooplate.com" target="_blank" class="text-white text-decoration-underline">Tooplate</a>
                </p>
            </div>

        </div>
    </div>

    <?php wp_footer(); ?>
</footer>
</body>

</html>