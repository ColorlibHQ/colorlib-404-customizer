<?php
/**
 * The template registry.
 *
 * Single source of truth for everything that used to be spread across seven
 * parallel arrays in the main plugin file: per-template stylesheets, Google Font
 * families, and which customizer controls each design actually supports.
 *
 * Adding a design means adding one entry here (plus the template directory and
 * its preview thumbnail) instead of editing seven separate lists.
 *
 * Keys:
 *   fonts    - Google Font family specs, combined into one request at runtime.
 *   supports - Optional features: heading, content, button, social, contact,
 *              background_color. Every template supports the background image
 *              and text colour settings.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

return array(
	'template_01' => array(
		'fonts'    => array( 'Montserrat:500', 'Titillium+Web:700,900' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
	'template_02' => array(
		'fonts'    => array( 'Roboto:400,700' ),
		'supports' => array( 'heading', 'background_color' ),
	),
	'template_03' => array(
		'fonts'    => array( 'Cabin:400,700', 'Montserrat:900' ),
		'supports' => array( 'heading', 'content', 'background_color' ),
	),
	'template_04' => array(
		'fonts'    => array( 'Montserrat:200,400,700' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
	'template_05' => array(
		'fonts'    => array( 'Poppins:400,700' ),
		'supports' => array( 'heading', 'button', 'background_color' ),
	),
	'template_06' => array(
		'fonts'    => array( 'Montserrat:700,900' ),
		'supports' => array( 'heading', 'button', 'background_color' ),
	),
	'template_07' => array(
		'fonts'    => array( 'Fredoka+One', 'Raleway:400,700' ),
		'supports' => array( 'heading', 'button', 'background_color' ),
	),
	'template_08' => array(
		'fonts'    => array( 'Josefin+Sans:400,700' ),
		'supports' => array( 'heading', 'button', 'background_color' ),
	),
	'template_09' => array(
		'fonts'    => array( 'Cabin:400,700' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
	'template_10' => array(
		'fonts'    => array( 'Montserrat:400,700,900' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
	'template_11' => array(
		'fonts'    => array( 'Muli:400', 'Passion+One' ),
		'supports' => array( 'heading', 'button', 'social', 'background_color' ),
	),
	'template_12' => array(
		'fonts'    => array( 'Montserrat:300,700' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
	'template_13' => array(
		'fonts'    => array( 'Montserrat:400', 'Chango' ),
		'supports' => array( 'content', 'button', 'background_color' ),
	),
	'template_14' => array(
		'fonts'    => array( 'Quicksand:700' ),
		'supports' => array( 'heading', 'content', 'button', 'social', 'background_color' ),
	),
	'template_15' => array(
		'fonts'    => array( 'Oswald:700', 'Lato:400' ),
		'supports' => array( 'heading', 'content', 'button', 'social', 'background_color' ),
	),
	'template_16' => array(
		'fonts'    => array( 'Montserrat:700,900' ),
		// This design paints its own gradient, so the background colour picker is hidden.
		'supports' => array( 'heading', 'button', 'social', 'contact' ),
	),
	'template_17' => array(
		'fonts'    => array( 'Raleway:400,700', 'Passion+One:900' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
	'template_18' => array(
		'fonts'    => array( 'Nunito:400,700' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
	'template_19' => array(
		'fonts'    => array( 'Kanit:200' ),
		'supports' => array( 'heading', 'content', 'button', 'social', 'background_color' ),
	),
	'template_20' => array(
		'fonts'    => array( 'Maven+Pro:400,900' ),
		'supports' => array( 'heading', 'content', 'button', 'background_color' ),
	),
);
