<section class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>" <?php echo (!empty($args['image'])) ? " style='--image-url: url({$args["image"]["url"]});'" : ""; ?>">
    <div class="<?php echo $args['base_class']; ?>__content">
        <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" />
        <?php if ($args['two_columns'] == true) : ?>
            <div class="<?php echo $args['base_class']; ?>__image">
                <?php echo wp_get_attachment_image(get_post_thumbnail_id(get_the_id()), 'full'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>