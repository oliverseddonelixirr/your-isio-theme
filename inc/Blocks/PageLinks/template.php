<?php if (!empty($args['page_links'])) : ?>
    <section class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
        <div class="<?php echo $args['base_class']; ?>__inner">
            <?php if (!empty($args['title']) || !empty($args['description'])) : ?>
                <header class="<?php echo $args['base_class']; ?>__header">
                    <?php if (!empty($args['title'])) : ?>
                        <h2 class="<?php echo $args['base_class']; ?>__header__title"><?php echo $args['title']; ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($args['description'])) : ?>
                        <p class="<?php echo $args['base_class']; ?>__header__text"><?php echo $args['description']; ?></p>
                    <?php endif; ?>
                </header>
            <?php endif; ?>
            <div class="<?php echo $args['base_class']; ?>__grid">
                <?php foreach ($args['page_links'] as $link) : ?>
                    <?php $post_id = url_to_postid($link['page_link']); ?>
                    <article class="<?php echo $args['base_class']; ?>__card group js-card-link">
                        <div class="<?php echo $args['base_class']; ?>__card__icon">
                            <?php echo EDWP\svg::icon($link['page_icon'], 'xlg'); ?>
                        </div>
                        <p class="<?php echo $args['base_class']; ?>__card__title">
                            <a class="<?php echo $args['base_class']; ?>__card__link" href="<?php echo $link['page_link']; ?>"><?php echo get_the_title($post_id); ?></a>
                        </p>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if (!empty($args['link'])) : ?>
                <footer class="<?php echo $args['base_class']; ?>__footer">
                    <?php echo generate_link($args['link'], "{$args['base_class']}__footer__link"); ?>
                </footer>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>