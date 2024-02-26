<?php
$plsa_args = array(
    'post_type' => 'plsa',
    'posts_per_page' => -1,
    'meta_key' => 'plsa_bracket_min',
    'orderby' => 'meta_value',
    'order' => 'ASC'
);
$plsas = new WP_Query($plsa_args);
$brackets = array();

if (!empty($plsas)) {
    foreach ($plsas->posts as $post) {
        $values = array();
        $values['average'] = 0;
        $values['name'] = $post->post_name;
        $values['sections'] = get_field('plsa_bracket_sections', $post->ID);

        if (!empty($values['sections'])) {
            foreach ($values['sections'] as $section) {
                $values['average'] = $values['average'] + $section['plsa_bracket_section_monthly'];
            }
        }

        if ($args['single_bracket'] == true) {
            $values['min'] = get_field('plsa_bracket_min_couple', $post->ID) ? get_field('plsa_bracket_min_couple', $post->ID) : (int)get_field('plsa_bracket_min', $post->ID) * 2;
            $values['max'] = get_field('plsa_bracket_max_couple', $post->ID) ? get_field('plsa_bracket_max_couple', $post->ID) : (int)get_field('plsa_bracket_max', $post->ID) * 2;
            $values['summary'] = get_field('plsa_bracket_summary_couple', $post->ID) ? get_field('plsa_bracket_summary_couple', $post->ID) : get_field('plsa_bracket_summary', $post->ID);

            $brackets[] = $values;
        } else {
            $values['min'] = get_field('plsa_bracket_min', $post->ID);
            $values['max'] = get_field('plsa_bracket_max', $post->ID);
            $values['summary'] = get_field('plsa_bracket_summary', $post->ID);

            $brackets[] = $values;
        }
    }
}
?>

<?php if (!empty($brackets)) : ?>
    <div class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
        <div class="<?php echo $args['base_class']; ?>__inner">
            <div class="<?php echo $args['base_class']; ?>__table">
                <?php foreach ($brackets as $bracket) : ?>
                    <div class="<?php echo $args['base_class']; ?>__table-col js-sections-table-col" data-js-bracket="<?php echo $bracket['name']; ?>">
                        <article class="<?php echo $args['base_class']; ?>__table-cell">
                            <div class="<?php echo $args['base_class']; ?>__table-row">
                                <h2 class="<?php echo $args['base_class']; ?>__table-title"><?php echo $bracket['name']; ?></h2>
                            </div>
                            <div class="<?php echo $args['base_class']; ?>__table-row">
                                <p class="<?php echo $args['base_class']; ?>__table-subtitle">
                                    <?php echo __('Required annual pension income:', 'edwp'); ?></p>
                                <p class="<?php echo $args['base_class']; ?>__table-cost">
                                    &pound;<?php echo number_format($bracket['min']); ?>
                                    <?php if (!empty($bracket['max'])) : ?>
                                        <span>- &pound;<?php echo number_format($bracket['max']); ?></span>
                                    <?php else : ?>
                                        +
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="<?php echo $args['base_class']; ?>__table-row">
                                <p class="<?php echo $args['base_class']; ?>__table-subtitle">
                                    <?php echo __('In summary:', 'edwp'); ?>
                                </p>
                                <p><?php echo $bracket['summary']; ?></p>
                            </div>
                            <div class="<?php echo $args['base_class']; ?>__table-row">
                                <p class="<?php echo $args['base_class']; ?>__table-average">
                                    <?php echo __('Average monthly spend:', 'edwp'); ?>
                                    &pound;<?php echo number_format($bracket['average']); ?>
                                </p>
                            </div>
                        </article>
                        <?php if (!empty($bracket['sections'])) : ?>
                            <?php foreach ($bracket['sections'] as $section) : ?>
                                <article class="<?php echo $args['base_class']; ?>__table-cell">
                                    <h2 class="<?php echo $args['base_class']; ?>__table-cell__title">
                                        <?php echo $section['plsa_bracket_section']; ?></h2>
                                    <div class="<?php echo $args['base_class']; ?>__table-row--full">
                                        <?php echo wp_get_attachment_image($section['plsa_bracket_section_image']['ID'], 'card'); ?>
                                    </div>
                                    <p><?php echo $section['plsa_bracket_section_summary']; ?></p>
                                    <p class="<?php echo $args['base_class']; ?>__table-average">
                                        <?php echo __('Average monthly spend:', 'edwp'); ?>
                                        &pound;<?php echo number_format($section['plsa_bracket_section_monthly']); ?>
                                    </p>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>