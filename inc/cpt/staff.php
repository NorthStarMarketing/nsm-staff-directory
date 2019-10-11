<?php
/**
 * Custom Post Type: Staff
 *
 * @package Nsm_Staff_Directory
 */

// Actions and Filters.
add_action( 'init', 'nsm_sd_staff', 0 );
add_action( 'save_post_staff', 'nsm_sd_set_default_staff_featured_image', 10, 1 );
add_action( 'save_post_staff', 'nsm_sd_set_staff_name', 10, 2 );

add_filter( 'use_block_editor_for_post_type', 'nsm_sd_disable_gutenberg', 10, 2 );

/**
 * Remove Gutenberg from the Staff Custom Post Type.
 *
 * @param boolean $current_status Status to show gutenberg or not.
 * @param string $post_type The Post Type.
 * @return void
 */
function nsm_sd_disable_gutenberg( $current_status, $post_type ){
    if ( $post_type === 'staff' ) {
		return false;
	}
	return $current_status;
}


/**
 * Defines the custom post type.
 */
function nsm_sd_staff() {
	$labels = array(
		'name'                  => _x( 'Staff', 'Post Type General Name', 'nsm_sd' ),
		'singular_name'         => _x( 'Staff', 'Post Type Singular Name', 'nsm_sd' ),
		'menu_name'             => __( 'Staff', 'nsm_sd' ),
		'name_admin_bar'        => __( 'Staff', 'nsm_sd' ),
		'archives'              => __( 'Staff Archives', 'nsm_sd' ),
		'attributes'            => __( 'Staff Attributes', 'nsm_sd' ),
		'parent_item_colon'     => __( 'Parent Staff Member:', 'nsm_sd' ),
		'all_items'             => __( 'All Staff Members', 'nsm_sd' ),
		'add_new_item'          => __( 'Add New Staff Member', 'nsm_sd' ),
		'add_new'               => __( 'Add New', 'nsm_sd' ),
		'new_item'              => __( 'New Staff Member', 'nsm_sd' ),
		'edit_item'             => __( 'Edit Staff Member', 'nsm_sd' ),
		'update_item'           => __( 'Update Staff Member', 'nsm_sd' ),
		'view_item'             => __( 'View Staff Member', 'nsm_sd' ),
		'view_items'            => __( 'View Staff Members', 'nsm_sd' ),
		'search_items'          => __( 'Search Staff Members', 'nsm_sd' ),
		'not_found'             => __( 'Not found', 'nsm_sd' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'nsm_sd' ),
		'featured_image'        => __( 'Profile Image', 'nsm_sd' ),
		'set_featured_image'    => __( 'Set profile image', 'nsm_sd' ),
		'remove_featured_image' => __( 'Remove profile', 'nsm_sd' ),
		'use_featured_image'    => __( 'Use as profile image', 'nsm_sd' ),
		'insert_into_item'      => __( 'Insert into staff member', 'nsm_sd' ),
		'uploaded_to_this_item' => __( 'Uploaded to this staff member', 'nsm_sd' ),
		'items_list'            => __( 'Staff list', 'nsm_sd' ),
		'items_list_navigation' => __( 'Staff list navigation', 'nsm_sd' ),
		'filter_items_list'     => __( 'Filter staff list', 'nsm_sd' ),
	);

	$rewrite = array(
		'slug'       => 'staff',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);

	$args = array(
		'label'               => __( 'Staff', 'nsm_sd' ),
		'labels'              => $labels,
		'supports'            => array( 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);

	register_post_type( 'staff', $args );
}

/**
 * Add a default staff silhouette if no image is applied.
 *
 * @param int $id The post ID.
 */
function nsm_sd_set_default_staff_featured_image( $id ) {
	if ( has_post_thumbnail() ) {
		return;
	}
	$nsm_sd_default_staff_profile = get_field( 'default_staff_profile', 'option' );
	// Set the default featured image.
	set_post_thumbnail( $id, $nsm_sd_default_staff_profile );
}

/**
 * Use the First and Last name custom fields to set post title.
 *
 * @param int    $id   The post ID.
 * @param object $post The post object.
 */
function nsm_sd_set_staff_name( $id, $post ) {
	if ( ! isset( $_POST['acf'] ) ) {
		return;
	}
	$nsm_sd_first_name = $_POST['acf']['field_5d9fdbe16c093'];
	$nsm_sd_last_name  = $_POST['acf']['field_5d9fdbf66c094'];
	if ( ! $nsm_sd_first_name || ! $nsm_sd_last_name ) {
		return;
	}
	$nsm_sd_title = $nsm_sd_first_name . ' ' . $nsm_sd_last_name;
	$nsm_sd_slug  = $nsm_sd_first_name . '-' . $nsm_sd_last_name;
	// Remove the action so we don't get caught in a loop.
	remove_action( 'save_post_staff', 'nsm_sd_set_staff_name' );
	wp_update_post(
		array(
			'ID'         => $id,
			'post_title' => $nsm_sd_title,
			'post_name'  => $nsm_sd_slug,
		)
	);
	// Restore the action.
	add_action( 'save_post_staff', 'nsm_sd_set_staff_name', 10, 2 );
}

