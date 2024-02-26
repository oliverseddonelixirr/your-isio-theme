<?php
if (!isset($args['post_id'])) :
    return;
endif;

$categories = get_the_terms($args['post_id'] , 'infosheet_category');
$category_list = '<ul class="card-info__category-list">';
foreach ($categories as $category) {
    $category_list .= "<li class='card-info__category-list__item'>{$category->name}</li>";
}
$category_list .= '</ul>';
$file_link = '';
$info_file = get_field('infosheet_file', $args['post_id']);

if (!empty(get_field('infosheet_url', $args['post_id']))) {
    $file_link = get_field('infosheet_url', $args['post_id']);
}
if (!empty($info_file)) {
    $file_link = $info_file['url'];
}
?>
<article class="group card-info js-card-link swiper-slide">
    <header class="card-info__header">
        <a href="<?php echo $file_link; ?>" class="card-info__link" target="_blank">
            <?php echo get_the_title($args['post_id']); ?>
            <span class="card-info__link__arrow"><?php echo EDWP\svg::icon('arrow-right'); ?></span>
        </a>
    </header>
    <footer class="card-info__footer">
        <?php echo $category_list; ?>
        <p class="card-info__footer__date"><span class="card-info__footer__date-title"><?php echo __('Updated', 'edwp'); ?></span>
        <?php echo wp_date('F d, Y', get_post_timestamp($args['post_id'])); ?></p>
    </footer>
</article>