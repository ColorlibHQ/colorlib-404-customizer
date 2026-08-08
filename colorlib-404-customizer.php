<?php
/**
 * Plugin Name: Colorlib 404 Customizer
 * Plugin URI: https://colorlib.com/
 * Description: Colorlib 404 Customizer is a responsive 404 customizer WordPress plugin that comes with well designed 404 pages and lots of useful features including customization via Live Customizer.
 * Version: 1.1.0
 * Author: Colorlib
 * Author URI: https://colorlib.com/
 * Requires at least: 6.0
 * Tested up to: 7.0
 * Requires PHP: 7.4
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: colorlib-404-customizer
 * Domain Path: /languages
 *
 * Copyright 2018-2026 Colorlib support@colorlib.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 3, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

define( 'CNFP_VERSION', '1.1.0' );
define( 'CNFP_PATH', plugin_dir_path( __FILE__ ) );
define( 'CNFP_URL', plugin_dir_url( __FILE__ ) );
define( 'CNFP_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'CNFP_FILE_', __FILE__ );

add_action( 'init', 'cnfp_skip_redirect_on_login' );
add_action( 'wp_enqueue_scripts', 'cnfp_style_enqueue' );
add_action( 'cnfp_header', 'cnfp_style_enqueue', 20 );
add_action( 'wp_head', 'cnfp_inline_style', 10 );
add_filter( 'wp_resource_hints', 'cnfp_resource_hints', 10, 2 );
add_filter( 'plugin_action_links_' . CNFP_PLUGIN_BASE, 'cnfp_add_settings_link' );
add_action( 'customize_controls_enqueue_scripts', 'cnfp_customizer_scripts', 30 );
add_action( 'customize_preview_init', 'cnfp_customizer_preview_scripts', 30 );
add_action( 'admin_init', 'cnfp_check_for_review' );
register_activation_hook( __FILE__, 'cnfp_check_on_activation' );

/*
 * No `load_plugin_textdomain()` call by design.
 *
 * Since WordPress 4.6 translations are resolved just in time from the `Domain
 * Path` header above, so loading them by hand is redundant — and doing it at the
 * wrong moment is exactly what produced the `_load_textdomain_just_in_time`
 * notice reported in issue #30. Nothing here may call a translation function
 * before `init`.
 */

/**
 * Default value for every setting the plugin owns.
 *
 * Also used to backfill options at read time, so a partially written option row
 * can never produce undefined-key warnings in the templates.
 *
 * @return array<string, string>
 */
function cnfp_default_options() {
	return array(
		'colorlib_404_customizer_activation'           => '1',
		'colorlib_404_customizer_select_template'      => 'template_01',
		'colorlib_404_customizer_page_heading'         => 'Oops !',
		'colorlib_404_customizer_content'              => 'Page Not Found!',
		'colorlib_404_customizer_button_text'          => 'Back to homepage',
		'colorlib_404_customizer_social_facebook'      => 'https://facebook.com/',
		'colorlib_404_customizer_social_twitter'       => 'https://x.com/',
		'colorlib_404_customizer_social_pinterest'     => 'https://pinterest.com/',
		'colorlib_404_customizer_social_youtube'       => 'https://youtube.com/',
		'colorlib_404_customizer_social_email'         => 'your@domain.to',
		'colorlib_404_customizer_social_instagram'     => 'https://instagram.com/',
		'colorlib_404_customizer_custom_css_control'   => '',
		'colorlib_404_customizer_background_image'     => '',
		'colorlib_404_customizer_background_repeat'    => 'no-repeat',
		'colorlib_404_customizer_background_size'      => 'auto',
		'colorlib_404_customizer_background_color'     => '',
		'colorlib_404_customizer_text_color'           => '',
		'colorlib_404_customizer_contact_link'         => '#',
		'colorlib_404_customizer_enable_header_footer' => '',
	);
}

/**
 * Allowed values for the two background dropdowns.
 *
 * Shared by the customizer (to build the controls and validate input) and by the
 * CSS writer (to validate again before the value reaches a stylesheet).
 *
 * @return array<string, string[]>
 */
function cnfp_background_choices() {
	return array(
		'repeat' => array( 'repeat', 'no-repeat', 'repeat-X', 'repeat-Y', 'round', 'space' ),
		'size'   => array( 'cover', 'contain', 'auto' ),
	);
}

