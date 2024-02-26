<?php

namespace EDWP\ACF;

use StoutLogic\AcfBuilder\FieldsBuilder;

class PlsaOptions
{
    public function getFields(): array
    {
        $fields = new FieldsBuilder('plsa_options', [
            'title' => 'Options',
        ]);

        $fields
            ->addRepeater('plsa_option_sections', [
                'label' => 'Sections',
                'layout' => 'block',
            ])
            ->addText('plsa_option_section_title', [
                'label' => 'Title',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addSelect('plsa_option_section_icon', [
                'label' => 'Icon',
                'choices' => [
                    'icon-section-house' => 'House',
                    'icon-section-food' => 'Food',
                    'icon-section-car' => 'Car',
                    'icon-section-outdoors' => 'Outdoors',
                    'icon-section-profile' => 'Profile',
                    'icon-section-money' => 'Money',
                ],
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('plsa_option_section_summary', [
                'label' => 'Summary',
            ])
            ->addRepeater('plsa_option_section_values', [
                'label' => 'Values',
                'layout' => 'block',
            ])
            ->addText('plsa_option_section_value_title', [
                'label' => 'Summary',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addSelect('plsa_option_section_value_duration', [
                'label' => 'Duration',
                'choices' => [
                    'week' => 'Weekly',
                    'month' => 'Monthly',
                    'year' => 'Yearly',
                ],
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->setLocation('options_page', '==', 'plsa-options');

        return $fields->build();
    }
}
