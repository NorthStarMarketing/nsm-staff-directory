<?php
/**
 * Plugin Name:     Staff Directory
 * Plugin URI:      https://www.northstarmarketing.com
 * Description:     Adds a Staff Directory CPT to the Theme.
 * Author:          North Star Marketing
 * Author URI:      https://www.northstarmarketing.com
 * Text Domain:     nsm-staff-directory
 * Domain Path:     /languages
 * Version:         0.3
 *
 * @package         Nsm_Staff_Directory
 */

define( 'NSM_SD_PATH', plugin_dir_path( __FILE__ ) );
define( 'NSM_SD_URL', plugin_dir_url( __FILE__ ) );

/**
 * Get all the files in the inc folder and load them.
 */
include_once( NSM_SD_PATH . 'inc/tanny.php' );
include_once( NSM_SD_PATH . 'block/staff/staff.php' );
