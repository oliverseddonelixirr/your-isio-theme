<div class="group card-static swiper-slide <?php echo (!empty($args['link'])) ? 'card-static--link js-card-link' : ''; ?> ">
    <div class="card-static__inner">
        <?php if (!empty($args['image'])) : ?>
            <div class="card-static__media">
                <?php echo $args['image']; ?>
            </div>
        <?php endif; ?>
        <div class="card-static__main">
            <div class="card-static__copy">
                <?php if (!empty($args['title'])) : ?>
                    <div class="card-selected__title">
                        <?php echo $args['title']; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($args['content'])) : ?>
                    <div class="card-static__content">
                        <?php echo $args['content']; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($args['link'])) : ?>
                <div class="card-static__link">
                    <?php echo generate_link($args['link'], 'btn'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>