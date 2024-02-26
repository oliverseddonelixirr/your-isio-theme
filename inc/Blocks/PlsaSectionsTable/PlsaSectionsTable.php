<?php

namespace EDWP\Blocks\PlsaSectionsTable;

use StoutLogic\AcfBuilder\FieldsBuilder;

class PlsaSectionsTable
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
            'base_class' => 'wp-block-plsa-sections-table',
            'modifier_classes' => [],
        ]);

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

        echo \EDWP\partial('inc/Blocks/PlsaSectionsTable/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('plsa_sections_table');

        $block
            ->addTrueFalse('single_bracket', [
                'label' => 'Couple?',
            ])
            ->setLocation('block', '==', 'acf/plsa-sections-table');

        acf_add_local_field_group($block->build());
    }
}
