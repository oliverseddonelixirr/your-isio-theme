<?php

namespace EDWP;

class Svg
{
    public function __construct()
    {
        add_filter('upload_mimes', [$this, 'uploadsMimes']);
        add_filter('admin_head', [$this, 'fixThumbs'], 10, 2);
    }

    public function uploadsMimes($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    public function fixThumbs()
    {
        echo '<style type="text/css">
              .attachment-266x266, .thumbnail img {
                   width: 100% !important;
                   height: auto !important;
              }
              </style>';
    }

    public static function get(string $svg): string
    {
        return sprintf(
            '<span class="inline-block svg">%s</span>',
            file_get_contents(get_template_directory() . '/dist/img/' . $svg . '.svg')
        );
    }

    public static function icon(string $icon, string $class = 'reg'): string
    {
        return sprintf(
            "<svg class='edwp-icon edwp-icon--{$class}' aria-hidden='true'>
                <use xlink:href='#{$icon}'></use>
            </svg>"
        );
    }
}
