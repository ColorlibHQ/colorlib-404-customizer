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
$cnfp_design   = CNFP_PATH . 'templates/' . $cnfp_template . '/' . $cnfp_template . '.php';

/*
 * Block themes have no header.php or footer.php, so `get_header()` fell back to
 * core's deprecated theme-compat markup — a generic header that is not the
 * theme's, plus two deprecation notices per 404. Render the theme's own header
 * and footer template parts instead, in the same document shape as core's
 * template-canvas.php.
 *
 * Hybrid themes that still ship header.php keep the classic path, which already
 * worked for them, as does any block theme without header or footer parts.
 */
$cnfp_header = '';
$cnfp_footer = '';

/*
 * Checked on disk rather than with `locate_template()`, which falls back to
 * core's theme-compat header and so never reports it missing.
 */
$cnfp_has_header_php = file_exists( get_stylesheet_directory() . '/header.php' )
	|| file_exists( get_template_directory() . '/header.php' );

if ( cnfp_use_theme_header_footer() && wp_is_block_theme() && ! $cnfp_has_header_php ) {
	// Rendered before `wp_head()` so the blocks inside can enqueue their styles
	// in time to be printed in <head>.
	ob_start();
	block_header_area();
	$cnfp_header = ob_get_clean();

	ob_start();
	block_footer_area();
	$cnfp_footer = ob_get_clean();
}

if ( '' !== trim( $cnfp_header . $cnfp_footer ) ) {
	?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
<div class="wp-site-blocks">
	<header class="wp-block-template-part"><?php echo $cnfp_header; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Rendered block markup, as core's template canvas prints it. ?></header>
	<?php include $cnfp_design; ?>
	<footer class="wp-block-template-part"><?php echo $cnfp_footer; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Rendered block markup, as core's template canvas prints it. ?></footer>
</div>
	<?php wp_footer(); ?>
</body>
</html>
	<?php
	return;
}

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
	} else {
		// `wp_head()` is skipped here to keep the page lean, so print the one piece
		// of it every visitor notices: without this the tab showed no favicon.
		wp_site_icon();
	}
	?>
</head>
<body class="colorlib-body">
	<?php
}

include $cnfp_design;

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
