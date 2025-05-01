<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container">
        <div class="site-branding">
            <div class="header-logo-text">
                <h1 class="site-title">
                    <?php echo do_shortcode('[custom_logo]'); ?>

                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div>
        </div>

        <div class="login-section">
            <?php if ( is_user_logged_in() ) : ?>
                <div class="user-info">
                    <span><?php echo esc_html__('خوش آمدید، ', 'text-domain') . wp_get_current_user()->display_name; ?></span>
                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="logout-link">
                        <?php esc_html_e('خروج', 'text-domain'); ?>
                    </a>
                </div>
            <?php else : ?>
                <div class="auth-container">
                    <!-- Registration Form -->
                    <form method="post" action="" class="register-form">
                        <h3><?php esc_html_e('ثبت‌نام', 'text-domain'); ?></h3>
                        <input type="text" name="username"
                               placeholder="<?php esc_html_e('نام کاربری', 'text-domain'); ?>" required>
                        <input type="email" name="email" placeholder="<?php esc_html_e('ایمیل', 'text-domain'); ?>"
                               required>
                        <input type="password" name="password"
                               placeholder="<?php esc_html_e('رمز عبور', 'text-domain'); ?>" required>
                        <input type="submit" name="register_submit"
                               value="<?php esc_html_e('ثبت‌نام', 'text-domain'); ?>">
                    </form>

                    <!-- Login Form -->
                    <form method="post" action="<?php echo esc_url(wp_login_url()); ?>" class="login-form">
                        <h3><?php esc_html_e('ورود', 'text-domain'); ?></h3>
                        <input type="text" name="log" placeholder="<?php esc_html_e('نام کاربری', 'text-domain'); ?>"
                               required>
                        <input type="password" name="pwd" placeholder="<?php esc_html_e('رمز عبور', 'text-domain'); ?>"
                               required>
                        <input type="submit" value="<?php esc_html_e('ورود', 'text-domain'); ?>">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url()); ?>">
                    </form>
                </div>
            <?php endif; ?>
        </div>


        <nav class="main-navigation" aria-label="<?php esc_attr_e('Primary Menu', 'text-domain'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => false,
                'depth'          => 2,
            ]);
            ?>
        </nav>

        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="hamburger" aria-hidden="true"></span>
            <span class="screen-reader-text">
                <?php esc_html_e('Menu', 'text-domain'); ?>
            </span>
        </button>
    </div>
</header>

<main class="site-content" role="main">


