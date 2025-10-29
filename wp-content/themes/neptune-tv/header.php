<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'neptune-tv'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                        $neptune_tv_description = get_bloginfo('description', 'display');
                        if ($neptune_tv_description || is_customize_preview()) :
                            ?>
                            <p class="site-description"><?php echo $neptune_tv_description; ?></p>
                        <?php endif;
                    }
                    ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'depth'          => 2,
                        ));
                    } else {
                        echo '<ul id="primary-menu">';
                        echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'neptune-tv') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/blog')) . '">' . esc_html__('Blog', 'neptune-tv') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'neptune-tv') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'neptune-tv') . '</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </nav>

                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'neptune-tv'); ?></span>
                    <span class="menu-icon">☰</span>
                </button>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">
