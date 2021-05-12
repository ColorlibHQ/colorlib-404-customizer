<?php
/**
 * Plugin Name: Colorlib 404 Customizer
 * Plugin URI: https://colorlib.com/
 * Description: Colorlib 404 Customizer is a responsive 404 customizer WordPress plugin that comes with well designed 404 pages and lots of useful features including customization via Live Customizer.
 * Version: 1.0.96
 * Author: Colorlib
 * Author URI: https://colorlib.com/
 * Tested up to: 5.5
 * Requires: 4.6 or higher
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Requires PHP: 5.6
 * Text Domain: colorlib-404-customizer
 * Domain Path: /languages
 *
 * Copyright 2018-2019 Colorlib support@colorlib.com
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
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CNFP_PATH', plugin_dir_path( __FILE__ ) );
define( 'CNFP_URL', plugin_dir_url( __FILE__ ) );
define( 'CNFP_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'CNFP_FILE_', __FILE__ );

add_action( 'init', 'cnfp_skip_redirect_on_login' );
add_action( 'init', 'cnfp_check_footer_header' );
add_action( 'plugins_loaded', 'cnfp_load_plugin_textdomain' );
add_filter( 'plugin_action_links', 'cnfp_add_settings_link', 10, 5 );
add_action( 'customize_controls_enqueue_scripts', 'cnfp_customizer_scripts', 30 );
add_action( 'customize_preview_init', 'cnfp_customizer_preview_scripts', 30 );
add_action( 'cnfp_header', 'cnfp_style_enqueue', 20 );
add_action( 'wp_head', 'cnfp_style_enqueue' );
add_action( 'cnfp_header', 'wp_print_scripts' );


// loads the text domain for translation
function cnfp_load_plugin_textdomain() {
	load_plugin_textdomain( 'colorlib-404-customizer', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}

// add settings and support links on WordPress plugin page
function cnfp_add_settings_link( $actions, $plugin_file ) {

	if ( CNFP_PLUGIN_BASE == $plugin_file ) {

		$settings  = array( 'settings' => '<a href="' . admin_url( 'options-general.php?page=cnfp_settings' ) . '">' . __( 'Settings', 'colorlib-404-customizer' ) . '</a>' );
		$site_link = array( 'support' => '<a href="https://colorlib.com/wp/forums/" target="_blank">' . __( 'Support', 'colorlib-404-customizer' ) . '</a>' );

		$actions = array_merge( $settings, $actions );
		$actions = array_merge( $site_link, $actions );
	}

	return $actions;
}

/* Redirect code that checks if on WP login page */
function cnfp_skip_redirect_on_login() {
	global $pagenow;

	if ( 'wp-login.php' == $pagenow ) {
		return;
	} else {
		add_action( 'template_redirect', 'cnfp_template_redirect' );
	}
}

/* 404 page Redirect to Template */
function cnfp_template_redirect() {

	// global $wp_customize;
	$cnfp_options = get_option( 'cnfp_settings' );
	// Checks for if user is logged in and CNFP is activated  OR if customizer is open on CNFP customization panel

	if ( ( is_404() && $cnfp_options['colorlib_404_customizer_activation'] == '1' ) || ( is_customize_preview() && isset( $_REQUEST['colorlib-404-customization'] ) && $cnfp_options['colorlib_404_customizer_activation'] == '1' ) ) {

		// get path of our 404 display page and redirecting
		include CNFP_PATH . 'includes/colorlib-template.php';

		exit();
	}
}

