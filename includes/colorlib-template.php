<?php
$cnfp_options = get_option( 'cnfp_settings' );

if ( $cnfp_options['colorlib_404_customizer_select_template'] ) {
    $template = $cnfp_options['colorlib_404_customizer_select_template'];
}

// Check if header is requested by user, else include our own header
if ( isset( $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) && '1' == $cnfp_options['colorlib_404_customizer_enable_header_footer']) {
    get_header();
} else {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <title><?php bloginfo( 'name' );
            $site_description = get_bloginfo( 'description' ); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- General Style -->
        <?php cnfp_inline_style(); ?>
        <!-- End General Style -->
        <?php

        do_action( 'cnfp_header', $template );

        if ( is_customize_preview() ) {
            wp_head();
        }
        ?>
    </head>
    <body class="colorlib-body">
<?php } // End our header

//get selected template
include(CNFP_PATH . 'templates/' . $template . '/' . $template . '.php');



if ( isset( $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) && '1' == $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) {
    // Check if user requested footer, else include our own footer
    get_footer();
} else {
    if (is_customize_preview()) {
        wp_footer();
    }
    ?>
    </body><!-- This template was made by Colorlib (https://colorlib.com) -->
    </html>
<?php } ?>