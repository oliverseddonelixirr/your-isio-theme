<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$post_args = array(
    'offset' => 3,
    'post_type' => 'post',
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'orderby' => 'modified',
    'order' => 'DESC',
    'paged' => $paged,
);

$post_list = new WP_Query($post_args);

echo "<div class='card-blog__section'>";

$GLOBALS['wp_query']->max_num_pages = $post_list->max_num_pages;
// posts
\EDWP\block('Cards', [
    'posts' => $post_list->posts,
    'post_type' => ['post'],
    'paginated' => true,
]);

echo "</div>";
