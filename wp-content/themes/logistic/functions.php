<?php
add_action('wp_enqueue_scripts', 'logistic_scripts');

function logistic_scripts() {
    wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('logistic-style', get_stylesheet_uri());
    wp_enqueue_script('swiper-scripts', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_script('logistic-scripts', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true);
};

add_theme_support('custom-logo');
add_theme_support('post-thumbnails');
add_theme_support('menus');

// Отключение автоматического оборачивания полей в теги <p> в Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');


?>
