<?php if (!empty(get_field('plsa_option_sections', 'option'))) : ?>
    <div class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?> js-section-form">
        <div class="<?php echo $args['base_class']; ?>__inner">
            <?php foreach (get_field('plsa_option_sections', 'option') as $option) : ?>
                <article class="<?php echo $args['base_class']; ?>__card">
                    <div class="<?php echo $args['base_class']; ?>__card__inner">
                        <?php if (!empty($option['plsa_option_section_icon'])) : ?>
                            <div class="<?php echo $args['base_class']; ?>__card__media">
                                <?php echo EDWP\svg::icon($option['plsa_option_section_icon'], 'xxl'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="<?php echo $args['base_class']; ?>__card__main">
                            <?php if (!empty($option['plsa_option_section_title'])) : ?>
                                <div class="<?php echo $args['base_class']; ?>__card__title">
                                    <h2><?php echo $option['plsa_option_section_title']; ?></h2>
                                </div>
                            <?php endif; ?>
                            <div class="<?php echo $args['base_class']; ?>__card__copy">
                                <?php if (!empty($option['plsa_option_section_summary'])) : ?>
                                    <div class="<?php echo $args['base_class']; ?>__card__content">
                                        <p><?php echo $option['plsa_option_section_summary']; ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($option['plsa_option_section_values'])) : ?>
                                <form class="<?php echo $args['base_class']; ?>__card__form js-value-form">
                                    <?php foreach ($option['plsa_option_section_values'] as $value) : ?>
                                        <div class="<?php echo $args['base_class']; ?>__card__form-row">
                                            <label class="<?php echo $args['base_class']; ?>__card__form__label">
                                                <?php echo $value['plsa_option_section_value_title']; ?>
                                                (<?php echo $value['plsa_option_section_value_duration'] . 'ly'; ?>)
                                            </label>
                                            <div class="<?php echo $args['base_class']; ?>__card__form__block">&pound;<input class="<?php echo $args['base_class']; ?>__card__form__input js-value-duration" type="number" value="0" data-js-duration="<?php echo $value['plsa_option_section_value_duration']; ?>" />
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <input class="js-value-duration-formtotal" type="hidden" value="0" />
                                    <p class="<?php echo $args['base_class']; ?>__card__average">
                                        <?php echo __('Your average monthly spend:', 'edwp'); ?>
                                        <span><span class="js-value-duration-total">&pound;0</span></span>
                                    </p>
                                </form>
                            <?php endif; ?>
                        </div>
                </article>
            <?php endforeach; ?>

            <article class="<?php echo $args['base_class']; ?>__results">
                <div class="<?php echo $args['base_class']; ?>__results__block">
                    <p><?php echo __('To reach the retirement lifestyle you would like, you will need an annual pension income of:', 'edwp'); ?>
                    </p>
                    <span class="<?php echo $args['base_class']; ?>__value js-value-duration-grandtotal">&pound;0</span>
                </div>
                <div class="<?php echo $args['base_class']; ?>__results__block">
                    <input class="js-value-duration-formprojected" type="hidden" value="0" />
                    <p><?php echo __('Currently, the projected value of your annual pension is:', 'edwp'); ?></p>
                    <span class="<?php echo $args['base_class']; ?>__value js-value-duration-projected"></span>
                </div>
                <div class="<?php echo $args['base_class']; ?>__results__block">
                    <p class="js-value-duration-resulttext"></p>
                    <div class="<?php echo $args['base_class']; ?>__results-footer">
                        <div class="<?php echo $args['base_class']; ?>__results-row">
                            <span class="<?php echo $args['base_class']; ?>__value js-value-duration-resultvalue"></span>
                            <span class="<?php echo $args['base_class']; ?>__icon hidden js-value-duration-icon"><?php echo EDWP\svg::icon('arrow-right', 'med'); ?></span>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
<?php endif; ?>