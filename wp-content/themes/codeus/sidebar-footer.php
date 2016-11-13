<?php
/**
 * The sidebar containing the main widget area.
 */
?>

	<?php if ( is_active_sidebar( 'footer_sidebar' ) ) : ?>
		<div id="footer_sidebar">
			<?php dynamic_sidebar('footer_sidebar'); ?>
		</div><!-- #sidebar -->
	<?php endif; ?>