// enqueue template styles
function cnfp_style_enqueue( $template_name ) {

	// styles based on each template
	$template_styles = array(
		'template_01' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_02' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_03' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_04' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_05' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_06' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_07' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_08' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_09' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_10' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_11' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
			array(
				'name'     => 'font-awesome',
				'location' => 'assets/css/font-awesome.min.css',
				'global'   => true,
			),
		),
		'template_12' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_13' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_14' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
			array(
				'name'     => 'font-awesome',
				'location' => 'assets/css/font-awesome.min.css',
				'global'   => true,
			),
		),
		'template_15' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
			array(
				'name'     => 'font-awesome',
				'location' => 'assets/css/font-awesome.min.css',
				'global'   => true,
			),
		),
		'template_16' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
			array(
				'name'     => 'font-awesome',
				'location' => 'assets/css/font-awesome.min.css',
				'global'   => true,
			),
		),
		'template_17' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_18' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
		'template_19' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
			array(
				'name'     => 'font-awesome',
				'location' => 'assets/css/font-awesome.min.css',
				'global'   => true,
			),
		),
		'template_20' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
	);

	$google_fonts_styles = array(
		'template_01' => array(
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:500',
			),
			array(
				'name'     => 'Titillium',
				'location' => 'https://fonts.googleapis.com/css?family=Titillium+Web:700,900',
			),
		),
		'template_02' => array(
			array(
				'name'     => 'Roboto',
				'location' => 'https://fonts.googleapis.com/css?family=Roboto:400,700',
			),
		),
		'template_03' => array(
			array(
				'name'     => 'Cabin',
				'location' => 'https://fonts.googleapis.com/css?family=Cabin:400,700',
			),
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:900',
			),
		),
		'template_04' => array(
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:200,400,700',
			),
		),
		'template_05' => array(
			array(
				'name'     => 'Poppins',
				'location' => 'https://fonts.googleapis.com/css?family=Poppins:400,700',
			),
		),
		'template_06' => array(
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:700,900',
			),
		),
		'template_07' => array(
			array(
				'name'     => 'Fredoka One',
				'location' => 'https://fonts.googleapis.com/css?family=Fredoka+One',
			),
			array(
				'name'     => 'Raleway',
				'location' => 'https://fonts.googleapis.com/css?family=Raleway:400,700',
			),
		),
		'template_08' => array(
			array(
				'name'     => 'Josefin',
				'location' => 'https://fonts.googleapis.com/css?family=Josefin+Sans:400,700',
			),
		),
		'template_09' => array(
			array(
				'name'     => 'Cabin',
				'location' => 'https://fonts.googleapis.com/css?family=Cabin:400,700',
			),
		),
		'template_10' => array(
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:400,700,900',
			),
		),
		'template_11' => array(
			array(
				'name'     => 'Muli',
				'location' => 'https://fonts.googleapis.com/css?family=Muli:400',
			),
			array(
				'name'     => 'Passion One',
				'location' => 'https://fonts.googleapis.com/css?family=Passion+One',
			),
		),
		'template_12' => array(
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:300,700',
			),
		),
		'template_13' => array(
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:400',
			),
			array(
				'name'     => 'Chango',
				'location' => 'https://fonts.googleapis.com/css?family=Chango',
			),
		),
		'template_14' => array(
			array(
				'name'     => 'Quicksand',
				'location' => 'https://fonts.googleapis.com/css?family=Quicksand:700',
			),
		),
		'template_15' => array(
			array(
				'name'     => 'Oswald',
				'location' => 'https://fonts.googleapis.com/css?family=Oswald:700',
			),
			array(
				'name'     => 'Lato',
				'location' => 'https://fonts.googleapis.com/css?family=Lato:400',
			),
		),
		'template_16' => array(
			array(
				'name'     => 'Montserrat',
				'location' => 'https://fonts.googleapis.com/css?family=Montserrat:700,900',
			),
		),
		'template_17' => array(
			array(
				'name'     => 'Raleway',
				'location' => 'https://fonts.googleapis.com/css?family=Raleway:400,700',
			),
			array(
				'name'     => 'Passion One',
				'location' => 'https://fonts.googleapis.com/css?family=Passion+One:900',
			),
		),
		'template_18' => array(
			array(
				'name'     => 'Nunito',
				'location' => 'https://fonts.googleapis.com/css?family=Nunito:400,700',
			),
		),
		'template_19' => array(
			array(
				'name'     => 'Kanit',
				'location' => 'https://fonts.googleapis.com/css?family=Kanit:200',
			),
		),
		'template_20' => array(
			array(
				'name'     => 'Maven',
				'location' => 'https://fonts.googleapis.com/css?family=Maven+Pro:400,900',
			),
		),
	);

	$cnfp_options = get_option( 'cnfp_settings' );

	// check if template_name exists, if not get it from options
	if ( ! $template_name || '' == $template_name ) {
		$template_name = $cnfp_options['colorlib_404_customizer_select_template'];
	}

	// check if template and get the template arrays
	if ( $template_name ) {
		$encript_styles     = $template_styles[ $template_name ];
		$google_fonts_style = $google_fonts_styles[ $template_name ];
	}

	if ( ! isset( $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) || '0' == $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) {
		// print WordPress default jquery
		wp_print_scripts( 'jquery' );
	}

	// print styles depending on template
	if ( $encript_styles != null && is_array( $encript_styles ) ) {
		foreach ( $encript_styles as $encript_style ) {
			if ( ! isset( $encript_style['global'] ) || true != $encript_style['global'] ) {

				wp_register_style( $template_name . '-' . $encript_style['name'], CNFP_URL . 'templates/' . $template_name . '/' . $encript_style['location'] );
				if ( isset( $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) && '1' == $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) {
					wp_enqueue_style( $template_name . '-' . $encript_style['name'] );
				} else {
					wp_print_styles( $template_name . '-' . $encript_style['name'] );
				}
			} else {

				wp_register_style( $encript_style['name'], CNFP_URL . $encript_style['location'] );

				if ( isset( $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) && '1' == $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) {

					wp_enqueue_style( $encript_style['name'] );
				} else {
					wp_print_styles( $encript_style['name'] );
				}
			}
		}
	}

	if ( $google_fonts_style != null && is_array( $google_fonts_style ) ) {
		foreach ( $google_fonts_style as $google_font ) {
			wp_register_style( $google_font['name'], $google_font['location'] );

			if ( isset( $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) && '1' == $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) {
				wp_enqueue_style( $google_font['name'] );
			} else {
				wp_print_styles( $google_font['name'] );
			}
		}
	}
}


