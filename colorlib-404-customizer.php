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
add_action( 'customize_controls_enqueue_scripts', 'cnfp_customizer_scripts', 30 );
add_action( 'customize_preview_init', 'cnfp_customizer_preview_scripts', 30 );
add_action( 'cnfp_header', 'cnfp_style_enqueue', 20 );
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

		$settings  = array( 'settings' => '<a href="options-general.php?page=ccsm_settings">' . __( 'Settings', 'colorlib-coming-soon' ) . '</a>' );
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
		add_action( 'template_redirect', 'ccsm_template_redirect' );
	}
}

/* 404 page Redirect to Template */
function cnfp_template_redirect() {

	global $wp_customize;
	$cnfp_options = get_option( 'cnfp_settings' );

	//Checks for if user is logged in and CCSM is activated  OR if customizer is open on CCSM customization panel
	if ( ! is_user_logged_in() && $cnfp_options['colorlib_coming_soon_activation'] == 1 || is_customize_preview() && isset( $_REQUEST['colorlib-coming-soon-customization'] ) ) {

		$file = plugin_dir_path( __FILE__ ) . 'includes/colorlib-template.php'; //get path of our 404 display page and redirecting
		include( $file );

		exit();
	}
}

// enqueue template styles
function cnfp_style_enqueue( $template_name ) {

	$global_styles = array(
		array(
			'name'     => 'animate',
			'location' => 'css/vendor/animate/animate.css',
		),
		array(
			'name'     => 'bootstrap',
			'location' => 'css/vendor/bootstrap/css/bootstrap.min.css',
		),
		array(
			'name'     => 'font-awesome',
			'location' => 'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
		),
		array(
			'name'     => 'select-2',
			'location' => 'css/vendor/select2/select2.min.css',
		),
	);

	//styles based on each template
	$template_styles = array(
		'template_01' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css'
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css'
			),
		),
		'template_02' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_03' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_04' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_05' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_06' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_07' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_08' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_09' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_10' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_11' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_12' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_13' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_14' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
		'template_15' => array(
			array(
				'name'     => 'main',
				'location' => 'css/main.css',
			),
			array(
				'name'     => 'util',
				'location' => 'css/util.css',
			)
		),
	);

	$global_scripts = array(
		array(
			'name'     => 'popper',
			'location' => 'js/vendor/bootstrap/js/popper.js',
			'template' => 'global',
		),
		array(
			'name'     => 'bootstrap',
			'location' => 'js/vendor/bootstrap/js/bootstrap.min.js',
			'template' => 'global'
		),
		array(
			'name'     => 'moment',
			'location' => 'js/vendor/countdowntime/moment.min.js',
			'template' => 'global'
		),
		array(
			'name'     => 'moment-timezone',
			'location' => 'js/vendor/countdowntime/moment-timezone.min.js',
			'template' => 'global'
		),
		array(
			'name'     => 'timezone',
			'location' => 'js/vendor/countdowntime/moment-timezone-with-data.min.js',
			'template' => 'global'
		),
		array(
			'name'     => 'tilt',
			'location' => 'js/vendor/tilt/tilt.jquery.min.js',
			'template' => 'global'
		),
	);

	if ( $template_name == 'template_06' || $template_name == 'template_15' ) {
		$global_scripts[] = array(
			'name'     => 'flipclock',
			'location' => 'js/vendor/countdowntime/flipclock.js',
			'template' => 'global'
		);
		$global_scripts[] = array(
			'name'     => 'coutdowntime-2',
			'location' => 'js/vendor/countdowntime/countdowntime-2.js',
			'template' => 'global'
		);
	} else {
		$global_scripts[] = array(
			'name'     => 'coutdowntime',
			'location' => 'js/vendor/countdowntime/countdowntime.js',
			'template' => 'global'
		);
	}

	// scripts based on each template
	$template_scripts = array(
		'template_01' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_02' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_03' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_04' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_05' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_06' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_07' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_08' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_09' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_10' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_11' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_12' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_13' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_14' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
		'template_15' => array(
			array(
				'name'     => 'main',
				'location' => 'js/main.js',
			),
		),
	);

	//check if template and get the template arrays
	if ( $template_name ) {
		$encript_styles  = $template_styles[ $template_name ];
		$encript_scripts = $template_scripts[ $template_name ];
	}

	//print global styles
	foreach ( $global_styles as $global_style ) {
		wp_register_style( $global_style['name'], CCSM_URL . 'assets/' . $global_style['location'] );
		wp_print_styles( $global_style['name'] );
	}

	//print wordpress default jquery
	wp_print_scripts( 'jquery' );

	//print global scripts
	foreach ( $global_scripts as $global_script ) {
		wp_register_script( $global_script['name'], CCSM_URL . 'assets/' . $global_script['location'] );
		wp_print_scripts( $global_script['name'] );
	}

	//print styles depending on template
	if ( $encript_styles != null && is_array( $encript_styles ) ) {
		foreach ( $encript_styles as $encript_style ) {
			wp_register_style( $template_name . '-' . $encript_style['name'], CCSM_URL . 'templates/' . $template_name . '/' . $encript_style['location'] );
			wp_print_styles( $template_name . '-' . $encript_style['name'] );

		}
	}

	//print scripts depending on template
	foreach ( $encript_scripts as $encript_script ) {
		wp_register_script( $template_name . '-' . $encript_script['name'], CCSM_URL . 'templates/' . $template_name . '/' . $encript_script['location'] );
		wp_print_scripts( $template_name . '-' . $encript_script['name'] );
	}
}


