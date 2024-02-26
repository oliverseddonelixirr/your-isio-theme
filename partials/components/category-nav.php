<?php
$latest_text = __('Latest updates', 'edwp');
$all_text = __('All news', 'edwp');
$categories = get_categories('taxonomy=category&type=post');
$category_nav = "
    <div class='content-navigation'>
        <ul class='content-navigation__list'>
";
if (is_home()) {
    $category_nav .= "
        <li class='content-navigation__item'>
            <a href='#latest-updates' class='content-navigation__link'>{$latest_text}</a>
        </li>
    ";
} else {
    $blog_page = get_post_type_archive_link('post');
    $category_nav .= "
        <li class='content-navigation__item'>
            <a href='{$blog_page}' class='content-navigation__link'>{$all_text}</a>
        </li>
    ";
}
foreach ($categories as $category) {
    $category_link = get_category_link($category->term_id);
    $current_cat = get_query_var('cat');
    $current_class = '';

    if ($current_cat == $category->term_id) {
        $current_class = ' content-navigation__link--current';
    }
    $category_nav .= "
        <li class='content-navigation__item'>
            <a href='{$category_link}' class='content-navigation__link{$current_class}'>{$category->name}</a>
        </li>
    ";
}
$category_nav .= "</ul></div>";



echo $category_nav;
