<?php
/**
 * The sidebar containing the main widget area.
 */
?>

	<?php if ( is_active_sidebar( 'blog_sidebar' ) ) : ?>
		<div id="blog_sidebar" class="sidebar">
			<?php dynamic_sidebar('blog_sidebar'); ?>
		</div><!-- #sidebar -->
	<?php endif; ?>