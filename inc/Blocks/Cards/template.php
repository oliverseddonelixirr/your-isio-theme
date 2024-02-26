<?php if (!empty($args['cards']) || is_admin()) : ?>
    <section class="<?php echo $args['classes']; ?>" data-columns="<?php echo $args['columns']; ?>" id="<?php echo $args['section_anchor']; ?>">
        <div class="wp-block-cards__container">
            <?php if (!empty($args['title']) || !empty($args['description'])) : ?>
                <header class="wp-block-cards__header">
                    <?php if (!empty($args['title'])) : ?>
                        <h2 class="wp-block-cards__header-title <?php echo $args['title_class']; ?>">
                            <?php echo $args['title']; ?>
                        </h2>
                    <?php endif; ?>
                    <?php if (!empty($args['subtitle'])) : ?>
                        <h3 class="<?php echo $args['subtitle_class']; ?>">
                            <?php echo $args['subtitle']; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if (!empty($args['description'])) : ?>
                        <div class="wp-block-cards__description">
                            <?php echo $args['description']; ?>
                        </div>
                    <?php endif; ?>
                </header>
            <?php endif; ?>

            <?php if (!empty($args['cards'])) : ?>
                <?php if ($args['slider']) : ?>
                    <div class="js-swiper-container swiper-container">
                        <div class="wp-block-cards__grid js-swiper-wrapper">
                            <?php foreach ($args['cards'] as $card) : ?>
                                <?php echo $card; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="wp-block-cards__grid facetwp-template">
                        <?php foreach ($args['cards'] as $card) : ?>
                            <?php echo $card; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($args['paginated'] == true) : ?>
                        <?php echo the_posts_pagination(array(
                            'show_all' => true,
                            'prev_next' => false,
                            'type' => 'list',
                        )); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php elseif (is_admin()) : ?>
                <p><?php echo __('No cards available.', 'edwp'); ?></p>
            <?php endif; ?>

            <?php if ($args['slider']) : ?>
                <div class="wp-block-cards__controls swiper-controls">
                    <button title="<?php echo __('Prev', 'edwp'); ?>" class="swiper-button-prev wp-block-cards__control wp-block-cards__control--prev">
                        <?php echo \EDWP\Svg::get('arrow'); ?>
                    </button>
                    <button title="<?php echo __('Next', 'edwp'); ?>" class="swiper-button-next wp-block-cards__control wp-block-cards__control--next">
                        <?php echo \EDWP\Svg::get('arrow'); ?>
                    </button>
                </div>
                <div class="wp-block-cards__pagination js-swiper-pagination"></div>
            <?php endif; ?>

            <?php if (!empty($args['link'])) : ?>
                <div class="wp-block-cards__footer">
                    <?php echo generate_link($args['link'], 'wp-block-cards__link'); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>