    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
                <div class="footer-widgets">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="site-info">
                <?php
                $footer_text = get_theme_mod('neptune_tv_footer_text');
                if ($footer_text) {
                    echo wp_kses_post($footer_text);
                } else {
                    printf(
                        esc_html__('&copy; %1$s %2$s. Powered by %3$s', 'neptune-tv'),
                        date('Y'),
                        '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>',
                        '<a href="https://wordpress.org/">WordPress</a>'
                    );
                }
                ?>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
