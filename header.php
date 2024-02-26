<?php

/**
 * The template for displaying the header.
 *
 * @package cdtheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a href="#main" class="skip-link" id="skip-navigation">Skip to navigation</a>
    <?php wp_body_open(); ?>
    <div class="main">
        <?php \EDWP\partial('partials/global/header'); ?>