/**
 * Read the plugin settings, backfilled with defaults.
 *
 * @return array<string, string>
 */
function cnfp_get_options() {
	// Deliberately not memoised: the customizer previews changes by filtering
	// `option_cnfp_settings`, and a request-lifetime cache would serve stale
	// values into the preview. `get_option()` is served from the options cache.
	$stored = get_option( 'cnfp_settings' );

	return wp_parse_args( is_array( $stored ) ? $stored : array(), cnfp_default_options() );
}

/**
 * Read a single setting.
 *
 * @param string $key           Setting key, without the `cnfp_settings[...]` wrapper.
 * @param string $default_value Returned when the key is unknown.
 * @return string
 */
function cnfp_get_option( $key, $default_value = '' ) {
	$options = cnfp_get_options();

	return isset( $options[ $key ] ) ? (string) $options[ $key ] : $default_value;
}

/**
 * The template registry.
 *
 * @return array<string, array{fonts: string[], supports: string[]}>
 */
function cnfp_get_templates() {
	static $templates = null;

	if ( null === $templates ) {
		$templates = require CNFP_PATH . 'includes/cnfp-templates.php';
	}

	return $templates;
}

/**
 * The currently selected template, validated against the registry.
 *
 * Never trust the stored value here: it is interpolated into an `include` path
 * and into asset URLs, so an unrecognised slug falls back to the default rather
 * than reaching the filesystem.
 *
 * @param string $template Optional slug to validate instead of the stored one.
 * @return string A slug that is guaranteed to exist in the registry.
 */
function cnfp_get_template( $template = '' ) {
	$templates = cnfp_get_templates();

	if ( ! is_string( $template ) || '' === $template ) {
		$template = cnfp_get_option( 'colorlib_404_customizer_select_template' );
	}

	return isset( $templates[ $template ] ) ? $template : 'template_01';
}

/**
 * Whether the active template offers a given feature.
 *
 * @param string $feature One of: content, button, social, contact, background_color.
 * @return bool
 */
function cnfp_template_supports( $feature ) {
	$templates = cnfp_get_templates();
	$template  = cnfp_get_template();

	return in_array( $feature, $templates[ $template ]['supports'], true );
}

/**
 * Whether this request should render a plugin 404 page.
 *
 * Both the real 404 and the customizer preview (which previews the home URL with
 * a marker query arg, so `is_404()` is false there) go through this.
 *
 * @return bool
 */
function cnfp_is_404_request() {
	if ( '1' !== cnfp_get_option( 'colorlib_404_customizer_activation' ) ) {
		return false;
	}

	if ( is_404() ) {
		return true;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only marker; the customizer enforces its own auth.
	return is_customize_preview() && isset( $_REQUEST['colorlib-404-customization'] );
}

/**
 * Skip the 404 takeover on wp-login.php.
 *
 * @return void
 */
function cnfp_skip_redirect_on_login() {
	global $pagenow;

	if ( 'wp-login.php' === $pagenow ) {
		return;
	}

	add_action( 'template_redirect', 'cnfp_template_redirect' );
}

/**
 * Swap the theme's 404 handling for the selected template.
 *
 * @return void
 */
function cnfp_template_redirect() {
	if ( ! cnfp_is_404_request() ) {
		return;
	}

	include CNFP_PATH . 'includes/colorlib-template.php';

	exit;
}

/**
 * Whether the 404 page is rendered inside the active theme's header and footer.
 *
 * @return bool
 */
function cnfp_use_theme_header_footer() {
	return '1' === cnfp_get_option( 'colorlib_404_customizer_enable_header_footer' );
}

/**
 * Build the combined Google Fonts URL for a template.
 *
 * One request per page instead of up to three, and `display=swap` so text paints
 * immediately in a fallback face rather than staying invisible while the webfont
 * downloads.
 *
 * Assembled by hand rather than with `add_query_arg()`, which would percent-encode
 * the `+` that the Fonts API uses to mean a space inside family names. Every part
 * comes from the hardcoded registry, so there is nothing user-supplied to escape.
 *
 * @param string $template Validated template slug.
 * @return string Empty when the template uses no webfonts.
 */
function cnfp_google_fonts_url( $template ) {
	$templates = cnfp_get_templates();
	$families  = $templates[ $template ]['fonts'];

	if ( empty( $families ) ) {
		return '';
	}

	return 'https://fonts.googleapis.com/css?family=' . implode( '|', $families ) . '&display=swap';
}

/**
 * Warm up the Google Fonts connection on pages that use one.
 *
 * Only reachable when the theme's header is in play; the plugin's own document
 * prints the hint itself, since `wp_resource_hints()` never runs there.
 *
 * @param string[] $urls          URLs already queued for this relation type.
 * @param string   $relation_type The hint type being filtered.
 * @return string[]
 */
function cnfp_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type || ! cnfp_use_theme_header_footer() || ! cnfp_is_404_request() ) {
		return $urls;
	}

	if ( '' === cnfp_google_fonts_url( cnfp_get_template() ) ) {
		return $urls;
	}

	$urls[] = array(
		'href' => 'https://fonts.gstatic.com',
		'crossorigin',
	);

	return $urls;
}

