<?php
/**
 * Include ACF Pro
 *
 * @package Nsm_Staff_Directory
 */

if ( ! defined( 'SHOW_ACF' ) ) {
	add_filter( 'acf/settings/show_admin', '__return_false' );
}
add_filter( 'acf/settings/path', 'nsm_sd_acf_settings_path' );
add_filter( 'acf/settings/dir', 'nsm_sd_acf_settings_dir' );

/**
 * Defines the path for ACF.
 *
 * @param string $path The path for ACF.
 */
function nsm_sd_acf_settings_path( $path ) {

	$path = NSM_SD_PATH . '/lib/acf/';

	return $path;
}

/**
 * Defines the directory for ACF.
 *
 * @param string $dir The directory for ACF.
 */
function nsm_sd_acf_settings_dir( $dir ) {

	$dir = NSM_SD_URL . '/lib/acf/';

	return $dir;

}

include_once( NSM_SD_PATH . '/lib/acf/acf.php' );
