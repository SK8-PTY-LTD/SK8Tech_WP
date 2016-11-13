<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );

?>
<h2 class="order-details-title"><?php _e( 'Order Details', 'woocommerce' ); ?></h2>
<table class="shop_table order-details received-order">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr class="checkout-cart-info">
			<td colspan="2">
				<table class="checkout-cart-info-table">
					<?php
						if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
							?>
							<tr>
								<th scope="row"><?php echo $total['label']; ?></th>
								<td><?php echo $total['value']; ?></td>
							</tr>
							<?php
						endforeach;
					?>
				</table>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<?php
		if ( sizeof( $order->get_items() ) > 0 ) {

			foreach( $order->get_items() as $key => $item ) {
				$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );

				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
					<td class="product-name">
						<?php if ($_product): ?>
							<div class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $item, $key );
									if ( ! $_product->is_visible() )
										echo $thumbnail;
									else
										printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
								?>
							</div>
						<?php endif; ?>
						<div class="product-info">
							<?php
								if ( $_product && ! $_product->is_visible() )
									echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
								else
									echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );

								echo apply_filters( 'woocommerce_order_item_quantity_html', ' <div class="product-quantity">' . __( 'Quantity:', 'woocommerce' ) . sprintf( '%s', $item['qty'] ) . '</div>', $item, $key );

								$item_meta->display();

								if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

									$download_files = $order->get_item_downloads( $item );
									$i              = 0;
									$links          = array();

									foreach ( $download_files as $download_id => $file ) {
										$i++;

										$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
									}

									echo '<br/>' . implode( '<br/>', $links );
								}
							?>
						</div>
					</td>
					<td class="product-total">
						<?php echo $order->get_formatted_line_subtotal( $item ); ?>
					</td>
				</tr>
				<?php

				if ( in_array( $order->status, array( 'processing', 'completed' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
					?>
					<tr class="product-purchase-note">
						<td colspan="3"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<div class="order-customer-details">
	<header>
		<h3><?php _e( 'Customer details', 'woocommerce' ); ?></h3>
	</header>
	<dl class="customer_details">
	<?php
		if ( $order->billing_email ) echo '<dt class="first">' . __( 'Email:', 'woocommerce' ) . '</dt><dd class="first">' . $order->billing_email . '</dd>';
		if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', 'woocommerce' ) . '</dt><dd>' . $order->billing_phone . '</dd>';

		// Additional customer details hook
		do_action( 'woocommerce_order_details_after_customer_details', $order );
	?>
	</dl>

	<div class="myaccount-splash-page">
		<div class="col2-set addresses">

			<div class="col-1 address">

				<header class="title">
					<h3><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
				</header>
				<address><p>
					<?php
						if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
					?>
				</p></address>

			</div><!-- /.col-1 -->
				
				<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

			<div class="col-2 address">

				<header class="title">
					<h3><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
				</header>
				<address><p>
					<?php
						if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
					?>
				</p></address>

			</div><!-- /.col-2 -->

		<?php endif; ?>

		</div><!-- /.col2-set -->
	</div>
</div>

<div class="clear"></div>
