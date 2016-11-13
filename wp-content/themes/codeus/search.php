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
						<?php if(!have_posts()) : ?><h2><?php _e( 'Nothing Found', 'codeus' ); ?></h2><?php endif; ?>
						<?php get_search_form(); ?>
						<?php if(have_posts()) : ?>
						<?php if(!is_singular()) { echo '<div class="blog_list"><ul class="styled">'; } ?>
						<?php while(have_posts()) : the_post(); ?>
							<?php if(!is_singular()) { echo '<li class="clearfix">'; } ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="comment-info">
									<a href="<?php echo get_permalink($post->ID); ?>" class="date-day"><?php echo get_the_date('d'); ?></a>
									<div class="date-month"><?php echo get_the_date('M'); ?></div>
								</div>
								<div class="post-info">
									<h3><?php the_title(); ?></h3>
									<div class="inner">
										<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post_image'); ?>
										<?php if($image_url[0]) : ?>
											<div class="post-image">
												<div class="image wrap-box shadow middle">
													<div class="shadow-left"></div><div class="shadow-right"></div>
													<img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
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
						<?php else : ?>
							<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'codeus' ); ?></p>
						<?php endif; ?>
					</div><!-- #content -->
				</div><!-- #center -->
				<?php get_sidebar('blog'); ?>
			</div><!-- .panel -->
		</div><!-- .central -->
	</div><!-- #main -->
</div>
<?php get_footer(); ?>