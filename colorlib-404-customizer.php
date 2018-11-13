<?php
/*
  Plugin Name: Colorlib 404 Customizer
  Plugin URI: https://colorlib.com/
  Description: Colorlib 404 Customizer is a responsive 404 customizer WordPress plugin that comes with well designed 404 pages and lots of useful features including customization via Live Customizer.
  Version: 1.0.0
  Author: Colorlib
  Author URI: https://colorlib.com/
  License: GPL V3
  Text Domain: colorlib-404-customizer
  Domain Path: /languages
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
add_action( 'plugins_loaded', 'cnfp_load_plugin_textdomain' );
add_filter( 'plugin_action_links', 'cnfp_add_settings_link', 10, 5 );
add_action( 'customize_controls_enqueue_scripts', 'cnfp_customizer_scripts' );
add_action( 'customize_preview_init', 'cnfp_customizer_preview_scripts' );
add_action( 'cnfp_header', 'cnfp_style_enqueue' );
add_action( 'cnfp_header', 'wp_print_scripts' );


//loads the text domain for translation
function cnfp_load_plugin_textdomain() {
	load_plugin_textdomain( 'colorlib-404-customizer', false, basename( dirname( __FILE__ ) ) . '/lang/' );
}

//add settings and support links on wordpress plugin page
function cnfp_add_settings_link( $actions, $plugin_file ) {

	static $plugin;

	if ( ! isset( $plugin ) ) {
		$plugin = plugin_basename( __FILE__ );
	}
	if ( $plugin == $plugin_file ) {

		$settings  = array( 'settings' => '<a href="options-general.php?page=cnfp_settings">' . __( 'Settings', 'colorlib-coming-soon' ) . '</a>' );
		$site_link = array( 'support' => '<a href="http://colorlib.com" target="_blank">Support</a>' );

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

	//global $wp_customize;
	$cnfp_options = get_option( 'cnfp_settings' );
	//Checks for if user is logged in and CNFP is activated  OR if customizer is open on CNFP customization panel

	if ( ( is_404() && $cnfp_options['colorlib_404_customizer_activation'] == '1' ) || ( is_customize_preview() && isset( $_REQUEST['colorlib-404-customization'] ) ) ) {

		$file = plugin_dir_path( __FILE__ ) . 'includes/colorlib-template.php'; //get path of our 404 display page and redirecting
		include( $file );

		exit();
	}
}

// enqueue template styles
function cnfp_style_enqueue( $template_name ) {

	//styles based on each template
	$template_styles = array(
		'template_01' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css'
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
				'location' => 'css/font-awesome.min.css',
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
				'location' => 'css/font-awesome.min.css',
			),
		),
		'template_15' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
			array(
				'name'     => 'font-awesome',
				'location' => 'css/font-awesome.min.css',
			),
		),
		'template_16' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
			array(
				'name'     => 'font-awesome',
				'location' => 'css/font-awesome.min.css',
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
				'location' => 'css/font-awesome.min.css',
			),
		),
		'template_20' => array(
			array(
				'name'     => 'main',
				'location' => 'css/style.css',
			),
		),
	);

	//check if template and get the template arrays
	if ( $template_name ) {
		$encript_styles = $template_styles[ $template_name ];
		//$encript_scripts = $template_scripts[ $template_name ];
	}

	//print wordpress default jquery
	wp_print_scripts( 'jquery' );

	//print styles depending on template
	if ( $encript_styles != null && is_array( $encript_styles ) ) {
		foreach ( $encript_styles as $encript_style ) {
			wp_register_style( $template_name . '-' . $encript_style['name'], CNFP_URL . 'templates/' . $template_name . '/' . $encript_style['location'] );
			wp_print_styles( $template_name . '-' . $encript_style['name'] );

		}
	}
}


function cnfp_customizer_preview_scripts() {
	wp_register_script( 'colorlib-customizer-preview', CNFP_URL . 'assets/js/customizer-preview.js', array(
		'jquery',
		'customize-preview'
	), '', true );
	wp_enqueue_script( 'colorlib-customizer-preview' );

}


function cnfp_customizer_scripts() {
	wp_enqueue_editor();
	wp_register_script( 'colorlib-customizer-js', CNFP_URL . 'assets/js/customizer.js' );
	wp_enqueue_script( 'colorlib-customizer-js' );
	wp_register_script( 'colorlib-cnfp-main-js', CNFP_URL . 'assets/js/main.js' );
	wp_enqueue_script( 'colorlib-cnfp-main-js' );
	wp_register_style( 'colorlib-custom-controls-css', CNFP_URL . 'assets/css/cnfp-custom-controls.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'colorlib-custom-controls-css' );
	wp_localize_script(
		'colorlib-customizer-js', 'CNFPurls', array(
			'siteurl' => get_option( 'siteurl' ),
		)
	);
}


//check if default settings are stored in db, else store them
register_activation_hook( __FILE__, 'cnfp_check_on_activation' );

function cnfp_check_on_activation() {
	if ( get_option( 'cnfp_settings' ) == null ) {
		$defaultSets = array(
			'colorlib_404_customizer_activation'       => '1',
			'colorlib_404_customizer_select_template'  => 'template_01',
			'colorlib_404_customizer_page_heading'     => 'Ooops !',
			'colorlib_404_customizer_content'          => 'Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable',
			'colorlib_404_customizer_button_text'      => 'Back to homepage',
			'colorlib_404_customizer_social_facebook'  => 'https://facebook.com/',
			'colorlib_404_customizer_social_twitter'   => 'https://twitter.com/',
			'colorlib_404_customizer_social_pinterest' => 'https://pinterest.com/',
			'colorlib_404_customizer_social_youtube'   => 'https://youtube.com/',
			'colorlib_404_customizer_social_email'     => 'your@domain.to',
			'colorlib_404_customizer_social_instagram' => 'https://instagram.com/',
			'colorlib_404_customizer_social_google'    => 'https://plus.google.com/'
		);
		update_option( 'cnfp_settings', $defaultSets );
	}
}

//Loading Plugin Theme Customizer Options
require_once( 'includes/class-cnfp-customizer.php' );
