<?php

namespace EDWP\Blocks\PlsaForm;

use StoutLogic\AcfBuilder\FieldsBuilder;

class PlsaForm
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
            'base_class' => 'wp-block-plsa-form',
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

        echo \EDWP\partial('inc/Blocks/PlsaForm/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('plsa_form');

        $block
            ->addImage('plsa_form_image')
            ->addText('plsa_form_heading', [
                'label' => 'Heading',
                'wrapper' => [
                    'width' => '75%'
                ]
            ])
            ->addText('plsa_form_summary', [
                'label' => 'Summary',
                'wrapper' => [
                    'width' => '100%'
                ]
            ])
            ->addText('plsa_form_details', [
                'label' => 'Details',
                'wrapper' => [
                    'width' => '100%'
                ]
            ])
            ->addText('plsa_form_cta', [
                'label' => 'Button Text',
                'wrapper' => [
                    'width' => '100%'
                ]
            ])
            ->setLocation('block', '==', 'acf/plsa-form');

        acf_add_local_field_group($block->build());
    }
}
