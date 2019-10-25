<?php
/**
 * Registers the Staff block.
 *
 * @package Nsm_Staff_Directory
 * @subpackage block
 */

add_action( 'acf/init', 'nsm_register_staff_block' );
add_action( 'acf/init', 'nsm_add_staff_field_group' );
add_action( 'after_setup_theme', 'nsm_add_staff_block_image_size' );

include NSM_SD_PATH . '/block/staff/staff-acf-fields.php';

/**
 * Registers the staff Block.
 *
 * @return void
 */
function nsm_register_staff_block() {
	acf_register_block(
		array(
			'name'            => 'staff',
			'title'           => 'Staff',
			'description'     => 'A custom block to display Staff content.',
			'render_template' => NSM_SD_PATH . '/block/staff/staff-template.php',
			'category'        => 'formatting',
			'icon'            => 'megaphone',
			'keywords'        => array( 'staff', 'Staff' ),
			'enqueue_style'   => NSM_SD_URL . '/block/staff/staff.css',
			'enqueue_script'  => NSM_SD_URL . '/block/staff/staff.js',
			'mode'            => 'auto',
			'align'           => 'wide',
			'supports'        => array(
				'align'    => array( 'center', 'wide', 'full' ),
				'multiple' => true,
			),
		)
	);
}

/**
 * Adds the staff Image size to the theme.
 *
 * @uses Action: after_setup_theme
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
 *
 * @uses add_image_size() to add additional image sizes.
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 *
 * @return void
 */
function nsm_add_staff_block_image_size() {
	add_image_size( 'staff-profile', 720, 480, array( 'center', 'top' ) );
}
