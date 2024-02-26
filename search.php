<?php

/**
 * Template Name: Search
 *
 * @package edwp
 */

get_header();

echo '<div class="main-content" id="main">';

\EDWP\block('PageHeader', [
    'heading' => __('Search', 'edwp'),
]);

echo '<div class="search-results-form">';
echo '<div class="search-results-form__inner">';

get_search_form();

if (get_search_query()) : ?>

    <div class="search-results-form__list">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                echo sprintf(
                    '<article class="search-results-form__list-item"><a href="%s" class="search-results-form__list-item__link">%s</a></article>',
                    get_the_permalink(),
                    get_the_title(),
                );
            endwhile;
        else :
        ?>
            <p><?php esc_html_e('No search results found.', 'edwp'); ?></p>
        <?php endif; ?>
    </div>

<?php
endif;

echo '</div>';
echo '</div>';

echo '</div>';

get_footer();
