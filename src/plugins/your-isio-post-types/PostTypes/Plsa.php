<?php

namespace EdxPostTypes;

use PostTypes\PostType;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Plsa
{
    public function __construct()
    {
        $this->registerPostType();

        add_action('init', [$this, 'registerFields']);
        add_action('pre_get_posts', [$this, 'sortOrder']);
    }

    public function registerPostType()
    {
        $plsa = new PostType('plsa', [
            'labels' => array(
                'name' => 'PLSA Brackets',
                'singular_name' => 'Bracket',
                'add_new' => 'Add New Bracket',
                'add_new_item' => 'Add New Bracket',
                'edit_item' => 'Edit Bracket',
                'new_item' => 'New Bracket',
                'view_item' => 'View Bracket',
                'view_items' => 'View Brackets',
                'all_items' => 'All Brackets',
                'search_items' => 'Search Brackets',
                'plural' => 'Brackets',
            ),
            'show_in_rest' => false,
            'has_archive' => true,
            'supports' => [
                'title',
                'revisions',
            ]
        ]);
        $plsa->icon('dashicons-calculator');
        $plsa->register();
    }

    public function registerFields()
    {
        acf_add_local_field_group($this->setupFields());
    }

    public function setupFields()
    {
        $option_sections = get_field('plsa_option_sections', 'option');
        $section_array = array();

        foreach ($option_sections as $section) {
            $section_array[] = $section['plsa_option_section_title'];
        }

        $fields = new FieldsBuilder('plsa', [
            'title' => 'Bracket Details',
        ]);

        $fields
            ->addPageLink('plsa_bracket_page', [
                'label' => 'Page Link',
                'required' => 1,
                'post_type' => ['page'],
                'multiple' => 0,
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addPageLink('plsa_bracket_page_couple', [
                'label' => 'Couple Page Link',
                'required' => 1,
                'post_type' => ['page'],
                'multiple' => 0,
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('plsa_bracket_min', [
                'label' => 'Minimum Value (£)',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('plsa_bracket_min_couple', [
                'label' => 'Couple Minimum Value (£)',
                'instructions' => 'Defaults to double single value if none specified',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('plsa_bracket_max', [
                'label' => 'Maximum Value (£)',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('plsa_bracket_max_couple', [
                'label' => 'Couple Maximum Value (£)',
                'instructions' => 'Defaults to double single value if none specified',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addTextArea('plsa_bracket_summary', [
                'label' => 'Summary',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addTextArea('plsa_bracket_summary_couple', [
                'label' => 'Couple Summary',
                'instructions' => 'Defaults to single summary if none specified',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addTextArea('plsa_bracket_additional', [
                'label' => 'Additional Text',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addTextArea('plsa_bracket_additional_couple', [
                'label' => 'Couple Additional Text',
                'instructions' => 'Defaults to single additional text if none specified',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addImage('plsa_bracket_image', [
                'label' => 'Bracket Image',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addImage('plsa_bracket_image_couple', [
                'label' => 'Couple Bracket Image',
                'instructions' => 'Defaults to single bracket image if none specified',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addPageLink('plsa_bracket_table_page', [
                'label' => 'Table Page Link',
                'required' => 1,
                'post_type' => ['page'],
                'multiple' => 0,
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addPageLink('plsa_bracket_table_page_couple', [
                'label' => 'Couple Table Page Link',
                'required' => 1,
                'post_type' => ['page'],
                'multiple' => 0,
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addRepeater('plsa_bracket_sections', [
                'label' => 'Sections',
                'layout' => 'block',
            ])
            ->addSelect('plsa_bracket_section', [
                'choices' => $section_array,
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addImage('plsa_bracket_section_image', [
                'wrapper' => [
                    'width' => '50%',
                ]
            ])
            ->addTextArea('plsa_bracket_section_summary', [
                'label' => 'Summary',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addTextArea('plsa_bracket_section_summary_couple', [
                'label' => 'Couple Summary',
                'instructions' => 'Defaults to single summary if none specified',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('plsa_bracket_section_monthly', [
                'label' => 'Monthly Spend (£)',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addText('plsa_bracket_section_monthly_couple', [
                'label' => 'Couple Monthly Spend (£)',
                'instructions' => 'Defaults to double single value if none specified',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->endRepeater()
            ->setLocation('post_type', '==', 'plsa');

        return $fields->build();
    }

    public function sortOrder($query)
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (is_post_type_archive('plsa')) {
            $query->set('orderby', 'meta_value');
            $query->set('meta_key', 'date_range');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', 8);
        }
    }
}
