<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main>
    <nav class="navbar navbar-expand-lg">                
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                
                if (has_custom_logo()) {
                    echo '<img src="' . esc_url($logo[0]) . '" class="navbar-brand-image img-fluid" alt="' . get_bloginfo('name') . '">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/images/coffee-beans.png" class="navbar-brand-image img-fluid" alt="' . get_bloginfo('name') . '">';
                }
                ?>
                <span class="ms-2"><?php bloginfo('name'); ?></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul class="navbar-nav ms-lg-auto">%3$s</ul>',
                    'depth' => 2,
                    'walker' => new Barista_Walker_Nav_Menu()
                ));
                ?>

                <div class="ms-lg-3">
                    <a class="btn custom-btn custom-border-btn" href="<?php echo esc_url(home_url('/reservation')); ?>">
                        Reservation
                        <i class="bi-arrow-up-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>