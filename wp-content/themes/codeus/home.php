<?php
/**
 * The template of home page.
 *
 * @package Codeus
 */

	$content_wrap_start = 0;

	$home_builder = codeus_get_option('home_content') ? json_decode(stripslashes(codeus_get_option('home_content'))) : array();

	get_header();

?>

<?php if(codeus_get_option('home_content_enabled')) : ?>

	<?php if(count((array)$home_builder)) : ?>
		<?php foreach($home_builder as $block) : ?>
			<?php if(in_array($block->block_type, array('content', 'news')) && !$content_wrap_start) : ?>
				</div><!-- wrap end -->
				<!-- wrap start --><div class="content-wrap">
				<?php $content_wrap_start = 1; ?>
			<?php elseif(!in_array($block->block_type, array('content', 'news')) && $content_wrap_start) : ?>
				</div><!-- wrap end -->
				<!-- wrap start --><div class="block-wrap">
				<?php $content_wrap_start = 0; ?>
			<?php endif; ?>
	
			<div id="homepage-block-<?php echo (isset($i) ? ++$i :  $i=1); ?>" class="block <?php echo $block->block_type; ?><?php if($block->block_type == 'slideshow') { echo ' noscript'; } ?>">
				<?php if($block->block_type != 'slideshow' && $block->block_type != 'portfolio' && $block->block_type != 'clients') : ?><div class="central-wrapper clearfix"><?php endif; ?>
	
					<?php if($block->block_type == 'slideshow') : ?>
						<?php if($block->slideshow_type) : ?>
							<?php echo do_shortcode('[layerslider id="'.$block->slider.'"]'); ?>
						<?php else : ?>
							<?php codeus_slideshow($block->slideshow); ?>
						<?php endif; ?>
					<?php endif; ?>
	
					<?php if($block->block_type == 'quickfinder') : ?>
						<?php codeus_quickfinder_block($block->quickfinder); ?>
					<?php endif; ?>
	
					<?php if($block->block_type == 'portfolio') : ?>
						<?php codeus_portfolio_block($block->portfolio); ?>
					<?php endif; ?>
	
					<?php if($block->block_type == 'content') : ?>
						<?php codeus_content_block($block); ?>
					<?php endif; ?>
	
					<?php if($block->block_type == 'news') : ?>
						<?php codeus_news_block($block); ?>
					<?php endif; ?>
	
					<?php if($block->block_type == 'clients') : ?>
						<?php codeus_clients_block($block->clients_set); ?>
					<?php endif; ?>
	
				<?php if($block->block_type != 'slideshow' && $block->block_type != 'portfolio' && $block->block_type != 'clients') : ?></div><?php endif; ?>
			</div>
			<?php if($block->block_type == 'slideshow') { echo '<div class="loading"></div>'; } ?>
		<?php endforeach; ?>
	<?php else : ?>
		</div><!-- wrap end -->
		<!-- wrap start --><div class="content-wrap">
	
			<div id="main">
				<div class="central-wrapper clearfix">
					<div id="center" class="fullwidth">
	
						<div id="content">
							<h1 class="title"><?php _e('Codeus Multi-Purpose Theme', 'codeus') ?></h1>
	
							<div class="inner">
								<p><?php printf(__('Log in to <a href="%s">wordpress</a> admin and set up your starting page using <a href="%s">Home Constructor</a>.', 'codeus'), admin_url(),admin_url('themes.php?page=options-framework#home_constructor')); ?></p>
								<p>&nbsp;</p>
								<p><?php _e('Please refer to Codeus documentation <b>(Getting Started &mdash; Setting Up Homepage)</b> in order to learn how to use Home Constructor.', 'codeus'); ?></p>
								<p>&nbsp;</p>
								<p><?php _e('Additionally you can use demo content included in Codeus to quickly setup a demo of your starting page.', 'codeus'); ?></p>
							</div>
						</div><!-- #content -->
	
					</div><!-- #center -->
				</div><!-- .central-wrapper -->
			</div><!-- #main -->
	<?php endif; ?>
	
	<?php /*</div><!-- wrap end -->!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/ ?>

<?php else : ?>

	<div class="content-wrap">
		<div id="main">
			<div class="central-wrapper clearfix">
				<div class="panel clearfix">
					<div id="center" class="center clearfix">
						<div id="content">
							<?php if(!is_singular()) { echo '<div class="blog_list"><ul class="styled">'; } ?>
							<?php while(have_posts()) : the_post(); ?>
								<?php if(!is_singular()) { echo '<li class="clearfix">'; } ?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="comment-info">
										<a href="<?php echo get_permalink($post->ID); ?>" class="date-day"><?php echo get_the_date('d'); ?></a>
										<div class="date-month"><?php echo get_the_date('M'); ?></div>
									</div>
									<div class="post-info">
										<h3><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h3>
										<div class="inner">
											<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'codeus_post_image'); ?>
											<?php if($image_url[0]) : ?>
												<div class="post-image">
													<div class="image wrap-box shadow middle">
														<div class="shadow-left"></div><div class="shadow-right"></div>
														<a href="<?php echo get_permalink($post->ID); ?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
													</div>
												</div>
											<?php endif; ?>
											<div class="text clearfix"><?php the_excerpt(); ?></div>
											<?php codeus_author_info(get_the_ID()); ?>
										</div>
									<div>
								</div>
								<?php if(!is_singular()) { echo '</li>'; } ?>
							<?php endwhile; ?>
							<?php if(!is_singular()) { echo '</ul></div>'; } ?>
							<?php echo paginate_links(); ?>
						</div><!-- #content -->
					</div><!-- #center -->
					<?php get_sidebar('blog'); ?>
				</div><!-- .panel -->
			</div><!-- .central -->
		</div><!-- #main -->
	</div>

<?php endif; ?>

<?php

	get_footer();

?>