<?php
$posts = get_posts([
    'post_type' => 'faq',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
]);

$category_nav = "
    <div class='content-navigation'>
        <ul class='content-navigation__list'>
";
foreach ($posts as $post) {
    $nav_title = get_the_title($post->ID);
    $category_nav .= "
        <li class='content-navigation__item'>
            <a href='#faq-{$post->ID}' class='content-navigation__link'>{$nav_title}</a>
        </li>
    ";
}
$category_nav .= "</ul></div>";

echo $category_nav;

echo "<div class='faq-list__section'>";

$posts = get_posts([
    'post_type' => 'faq',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
]);

foreach ($posts as $index => $post) {
    $title = get_the_title($post->ID);
    $icon_plus = EDWP\svg::icon('plus');
    echo "
        <div class='faq-list__container js-faq-list-section' id='faq-{$post->ID}'>
            <div class='faq-list__container-inner'>
                <h2 class='faq-list__heading'>{$title}</h2>
                <div class='faq-list__container__content'>
                    <button type='button' class='faq-list__title js-faq-list-accordion' aria-selected='false'>
                        {$title}
                        <span class='faq-list__title__icon'>{$icon_plus}</span>
                    </button>
                    <article class='faq-list js-faq-list'>
    ";
    foreach (get_field('faq_list', $post->ID) as $item) {
        $icon_chevron = EDWP\svg::icon('chevron-down');
        echo "
            <details class='faq-list__details'>
                <summary class='faq-list__summary'>
                    {$item['faq_definition']}
                    <span class='faq-list__summary__arrow'>{$icon_chevron}</span>
                </summary>
                <div class='faq-list__content'>{$item['faq_description']}</div>
            </details>
        ";
    }
    echo "</article></div></div></div>";
}

echo "</div>";
