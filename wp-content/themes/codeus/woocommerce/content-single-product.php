<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="one_half product-right-block">
		<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
	</div>

	<div class="one_half last product-left-block">
		<?php do_action( 'codeus_woocommerce_single_product' ); ?>
	</div>

	<div class="clear"></div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->
<?php /*
<div class="class-1"><?php do_action( 'woocommerce_before_single_product_summary' ); ?></div>
<div class="class-2"><?php do_action( 'woocommerce_single_product_summary' ); ?></div>
<div class="class-3"><?php do_action( 'woocommerce_after_single_product_summary' ); ?></div>
*/?>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<div class="post-tags-block clearfix">
	<?php if(codeus_get_option('show_social_icons')) { codeus_socials_sharing(); } ?>
	<div class="product_bottom_line">
		<?php do_action( 'codeus_woocommerce_single_product_bottom_line' ); ?>
	</div>
</div>
<div class="post-posts-links clearfix">
	<div class="left"><?php previous_post_link('%link', __('Previous product', 'codeus')); ?></div>
	<div class="right"><?php next_post_link('%link', __('Next product', 'codeus')); ?></div>
</div>