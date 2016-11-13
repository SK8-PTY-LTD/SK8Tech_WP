<?php
/**
 * Template Name: Full-Width Page
 *
 * The main template file
 *
 * @package Codeus
 */

	global $post;

	$quickfinder_position = get_post_meta($post->ID, 'codeus_quickfinder_position', TRUE) ? get_post_meta($post->ID, 'codeus_quickfinder_position', TRUE) : 0;
	$quickfinder_select = get_post_meta($post->ID, 'codeus_quickfinder_select', TRUE) ? get_post_meta($post->ID, 'codeus_quickfinder_select', TRUE) : array();

	$portfolio_position = get_post_meta($post->ID, 'codeus_portfolio_position', TRUE) ? get_post_meta($post->ID, 'codeus_portfolio_position', TRUE) : 0;
	$portfolio_filter = get_post_meta($post->ID, 'codeus_portfolio_filter', TRUE) ? get_post_meta($post->ID, 'codeus_portfolio_filter', TRUE) : 0;
	$portfolio_select = get_post_meta($post->ID, 'codeus_portfolio_select', TRUE) ? get_post_meta($post->ID, 'codeus_portfolio_select', TRUE) : array();
	$portfolio_size = get_post_meta($post->ID, 'codeus_portfolio_size', TRUE) ? get_post_meta($post->ID, 'codeus_portfolio_size', TRUE) : 'small';
	$portfolio_count = get_post_meta($post->ID, 'codeus_portfolio_count', TRUE) && get_post_meta($post->ID, 'codeus_portfolio_count', TRUE) > 0 ? get_post_meta($post->ID, 'codeus_portfolio_count', TRUE) : 6;
	$portfolio_title = get_post_meta($post->ID, 'codeus_portfolio_title', TRUE) ? get_post_meta($post->ID, 'codeus_portfolio_title', TRUE) : '';

	$gallery_position = get_post_meta($post->ID, 'codeus_gallery_position', TRUE) ? get_post_meta($post->ID, 'codeus_gallery_position', TRUE) : 0;
	$gallery_select = get_post_meta($post->ID, 'codeus_gallery_select', TRUE) ? get_post_meta($post->ID, 'codeus_gallery_select', TRUE) : 0;
	$gallery_size = get_post_meta($post->ID, 'codeus_gallery_size', TRUE) ? get_post_meta($post->ID, 'codeus_gallery_size', TRUE) : 0;
	$gallery_style = get_post_meta($post->ID, 'codeus_gallery_style', TRUE) ? get_post_meta($post->ID, 'codeus_gallery_style', TRUE) : 'no-style';

	get_header();

?>

		<?php if($quickfinder_position == 1) : ?>
			<div class="block quickfinder">
				<div class="central-wrapper clearfix">
					<?php codeus_quickfinder_block($quickfinder_select); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if($portfolio_position == 1) : ?>
			<div class="block portfolio">
				<?php codeus_portfolio_block(implode(',',$portfolio_select), $portfolio_title); ?>
			</div>
		<?php endif; ?>

	</div><!-- wrap end -->

	<!-- wrap start --><div class="content-wrap">

		<?php if(have_posts()) : the_post(); ?>

			<div id="main">
				<div class="central-wrapper clearfix">
					<div id="center" class="fullwidth">

						<div id="content">

							<?php if($gallery_select && $gallery_position == 1) : ?>
								<?php codeus_gallery($gallery_select, $gallery_size, $gallery_style); ?>
							<?php endif; ?>

							<div class="inner">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="pagination"><div class="page-links-title">' . __( 'Pages:', 'codeus' ) . '</div>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

								<?php if($quickfinder_position == 2) : ?>
									<?php codeus_quickfinder($quickfinder_select); ?>
								<?php endif; ?>

								<?php if($portfolio_position == 2) : ?>
									<?php codeus_portfolio(implode(',',$portfolio_select), $portfolio_size, $portfolio_count, $portfolio_filter, $portfolio_title); ?>
								<?php endif; ?>

								<?php if($gallery_select && $gallery_position == 3) : ?>
									<?php codeus_gallery($gallery_select, $gallery_size, $gallery_style); ?>
								<?php endif; ?>

							</div>
						</div><!-- #content -->

					</div><!-- #center -->
				</div><!-- .central-wrapper -->
			</div><!-- #main -->

		<?php endif; ?>

	</div><!-- wrap end -->

	<!-- wrap start --><div class="block-wrap">

		<?php if($quickfinder_position == 3) : ?>
			<div class="block quickfinder">
				<div class="central-wrapper clearfix">
					<?php codeus_quickfinder_block($quickfinder_select); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if($portfolio_position == 3) : ?>
			<div class="block portfolio">
				<?php codeus_portfolio_block(implode(',',$portfolio_select), $portfolio_title); ?>
			</div>
		<?php endif; ?>

	</div><!-- wrap end -->

<?php get_footer(); ?>