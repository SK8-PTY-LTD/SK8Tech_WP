<?php
/**
 * The main template.
 *
 * @package Codeus
 */

	get_header();

?>
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
<?php get_footer(); ?>