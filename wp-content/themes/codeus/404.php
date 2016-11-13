<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Codeus
 */

	get_header();

?>

	<div id="main">
		<div class="central-wrapper clearfix">
				<div id="center" class="fullwidth">
					<div id="content">
						<h1 class="title"><?php _e('Page not found.', 'codeus'); ?></h1>
						<div class="inner">
							<?php _e('Sorry, but the page you requested could not be found.', 'codeus'); ?>
						</div>
					</div><!-- #content -->
				</div><!-- #center -->
		</div><!-- .central -->
	</div><!-- #main -->

<?php get_footer(); ?>