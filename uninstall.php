<?php
/**
 * Runs when the plugin is deleted from the WordPress dashboard.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

/**
 * Remove every row the plugin created.
 *
 * @return void
 */
function cnfp_uninstall_cleanup() {
	delete_option( 'cnfp_settings' );
	delete_transient( 'cnfp_review' );
}

if ( is_multisite() ) {
	$cnfp_sites = get_sites(
		array(
			'fields'   => 'ids',
			'number'   => 0,
			'archived' => 0,
			'deleted'  => 0,
		)
	);

	foreach ( $cnfp_sites as $cnfp_site_id ) {
		switch_to_blog( $cnfp_site_id );
		cnfp_uninstall_cleanup();
		restore_current_blog();
	}

	unset( $cnfp_sites, $cnfp_site_id );
} else {
	cnfp_uninstall_cleanup();
}
