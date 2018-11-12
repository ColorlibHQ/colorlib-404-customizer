<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php bloginfo( 'name' );
		$site_description = get_bloginfo( 'description' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php
	$ccsm_options = get_option( 'ccsm_settings' );

	if ( $ccsm_options['colorlib_coming_soon_template_selection'] ) {
		$template = $ccsm_options['colorlib_coming_soon_template_selection'];
	}
	
	?>
    <!--TODO think we should remove this or add option in the customizer-->
    <!--<link rel="icon" type="image/png"
          href="<?php /*echo CCSM_URL . 'templates/' . $template; */ ?>/images/icons/favicon.ico"/>-->

	<?php
	include( CCSM_PATH . 'templates/' . $template . '/' . $template . '.php' );
	?>

    </body>
</html>