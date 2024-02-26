<?php
\EDWP\block('Cards', [
    'title' => __('Latest updates', 'edwp'),
    'post_type' => ['post'],
    'display' => 'latest',
    'section_anchor' => 'latest-updates',
    'display_on_mobile' => 'slider',
]);
