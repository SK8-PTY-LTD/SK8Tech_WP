<?php
/**
 * Template Name: woocommerce
 *
 * The main template file
 *
 * @package Codeus
 */

	global $post;

	get_header();


	$has_sidebar = is_active_sidebar( 'shop' ) && !is_single();

?>

	</div><!-- wrap end -->

	<!-- wrap start --><div class="content-wrap">

			<div id="main">
				<div class="central-wrapper clearfix">

					<?php if($has_sidebar){ echo '<div class="panel clearfix">'; } ?>
					<div id="center" class="<?php if($has_sidebar) {echo 'center clearfix';} else {echo 'fullwidth';} ?>">
						<div id="content"><div class="inner">
							<?php woocommerce_content(); ?>
						</div></div>
					</div><!-- #center -->
					<?php if($has_sidebar){ get_sidebar('shop'); } ?>
					<?php if($has_sidebar){ echo '</div><!-- .panel -->'; } ?>
				</div><!-- .central-wrapper -->
				<?php if(is_product()) { do_action( 'codeus_woocommerce_after_single_product' ); } ?>
				<div class="central-wrapper clearfix">
					<?php get_sidebar('shop_bottom'); ?>
				</div>
			</div><!-- #main -->
	</div><!-- wrap end -->

<?php get_footer(); ?>