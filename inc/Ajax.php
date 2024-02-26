<?php

namespace EDWP;

use Curl\Curl;

class Ajax
{
    public function __construct()
    {
        add_action('wp_ajax_nopriv_newsletterSubscribe', [$this, 'newsletterSubscribe']);
        add_action('wp_ajax_newsletterSubscribe', [$this, 'newsletterSubscribe']);
    }

    public function newsletterSubscribe()
    {
        wp_send_json_success([
            'message' => __('Thank you for subscribing to our newsletter.', 'edwp'),
        ]);

        exit;
    }
}