/**
 * Print or enqueue the stylesheets the active template needs.
 *
 * Runs in two very different contexts:
 *
 *  - `cnfp_header`, from the plugin's own minimal document, where nothing else
 *    has been printed and the styles go straight out via `wp_print_styles()`.
 *  - `wp_enqueue_scripts`, when the theme's header is in use, where they join the
 *    normal enqueue pipeline and get printed in `<head>` with everything else.
 *
 * The theme-header path is guarded: before 1.1.0 this was hooked to `wp_head` on
 * every front-end request, which shipped the 404 stylesheet, its webfonts and
 * jQuery site-wide — and did so too late in `wp_head` to be printed in `<head>`.
 *
 * @param string $template Slug passed by the `cnfp_header` action; empty otherwise.
 * @return void
 */
function cnfp_style_enqueue( $template = '' ) {
	if ( ! cnfp_is_404_request() ) {
		return;
	}

	$standalone = ( 'cnfp_header' === current_action() );

	// Each mode has exactly one entry point; ignore the other hook.
	if ( $standalone === cnfp_use_theme_header_footer() ) {
		return;
	}

	$template = cnfp_get_template( $template );

	$styles = array(
		$template . '-main' => CNFP_URL . 'templates/' . $template . '/css/style.css',
	);

	if ( cnfp_template_supports( 'social' ) ) {
		$styles['cnfp-social-icons'] = CNFP_URL . 'assets/css/social-icons.css';
	}

	$fonts_url = cnfp_google_fonts_url( $template );

	if ( '' !== $fonts_url ) {
		$styles['cnfp-fonts'] = $fonts_url;

		if ( $standalone ) {
			echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
		}
	}

	foreach ( $styles as $handle => $src ) {
		// Google's endpoint carries its own cache key; ours are versioned by the plugin.
		$version = ( 'cnfp-fonts' === $handle ) ? null : CNFP_VERSION;

		wp_register_style( $handle, $src, array(), $version );

		if ( $standalone ) {
			wp_print_styles( $handle );
		} else {
			wp_enqueue_style( $handle );
		}
	}
}

/**
 * Clamp a stored colour to something that cannot escape a CSS declaration.
 *
 * Hand-rolled rather than using `sanitize_hex_color()`, which lives in the
 * customizer class file and is not guaranteed to be loaded on the front end.
 * Accepts hex, CSS colour functions and bare keywords, because older versions
 * stored whatever the free-text sanitiser let through; anything containing
 * characters that could terminate the declaration is dropped.
 *
 * @param string $color Raw stored value.
 * @return string A usable CSS colour, or an empty string.
 */
function cnfp_sanitize_color( $color ) {
	$color = trim( (string) $color );

	if ( '' === $color ) {
		return '';
	}

	$pattern = '/^(#(?:[0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})'
		. '|[a-z]+'
		. '|(?:rgb|rgba|hsl|hsla)\([0-9.,%\s\/deg]+\))$/i';

	return preg_match( $pattern, $color ) ? $color : '';
}

/**
 * Strip anything that could break out of a `<style>` element.
 *
 * @param string $css Raw stored CSS.
 * @return string
 */
function cnfp_sanitize_css( $css ) {
	return str_replace( array( '<', '>' ), '', wp_strip_all_tags( (string) $css ) );
}

/**
 * Emit the settings-driven CSS overrides.
 *
 * Hooked to `wp_head` at priority 10, i.e. after core prints enqueued styles at
 * priority 8, so these overrides win the cascade. The plugin's own document calls
 * this directly instead.
 *
 * @return void
 */
