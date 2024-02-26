<?php
$plsa_args = array(
    'post_type' => 'plsa',
    'posts_per_page' => -1,
    'meta_key' => 'plsa_bracket_min',
    'orderby' => 'meta_value',
    'order' => 'ASC'
);
$plsa_query = new WP_Query($plsa_args);
$brackets = array();

foreach ($plsa_query->posts as $post) {
    $min = get_field('plsa_bracket_min', $post->ID);
    $max = get_field('plsa_bracket_max', $post->ID);
    $values = array();
    $values['name'] = $post->post_name;
    $values['link'] = get_field('plsa_bracket_page', $post->ID);
    $values['link_couple'] = get_field('plsa_bracket_page_couple', $post->ID);
    $values['min'] = $min;
    $values['max'] = $max;
    $values['min_couple'] = get_field('plsa_bracket_min_couple', $post->ID) ? get_field('plsa_bracket_min_couple', $post->ID) : (int)$min * 2;
    $values['max_couple'] = get_field('plsa_bracket_max_couple', $post->ID) ? get_field('plsa_bracket_max_couple', $post->ID) : (int)$max * 2;
    $brackets[] = $values;
}
?>

<div class="<?php echo $args['base_class']; ?>">
    <div class="<?php echo $args['base_class']; ?>__inner">
        <?php if (!empty($args['plsa_form_image'])) : ?>
            <div class="<?php echo $args['base_class']; ?>__media">
                <?php echo wp_get_attachment_image($args['plsa_form_image']['ID'], 'card'); ?>
            </div>
        <?php endif; ?>
        <div class="<?php echo $args['base_class']; ?>__main">
            <div class="<?php echo $args['base_class']; ?>__copy">
                <?php if (!empty($args['plsa_form_heading'])) : ?>
                    <div class="card-selected__title">
                        <?php echo $args['plsa_form_heading']; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($args['plsa_form_summary'])) : ?>
                    <div class="<?php echo $args['base_class']; ?>__content">
                        <?php echo $args['plsa_form_summary']; ?>
                    </div>
                <?php endif; ?>
                <form class="<?php echo $args['base_class']; ?>__form js-plsa-form" data-js-brackets='<?php echo json_encode($brackets); ?>'>
                    <div class="<?php echo $args['base_class']; ?>__input-row">
                        <div class="<?php echo $args['base_class']; ?>__toggle">
                            <input class="js-plsa-form-type" type="checkbox" id="couple_toggle" />
                            <span class="slider round"></span>
                        </div>
                        <label class="<?php echo $args['base_class']; ?>__label" for="couple_toggle"><?php echo __('Couple?', 'edwp'); ?></label>
                    </div>
                    <div class="<?php echo $args['base_class']; ?>__input-row">
                        <label class="<?php echo $args['base_class']; ?>__label" for="projected"><?php echo __('Projected annual pension at retirement age:', 'edwp'); ?></label>
                        <div class="<?php echo $args['base_class']; ?>__input-row__inner">
                            &pound;<input class="<?php echo $args['base_class']; ?>__inner__input js-plsa-form-input" type="number" id="projected" />
                        </div>
                    </div>
                    <div class="<?php echo $args['base_class']; ?>__input-row">
                        <label class="hidden" for="projected_additional"><?php echo __('Projected additional annual pension at retirement age:', 'edwp'); ?></label>
                        <div class="<?php echo $args['base_class']; ?>__input-row__inner <?php echo $args['base_class']; ?>__input-row__inner--hidden">
                            &pound;<input class="<?php echo $args['base_class']; ?>__inner__input hidden js-plsa-form-input" type="number" id="projected_additional" />
                        </div>
                    </div>
                    <div class="<?php echo $args['base_class']; ?>__link">
                        <a href="<?php echo get_permalink(); ?>" class="<?php echo $args['base_class']; ?>__button disabled js-plsa-form-button"><?php echo $args['plsa_form_cta']; ?></a>
                    </div>
                    <?php if (!empty($args['plsa_form_details'])) : ?>
                        <div class="<?php echo $args['base_class']; ?>__content-sub">
                            <?php echo $args['plsa_form_details']; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>