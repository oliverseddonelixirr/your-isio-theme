<?php

/**
 * The Page template file.
 *
 * @package edwp
 */

get_header();

echo '<main class="main-content" id="main">';

while (have_posts()) : the_post();
    the_content();
endwhile;

echo '</main>';

get_footer();
