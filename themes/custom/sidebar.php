<aside class="sidebar">
    <div class="sidebar-widget">
        <?php if ( is_active_sidebar('sidebar-1') ): ?>
            <?php dynamic_sidebar('sidebar-1'); ?>
        <?php else: ?>
            <div class="widget">
                <h3 class="widget-title"><?php esc_html_e('Search', 'my-dark-theme'); ?></h3>
                <?php get_search_form(); ?>
            </div>

            <div class="widget">
                <h3 class="widget-title"><?php esc_html_e('Recent Posts', 'my-dark-theme'); ?></h3>
                <ul>
                    <?php
                    $recent_posts = wp_get_recent_posts([ 'numberposts' => 5 ]);
                    foreach ( $recent_posts as $post ): ?>
                        <li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</aside>