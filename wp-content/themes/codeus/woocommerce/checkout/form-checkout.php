<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		
		<div class="tabs noscript1">
			<ul class="tabs-nav styled clearfix">
				<li><h5><a href="#tabs-billing">
					<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
						<?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?>
					<?php else : ?>
						<?php _e( 'Billing Details', 'woocommerce' ); ?>
					<?php endif; ?>
				</a></h5></li>
				<li><h5><a href="#tabs-shipping">
					<?php _e( 'Shipping Address', 'woocommerce' ); ?>
				</a></h5></li>
				<li><h5><a href="#tabs-order_review">
					Review & Payment
				</a></h5></li>
			</ul>
			<div id="tabs-billing" class="tab_wrapper">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>
			<div id="tabs-shipping" class="tab_wrapper">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
			<div id="tabs-order_review" class="tab_wrapper">
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
			</div>
		</div><div class="loading1"></div>
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>


</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>