<div class="live-search-container">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" class="search-field"
               placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'your-text-domain'); ?>"
               value="<?php echo get_search_query(); ?>" name="s" id="live-search-input" autocomplete="off"/>
        <div class="search-results-container"></div>
    </form>
</div>