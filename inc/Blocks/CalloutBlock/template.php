<?php if (!empty($args['title']) || !empty($args['content'])) : ?>
    <article class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
        <?php if (!empty($args['title'])) : ?>
            <h2 class="<?php echo $args['base_class']; ?>__intro"><?php echo $args['title']; ?></h2>
        <?php endif; ?>
        <?php if (!empty($args['content'])) : ?>
            <div class="<?php echo $args['base_class']; ?>__copy"><?php echo $args['content']; ?></div>
        <?php endif; ?>
    </article>
<?php endif; ?>