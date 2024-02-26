<?php if (!empty($args['images'])) : ?>
    <section class="<?php echo $args['classes']; ?>">
        <div class="wp-block-carousel__outer">
            <div class="wp-block-carousel__slides swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($args['images'] as $image) : ?>
                        <div class="wp-block-carousel__slide swiper-slide">
                            <?php
                            if (!empty($image['image'])) :
                                echo wp_get_attachment_image(
                                    $image['image']['ID'],
                                    'full',
                                    false,
                                    ['class' => 'wp-block-carousel__image']
                                );
                            endif;
                            if (!empty($image['mobile_image'])) :
                                echo wp_get_attachment_image(
                                    $image['mobile_image']['ID'],
                                    'full',
                                    false,
                                    ['class' => 'wp-block-carousel__mobile-image']
                                );
                            endif;
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="wp-block-carousel__content">
                <div class="wp-block-carousel__container">
                    <div class="wp-block-carousel__label">
                        <?php echo $args['label']; ?>
                    </div>
                    <div class="wp-block-carousel__title-container">
                        <div class="wp-block-carousel__title">
                            <?php echo $args['title']; ?>
                        </div>
                        <div class="wp-block-carousel__subtitle">
                            <?php echo $args['subtitle']; ?>
                        </div>
                    </div>
                    <?php if (!empty($args['content'])) : ?>
                        <div class="wp-block-carousel__text">
                            <?php echo $args['content']; ?>
                        </div>
                    <?php endif; ?>
                    <div class="wp-block-carousel__link">
                        <?php echo $args['link']; ?>
                    </div>

                    <?php if (count($args['images']) > 1) : ?>
                        <div class="wp-block-carousel__controls swiper-controls">
                            <button title="<?php echo __('Prev', 'edwp'); ?>" class="swiper-button-prev wp-block-carousel__control wp-block-carousel__control--prev">
                                <?php echo \EDWP\Svg::get('arrow'); ?>
                            </button>
                            <button title="<?php echo __('Next', 'edwp'); ?>" class="swiper-button-next wp-block-carousel__control wp-block-carousel__control--next">
                                <?php echo \EDWP\Svg::get('arrow'); ?>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>