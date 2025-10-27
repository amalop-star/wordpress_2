<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
                    <?php
                    if (function_exists('the_custom_logo')) {
                        the_custom_logo();
                    } else { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/coffee-beans.png" alt="Logo">
                    <?php } ?>
                        
                    <?php bloginfo('name'); ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary_menu',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ms-lg-auto gap-3',
                        'fallback_cb'    => false,
                    ]);
                    ?>

                </div>
            </div>
        </nav>