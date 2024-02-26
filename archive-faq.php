<?php

/**
 * The FAQ archive
 *
 * @package edwp
 */

get_header();

echo '<div class="main-content" id="main">';

\EDWP\block('PageHeader', [
    'heading' => __('FAQs', 'edwp'),
]);

echo '<div class="js-faq-archive">';

// content
\EDWP\partial('partials/content/content-faq', [], [], true);

echo '</div>';

echo '</div>';

get_footer();
