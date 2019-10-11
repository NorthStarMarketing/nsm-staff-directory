<?php
/**
 * Registers the fields for ACF.
 * phpcs:ignoreFile
 *
 * @package wbl
 */

 /**
 * Adds the ACF Fields for the Staff Block.
 *
 * @return void
 */
function nsm_add_staff_field_group() {
	if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5d9fe8119cac0',
			'title' => 'Block: Staff',
			'fields' => array(
				array(
					'key' => 'field_5da07e8409c5f',
					'label' => 'Staff Members',
					'name' => 'nsm_sd_staff_members',
					'type' => 'relationship',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'staff',
					),
					'taxonomy' => '',
					'filters' => '',
					'elements' => array(
						0 => 'featured_image',
					),
					'min' => '',
					'max' => '',
					'return_format' => 'id',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/staff',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

		endif;

}
