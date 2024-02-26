<?php

namespace EDWP\Blocks\CalloutBlock;

use StoutLogic\AcfBuilder\FieldsBuilder;

class CalloutBlock
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
            'base_class' => 'wp-block-callout-block',
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

        echo \EDWP\partial('inc/Blocks/CalloutBlock/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('callout_block');

        $block
            ->addText('title', [
                'label' => 'Title',
            ])
            ->addWysiwyg('content', [
                'label' => 'Content',
            ])
            ->setLocation('block', '==', 'acf/callout-block');

        acf_add_local_field_group($block->build());
    }
}
