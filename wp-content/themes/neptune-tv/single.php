<?php
get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <div class="content-area">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php
                            the_title('<h1 class="entry-title">', '</h1>');

                            if ('post' === get_post_type()) :
                                ?>
                                <div class="entry-meta">
                                    <?php
                                    neptune_tv_posted_on();
                                    neptune_tv_posted_by();
                                    ?>
                                </div>
                                <?php
                            endif;
                            ?>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('neptune-tv-featured'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content(sprintf(
                                wp_kses(
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'neptune-tv'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post(get_the_title())
                            ));

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'neptune-tv'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <footer class="entry-footer">
                            <?php neptune_tv_entry_footer(); ?>
                        </footer>
                    </article>

                    <?php
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'neptune-tv') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'neptune-tv') . '</span> <span class="nav-title">%title</span>',
                    ));

                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile;
                ?>
            </div>
        </div>
    </main>

<?php
get_footer();
