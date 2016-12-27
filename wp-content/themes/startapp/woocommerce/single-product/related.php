<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes, 8guild
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if ( ! $related = $product->get_related( 4 ) ) {
	return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
	'posts_per_page'      => 4,
	'napaging'            => true,
	'orderby'             => $orderby,
	'post__in'            => $related,
	'post__not_in'        => array( $product->id ),
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $products->have_posts() ) :
	?>
	<div class="related products">

		<h2><?php esc_html_e( 'Related Products', 'startapp' ); ?></h2>
		<div class="row">

			<?php
			$i = 1;
			woocommerce_product_loop_start();
			while ( $products->have_posts() ) :
				$products->the_post();

				echo '<div class="col-md-3 col-sm-6">';
				wc_get_template_part( 'content', 'product' );
				echo '</div>';

				if ( $i % 2 == 0 ) {
					// fix the floating
					echo '<div class="clearfix visible-sm"></div>';
				}

				$i ++;
			endwhile;
			wp_reset_postdata();
			woocommerce_product_loop_end();
			?>

		</div>
	</div>
	<?php
endif;
