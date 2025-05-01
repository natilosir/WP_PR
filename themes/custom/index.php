<?php get_header(); ?>

    <div class="content-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php if ( have_posts() ): ?>
                        <?php while ( have_posts() ): the_post(); ?>
                            <article <?php post_class(); ?>>
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <div class="entry-meta">
                                    <?php the_time('F j, Y'); ?> |
                                    <?php the_category(', '); ?> |
                                    <?php comments_number('No comments', '1 comment', '% comments'); ?>
                                </div>

                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                            </article>
                        <?php endwhile; ?>

                        <div class="pagination">
                            <?php the_posts_pagination([
                                'mid_size'  => 2,
                                'prev_text' => __('&laquo; Previous', 'my-dark-theme'),
                                'next_text' => __('Next &raquo;', 'my-dark-theme'),
                            ]); ?>
                        </div>
                    <?php else: ?>
                        <p><?php esc_html_e('No posts found.', 'my-dark-theme'); ?></p>
                    <?php endif; ?>
                </div>

                <div class="col-md-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>