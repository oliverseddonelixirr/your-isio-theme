<?php

namespace EDWP\Blocks\PlsaSectionForms;

use StoutLogic\AcfBuilder\FieldsBuilder;

class PlsaSectionForms
{
    public function __construct()
    {
        add_action('acf/init', [$this, 'initialiseBlock']);
    }

    public function initialiseBlock(): void
    {
        $this->registerBlock();
        $this->setupBlockACF();
    }

    public static function filterBlockFields($args): array
    {
        $args = wp_parse_args($args, [
            'base_class' => 'wp-block-plsa-section-forms',
            'modifier_classes' => [],
        ]);

        if ($args['background_colour'] == true) {
            $args['modifier_classes'][] = "{$args['base_class']}--background";
        }

        return [
            ...$args,
            'modifier_classes' => implode(' ', $args['modifier_classes'])
        ];
    }

    public function registerBlock(): void
    {
        register_block_type(
            __DIR__,
            ['render_callback' => [$this, 'renderBlock']]
        );
    }

    public function renderBlock()
    {
        $args = $this->filterBlockFields(get_fields());

        echo \EDWP\partial('inc/Blocks/PlsaSectionForms/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('plsa_section_forms');

        $block
            ->addTrueFalse('background_colour', [
                'label' => 'Background Colour',
                'instructions' => 'Should the section apply a brand background colour?',
            ])
            ->setLocation('block', '==', 'acf/plsa-section-forms');

        acf_add_local_field_group($block->build());
    }
}
