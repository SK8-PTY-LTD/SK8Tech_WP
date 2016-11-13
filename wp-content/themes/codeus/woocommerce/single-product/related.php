<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$related = $product->get_related( 1000 );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 1000,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );
$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

<div class="block portfolio related-products">
	<div class="lazy-loading" data-ll-item-delay="0">
		<div class="central-wrapper"><div class="fullwidth">
			<h2 class="bar-title lazy-loading-item" data-ll-effect="fading"><?php _e('Related Products', 'codeus'); ?></h2>
		</div></div>
		<div class="carousel-wrapper"><div class="carousel"><ul class="thumbs products noscript styled">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</ul><div class="loading"></div></div></div>
	</div>
</div>

<?php endif;

wp_reset_postdata();