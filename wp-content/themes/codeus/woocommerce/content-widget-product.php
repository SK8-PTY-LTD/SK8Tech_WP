<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>
<li class="clearfix">
	<?php
		$image_id = get_post_thumbnail_id($product->id);
		$image_thumb = codeus_thumbnail($image_id, 'codeus_widget_products');
		if(!empty($image_thumb)) {
			echo '<div class="image"><a href="'.get_permalink($product->id).'"><img src="'.$image_thumb[0].'" alt=""/><span class="overlay"></span></a></div>';
		} else {
			echo '<div class="image dummy"><a href="'.get_permalink($product->id).'"><span class="overlay"></span></a></div>';
		}
	?>
	<div class="title"><a href="<?php get_permalink($product->id); ?>"><?php echo $product->get_title(); ?></a></div>
	<div class="price"><?php echo $product->get_price_html(); ?></div>
	<?php if ( $product->is_on_sale() ) : ?>
		<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">%</span>', null, $product ); ?>
	<?php endif; ?>
</li>