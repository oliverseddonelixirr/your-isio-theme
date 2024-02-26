<?php

namespace EDWP\Blocks\PageIntro;

use StoutLogic\AcfBuilder\FieldsBuilder;

class PageIntro
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
            'base_class' => 'wp-block-page-intro',
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

        echo \EDWP\partial('inc/Blocks/PageIntro/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('page_intro');

        $block
            ->addText('intro', [
                'label' => 'Intro Title',
            ])
            ->addWysiwyg('content', [
                'label' => 'Intro Content',
            ])
            ->addLink(
                'link',
                [
                    'label' => 'CTA link'
                ]
            )
            ->setLocation('block', '==', 'acf/page-intro');

        acf_add_local_field_group($block->build());
    }
}
