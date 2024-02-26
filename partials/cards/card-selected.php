<div class="group card-selected swiper-slide js-card-link">
    <div class="card-selected__inner">
        <?php if (!empty($args['image'])) : ?>
            <div class="card-selected__media">
                <?php echo $args['image']; ?>
            </div>
        <?php endif; ?>

        <div class="card-selected__main">
            <?php if (!empty($args['title'])) : ?>
                <div class="card-selected__title">
                    <a href="<?php echo get_permalink($args['post_id']); ?>"><?php echo $args['title']; ?></a>
                </div>
            <?php endif; ?>
            <?php if (!empty($args['content'])) : ?>
                <div class="card-selected__content">
                    <?php echo $args['content']; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($args['list_items'])) : ?>
                <ul class="card-selected__list">
                    <?php foreach ($args['list_items'] as $item) : ?>
                        <li class="card-selected__list-item">
                            <span class="card-selected__list-item__icon"><?php echo EDWP\svg::icon('check'); ?></span>
                            <?php echo $item['item']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="card-selected__link">
                <a class="card-selected__button" href="<?php echo get_permalink($args['post_id']); ?>">Find out more</a>
            </div>
        </div>
    </div>
</div>