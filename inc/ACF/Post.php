<?php

namespace EDWP\ACF;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Post
{
    public function getFields(): array
    {
        $fields = new FieldsBuilder('post', [
            'title' => 'Post',
        ]);

        $fields
            ->setLocation('post_type', '==', 'post');

        return $fields->build();
    }
}
