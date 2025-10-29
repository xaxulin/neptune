<?php
get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <div class="content-area">
                <?php
                if (have_posts()) :
                    if (is_home() && !is_front_page()) :
                        ?>
                        <header>
                            <h1 class="page-title"><?php single_post_title(); ?></h1>
                        </header>
                        <?php
                    endif;
                    ?>

                    <div class="posts-list">
                        <?php
                        while (have_posts()) :
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-card-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('neptune-tv-featured'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-card-content">
                                    <header class="entry-header">
                                        <?php
                                        the_title('<h2 class="post-card-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                        ?>
                                    </header>

                                    <div class="post-card-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="post-card-meta">
                                        <?php
                                        printf(
                                            esc_html__('By %s on %s', 'neptune-tv'),
                                            '<span class="author">' . esc_html(get_the_author()) . '</span>',
                                            '<span class="date">' . esc_html(get_the_date()) . '</span>'
                                        );
                                        ?>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        ?>
                    </div>

                    <?php
                    the_posts_navigation(array(
                        'prev_text' => esc_html__('&larr; Older posts', 'neptune-tv'),
                        'next_text' => esc_html__('Newer posts &rarr;', 'neptune-tv'),
                    ));

                else :
                    ?>
                    <section class="no-results not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e('Nothing Found', 'neptune-tv'); ?></h1>
                        </header>

                        <div class="page-content">
                            <?php
                            if (is_home() && current_user_can('publish_posts')) :
                                printf(
                                    '<p>' . wp_kses(
                                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'neptune-tv'),
                                        array(
                                            'a' => array(
                                                'href' => array(),
                                            ),
                                        )
                                    ) . '</p>',
                                    esc_url(admin_url('post-new.php'))
                                );
                            elseif (is_search()) :
                                ?>
                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'neptune-tv'); ?></p>
                                <?php
                                get_search_form();
                            else :
                                ?>
                                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'neptune-tv'); ?></p>
                                <?php
                                get_search_form();
                            endif;
                            ?>
                        </div>
                    </section>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </main>

<?php
get_footer();
