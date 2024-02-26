<?php

/**
 * The Infosheet archive
 *
 * @package edwp
 */

get_header();

echo '<div class="main-content" id="main">';

\EDWP\block('PageHeader', [
    'heading' => __('Infosheets', 'edwp'),
]);

// content
\EDWP\partial('partials/content/content-infosheet', [], [], true);

echo '</div>';

get_footer();