function cnfp_customizer_preview_scripts() {
	wp_register_script( 'colorlib-customizer-preview', CCSM_URL . 'assets/js/customizer-preview.js', array(
		'jquery',
		'customize-preview'
	), '', true );
	wp_enqueue_script( 'colorlib-customizer-preview' );

}


function cnfp_customizer_scripts() {
	wp_enqueue_editor();
	wp_register_script( 'colorlib-customizer-js', CCSM_URL . 'assets/js/customizer.js' );
	wp_enqueue_script( 'colorlib-customizer-js' );
	wp_register_script( 'colorlib-ccsm-main-js', CCSM_URL . 'assets/js/main.js' );
	wp_enqueue_script( 'colorlib-ccsm-main-js' );
	wp_register_style( 'colorlib-custom-controls-css', CCSM_URL . 'assets/css/ccsm-custom-controls.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'colorlib-custom-controls-css' );
	wp_localize_script(
		'colorlib-customizer-js', 'CCSMurls', array(
			'siteurl' => get_option( 'siteurl' ),
		)
	);
}

// Timer and countdown date display function
function cnfp_counter_dates( $timerDate ) {

	if ( $timerDate ) {
		$date = DateTime::createFromFormat( 'Y-m-d H:i:s', $timerDate );
	} else {
		$date = DateTime::createFromFormat( 'Y-m-d H:i:s', date( 'Y-m-d H:i:s', strtotime( '+1 month' ) ) );
	}

	$cDate    = new DateTime( date( 'Y-m-d H:i:s' ) );
	$interval = $cDate->diff( $date );


	//template needed info
	$days    = $interval->format( '%a' );
	$hours   = $interval->format( '%H' );
	$minutes = $interval->format( '%I' );
	$seconds = $interval->format( '%S' );
	//script needed info
	$year  = $date->format( 'Y' );
	$month = $date->format( 'm' );
	$day   = $date->format( 'd' );

	$dates['template'] = array(
		'days'    => $days,
		'hours'   => $hours,
		'minutes' => $minutes,
		'seconds' => $seconds
	);

	$dates['script'] = array(
		'year'   => $year,
		'month'  => $month,
		'day'    => $day,
		'hour'   => $hours,
		'minute' => $minutes,
		'second' => $seconds
	);


	return $dates;
}

//check if default settings are stored in db, else store them
register_activation_hook( __FILE__, 'cnfp_check_on_activation' );

function cnfp_check_on_activation() {
	if ( get_option( 'cnfp_settings' ) == null ) {
		$defaultSets = array(
			'colorlib_coming_soon_activation'         => '1',
			'colorlib_coming_soon_timer_activation'   => '1',
			'colorlib_coming_soon_template_selection' => 'template_01',
			'colorlib_coming_soon_timer_option'       => date( 'Y-m-d H:i:s', strtotime( '+1 month' ) ),
			'colorlib_coming_soon_plugin_logo'        => CCSM_URL . 'assets/images/logo.jpg',
			'colorlib_coming_soon_page_heading'       => 'Something <strong>really good</strong> is coming <strong>very soon</strong>',
			'colorlib_coming_soon_page_content'       => 'If you have something new you’re looking to launch, you’re going to want to start building a community of people interested in what you’re launching.',
			'colorlib_coming_soon_page_footer'        => 'And don\'t worry, we hate spam too! You can unsubscribe at any time.',
			'colorlib_coming_soon_social_facebook'    => 'https://facebook.com/',
			'colorlib_coming_soon_social_twitter'     => 'https://twitter.com/',
			'colorlib_coming_soon_social_youtube'     => 'https://youtube.com/',
			'colorlib_coming_soon_social_email'       => 'you@domain.com',
			'colorlib_coming_soon_social_pinterest'   => 'https://pinterest.com/',
			'colorlib_coming_soon_social_instagram'   => 'https://instagram.com/'

		);
		update_option( 'cnfp_settings', $defaultSets );
	}
}

function cnfp_template_has_content() {
	$cnfp_options         = get_option( 'ccsm_settings' );
	$template_has_content = array(
		'template_02',
		'template_04',
		'template_05',
		'template_06',
		'template_08',
		'template_10',
		'template_12',
		'template_14'
	);
	if ( in_array( $cnfp_options['colorlib_coming_soon_template_selection'], $template_has_content ) ) {
		return true;
	}

	return false;
}

function cnfp_template_has_footer() {
	$cnfp_options        = get_option( 'ccsm_settings' );
	$template_has_footer = array(
		'template_01',
		'template_03',
		'template_04',
		'template_06'
	);
	if ( in_array( $cnfp_options['colorlib_coming_soon_template_selection'], $template_has_footer ) ) {
		return true;
	}

	return false;
}


function cnfp_template_has_background_image() {
	$cnfp_options                  = get_option( 'ccsm_settings' );
	$template_has_background_image = array(
		'template_03',
		'template_04'
	);
	if ( in_array( $cnfp_options['colorlib_coming_soon_template_selection'], $template_has_background_image ) ) {
		return false;
	}

	return true;
}

function cnfp_template_has_background_color() {
	$cnfp_options                  = get_option( 'ccsm_settings' );
	$template_has_background_color = array(
		'template_03',
		'template_04'
	);
	if ( in_array( $cnfp_options['colorlib_coming_soon_template_selection'], $template_has_background_color ) ) {
		return true;
	}

	return false;
}


//Loading Plugin Theme Customizer Options
require_once( 'includes/class-cnfp-customizer.php' );
