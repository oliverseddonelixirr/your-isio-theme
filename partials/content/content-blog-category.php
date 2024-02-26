<?php
$category = get_category(get_query_var('cat'));
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$post_args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
    'cat' => $category->cat_ID,
);

$post_list = new WP_Query($post_args);

echo "<div class='card-blog__section--category'>";

$GLOBALS['wp_query']->max_num_pages = $post_list->max_num_pages;
// posts
\EDWP\block('Cards', [
    'title' => $category->name,
    'posts' => $post_list->posts,
    'post_type' => ['post'],
    'paginated' => true,
]);

echo "</div>";
