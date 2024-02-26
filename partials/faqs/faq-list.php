<?php
if (!isset($args['post_id'])) :
    return;
endif;
?>
<button type="button" id="tab-<?php echo $args['post_id']; ?>" class="faq-list__title js-faq-list-accordion" aria-selected="false" aria-controls="tabpanel-<?php echo $args['post_id']; ?>">
    <?php echo get_the_title($args['post_id']); ?>
    <span class="faq-list__title__icon"><?php echo EDWP\svg::icon('plus'); ?></span>
</button>
<article class="faq-list js-faq-list" data-js-tab="tabpanel-<?php echo $args['post_id']; ?>" tabindex="-1" role="tabpanel" aria-labelledby="tab-<?php echo $args['post_id']; ?>" hidden>
    <?php foreach (get_field('faq_list', $args['post_id']) as $item) : ?>
        <details class="faq-list__details">
            <summary class="faq-list__summary">
                <?php echo $item['faq_definition']; ?>
                <span class="faq-list__summary__arrow"><?php echo EDWP\svg::icon('chevron-down'); ?></span>
            </summary>
            <div class="faq-list__content"><?php echo $item['faq_description']; ?></div>
        </details>
    <?php endforeach; ?>
</article>