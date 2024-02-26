<?php

namespace EdxPostTypes;

use PostTypes\PostType;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Faq
{
    public function __construct()
    {
        $this->registerPostType();

        add_action('init', [$this, 'registerFields']);
        add_action('pre_get_posts', [$this, 'sortOrder']);
    }

    public function registerPostType()
    {
        $faq = new PostType('faq', [
            'show_in_rest' => false,
            'has_archive' => true,
            'supports' => [
                'title',
                'revisions',
            ]
        ]);
        $faq->icon('dashicons-list-view');
        $faq->register();
    }

    public function registerFields()
    {
        acf_add_local_field_group($this->setupFields());
    }

    public function setupFields()
    {
        $fields = new FieldsBuilder('faq');

        $fields
            ->addRepeater('faq_list', [
                'label' => 'FAQs',
                'layout' => 'block',
            ])
            ->addText('faq_definition', [
                'label' => 'Title',
            ])
            ->addText('faq_description', [
                'label' => 'Text',
            ])
            ->endRepeater()
            ->setLocation('post_type', '==', 'faq');

        return $fields->build();
    }

    public function sortOrder($query)
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (is_post_type_archive('faq')) {
            $query->set('orderby', 'meta_value');
            $query->set('meta_key', 'date_range');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', 8);
        }
    }
}