function cnfp_inline_style() {
	if ( ! cnfp_is_404_request() ) {
		return;
	}

	// The standalone document calls this itself; don't emit it twice in the
	// customizer preview, where `wp_head()` also runs.
	if ( 'wp_head' === current_action() && ! cnfp_use_theme_header_footer() ) {
		return;
	}

	$choices    = cnfp_background_choices();
	$text_color = cnfp_sanitize_color( cnfp_get_option( 'colorlib_404_customizer_text_color' ) );
	$bg_color   = cnfp_sanitize_color( cnfp_get_option( 'colorlib_404_customizer_background_color' ) );
	$background = cnfp_get_option( 'colorlib_404_customizer_background_image' );
	$bg_repeat  = cnfp_get_option( 'colorlib_404_customizer_background_repeat' );
	$bg_size    = cnfp_get_option( 'colorlib_404_customizer_background_size' );

	$css = '';

	if ( '' !== $text_color ) {
		$css .= 'h1, h2, h3, h4, span, li, p, div, a { color: ' . $text_color . ' !important; }';
	}

	$css .= '#colorlib-notfound, #colorlib-notfound .colorlib-notfound-bg {';

	if ( '' !== $background ) {
		$css .= 'background-image: url("' . esc_url( $background ) . '") !important;';
	}
	if ( '' !== $bg_color ) {
		$css .= 'background-color: ' . $bg_color . ' !important;';
	}
	if ( in_array( $bg_repeat, $choices['repeat'], true ) ) {
		$css .= 'background-repeat: ' . $bg_repeat . ';';
	}
	if ( in_array( $bg_size, $choices['size'], true ) ) {
		$css .= 'background-size: ' . $bg_size . ';';
	}

	$css .= '}';

	$css .= '.colorlib-copyright { position: absolute; left: 0; right: 0; bottom: 0; margin: 0 auto; text-align: center; }';
	$css .= '.colorlib-copyright span { opacity: 0.8; }';
	$css .= '.colorlib-copyright a { opacity: 1; }';

	$css .= cnfp_get_option( 'colorlib_404_customizer_custom_css_control' );

	printf(
		"<style id=\"cnfp-inline-css\">\n%s\n</style>\n",
		cnfp_sanitize_css( $css ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CSS cannot be HTML-escaped; sanitised for tag breakout instead.
	);
}

/**
 * Render the social links shared by templates 11, 14, 15, 16 and 19.
 *
 * Previously duplicated verbatim in all five template files.
 *
 * @return void
 */
function cnfp_social_links() {
	$networks = array(
		'facebook'  => __( 'Facebook', 'colorlib-404-customizer' ),
		'twitter'   => __( 'X', 'colorlib-404-customizer' ),
		'pinterest' => __( 'Pinterest', 'colorlib-404-customizer' ),
		'email'     => __( 'Email', 'colorlib-404-customizer' ),
		'youtube'   => __( 'YouTube', 'colorlib-404-customizer' ),
		'instagram' => __( 'Instagram', 'colorlib-404-customizer' ),
	);

	echo '<div class="colorlib-notfound-social">';

	foreach ( $networks as $network => $label ) {
		$value = cnfp_get_option( 'colorlib_404_customizer_social_' . $network );

		if ( '' === $value ) {
			continue;
		}

		if ( 'email' === $network ) {
			// `antispambot()` returns HTML entities; `esc_attr()` leaves those intact
			// because it does not double-encode. `esc_url()` would mangle them.
			$href = esc_attr( 'mailto:' . antispambot( $value ) );
		} else {
			$href = esc_url( $value );

			if ( '' === $href ) {
				continue;
			}
		}

		printf(
			'<a href="%1$s" id="colorlib_404_customizer_social_%2$s">%3$s<span class="screen-reader-text">%4$s</span></a>',
			$href, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above for its scheme.
			esc_attr( $network ),
			cnfp_get_icon( $network ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Built from a hardcoded, escaped icon table.
			esc_html( $label )
		);
	}

	echo '</div>';
}

/**
 * Build one inline SVG icon.
 *
 * @param string $name Icon key from includes/cnfp-icons.php.
 * @return string Safe markup, or an empty string for an unknown icon.
 */
function cnfp_get_icon( $name ) {
	static $icons = null;

	if ( null === $icons ) {
		$icons = require CNFP_PATH . 'includes/cnfp-icons.php';
	}

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$icon = $icons[ $name ];
	$path = '<path d="' . esc_attr( $icon['path'] ) . '"/>';

	// Outlines lifted from the Font Awesome SVG font are Y-up.
	if ( $icon['flip'] ) {
		$path = '<g transform="translate(0,1536) scale(1,-1)">' . $path . '</g>';
	}

	return sprintf(
		'<svg class="cnfp-icon" viewBox="%s" fill="currentColor" aria-hidden="true" focusable="false">%s</svg>',
		esc_attr( $icon['viewbox'] ),
		$path
	);
}

/**
 * Add Settings and Support links to the plugin row.
 *
 * @param string[] $actions Existing row action links.
 * @return string[]
 */
function cnfp_add_settings_link( $actions ) {
	return array_merge(
		array(
			'support'  => '<a href="https://colorlib.com/wp/forums/" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Support', 'colorlib-404-customizer' ) . '</a>',
			'settings' => '<a href="' . esc_url( admin_url( 'admin.php?page=cnfp_settings' ) ) . '">' . esc_html__( 'Settings', 'colorlib-404-customizer' ) . '</a>',
		),
		$actions
	);
}

/**
 * Register the customizer preview script.
 *
 * @return void
 */
function cnfp_customizer_preview_scripts() {
	wp_enqueue_script(
		'colorlib-cnfp-customizer-preview',
		CNFP_URL . 'assets/js/customizer-preview.js',
		array( 'customize-preview', 'customize-selective-refresh' ),
		CNFP_VERSION,
		true
	);
}

/**
 * Register the customizer control scripts and styles.
 *
 * @return void
 */
function cnfp_customizer_scripts() {
	wp_enqueue_editor();

	wp_enqueue_script(
		'colorlib-cnfp-customizer-js',
		CNFP_URL . 'assets/js/customizer.js',
		array( 'customize-controls' ),
		CNFP_VERSION,
		true
	);

	wp_enqueue_style(
		'colorlib-cnfp-custom-controls-css',
		CNFP_URL . 'assets/css/cnfp-custom-controls.css',
		array(),
		CNFP_VERSION
	);

	wp_localize_script(
		'colorlib-cnfp-customizer-js',
		'CNFPurls',
		array(
			'siteurl' => home_url( '/' ),
		)
	);
}

/**
 * Seed defaults on activation.
 *
 * @return void
 */
function cnfp_check_on_activation() {
	if ( null === get_option( 'cnfp_settings', null ) ) {
		add_option( 'cnfp_settings', cnfp_default_options() );
	}
}

/**
 * Boot the review prompt.
 *
 * @return void
 */
function cnfp_check_for_review() {
	require_once CNFP_PATH . 'includes/class-cnfp-review.php';

	CNFP_Review::get_instance( array( 'slug' => 'colorlib-404-customizer' ) );
}

/*
 * Backwards-compatible wrappers. These names are referenced as customizer
 * `active_callback` strings and may be relied on by third-party snippets.
 */

/**
 * Whether the active template shows a contact link.
 *
 * @return bool
 */
function cnfp_template_has_contact_link() {
	return cnfp_template_supports( 'contact' );
}

/**
 * Whether the active template shows social links.
 *
 * @return bool
 */
function cnfp_template_has_social_links() {
	return cnfp_template_supports( 'social' );
}

/**
 * Whether the active template shows the heading.
 *
 * Template 13 hardcodes its own "Error 404" wordmark and has nowhere to put the
 * setting, so the control is hidden there rather than silently doing nothing.
 *
 * @return bool
 */
function cnfp_template_has_heading() {
	return cnfp_template_supports( 'heading' );
}

/**
 * Whether the active template shows the main content block.
 *
 * @return bool
 */
function cnfp_template_has_content() {
	return cnfp_template_supports( 'content' );
}

/**
 * Whether the active template shows the back-to-home button.
 *
 * @return bool
 */
function cnfp_template_has_back_button() {
	return cnfp_template_supports( 'button' );
}

/**
 * Whether the active template honours the background colour setting.
 *
 * @return bool
 */
function cnfp_template_has_background_color() {
	return cnfp_template_supports( 'background_color' );
}

require_once CNFP_PATH . 'includes/class-cnfp-customizer.php';
