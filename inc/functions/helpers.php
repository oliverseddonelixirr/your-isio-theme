<?php

/**
 * Helpers file.
 *
 * @package edwp
 */

/**
 * Return content with ellipses.
 *
 * This function is designed to trim down content for excerpts
 * and add an ellipses to the end of the content string if
 * it exceeds the specified width.
 *
 * @param string $content The content to trim.
 * @param int    $length  The length to trim to.
 *
 * @return string $content
 */
function trimContent($content = '', $length = 100)
{

    // Trim the content of spaces.
    $content = trim($content);

    // Check we have something to filter.
    if ('' === $content) {
        return $content;
    }

    // Remove any HTML.
    $content = wp_strip_all_tags($content);

    // Type cast to an int.
    $length = (int) intval($length);

    // Check it's longer than the $length.
    if (strlen($content) > $length) {
        // Trim the content down.
        $content = substr($content, 0, $length);

        // Do we have an iffy character at the end.
        if (
            (substr($content, -1) === ' ') ||
            (substr($content, -1) === ',') ||
            (substr($content, -1) === '.') ||
            (substr($content, -1) === '!') ||
            (substr($content, -1) === '?')
        ) {
            // Reduce the length down.
            $length--;

            // Trim the last character again.
            $content = substr($content, 0, $length);
        }

        // Add the ellipses.
        $content .= '&hellip;';
    }

    return $content;
}

function phone_to_tel(string $phone_number, bool $is_url): string
{
    $phone_number = str_replace(' ', '', $phone_number);

    if ($is_url) {
        $phone_number = "tel:{$phone_number}";
    }

    return $phone_number;
}

function phone_to_fax(string $phone_number, bool $is_url): string
{
    $phone_number = str_replace(' ', '', $phone_number);

    if ($is_url) {
        $phone_number = "fax:{$phone_number}";
    }

    return $phone_number;
}

function generate_link(array $link, string $classes, string $default_text = 'Click here'): string
{
    if (empty($link['url'])) {
        return '';
    }

    $title = $link['title'] ?: $default_text;
    $link_title = $link['link_title'] ?? $link['title'];
    $html = '<a href="' . esc_url($link['url']) . '" title="' . esc_attr($link_title) . '">' . $title . '</a>';

    if (!empty($link['target'])) {
        $html = str_replace('href', 'target="' . $link['target'] . '" rel="noopener noreferrer" href', $html);
    }

    if (!empty($classes)) {
        $html = str_replace('href', 'class="' . $classes . '" href', $html);
    }

    return $html;
}

function image_array_to_img($image_array, $size = 'full', $class = '')
{
    return wp_get_attachment_image($image_array['ID'], $size, false, ['class' => $class]);
}
