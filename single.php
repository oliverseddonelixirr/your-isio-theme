<?php

/**
 * The Post template file.
 *
 * @package edwp
 */

get_header();

echo '<div class="main-content" id="main">';

$post_date = wp_date('j F Y', get_post_timestamp(get_the_ID()));
$posttags = wp_get_post_categories(get_the_ID());
$cats = array();
$tagList = "<ul class='card-blog__taglist__list'>";
if ($posttags) {
    foreach ($posttags as $tag) {
        $cat = get_category($tag);
        $tagList .= "<li class='card-blog__taglist__item card-blog__taglist__item--inverted'>{$cat->name}</li>";
    }
}
$tagList .= "</ul>";

\EDWP\block('PageHeader', [
    'heading' => get_the_title(),
    'text' => "<span class='wp-block-page-header__text--thin'>Last updated</span> {$post_date}",
    'additional_content' => $tagList,
    'text_wide' => true,
    'header_image' => array('url' => get_the_post_thumbnail_url(get_the_ID(), 'header_background')),
    'image_mask' => true,
]);

echo '<div class="single-content__container">';

the_content();

echo '</div>';

// get modified date
$modified_date = date_create(get_the_modified_date('Y-n-j H:i:s'));
// get 1 second before
$before_date = date_sub($modified_date, date_interval_create_from_date_string('1 second'));

$prev_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'date_query' => array(
        'before' => date_format($before_date, 'Y-n-j H:i:s'),
        'inclusive' => true,
        'column' => 'post_modified',
    ),
);
$prev_posts = new WP_Query($prev_args);

\EDWP\block('Cards', [
    'title' => __('Up next', 'edwp'),
    'posts' => $prev_posts->posts,
    'post_type' => ['post'],
    'columns' => 1,
    'display_on_desktop' => 'slider',
    'display_on_mobile' => 'slider',
    'link' => array('title' => __('See all articles', 'edwp'), 'url' => get_post_type_archive_link('post')),
]);

\EDWP\block('PageLinks', [
    'title' => get_field('form_links_ title', 'option'),
    'description' => get_field('form_links_description', 'option'),
    'background_colour' => true,
    'page_links' => get_field('form_links_page_links', 'option'),
    'link' => get_field('form_links_link', 'option'),
]);

echo '</div>';

get_footer();
