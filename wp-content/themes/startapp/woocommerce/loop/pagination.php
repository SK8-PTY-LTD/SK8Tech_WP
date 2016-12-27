<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
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
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

/**
 * Filter the arguments passed to {@see paginate_links} for Shop Catalog.
 *
 * @param array $args Arguments for {@see paginate_links}
 */
$links = paginate_links( apply_filters( 'startapp_shop_pagination_args', array(
	'base'      => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
	'format'    => '',
	'add_args'  => false,
	'current'   => max( 1, get_query_var( 'paged' ) ),
	'total'     => $wp_query->max_num_pages,
	'type'      => 'plain',
	'end_size'  => 3,
	'mid_size'  => 3,
	'prev_next' => true,
	'prev_text' => '<i class="material-icons keyboard_backspace"></i>',
	'next_text' => '<i class="material-icons keyboard_backspace"></i>',
) ) );

$class = array();

$class[] = 'pagination';
$class[] = 'margin-bottom-1x';
$class[] = 'text-' . startapp_get_option( 'shop_pagination_pos', 'left' );

/**
 * Filter the classes for Shop Catalog pagination.
 *
 * @param array $class A list of extra classes
 */
$class = apply_filters( 'startapp_shop_pagination_class', $class );
$class = esc_attr( startapp_get_classes( $class ) );

echo '<section class="', $class, '"><div class="nav-links">', $links, '</div></section>';

unset( $links, $class );
