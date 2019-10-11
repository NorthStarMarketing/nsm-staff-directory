<?php
/**
 * Staff Block Template.
 *
 * @param   array        $block      The block settings and attributes.
 * @param   string       $content    The block inner HTML (empty).
 * @param   bool         $is_preview True during AJAX preview.
 * @param   int|string   $post_id    The post ID this block is saved to.
 *
 * @package Nsm_Staff_Directory
 */

$nsm_sd_id        = 'staff-' . $block['id'];
$nsm_sd_classes[] = 'wp-block-staff';

if ( ! empty( $block['anchor'] ) ) {
	$nsm_sd_id = $block['anchor'];
}

if ( ! empty( $block['align'] ) ) {
	$nsm_sd_classes[] = "align{$block['align']}";
}

?>
<div class="<?php echo esc_attr( implode( ' ', $nsm_sd_classes ) ); ?> " id="<?php echo esc_attr( $nsm_sd_id ); ?>" >
	<?php
	$nsm_sd_staff_members = get_field( 'nsm_sd_staff_members' );
	foreach ($nsm_sd_staff_members as $nsm_sd_staff_member ) {
		?>
		<div class="staff-card">
			<?php echo get_the_post_thumbnail( $nsm_sd_staff_member, 'staff-profile' ); ?>
			<div class="container">
				<h4><?php echo get_field( 'nsm_sd_first_name', $nsm_sd_staff_member ); ?> <?php echo get_field( 'nsm_sd_last_name', $nsm_sd_staff_member ); ?></h4>
				<div class="education">
					<?php echo get_field( 'nsm_sd_education', $nsm_sd_staff_member ); ?>
				</div>
				<div class="contact">
					<?php
					$nsm_sd_email = get_field( 'nsm_sd_email', $nsm_sd_staff_member );
					echo sprintf(
						'<a href="%s" target="_blank">%s</a>',
						esc_url( $nsm_sd_email ),
						$nsm_sd_email
					);
					?>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>



