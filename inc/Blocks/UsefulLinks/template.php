<?php if (!empty($args['useful_links'])) : ?>
    <article class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
        <?php if (!empty($args['title'])) : ?>
            <h2 class="<?php echo $args['base_class']; ?>__title"><?php echo $args['title']; ?></h2>
        <?php endif; ?>
        <dl class="<?php echo $args['base_class']; ?>__link-list">
            <?php foreach ($args['useful_links'] as $link) : ?>
                <div>
                    <dt class="<?php echo $args['base_class']; ?>__link-list__title"><?php echo $link['title']; ?></dt>
                    <dd class="<?php echo $args['base_class']; ?>__link-list__description">
                        <a class="<?php echo $args['base_class']; ?>__link-list__link" href="<?php echo $link['useful_link']['url']; ?>" target="<?php echo $link['useful_link']['target']; ?>">
                            <?php echo $link['useful_link']['title']; ?><?php echo EDWP\svg::icon('outside-link', 'xsml'); ?>
                        </a>
                    </dd>
                </div>
            <?php endforeach; ?>
        </dl>
    </article>
<?php endif; ?>