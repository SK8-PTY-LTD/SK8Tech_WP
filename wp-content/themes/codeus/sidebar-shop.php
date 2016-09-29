<?php
/**
 * The sidebar containing the main widget area.
 */
?>

	<?php if ( is_active_sidebar( 'shop' ) ) : ?>
		<div id="shop_sidebar" class="sidebar">
			<?php dynamic_sidebar('shop'); ?>
		</div><!-- #sidebar -->
	<?php endif; ?>