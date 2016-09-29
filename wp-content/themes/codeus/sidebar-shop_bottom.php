<?php
/**
 * The sidebar containing the main widget area.
 */
?>

	<?php if ( is_active_sidebar( 'shop_bottom' ) ) : ?>
			<div class="fullwidth">
				<div class="divider double"></div>
				<div id="shop_bottom_sidebar">
					<?php dynamic_sidebar('shop_bottom'); ?>
				</div><!-- #sidebar -->
			</div>
	<?php endif; ?>