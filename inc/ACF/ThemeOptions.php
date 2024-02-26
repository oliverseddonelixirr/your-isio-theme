<?php

namespace EDWP\ACF;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ThemeOptions
{
    public function getFields(): array
    {
        $fields = new FieldsBuilder('theme_options');

        $fields
            ->addTab('Header', [
                'placement' => 'left',
            ])
            ->addImage('header_logo', [
                'label' => 'Header logo',
                'return_format' => 'id',
            ])
            ->addSelect('header_logo_align', [
                'label' => 'Logo Vertical ALignment',
                'choices' => [
                    'start' => 'Top',
                    'center' => 'Middle',
                    'end' => 'Bottom',
                ],
            ])
            ->addUrl('header_profile_link', [
                'label' => 'Profile Link',
            ])
            ->addLink('header_cta_link', [
                'label' => 'CTA Link',
            ])
            ->addTab('Header Banner', [
                'placement' => 'left',
            ])
            ->addImage('mask_image', [
                'label' => 'Mask Image',
                'return_format' => 'id',
            ])
            ->addImage('mask_image_mobile', [
                'label' => 'Mobile Mask Image',
                'return_format' => 'id',
            ])
            ->addImage('mask_background', [
                'label' => 'Mask Background Image',
                'return_format' => 'id',
            ])
            ->addImage('textual_background', [
                'label' => 'Text Background Image',
                'return_format' => 'id',
            ])
            ->addTab('Footer', [
                'placement' => 'left',
            ])
            ->addText('company_registration_title', [
                'label' => 'Company registration title',
                'default_value' => __('About us', 'edwp'),
            ])
            ->addText('company_registration', [
                'label' => 'Company registration details',
            ])
            ->addText('contact_title', [
                'label' => 'Contact title',
                'default_value' => __('Get in touch', 'edwp'),
            ])
            ->addText('contact_phone', [
                'label' => 'Contact phone number',
            ])
            ->addText('contact_email', [
                'label' => 'Contact email',
            ])
            ->addText('contact_address', [
                'label' => 'Contact address',
            ])
            ->addText('copyright_text', [
                'label' => 'Copyright notice',
                'default_value' => get_bloginfo('name'),
            ])
            ->addImage('footer_logo', [
                'label' => 'Footer logo',
                'return_format' => 'id',
            ])
            ->addTrueFalse('footer_logo_background', [
                'label' => 'Footer logo as background',
                'instructions' => 'Check to speficy if logo should be used as a background'
            ])
            ->addTab('Footer Banner', [
                'placement' => 'left',
            ])
            ->addImage('banner_background_image', [
                'label' => 'Background Image',
                'return_format' => 'id',
            ])
            ->addImage('banner_image', [
                'return_format' => 'id',
            ])
            ->addText('banner_title', [
                'label' => 'Banner title',
            ])
            ->addWysiwyg('banner_copy', [
                'label' => 'Banner text',
                'media_upload' => false,
            ])
            ->addText('banner_cta_copy', [
                'label' => 'CTA text',
                'default_value' => __('Read more', 'edwp'),
            ])
            ->addText('banner_cta_link', [
                'label' => 'CTA link',
            ])
            ->addTab('Insights', [
                'placement' => 'left',
            ])
            ->addText('news_title', [
                'label' => 'Title',
                'default_value' => __('Insights', 'edwp'),
            ])
            ->addText('news_intro', [
                'label' => 'Intro',
            ])
            ->addTab('Single Article Form Links', [
                'placement' => 'left',
            ])
            ->addText('form_links_title', [
                'label' => 'Title',
                'default_value' => __('I want to...', 'edwp')
            ])
            ->addText('form_links_description', [
                'label' => 'Description',
                'default_value' => 'Use the forms below to communicate requests or changes to us.'
            ])
            ->addRepeater('form_links_page_links', [
                'label' => 'Page Links',
                'layout' => 'block',
            ])
            ->addPageLink('page_link', [
                'label' => 'Page Link',
                'post_type' => ['page'],
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addSelect('page_icon', [
                'label' => 'Icon',
                'choices' => [
                    'icon-page-certificate' => 'Certificate',
                    'icon-page-contact' => 'Contact',
                    'icon-page-document-money' => 'Document Money',
                    'icon-page-document-profile' => 'Document Profile',
                    'icon-page-document-refresh' => 'Document Refresh',
                    'icon-page-document-wish' => 'Document Wish',
                    'icon-page-document' => 'Document',
                    'icon-page-door' => 'Door',
                    'icon-page-golf' => 'Golf',
                    'icon-page-key' => 'Key',
                    'icon-page-profile' => 'Profile',
                    'icon-page-rings' => 'Rings',
                ],
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->endRepeater()
            ->addLink(
                'form_links_link',
                [
                    'label' => 'More link'
                ]
            )
            ->addTab('Advanced', [
                'placement' => 'left',
            ])
            ->addText('google_tag_manager_id', [
                'label' => 'Google Tag Manager ID',
            ])
            ->addText('google_maps_api_key', [
                'label' => 'Google Maps API Key',
            ])
            ->addTextArea('header_scripts', [
                'label' => 'Header scripts',
            ])
            ->addTextArea('footer_scripts', [
                'label' => 'Footer scripts',
            ])
            ->setLocation('options_page', '==', 'theme-options');

        return $fields->build();
    }
}