</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <div class="footer-widget">
                <?php if ( is_active_sidebar('footer-1') ): ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php endif; ?>
            </div>

            <div class="footer-widget">
                <h3 class="widget-title"><?php esc_html_e('Quick Links', 'my-dark-theme'); ?></h3>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                ]);
                ?>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'my-dark-theme'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>