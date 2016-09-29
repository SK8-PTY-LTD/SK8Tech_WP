<?php
/**
 * The sidebar containing the main widget area.
 */
?>

<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<div id="sidebar" class="sidebar">
		<?php dynamic_sidebar('sidebar'); ?>
	</div><!-- #sidebar -->
<?php endif; ?>