function cnfp_customizer_preview_scripts() {
	wp_register_script(
		'colorlib-cnfp-customizer-preview',
		CNFP_URL . 'assets/js/customizer-preview.js',
		array(
			'jquery',
			'customize-preview',
		),
		'',
		true
	);
	wp_enqueue_script( 'colorlib-cnfp-customizer-preview' );
	wp_enqueue_script( 'customize-selective-refresh' );

}


function cnfp_customizer_scripts() {
	wp_enqueue_editor();
	wp_register_script( 'colorlib-cnfp-customizer-js', CNFP_URL . 'assets/js/customizer.js', array( 'customize-controls' ) );
	wp_enqueue_script( 'colorlib-cnfp-customizer-js' );
	wp_register_style( 'colorlib-cnfp-custom-controls-css', CNFP_URL . 'assets/css/cnfp-custom-controls.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'colorlib-cnfp-custom-controls-css' );
	wp_localize_script(
		'colorlib-cnfp-customizer-js',
		'CNFPurls',
		array(
			'siteurl' => get_option( 'siteurl' ),
		)
	);
}


// check if default settings are stored in db, else store them
register_activation_hook( __FILE__, 'cnfp_check_on_activation' );

function cnfp_check_on_activation() {
	if ( get_option( 'cnfp_settings' ) == null ) {
		$defaultSets = array(
			'colorlib_404_customizer_activation'           => '1',
			'colorlib_404_customizer_select_template'      => 'template_01',
			'colorlib_404_customizer_page_heading'         => 'Oops !',
			'colorlib_404_customizer_content'              => 'Page Not Found!',
			'colorlib_404_customizer_button_text'          => 'Back to homepage',
			'colorlib_404_customizer_social_facebook'      => 'https://facebook.com/',
			'colorlib_404_customizer_social_twitter'       => 'https://twitter.com/',
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
		update_option( 'cnfp_settings', $defaultSets );
	}
}


function cnfp_template_has_contact_link() {
	$cnfp_options              = get_option( 'cnfp_settings' );
	$template_has_contact_link = array(
		'template_16',
	);

	if ( in_array( $cnfp_options['colorlib_404_customizer_select_template'], $template_has_contact_link ) ) {
		return true;
	}

	return false;
}

function cnfp_template_has_social_links() {
	$cnfp_options              = get_option( 'cnfp_settings' );
	$template_has_social_links = array(
		'template_11',
		'template_14',
		'template_15',
		'template_16',
		'template_19',
	);

	if ( in_array( $cnfp_options['colorlib_404_customizer_select_template'], $template_has_social_links ) ) {
		return true;
	}

	return false;
}

function cnfp_template_has_content() {
	$cnfp_options         = get_option( 'cnfp_settings' );
	$template_has_content = array(
		'template_01',
		'template_03',
		'template_04',
		'template_09',
		'template_10',
		'template_12',
		'template_13',
		'template_14',
		'template_15',
		'template_17',
		'template_18',
		'template_19',
		'template_20',
	);

	if ( in_array( $cnfp_options['colorlib_404_customizer_select_template'], $template_has_content ) ) {
		return true;
	}

	return false;
}

function cnfp_template_has_back_button() {
	$cnfp_options             = get_option( 'cnfp_settings' );
	$template_has_back_button = array(
		'template_01',
		'template_04',
		'template_05',
		'template_06',
		'template_07',
		'template_08',
		'template_09',
		'template_10',
		'template_11',
		'template_12',
		'template_13',
		'template_14',
		'template_15',
		'template_16',
		'template_17',
		'template_18',
		'template_19',
		'template_20',
	);

	if ( in_array( $cnfp_options['colorlib_404_customizer_select_template'], $template_has_back_button ) ) {
		return true;
	}

	return false;
}

function cnfp_template_has_background_color() {
	$cnfp_options                  = get_option( 'cnfp_settings' );
	$template_has_background_color = array(
		'template_16',
	);

	if ( in_array( $cnfp_options['colorlib_404_customizer_select_template'], $template_has_background_color ) ) {
		return false;
	}

	return true;
}

function cnfp_check_for_review() {
	if ( ! is_admin() ) {
		return;
	}
	require_once CNFP_PATH . 'includes/class-cnfp-review.php';

	CNFP_Review::get_instance(
		array(
			'slug' => 'colorlib-404-customizer',
		)
	);
}

function cnfp_check_footer_header() {
	$cnfp_options = get_option( 'cnfp_settings' );
	if ( isset( $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) && '1' == $cnfp_options['colorlib_404_customizer_enable_header_footer'] ) {
		add_action( 'wp_head', 'cnfp_inline_style' );
	}
}

function cnfp_inline_style() {

	$cnfp_options = get_option( 'cnfp_settings' );

	$inline_css = '<style type="text/css">';
	if ( $cnfp_options['colorlib_404_customizer_text_color'] ) {
		$inline_css .= 'h1, h2, h3, h4, span, li, p, div, a { color: ' . esc_attr( $cnfp_options['colorlib_404_customizer_text_color'] ) . ' !important; }';
	}

	$inline_css .= '#colorlib-notfound, #colorlib-notfound .colorlib-notfound-bg {';

	$inline_css .= ( $cnfp_options['colorlib_404_customizer_background_image'] ) ? 'background-image:url("' . esc_url( $cnfp_options['colorlib_404_customizer_background_image'] ) . '") !important;' : '';

	$inline_css .= ( $cnfp_options['colorlib_404_customizer_background_color'] ) ? 'background-color:' . esc_attr( $cnfp_options['colorlib_404_customizer_background_color'] ) . ' !important;' : '';

	$inline_css .= ( $cnfp_options['colorlib_404_customizer_background_repeat'] ) ? 'background-repeat:' . esc_attr( $cnfp_options['colorlib_404_customizer_background_repeat'] ) . ';' : '';

	$inline_css .= ( $cnfp_options['colorlib_404_customizer_background_size'] ) ? 'background-size:' . esc_attr( $cnfp_options['colorlib_404_customizer_background_size'] ) . ';' : '';

	$inline_css .= '}';

	$inline_css .= $cnfp_options['colorlib_404_customizer_custom_css_control'];

	$inline_css .= '.colorlib-copyright {position: absolute;left: 0;right: 0;bottom: 0;margin: 0 auto;
    text-align: center;
    }';

	$inline_css .= '.colorlib-copyright span {opacity: 0.8;}';

	$inline_css .= '.colorlib-copyright a {opacity: 1;}';
	$inline_css .= '</style>';

	echo $inline_css;
}

cnfp_check_for_review();

// Loading Plugin Theme Customizer Options
require_once 'includes/class-cnfp-customizer.php';
