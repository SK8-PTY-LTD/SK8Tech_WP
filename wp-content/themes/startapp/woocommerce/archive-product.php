<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes, 8guild
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/**
 * woocommerce_before_main_content hook.
 *
 * @see startapp_wc_open_wrapper() 5
 */
do_action( 'woocommerce_before_main_content' );

/**
 * woocommerce_archive_description hook.
 */
do_action( 'woocommerce_archive_description' );

if ( have_posts() ) :

	get_template_part( 'template-parts/shop/shop', startapp_shop_layout() );

elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after'  => woocommerce_product_loop_end( false ) ) ) ) :

	wc_get_template( 'loop/no-products-found.php' );

endif;

/**
 * woocommerce_after_main_content hook.
 *
 * @see startapp_wc_close_wrapper() 5
 */
do_action( 'woocommerce_after_main_content' );

get_footer();
