<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('neptune_tv_pagination')) {
    function neptune_tv_pagination() {
        global $wp_query;
        
        if ($wp_query->max_num_pages <= 1) {
            return;
        }
        
        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $max = intval($wp_query->max_num_pages);
        
        if ($paged >= 1) {
            $links[] = $paged;
        }
        
        if ($paged >= 3) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }
        
        if (($paged + 2) <= $max) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }
        
        echo '<div class="pagination">' . "\n";
        
        if (get_previous_posts_link()) {
            printf('<a href="%s" class="page-numbers prev">%s</a>' . "\n", get_previous_posts_page_link(), '&laquo;');
        }
        
        if (!in_array(1, $links)) {
            $class = 1 == $paged ? ' class="page-numbers current"' : '';
            printf('<a href="%s"%s>%s</a>' . "\n", esc_url(get_pagenum_link(1)), $class, '1');
            
            if (!in_array(2, $links)) {
                echo '<span class="page-numbers dots">...</span>' . "\n";
            }
        }
        
        sort($links);
        foreach ((array) $links as $link) {
            $class = $paged == $link ? ' class="page-numbers current"' : '';
            printf('<a href="%s"%s>%s</a>' . "\n", esc_url(get_pagenum_link($link)), $class, $link);
        }
        
        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links)) {
                echo '<span class="page-numbers dots">...</span>' . "\n";
            }
            
            $class = $paged == $max ? ' class="page-numbers current"' : '';
            printf('<a href="%s"%s>%s</a>' . "\n", esc_url(get_pagenum_link($max)), $class, $max);
        }
        
        if (get_next_posts_link()) {
            printf('<a href="%s" class="page-numbers next">%s</a>' . "\n", get_next_posts_page_link(), '&raquo;');
        }
        
        echo '</div>' . "\n";
    }
}

if (!function_exists('neptune_tv_reading_time')) {
    function neptune_tv_reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);
        
        return $reading_time . ' min read';
    }
}

if (!function_exists('neptune_tv_post_classes')) {
    function neptune_tv_post_classes($classes) {
        if (!has_post_thumbnail()) {
            $classes[] = 'no-thumbnail';
        }
        
        return $classes;
    }
}
add_filter('post_class', 'neptune_tv_post_classes');

if (!function_exists('neptune_tv_estimated_reading_time')) {
    function neptune_tv_estimated_reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);
        
        if ($reading_time > 0) {
            printf(
                '<span class="reading-time">%s</span>',
                sprintf(esc_html(_n('%s minute read', '%s minutes read', $reading_time, 'neptune-tv')), $reading_time)
            );
        }
    }
}

if (!function_exists('neptune_tv_get_attachment_image_caption')) {
    function neptune_tv_get_attachment_image_caption($post_id) {
        $attachment = get_post($post_id);
        if (!$attachment) {
            return '';
        }
        
        return $attachment->post_excerpt;
    }
}
