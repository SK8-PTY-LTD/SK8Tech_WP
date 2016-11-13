<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="back-to-stock"><div class="post-posts-links"><div class="left">
	<a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"><?php _e('Back to Stock', 'codeus') ?></a>
</div></div></div>
<h3 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h3>