<?php
/**
 *
 *  $$$$$$$$$\
 *  \__$$  __|
 *     $$ | $$$$$$\  $$$$$$$\  $$$$$$$\  $$\   $$\
 *     $$ | \____$$\ $$  __$$\ $$  __$$\ $$ |  $$ |
 *     $$ | $$$$$$$ |$$ |  $$ |$$ |  $$ |$$ |  $$ |
 *     $$ |$$  __$$ |$$ |  $$ |$$ |  $$ |$$ |  $$ |
 *     $$ |\$$$$$$$ |$$ |  $$ |$$ |  $$ |\$$$$$$$ |
 *     \__| \_______|\__|  \__|\__|  \__| \____$$ |
 *                                       $$\   $$ |
 *                                       \$$$$$$  |
 *                                        \______/
 *
 * This includes all .php files within the current directory
 * and subdirectories.
 *
 * @package Nsm_Staff_Directory
 */

nsm_sd_recursive_dive( dirname( __FILE__ ) );

/**
 * Includes all files from the given directory.
 *
 * @param string $dir_path The directory from which to recursively include files.
 */
function nsm_sd_recursive_dive( $dir_path ) {
	$file_name = $dir_path;
	$directory = array_diff( scandir( $dir_path ), array( '..', '.' ) );
	foreach ( $directory as $dir ) {
		if ( is_dir( $dir_path . '/' . $dir ) ) {
			nsm_sd_recursive_dive( $dir_path . '/' . $dir );
		} elseif ( substr( $dir, -4, 4 ) === '.php' ) {
			include_once( $dir_path . '/' . $dir );
		}
	}
}
