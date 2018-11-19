<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <title><?php bloginfo( 'name' );
		$site_description = get_bloginfo( 'description' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php
	$cnfp_options = get_option( 'cnfp_settings' );
	?>
    <!-- General Style -->
    <style>
        <?php if ( $cnfp_options['colorlib_404_customizer_text_color'] ) { ?>

        h1, h2, h3, h4, span, li, p, div, a {
            color: <?php echo $cnfp_options['colorlib_404_customizer_text_color']; ?> !important;
        }

        <?php } ?>
        #notfound, #notfound .notfound-bg {
        <?php echo ($cnfp_options['colorlib_404_customizer_background_image']) ?  'background-image:url("'. $cnfp_options['colorlib_404_customizer_background_image'].'") !important;' : ''; ?><?php echo ($cnfp_options['colorlib_404_customizer_background_color']) ?  'background-color:'. $cnfp_options['colorlib_404_customizer_background_color'] .' !important;' : ''; ?><?php echo ($cnfp_options['colorlib_404_customizer_background_repeat']) ?  'background-repeat:'. $cnfp_options['colorlib_404_customizer_background_repeat'].';' : ''; ?><?php echo ($cnfp_options['colorlib_404_customizer_background_size']) ?  'background-size:'. $cnfp_options['colorlib_404_customizer_background_size'].';' : ''; ?>
        }

        <?php
            echo $cnfp_options['colorlib_404_customizer_custom_css_control'];
        ?>
        .colorlib-copyright {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            margin: 0 auto;
            text-align: center;
        }

        .colorlib-copyright span {
            opacity: 0.8;
        }

        .colorlib-copyright a {
            opacity: 1;
        }
    </style>
    <!-- End General Style -->
	<?php
	if ( $cnfp_options['colorlib_404_customizer_select_template'] ) {
		$template = $cnfp_options['colorlib_404_customizer_select_template'];
	}
	do_action( 'cnfp_header', $template );
	if ( is_customize_preview() ) {
		wp_head();
	}
	?>
</head>
<body>
<?php
//get selected template
include( CNFP_PATH . 'templates/' . $template . '/' . $template . '.php' );

if ( is_customize_preview() ) {
	wp_footer();
} ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>