<?php

if (!defined('ABSPATH')) {
    exit;
}

define('NEPTUNE_TV_VERSION', '1.0.0');

require_once get_template_directory() . '/inc/template-tags.php';

function neptune_tv_setup() {
    load_theme_textdomain('neptune-tv', get_template_directory() . '/languages');
    
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    add_theme_support('customize-selective-refresh-widgets');
    
    add_theme_support('responsive-embeds');
    
    add_theme_support('align-wide');
    
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    add_theme_support('wp-block-styles');
    
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'neptune-tv'),
        'footer'  => esc_html__('Footer Menu', 'neptune-tv'),
    ));
    
    add_image_size('neptune-tv-featured', 1280, 720, true);
    add_image_size('neptune-tv-thumbnail', 400, 225, true);
}
add_action('after_setup_theme', 'neptune_tv_setup');

function neptune_tv_content_width() {
    $GLOBALS['content_width'] = apply_filters('neptune_tv_content_width', 1280);
}
add_action('after_setup_theme', 'neptune_tv_content_width', 0);

function neptune_tv_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'neptune-tv'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'neptune-tv'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'neptune-tv'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in footer column 1.', 'neptune-tv'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'neptune-tv'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in footer column 2.', 'neptune-tv'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'neptune-tv'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in footer column 3.', 'neptune-tv'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'neptune_tv_widgets_init');

function neptune_tv_scripts() {
    wp_enqueue_style('neptune-tv-style', get_stylesheet_uri(), array(), NEPTUNE_TV_VERSION);
    wp_enqueue_style('neptune-tv-main', get_template_directory_uri() . '/assets/css/main.css', array(), NEPTUNE_TV_VERSION);
    
    wp_enqueue_script('neptune-tv-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NEPTUNE_TV_VERSION, true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'neptune_tv_scripts');

function neptune_tv_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'neptune_tv_excerpt_length');

function neptune_tv_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'neptune_tv_excerpt_more');

function neptune_tv_body_classes($classes) {
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'neptune_tv_body_classes');

function neptune_tv_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'neptune_tv_pingback_header');

function neptune_tv_customize_register($wp_customize) {
    $wp_customize->add_section('neptune_tv_colors', array(
        'title'    => __('Neptune TV Colors', 'neptune-tv'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('neptune_tv_primary_color', array(
        'default'           => '#0066ff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'neptune_tv_primary_color', array(
        'label'    => __('Primary Color', 'neptune-tv'),
        'section'  => 'neptune_tv_colors',
        'settings' => 'neptune_tv_primary_color',
    )));
    
    $wp_customize->add_setting('neptune_tv_secondary_color', array(
        'default'           => '#00d4ff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'neptune_tv_secondary_color', array(
        'label'    => __('Secondary Color', 'neptune-tv'),
        'section'  => 'neptune_tv_colors',
        'settings' => 'neptune_tv_secondary_color',
    )));
    
    $wp_customize->add_section('neptune_tv_layout', array(
        'title'    => __('Neptune TV Layout', 'neptune-tv'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('neptune_tv_sidebar_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'neptune_tv_sanitize_sidebar_position',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('neptune_tv_sidebar_position', array(
        'label'    => __('Sidebar Position', 'neptune-tv'),
        'section'  => 'neptune_tv_layout',
        'settings' => 'neptune_tv_sidebar_position',
        'type'     => 'select',
        'choices'  => array(
            'left'  => __('Left', 'neptune-tv'),
            'right' => __('Right', 'neptune-tv'),
            'none'  => __('No Sidebar', 'neptune-tv'),
        ),
    ));
    
    $wp_customize->add_section('neptune_tv_footer', array(
        'title'    => __('Neptune TV Footer', 'neptune-tv'),
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('neptune_tv_footer_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('neptune_tv_footer_text', array(
        'label'    => __('Footer Copyright Text', 'neptune-tv'),
        'section'  => 'neptune_tv_footer',
        'settings' => 'neptune_tv_footer_text',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'neptune_tv_customize_register');

function neptune_tv_sanitize_sidebar_position($input) {
    $valid = array('left', 'right', 'none');
    return in_array($input, $valid) ? $input : 'right';
}

function neptune_tv_get_custom_colors() {
    $primary_color = get_theme_mod('neptune_tv_primary_color', '#0066ff');
    $secondary_color = get_theme_mod('neptune_tv_secondary_color', '#00d4ff');
    
    if ($primary_color !== '#0066ff' || $secondary_color !== '#00d4ff') {
        echo '<style type="text/css">';
        if ($primary_color !== '#0066ff') {
            echo ':root { --color-primary: ' . esc_attr($primary_color) . '; }';
        }
        if ($secondary_color !== '#00d4ff') {
            echo ':root { --color-secondary: ' . esc_attr($secondary_color) . '; }';
        }
        echo '</style>';
    }
}
add_action('wp_head', 'neptune_tv_get_custom_colors');

function neptune_tv_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    
    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date())
    );
    
    $posted_on = sprintf(
        esc_html_x('Posted on %s', 'post date', 'neptune-tv'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );
    
    echo '<span class="posted-on">' . $posted_on . '</span>';
}

function neptune_tv_posted_by() {
    $byline = sprintf(
        esc_html_x('by %s', 'post author', 'neptune-tv'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );
    
    echo '<span class="byline"> ' . $byline . '</span>';
}

function neptune_tv_entry_footer() {
    if ('post' === get_post_type()) {
        $categories_list = get_the_category_list(esc_html__(', ', 'neptune-tv'));
        if ($categories_list) {
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'neptune-tv') . '</span>', $categories_list);
        }
        
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'neptune-tv'));
        if ($tags_list) {
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'neptune-tv') . '</span>', $tags_list);
        }
    }
    
    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'neptune-tv'),
                    array('span' => array('class' => array()))
                ),
                wp_kses_post(get_the_title())
            )
        );
        echo '</span>';
    }
    
    edit_post_link(
        sprintf(
            wp_kses(
                __('Edit <span class="screen-reader-text">%s</span>', 'neptune-tv'),
                array('span' => array('class' => array()))
            ),
            wp_kses_post(get_the_title())
        ),
        '<span class="edit-link">',
        '</span>'
    );
}
