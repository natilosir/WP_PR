<?php

function live_search_handler() {
    check_ajax_referer('live_search_nonce', 'security');

    $search_term = sanitize_text_field($_POST['search_term']);

    if ( empty($search_term) ) {
        wp_send_json_error('Empty search term');
    }

    $args = [
        'post_type'           => 'post',
        'post_status'         => 'publish',
        's'                   => $search_term,
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => true,
    ];

    $query = new WP_Query($args);

    if ( $query->have_posts() ) {
        $output = '';

        while ( $query->have_posts() ) {
            $query->the_post();
            $output .= '<div class="search-result-item">';
            $output .= '<a href="' . get_permalink() . '">';
            $output .= '<div class="search-result-title">' . get_the_title() . '</div>';

            if ( has_excerpt() ) {
                $output .= '<div class="search-result-excerpt">' . get_the_excerpt() . '</div>';
            } else {
                $output .= '<div class="search-result-excerpt">' . wp_trim_words(get_the_content(), 15) . '</div>';
            }

            $output .= '</a>';
            $output .= '</div>';
        }

        wp_reset_postdata();
        wp_send_json_success($output);
    } else {
        wp_send_json_error('No results found');
    }
}

add_action('wp_ajax_live_search', 'live_search_handler');
add_action('wp_ajax_nopriv_live_search', 'live_search_handler');
