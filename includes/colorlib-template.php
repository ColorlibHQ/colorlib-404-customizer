<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php bloginfo( 'name' );
		$site_description = get_bloginfo( 'description' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php
	$cnfp_options = get_option( 'cnfp_settings' );

	/*General style*/
	?>
    <style>
        <?php if ( $cnfp_options['colorlib_404_customizer_text_color'] ) { ?>

        h1, h2, h3, h4, span, li, p {
            color: <?php echo $cnfp_options['colorlib_404_customizer_text_color']; ?> !important;
        }

        <?php } ?>
        body {
        <?php echo ($cnfp_options['colorlib_404_customizer_background_image']) ?  'background-image:url("'. $cnfp_options['colorlib_404_customizer_background_image'].'");' : '#fff;'; ?>

        <?php echo ($cnfp_options['colorlib_404_customizer_background_color']) ?  'background-color:'. $cnfp_options['colorlib_404_customizer_background_color'] .';' : '#fff;'; ?>
        <?php echo ($cnfp_options['colorlib_404_customizer_background_repeat']) ?  'background-repeat:'. $cnfp_options['colorlib_404_customizer_background_repeat'].';' : 'no-repeat;'; ?>
        <?php echo ($cnfp_options['colorlib_404_customizer_background_size']) ?  'background-size:'. $cnfp_options['colorlib_404_customizer_background_size'].';' : 'auto;'; ?>
        }
    </style>
	<?php
	if ( $cnfp_options['colorlib_404_customizer_select_template'] ) {
		$template = $cnfp_options['colorlib_404_customizer_select_template'];
	}
	include( CNFP_PATH . 'templates/' . $template . '/' . $template . '.php' );
	?>
    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>