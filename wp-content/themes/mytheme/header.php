<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <!-- Very Important: adds our enqueued styles -->
        <?php wp_head(); ?>
    </head>

    <body>
    <!-- Yea i dont like this syntax for using template-parts as well -->
    <?php get_template_part( 'template-parts/header', 'banner' ); ?>

