<?php

/**
 * The template for displaying the search form.
 *
 * @package edwp
 */

?>

<div itemscope itemtype="http://schema.org/WebSite" class="wp-block-search-form">
    <div class="content-container">
        <form role="search" id="searchform" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <meta itemprop="target" content="<?php echo esc_url(home_url()); ?>/?s={s}" />
            <label class="wp-block-search-form__label" for="search-field">
                <?php
                if (get_search_query()) :
                    echo esc_html_x('Results for ', 'label', 'edwp');
                else :
                    echo esc_html_x('Search for ', 'label', 'edwp');
                endif;
                ?>
            </label>
            <div class="wp-block-search-form__fields">
                <input class="wp-block-search-form__fields__input" itemprop="query-input" type="search" id="search-field" value="<?php echo get_search_query(); ?>" name="s" />
                <button class="wp-block-search-form__fields__button" type="submit" label="<?php echo esc_attr_x('Submit', 'submit button', 'edwp'); ?>">
                    <?php echo EDWP\svg::icon('search'); ?>
                </button>
            </div>
        </form>
    </div>
</div>