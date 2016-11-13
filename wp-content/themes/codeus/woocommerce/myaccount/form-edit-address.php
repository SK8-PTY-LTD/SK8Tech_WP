<?php
/**
 * Edit address form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $current_user;

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', 'woocommerce' ) : __( 'Shipping Address', 'woocommerce' );

get_currentuserinfo();
?>

<?php wc_print_notices(); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

	<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>
	
	<?php
		$collumns = 2;
		$fields_per_collumn = ceil(count($address) / $collumns);
		$index = 0;
		$index_collumns = 1;
	?>
	
	<form method="post" class="edit-address-form">
		<div class="woocommerce-billing-collumns">

			<div class="woocommerce-billing-collumn odd clearfix">
				<?php foreach ( $address as $key => $field ) : ?>
					
					<?php if ($index >= $fields_per_collumn && $index_collumns < $collumns): ?>
						<?php
							$index_collumns++;
						?>
						</div><div class="woocommerce-billing-collumn <?php echo ($index_collumns % 2 == 0 ? 'even' : 'odd'); ?> clearfix">
					<?php endif; ?>

					<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); $index++; ?>

				<?php endforeach; ?>

				<p class="form-row edit-address-form-save">
					<button type="submit" class="button" name="save_address"><?php _e( 'Save Address', 'woocommerce' ); ?></button>
					<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
					<input type="hidden" name="action" value="edit_address" />
				</p>
			</div>
		
		</div>

	</form>

<?php endif; ?>