<?php

/**
 * The 404 Not Found template.
 *
 * @package edwp
 */

get_header();

echo '<div class="main-content" id="main">';

\EDWP\block('PageHeader', [
    'heading' => __('404 error', 'edwp'),
]);

$not_found = __('Page not found.', 'edwp');

echo '<div class="wp-block-wrapper__content">';

echo "<h2 class='h1'>{$not_found}</h2>";

echo '</div>';

echo '</div>';

get_footer();
