<?php

/**
 * The Category
 *
 * @package edwp
 */

get_header();

echo '<div class="main-content" id="main">';

\EDWP\block('PageHeader', [
    'heading' => get_field('news_title', 'option'),
    'text' => get_field('news_intro', 'option'),
]);

// category navigation
\EDWP\partial('partials/components/category-nav', [], [], true);

// content
\EDWP\partial('partials/content/content-blog-category', [], [], true);

echo '</div>';

get_footer();
