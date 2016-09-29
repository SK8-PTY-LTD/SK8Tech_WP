<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<form action="" method="post" class="edit-address-form">
	<div class="woocommerce-billing-collumns">
		<div class="woocommerce-billing-collumn odd clearfix">
			<p class="form-row form-row-first">
				<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			</p>
			<p class="form-row form-row-last">
				<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</p>
		</div><div class="woocommerce-billing-collumn even clearfix">
			<p class="form-row form-row-first">
				<label for="password_1"><?php _e( 'Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
				<input type="password" class="input-text" name="password_1" id="password_1" />
			</p>
			<p class="form-row form-row-last">
				<label for="password_2"><?php _e( 'Confirm new password', 'woocommerce' ); ?></label>
				<input type="password" class="input-text" name="password_2" id="password_2" />
			</p>
			<div class="clear"></div>
			<p class="form-row edit-address-form-save"><button type="submit" class="button" name="save_account_details"><?php _e( 'Save changes', 'woocommerce' ); ?></button></p>
		</div>
	</div>

	<?php wp_nonce_field( 'save_account_details' ); ?>
	<input type="hidden" name="action" value="save_account_details" />
</form>