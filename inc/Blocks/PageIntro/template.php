<?php if (!empty($args['intro']) || !empty($args['content'])) : ?>
    <section class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
        <div class="<?php echo $args['base_class']; ?>__inner">
            <div class="<?php echo $args['base_class']; ?>__content">
                <?php if (!empty($args['intro'])) : ?>
                    <h2 class="<?php echo $args['base_class']; ?>__intro"><?php echo $args['intro']; ?></h2>
                <?php endif; ?>
                <?php if (!empty($args['content'])) : ?>
                    <div class="<?php echo $args['base_class']; ?>__copy"><?php echo $args['content']; ?></div>
                <?php endif; ?>
                <?php if (!empty($args['link'])) : ?>
                    <div class="<?php echo $args['base_class']; ?>__footer">
                        <?php echo generate_link($args['link'], "{$args['base_class']}__footer__link"); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>