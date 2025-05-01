<?php

// فعال کردن ویژگی‌های وردپرس
function my_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    // ثبت منو
    register_nav_menus([
        'primary' => __('Primary Menu', 'my-dark-theme'),
        'footer'  => __('Footer Menu', 'my-dark-theme'),
    ]);
}

add_action('after_setup_theme', 'my_theme_setup');

function my_theme_scripts() {
    wp_enqueue_script('live-search',
        get_template_directory_uri() . '/assets/js/live-search.js',
        [ 'jquery' ],
        filemtime(get_template_directory() . '/assets/js/live-search.js'),
        true
    );

    wp_localize_script('live-search', 'ajax_object', [
        'ajax_url'   => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('live_search_nonce'),
    ]);

    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css', [], '1.0');

    wp_enqueue_script('my-theme-js', get_template_directory_uri() . '/assets/js/main.js', [ 'jquery' ], '1.0', true);
}

add_action('wp_enqueue_scripts', 'my_theme_scripts');

function my_theme_body_class( $classes ) {
    $classes[] = 'dark-mode';
    return $classes;
}

add_filter('body_class', 'my_theme_body_class');
?>