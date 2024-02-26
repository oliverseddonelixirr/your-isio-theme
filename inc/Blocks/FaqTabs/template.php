<?php if (!empty($args['title']) || !empty($args['tabs'])) : ?>
    <section class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
        <div class="<?php echo $args['base_class']; ?>__inner" data-js-tab="tabwrapper">
            <?php if (!empty($args['title'])) : ?>
                <h2 class="<?php echo $args['base_class']; ?>__header__title"><?php echo $args['title']; ?></h2>
            <?php endif; ?>
            <?php if (!empty($args['faq_tabs']) && !empty($args['tabs'])) : ?>
                <div class="<?php echo $args['base_class']; ?>__tabs-wrapper">
                    <div class="<?php echo $args['base_class']; ?>__tabs" data-js-tab="tablist" role="tablist" aria-label="FAQ Tabs">
                        <?php foreach ($args['faq_tabs'] as $tab) : ?>
                            <button class="<?php echo $args['base_class']; ?>__tabs__button" type="button" role="tab" tabindex="-1" aria-selected="false" aria-controls="tabpanel-<?php echo $tab->ID; ?>">
                                <?php echo get_the_title($tab->ID); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <?php foreach ($args['tabs'] as $tabpanel) : ?>
                        <?php echo $tabpanel; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>