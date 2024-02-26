<?php
if (!isset($args['post_id'])) :
    return;
endif;

$posttags = wp_get_post_categories($args['post_id']);
$cats = array();
$tagList = "<ul class='card-blog__taglist__list'>";
if ($posttags) {
    foreach ($posttags as $tag) {
        $cat = get_category($tag);
        $tagList .= "<li class='card-blog__taglist__item'>{$cat->name}</li>";
    }
}
$tagList .= "</ul>";

$thumb_size = 'article-card';

switch ($args['card_args']['columns']) {
    case '1':
        $thumb_size = 'article-card-xl';
        break;
    case '2':
        $thumb_size = 'article-card-lg';
        break;
    case '3':
        $thumb_size = 'article-card-md';
        break;
    case '4':
        $thumb_size = 'article-card-sm';
        break;

    default:
        $thumb_size = 'article-card-md';
        break;
}
?>

<div class="group card-blog swiper-slide js-card-link">
    <?php if (has_post_thumbnail($args['post_id'])) : ?>
        <div class="card-blog__media">
            <?php echo wp_get_attachment_image(get_post_thumbnail_id($args['post_id']), $thumb_size); ?>
        </div>
    <?php endif; ?>
    <div class="card-blog__content">
        <div class="card-blog__content__copy">
            <div class="card-blog__date">
                <p class="card-blog__date__copy"><span class="card-blog__date__title"><?php echo __('Updated', 'edwp'); ?></span>
                    <?php echo get_the_modified_date('F d, Y', $args['post_id']); ?></p>
                <span class="card-blog__date__arrow"><?php echo EDWP\svg::icon('arrow-right'); ?></span>
            </div>
            <div class="card-blog__title">
                <a href="<?php echo get_permalink($args['post_id']); ?>" class="card-blog__link">
                    <?php echo get_the_title($args['post_id']); ?>
                </a>
            </div>
        </div>
        <div class="card-blog__taglist">
            <?php echo $tagList; ?>
        </div>
    </div>
</div>