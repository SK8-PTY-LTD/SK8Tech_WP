<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

/*$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );*/
?>

<form class="checkout_coupon shop_table cart clearfix" method="post">
	<h4 class="promo-code-heading alignleft">Have A Promotional Code?</h4>

	<div class="coupon-contents coupon alignright">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
		<button type="submit" class="button" name="apply_coupon"><?php _e( 'Apply Coupon', 'woocommerce' ); ?></button>
	</div>
</form>