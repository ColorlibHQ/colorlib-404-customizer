<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php bloginfo( 'name' );
		$site_description = get_bloginfo( 'description' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php
	$cnfp_options = get_option( 'cnfp_settings' );

	if ( $cnfp_options['colorlib_404_customizer_select_template'] ) {
		$template = $cnfp_options['colorlib_404_customizer_select_template'];
	}
	include( CNFP_PATH . 'templates/' . $template . '/' . $template . '.php' );
	?>
    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>