<?php
/**
 * The 404 document shell.
 *
 * Included from `cnfp_template_redirect()` in place of the theme's own 404
 * handling. Either wraps the selected design in the theme's header and footer, or
 * emits a minimal standalone document of its own.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

$cnfp_template = cnfp_get_template();

if ( cnfp_use_theme_header_footer() ) {
	get_header();
} else {
	?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo esc_html( wp_get_document_title() ); ?></title>
	<?php
	/*
	 * A 404 is not something search engines should keep. WordPress already sends
	 * the 404 status header; this makes the intent explicit for the crawlers that
	 * read the tag instead.
	 */
	?>
	<meta name="robots" content="noindex, follow">
	<?php
	do_action( 'cnfp_header', $cnfp_template );

	cnfp_inline_style();

	if ( is_customize_preview() ) {
		wp_head();
	}
	?>
</head>
<body class="colorlib-body">
	<?php
}

include CNFP_PATH . 'templates/' . $cnfp_template . '/' . $cnfp_template . '.php';

if ( cnfp_use_theme_header_footer() ) {
	get_footer();
} else {
	if ( is_customize_preview() ) {
		wp_footer();
	}
	?>
	<!-- This template was made by Colorlib (https://colorlib.com) -->
</body>
</html>
	<?php
}
