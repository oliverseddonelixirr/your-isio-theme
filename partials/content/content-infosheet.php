<?php
$categories = get_categories('taxonomy=infosheet_category&type=infosheet');

$category_nav = "
    <div class='content-navigation'>
        <ul class='content-navigation__list'>
            <li class='content-navigation__item'>
                <a href='#latest-updates' class='content-navigation__link'>Latest updates</a>
            </li>
";
foreach ($categories as $category) {
    $category_nav .= "
        <li class='content-navigation__item'>
            <a href='#{$category->slug}' class='content-navigation__link'>{$category->name}</a>
        </li>
    ";
}
$category_nav .= "</ul></div>";

echo $category_nav;

\EDWP\block('Cards', [
    'title' => __('Latest updates', 'edwp'),
    'post_type' => ['infosheet'],
    'display' => 'latest',
    'section_anchor' => 'latest-updates',
]);

foreach ($categories as $index => $category) {
    $posts = get_posts(get_info_posts($category->term_id));
    $class = '';
    if ($index % 2 == 0) {
        $class = 'wp-block-cards--even';
    }

    \EDWP\block('Cards', [
        'title' =>  $category->name,
        'posts' => $posts,
        'post_type' => ['infosheet'],
        'section_anchor' => $category->slug,
        'classes' => [$class],
    ]);
}

function get_info_posts($category)
{
    $args = [];

    if (!empty($category)) {
        $args = [
            'post_type' => 'infosheet',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => [
                [
                    'taxonomy' => 'infosheet_category',
                    'field' => 'id',
                    'terms' => $category,
                ]
            ]
        ];
    }

    return $args;
}
