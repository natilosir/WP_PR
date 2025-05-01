<?php

get_header(); ?>

    <main id="primary" class="site-main">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part('template-parts/content', 'single');

                // ناوبری پست‌های قبلی و بعدی
                the_post_navigation([
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'your-theme-textdomain') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'your-theme-textdomain') . '</span> <span class="nav-title">%title</span>',
                ]);

                // اگر کامنت‌ها باز هستند یا تعداد کامنت‌ها بیشتر از صفر است
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div><!-- .container -->
    </main><!-- #main -->

<?php
get_sidebar();
get_footer();