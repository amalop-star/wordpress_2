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

                    <ul class="navbar-nav ms-lg-4">
                        <?php if (is_user_logged_in()) :
                            $current_user = wp_get_current_user();
                            $avatar = get_avatar_url($current_user->ID, ['size' => 40]);
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo esc_url($avatar); ?>" alt="Profile" class="rounded-circle me-2" style="width: 32px; height: 32px;">
                                    <span class="text-white"><?php echo esc_html($current_user->display_name); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo esc_url(get_edit_user_link()); ?>">Profile</a></li>
                                    <li><a class="dropdown-item" href="<?php echo esc_url(admin_url()); ?>">Dashboard</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?php echo esc_url(wp_login_url()); ?>" class="btn btn-outline-light btn-sm">Login</a>
                            </li>
                            <li class="nav-item ms-2">
                                <a href="<?php echo esc_url(wp_registration_url()); ?>" class="btn btn-light btn-sm text-dark">Register</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </nav>