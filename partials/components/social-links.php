<?php if (!empty($args['linkedin_url']) || !empty($args['facebook_url']) || !empty($args['instagram_url'])) : ?>
    <div class="social-links">
        <?php if (!empty($args['linkedin_url'])) : ?>
            <a
                href="<?php echo $args['linkedin_url']; ?>"
                target="_blank"
                rel="noreferer noopener"
                class="social-link"
                title="<?php echo __('Find us on Linkedin', 'edwp'); ?>"
            >
                <?php echo \EDWP\Svg::get('linkedin'); ?>
            </a>
        <?php endif; ?>

        <?php if (!empty($args['facebook_url'])) : ?>
            <a
                href="<?php echo $args['facebook_url']; ?>"
                target="_blank" rel="noreferer noopener"
                class="social-link"
                title="<?php echo __('Find us on Facebook', 'edwp'); ?>"
            >
                <?php echo \EDWP\Svg::get('facebook'); ?>
            </a>
        <?php endif; ?>

        <?php if (!empty($args['instagram_url'])) : ?>
            <a
                href="<?php echo $args['instagram_url']; ?>"
                target="_blank"
                rel="noreferer noopener"
                class="social-link"
                title="<?php echo __('Find us on Instagram', 'edwp'); ?>"
            >
                <?php echo \EDWP\Svg::get('instagram'); ?>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>
